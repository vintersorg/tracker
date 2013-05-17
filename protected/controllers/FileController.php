<?php

class FileController extends Controller
{
	public $layout=false;		
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('*'),
				'users'=>array('*'),
			),
		);
	}
	/*
	 * отображает постер 
	 * params:
	 * (int)id = id торрента
	 * (char)size = размер
	 * return
	 * 	(stream)image not null
	 */
	/*
	 * слишком медленно
	public function actionPoster($id=null, $size='original')
	{		
		echo Func::getImage('poster', $size, $id, Yii::app()->params['fileDefaultNames']['poster']);		
	}
	*/
	/*
	 * отображает скрин 
	 * params:
	 * (int)id = id торрента
	 * (char)size = размер
	 * return
	 * 	(stream)image not null
	 */
	/*
	 * слишком медленно
	public function actionScreen($id, $size='original', $file)
	{
		echo Func::getImage('screen', $size, $id, $file);		
	}
	 */
	/*
	 * выдает торрент файл
	 * params:
	 * (int)id = id торрента
	 * return
	 * 	(stream)image not null
	 */
	
	public function actionTorrent($id)
	{
		//714ebc73790bbf14c23395962a4ff53467f1a957
		$model = Torrents::model()->findByPk($id);
		$pathToTorrent = Func::getFilePath('torrent', $id);
		$torrent = $pathToTorrent.Yii::app()->params['fileDefaultNames']['torrent'];
		if (ob_get_level()) {
	    	ob_end_clean();
	    }		
	    //подключаем класс работы с торрент файлами
		$binary = new BDecode();
		//декодируем файл, получаем массив
		$dictionary = $binary->bdecode($torrent);
		
		unset($dictionary['announce-list']);
		//TODO: где паскей взять?
		//$dictionary['announce'] = "http://bt.spark-media.ru/announce.php?passkey=b253a3904f6b5d75b58746664427ecc97";
		$dictionary['announce'] = "http://firebow.org/announce.php";
		$dictionary['comment']	= "http://firebow.org".$this->createUrl('torrent/view',array('id' => $id));
				
	    // заставляем браузер показать окно сохранения файл
	    
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/x-bittorrent');
	    header('Content-Disposition: attachment; filename=' . $model->torrent_file);
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    //header('Content-Length: ' . filesize($torrent));
		
	    // читаем файл и отправляем его пользователю
	    
	    //VarDumper::dump($dictionary);
	    print $binary->bencode($dictionary);
	}
	/*
	 * Сохраняем файлы 
	 * params:
	 * (int)id = id торрента
	 * (char)type = тип ('poster','screen')
	 * return
	 * 	(json array)about file
	 */
	
	public function actionUpload($id, $type)
	{
		//делаем особые дела для каждого типа загрузок
		$result = $this->prepareSwitcher($id, $type);
		//вывод данных о конечном файле
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
        echo $return;// it's array	
	}
	/*
	 * Передает управление методу заточенному под тип загрузки
	 * params:
	 * (int)id = id торрента
	 * (char)type = тип ('poster','screen')
	 * return
	 * 	(json array)about file
	 */	
	public function prepareSwitcher($id, $type)
	{		
		$function = 'prepare'.ucfirst(strtolower($type));
		return $this->$function($id);
	}
	/*
	 * Делат хорошо постеру
	 * params:
	 * (int)id = id торрента
	 * return
	 * 	(json array)about file
	 */	
	public function preparePoster($id)
	{
		//получаем пути до кэшей
		$file = Func::getFilePath('poster', $id);
		
		$fileName = Yii::app()->params['fileDefaultNames']['poster'];

		//кладем файл на винт
		
		$result = Func::putFile($id, 'poster');
		//переименовываем как положено
		rename($file.$result['filename'], $file.$fileName);		
		//делаем превьюхи
		Func::makeCacheImages($id, 'poster', $fileName);
		
		return $result;
	}
	/*
	 * Делат хорошо скринам
	 * params:
	 * (int)id = id торрента
	 * return
	 * 	(json array)about file
	 */	
	public function prepareScreen($id)
	{
		//получаем путь		
		$filePath = Func::getFilePath('screen', $id);
		//даем псевдослучайное цифовое имя
		$micro = explode('.',microtime(true));
		$fileName = $micro[0].$micro[1].Yii::app()->params['fileDefaultExtention']['image'];		
		//кладем файл на винт
		$result = Func::putFile($id, 'screen');
		//переименовываем как положено		
		rename($filePath.$result['filename'], $filePath.$fileName);
		//делаем превьюхи
		Func::makeCacheImages($id, 'screen', $fileName);
		return $result;
	}
	/*
	 * Делат хорошо torrent файлу
	 * params:
	 * (int)id = id торрента
	 * return
	 * 	(json array)about file
	 */	
	public function prepareTorrent($id)
	{
		//получаем пути до кэшей
		$file = Func::getFilePath('torrent', $id);
		
		$fileName = Yii::app()->params['fileDefaultNames']['torrent'];

		//кладем файл на винт		
		$result = Func::putFile($id, 'torrent');
		//переименовываем как положено
		rename($file.$result['filename'], $file.$fileName);
		
		//подключаем класс работы с торрент файлами
		$binary = new BDecode();
		//декодируем файл, получаем массив
		$dictionary = $binary->bdecode($file.$fileName);
		//делаем торент приватным
		$dictionary['info']['private'] = 1;
		
		//считаем хэш раздачи		
		$info_hash = sha1($binary->bencode($dictionary['info']));
		
		//пишем в базу
		$torrent = Torrents::model()->findByPk($id);
		$torrent->torrent_file = $result['filename'];
		$torrent->info_hash = $info_hash;
		$torrent->save();
		
		return $result;
	}
	
	
	
	
}