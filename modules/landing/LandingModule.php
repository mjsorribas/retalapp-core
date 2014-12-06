<?php

class LandingModule extends Module
{
	public function init()
	{
		parent::init();
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		defined('LANDING_ID') or define('LANDING_ID',$this->id);

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

	public function getModulesList()
	{
		$modules=array();
		foreach(Yii::app()->getModules() as $id=>$params)
			$modules[$id]=$id;
		return $modules;
	}

	public function getTypesList($moduleName)
	{
		$module=r($moduleName);
		if(method_exists($module,'getTypesBlocks')) {
			$result=$module->getTypesBlocks();
			return array_keys($result);
		}
		return array();
	}

	public function getImgBlock($module,$type)
	{
		$assets=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias($module.'.imgs'));
		//return $assets;
		return $assets.'/'.$type.'.png';
	}

	/*
   * HOeee!! Do you want a multi-level menu?
   * Here is
  */
  public function menuItems()
  {
      return array(
          array('label'=>Yii::t('app','Landing'), 'icon'=>'fa fa-align-justify ', 'url'=>array('#'), 'items'=>array(
              array('label'=>Yii::t('app','Elements for page'), 'icon'=>'fa fa-list', 'url'=>array('/'.$this->id.'/elements/index')),
              array('label'=>Yii::t('app','Slider'), 'icon'=>'fa fa-magic', 'url'=>array('/'.$this->id.'/slider/admin')),
         			array('label'=>Yii::t('app','Contact info'), 'icon'=>'fa fa-share-alt', 'url'=>array('/'.$this->id.'/contact_info/')),

         		 // ... Put here more sub-menues like this
          )),
     );
  }

	public function getHeader()
	{

		$echo='';
		foreach(LandingElements::model()->findAll(array('order'=>'orden_id','condition'=>'landing_elements_positions_id=1')) as $data) {
			$echo.=$this->renderBlok($data);
		}
		return $echo;
	}

	public function getFooter()
	{

		$echo='';
		foreach(LandingElements::model()->findAll(array('order'=>'orden_id','condition'=>'landing_elements_positions_id=3')) as $data) {
			$echo.=$this->renderBlok($data);
		}
		return $echo;
	}

	public function getBody()
	{

		$echo='';
		foreach(LandingElements::model()->findAll(array('order'=>'orden_id','condition'=>'landing_elements_positions_id=2')) as $data) {
			$echo.=$this->renderBlok($data);
		}
		return $echo;
	}

	public function renderBlok($data)
	{
		$blockRender='';
		$module=r($data->module);

		if($module!==null) {
			$blocks=$module->getTypesBlocks();
			if(isset($blocks[$data->type])) {
				$method=$blocks[$data->type];
				$blockRender.=$module->{$method}();
			}
		}
		return $blockRender;
	}

  public function getTypesBlocks()
  {
  	return array(
			'menu-1'=>'landingMenu',
			//'header-1'=>'landingHeader',
			'header-slider-1'=>'landingHeaderSlider',
			'content-1'=>'landingContent1',
			'footer-1'=>'landingFooter',
			//'footer-2'=>'landingFooter2',
			'footer-small-1'=>'landingFooterSmall',
		);
  }

  public function renderPartialView($view,$params=array())
  {
  	if(r()->controller->getViewFile('//'.LANDING_ID.'/page/'.$view)!==false)
			return r()->controller->renderPartial('//'.LANDING_ID.'/page/'.$view,$params,true);
		return r()->controller->renderPartial(LANDING_ID.'.views.page.'.$view,$params,true);
	}

	public function landingMenu($item=null)
	{
		return $this->renderPartialView('_menu');
	}

	public function landingHeader($item=null)
	{
		return $this->renderPartialView('_header');
	}

	public function landingHeaderSlider($item=null)
	{
		return $this->renderPartialView('_header_slider');
	}

	public function landingFooter($item=null)
	{
		return $this->renderPartialView('_footer');
	}

	public function landingFooter2($item=null)
	{
		return $this->renderPartialView('_footer2');
	}

	public function landingFooterSmall($item=null)
	{
		return $this->renderPartialView('_footer_small');
	}

	public function landingContent1($item=null)
	{
		return $this->renderPartialView('_content1');
	}


	/*
	 * HOeee!! Do you want a multi-level menu?
	 * Here is
	public function menuItems()
	{
		return array(
            array('label'=>Yii::t('app','Landing'), 'icon'=>'fa fa-puzzle-piece', 'url'=>array('#'), 'items'=>array(
			    array('label'=>Yii::t('app','Admin Landing'), 'icon'=>'fa fa-list', 'url'=>array('/'.$this->id.'/mycontrollername/andactionname')),
            	// ... Put here more sub-menues like this
            )),
       );
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
