<?php

class BackController extends CmsController
{
	public $title='Location';
	public $subTitle='Administrar location';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}