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
				'actions'=>array('create','update', 'edit'),
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
		$torrents		= new stdClass;
		
		if(isset($_POST['TorrentFirstForm']))
		{
			$formModel->attributes=$_POST['TorrentFirstForm'];
			if($formModel->validate())
			{
				$tag_ids = $formModel->searchTags();
				$torrents = $torsModel->getTorrentByTags($tag_ids);
				if(empty($torrents))
				{
					$torsModel->created_by = Yii::app()->user->id;
					$torsModel->approve_id = 1;
					if($torsModel->save())
						$this->redirect(array('edit','id'=>$torsModel->id));
				}	 
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
		$tagsModel		= new Tags;
		$torsModel		= new Torrents;
		$this->render('edit',array(
			'model'			=> $formModel,
			'nameLocal'		=> $tagsModel->getCat('nameLocal'),
			'nameOrigin'	=> $tagsModel->getCat('nameOrigin'),
			'year'			=> $tagsModel->getCat('year'),
			'torrents'		=> $torsModel,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Torrents the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Torrents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}