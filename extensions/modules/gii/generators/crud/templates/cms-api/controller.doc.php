<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$module=Yii::app()->getModule('gii');
?>
<?php echo "<?php\n"; ?>
return array(
	array(
		'url'=>'<?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/',
		'method'=>'GET',
		'action'=>'This action retrive all <?php echo $this->modelClass; ?> resources, you can also filter according to sended params.',
		'params'=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
			array(
		    	"name"=>"<?php echo $column->name?>",
		    	"description"=>"<?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type",
		    	"defaultValue"=><?php echo $column->defaultValue===null?'null':$column->defaultValue?>,
<?php if($r=!$column->allowNull && $column->defaultValue===null):?>
				"required"=>false,
<?php else:?>
				"required"=>false,
<?php endif;?>
			),
<?php endforeach;?>
		),
		"success_response"=>array(
		    "status"=> 200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
			array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		    	"<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
				),
			),
		),
		"error_response"=>array(
		    "status"=> 404,
		    "success"=> false,
		    "error"=> "A key (e.g. resource_not_found) for the error",
		    "message"=> "A longer description of the error."
		),
	),
	// ....	
	array(
		'url'=>'<?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a <?php echo $this->modelClass; ?> selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		    "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
			)
		),
		"error_response"=>array(
		    "status"=> 404,
		    "success"=> false,
		    "error"=> "A key (e.g. resource_not_found) for the error",
		    "message"=> "A longer description of the error."
		),
	),
	// ....
	array(
		'url'=>'<?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/update/{id}',
		'method'=>'POST',
		'action'=>'Update a <?php echo $this->modelClass; ?>',
		'params'=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
<?php if($column->name=='id') continue;?>
			array(
		    	"name"=>"<?php echo $column->name?>",
		    	"description"=>"<?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type",
		    	"defaultValue"=><?php echo $column->defaultValue===null?'null':$column->defaultValue?>,
<?php if($r=!$column->allowNull && $column->defaultValue===null):?>
				"required"=>true,
<?php else:?>
				"required"=>false,
<?php endif;?>
			),
<?php endforeach;?>
		),
		"success_response"=>array(
		    "status"=> 200,
			"success"=>"true",
		    "message"=>"Some summary message",
			"data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		    "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
<?php if($column->name=='id') continue;?>
			"<?php echo $column->name?>"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
<?php endforeach;?>
		    ),
		),
	),
	// ....
	array(
		'url'=>'<?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/create',
		'method'=>'POST',
		'action'=>'Create a new <?php echo $this->modelClass; ?>',
		'params'=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
<?php if($column->name=='id') continue;?>
			array(
		    	"name"=>"<?php echo $column->name?>",
		    	"description"=>"<?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type",
		    	"defaultValue"=><?php echo $column->defaultValue===null?'null':$column->defaultValue?>,
<?php if($r=!$column->allowNull && $column->defaultValue===null):?>
				"required"=>true,
<?php else:?>
				"required"=>false,
<?php endif;?>
			),
<?php endforeach;?>
		),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		    "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
<?php if($column->name=='id') continue;?>
			"<?php echo $column->name?>"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
<?php endforeach;?>
		    ),
		),
	),
);