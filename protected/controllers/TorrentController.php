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
				'actions'=>array('create','update', 'edit', 'admin','delete'),
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
		return $this->actionCreate();
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$formModel		= new TorrentFirstForm;
		$tagsModel		= new Tags;
		$torsModel		= new Torrents;
		$torrents		= ''; //в представлении будет проверка на пустоту
		
		if(isset($_POST['TorrentFirstForm']))
		{
			$formModel->attributes=$_POST['TorrentFirstForm'];
			if($formModel->validate())
			{
				$formModel->createTorrent();
			}			
		}
	
		$this->render('create',array(
			'model'			=> $formModel,
			'nameLocal'		=> $tagsModel->getCat('nameLocal'),
			'nameOrigin'	=> $tagsModel->getCat('nameOrigin'),
			'year'			=> $tagsModel->getCat('year'),
			'torrents'		=> $torrents,
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
		
		$this->render('edit',array(
			'model'			=> $formModel,
			'country'		=> $tagsModel->getCat('country'),
			'producer'		=> $tagsModel->getCat('producer'),
			'actors'		=> $tagsModel->getCat('actor'),
		));
	}


}