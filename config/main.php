<?php
// This is the main Yii 1 Web application configuration. Any writable
// CWebApplication properties can be configured here.


/**
 * We are creating the aliases for retalapp structure
*/ 

/**
 * Now we can set the oters path configuraions
*/
$appAlias=Yii::getPathOfAlias('app');

$paramsConfig=array(
    'version' => 'v0.1.1',
);


if(file_exists($appAlias.'/config/app.php'));
    $paramsConfig=array_merge(require($appAlias.'/config/app.php'));

if(!isset($paramsConfig['adminEmail']))
    $paramsConfig['adminEmail']='';

/**
 * Read app database configuration
*/
$db=require($appAlias.'/config/database.php');


/**
 * Databases config according to a host to use
*/
$dbConfig=$db['localhost'];
if(isset($_SERVER['HTTP_HOST']) and isset($db[$_SERVER['HTTP_HOST']]))
    $dbConfig=$db[$_SERVER['HTTP_HOST']];


$componentsConfig=require(dirname(__FILE__).'/components.php');
if(file_exists($appAlias.'/config/components.php'))
    $componentsConfig=array_merge($componentsConfig,require($appAlias.'/config/components.php'));


$urlDefault=array(
    '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
);

if(isset($paramsConfig['urlRules'])) {
    $urlDefault=$paramsConfig['urlRules'];
}

$componentsConfig['db']=$dbConfig;
$defaultController='home';
if(isset($paramsConfig['defaultModule']))
    $defaultController=$paramsConfig['defaultModule'];
/*
if(isset($componentsConfig['log'])) {
    unset($componentsConfig['log']); 
    $componentsConfig['log']['class'] = 'CLogRouter';
    $componentsConfig['log']['routes'][] = array(
        'class' => 'CFileLogRoute',
        'levels' => 'error, warning',
    );
    
    if(isset($paramsConfig['debugWeb']) and $paramsConfig['debugWeb']) {
        $componentsConfig['log']['routes'][] = array(
         'class'=>'CWebLogRoute',
        );
    }

    if(isset($paramsConfig['profileWeb']) and $paramsConfig['profileWeb']) {
        $componentsConfig['log']['routes'][] = array(
         'class'=>'CProfileLogRoute',
        );
    }

    $componentsConfig['log']['routes'][] = array(
        // uncomment the following to show log messages on web pages
        'class'=>'CEmailLogRoute',
        'emails'=>array("developer@email.com"),
        'subject'=>"[ERRORS] APP ".time(),
        'levels'=>'error, warning',
    );
}
*/

if(isset($componentsConfig['urlManager'])) {
    unset($componentsConfig['urlManager']); 
}
$componentsConfig['urlManager']=array(
    'urlFormat' => 'path',
    'showScriptName' => false,
    // 'urlSuffix' => '.html',
    'rules' => $urlDefault,
);

return array(
    'basePath' => $appAlias,
    'theme'=>'flat',
    'language'=>isset($paramsConfig['language'])?$paramsConfig['language']:'en',
    'defaultController'=>$defaultController,
    'modules' => require($appAlias.'/config/modules.php'),
    'extensionPath' => dirname(__FILE__).'/../extensions/',
    'runtimePath' => $appAlias . '/storage/',
    'name' => 'My Application',
    
    // controller map for response all missing request outside on a module
    'controllerMap'=>array(
        'site'=>array(
            'class'=>'core.extensions.actions.SiteController'
        ),
    ),
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
    'components' => $componentsConfig,
    // application-level parameters that can be accessed
    // using r()->params['paramName']
    'params' => $paramsConfig,
);
