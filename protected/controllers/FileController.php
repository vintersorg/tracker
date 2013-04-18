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
	
	public function actionPoster($id=null, $size='small')
	{
		echo $this->getImage('poster', $size, $id);		
	}
	/*
	 * отображает скрин 
	 * params:
	 * (int)id = id торрента
	 * (char)size = размер
	 * return
	 * 	(stream)image not null
	 */
	
	public function actionScreen($id, $size='small')
	{		
		echo $this->getImage('screen', $size, $id);		
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
		$files[] = $this->getFilePath('poster', 'original', $id);
		$files[] = $this->getFilePath('poster', 'big', $id);
		$files[] = $this->getFilePath('poster', 'small', $id);
		
		$fileName = Yii::app()->params['fileDefaultNames']['poster'];
		//удаляем кэши, если такие имеются
		foreach ($files as $key => $value) {
			if(file_exists($value.$fileName)) unlink($value.$fileName);
		}
		//кладем файл на винт
		
		$result = $this->putImage($files[0], 'poster');
		//переименовываем как положено
		rename($files[0].$result['filename'], $files[0].$fileName);
		
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
		$filePath = $this->getFilePath('screen', 'original', $id);		
		//кладем файл на винт
		$result = $this->putImage($filePath, 'screen');
		
		return $result;
	}

	/*
	 * Кладем папку на винт
	 * params:
	 * (char)filePath = путь до файла
	 * return
	 * 	(json array)about file
	 */
	public function putImage($filePath, $type)
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");			
		$uploader = new qqFileUploader(Yii::app()->params['fileAllowedExtensions'][$type], Yii::app()->params['fileSizeLimit'][$type]);
		//true - перезапись файла. иначе будет менять имя. нам вроде без разницы, но и файлы плодить не нужно
		return $uploader->handleUpload($filePath);
	}
	/*
	 * Собирает путь до картинки (файла?)
	 * params:
	 * (char)type = тип
	 * (char)size = размер
	 * (int)id = id раздачи
	 * (boolean)empty = true - выдать файл заглушку
	 * return
	 * 	(char)filePath
	 */
	public function getFilePath($type, $size='', $id)
	{
		$filePath	= '';
		
		$filePath	.=	$_SERVER['DOCUMENT_ROOT'];
		$filePath	.=	Yii::app()->params['filePath'][$type];
		$filePath	.=	$this->getMiddlePath($id);
		$filePath	.=	!empty($size)?Yii::app()->params['filePath'][$size]:'';
		
		//если папки нет, создаем
		if(!file_exists($filePath)) mkdir($filePath, 0777, true);
		
		return $filePath;
	}
	
	/*
	 * Выдает картинку потоком
	 * params:
	 * (char)type = тип
	 * (char)size = размер
	 * (int)id = id раздачи
	 * return
	 * 	(stream)image not null
	 */
	public function getImage($type, $size, $id, $filename='')
	{
		$filePathCache		= $this->getFilePath($type, $size, $id);
		$filePathOriginal	= $this->getFilePath($type, 'original', $id);
		if(empty($filename))		
			$filename		= Yii::app()->params['fileDefaultNames'][$type];	
		
		//смотрим в кэш
		if(is_readable($filePathCache.$filename)){			
			Yii::app()->phpThumb->create($filePathCache.$filename)->show();
		//в кеше фига? тогда в оригиральный файл
		}elseif(is_readable($filePathOriginal.$filename)){
			//размеры
			list($width, $height) = Yii::app()->params['imageSize'][$type][$size];
			//готовим папку
			if(!file_exists($filePathCache)) mkdir($filePathCache, 0777, true);
			
			Yii::app()->phpThumb->create($filePathOriginal.$filename)
				->adaptiveResize($width,$height)
				->save($filePathCache.$filename)->show();
		}		
	}
	
	/*
	 * получаем путь до файлов раздачи относительно id 
	 * params:
	 * (int)id = id раздачи
	 * return
	 * 	(stream)image not null
	 */
	public function getMiddlePath($id)
	{
		$path = '';
		
		if(empty($id)) return $path;
		
		$string = $id;
		while(strlen($string)){
			//поддиректории из 2х символов
			$step = substr($string, 0, 2);
			$string = substr_replace($string, '', 0, 2);
			if(strlen($step) == 1)
				$path .= '0'.$step;
			else
				$path .= $step;			
			if(strlen($string) >0 ) $path .= DIRECTORY_SEPARATOR;
		}
		$path = $path.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
		return $path;
	}
}