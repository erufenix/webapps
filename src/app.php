<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

use Silex\Provider\SwiftmailerServiceProvider;

use Microstudi\Silex\ImageController\ImageController;
use Microstudi\Silex\InterventionImage\InterventionImageServiceProvider;


$app = new Application();
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());


$app['twig'] = $app->extend('twig', function ($twig, $app) {
        // add custom globals, filters, tags, ...

        $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
                    return $app['request_stack']->getMasterRequest()->getBasepath().'/'.$asset;
                }));

        return $twig;
});


/*$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver'		=> 'pdo_mysql',
		'dbname'		=> 'tcevents_turycon_reservaciones',
		'host'			=> 'localhost',
		'user'			=> 'apps17',
		'password'	=> 'cjJRDnchCSJebaGJ',
		'charset'		=> 'utf8',
		'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock' // /var/run/mysqld/mysqld.sock
	),
	//ciTpoiTc jqlIrvF1NBBDXnY3
));*/


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'reservacion' => array(
            'driver'    	=> 'pdo_mysql',
            'host'      	=> 'localhost',
            'dbname'    	=> 'tcevents_turycon_reservaciones',
            'user'      	=> 'apps17',
            'password'		=> 'cjJRDnchCSJebaGJ',
            'charset'   	=> 'utf8',
            //'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
        ),
        'operations' => array(
            'driver'    	=> 'pdo_mysql',
            'host'      	=> 'localhost',
            'dbname' 			=> 'operations',
            'user'      	=> 'usuApp17',
            'password'  	=> 'axDtoTzElzg1eGtd',
            'charset'   	=> 'utf8',
            //'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
        ),
        'devapps' => array(
            'driver'    	=> 'pdo_mysql',
            'host'      	=> 'localhost',
            'dbname' 			=> 'apps',
            'user'      	=> 'devapps',
            'password'  	=> 'Mxtlv5bm2Tq2tGG3',
            'charset'   	=> 'utf8',
            //'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
        ),
        //devapps Mxtlv5bm2Tq2tGG3
        /*'reservas' => array(
            'driver'    	=> 'pdo_mysql',
            'host'      	=> 'localhost',
            'dbname'    	=> 'tcevents_turycon_reservaciones',
            'user'      	=> 'apps17',
            'password'		=> 'cjJRDnchCSJebaGJ',
            'charset'   	=> 'utf8',
            'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
				),
				'new_operations' => array(
					'driver'    	=> 'pdo_mysql',
					'host'      	=> 'localhost',
					'dbname' 			=> 'operations',
					'user'      	=> '0p3rVT',
					'password'  	=> 'Zd32sTlL51YLb6jY',
					'charset'   	=> 'utf8',
					//'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
			),	*/

    )
));

$app->register(new DoctrineOrmServiceProvider(), array(
	'orm.ems.default' => 'reservacion',
	'orm.ems.options'	=> array(
		'reservacion' => array(
			'connection'	=> 'reservacion',
			'mappings'  	=> array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity\Reservaciones',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
				)
			)
		),
		'operations' => array(
			'connection'	=> 'operations',
			'mappings'  	=> array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity\Operaciones',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
				)
			)
		),
		'devapps' => array(
			'connection'	=> 'devapps',
			'mappings'  	=> array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity\Apps',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
				)
			)
		)
		/*'reservas' => array(
			'connection'	=> 'reservas',
			'mappings'  	=> array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity\Reservas',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
				)
			)
		),
		'new_operations' => array(
			'connection'	=> 'new_operations',
			'mappings'  	=> array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity\Operaciones',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
				)
			)
		)*/
	)
));

/*$app->register(new DoctrineOrmServiceProvider(), array(
	'orm.ems.options'	=> array(
			'mappings'  => array(
				array(
					'type'		=> 'yml',
					'namespace'	=> 'Entity',
					'path'		=> realpath(__DIR__ . "/../src/Doctrine")
			)
		)
	)
));*/

$app->register(new SessionServiceProvider(), array(
	'session.storage.options' => array(
		'name' => 'reservas'
	)
));

