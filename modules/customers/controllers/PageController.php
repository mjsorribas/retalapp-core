<?php

class PageController extends FrontController
{
	public $title='Customers';
	public $subTitle='Administrar customers';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}