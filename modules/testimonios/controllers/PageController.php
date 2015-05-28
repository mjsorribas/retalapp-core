<?php

class PageController extends FrontController
{
	public $title='Testimonios';
	public $subTitle='Administrar testimonios';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}