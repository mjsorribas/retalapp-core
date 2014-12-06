<?php

class CartModule extends Module
{

	public $typesAllowed=array(
		'ProductosResultados'=>array(
			'id'=>'id',
			'name'=>'nombre',
			'unit_value'=>'precio',
			'description'=>'descripcion',
			'extra'=>'nombre',
			'image'=>'img_imagen',
			'currency'=>null,
			'tax_rate'=>null,
		),
	);

    public $singlePay=false;
    public $showConditions=false;
	
    public $responseUrl='/cart/page/response';
    
    public $redirectResponse;
    
    public $confirmationUrl='/cart/page/confirmation';
	
	public $is_shipping=false;

	public $returnUrlAfterPay=array('/home');

	public $errorCart=array();

	// Config params comes from cart_config table
	public $overall_tax;
	public $shipping_cost;
	public $shipping_data_required;
	public $editor_purchase_terms;
	public $email_just_test;
	public $pol_api_key;
	public $pol_merchant_id;
	public $pol_test;
	public $pol_currency;
	public $pol_description;

	private $_configModel;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		defined('CART_ID') or define('CART_ID',$this->id);
		
		$this->setImport(array(
			$this->id.'.models.*',
			$this->id.'.models.base.*',
			$this->id.'.components.*',
		));

		// $this->getCart();

		if($this->_configModel===null)
			$this->_configModel=CartConfig::model()->find();
		
		if($this->_configModel!==null)
		{
			$this->overall_tax=$this->_configModel->overall_tax;
			$this->shipping_cost=$this->_configModel->shipping_cost;
			#$this->shipping_data_required=$this->_configModel->shipping_data_required;
			$this->editor_purchase_terms=$this->_configModel->editor_purchase_terms;
			$this->email_just_test=$this->_configModel->email_just_test;
			$this->pol_api_key=$this->_configModel->pol_api_key;
			$this->pol_merchant_id=$this->_configModel->pol_merchant_id;
			$this->pol_test=$this->_configModel->pol_test;
			$this->pol_currency=$this->_configModel->pol_currency;
			$this->pol_description=$this->_configModel->pol_description;
		}
		
		parent::init();
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

	public function addCart($id,$quantity,$type=null)
	{
		if($type===null)
		{
			$possiblesKeys=array_keys($this->typesAllowed);
			$type=$possiblesKeys[0];
		}

		$modelRelated=CActiveRecord::model($type)->findByPk($id);
		if(!in_array($type, array_keys($this->typesAllowed)))
		{
			$this->errorCart['table_related'][]='Type of items is not allowed put into the card';
			return false;
		}
		
		$modelConfig=$this->typesAllowed[$type];
		$modelId=$modelConfig['id'];
		$modelUnitValue=$modelConfig['unit_value'];
		
		$modelCurrency=(isset($modelConfig['currency']) and $modelConfig['currency']!==null)?$modelConfig['currency']:null;
		$modelTaxRate=(isset($modelConfig['tax_rate']) and $modelConfig['tax_rate']!==null)?$modelConfig['tax_rate']:null;

		$cart=$this->getCart();
		
		$found=false;
		foreach($cart['items'] as $i => $row)
		{
			if($row['product_id']==$id and $row['type']==$type)
			{
				if($this->singlePay)
					$cart['items'][$i]['quantity']=1;
				else
					$cart['items'][$i]['quantity']+=$quantity;
				$found=true;
			}
		}

		if(!$found)
		{
			$cartItem=array(
				'cart_shoping_header_id'=>$cart['id'],
				// here sould return a erros if type model is not allowed
				'table_related'=>$type,
				'type'=>$type,
				'product_id'=>$modelRelated->{$modelId},
				'unit_value'=>0,
				'quantity'=>$quantity,
				'currency'=>($modelCurrency!==null)?$modelRelated->{$modelCurrency}:$this->pol_currency,
				'tax_rate'=>($modelTaxRate!==null)?$modelRelated->{$modelTaxRate}:$this->overall_tax,
				'created_at'=>date('Y-m-d H:i:s'),
			);
			$cart['items'][]=$cartItem;
		}
		
		$this->setState('cart',serialize($cart));
		return true;
	}
	
