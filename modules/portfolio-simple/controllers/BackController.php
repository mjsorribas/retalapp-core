<?php

class BackController extends CmsController
{
	public $title='Portfolio';
	public $subTitle='Administrar portfolio';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}