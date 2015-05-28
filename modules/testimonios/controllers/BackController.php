<?php

class BackController extends CmsController
{
	public $title='Testimonios';
	public $subTitle='Administrar testimonios';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}