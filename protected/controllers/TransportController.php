<?php

class TransportController extends Controller
{
	public $layout='//layouts/clear';
	//public $layout=false;
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('list','torrent'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionList($id)
	{		
		$connection = Yii::app()->dbt;
		
		$sql = "select id from torrents where id > ".mysql_escape_string($id)." order by id desc limit 1000"; 
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		foreach($result as $key => $val)
			$data['torrents'][] = $val['id'];
		
		$this->render('json', array('data'=> $data));
	}
	public function actionTorrent($id)
	{
		
		$connection = Yii::app()->dbt;
		
		$sql = "select * from torrents where id = ".mysql_escape_string($id); 
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		
		$data['torrent'] = $result;
		
		$this->render('json', array('data'=> $data));
		//Func::pre(json_decode(json_encode($data)));
	}

	/*
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

}