<?php
/**
 * GiiModule class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

Yii::import('ext.modules.gii.CCodeGenerator');
Yii::import('ext.modules.gii.CCodeModel');
Yii::import('ext.modules.gii.CCodeFile');
Yii::import('ext.modules.gii.CCodeForm');

/**
 * GiiModule is a module that provides Web-based code generation capabilities.
 *
 * To use GiiModule, you must include it as a module in the application configuration like the following:
 * <pre>
 * return array(
 *     ......
 *     'modules'=>array(
 *         'gii'=>array(
 *             'class'=>'system.gii.GiiModule',
 *             'password'=>***choose a password***
 *         ),
 *     ),
 * )
 * </pre>
 *
 * Because GiiModule generates new code files on the server, you should only use it on your own
 * development machine. To prevent other people from using this module, it is required that
 * you specify a secret password in the configuration. Later when you access
 * the module via browser, you will be prompted to enter the correct password.
 *
 * By default, GiiModule can only be accessed by localhost. You may configure its {@link ipFilters}
 * property if you want to make it accessible on other machines.
 *
 * With the above configuration, you will be able to access GiiModule in your browser using
 * the following URL:
 *
 * http://localhost/path/to/index.php?r=gii
 *
 * If your application is using path-format URLs with some customized URL rules, you may need to add
 * the following URLs in your application configuration in order to access GiiModule:
 * <pre>
 * 'components'=>array(
 *     'urlManager'=>array(
 *         'urlFormat'=>'path',
 *         'rules'=>array(
 *             'gii'=>'gii',
 *             'gii/<controller:\w+>'=>'gii/<controller>',
 *             'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
 *             ...other rules...
 *         ),
 *     )
 * )
 * </pre>
 *
 * You can then access GiiModule via:
 *
 * http://localhost/path/to/index.php/gii
 *
 * @property string $assetsUrl The base URL that contains all published asset files of gii.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.gii
 * @since 1.1.2
 */
class GiiModule extends Module
{

	public $arrayClean=array(
		'_id'=>'',
		'_'=>' ',
		'hour_'=>'',
		'editor_'=>'',
		'img_'=>'',
		'map_'=>'',
		'file_'=>'',
		'class_'=>'',
		'icon_'=>'',
		'radio_'=>'',
		'color_'=>'',
		'select_'=>'',
		'multiselect_'=>'',
		'crud_'=>'',
		'url_'=>'',
		'link_'=>'',
		'money_'=>'',
		'redactor_'=>'',
		'code_'=>'',
		'cms_'=>'',
	);
	
	public $arrayReplaceInputs=array(
		'varchar'=>'string',
		'tinyint'=>'boolean',
		'int('=>'integer(',
		'datetime'=>'datetime format (yyyy-MM-dd hh:mm:ss)',
		'time'=>'time format (hh:mm:ss)',
		'date'=>'date format (yyyy-MM-dd)',
	);

	public $noModules=array('users','admin','gii','smtp','settings');
	// public $noModules=array();
		
	public $defaultController='crud';
	/**
	 * @var string the password that can be used to access GiiModule.
	 * If this property is set false, then GiiModule can be accessed without password
	 * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
	 */
	public $password;
	/**
	 * @var array the IP filters that specify which IP addresses are allowed to access GiiModule.
	 * Each array element represents a single filter. A filter can be either an IP address
	 * or an address with wildcard (e.g. 192.168.0.*) to represent a network segment.
	 * If you want to allow all IPs to access gii, you may set this property to be false
	 * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
	 * The default value is array('127.0.0.1', '::1'), which means GiiModule can only be accessed
	 * on the localhost.
	 */
	public $ipFilters=array('127.0.0.1','::1');
	/**
	 * @var array a list of path aliases that refer to the directories containing code generators.
	 * The directory referred by a single path alias may contain multiple code generators, each stored
	 * under a sub-directory whose name is the generator name.
	 * Defaults to array('application.gii').
	 */
	public $generatorPaths=array('application.gii');
	/**
	 * @var integer the permission to be set for newly generated code files.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0666, meaning the file is read-writable by all users.
	 */
	public $newFileMode=0666;
	/**
	 * @var integer the permission to be set for newly generated directories.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0777, meaning the directory can be read, written and executed by all users.
	 */
	public $newDirMode=0777;

