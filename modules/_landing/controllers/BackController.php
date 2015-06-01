<?php

class BackController extends CmsController
{
	public $title='Landing';
	public $subTitle='Administrar landing';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}