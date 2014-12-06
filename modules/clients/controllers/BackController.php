<?php

class BackController extends CmsController
{
	public $title='Clients';
	public $subTitle='Administrar clients';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}