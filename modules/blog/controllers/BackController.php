<?php

class BackController extends CmsController
{
	public $title='Blog';
	public $subTitle='Administrar blog';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}