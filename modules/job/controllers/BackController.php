<?php

class BackController extends CmsController
{
	public $title='Job';
	public $subTitle='Administrar job';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}