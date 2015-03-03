<?php

class PageController extends FrontController
{
	public $title='Push';
	public $subTitle='Administrar push';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}