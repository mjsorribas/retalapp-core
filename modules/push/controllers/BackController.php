<?php

class BackController extends CmsController
{
	public $title='Push';
	public $subTitle='Administrar push';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}