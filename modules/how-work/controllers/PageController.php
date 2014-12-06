<?php

class PageController extends FrontController
{
	public $title='How_work';
	public $subTitle='Administrar how_work';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}