$app->register(new SecurityServiceProvider(), array(
	'security.firewalls' => array(
    /*Aippi Admin*/
		'AippiPanel_login' => array(
			'pattern' => '^/AippiPanel/login$'
		),
		'AippiPanel' => array(
			'pattern' => '^/AippiPanel/.*$',
			'form' => array(
				'login_path' => '/AippiPanel/login',
				'check_path' => '/AippiPanel/login_check',
				'default_target_path' => '/AippiPanel/',
				'always_use_default_target_path' => true,
				'username_parameter' => 'user_correo',
				'password_parameter' => 'user_password',
				'csrf_parameter' => 'login_token',
				'failure_path' => '/AippiPanel/login',
			),
			'users' => $app->factory(function() use ($app) {
				return new Lib\Provider\AippiAuthProvider($app);
			}),
			'logout' => array(
				'logout_path' => '/AippiPanel/logout',
				'target_url' => '/AippiPanel/login'
			)
		),
		
		/*CMI panel login*/
		'transportCMI_panel_login' => array(
			'pattern' => '^/transportCMI/panel/login$'
		),
		'transportCMI_panel' => array(
			'pattern' => '^/transportCMI/panel/.*$',
			'form' => array(
				'login_path' => '/transportCMI/panel/login',
				'check_path' => '/transportCMI/panel/login_check',
				'default_target_path' => '/transportCMI/panel/',
				'always_use_default_target_path' => true,
				'username_parameter' => 'user_correo',
				'password_parameter' => 'user_password',
				'csrf_parameter' => 'login_token',
				'failure_path' => '/transportCMI/panel/login',
			),
			'users' => $app->factory(function() use ($app) {
				return new Lib\Provider\CMIAuthProvider($app);
			}),
			'logout' => array(
				'logout_path' => '/transportCMI/panel/logout',
				'target_url' => '/transportCMI/panel/login'
			)									
		),

		/*Navistar panel login*/
		'torneoNavistar_panel_login' => array(
			'pattern' => '^/torneoNavistar/panel/login$'
		),
		'torneoNavistar_panel' => array(
			'pattern' => '^/torneoNavistar/panel/.*$',
			'form' => array(
				'login_path' => '/torneoNavistar/panel/login',
				'check_path' => '/torneoNavistar/panel/login_check',
				'default_target_path' => '/torneoNavistar/panel/',
				'always_use_default_target_path' => true,
				'username_parameter' => 'user_correo',
				'password_parameter' => 'user_password',
				'csrf_parameter' => 'login_token',
				'failure_path' => '/torneoNavistar/panel/login',
			),
			'users' => $app->factory(function() use ($app) {
				return new Lib\Provider\NavistarAuthProvider($app);
			}),
			'logout' => array(
				'logout_path' => '/torneoNavistar/panel/logout',
				'target_url' => '/torneoNavistar/panel/login'
			)									
		),

		/*upfront panel login*/
		'upfront20_panel_login' => array(
			'pattern' => '^/upfront20/panel/login$'
		),
		'upfront20_panel' => array(
			'pattern' => '^/upfront20/panel/.*$',
			'form' => array(
				'login_path' => '/upfront20/panel/login',
				'check_path' => '/upfront20/panel/login_check',
				'default_target_path' => '/upfront20/panel/',
				'always_use_default_target_path' => true,
				'username_parameter' => 'user_correo',
				'password_parameter' => 'user_password',
				'csrf_parameter' => 'login_token',
				'failure_path' => '/upfront20/panel/login',
			),
			'users' => $app->factory(function() use ($app) {
				return new Lib\Provider\UpfrontAuthProvider($app);
			}),
			'logout' => array(
				'logout_path' => '/upfront20/panel/logout',
				'target_url' => '/upfront20/panel/login'
			)									
		)		

	),
	'security.access_rules' => array(
		array('^/transportCMI/panel/', 'ROLE_ADMIN'),
		//array('^/AippiPanel', 'ROLE_ADMIN'),
		array('^/kickOff19/admin', 'ROLE_ADMIN')
		),
	'security.role_hierarchy' => array(
			'SUPER_ADMIN' => array('ROLE_ADMIN', 'ROLE_AIPPI_VIEW','ROLE_CMI_VIEW'),
			'ROLE_AIPPI_VIEW' => array('ROLE_ADMIN'),
			'ROLE_CMI_VIEW' => array('ROLE_ADMIN')
		)
));



