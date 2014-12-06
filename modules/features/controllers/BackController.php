<?php

class BackController extends CmsController
{
	public $title='Features';
	public $subTitle='Administrar features';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}