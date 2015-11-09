<?php

class AdminModule extends Module
{
	public $analyticsID='UA-xxxxxx-1';
	public $defaultController='back';
	public $hideConfigMenu=false;
	private $_reports=array();
	private $_counters=array();

	public $types=array(
		'info'=>'bg-aqua',
		'success'=>'bg-green',
		'warning'=>'bg-yellow',
		'danger'=>'bg-red',
	);

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	/*
	For more then one link
	*/
	public function menuItems()
	{
		if($this->menuConfig!==array())
			return $this->menuConfig;
		return array(
            array('label'=>'Dashboard', 'icon'=>'fa fa-dashboard', 'url'=>array('/'.$this->id.'')),
       );
	}
		
	public function loadModules()
	{
		if($this->_modules===null)
			$this->_modules=Yii::app()->getModules();
		return $this->_modules;
 	}

	public function getTypeClass($type)
	{
		if(isset($this->types[$type]))
			return $this->types[$type];
		else if(is_string($type))
			return $type;
		return '';
	}

	public function builtHeader($ctr)
	{
		if($this->isEnabled()) {
			$ctr->renderPartial($this->id.'.views.page.__modals',array('module'=>$this));
		}
	}	
}