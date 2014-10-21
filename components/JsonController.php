<?php
require Yii::getPathOfAlias('ext.components.api').'/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class JsonController extends Controller
{
	public function missingAction($actionID)
	{
		$this->routes(new \Slim\Slim(),"/".$this->module->id);
	}
}