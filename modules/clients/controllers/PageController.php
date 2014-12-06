<?php

class PageController extends FrontController
{
	public $title='Clients';
	public $subTitle='Administrar clients';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}