<?php

class PassportController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	private $message;
	/*
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('restore', 'register'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('index','view','edit', 'restore'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	
	
	public function actionIndex(){
		
		$this->render('view', array(
			'model'=>$this->loadModel(Yii::app()->user->id),
		));
	}
	public function actionRestore()
	{
		$model = new RestoreForm;
		
		if(isset($_POST['RestoreForm']))
		{
			$record = new Users;
			
			$data = $record->findByAttributes(array('email' => $_POST['RestoreForm']['email']));
	
			if(empty($data->email)){				
				$model->addError('email', 'Введен не корректный Email');
			}else{
				$this->message = new YiiMailMessage;
				$this->message->setBody('Message content here with HTML', 'text/html');
				$this->message->subject = 'My Subject';
				$this->message->addTo('vintersorg61@gmail.com');
				$this->message->from = Yii::app()->params['adminEmail'];
				Yii::app()->mail->send($this->message);
				
				Yii::app()->user->setFlash('success', "Сообщение отправлено!"); 
			}	
		}
		$this->render('restore', array(
			'model' => $model
		));
		
	}
	public function actionEdit(){

		$model = $this->loadModel(Yii::app()->user->id);
		
		if(isset($_POST['Users']))
		{
			$post = $_POST['Users'];
			if(!empty($_POST['Users']['password']))
			{
				$post['password'] = crypt($post['password'],$post['password']);
			}
			$model->attributes = $post;
			
			if($model->save())
				$this->redirect(array('edit'));
		}
		
		$this->render('edit', array(
			'model'=>$model
		));
	}
	public function actionView($id){

		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionRegister(){

		$model = new Users;
		
		if(isset($_POST['Users']))
		{
			
			$post = $_POST['Users'];
			$post['openpassword'] = $post['password'];
			
			//дефолтные значения при регистрации юзера
			$username			= preg_split('/\@/', $post['email']);
			$post['username']	= $username[0];
			$post['role_id']	= Yii::app()->params['defaultRoleID'];			
			$post['password']	= crypt($post['password'],$post['password']);
			
			$model->attributes = $post;

			$this->message = new YiiMailMessage;
			$this->message->setBody('Message content here with HTML', 'text/html');
			$this->message->subject = 'My Subject';
			$this->message->addTo('vintersorg61@gmail.com');
			$this->message->from = Yii::app()->params['adminEmail'];

			if(!$model->save())
			{
				//если имя пользователя уже занято - добаляем к нему случайное число
				$errors = $model->getErrors();
				if(array_key_exists('username', $errors)){
					
					$post['username'] = $post['username'].date('is');
					$model->attributes = $post;
					if($model->save()){						
						//если регистрация прошла успешно сразу авторизуем пользователя
						$post['password']	= $post['openpassword'];
						//логинимся под новым пользователем
						$this->login($post);											
					}
				}									
			}else{
				$post['password']	= $post['openpassword'];
				//логинимся под новым пользователем
				$this->login($post);
			}
		
		}		
		
		$this->render('register', array(
			'model'=>$model
		));
	}
	public function login($params=array())
	{
		if(empty($params)) $this->redirect(array('register'));
		
		$login=new LoginForm;
		
		$login->attributes	= $params;
						
		// validate user input and redirect to the previous page if valid
		if($login->validate() && $login->login())
		{
			if(!empty($this->message))
				Yii::app()->mail->send($this->message);		
			$this->redirect(array('edit'));
		}
		$this->redirect(array('register'));
	}
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}
