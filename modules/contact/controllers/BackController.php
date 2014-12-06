<?php

class BackController extends CmsController
{
	public $title='Contact';
	public $subTitle='Administrar contact';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}