<?php

class PageController extends FrontController
{
	public $title='Portfolio';
	public $subTitle='Administrar portfolio';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}