<?php

class TorrentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'create';
	public $page;
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
				'actions'=>array('view','category','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform actions
				'actions'=>array('create','update', 'edit', 'admin', 'delete', 'special', 'preview','upload'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$formModel		= new TorrentFirstForm;		
		$formModelChois	= new TorrentChoisForm;
		$tagsModel		= new Tags;
		$torrents		= array(); //для отображения списка найденых раздач
		
		if(isset($_POST['TorrentFirstForm']))
		{
			$formModel->attributes=$_POST['TorrentFirstForm'];
			if($formModel->validate())
			{
				$result = $formModel->createTorrent();
				if($result['created'])
					$this->redirect(array('edit','id'=>$result['torrent_id']));
				else {
					$torrents = $result['torrents'];
				}
			}			
		}
		if(isset($_POST['TorrentChoisForm']))
		{
			$formModelChois->attributes=$_POST['TorrentChoisForm'];
			if($formModelChois->validate())
			{
				$this->redirect(array('special','id'=>$formModelChois->torrentGroup));				
			}else{
				VarDumper::dump($formModelChois->attributes);
			}
		}
		$this->render('create',array(
			'model'			=> $formModel,
			'list'			=> $torrents, 
			'modelChois'	=> $formModelChois,
		));
	}
	public function actionView($id){
		$model = $this->loadModel($id);
		$pathToScreen = Func::getFilePath('screen', $id);		
		$screensPath = glob($pathToScreen.'*.{png}', GLOB_BRACE);
		$screens = Func::getfileName($screensPath);
		
		$pathToTorrent = Func::getFilePath('torrent', $id);
		$torrent = $pathToTorrent.Yii::app()->params['fileDefaultNames']['torrent'];
		
		$this->render('view', array(
			'model'=>$model,			
			'preview' => false,
			'screens' => $screens,
			'torrent' => $torrent,
		));
	}
	public function actionEdit($id)
	{
		$formModel		= new TorrentEditForm;
		$formModel->torrent_id	= $id;
		$tagsModel		= new Tags;
		
		if(isset($_POST['TorrentEditForm']))
		{
			$formModel->attributes=$_POST['TorrentEditForm'];
			if($formModel->validate())
			{
				$formModel->saveTorrent();
				$this->redirect(array('special','id'=>$id));
			}
		}
		$torrentModel = Torrents::model()->findByPK($formModel->torrent_id);
		if(empty($torrentModel->id)){ $torrentModel = new Torrents;}
		$formModel->attributes=$torrentModel->attributes;
				
		$this->render('edit',array(
			'model'			=> $formModel,
			'torrentModel'	=> $torrentModel,
			
		));
	}
	public function actionSpecial($id)
	{
		$model = Torrents::model()->findByPk($id);	
	    $this->render('special', array(
	        'model' => $model,
	    ) );
	}
	public function actionCategory($id)
	{
		//VarDumper::dump($category);exit;
		try{
			$model = Torrents::model()->$id();
			$torrents = new CActiveDataProvider($model);	
			$this->render('category', array('torrents'=>$torrents, 'category'=>$id));
		}catch(exception $e){
			$this->render('/tracker/error', array('code'=>404, 'message'=>'Системе не удалось найти запрашиваемое действие "'.$id.'".'));
		}
		
	}
	public function actionSearch($search)
	{
		$category = 'Поиск';
		$model = Torrents::model()->tagSearch($search);
		$torrents = new CActiveDataProvider($model);	
		$this->render('category', array('torrents'=>$torrents, 'category'=>$category));
		
	}
	public function loadModel($id)
	{
		$model=Torrents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionPreview($id){
		$model = $this->loadModel($id);
		$this->render('view', array(
			'model'=>$model,
			'preview' => true,
		));
	}
}