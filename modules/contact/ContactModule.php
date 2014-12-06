<?php

class ContactModule extends Module
{
	public function init()
	{
		parent::init();
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		defined('CONTACT_ID') or define('CONTACT_ID',$this->id);
		
		$this->setImport(array(
			$this->id.'.models.base.*',
			$this->id.'.models.*',
			$this->id.'.components.*',
		));

		if(file_exists(dirname(__FILE__)."/components.php"))
			r()->setComponents(require(dirname(__FILE__)."/components.php"), false);
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

   	public function menuItems()
    {
        return array(
            array('label'=>Yii::t('app','Contact'), 'icon'=>'fa fa-envelope', 'url'=>array('#'), 'items'=>array(
                array('label'=>Yii::t('app','Contact Info'), 'icon'=>'fa fa-envelope', 'url'=>array('/'.$this->id.'/info/')),
                  array('label'=>Yii::t('app','Messages'), 'icon'=>'fa fa-envelope', 'url'=>array('/'.$this->id.'/messages/admin')),
               array('label'=>Yii::t('app','Contact Newsletter'), 'icon'=>'fa fa-envelope', 'url'=>array('/'.$this->id.'/news/admin')),
               
                // ... Put here more sub-menues like this 
            )),
       );
    }

	/*
	 * HOeee!! Do you want a multi-level menu?
	 * Here is
	public function menuItems()
	{
		return array(
            array('label'=>Yii::t('app','Contact'), 'icon'=>'fa fa-puzzle-piece', 'url'=>array('#'), 'items'=>array(
			    array('label'=>Yii::t('app','Admin Contact'), 'icon'=>'fa fa-list', 'url'=>array('/'.$this->id.'/mycontrollername/andactionname')),
            	// ... Put here more sub-menues like this 
            )),
       );
	}
	*/
	
	public function renderPartialView($view,$params=array())
    {
    	if(r()->controller->getViewFile('//'.CONTACT_ID.'/page/'.$view)!==false)
			return r()->controller->renderPartial('//'.CONTACT_ID.'/page/'.$view,$params,true);
		return r()->controller->renderPartial(CONTACT_ID.'.views.page.'.$view,$params,true);
	}
	
	/*
	 * HOeee!! Do you want publish elements on the landing module
	 * Here is
	public function getTypesBlocks()
    {
    	return array(
			'contact-1'=>'landingContact',
		);
    }

	public function landingContact($item=null)
	{
		return $this->renderPartialView('_block');
	}
	*/

	/*
	 * HOeee!! Do you want show someting on the end body
	 * Here is
	public function builtEndBody($ctr)
	{
	}
	*/

	/*
	 * HOeee!! Do you want to do something 
	 * Before all app is init
	 * Here is
	public function builtApp($ctr)
	{
	}
	*/

	/*
	 * Eyyyy shiffff!! Do you want a submenu on the config crud?
	 * Here is
	public function configItems()
	{
		return array(
	    	array('label'=>ucfirst($this->id), 'icon'=>'fa fa-cogs', 'url'=>array('/'.$this->id.'/config')),
		);
	}
	*/

	///////////////////////////////////////////////
	// The follow methos are in order to         //
	// Enabled menues on the left side bar admin //
	///////////////////////////////////////////////

	/*
	 * Examples in order to show reports in dashboard
	public function dashboardCounters()
	{
		return array(
            array('label'=>'New Orders', 'type'=>'info', 'icon'=>'fa fa-cog', 'count'=>'150', 'url'=>array('/'.$this->id.'/back')),
            array('label'=>'Bounce Rate', 'type'=>'success', 'icon'=>'fa fa-shopping-cart', 'count'=>'40', 'url'=>array('/'.$this->id.'/back')),
            array('label'=>'User Registrations', 'type'=>'warning', 'icon'=>'fa fa-user', 'count'=>'44', 'url'=>array('/'.$this->id.'/back')),
            array('label'=>' Unique Visitors ', 'type'=>'danger', 'icon'=>'fa fa-eye', 'count'=>'60', 'url'=>array('/'.$this->id.'/back')),
		);
	}

	public function dashboardReports()
	{
		return array(
            array('label'=>'New Orders', 'type'=>'danger', 'icon'=>'fa fa-cog', 'content'=>$this->loadOrders(), 'url'=>array('/'.$this->id)),
        );
	}

	public function loadOrders()
	{
		// Load here your html 
		// You can call all the models of this module
		// and create your own html for report
		return '<em>Hola orders</em>';
	}
	*/
	
}
