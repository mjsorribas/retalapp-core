<?php

class BackController extends CmsController
{
	public $title='Users';
	public $subTitle='Administrar users';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}