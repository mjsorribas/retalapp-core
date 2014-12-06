<?php

class BackController extends CmsController
{
	public $title='Price';
	public $subTitle='Administrar price';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}