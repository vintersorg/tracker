<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Трекер',
	'timeZone'=>'Europe/Moscow',
	'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.YiiMailMessage',
		//'application.modules.rights.*',
		//'application.modules.rights.components.*',		
	),

	'modules'=>array(
	/*
		'rights'=>array(
	        'userIdColumn'=>'id',
			'enableBizRule'=>true,
	        'install' => true,//add this
	        
	    ),
	 */
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			//'class'=> 'RWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,		
			//'loginUrl' => array('/user/login'),
			
		),
		/*
		'authManager'=>array(
			'class'=>'RDbAuthManager', // Provides support authorization item sorting. ......
		),
		 */
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),		     
		),
		
		'db'=>array(
		        'tablePrefix'=>'t_',
		        'connectionString' => 'pgsql:host=localhost;port=5432;dbname=tracker',
		        'username'=>'postgres',
		        'password'=>'',
		        'charset'=>'UTF8',
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'mail'=>array(
	        'class' => 'ext.yii-mail.YiiMail',
	        'transportType' => 'smtp',
 			'viewPath' => 'application.views.mail',
 			'logging' => true,
 			'dryRun' => false,
 			'transportOptions' => array(  
			   'host' => 'smtp.gmail.com',  
			   'username' => 'vintersorg61@gmail.com',  
			   'password' => 'Pk0gbpltw',  
			   'port' => '465',  
			   'encryption' => 'tls',  
			),  
	    ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'vintersorg61@gmail.com',
		'defaultRoleID'=>2,
	),
);