<?php

class TorrentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'edit', 'admin', 'delete', 'special'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$this->redirect(array('create'));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$formModel		= new TorrentFirstForm;
		$tagsModel		= new Tags;
		$torrentsSearch	= ''; //в представлении будет проверка на пустоту
		
		if(isset($_POST['TorrentFirstForm']))
		{
			$formModel->attributes=$_POST['TorrentFirstForm'];
			if($formModel->validate())
			{
				$torrent_id = $formModel->createTorrent();
				$this->redirect(array('edit','id'=>$torrent_id));
			}			
		}
	
		$this->render('create',array(
			'model'			=> $formModel,
			'torrentsSearch'=> $torrentsSearch,
		));
	}
	public function actionEdit($id)
	{
		$formModel		= new TorrentEditForm;
		$formModel->torrent_id	= $id;
		$tagsModel		= new Tags;
		
		if(isset($_POST['TorrentEditForm']))
		{
			VarDumper::dump($_POST);
			$formModel->attributes=$_POST['TorrentEditForm'];
			if($formModel->validate())
			{
				$formModel->saveTorrent();
				$this->redirect(array('special','id'=>$id));
			}
		}
		$torrentModel = Torrents::model()->findByPK($formModel->torrent_id);
		if(empty($torrentModel->id)){ $torrentModel = new Torrents;}
		$formModel->getAdditionalFields();
		$formModel->attributes=$torrentModel->attributes;
				
		$this->render('edit',array(
			'model'			=> $formModel,
			'torrentModel'	=> $torrentModel,
			
		));
	}
	public function actionSpecial($id)
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
		
		$this->render('special',array(
			'model'			=> $formModel,
			'country'		=> $tagsModel->getCat('country'),
			'producer'		=> $tagsModel->getCat('producer'),
			'actors'		=> $tagsModel->getCat('actor'),
		));
	}


}