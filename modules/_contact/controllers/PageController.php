<?php

class PageController extends FrontController
{
	public $title='Contact';
	public $subTitle='Administrar contact';
	
	public function actionIndex()
	{
		$contact=ContactInfo::model()->find();
		$this->render('index',array(
			'contact'=>$contact,
		));
	}

	
	public function actionContactJson()
	{
        #$config=$this->module->getInfo();
        $model=new ContactMessages;
		$model->attributes = $_REQUEST;
		$model->read = 0;
		$model->created_at = date('Y-m-d H:i:s');
        if ($model->save())
        {
			$subject=r('contact','New contact message').' '.strip_tags(Yii::app()->name);
			#$targetEmail=YII_DEBUG?Yii::app()->params['adminEmail']:$config->email;
 			#if(empty($config->email))
				$targetEmail=Yii::app()->params['adminEmail'];
			
			$body="<strong>Name</strong>: <em>{$model->name}</em> <br>";
			if(!empty($model->phone))
				$body.="<strong>Phone</strong>: <em>{$model->phone}</em> <br>";
			$body.="<strong>Email</strong>: <em>{$model->email}</em> <br>";
			$body.="<strong>Comment</strong>: <em>{$model->message}</em> <br>";
            
            r('email')->fromEmail=$model->email;
            r('email')->fromName=$model->name;
            r('email')->add($targetEmail, strip_tags(Yii::app()->name));
            r('email')->sendBody($subject, $body);
            
            echo CJSON::encode(array('success'=>1,'data'=>$model,'message'=>r('contact','Thanks for contacting us, message sent')));
        } else {
			echo CJSON::encode(array('success'=>0,'data'=>$model->getErrors()));
        }
	}
	
	public function actionNewsJson()
	{
        #$config=$this->module->getInfo();
        $model=new ContactNews;
		$model->attributes = $_REQUEST;
		$model->created_at = date('Y-m-d H:i:s');
        if ($model->save())
        {
		    echo CJSON::encode(array('success'=>1,'data'=>$model,'message'=>r('contact','Thanks for contacting us, message sent')));
        } else {
			echo CJSON::encode(array('success'=>0,'data'=>$model->getErrors()));
        }
	}
}