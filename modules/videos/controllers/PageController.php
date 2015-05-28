<?php

class PageController extends FrontController
{
	public $title='Videos';
	public $subTitle='Administrar videos';
	
	public function actionIndex()
	{
		$videos_videos=VideosVideos::model()->findAll(array('order'=>'orden_id'));
		$this->render('index',array(
			'videos_videos'=>$videos_videos,
		));
	}
}