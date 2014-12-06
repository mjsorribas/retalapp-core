<?php

class PageController extends FrontController
{
	public $title='Team';
	public $subTitle='Administrar team';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}