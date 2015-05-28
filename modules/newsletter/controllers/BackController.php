<?php

class BackController extends CmsController
{
	public $title='Newsletter';
	public $subTitle='Administrar newsletter';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}