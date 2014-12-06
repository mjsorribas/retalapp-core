<?php

class BackController extends CmsController
{
	public $title='Home';
	public $subTitle='Administrar home';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}