	public function getCart()
	{
		// $this->setState('cart',null);
		$cart=$this->getState('cart',null);
		if($cart!==null)
			$cart=unserialize($cart);
		
		if($cart===null)
		{
			// In this case the cart is just 
			// storage on session
			// this is headers to cart
			$cart=array(
				'id'=>null,
				'ref_venta'=>null,
				'users_id'=>null,
				// 'total'=>0,
				// 'shipping_cost'=>null,
				'shipping_data'=>null,
				'form_pol'=>null,
				'cart_states_id'=>0,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'items'=>array(),
				
				'sub_total'=>0,
				'total_tax'=>0,
				'shipping_cost'=>0,
				'shipping_id'=>0,
				'total'=>0,
			);
			
			// $this->setState('cart',serialize($cart));
		}

		$subTotal=0;

		foreach($cart['items'] as $i => $row)
		{
			$data=CActiveRecord::model($row['type'])->findByPk($row['product_id']);
			$modelFields=$this->typesAllowed[$row['type']];
			$modelId=$modelFields['id'];
			$modelUnitValue=$modelFields['unit_value'];
			$modelName=$modelFields['name'];
			$modelImage=$modelFields['image'];
			$modelDescription=$modelFields['description'];
			$modelExtra=$modelFields['extra'];	
			$subTotal+=((r('#price')->getPrice($data))*$row['quantity']);
			$cart['items'][$i]['unit_value']=r('#price')->getPrice($data);
		}
		
		$overallTax=$this->overall_tax;

		$shippingCost=$this->shipping_cost;
		
		if(!empty($cart['shipping_id']))
		{
			$shipping=CartShippingRates::model()->findByPk($cart['shipping_id']);
			if($shipping!==null)
				$shippingCost=$this->shipping_cost+$shipping->price;
		}

		$totalTax=$this->tax($overallTax,$subTotal);

		$cart['sub_total']=$subTotal;
		$cart['total_tax']=$totalTax;
		$cart['shipping_cost']=$shippingCost;
		$cart['total']=($subTotal+$totalTax+$shippingCost);

		if(!$cart['shipping_data'] instanceof CartShipmentData)
			$cart['shipping_data']=CartShipmentData::model()->findByPk($cart['shipping_data']);
		
		if(!$cart['users_id'] instanceof Users)
			$cart['users_id']=Users::model()->findByPk($cart['users_id']);
		
		$cartSave=$cart;
		$cartSave['users_id']=($cart['users_id']!==null)?$cart['users_id']->id:null;
		$cartSave['shipping_data']=($cart['shipping_data']!==null)?$cart['shipping_data']->id:null;

		$this->setState('cart',serialize($cartSave));
		return $cart;
	}

	public function getState($name,$defaultValue=null)
	{
		if($name=='cart')
		{
			if(!r('#user')->isGuest)
			{
				$model=CartShopingPending::model()->find('users_users_id=?',array(r('#user')->id));
				if($model===null)
				{
					$model=new CartShopingPending;
					$model->users_users_id=r('#user')->id;
					$model->cart=$defaultValue;
				}
				$model->save();
				return $model->cart;
			}
		}
		return null;
	}

	public function setState($name,$defaultValue=null)
	{
		if($name=='cart')
		{
			if(!r('#user')->isGuest)
			{
				$model=CartShopingPending::model()->find('users_users_id=?',array(r('#user')->id));
				if($model===null)
				{
					$model=new CartShopingPending;
					$model->users_users_id=r('#user')->id;
				}
				$model->cart=$defaultValue;
				$model->save();
				return $model->cart;
			}
		}
		return null;
	}

	public function amountID($id)
	{
		$cart=$this->getState('cart',null);
		if($cart!==null) {
			$cart=unserialize($cart);
		
			foreach($cart['items'] as $i => $row)
			{
				if($row['product_id']==$id)
					return $cart['items'][$i]['quantity'];
			}
		}
		return 0;
	}

	public function drop()
	{
		$this->setState('cart',null);
	}

	public function setShippingID($locality)
	{
		$cart=$this->getState('cart',null);
		if($cart!==null)
		{
			$cart=unserialize($cart);
			$cart['shipping_id']=$locality;
		}
		
		$this->setState('cart',serialize($cart));
	}

	public function setShippingData($ID)
	{
		$cart=$this->getState('cart',null);
		if($cart!==null)
		{
			$cart=unserialize($cart);
			$cart['shipping_data']=$ID;
		}
		
		$this->setState('cart',serialize($cart));
	}

	public function setShippingUser($ID)
	{
		$cart=$this->getState('cart',null);
		if($cart!==null)
		{
			$cart=unserialize($cart);
			$cart['users_id']=$ID;
		}
		
		$this->setState('cart',serialize($cart));
	}

	public function getCount()
	{
		$cart=$this->getState('cart',null);
		if($cart!==null)
		{
			$cart=unserialize($cart);
			return count($cart['items']);
		}
		return 0;
	}

