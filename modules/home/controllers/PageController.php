<?php

class PageController extends FrontController
{
	public $title='Home';
	public $subTitle='Administrar home';
	
	public function actionIndex()
	{
		$slider=HomeSlider::model()->findAll(array('order'=>'orden_id'));
		$recent=HomeRecentPost::model()->findAll(array('order'=>'orden_id','limit'=>2));
		$intro=HomeIntro::model()->find();
		$items=HomeItems::model()->findAll(array('order'=>'orden_id'));
		$clients=ClientsItems::model()->findAll(array('order'=>'orden_id'));
		$work=PortfolioItems::model()->findAll(array('order'=>'orden_id','limit'=>3));

		$this->render('index',array(
			'slider'=>$slider,
			'recent'=>$recent,
			'intro'=>$intro,
			'items'=>$items,
			'clients'=>$clients,
			'work'=>$work,
		));
	}
}