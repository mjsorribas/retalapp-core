<?php

class BackController extends CmsController
{
	public $title='Team';
	public $subTitle='Administrar team';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}