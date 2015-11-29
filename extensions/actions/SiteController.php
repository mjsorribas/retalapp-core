<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		throw new CHttpException(404,"You need to have and module for default, please configure this on app/config/app.php 'defaultModule' parameter");
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		Yii::app()->theme=$this->themeFront;
		if($error=Yii::app()->errorHandler->error)
		{
			if($error['code']==404) {

				$route=r()->request->getPathInfo();
				$home_resources=HomeResources::model()->find('url=? AND published=1 AND published_at <= NOW()',array($route));
				// echo CJSON::encode($route);
				// exit;
				if($home_resources!==null) {
				// if(($home_resources!==null and $home_resources->home_visibility_id==1) or ($home_resources!==null and $home_resources->home_visibility_id==2 and !r()->user->isGuest)) {
					if(file_exists(r()->theme->basePath.'/'.$home_resources->template->view_template)) {
						$this->render($home_resources->template->view_template,array(
							'model'=>$home_resources,
						));
					} else {
						$this->render('index',array(
							'model'=>$home_resources,
						));
					}
					r()->end();
				}
			}
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}