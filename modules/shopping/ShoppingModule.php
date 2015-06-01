<?php

class ShoppingModule extends Module
{

	//@TODO Hacer un módulo administrativo para que le hagan seguimiento a las
	// peticiones y respuestas de POL

	//@TODO implementar eventos del lado del servidor para 
	// las páginas de respuesta y confirmación

	//@TODO implementar en el modulo de POL
	// un simulador de pago para los casos que no pueda entrar a pol
	// tu dices los parametros que esperas el te envía un post
	
	// this data are required
	public $typePlataform='payu';
	public $ApiKey='6u39nqhq8ftd0hlvnjfs66eh8c';
	public $merchantId='500238';
	
	// Es para habilitar medios de pago
	// de cada país y es un código especial
	// por cada cuenta de susuario
	public $accountId='500538';

	public $testUrl="https://stg.gateway.payulatam.com/ppp-web-gateway";
	public $prodUrl="https://gateway.payulatam.com/ppp-web-gateway/";
	

	public $responseUrl="/shopping/page/response";
	public $confirmationUrl="/shopping/page/confirmation";

	public $test=true;
	public $description='Pay description';
	// this is for calcule tax on value
	public $porcentTax=0;
	public $currency='COP';
	

	public $payerFullName;
	public $buyerEmail;
	public $purchaseID;
	
	// Amount for pay
	public $amount;
	public $tax;
	public $taxReturnBase;
	public $shipmentValue=0; // COsto de envío
	public $refVenta; // COsto de envío
	
	public $redirectResponse;
	public $successCallback=array();
	public $penddingCallback=array();
	public $rejectCallback=array();
	
	public $returnUrlAfterPay=array('/');
	
	public $onePerProduct=false;
	public $justBuyRegister=false;
	public $addressRequired=true;

	// Data for test
	// Nombres y apellidos
	// APPROVED
	// REJECTED
	// 5378894813179156 mc

	// @TODO Severals ways for to use cart module
	// @TODO a widget for shoping-cart Include all of cart
	// @TODO a link for pay a plan (Prices, suscription)
	
	public $prefix="PAY00";

	public function getAction()
	{
		if($this->typePlataform!=='payu') {
			$this->prodUrl='https://gateway.pagosonline.net/apps/gateway/index.html';
			$this->testUrl='https://gateway2.pagosonline.net/apps/gateway/index.html';
		} 

		if($this->getIsTest())
			return $this->testUrl;
		return $this->prodUrl;
	}

	public function getSignature($amount,$refVenta,$raw=false)
	{
		$ApiKey=$this->ApiKey;
		$currency=$this->currency; // Id Comercio
		$merchantId=$this->merchantId; // Id Comercio
		$accountId=$this->accountId;
		if($raw)
			return ("{$ApiKey}~{$merchantId}~{$refVenta}~{$amount}~{$currency}");
		return md5("{$ApiKey}~{$merchantId}~{$refVenta}~{$amount}~{$currency}");
	}

	public function getIsTest()
	{
		if(YII_DEBUG)
			return true;
		return $this->test;
	}

	public function actionPay()
	{
		// if(is_object($this->purchase))
		// 	$this->prefix=get_class($purchase);

		$refVenta=$this->refVenta;
		
		if($this->porcentTax>0 and $this->tax===null and $this->taxReturnBase===null)
		{
			$orderTotal=$this->amount;
			$this->tax=(($orderTotal*$this->porcentTax)/100);
			$this->taxReturnBase=($orderTotal - (($orderTotal*$this->porcentTax)/100));
			$this->amount=($orderTotal);
		} 
		else
			$this->amount=($this->amount);
		
		if($this->tax<=0)
			$this->taxReturnBase=0;
		// if($this->porcentTax>0 and $this->tax===null and $this->taxReturnBase===null)
		// {
		// 	$orderTotal=$this->amount;
		// 	$this->tax=round(($orderTotal*$this->porcentTax)/100);
		// 	$this->taxReturnBase=round($orderTotal - (($orderTotal*$this->porcentTax)/100));
		// 	$this->amount=round($orderTotal);
		// } 
		// else
		// 	$this->amount=round($this->amount);

		if($this->typePlataform==='payu') {
			return array(
				"actionUrl"=>$this->getAction(),
				"merchantId"=>$this->merchantId,
				"usuarioId"=>$this->merchantId,
				"refVenta"=>$refVenta,
				"confirmationUrl"=>Yii::app()->createAbsoluteUrl($this->confirmationUrl),
				"responseUrl"=>Yii::app()->createAbsoluteUrl($this->responseUrl),
				"payerFullName"=>$this->payerFullName,
				"accountId"=>$this->accountId,
				"description"=>$this->description,
				"referenceCode"=>$refVenta,
				"amount"=>$this->amount,
				"tax"=>$this->tax,
				"taxReturnBase"=>$this->taxReturnBase,
				"buyerEmail"=>$this->buyerEmail,
				"shipmentValue"=>$this->shipmentValue,
				"currency"=>$this->currency,
				"lng"=>substr(Yii::app()->language,0,2),
				"test"=>(int)$this->getIsTest(),
				"signature"=>$this->getSignature($this->amount,$refVenta),
				"signature_raw"=>$this->getIsTest()?$this->getSignature($this->amount,$refVenta,true):'',
			);
		} else {
/*
<input name="usuarioId" type="text" value="2">
<input name="descripcion" type="text" value="Pruebas">
<input name="refVenta" type="text" value="0001">
<input name="valor" type="text" value="116000">
<input name="baseDevolucionIva " type="text" value="100000">
<input name="iva" type="text" value="16000">
<input name="moneda" type="text" value="COP">
<input name="firma" type="text" value="694f9837325a1948796680e450a820b0">
*/
		
			return array(
				"actionUrl"=>$this->getAction(),
				"usuarioId"=>$this->merchantId,
				"descripcion"=>$this->description,
				"refVenta"=>$refVenta,
				"valor"=>$this->amount,
				"baseDevolucionIva"=>$this->taxReturnBase,
				"iva"=>$this->tax,
				"moneda"=>$this->currency,
				"firma"=>$this->getSignature($this->amount,$refVenta),
				"firma_raw"=>$this->getIsTest()?$this->getSignature($this->amount,$refVenta,true):'',
				"prueba"=>(int)$this->getIsTest(),
				"emailComprador"=>$this->buyerEmail,
				"nombreComprador"=>$this->payerFullName,
				"url_confirmacion"=>Yii::app()->createAbsoluteUrl($this->confirmationUrl),
				"url_respuesta"=>Yii::app()->createAbsoluteUrl($this->responseUrl),
				"lng"=>substr(Yii::app()->language,0,2),
				/*
				"merchantId"=>$this->merchantId,
				"accountId"=>$this->accountId,
				"referenceCode"=>$refVenta,
				"shipmentValue"=>$this->shipmentValue,
				*/
			);
		}
	}

