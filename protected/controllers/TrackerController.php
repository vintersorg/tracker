<?php

class TrackerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index', array(
			//Новые раздачи
			'recently'		=> new CActiveDataProvider(Torrents::model()->recently()),
			//Популярные раздачи
			'top'			=> new CActiveDataProvider(Torrents::model()->top()),
			//Избранные раздачи
			'favorites'		=> new CActiveDataProvider(Torrents::model()->favorites()),
			//Рекомендуемые раздачи
			'recommended'	=> new CActiveDataProvider(Torrents::model()->recommended()),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actionSchedule()
	{
		//собираем модель с найденными раздачами, у которых есть все указанные тэги
		$criteria = new CDbCriteria;
		$criteria->select = 'info_hash, sum(case when state=1 then 1 else 0 end) as seeders, sum(case when state=0 then 1 else 0 end) as leechers';		
		$criteria->group='info_hash';
		$peers = new CActiveDataProvider('Peers', array('criteria' => $criteria));
		VarDumper::dump($peers);exit;
		$torrent = Torrents::model();
		foreach ($peers as $key => $value) {
			//$torrent->findByAttributes('info_hash', 'info_hash=:info_hash', array(':info_hash'=>$peers[$key]->info_hash));
			//$torrent->seeders = $peers[$key]->seeders;
			//$torrent->peers = $peers[$key]->peers;
			VarDumper::dump($key);exit;
		}
		echo "ok";
	}
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
}