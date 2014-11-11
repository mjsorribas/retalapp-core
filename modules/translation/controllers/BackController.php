<?php

class BackController extends CmsController
{
	public $title='Translation';
	public $subTitle='Administrar translation';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}