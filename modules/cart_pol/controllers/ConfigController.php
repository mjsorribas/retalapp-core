<?php

class ConfigController extends CmsController
{
	public $title='<i class="fa fa-cogs"></i> Config purcharse';
	public $subTitle='Admin config';
	
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
		$this->title='<i class="fa fa-cogs"></i> '.r('app','Cart').' Config';
	
		// $this->subTitle='Admin CartConfig';
		$model=CartConfig::model()->find();
		if($model===null)
			$model=new CartConfig;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CartConfig']))
		{
			$model->attributes=$_POST['CartConfig'];
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
	 * @param CartConfig $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
