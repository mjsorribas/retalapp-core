<?php

// you need to change this for your timezone
// date_default_timezone_set("America/Bogota"); 

// change the following paths if necessary
$framework=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/config/main.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($framework);

Yii::setPathOfAlias('app',dirname(__FILE__).'/../../../app');
Yii::setPathOfAlias('vendor',dirname(__FILE__).'/../../../vendor');
Yii::setPathOfAlias('core',dirname(__FILE__));
if(true) {
	require_once(Yii::getPathOfAlias('core').'/install/retalapp-install-setup.php');
}

function r($module=null,$message=null,$params=array()) {
	
	if($module===null)
		return Yii::app();
	
	if($module!==null and $message!==null)
		return Yii::t($module,$message,$params);

	if(stripos($module, '#')!==false)
		return Yii::app()->getComponent(substr($module, 1));

	return Yii::app()->getModule($module);
}

Yii::createWebApplication($config)->run();
