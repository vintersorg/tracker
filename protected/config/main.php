<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'FireBow',
	'timeZone'=>'Europe/Moscow',
	'language' => 'ru',
	'defaultController' => 'tracker', 

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.components.*',
		'application.extensions.yii-mail.YiiMailMessage',
		
	),

	'modules'=>array(

		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),		
		'comments'=>array(
			'class'=>'ext.comments.CommentsModule',
	        //you may override default config for all connecting models
	        'defaultModelConfig' => array(
	            //only registered users can post comments
	            'registeredOnly' => true,
	            'useCaptcha' => false,
	            //allow comment tree
	            'allowSubcommenting' => true,
	            //display comments after moderation
	            'premoderate' => false,
	            //action for postig comment
	            'postCommentAction' => 'comments/comment/postComment',
	            //super user condition(display comment list in admin view and automoderate comments)
	            'isSuperuser'=>'Yii::app()->user->checkAccess("moderate")',
	            //order direction for comments
	            'orderComments'=>'DESC',
	        ),
	        //the models for commenting
	        'commentableModels'=>array(
	            //model with individual settings
	            'torrents'=>array(
	                'registeredOnly'=>false,
	                'useCaptcha'=>false,
	                'allowSubcommenting'=>false,
	                //config for create link to view model page(page with comments)
	                'pageUrl'=>array(
	                    'route'=>'torrent/view',
	                    //'data'=>array('id'=>'id'),
	                ),
	            ),
	            //model with default settings
	            'ImpressionSet',
	        ),
	        //config for user models, which is used in application
	        'userConfig'=>array(
	            'class'=>'Users',
	            'nameProperty'=>'username',
	            'emailProperty'=>'email',
	        ),
	    ),

	),

	// application components
	'components'=>array(
		'phpThumb'=>array(
		    'class'=>'ext.EPhpThumb.EPhpThumb',
		    //'options'=>array()
		),
		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,		
			'loginUrl' => array('/passport/login'),
			
		),
		'authManager'=>array(
				
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            
			 		
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				''=>'tracker/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>',
			),		     
		),
		
		'db'=>array(
		        'tablePrefix'=>'t_',
		        'connectionString' => 'pgsql:host=localhost;port=5432;dbname=tracker',
		        'username'=>'tracker',
		        'password'=>'tracker',
		        'charset'=>'UTF8',
		        /*
		        // включаем профайлер
		        'enableProfiling'=>true,
		        // показываем значения параметров
		        'enableParamLogging' => true,
				*/
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'dbt'=>array(
			'class' => 'system.db.CDbConnection',
			'connectionString' => 'mysql:host=mysql.spark-media.ru;dbname=torent',
			'emulatePrepare' => true,
			'username' => 'tracker',
			'password' => '8ZIPeapZMYr4NYu9tG8s',
			'charset' => 'UTF8',
		),
		
		'errorHandler'=>array(
			// use 'tracker/error' action to display errors
			'errorAction'=>'tracker/error',
		),
		/*
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					 
					 
					'class'=>'CProfileLogRoute',
		            'levels'=>'profile',
		            'enabled'=>true,
		            
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),		
		*/
		'mail'=>array(
	        'class' => 'ext.yii-mail.YiiMail',
	        'transportType' => 'smtp',
 			'viewPath' => 'application.views.mail',
 			'logging' => true,
 			'dryRun' => false,
 			'transportOptions' => array(  
			   'host' => 'smtp.yandex.ru',  
			   'username' => 'mailer@firebow.org',  
			   'password' => 'firebow+3000mailer',  
			   'port' => '465',  
			   'encryption' => 'tls',  
			),  
	    ),
	    'bootstrap' => array(
		    'class' => 'ext.bootstrap.components.Bootstrap',
		    'responsiveCss' => true,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@firebow.org',
		'defaultRoleID'=>2,
		'officialAppName'=> $_SERVER['SERVER_NAME'],
		'registerMail' => 'mailer@firebow.org',
		'filePath' => array(
			'poster'		=> 'posters/',
			'screen'		=> 'screens/',
			'torrent'		=> 'torrents/',
			'big'			=> 'big/',
			'middle'		=> 'middle/',
			'small'			=> 'small/',
			'original'		=> 'original/',
		),
		'fileDefaultNames' => array(
			'poster'	=> 'poster.png',
			'screen'	=> 'screen.png',
			'torrent'	=> 'torrent.torrent',
		),
		'fileDefaultExtention' => array(
			'image' => '.png',
			'torrent' => '.torrent',
		),
		'imageSize' => array(
			'poster' => array(
				'big'	=> array(350,400),
				'small'	=> array(150,200),
				'middle'=> array(250,300),
			),
			'screen' => array(
				'small'	=> array(150,100),
			),
		),
		'fileSizeLimit' => array(
			'poster' => 10 * 1024 * 1024,// maximum file size in bytes,
			'screen' => 10 * 1024 * 1024,// maximum file size in bytes,
			'torrent' => 3145728,// maximum file size in bytes,
		),
		'fileAllowedExtensions' => array(
			'poster' => array("jpg","jpeg","gif","png","bmp"),
			'screen' => array("jpg","jpeg","gif","png","bmp"),
			'torrent' => array("torrent"),
		),
	),
);