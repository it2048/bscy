<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name' => '百胜餐饮西南-后台系统',
        'language'=>'zh_cn',
        'defaultController' => 'adminlogin',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.models.data.*',
		'application.components.*',
        'application.components.rbac.*',
        'application.widget.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => '654321',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                //'ipFilters' => array('127.0.0.1'),
            )
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'loginUrl'=>array('admincontent/index'),
		        ),
                'session' => array(
                    'autoStart' => true,
                ),
                'request'=>array(  
                    // Enable Yii Validate CSRF Token
                    'enableCsrfValidation' => false,
                    'class'=>'HttpRequest',
                    'noCsrfValidationRoutes'=>array(
                        'admincontent','adminhomeset','home'
                    ),
                    'csrfTokenName'=>'csrf_token'
                ),  
		// uncomment the following to enable URLs in path-format
                'urlManager' => array(
                    'urlFormat' => 'path',
                    'caseSensitive' => True,
                    'rules' => array(
                        '<controller:\w+>/<id:\d+>' => '<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
                ),
		// uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=baisheng',
            'emulatePrepare' => true,
            'username' => 'kefu',
            'password' => 'abcd1234',
            'charset' => 'utf8'
        ),
        // 基于角色的用户权限认证配置
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'defaultRoles' => array('guest'),
            'itemTable' => 'Authitem',
            'itemChildTable' => 'Authitemchild',
            'assignmentTable' => 'Authassignment',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'errorAction'=>'site/error',
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
	)
);