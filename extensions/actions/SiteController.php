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

				$json=false;
				$route=r()->request->getPathInfo();
				if(substr($route, -5)==='.json') {
					$route=strtr($route,array('.json'=>''));
					$json=true;
				}

				$urls = explode('/', $route);
				$modelUrls=array();
				foreach($urls as $url) {
					$modelUrls[]=HomeResources::model()->find('url=?',array($url));
				}
				$lastModel=end($modelUrls);


				// if(($lastModel!==null and $lastModel->home_visibility_id==1) or ($lastModel!==null and $lastModel->home_visibility_id==2 and !r()->user->isGuest)) {
				if($lastModel!==null) {

					// if(($lastModel!==null and $lastModel->home_visibility_id==1) or ($lastModel!==null and $lastModel->home_visibility_id==2 and !r()->user->isGuest)) {
					// if(file_exists(r()->theme->basePath.'/'.$lastModel->template->view_template)) {
					// 	$this->render($lastModel->template->view_template,array(
					// 		'model'=>$lastModel,
					// 	));
					// } else {
						if($lastModel->published!=1) {
							$this->render('unpublished',array(
								'model'=>$lastModel,
								// 'content'=>$lastModel->content_raw,
							));
							r()->end();
						}
						if($lastModel->home_visibility_id==2 and !r()->user->isGuest) {
							$this->render('private',array(
								'model'=>$lastModel,
								// 'content'=>$lastModel->content_raw,
							));
							r()->end();
						}
						if($lastModel->home_visibility_id==3) {
							$this->render('key_access',array(
								'model'=>$lastModel,
								// 'content'=>$lastModel->content_raw,
							));
							r()->end();
						}

						if($json) {
							header('content-type:application/json');
							echo $lastModel->getCompiledHtml(true);
						} else {
							$this->render('default',array(
								'content'=>$lastModel->getCompiledHtml(),
							));
						}
					// }
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