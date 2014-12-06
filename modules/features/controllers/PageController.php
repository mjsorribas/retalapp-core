<?php

class PageController extends FrontController
{
	public $title='Features';
	public $subTitle='Administrar features';
	
	public function actionIndex()
	{
		$model=FeaturesItems::model()->findAll(array('order'=>'orden_id'));
		$this->render('index',array(
			'model'=>$model
		));
	}
}