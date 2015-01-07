<?php

class Codes_upload_modalController extends CmsController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('delete','view','create','update','order','upload'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		echo CJSON::encode($this->loadModel($id));
		Yii::app()->end();
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		
		$model=new CartSecretCodes;

		if(isset($_POST['CartSecretCodes']))
		{
			$model->attributes=$_POST['CartSecretCodes'];
			$model->cart_upload_id=$_GET['cart_upload_id']; // en curso
			$model->created_at=date('Y-m-d H:i:s');
			if($model->save())
			{
				echo CJSON::encode($model);
				Yii::app()->end();
			}
			$this->validateAjax($model);
		}
	}

	/**
	 * Update a model.
	 * If update is successful, return a json with updated data.
	 */
	public function actionUpdate($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		
		$model=$this->loadModel($id);

		if(isset($_POST['CartSecretCodes']))
		{
			$model->attributes=$_POST['CartSecretCodes'];
			if($model->save())
			{
				echo CJSON::encode($model);
				Yii::app()->end();
			}
			$this->validateAjax($model);
		}
		
		echo CJSON::encode($model);
		Yii::app()->end();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		$model=$this->loadModel($id);
		if($model->delete())
		{
			echo CJSON::encode(array("result"=>1));
			Yii::app()->end();
		} else
			throw new CHttpException(500,"Error al tratar de eliminar este registro, por favor intente más tarde");
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CartSecretCodes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CartSecretCodes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function validateAjax($model)
	{
		if($model->getErrors()!==array() and isset($_POST['ajax']) and $_POST['ajax']==='cart-secret-codes-form')
		{
			$result=array();
			foreach($model->getErrors() as $attribute=>$errors)
				$result[CHtml::activeId($model,$attribute)]=$errors;	
			echo CJSON::encode($result);
			Yii::app()->end();
		}
	}
}
