<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends FrontController
{
	/////////////////////////////
	// This controller is for  //
	// Front actions            //
	/////////////////////////////
	
	public $defaultAction='index';

	
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
				'actions'=>array('delete','update','view','create','createAjax','order','upload','list'),
				'roles'=>$this->module->getAllowPermissoms(false),
			),
			array('deny', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','update','view','create','createAjax','order','upload','list'),
				'users'=>array('*'),
			),
			array('allow',  // deny all users
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria; 
		if(isset($_GET['search']) and $_GET['search']!=="")
		{
			$criteria->compare('id',$_GET['search'],true,'OR');
			//$criteria->compare('description',$_GET['search'],true,'OR');
			//$criteria->compare('year',$_GET['search'],false,'OR');
		}

		$dataProvider=new CActiveDataProvider('<?php echo $this->modelClass; ?>',array('criteria'=>$criteria));

		$typeRender='render';
		if(r()->request->isAjaxRequest)
			$typeRender='renderPartial';

		$this->{$typeRender}('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all items through Infinite scroll.
	 */
	public function actionList()
	{
		$criteria=new CDbCriteria; 
		if(isset($_GET['search']) and $_GET['search']!=="")
		{
			$criteria->compare('id',$_GET['search'],true,'OR');
			//$criteria->compare('description',$_GET['search'],true,'OR');
			//$criteria->compare('year',$_GET['search'],false,'OR');
		}
        // $criteria->order='orden_id';
        
        $total = <?php echo $this->modelClass; ?>::model()->count();

        $pages = new CPagination($total);
        $pages->pageSize = 6;
        $pages->applyLimit($criteria);

        $model = <?php echo $this->modelClass; ?>::model()->findAll($criteria);

		$typeRender='render';
		if(r()->request->isAjaxRequest)
			$typeRender='renderPartial';
		
		$this->{$typeRender}('list',array(
			'model' => $model,
            'pages' => $pages,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
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
		echo "\t\t\t// In oreder to create chronologically asc \n";
		echo "\t\t\t//\$last=".$this->modelClass."::model()->findAll();\n";
		echo "\t\t\t//\$model->orden_id=count(\$last)+1;\n";
		echo "\t\t\t// In oreder to create chronologically desc \n";
		echo "\t\t\t\$last=".$this->modelClass."::model()->findAll(array('order'=>'orden_id'));\n";
		echo "\t\t\t\$i=2;\n";
		echo "\t\t\tforeach(\$last as \$data)\n";
		echo "\t\t\t{\n";
		echo "\t\t\t\t\$data->orden_id=\$i++;\n";
		echo "\t\t\t\t\$data->save(true,array('orden_id'));\n";
		echo "\t\t\t}\n";
		echo "\t\t\t\$model->orden_id=1;\n";
	}
	if($column->name=='updated_at')
		echo "\t\t\t\$model->updated_at=date('Y-m-d H:i:s');\n";
	if($column->name=='created_at')
		echo "\t\t\t\$model->created_at=date('Y-m-d H:i:s');\n";
}
?>
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


    /**
	 * Creates a new model through ajax.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *	 
	 *  $(document).on('submit','#<?php echo $this->class2id($this->modelClass); ?>-form',function(e) {
	 *    e.preventDefault();
	 *    var $form = $(this);
	 *    $.ajax({
	 *        url: '<?php echo "<?php echo \$this->createUrl(\"createAjax\");?>"?>',
	 *        dataType: 'json', 
	 *        type: 'post',
	 *        data: $form.serialize(),
	 *        success: function (data){
	 *
	 *          console.log(data);
	 *
	 *          $.each($form.serializeArray(), function(index, name) {
	 *            $('[name='+name.name+']')
	 *              .parent()
	 *              .find('#validate-'+name.name)
	 *              .remove();
	 *          });
	 *
	 *          if(data.success) {
	 *            // here submit 
	 *            alert(data.message);
	 *
	 *          } else {
	 *
	 *            $.each(data.data, function(name, errors) {
	 *              $('[name='+name+']')
	 *              .parent()
	 *              .append($('<p id="validate-'+name+'" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
	 *            });
	 *          }
	 *        }
	 *    });
	 *  });
	 *
	*/
	public function actionCreateAjax()
	{

        $model=new <?php echo $this->modelClass; ?>;
		$model->attributes = $_REQUEST;
<?php 
foreach($this->tableSchema->columns as $column)
{
	if($column->name=='orden_id')
	{
		echo "\t\t\t// In oreder to create chronologically asc \n";
		echo "\t\t\t//\$last=".$this->modelClass."::model()->findAll();\n";
		echo "\t\t\t//\$model->orden_id=count(\$last)+1;\n";
		echo "\t\t\t// In oreder to create chronologically desc \n";
		echo "\t\t\t\$last=".$this->modelClass."::model()->findAll(array('order'=>'orden_id'));\n";
		echo "\t\t\t\$i=2;\n";
		echo "\t\t\tforeach(\$last as \$data)\n";
		echo "\t\t\t{\n";
		echo "\t\t\t\t\$data->orden_id=\$i++;\n";
		echo "\t\t\t\t\$data->save(true,array('orden_id'));\n";
		echo "\t\t\t}\n";
		echo "\t\t\t\$model->orden_id=1;\n";
	}
	if($column->name=='updated_at')
		echo "\t\t\t\$model->updated_at=date('Y-m-d H:i:s');\n";
	if($column->name=='created_at')
		echo "\t\t\t\$model->created_at=date('Y-m-d H:i:s');\n";
}
?>
        if ($model->save()) { 
        	echo CJSON::encode(array('success'=>1,'data'=>$model,'message'=>r('app','Record created!')));
        } else {
			echo CJSON::encode(array('success'=>0,'data'=>$model->getErrors()));
        }
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

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
<?php 
foreach($this->tableSchema->columns as $column)
{
	if($column->name=='updated_at')
		echo "\t\t\t\$model->updated_at=date('Y-m-d H:i:s');\n";
	if($column->name=='users_id')
		echo "\t\t\t\$model->users_id=Yii::app()->user->id;\n";
	if($column->name=='user_id')
		echo "\t\t\t\$model->user_id=Yii::app()->user->id;\n";
}
?>

			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPdf($id)
	{
		$model=$this->loadModel($id);
		$content=$this->renderPartial('view',array(
			'model'=>$model,
		),true);

		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
	    // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('<?php echo $this->modelClass; ?>.pdf');
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
}