	public function init()
	{
		parent::init();
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		defined('SHOPPING_ID') or define('SHOPPING_ID',$this->id);
		
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

	/**
	 * For one link on admin sidebar
	*/
 	public function menuItems()
    {
        return array(
            array('label'=>Yii::t('app','Compras'), 'icon'=>'fa fa-shopping-cart', 'url'=>array('#'), 'items'=>array(
                
                // array('label'=>Yii::t('app','Home Información'), 'icon'=>'fa fa-star-half-o', 'url'=>array('/'.$this->id.'/info/')),
                // array('label'=>Yii::t('app','Beneficios'), 'icon'=>'fa fa-rocket', 'url'=>array('/'.$this->id.'/features/admin')),
              
               	array('label'=>Yii::t('app','Compras'), 'icon'=>'fa fa-shopping-cart', 'url'=>array('/'.$this->id.'/header/admin')),

               	array('label'=>Yii::t('app','Términos y condiciones'), 'icon'=>'fa fa-gavel', 'url'=>array('/'.$this->id.'/conditions/')),
               	array('label'=>Yii::t('app','Config'), 'icon'=>'fa fa-cog', 'url'=>array('/'.$this->id.'/config/')),
             
            
            )),
            array('label'=>Yii::t('app','Productos'), 'icon'=>'fa fa-barcode', 'url'=>array('#'), 'items'=>array(
                
                array('label'=>Yii::t('app','Categorías'), 'icon'=>'fa fa-list-ol', 'url'=>array('/'.$this->id.'/categories/admin')),
                array('label'=>Yii::t('app','Productos'), 'icon'=>'fa fa-barcode', 'url'=>array('/'.$this->id.'/items/admin')),
            	// array('label'=>Yii::t('app','Facilitadores'), 'icon'=>'fa fa-graduation-cap', 'url'=>array('/'.$this->id.'/facilitador/admin')),
               
            )),
       );
    }

	/*
	 * HOeee!! Do you want a multi-level menu?
	 * Here is
	public function menuItems()
	{
		return array(
            array('label'=>Yii::t('app','Shopping'), 'icon'=>'fa fa-puzzle-piece', 'url'=>array('#'), 'items'=>array(
			    array('label'=>Yii::t('app','Admin Shopping'), 'icon'=>'fa fa-list', 'url'=>array('/'.$this->id.'/mycontrollername/andactionname')),
            	// ... Put here more sub-menues like this 
            )),
       );
	}
	*/
	
	public function renderPartialView($view,$params=array())
    {
    	if(r()->controller->getViewFile('//'.SHOPPING_ID.'/page/'.$view)!==false)
			return r()->controller->renderPartial('//'.SHOPPING_ID.'/page/'.$view,$params,true);
		return r()->controller->renderPartial(SHOPPING_ID.'.views.page.'.$view,$params,true);
	}
	
	/*
	 * HOeee!! Do you want publish elements on the landing module
	 * Here is
	public function getTypesBlocks()
    {
    	return array(
			'shopping-1'=>'landingShopping',
		);
    }

	public function landingShopping($item=null)
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
