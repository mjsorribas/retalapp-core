<?php

class PageController extends FrontController
{
	public $title='Contact';
	public $subTitle='Administrar contact';
	
	public function actionIndex()
	{
		$this->render('index');
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
			$subject='Nuevo Contacto ' . strip_tags(Yii::app()->name);
			#$targetEmail=YII_DEBUG?Yii::app()->params['adminEmail']:$config->email;
 			#if(empty($config->email))
				$targetEmail=Yii::app()->params['adminEmail'];
			
			$body="<strong>Name</strong>: <em>{$model->name}</em> <br>";
			$body.="<strong>Email</strong>: <em>{$model->email}</em> <br>";
			$body.="<strong>Comment</strong>: <em>{$model->message}</em> <br>";
            
            r('email')->fromEmail=$model->email;
            r('email')->fromName=$model->name;
            r('email')->add($targetEmail, strip_tags(Yii::app()->name));
            r('email')->sendBody($subject, $body);
            
            echo CJSON::encode(array('success'=>1,'data'=>$model));
        } else {
			echo CJSON::encode(array('success'=>0,'data'=>$model->getErrors()));
        }
	}
}