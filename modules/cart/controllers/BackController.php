<?php

class BackController extends CmsController
{
	public $title='Cart';
	public $subTitle='Administrar cart';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}