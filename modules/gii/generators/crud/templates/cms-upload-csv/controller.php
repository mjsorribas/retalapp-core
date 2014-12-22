<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends CmsController
{
	/////////////////////////////
	// This controller is for  //
	// Back actions            //
	/////////////////////////////
	
	public $defaultAction='admin';
<?php if($this->fontIcon!==null):?>
	public $title='<i class="fa <?php echo $this->fontIcon?>"></i> <?php echo $this->labelName; ?>';
<?php else:?>
	public $title='<?php echo $this->labelName; ?>';
<?php endif;?>
	public $subTitle='Admin <?php echo $this->labelName; ?>';
	
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
		$model=new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
<?php 
foreach($this->tableSchema->columns as $column)
{
	if($column->name=='orden_id')
	{
		echo "\t\t\t\$last=".$this->modelClass."::model()->findAll();\n";
		echo "\t\t\t\$model->orden_id=count(\$last)+1;\n";
	}
	if($column->name=='updated_at')
		echo "\t\t\t\$model->updated_at=date('Y-m-d H:i:s');\n";
	if($column->name=='created_at')
		echo "\t\t\t\$model->created_at=date('Y-m-d H:i:s');\n";
	if($column->name=='users_id' or $column->name=='users_users_id' or $column->name=='user_id')
		echo "\t\t\t\$model->".$column->name."=Yii::app()->user->id;\n";
	if(stripos($column->name, "money_")!==false)
		echo "\t\t\t\$model->".$column->name."=strtr(\$model->".$column->name.",array(\",\"=>\"\"));\n";

}
?>
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
					$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'errors'=>$errors,
			'modelToUpload'=>new <?php echo $this->foraneKey?>,
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
				if($row===0)
            	{
            		//$header1=$line[0];
        			//if($header1!=='FIRST_NAME')
					//	return false;
					//$header2=$line[1];
					//if($header2!=='LAST_NAME')
					//	return false;
					//$header3=$line[2];
					//if($header3!=='PHONE_NUMBER')
					//	return false;
				}
            	else
            	{
            		// This is for update
					// $data = <?php echo $this->foraneKey?>::model()->findByPk($id);
            		// This is for create
					$data = new <?php echo $this->foraneKey?>;
					//$data->first_name=$line[0];
					//$data->last_name=$line[1];
					//$data->phone_number=$line[2];
					if(!$data->save())
						$errors[$row]=$data->getErrors();
            	}
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
					// $data = <?php echo $this->foraneKey?>::model()->findByPk($id);
            		// This is for create
					$data = new <?php echo $this->foraneKey?>;
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
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

<?php foreach($this->tableSchema->columns as $column):?>
<?php if($column->name=='orden_id'):?>
	/**
	 * Manages all models.
	 */
	public function actionOrder()
	{
		if(!isset($_POST['order']))
			throw new CHttpException(403,"Petición inválida");
			
		$orden = $_POST['order'];
        $cant = count($orden);
        $id = array();
        $pos = array();
        for($i = 0 ; $i < $cant ; $i++){
            $data = explode('-', $orden[$i]);
            $pos[$i] = $data[0];
            $id[$i] = $data[1];
        }        
        $ini = min($pos);         
        for($i = 0 ; $i < $cant ; $i++){
            $datos = array(
                'orden_id' => $ini,
                'id' => $id[$i]
            );
	        $ini = $ini + 1 ;
	        $model=<?php echo $this->modelClass; ?>::model()->findByPk($datos['id']);
	        $model->orden_id=$ini; // la tabla debe tener orden_id
	        $model->save(true,array('orden_id'));
	    }
	}
<?php endif;?>
<?php endforeach;?>
	

	/**
	 * Manages all models.
	 */
	public function actionExcelToUpload()
	{
		$model=new <?php echo $this->foraneKey?>('search');
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
		$model=new <?php echo $this->foraneKey?>('search');
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
	 * @return <?php echo $this->modelClass; ?> the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param <?php echo $this->modelClass; ?> $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
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