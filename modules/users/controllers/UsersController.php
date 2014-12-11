<?php

class UsersController extends CmsController
{
	/////////////////////////////
	// This controller is for  //
	// Back actions            //
	/////////////////////////////
	
	public $defaultAction='admin';
	public $title='<i class="fa fa-users"></i> Users';
	public $subTitle='Admin Users';
	
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
				'actions'=>array('admin','roles','assign','delete','update','view','create','order','upload'),
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
	public function actionRoles($id)
	{
		$role=new RoleForm;

		if(isset($_POST["ajax"]) and $_POST["ajax"]==="role-form")
		{
			echo CActiveForm::validate($role);
			Yii::app()->end();
		}

		if(isset($_POST["RoleForm"]))
		{
			$role->attributes=$_POST["RoleForm"];
			if($role->validate())
			{
				Yii::app()->authManager->createRole($role->name,$role->description);
				Yii::app()->authManager->assign($role->name,$id);

				$this->redirect(array("view","id"=>$id));
			}
		}
		$this->render('roles',array(
			'model'=>$this->loadModel($id),
			'role'=>$role,
		));
	}

	
	public function actionAssign($id)
	{
		$result=0;
		if($_POST['action']==="Asignar" and !Yii::app()->authManager->checkAccess($_GET["item"],$id))
			$result=Yii::app()->authManager->assign($_GET["item"],$id);
		else
			$result=Yii::app()->authManager->revoke($_GET["item"],$id);
		
		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				"message"=>$_POST['action']==="Asignar"?"Quitar":"Asignar",
				"btn"=>$_POST['action']==="Asignar"?"btn-primary":"btn-info",
				"result"=>$result,
			));
		}
		else
			$this->redirect(array("view","id"=>$id));
	}

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$role=new RoleForm;
		
		if(isset($_POST["ajax"]) and $_POST["ajax"]==="role-form")
		{
			echo CActiveForm::validate($role);
			Yii::app()->end();
		}

		if(isset($_POST["RoleForm"]))
		{
			$role->attributes=$_POST["RoleForm"];
			if($role->validate())
			{
				Yii::app()->authManager->createRole($role->name,$role->description);
				Yii::app()->authManager->assign($role->name,$id);

				$this->redirect(array("view","id"=>$id));
			}
		}

		$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
		
		$this->{$typeRender}('view',array(
			'model'=>$this->loadModel($id),
			'role'=>$role,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UsersUsers;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['UsersUsers']))
		{
			$model->attributes=$_POST['UsersUsers'];
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

		if(isset($_POST['UsersUsers']))
		{
			$model->attributes=$_POST['UsersUsers'];
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
		$model=$this->loadModel($id);
		$model->trash=1;
		$model->save(true,array('trash'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UsersUsers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UsersUsers']))
			$model->attributes=$_GET['UsersUsers'];

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
	 * @return UsersUsers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UsersUsers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UsersUsers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}