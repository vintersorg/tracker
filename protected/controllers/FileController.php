<?php

class FileController extends Controller
{
	public $layout=false;
	public $defaultAction = 'show';
	public $fileDefaultPaths = array(
		'poster'		=> '/images/poster/',
		'screen'		=> '/images/screen/',
		'original'		=> 'original/',
		'big'			=> 'big/',
		'small'			=> 'small/',
	);
	public $fileEmptyPaths = array(
		'poster'	=> '/images/empty/poster/',
		'screen'	=> '/images/empty/screen/',
	);
	public $fileDefaultNames = array(
		'poster'	=> 'poster',
		'screen'	=> 'screen',
	);
	public $fileDefaultExtension = 'png';
	
	//источник безысходности
	public $emptyImage = '/images/empty/empty.png';
	
	public $imageDefaultSize = array(
		'poster' => array(
			'big'	=> array(200,250),
			'small'	=> array(100,150),
		),
		'screen' => array(
			'small'	=> array(150,100),
		),
	);
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
		//получаем полный путь до будующего файла	
		$fileFullPath = $this->makeFilePath($type, $id);
		//отрезаем директорию 		
		$filePath = pathinfo($fileFullPath,PATHINFO_DIRNAME).DIRECTORY_SEPARATOR;
		//делаем особые дела для каждого типа загрузок
		$result = $this->prepareSwitcher($id, $type);
		//вывод данных о конечном файле
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 		$fileSize=filesize($fileFullPath);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
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
		//получаем часть пути основанной на is		
		$middlePath = $this->getMiddlePath($id);
		//получаем пути до кэшей
		$files[] = $this->getImagePath('poster', 'original', $id);
		$files[] = $this->getImagePath('poster', 'big', $id);
		$files[] = $this->getImagePath('poster', 'small', $id);
		//удаляем кэши, если такие имеются
		foreach ($files as $key => $value) {
			if(file_exists($value)) unlink($value);
		}
		//кладем файл на винт
		$filePath = pathinfo($files[0],PATHINFO_DIRNAME).DIRECTORY_SEPARATOR;		
		$result = $this->putImage($filePath);
		//переименовываем как положено
		rename($filePath.$result['filename'], $files[0]);
		
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
		//получаем часть пути основанной на is		
		$middlePath = $this->getMiddlePath($id);
		//получаем пути до кэшей		
		$files[] = $this->getImagePath('screen', 'original', $id);
		$files[] = $this->getImagePath('screen', 'small', $id);
		//удаляем кэши, если такие имеются
		foreach ($files as $key => $value) {
			if(file_exists($value)) unlink($value);
		}
		//кладем файл на винт
		$filePath = pathinfo($files[0],PATHINFO_DIRNAME).DIRECTORY_SEPARATOR;	
		$result = $this->putImage($filePath);
		//переименовываем как положено
		rename($filePath.$result['filename'], $files[0]);
		
		return $result;
	}
	/*
	 * Делаем папку для загрузки
	 * params:
	 * (int)id = id торрента
	 * (char)type = тип ('poster','screen')
	 * return
	 * 	(char)fileFullPath
	 */
	public function makeFilePath($type, $id)
	{
		//получаем путь куда класть файл
		$fileFullPath = $this->getImagePath($type, 'original', $id);
		$filePath = pathinfo($fileFullPath,PATHINFO_DIRNAME).DIRECTORY_SEPARATOR;
		//если папки нет, создаем
		if(!file_exists($filePath))
			mkdir($filePath, 0777, true);
		
		return $fileFullPath;
	}
	/*
	 * Кладем папку на винт
	 * params:
	 * (char)filePath = путь до файла
	 * return
	 * 	(json array)about file
	 */
	public function putImage($filePath)
	{
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$allowedExtensions = array("jpg","jpeg","gif","png","bmp");//array("jpg","jpeg","gif","exe","mov" and etc...
		
		Yii::import("ext.EAjaxUpload.qqFileUploader");			
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		//true - перезапись файла. иначе будет менять имя. нам вроде без разницы, но и файлы плодить не нужно
		return $uploader->handleUpload($filePath, true);
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
	public function getImagePath($type, $size='small', $id, $empty=FALSE)
	{
		$filePath	= '';
		if(
			!isset($this->fileEmptyPaths[$type])	||
			!isset($this->fileDefaultPaths[$type])	||
			!isset($this->fileDefaultPaths[$size])	||
			!isset($this->fileDefaultNames[$type])
		) 
		return $filePath;
		
		$filePath	.=	$_SERVER['DOCUMENT_ROOT'];
		$filePath	.=	($empty)?$this->fileEmptyPaths[$type]:$this->fileDefaultPaths[$type];
		$filePath	.=	$this->getMiddlePath($id);
		$filePath	.=	$this->fileDefaultPaths[$size];
		$filePath	.=	$this->fileDefaultNames[$type];
		$filePath	.=	'.';
		$filePath	.=	$this->fileDefaultExtension;
		
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
	public function getImage($type, $size, $id)
	{
		//смотрим в кэш
		if(is_readable($filePathTarget=$this->getImagePath($type, $size, $id))){
			
			Yii::app()->phpThumb
				->create($filePathTarget)
				->show();
		//в кеше фига? тогда в оригиральный файл
		}elseif(is_readable($filePathOriginal=$this->getImagePath($type, 'original', $id))){
			list($width, $height) = $this->imageDefaultSize[$type][$size];
			if(!file_exists(pathinfo($filePathTarget, PATHINFO_DIRNAME)))
				mkdir(pathinfo($filePathTarget, PATHINFO_DIRNAME), 0777, true);
			
			Yii::app()->phpThumb
				->create($filePathOriginal)
				->adaptiveResize($width,$height)
				->save($filePathTarget)
				->show();
		//нет картинки? тогда подставим заглушку
		}elseif(is_readable($filePathEmpty=$this->getImagePath($type, $size, $id, true))){			
			Yii::app()->phpThumb->create($filePathEmpty)->show();			
		//заглушки тоже нет по размеру? так и быть сделаем из заготовки
		}else{
			//безысходность
			$emptyPath = $_SERVER['DOCUMENT_ROOT'].$this->emptyImage;
			list($width, $height) = $this->imageDefaultSize[$type][$size];
			if(!file_exists(pathinfo($filePathEmpty, PATHINFO_DIRNAME)))
				mkdir(pathinfo($filePathEmpty, PATHINFO_DIRNAME), 0777, true);
			
			Yii::app()->phpThumb
				->create($emptyPath)
				->adaptiveResize($width,$height)
				->save($filePathEmpty)
				->show();
		}
		//если и тут нет, то ищите сами
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