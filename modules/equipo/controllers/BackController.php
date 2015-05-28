<?php

class BackController extends CmsController
{
	public $title='Equipo';
	public $subTitle='Administrar equipo';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}