	public function checkOwn($post)
	{
		// $model=Users::model()->find('card_identity=?',array($post['card_identity']));
		$model=Users::model()->find('email=?',array($post['email']));
		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);
		$cart['users_id']=($model!==null)?$model->id:null;
		$this->setState('cart',serialize($cart));
		return true;
	}

	public function checkOwnById($id)
	{
		// $model=Users::model()->find('card_identity=?',array($post['card_identity']));
		$model=Users::model()->findByPk($id);
		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);
		$cart['users_id']=($model!==null)?$model->id:null;
		$this->setState('cart',serialize($cart));
		return true;
	}

	public function checkData($post)
	{
		$result=true;
		$errors=array();

		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);

		if($cart===null)
			return false;

		if(($model=Users::model()->find('email=?',array($post['email'])))===null)
		{
			$model=new Users;
			$model->password=$post['email'];
			$model->registered=date('Y-m-d H:i:s');
			$model->state=1;
			$model->username=$post['email'];
		}
		
		$model->attributes=$post;
		if(($result=$model->save() and $result))
		{
			if(($data=CartShipmentData::model()->find('users_users_id=?',array($model->id)))===null)
			{
				$data=new CartShipmentData;
				$data->users_users_id=$model->id;
			}

			$data->attributes=$post;
			
			$result=($data->save() and $result);
			$errors=$data->getErrors();
			$cart['shipping_data']=$data->id;
		} 
		else
			$errors=$model->getErrors();
		
		$this->setState('cart',serialize($cart));
		if($result===false)
			return $errors;
		return $result;
	}

	public function addAndConfirm($id)
	{
		if($this->singlePay)
			$this->setState('cart',null);

		$this->addCart($id,1);
		$this->checkOwnById(Yii::app()->user->id);
		return $this->checkConfirm();
	}

	public function checkConfirm($purcharseID=null)
	{
		// $this->setState('cart',null);
		if(($shopping=$this->saveShopping($purcharseID))!==false)
		{
			if(!$this->pol_test or $shopping->user->email==$this->email_just_test)
			{
				Yii::app()->pol->test=false;
	            Yii::app()->pol->ApiKey=$this->pol_api_key;
	            Yii::app()->pol->merchantId=$this->pol_merchant_id;
			}
			
			Yii::app()->pol->responseUrl=$this->responseUrl;
            Yii::app()->pol->confirmationUrl=$this->confirmationUrl;
			
			Yii::app()->pol->currency=$this->pol_currency;
			
			Yii::app()->pol->shipmentValue=(float)$shopping->getTotalShippingCost();
			Yii::app()->pol->amount=(float)$shopping->getTotalShipping();
			Yii::app()->pol->tax=(float)$shopping->getTotalShippingTax();
			Yii::app()->pol->taxReturnBase=(float)$shopping->getTotalShippingBase();

			Yii::app()->pol->purchaseID=$shopping->id;
			Yii::app()->pol->refVenta=$shopping->ref_venta;
			Yii::app()->pol->buyerEmail=$shopping->user->email;
			Yii::app()->pol->payerFullName=$shopping->user->name;
			Yii::app()->pol->description=$this->pol_description;

			$result=Yii::app()->pol->actionPay();
			$shopping->signature=$result['signature'];
			$shopping->save(true,array('signature'));

			if(!$this->pol_test)
				$this->setState('cart',null);
			return $result;
		}
		else {
			return null;
		}
	}

	public function removeToCart($id,$type=null)
	{
		if($type===null)
		{
			$possiblesKeys=array_keys($this->typesAllowed);
			$type=$possiblesKeys[0];
		}

		$return=true;
		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);

		foreach($cart['items'] as $i => $row)
		{
			if($row['product_id']==$id and $row['type']==$type)
			{
				unset($cart['items'][$i]);
				$return=true;
			}
		}
		$this->setState('cart',serialize($cart));
		return $return;
	}

	public function updateToCart($id,$quantity,$type=null)
	{
		if($type===null)
		{
			$possiblesKeys=array_keys($this->typesAllowed);
			$type=$possiblesKeys[0];
		}

		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);

		$return=false;
		foreach($cart['items'] as $i => $row)
		{
			if($row['product_id']==$id and $row['type']==$type)
			{
				$cart['items'][$i]['quantity']=$quantity;
				$return=true;
			}
		}

		$this->setState('cart',serialize($cart));
		return $return;
	}

	public function saveShopping($purcharseID=null,$state=1,$comment='Compra sin observación del usuario')
	{
		if($purcharseID!==null)
			return CartShoppingHeader::model()->findByPk($purcharseID);

		$result=true;
		$cart=$this->getState('cart');
		if($cart!==null)
			$cart=unserialize($cart);

		$shopping=new CartShoppingHeader;
		
		// $shopping->shipping_data=null;
		// $shopping->form_pol=null;
		
		$shopping->ref_venta=time();
		$shopping->users_id=$cart['users_id'];
		$shopping->overall_tax=$this->overall_tax;
		$shopping->total=$cart['total'];
		$shopping->shipping_cost=$cart['shipping_cost'];
		$shopping->cart_states_id=$state;
		$shopping->comment=$comment;
		$shopping->datetime_go_pay=date('Y-m-d H:i:s');
		$shopping->created_at=date('Y-m-d H:i:s');
		$shopping->updated_at=date('Y-m-d H:i:s');

		if($result=$shopping->save() and $result)
		{
			$shopping->ref_venta=$this->generateRefVenta($shopping);
			$shopping->save(true,array('ref_venta'));
		
			foreach ($cart['items'] as $row) 
			{
				$modelConfig=$this->typesAllowed[$row['type']];
				$modelRelated=CActiveRecord::model($row['type'])->findByPk($row['product_id']);
		
				$modelId=$modelConfig['id'];
				$modelUnitValue=$modelConfig['unit_value'];
				$modelCurrency=(isset($modelConfig['currency']) and $modelConfig['currency']!==null)?$modelConfig['currency']:null;
				$modelTaxRate=(isset($modelConfig['tax_rate']) and $modelConfig['tax_rate']!==null)?$modelConfig['tax_rate']:null;

				$item=new CartShoppingDetail;
				$item->attributes=$row;
				$item->ref=$modelRelated->referencia_1;
				$item->codigo_ormos=$modelRelated->codigo_ormos;
				$item->description=$modelRelated->descripcion;
				$item->marca=$modelRelated->catalogoMarcas->nombre;
				$item->cart_shoping_header_id=$shopping->id;
				$item->unit_value=r('#price')->getPrice($modelRelated);
				$item->tax_rate=($modelTaxRate!==null)?$modelRelated->{$modelTaxRate}:$this->overall_tax;
				$item->currency=($modelCurrency!==null)?$modelRelated->{$modelCurrency}:$this->pol_currency;
				$item->created_at=date('Y-m-d H:i:s');
				$result=$item->save() and $result;
			}
		}
		// else
		// {
		// 	echo CJSON::encode($shopping->getErrors());
		// 	exit;
		// }
		// $shopping->ref_venta=strtoupper(string) substr(strtr(Yii::app()->name), array('.'=>'','.:'=>'',' '=>''));
		if($result)
			return $shopping;
		return $result;
	}

	public function generateRefVenta($shopping)
	{
		$siteNameLower=strtoupper(Yii::app()->format->trimAndLower(Yii::app()->name));
		$siteNameLower=strtr($siteNameLower,array(':'=>'','.'=>'','.:'=>'',':.'=>''));
		return substr($siteNameLower, 0,4).sprintf('%05d', $shopping->id);
	}

	public function getUserCart()
	{
		$cart=$this->getState('cart',null);
		if($cart!==null)
			$cart=unserialize($cart);

		if($cart===null)
			return null;
		if(isset($cart['users_id']))
			return Users::model()->findByPk($cart['users_id']);
		return null;
	}

	public function tax($porcentTax,$amount)
	{
		$tax=0;
		if($porcentTax>0)
			$tax=round(($amount*$porcentTax)/100);
		return $tax;
	}

	public function taxValue($amount,$porcentTax=null)
	{
		if($porcentTax===null)
			$porcentTax=$this->overall_tax;
		
		$tax=0;
		if($porcentTax>0)
			$tax=round(($amount*$porcentTax)/100);
		return $tax;
	}

	/*
	 * HOeee!! Do you want a multi-level menu?
	 * Here is
	*/
	public function menuItems()
	{
		return array(
            array('label'=>Yii::t('app','Cart'), 'icon'=>'fa fa-shopping-cart', 'url'=>array('#'), 'items'=>array(
			    array('label'=>Yii::t('app','Purchases List'), 'icon'=>'fa fa-money', 'url'=>array('/'.$this->id.'/purchases/admin')),
		        array('label'=>Yii::t('app','Shipping Rates'), 'icon'=>'fa fa-truck', 'url'=>array('/'.$this->id.'/rates/admin')),
        	    // array('label'=>Yii::t('app','Cart States'), 'icon'=>'fa fa-tachometer ', 'url'=>array('/'.$this->id.'/states/admin')),
            	// ... Put here more sub-menues like this 
            )),
       );
	}

	public function configItems()
	{
		return array(
	    	array('label'=>Yii::t('app','Cart'), 'icon'=>'fa fa-cogs', 'url'=>array('/'.$this->id.'/config')),
		);
	}

/*
	public function builtApp($ctr)
	{
		if(!r('#user')->isGuest)
		{
			$model=CartShopingPending::model()->find('users_users_id=?',array(r('#user')->id));
			if($model!==null)
				$model->cart;
		}
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
