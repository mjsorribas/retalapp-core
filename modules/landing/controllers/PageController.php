<?php

class PageController extends FrontController
{
	public $title='Landing';
	public $subTitle='Administrar landing';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}