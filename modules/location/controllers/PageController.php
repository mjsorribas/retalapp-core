<?php

class PageController extends FrontController
{
	public $title='Location';
	public $subTitle='Administrar location';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}