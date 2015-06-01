<?php

class PageController extends FrontController
{
	public $title='Landing';
	public $subTitle='Administrar landing';
	
	public function actionIndex()
	{
		$this->layout='//layouts/landing';
		$model=LandingPages::model()->find(array(
			'order'=>'orden_id'
		));
		$this->render('index',array(
			'model'=>$model
		));
	}
}