	private $_assetsUrl;

	/**
	 * Initializes the gii module.
	 */
	public function init()
	{
		parent::init();
		Yii::setPathOfAlias('gii',dirname(__FILE__));
		$this->generatorPaths[]='gii.generators';
		$this->controllerMap=$this->findGenerators();
	}

	/**
	 * @return string the base URL that contains all published asset files of gii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('gii.assets'));
		return $this->_assetsUrl;
	}

	/**
	 * @param string $value the base URL that contains all published asset files of gii.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}

	/**
	 * Performs access check to gii.
	 * This method will check to see if user IP and password are correct if they attempt
	 * to access actions other than "default/login" and "default/error".
	 * @param CController $controller the controller to be accessed.
	 * @param CAction $action the action to be accessed.
	 * @throws CHttpException if access denied
	 * @return boolean whether the action should be executed.
	 */
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$cs=Yii::app()->clientScript;
			$cs->coreScriptPosition=CClientScript::POS_HEAD;
			$cs->scriptMap=array();
			$baseUrl=$this->assetsUrl;
			$cs->registerCoreScript('jquery');
			// $cs->registerScriptFile($baseUrl.'/js/tooltip.js');
			$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.pack.js');
			
			$cs->registerScriptFile($baseUrl.'/js/main.js');
			$cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.css');
			$cs->registerCssFile($baseUrl.'/css/main.css');

			$route=$controller->id.'/'.$action->id;
			if(!$this->allowIp(Yii::app()->request->userHostAddress) && $route!=='default/error')
				throw new CHttpException(403,"You are not allowed to access this page.");

