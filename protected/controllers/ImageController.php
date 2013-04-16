<?php

class ImageController extends Controller
{
	public $layout=false;
	public $defaultAction = 'show';
	public $imageDefaultPaths = array(
		'poster'		=> '/images/poster/',
		'screen'		=> '/images/screen/',
		'original'		=> 'original/',
		'big'			=> 'big/',
		'small'			=> 'small/',
	);
	public $imageEmptyPaths = array(
		'poster'	=> '/images/empty/poster/',
		'screen'	=> '/images/empty/screen/',
	);
	public $imageDefaultNames = array(
		'poster'	=> 'poster',
		'screen'	=> 'screen',
	);
	public $imageDefaultExtension = 'png';
	
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
		
		$type		= 'poster';
		$filePath	= '';
		
		$torrent = Torrents::model()->findByPk($id);		
		$torrentPath = isset($torrent->middlePath)?$torrent->middlePath:'';
		
		$filePath	=	$this->getFile($type, $size, $torrentPath);
		//$thumb=Yii::app()->phpThumb->create($folder.$result['filename']);
		echo $filePath;
	}

	public function getImagePath($type, $size='small', $middlePath='', $empty=FALSE)
	{
		$filePath	= '';
		if(
			!isset($this->imageEmptyPaths[$type])	||
			!isset($this->imageDefaultPaths[$type])	||
			!isset($this->imageDefaultPaths[$size])	||
			!isset($this->imageDefaultNames[$type])
		) 
		return $filePath;
		
		$filePath	.=	$_SERVER['DOCUMENT_ROOT'];
		$filePath	.=	($empty)?$this->imageEmptyPaths[$type]:$this->imageDefaultPaths[$type];
		$filePath	.=	(!$empty)?'/'.$middlePath:'';
		$filePath	.=	$this->imageDefaultPaths[$size];
		$filePath	.=	$this->imageDefaultNames[$type];
		$filePath	.=	'.';
		$filePath	.=	$this->imageDefaultExtension;
		
		return $filePath;
	}

	public function getFile($type, $size, $middlePath)
	{
		if(is_readable($filePath=$this->getImagePath($type, $size, $middlePath))){
			Yii::app()->phpThumb->create($filePath)->show();
		}elseif(is_readable($filePath=$this->getImagePath($type, 'original', $middlePath))){
			Yii::app()->phpThumb->create($filePath)->show();
		}elseif(is_readable($filePath=$this->getImagePath($type, $size, $middlePath, true))){			
			Yii::app()->phpThumb->create($filePath)->show();
		}else{
			//безысходность
			$filePath = $_SERVER['DOCUMENT_ROOT'].'/images/empty/empty.png';
			Yii::app()->phpThumb->create($filePath)->adaptiveResize(100,150)->show();
		}
	}
}