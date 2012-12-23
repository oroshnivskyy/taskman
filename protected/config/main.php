<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
$routes = include_once 'routing.php';
return array(

    'basePath' => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Task manager',
    // preloading 'log' component
    'preload' => array( 'log' ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class' => 'system.gii.GiiModule',
            'password' => '1111',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array( '127.0.0.1', '::1' ),
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),
        'user'=>array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
    ),
    'theme'=>'bootstrap', // requires you to copy the bootstrap under your themes directory

    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=> $routes,
            'showScriptName'=>false,
            'caseSensitive'=>false,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=taskmanager',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'enabled' => YII_DEBUG,
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'application.extensions.yii-debug-toolbar.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array( '127.0.0.1', '192.168.1.215' ),
                ),
            ),
            // uncomment the following to show log messages on web pages
            /*
            array(
                'class'=>'CWebLogRoute',
            ),
            */
        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);