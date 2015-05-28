<?php

class BackController extends CmsController
{
	public $title='Shopping';
	public $subTitle='Administrar shopping';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}