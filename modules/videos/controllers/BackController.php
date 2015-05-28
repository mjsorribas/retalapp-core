<?php

class BackController extends CmsController
{
	public $title='Videos';
	public $subTitle='Administrar videos';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}