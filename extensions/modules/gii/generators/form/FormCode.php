<?php

class FormCode extends CCodeModel
{
	public $model;
	public $viewPath='application.views';
	public $viewName;
	public $scenario;
	public $moduleName;

	private $_modelClass;

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('model, viewName, scenario', 'filter', 'filter'=>'trim'),
			array('model, viewName, viewPath, moduleName', 'required'),
			array('model, viewPath', 'match', 'pattern'=>'/^\w+[\.\w+]*$/', 'message'=>'{attribute} should only contain word characters and dots.'),
			array('viewName', 'match', 'pattern'=>'/^\w+[\\/\w+]*$/', 'message'=>'{attribute} should only contain word characters and slashes.'),
			array('model', 'validateModel'),
			array('viewPath', 'validateViewPath'),
			array('scenario', 'match', 'pattern'=>'/^\w+$/', 'message'=>'{attribute} should only contain word characters.'),
			array('viewPath', 'sticky'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'model'=>'Model Class',
			'viewName'=>'View Name',
			'viewPath'=>'View Path',
			'scenario'=>'Scenario',
		));
	}

	public function requiredTemplates()
	{
		return array(
			'form.php',
			'action.php',
		);
	}

	public function successMessage()
	{
		$output=<<<EOD
<p>The form has been generated successfully.</p>
<p>You may add the following code in an appropriate controller class to invoke the view:</p>
EOD;
		$code="<?php\n".$this->render($this->templatePath.'/action.php');
		return $output.highlight_string($code,true);
	}

	public function validateModel($attribute,$params)
	{
		if($this->hasErrors('model'))
			return;
		$class=@Yii::import($this->model,true);
		if(!is_string($class) || !$this->classExists($class))
			$this->addError('model', "Class '{$this->model}' does not exist or has syntax error.");
		elseif(!is_subclass_of($class,'CModel'))
			$this->addError('model', "'{$this->model}' must extend from CModel.");
		else
			$this->_modelClass=$class;
	}

	public function validateViewPath($attribute,$params)
	{
		if($this->hasErrors('viewPath'))
			return;
		if(Yii::getPathOfAlias($this->viewPath)===false)
			$this->addError('viewPath','View Path must be a valid path alias.');
	}

	public function prepare()
	{
		$templatePath=$this->templatePath;
		$this->files[]=new CCodeFile(
			Yii::getPathOfAlias($this->viewPath).'/'.$this->viewName.'.php',
			$this->render($templatePath.'/form.php')
		);
	}

	public function getModelClass()
	{
		return $this->_modelClass;
	}

	public function getModelAttributes()
	{
		$model=new $this->_modelClass($this->scenario);
		return $model->getSafeAttributeNames();
	}


	public function generateActiveField($modelClass,$attribute)
	{
		$size=null;

		// if()
		// 	$size=
		
		if(stripos($attribute,'on_')!==false)
			return "\$form->checkBox(\$model,'{$attribute}')";
		elseif(stripos($attribute,'date_')!==false)
			return $this->textFieldWidget("date",$attribute);
		elseif(stripos($attribute,'map_')!==false)
			return $this->textFieldWidget("map",$attribute);
		elseif(stripos($attribute,'img_')!==false)
			return $this->textFieldWidget("img",$attribute);
		elseif(stripos($attribute,'area_')!==false)
		{
			if($size===null)
				return "\$form->textArea(\$model,'{$attribute}',array('class'=>'form-control'))";
			return $this->textFieldWidget("textArea",$attribute,$size);
		}
		elseif(stripos($attribute,'text_')!==false)
		{
			if($size===null)
				return "\$form->textField(\$model,'{$attribute}',array('class'=>'form-control'))";
			return $this->textFieldWidget("textField",$attribute,$size);
		}
		else
		{
			// if(preg_match('/^(password|pass|passwd|passcode)$/i',$attribute))
			if(strpos($attribute, 'pass_')!==false)
				$inputField='passwordField';
			else
				$inputField='textField';

			if($size===null)
				return "\$form->{$inputField}(\$model,'{$attribute}',array('class'=>'form-control'))";
			else
				return $this->textFieldWidget($inputField,$attribute,$size);
		}
	}

	public function textFieldWidget($inputField,$name,$size=255)
	{
		if($inputField=='textField')
		{
			return "\$this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>\$model,
				'attribute'=>'{$name}',
				'allowed' => {$size},
				'htmlOptions' => array('class'=>'form-control'),
			),true)";
		}
		if($inputField=='textArea')
		{
			return "\$this->widget('ext.inputs.counter.GTextarea',array(
				'model'=>\$model,
				'attribute'=>'{$name}',
				'allowed' => {$size},
				'htmlOptions' => array('class'=>'form-control','rows'=>5, 'cols'=>50),
			),true)";
		}
		if($inputField=='date')
		{
			return "\$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => \$model,
				'attribute' => '{$name}',
				'language' =>  Yii::app()->language,
				'htmlOptions' => array('class'=>'form-control'),
				'options' => array(
					'showButtonPanel' => true,
					'changeYear' => true,
					'dateFormat' => 'yy-mm-dd',
				),
			),true)";
		}
		if($inputField=='map')
		{
			return "\$this->widget('ext.inputs.map.GMap', array(
			    'model' => \$model,
			    'attribute' => '{$name}',
			),true)";
		}
		if($inputField=='img')
		{
			return "\$this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => \$model,
			    'attribute' => '{$name}',
			    // 'sizeValidate' => array('width'=>'width','height'=>'height'),
			    'actionUrl' => \$this->createUrl('upload'),
			),true)";
		}
		return "\$form->{$inputField}(\$model,'{$column->name}',array('size'=>$size,'maxlength'=>$maxLength,'class'=>'form-control'))";
	}
}