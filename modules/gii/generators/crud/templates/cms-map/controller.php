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
	
	public $defaultAction='index';
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
				'actions'=>array('index'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];
			// Nombres de filtros que llegan desde
			// el formulario de búsqueda
		}
		
		$list=<?php echo $this->modelClass; ?>::model()->findAll($model->search()->getCriteria());
		// $list=<?php echo $this->modelClass; ?>::model()->findAll($model->searchMap()->getCriteria());
		
		$models = array();
		foreach($list as $data)
		{
			$attr=$data->attributes;
		    $attr['color']='cccccc';
<?php 
foreach($this->tableSchema->columns as $column)
{
		if(strpos($column->name, "_lat")!==false)
			echo "\t\t\t\$attr['lat']=\$data->".$column->name.";\n";
		if(strpos($column->name, "_lng")!==false)
			echo "\t\t\t\$attr['lng']=\$data->".$column->name.";\n";
}
?>
		    // $attr['description_service']=$data->getDescriptionPin();
		    $attr['content_event']="
			<div class=\"row row-map\">
				<div class=\"col-xs-5\">
					<img src=\"img/map-img.jpg\">
				</div>
				<div class=\"col-xs-7\">
					<p><strong>Nombre: </strong> Lorem ipsum dolor</p>
					<p><strong>Dirección: </strong> Lorem ipsum dolor</p>
					<p><strong>Teléfono: </strong> (+571) 123 4567</p>
					<p><strong>Correo: </strong><a href=\"mailto:#\">info@email.com</a></p>
				</div>
			</div>
		    ";
		    
		    $models[] = $attr;
		}
		$typeRender='render';
		if(Yii::app()->request->isAjaxRequest)
			$typeRender='renderPartial';
		
		$this->{$typeRender}('index',array(
			'models'=>$models,
			'model'=>$model,
		));
	}

}