<?php

class BackController extends CmsController
{
	public $title='How_work';
	public $subTitle='Administrar how_work';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}