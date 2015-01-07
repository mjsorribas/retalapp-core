<?php

class PurchasesController extends CmsController
{
	/////////////////////////////
	// This controller is for  //
	// Back actions            //
	/////////////////////////////
	
	public $defaultAction='admin';
	public $title='<i class="fa fa-money"></i> Compras';
	public $subTitle='Admin Compras';
	
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
				'actions'=>array('admin','delete','update','view','create','order','upload'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	///////////////////
	// REST actions  //
	///////////////////
	// Put here your rest actions and just response a json

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$this->title=Yii::t('app','Detail of')." ".$model->ref_venta;

		$purchases_detail=new CartShoppingDetail;
		$criteria=new CDbCriteria;
		$criteria->compare('cart_shoping_header_id',$id);

		$purchases_detailDataProvider=new CActiveDataProvider('CartShoppingDetail',array(
		    "criteria"=>$criteria,
		));


		$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
		$this->{$typeRender}('view',array(
		    'model'=>$model,
		    'purchases_detail'=>$purchases_detail,
		    'purchases_detailDataProvider'=>$purchases_detailDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CartShoppingHeader;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CartShoppingHeader']))
		{
			$model->attributes=$_POST['CartShoppingHeader'];
			$model->users_id=Yii::app()->user->id;
			$model->created_at=date('Y-m-d H:i:s');
			$model->updated_at=date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CartShoppingHeader']))
		{
			$model->attributes=$_POST['CartShoppingHeader'];
			$model->users_id=Yii::app()->user->id;
			$model->updated_at=date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CartShoppingHeader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CartShoppingHeader']))
			$model->attributes=$_GET['CartShoppingHeader'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CartShoppingHeader the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CartShoppingHeader::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CartShoppingHeader $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-shopping-header-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}