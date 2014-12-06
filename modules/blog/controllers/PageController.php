<?php

class PageController extends FrontController
{
	public $title='Blog';
	public $subTitle='Administrar blog';
	
	public function actionIndex()
	{
		$posts=BlogPosts::model()->findAll(array('order'=>'orden_id','limit'=>'5'));
		$this->render('index',array(
			'posts'=>$posts,
		));
	}

	public function actionDetail($id)
	{
		$model=BlogPosts::model()->findByPk($id);
		$this->render('detail',array(
			'model'=>$model
		));
	}
}