			// $publicPages=array(
			// 	'default/login',
			// 	'default/error',
			// );
			// if($this->password!==false && Yii::app()->user->isGuest && !in_array($route,$publicPages))
			// 	Yii::app()->user->loginRequired();
			// else
				return true;
		}
		return false;
	}

	/**
	 * Checks to see if the user IP is allowed by {@link ipFilters}.
	 * @param string $ip the user IP
	 * @return boolean whether the user IP is allowed by {@link ipFilters}.
	 */
	protected function allowIp($ip)
	{
		if(empty($this->ipFilters))
			return true;
		foreach($this->ipFilters as $filter)
		{
			if($filter==='*' || $filter===$ip || (($pos=strpos($filter,'*'))!==false && !strncmp($ip,$filter,$pos)))
				return true;
		}
		return false;
	}

	/**
	 * Finds all available code generators and their code templates.
	 * @return array
	 */
	protected function findGenerators()
	{
		$generators=array();
		$n=count($this->generatorPaths);
		for($i=$n-1;$i>=0;--$i)
		{
			$alias=$this->generatorPaths[$i];
			$path=Yii::getPathOfAlias($alias);
			if($path===false || !is_dir($path))
				continue;

			$names=scandir($path);
			foreach($names as $name)
			{
				if($name[0]!=='.' && is_dir($path.'/'.$name))
				{
					$className=ucfirst($name).'Generator';
					if(is_file("$path/$name/$className.php"))
					{
						$generators[$name]=array(
							'class'=>"$alias.$name.$className",
						);
					}

					if(isset($generators[$name]) && is_dir("$path/$name/templates"))
					{
						$templatePath="$path/$name/templates";
						$dirs=scandir($templatePath);
						foreach($dirs as $dir)
						{
							if($dir[0]!=='.' && is_dir($templatePath.'/'.$dir))
								$generators[$name]['templates'][$dir]=strtr($templatePath.'/'.$dir,array('/'=>DIRECTORY_SEPARATOR,'\\'=>DIRECTORY_SEPARATOR));
						}
					}
				}
			}
		}
		return $generators;
	}

	/*
	For more then one link
	You can also to use 'items'=>array('label'=>'My other link'...)
	until two levels
	*/
	public function menuItems()
	{
		return array(
            array('label'=>$this->labelMenu!==null?$this->labelMenu:Yii::t('app','Generator'), 'icon'=>'fa fa-code', 'url'=>'#','items'=>$this->getMyselfMenu(),'visible'=>Yii::app()->getModule('users')->check('root')),
       );
	}

	public function getMyselfMenu()
	{
		$result=array();
 		foreach($this->controllerMap as $name=>$config)
			array_unshift($result,array('label'=>ucwords(CHtml::encode($name).' generator'), 'icon'=>'fa fa-code', 'url'=>array('/'.$this->id.'/'.$name.'/index')));
		return ($result);
	}

	public function getListDataModels($moduleName,$codeModel)
	{
		if(empty($moduleName))
			return array(''=>'Please select a module.');
			
		$data=array();
		$modelClass=Yii::import($codeModel,true);
		$pathDir=Yii::getPathOfAlias($moduleName.'.models');

		if(is_dir($pathDir) and ($handle = opendir($pathDir))) 
		{
		    $blacklist = array('.', '..', '.gitignore', '.DS_Store');
		    while (false !== ($file = readdir($handle))) 
		    {
		        // if (!in_array($file, $blacklist)) {
		        if (!in_array($file, $blacklist) and !is_dir($pathDir."/".$file)) {
		            $modelName=strtr($file,array('.php'=>''));
		            $data[$modelName]=$modelName;
		            // $data[$modelName]='ext.modules.'.$moduleName.'.models.'.$modelName;
		        }
		    }
		    closedir($handle);
		}
		else
			$data=array(''=>'Empty models for selected module');
		return $data;
	}

	public function getLabelOfColumn($column)
	{
		$columnName=strtr($column->name, $this->arrayClean);
		$label=ucwords(trim(strtolower(str_replace(array('-','_'),' ',preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $columnName)))));
		$label=preg_replace('/\s+/',' ',$label);
		if(strcasecmp(substr($label,-3),' id')===0)
			$label=substr($label,0,-3);
		if($label==='Id')
			$label='ID';
		$label=str_replace("'","\\'",$label);
		return $label;
	}

	public function getParamsField($column)
	{
		$valuesConfig=array('width','height','ext','table','label','type','size','w','h','help','comment');

		$width=null;
		$height=null;
		$size=$column->size;
		$comment=$column->comment;
		$label=$this->getLabelOfColumn($column);
		$type='field';
		$table=null;
		$ext=null;
		

		if($column->type==='integer')
			$type='integer';
			
		if($column->type==='boolean' or strpos($column->dbType,'tinyint(1)')!==false)
			$type='boolean';

		if(strpos($column->dbType,'decimal')!==false)
			$type='decimal';

		if(strpos($column->dbType,'float')!==false)
			$type='float';

		if(strpos($column->dbType,'datetime')!==false)
			$type='datetime';

		if($column->dbType==='date')
			$type='date';

		if($column->dbType==='time' or stripos($column->name,'hour_')!==false)
			$type='hour';

		if(stripos($column->name,'cms_')!==false)
			$type='cms';

		if(stripos($column->name,'map_')!==false)
			$type='map';

		if(stripos($column->name,'money_')!==false)
			$type='money';

		if(stripos($column->name,'redactor_')!==false)
			$type='redactor';

		if(stripos($column->name,'code_')!==false)
			$type='code';

		if(stripos($column->name,'img_')!==false)
			$type='img';

		if(stripos($column->name,'class_')!==false)
			$type='class';

		if(stripos($column->name,'icon_')!==false)
			$type='icon';

		if(stripos($column->name,'radio_')!==false)
			$type='radio';

		if(stripos($column->name,'file_')!==false)
			$type='file';

		if(stripos($column->name,'editor_')!==false)
			$type='editor';

		if(stripos($column->name,'color_')!==false)
			$type='color';
		
		if(strpos($column->name, '_users_id')!==false)
			$type='users';
		
		if(stripos($column->name,'select_')!==false)
			$type='select';
		
		if(stripos($column->name,'url_')!==false or stripos($column->name,'link_')!==false)
			$type='link';
			
		if(stripos($column->dbType,'text')!==false or stripos($column->name,'text_')!==false)
			$type='text';

		if(stripos($column->name, 'email_')!==false)
			$type='email';
			
		if(preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
			$type='password';
		
		if(!empty($column->comment))
		{
			$content=explode(";", $column->comment);
			foreach($content as $cont)
			{
				$trimCont=trim($cont);
				if(strpos($trimCont, ':')!==false)
				{
					$pice=explode(":", $trimCont);
					$param=strtolower(trim($pice[0]));
					$value=trim($pice[1]);
					
					if(in_array($param, $valuesConfig))
					{
						if($param==='type')
							$type=$value;
						if($param==='comment' or $param==='help')
							$comment=$value;
						if($param==='label')
							$label=$value;
						if($param==='width' or $param==='w')
							$width=$value;
						if($param==='height' or $param==='h')
							$height=$value;
						if($param==='size')
							$size=$value;
						if($param==='table')
							$table=$value;
						if($param==='ext')
							$ext=$value;
					}
				}
			}
		}
		
		return compact('width','height','size','comment','type','table','ext','label');
	}

	public function generateActiveField($modelClass,$column)
	{
		$params=$this->getParamsField($column);
		return $this->textFieldWidget($params,$column);
	}

	public function generateClassName($tableName)
	{
		if(($pos=strpos($tableName,'.'))!==false) // remove schema part (e.g. remove 'public2.' from 'public2.post')
			$tableName=substr($tableName,$pos+1);
		$className='';
		foreach(explode('_',$tableName) as $name)
		{
			if($name!=='')
				$className.=ucfirst($name);
		}
		if($className==='UsersUsers')
			$className='Users';
		return $className;
	}

	public function textFieldWidget($params,$column)
	{
		$inputField=$params['type'];

		if($inputField=='password')
			return "\$form->passwordField(\$model,'{$column->name}',array('class'=>'form-control'))";
		if($inputField=='select')
		{
			$modelName='NameModelRelated';
			if($params['table']!==null)
			{
				$modelName=$this->generateClassName($params['table']);
				return "\$form->dropDownList(\$model,'{$column->name}',{$modelName}::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control'))";
			}
			else
			{
				$im=explode("_", $column->name);
				array_pop($im);
				$modelName=$this->generateClassName(implode("_", $im));
				if(!empty($modelName))
					return "\$form->dropDownList(\$model,'{$column->name}',{$modelName}::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control'))";
				return "\$form->dropDownList(\$model,'{$column->name}',array('1'=>'Value 1','2'=>'Value 2','3'=>'Value 3')/* CHtml::listData({$modelName}::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow')*/,array('empty'=>Yii::t('app','Select one ...'),'class'=>'form-control'))";
			}
		}
		if($inputField=='users')
			return "\$form->dropDownList(\$model,'{$column->name}',Users::listData(),array('empty'=>Yii::t('app','Select users...'),'class'=>'form-control'))";
		if($inputField=='boolean')
			return "\$form->checkBox(\$model,'{$column->name}')";
		if($inputField=='field' or $inputField=='link' or $inputField=='integer'or $inputField=='email')
		{
			if(($size=$params['size'])!==null)
				return "\$this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>\$model,
					'attribute'=>'{$column->name}',
					'allowed' => {$size},
					'htmlOptions' => array('class'=>'form-control'),
				),true)";
			return "\$form->textField(\$model,'{$column->name}',array('class'=>'form-control'))";
		}
		if($inputField=='text')
		{
			if(($size=$params['size'])!==null)
			return "\$this->widget('ext.inputs.counter.GTextarea',array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
				'allowed' => {$size},
				'htmlOptions' => array('class'=>'form-control','rows'=>5, 'cols'=>50),
			),true)";
			return "\$form->textArea(\$model,'{$column->name}',array('rows'=>5, 'cols'=>50,'class'=>'form-control'))";
		}
		if($inputField=='date')
		{
			return "\$this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
		        'pluginOptions' => array(
		            'format' => 'yyyy-mm-dd'
		        ),
				'htmlOptions' => array('class'=>'form-control'),
		    ),true)";
		}
		if($inputField=='datetime')
		{
			return "\$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
		        'model' => \$model,
		        'attribute' => '{$column->name}',
				'pluginOptions'=>array( 
			        'pick12HourFormat' => false,
		    		'format' => 'YYYY-MM-DD HH:mm:ss',
					'showButtonPanel' => true,
			        'changeYear' => true,
			    ),
				'htmlOptions' => array('class'=>'form-control'),
		    ),true)";
		}
		// TODO add two inputs float
		if($inputField=='map')
		{
			return "\$this->widget('ext.inputs.map.GMap', array(
			    'model' => \$model,
			    'attribute' => '{$column->name}',
			),true)";
		}
		if($inputField=='img')
		{
			$shape="// 'sizeValidate' => array('width'=>'500','height'=>'500'),";
			if($params['width']!==null and $params['height']===null)
				$shape="'sizeValidate' => array('width'=>'".$params['width']."'),";
			if($params['width']===null and $params['height']!==null)
				$shape="'sizeValidate' => array('height'=>'".$params['height']."'),";
			if($params['width']!==null and $params['height']!==null)
				$shape="'sizeValidate' => array('width'=>'".$params['width']."','height'=>'".$params['height']."'),";
			// var_dump($params);
			// exit;
			return "\$this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => \$model,
			    'attribute' => '{$column->name}',
			    {$shape}
			    'actionUrl' => \$this->createUrl('upload'),
			),true)";
		}
		if($inputField=='hour')
		{
			return "\$this->widget('yiiwheels.widgets.maskinput.WhMaskInput', array(
			    'model' => \$model,
			    'attribute' => '{$column->name}',
                'mask' => '00:00:00',
                'htmlOptions' => array(
                	'placeholder' => '00:00:00',
                	'class' => 'form-control'
            	),
            ),true)";
		}
		if($inputField=='file')
		{
			$extensions=array('png','jpg','jpeg','csv','xls','xlsx','doc','docx','pdf','rar','zip','txt','mp4','mp3','mov','swf');
			if($params['ext']!==null)
				$extensions=explode(",", $params['ext']);
			
			return "\$this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => \$model,
			    'attribute' => '{$column->name}',
			    // Put this same array extensions allowed in your upload action
			    'allowedExtensions' => array('".implode("','", $extensions)."'),
			    'actionUrl' => \$this->createUrl('upload'),
			),true)";
		}
		if($inputField=='editor')
		{
			return "\$this->widget('ext.widgets.xheditor.XHeditor',array(
			    'model'=>\$model,
			    'modelAttribute'=>'{$column->name}',
			    'config'=>array(
			        'tools'=>'mfull', // mini, simple, mfull, full or from XHeditor::\$_tools, tool names are case sensitive
			        'skin'=>'default', // default, nostyle, o2007blue, o2007silver, vista
			        'width'=>'100%',
			        'height'=>'300px',
			        'upImgUrl'=>\$this->createUrl('request/uploadFile'), // NB! Access restricted by IP        'upImgExt'=>'jpg,jpeg,gif,png',
			    ),
			),true)";
		}
		if($inputField=='class')
		{
			// TODO List data
			return "\$this->widget('ext.inputs.radio.GStatus',array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
				'listData'=>array(
				  	'default'=>'<span class=\"label label-default\">Default</span>',
					'primary'=>'<span class=\"label label-primary\">Primary</span>',
					'success'=>'<span class=\"label label-success\">Success</span>',
					'info'=>'<span class=\"label label-info\">Info</span>',
					'warning'=>'<span class=\"label label-warning\">Warning</span>',
					'danger'=>'<span class=\"label label-danger\">Danger</span>'
				)
			),true)";
		}
		if($inputField=='radio')
		{
			$modelName='NameModelRelated';
			$listData="'listData'=>array(
				  	'1'=>'Example <strong>html</strong> support 1',
					'2'=>'Example <strong>html</strong> support 2',
					'3'=>'Example <strong>html</strong> support 3',
					'4'=>'Example <strong>html</strong> support 4',
					'5'=>'Example <strong>html</strong> support 5',
					'6'=>'Example <strong>html</strong> support 6'
				),";
		
			if($params['table']!==null)
			{
				$modelName=$this->generateClassName($params['table']);
				$listData="'listData'=>{$modelName}::listData(),";
			}
			
			return "\$this->widget('ext.inputs.radio.GThumbnail',array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
				{$listData}
			),true)";
		}
		if($inputField=='icon')
		{
			return "\$this->widget('ext.inputs.radio.GFontAwesome',array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
			),true)";
		}
		if($inputField=='color')
		{
			return "\$this->widget('ext.inputs.colorpicker.EColorPicker', array(
                'model'=>\$model,
                'attribute'=>'{$column->name}',
                'htmlOptions'=>array('class'=>'form-control'),
                'mode'=>'textfield',
                'fade' => false,
                'slide' => false,
                'curtain' => true,
           ),true)";
		}
		if($inputField=='select')
		{
			// TODO IMPROVE
			return "\$this->widget('yiiwheels.widgets.formhelpers.WhSelectBox', array(
            	'model'=>\$model,
                'attribute'=>'{$column->name}',
				/* 'data' => CHtml::listData(NameModelRelated::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow') */
                'data' => array(
                	'1'=>'Value 1',
                	'2'=>'Value 2',
                	'3'=>'Value 3'
            	)
            ),true)";
		}
		if($inputField=='money')
		{
			return "\"\";
			\$model->{$column->name}=Yii::app()->format->money(\$model->{$column->name});
			echo \$this->widget('yiiwheels.widgets.maskmoney.WhMaskMoney', array(
            	'model'=>\$model,
                'attribute'=>'{$column->name}',
                'htmlOptions' => array(
                    'class' => 'form-control'
                )
			),true)";
		}
		if($inputField=='redactor')
		{
			return "\$this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
            	'model'=>\$model,
                'attribute'=>'{$column->name}',
            	'height'=>'250px',
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
			),true)";
		}
		if($inputField=='code')
		{
			return "\$this->widget('yiiwheels.widgets.ace.WhAceEditor', array(
            	'model'=>\$model,
                'attribute'=>'{$column->name}',
                'htmlOptions' => array(
                    'class' => 'form-control',
                    'style'=> 'width:100%;height:150px',
                )
			),true)";
		}
		if($inputField=='cms')
		{
			return "\$this->widget('ext.inputs.sir-trevor.GSirTrevor',array(
			    'model'=>\$model,
			    'attribute'=>'{$column->name}',
				'uploadUrl'=>\$this->createUrl('upload'),
				// list of avalilables blocks
				'blockTypes'=>array(
					\"Heading\",
					\"Text\",
					\"List\",
					\"Quote\",
					\"Image\",
					\"Video\",
					\"Tweet\"
				),
				'blockLimit'=>0, // 0 is infinite bloks
				'required'=>array('Text'),
				'onEditorRender'=>'js:function(){
					console.log(\"Do something\")
				}',
				// 'blockTypeLimits'=>array(
				// 	'Text'=>'2',
				// 	'Image'=>'1',
				// ),
			),true)";
		}

		if(($size=$params['size'])!==null)
			return "\$this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>\$model,
				'attribute'=>'{$column->name}',
				'allowed' => {$size},
				'htmlOptions' => array('class'=>'form-control'),
			),true)";
		return "\$form->textField(\$model,'{$column->name}',array('class'=>'form-control'))";
	}
}