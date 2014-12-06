<?php

class BackController extends CmsController
{
	public $title='Customers';
	public $subTitle='Administrar customers';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}