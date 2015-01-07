<?php

class UploadController extends CmsController
{
	/////////////////////////////
	// This controller is for  //
	// Back actions            //
	/////////////////////////////
	
	public $defaultAction='admin';
	public $title='<i class="fa fa-cloud-upload"></i> Upload Codes';
	public $subTitle='Admin Upload Codes';
	
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
				'actions'=>array('admin','delete','create','order','upload','excelToUpload','csvToUpload','view'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$errors=array();
		$model=new CartUpload;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CartUpload']))
		{
			$model->attributes=$_POST['CartUpload'];
			$model->created_at=date('Y-m-d H:i:s');
			$model->users_users_id=Yii::app()->user->id;
			if($model->save()) 
			{
				$pices=explode('.', $model->file);
				$extension = end($pices);
				if($extension==='xls' or $extension==='xlsx')
					$errors=$this->excelUploadAndUpdate($model);
				if($extension==='csv')
					$errors=$this->csvUploadAndUpdate($model,';'); //";" for windows or "," for mac or linux
				if($extension==='tsv')
					$errors=$this->csvUploadAndUpdate($model,'	');
				if($errors===array())
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'errors'=>$errors,
			'modelToUpload'=>new CartSecretCodes,
		));

	}

	public function csvUploadAndUpdate($model, $separator=";")
	{
		$errors=array();
		$fp = fopen(Yii::getPathOfAlias('webroot') . "/uploads/" . $model->file, 'r');
		if($fp)
		{
			$transaction = Yii::app()->db->beginTransaction();
			$row=0;
			while(($line=fgetcsv($fp,1000,$separator))!=false)
			{
				#if($row===0)
            	#{
            		//$header1=$line[0];
        			//if($header1!=='FIRST_NAME')
					//	return false;
					//$header2=$line[1];
					//if($header2!=='LAST_NAME')
					//	return false;
					//$header3=$line[2];
					//if($header3!=='PHONE_NUMBER')
					//	return false;
				#}
            	#else
            	#{
            		// This is for update
					// $data = CartSecretCodes::model()->findByPk($id);
            		// This is for create
					$data = new CartSecretCodes;
					$data->secret_code=$line[0];
					$data->created_at=date('Y-m-d H:i:s');
					$data->state=1;
					$data->cart_upload_id=$model->id;
					if(!$data->save())
						$errors[$row]=$data->getErrors();
            	#}
            	$row++;
			}
			 
			fclose($fp);
			
			if($errors===array())
			{
				$transaction->commit();
				return $errors;
			}
			else
			{
        		$transaction->rollBack();
				return $errors;
			}
		}
		else
			throw new CHttpException(500,r('app','Could not open the file, please try again'));
	}

	public function excelUploadAndUpdate($model)
	{
		$errors=array();
		if(file_exists(Yii::getPathOfAlias("webroot.uploads")."/".$model->file))
		{
			$transaction = Yii::app()->db->beginTransaction();

			$excelSheet = Yii::app()->excel->load(@Yii::getPathOfAlias("webroot.uploads")."/".$model->file)->getActiveSheet();
            for($row = 1; $row <= $excelSheet->getHighestRow(); $row++)
            {
            	if($row===1)
            	{
            		//$header1=$this->trim($excelSheet->getCellByColumnAndRow(0, $row)->getValue());
        			//if($header1!=='FIRST_NAME')
					//	return false;
					//$header2=$this->trim($excelSheet->getCellByColumnAndRow(1, $row)->getValue());
					//if($header2!=='LAST_NAME')
					//	return false;
					//$header3=$this->trim($excelSheet->getCellByColumnAndRow(2, $row)->getValue());
					//if($header3!=='PHONE_NUMBER')
						return false;
				}
            	else
            	{
            		// This is for update
					// $data = CartSecretCodes::model()->findByPk($id);
            		// This is for create
					$data = new CartSecretCodes;
					//$data->first_name=$this->trim($excelSheet->getCellByColumnAndRow(0, $row)->getValue());
					//$data->last_name=$this->trim($excelSheet->getCellByColumnAndRow(1, $row)->getValue());
					//$data->phone_number=$this->trim($excelSheet->getCellByColumnAndRow(2, $row)->getValue());
					if(!$data->save())
						$errors[$row]=$data->getErrors();
            	}
			}
						
			if($errors===array())
			{
				$transaction->commit();
				return $errors;
			}
			else
			{
        		$transaction->rollBack();
				return $errors;
			}
		}
		else
			throw new CHttpException(500,r('app','Could not open the file, please try again'));
	}
	
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$this->render("view",array(
			"model"=>$model
		));
	}
	
	public function trim($value='',$int=false)
	{
		$value=trim($value);
		if($value=="")
			return null;
		if($int)
		{
			$value=strtr($value,array(
				"%"=>"","$"=>"","?"=>"","*"=>"","+"=>""
			));
			$value=(int)$value;
			if($value<0)
				$value=$value*10;
			return $value;
		}
		return $value;
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
		$model=new CartUpload('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CartUpload']))
			$model->attributes=$_GET['CartUpload'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	

	/**
	 * Manages all models.
	 */
	public function actionExcelToUpload()
	{
		$model=new CartSecretCodes('search');
		$model->unsetAttributes();  // clear any default values

		// set attributes to filter
		// $model->attribute1=1

		$content=$this->renderPartial('_excel_to_upload',array(
			'model'=>$model,
		),true);
		r()->request->sendFile('example_to_upload.xls',$content);
	}

	/**
	 * Manages all models.
	 */
	public function actionCsvToUpload()
	{
		$model=new CartSecretCodes('search');
		$model->unsetAttributes();  // clear any default values

		// set attributes to filter
		// $model->attribute1=1

		$content=$this->renderPartial('_csv_to_upload',array(
			'model'=>$model,
		),true);
		r()->request->sendFile('example_to_upload.csv',$content);
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CartUpload the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CartUpload::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CartUpload $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-upload-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload()
    {
    	$uploader=Yii::createComponent('ext.inputs.uploader.GComponentUpload');
		$uploader->upload(array('xls','xlsx','csv','tsv'),30 * 1024 * 1024);
	}
}