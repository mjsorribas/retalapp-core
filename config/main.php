<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('app',dirname(__FILE__).'/../../app/');
Yii::setPathOfAlias('core',dirname(__FILE__).'/..');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$db=require(dirname(__FILE__).'/../../app/config/db.php');

$configDB=$db['localhost'];
if(isset($db[$_SERVER['HTTP_HOST']]))
    $configDB=$db[$_SERVER['HTTP_HOST']];

return array(

    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/../../app/',
    'theme'=>'classic',
    'defaultController'=>'home',
    'modules' => require(dirname(__FILE__).'/../../app/config/modules.php'),
    'extensionPath' => dirname(__FILE__).'/../extensions/',
    'runtimePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '/../../app/logs/',
    'name' => 'My Application',
     // path aliases
    'aliases' => array(
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/yiistrap'), // change if necessary
        // yiiwheels configuration
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary
    ),
    // preloading 'log' component
    'preload' => array('log'),
    // 'defaultController' => 'admin',
    // autoloading model and component classes
    'import' => array(
        'core.extensions.modules.users.models.*',
        'application.components.*',
        'core.components.*',
        'bootstrap.helpers.TbHtml',
    ),
    // application components
    'components' => array(
        // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        // yiiwheels configuration
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
        'pol' => array(
            'class' => 'core.extensions.components.pol.GPol',
          
            // Estas son de prueba
            'ApiKey' => '6u39nqhq8ftd0hlvnjfs66eh8c',
            'merchantId' => '500238',
            'accountId' => '500538',
            
            // 'responseUrl' => '/gym/page/response',
            // 'confirmationUrl' => '/gym/page/confirmation',

            'currency' => 'USD',
        ),
        'email' => array(
            'class' => 'core.extensions.components.email.GPHPMailer',
            'colorTemplate'=>'#1f535c',
            'colorFontTemplate'=>'#8ea9ae',
        ),
        'editable' => array(
            'class' => 'core.extensions.components.editable.DEEditable'
        ),
        'format' => array(
            'class' => 'core.extensions.components.format.BFormatter',
        ),
        'security' => array(
            'class' => 'core.extensions.components.security.GSecurityManager',
        ),
        'user' => array(
            'class' => 'core.extensions.components.auth.GSWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/users/page/login'),
            'loginRequiredAjaxResponse' => 'YII_LOGIN_REQUIRED',
        ),
        'cache' => array(
            'class' => 'CFileCache',
            'enabled'=>!YII_DEBUG,
        ),
        'authManager' => array(
            "class" => "CDbAuthManager",
            "connectionID" => "db",
            "itemTable" => 'users_authitem',
            "itemChildTable" => 'users_authitemchild',
            "assignmentTable" => 'users_authassignment',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            // 'urlSuffix' => '.html',
            'rules' => array(
                'themes/<theme:\w+>/view/site/<page:\w+\.php>' => 'site/<page>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => $configDB,
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => '/site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            // array(
            // 	'class'=>'CWebLogRoute',
            // ),
            // array(
            // 	'class'=>'core.extensions.components.log.GEmailLogRoute',
            // 	'enabled'=>!YII_DEBUG,
            // 	'emails'=>array("developer@email.com"),
            // 	'subject'=>"[ERRORS] APP ".time(),
            // 	'levels'=>'error, warning',
            // ),
            ),
        ),
    ),
    'controllerMap'=>array(
        'site'=>array(
            'class'=>'core.extensions.actions.SiteController'
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'adminmail@mail.com',
        'developerEmail' => 'developer@mail.com',
        'version' => 'v0.1.1',
    ),
);
