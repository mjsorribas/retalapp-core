<?php

class PageController extends FrontController
{
	public $title='Equipo';
	public $subTitle='Administrar equipo';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}