<?php

class BackController extends CmsController
{
	public $title='Faq';
	public $subTitle='Administrar faq';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}