$app->register(new JDesrosiers\Silex\Provider\JmsSerializerServiceProvider(), array(
    "serializer.srcDir" => __DIR__ . "/vendor/jms/serializer/src",
));

$app->register(new SwiftmailerServiceProvider(), array(
	//TBIM*^fx-Z
	//O_2ddW2cNDeG0RldnkG4Waxf4v17sfKMIl0s9rat0tvMMT-UsokusYKdRATBsWA2

	// EasySMTP configuration
	/*'swiftmailer.options' => array(
		'host'				=> 'ssrs.reachmail.net',
		'port' 				=> 465,
		'username' 		=> 'ERUFENIX\\erufenix',
		'password' 		=> 'erumail1',
		'encryption' 	=> 'ssl',
		'auth_mode' 	=> 'plain',
		'transport' 	=> 'smtp'
	)*/


	'swiftmailer.options' => array(
			'host'				=> 'server.tcevents.com',
			'port' 				=> 465,
			'username' 		=> 'no--reply@sin-tcevents.mx',
			'password' 		=> '9NFxVI_78q)q',
			'encryption' 	=> 'ssl',
			'auth_mode' 	=> 'login',
			'transport' 	=> 'smtp'
		)
));

/*$app->mount('/himg', new ImageController(array(
                'image_path' => getcwd() .  "/assets/files/reservas/hoteles/",
                'image_cache_path' => getcwd() .  "/assets/files/reservas/hoteles/cache/"
            ) ));*/


$app['security.default_encoder'] = $app->factory(function($app) {
	return $app['security.encoder.digest'];
});

$app['rsvModel'] = $app->factory(function($app) {
	return new Model\ReservacionesModel($app);
});

$app['rsvPanelModel'] = $app->factory(function($app) {
	//$user = new Model\rsvPanelModel($app);
	//return $user->getUser();
	return new Model\rsvPanelModel($app);
});

$app['allianceModel'] = $app->factory(function($app) {
	return new Model\AllianceModel($app);
});

$app['kickoff18Model'] = $app->factory(function($app) {
	return new Model\kick18Model($app);
});

$app['kickoff19Model'] = $app->factory(function($app) {
  return new Model\kick19Model($app);
});

$app['michelin19Model'] = $app->factory(function($app) {
  return new Model\michelin19Model($app);
});


$app['aippiModel'] = $app->factory(function($app) {
	return new Model\aippiModel($app);
});

$app['aippiUser'] = $app->factory(function($app) {
	$user = new Model\aippiModel($app);
	return $user->getUser();
});

$app['transportCMIModel'] = $app->factory(function($app) {
	return new Model\transportCMIModel($app);
});

$app['cmiUser'] = $app->factory(function($app) {
	$user = new Model\transportCMIModel($app);
	return $user->getUser();
});

$app['appsModel'] = $app->factory(function($app) {
	return new Model\appsModel($app);
});

$app['rail19Model'] = $app->factory(function($app) {
	return new Model\rail19Model($app);
});

$app['wmcModel'] = $app->factory(function($app) {
	return new Model\WMCtoursModel($app);
});

$app['upfrontModel'] = $app->factory(function($app) {
	return new Model\upfrontModel($app);
});

$app['michelin20Model'] = $app->factory(function($app) {
  return new Model\michelin20Model($app);
});

$app['torneoNavistarModel'] = $app->factory(function($app) {
  return new Model\torneoNavistarModel($app);
});

$app['NaviUser'] = $app->factory(function($app) {
	$user = new Model\torneoNavistarModel($app);
	return $user->getUser();
});


/*$app['reservaModel'] = $app->factory(function($app) {
	$user = new Model\PanelModel($app);
	return $user->getUser();
});*/

return $app;

