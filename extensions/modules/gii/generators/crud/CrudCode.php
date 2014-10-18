<?php
Yii::import('ext.modules.gii.CCodeModel');
class CrudCode extends CCodeModel
{
	public $model;
	public $controller;
	public $foraneKey;
	public $moduleName;
	public $baseControllerClass='Controller';
	
	public $labelName;
	public $fontIcon;


	public $title='CRUD Generator';
	public $subTitle='CRUD Generator code';

	private $_modelClass;
	private $_table;

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('model, controller', 'filter', 'filter'=>'trim'),
			array('controller', 'filter', 'filter'=>'strtolower'),
			array('model, controller, baseControllerClass, moduleName, labelName', 'required'),
			array('fontIcon', 'safe'),
			array('model', 'match', 'pattern'=>'/^\w+[\w+\\.]*$/', 'message'=>'{attribute} should only contain word characters and dots.'),
			array('controller', 'match', 'pattern'=>'/^\w+[\w+\\/]*$/', 'message'=>'{attribute} should only contain word characters and slashes.'),
			array('baseControllerClass', 'match', 'pattern'=>'/^[a-zA-Z_][\w\\\\]*$/', 'message'=>'{attribute} should only contain word characters and backslashes.'),
			array('baseControllerClass', 'validateReservedWord', 'skipOnError'=>true),
			array('controller', 'validateController'),
			array('model', 'validateModel'),
			array('foraneKey', 'validateForeign'),
			// array('foraneKey', 'safe'),
			array('baseControllerClass', 'sticky'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'model'=>'Model Class',
			'controller'=>'Controller ID',
			'baseControllerClass'=>'Base Controller Class',
		));
	}

	public function requiredTemplates()
	{
		return array(
			'controller.php',
		);
	}

	public function init()
	{
		if(Yii::app()->db===null)
			throw new CHttpException(500,'An active "db" connection is required to run this generator.');
		parent::init();
	}

	public function successMessage()
	{
		$link=CHtml::link('try it now', strtr(Yii::app()->createUrl($this->moduleName.'/'.$this->controller),array('.html'=>'')), array('target'=>'_blank'));
		$output="The controller has been generated successfully. You may $link.<br>";
		if($this->template==='cms-manny-modal')
		{
$orderString='';
foreach($this->tableSchema->columns as $column)
{
	if($column->name=='orden_id')
	{
		$orderString="\$criteria->order='orden_id';";
		break;
	}
}


		$code="
<?php
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

\$model=\$this->loadModel(\$id);

\$".$this->getControllerID()."=new ".$this->modelClass.";
\$criteria=new CDbCriteria;
\$criteria->compare('".$this->foraneKey."',\$id);
{$orderString}
\$".$this->getControllerID()."DataProvider=new CActiveDataProvider('".$this->modelClass."',array(
	\"criteria\"=>\$criteria,
));


\$typeRender=Yii::app()->request->isAjaxRequest?\"renderPartial\":\"render\";
\$this->{\$typeRender}('view',array(
	'model'=>\$model,
	'".$this->getControllerID()."'=>\$".$this->getControllerID().",
	'".$this->getControllerID()."DataProvider'=>\$".$this->getControllerID()."DataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php \$this->renderPartial('../{$this->getControllerID()}/view_embed',array(\n
	'model'=>\$model,
	'".$this->getControllerID()."DataProvider'=>\$".$this->getControllerID()."DataProvider,
	'".$this->getControllerID()."'=>\$".$this->getControllerID().",
))?>";
			$output=<<<EOD
<p>The controller has been generated successfully. You may {$link}.</p>
EOD;

			return $output.highlight_string($code,true);
		}
		elseif($this->template==='cms-manny-grid' or $this->template==='cms-one')
		{
$orderString='';
if($this->fontIcon!==null)
	$linkWithIcon=", 'icon'=>'fa ".$this->fontIcon."'";
		$code="
<?php
	// Right now you can create access for your new CRUD menu method 
	// in module ".ucfirst($this->moduleName)."Module class
	// something like this:
	/*
	 * HOeee!! Do you want a multi-level menu?
	 * Here is
	*/
	public function menuItems()
	{
		return array(
            array('label'=>Yii::t('app','".ucfirst($this->moduleName)."'), 'icon'=>'fa fa-puzzle-piece', 'url'=>array('#'), 'items'=>array(
			    array('label'=>Yii::t('app','".$this->labelName."'){$linkWithIcon}, 'url'=>array('/'.\$this->id.'/".$this->getControllerID()."/admin')),
            	// ... Put here more sub-menues like this 
            )),
       );
	}";
		$output=<<<EOD
<p>The controller has been generated successfully. You may {$link}.</p>
EOD;

			return $output.highlight_string($code,true);
		}
		else
			return $output;
	}

	public function validateController($attribute,$params)
	{
		if($this->template=='cms-api' and strpos($this->controller,'api_')!==0)
			$this->addError('controller', "If Your template is <strong>cms-api</strong> enter first a controller prefixed eg. <strong>"."api_".$this->controller."</strong>.");
		if($this->template=='cms-manny-grid' and strpos($this->controller,'api_')===0)
			$this->addError('controller', "If Your template is <strong>cms-manny-grid</strong> enter first a controller without prefixed eg. just wrhite <strong>".strtr($this->controller,array('api_'=>''))."</strong>.");
	}

	public function validateForeign($attribute,$params)
	{
		if($this->template=='cms-manny-modal' and empty($this->foraneKey))
			$this->addError('foraneKey', "If Your template is <strong>cms-manny-modal</strong> enter first a foraneKey eg. <strong>"."foraneKey_id</strong>.");
		
		if($this->template=='cms-manny-modal')
		{
			$key=false;
			foreach($this->tableSchema->columns as $column)
			{
				if($column->name==$this->foraneKey)
					$key=true;
			}
			if(!$key)
				$this->addError('foraneKey', "ForaneKey <strong>".$this->foraneKey."</strong> not found.");
		}
	}

	public function validateModel($attribute,$params)
	{
		if($this->hasErrors('model'))
			return;
		if(empty($this->moduleName))
			$this->addError('model', "Select first a module.");

		$class=@Yii::import($this->moduleName.'.models.'.$this->model,true);
		if(!is_string($class) || !$this->classExists($class))
			$this->addError('model', "Class '{$this->model}' does not exist or has syntax error.");
		elseif(!is_subclass_of($class,'CActiveRecord'))
			$this->addError('model', "'{$this->model}' must extend from CActiveRecord.");
		else
		{
			$table=CActiveRecord::model($class)->tableSchema;
			if($table->primaryKey===null)
				$this->addError('model',"Table '{$table->name}' does not have a primary key.");
			elseif(is_array($table->primaryKey))
				$this->addError('model',"Table '{$table->name}' has a composite primary key which is not supported by crud generator.");
			else
			{
				$this->_modelClass=$class;
				$this->_table=$table;
			}
		}
	}

	public function prepare()
	{
		$this->files=array();
		$model=$this->model;
		$controller=$this->controller;
		$nameController=$this->controller;
		
		$this->model=$this->moduleName.'.models.'.$this->model;
		$this->controller=$this->moduleName.'/'.$this->controller;
		
		
		$templatePath=$this->templatePath;
		$controllerTemplateFile=$templatePath.DIRECTORY_SEPARATOR.'controller.php';

		$this->files[]=new CCodeFile(
			$this->controllerFile,
			$this->render($controllerTemplateFile)
		);

		$files=scandir($templatePath);
		foreach($files as $file)
		{
			if(is_file($templatePath.'/'.$file) && CFileHelper::getExtension($file)==='php' && $file!=='controller.php')
			{
				if(strpos($file, '.doc.php')!==false)
				{
					// $file=$nameController.'.doc.php';
					$this->files[]=new CCodeFile(
						strtr($this->controllerFile,array('Controller.php'=>'.doc.php')),
						$this->render($templatePath.'/'.$file)
					);
				}
				else
				{
					$this->files[]=new CCodeFile(
						$this->viewPath.DIRECTORY_SEPARATOR.$file,
						$this->render($templatePath.'/'.$file)
					);
				}
			}
		}

		$this->model=$model;
		$this->controller=$controller;
	}

	public function getModelClass()
	{
		return $this->_modelClass;
	}

	public function getControllerClass()
	{
		if(($pos=strrpos($this->controller,'/'))!==false)
			return ucfirst(substr($this->controller,$pos+1)).'Controller';
		else
			return ucfirst($this->controller).'Controller';
	}

	public function getModule()
	{
		if(($pos=strpos($this->controller,'/'))!==false)
		{
			$id=substr($this->controller,0,$pos);
			if(($module=Yii::app()->getModule($id))!==null)
				return $module;
		}
		return Yii::app();
	}

	public function getControllerID()
	{
		if($this->getModule()!==Yii::app())
			$id=substr($this->controller,strpos($this->controller,'/')+1);
		else
			$id=$this->controller;
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtolower($id[$pos+1]);
		else
			$id[0]=strtolower($id[0]);
		return $id;
	}

	public function getUniqueControllerID()
	{
		$id=$this->controller;
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtolower($id[$pos+1]);
		else
			$id[0]=strtolower($id[0]);
		return $id;
	}

	public function getControllerFile()
	{
		$module=$this->getModule();
		$id=$this->getControllerID();
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtoupper($id[$pos+1]);
		else
			$id[0]=strtoupper($id[0]);
		return $module->getControllerPath().'/'.$id.'Controller.php';
	}

	public function getViewPath()
	{
		return $this->getModule()->getViewPath().'/'.$this->getControllerID();
	}

	public function getTableSchema()
	{
		return $this->_table;
	}

	public function generateInputLabel($modelClass,$column)
	{
		return "CHtml::activeLabelEx(\$model,'{$column->name}')";
	}

	public function generateInputField($modelClass,$column)
	{
		if($column->type==='boolean')
			return "CHtml::activeCheckBox(\$model,'{$column->name}')";
		elseif(stripos($column->dbType,'text')!==false)
			return "CHtml::activeTextArea(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50))";
		else
		{
			if(preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
				$inputField='activePasswordField';
			else
				$inputField='activeTextField';

			if($column->type!=='string' || $column->size===null)
				return "CHtml::{$inputField}(\$model,'{$column->name}')";
			else
			{
				if(($size=$maxLength=$column->size)>60)
					$size=60;
				return "CHtml::{$inputField}(\$model,'{$column->name}',array('size'=>$size,'maxlength'=>$maxLength))";
			}
		}
	}

	public function guessNameColumn($columns)
	{
		foreach($columns as $column)
		{
			if(!strcasecmp($column->name,'name'))
				return $column->name;
		}
		foreach($columns as $column)
		{
			if(!strcasecmp($column->name,'title'))
				return $column->name;
		}
		foreach($columns as $column)
		{
			if($column->isPrimaryKey)
				return $column->name;
		}
		return 'id';
	}

	public function generateActiveLabel($modelClass,$column)
	{
		return "\$form->labelEx(\$model,'{$column->name}',array('class'=>'control-label'))";
	}

	public function generateActiveField($modelClass,$column)
	{
		return Yii::app()->getModule('gii')->generateActiveField($modelClass,$column);
	}
}