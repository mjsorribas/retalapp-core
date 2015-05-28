<?php

class PageController extends FrontController
{
	public $title='Newsletter';
	public $subTitle='Administrar newsletter';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}