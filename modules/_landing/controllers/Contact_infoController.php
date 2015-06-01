<?php

class Contact_infoController extends CmsController
{
	public $defaultAction='index';
	public $title='<i class="fa fa-share-alt"></i> Contact info';
	public $subTitle='Admin Contact info';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','upload'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionIndex()
	{
		$this->title='<i class="fa fa-share-alt"></i> '.Yii::t('app','Contact info');
		$this->subTitle='Admin '.Yii::t('app','Contact info');
		
		$model=LandingContactInfo::model()->find();
		if($model===null)
			$model=new LandingContactInfo;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['LandingContactInfo']))
		{
			$model->attributes=$_POST['LandingContactInfo'];
			if($model->save())
	        {
            	Yii::app()->user->setFlash('success',Yii::t('app','The record was saved successfully'));
                $this->refresh();
            }
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Performs the AJAX validation.
	 * @param LandingContactInfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='landing-contact-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
