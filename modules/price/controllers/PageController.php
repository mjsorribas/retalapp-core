<?php

class PageController extends FrontController
{
	public $title='Price';
	public $subTitle='Administrar price';
	
	public function actionIndex()
	{
		$model=PriceItems::model()->findAll(array('order'=>'orden_id'));
		$this->render('index',array(
			'model'=>$model
		));
	}
}