<?php
/*
  @version 1.0rc3
  @since 1.1
  For know variables please read this link
  @see http://docs.payulatam.com/manual-integracion-web-checkout/informacion-adicional/tablas-de-variables-complementarias/
 */
class GPol extends CApplicationComponent
{
	//@TODO Hacer un módulo administrativo para que le hagan seguimiento a las
	// peticiones y respuestas de POL

	//@TODO implementar eventos del lado del servidor para 
	// las páginas de respuesta y confirmación

	//@TODO implementar en el modulo de POL
	// un simulador de pago para los casos que no pueda entrar a pol
	// tu dices los parametros que esperas el te envía un post
	
	// this data are required
	public $ApiKey='6u39nqhq8ftd0hlvnjfs66eh8c';
	public $merchantId='500238';
	
	// Es para habilitar medios de pago
	// de cada país y es un código especial
	// por cada cuenta de susuario
	public $accountId='500538';

	public $testUrl="https://stg.gateway.payulatam.com/ppp-web-gateway";
	public $prodUrl="https://gateway.payulatam.com/ppp-web-gateway/";
	public $responseUrl="site/response";
	public $confirmationUrl="site/confirmation";

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
		
		// if($this->porcentTax>0 and $this->tax===null and $this->taxReturnBase===null)
		// {
		// 	$orderTotal=$this->amount;
		// 	$this->tax=round(($orderTotal*$this->porcentTax)/100);
		// 	$this->taxReturnBase=round($orderTotal - (($orderTotal*$this->porcentTax)/100));
		// 	$this->amount=round($orderTotal);
		// } 
		// else
		// 	$this->amount=round($this->amount);

		
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
	}
}