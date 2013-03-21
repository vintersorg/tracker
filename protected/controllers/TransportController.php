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
				'actions'=>array('list','torrent', 'files'),
				'users'=>array('*'),
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
		
		$sql = "select t.*, g.screens_path, tm.video, tm.audio, ts.bitreid, ac.name as audio_codec 
				from torrents as t 
				join genres as g on t.category=g.id
				left join torrents_movies as tm on tm.id=t.id
				left join torrents_music as ts on ts.id=t.id
				left join info_audio_codecs as ac on ac.id=ts.audio_codec
				where t.id = ".mysql_escape_string($id); 
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		
		//$data = $result[0];
		foreach($result as $k => $val)
			foreach($val as $key => $value)
				$data[$key] = preg_replace('#[\n\r]+#', "\\n", $value);
		
		$data['host'] = 'http://tracker.spark-media.ru';
		$data['poster_path'] = '/poster/'.substr($id, 0, strlen($id)-3).'/';
		
		$data['poster'][] = $id.'.jpg';
		$data['screen_path'] = '/screens/'.$data['screens_path'].'/';
		
		$sql = "select id,file_name,width,height from screenshots where torrent_id=".mysql_escape_string($id)." order by record_time";
		 
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		foreach($result as $key => $val)
			$data['screen'][] = $val;
		//Func::pre($data);exit;
		$this->render('json', array('data'=> $data));
		
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
