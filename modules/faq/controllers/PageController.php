<?php

class PageController extends FrontController
{
	public $title='Faq';
	public $subTitle='Administrar faq';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}