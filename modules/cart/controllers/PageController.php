<?php

class PageController extends FrontController
{
	public $title='Cart';
	public $subTitle='Administrar cart';

	public function actionIndex()
	{
		$currentLocality=null;
		$config=CartConfig::model()->find();
		$cart=$this->module->getCart();
		if(($model=$cart['shipping_data'])===null)
			$model=new CartShipmentData;
		if(($user=$cart['users_id'])===null)
			$user=new Users;
		if(!empty($cart['shipping_id']))
			$currentLocality=CartShippingRates::model()->findByPk($cart['shipping_id']);

		$rates=CartShippingRates::model()->findAll(array('order'=>'orden_id'));

		$this->render('index',array(
			'config'=>$config,
			'cart'=>$cart,
			'user'=>$user,
			'model'=>$model,
			'currentLocality'=>$currentLocality,
			'rates'=>$rates,
			'modelConfig'=>$this->module->typesAllowed,
		));
	}

	public function actionRates()
	{

		$rates=CartShippingRates::model()->findAll(array('order'=>'orden_id'));

		$this->render('rates',array(
			'rates'=>$rates,
		));
	}

	public function actionPurcharse()
	{

		/*
		TAB1
		Compras apŕobadas
		*/
		$purcharses=CartShoppingHeader::model()->findAll(array(
			'condition'=>'users_id=? AND cart_states_id=3',
			'params'=>array(r('#user')->id),
			'order'=>'created_at DESC',
			'limit'=>100,
		));

		/*
		TAB2
		Cotizaciones de envío (Mis compras pendientes)
		*/
		$pending=CartShoppingHeader::model()->findAll(array(
			'condition'=>'users_id=? AND cart_states_id=6',
			'params'=>array(r('#user')->id),
			'order'=>'created_at DESC',
			'limit'=>100,
		));


		/*
		TAB3
		Del boton hacer pedido (Mis pedidos)
		*/
		$request=CartShoppingHeader::model()->findAll(array(
			'condition'=>'users_id=? AND cart_states_id=5',
			'params'=>array(r('#user')->id),
			'order'=>'created_at DESC',
			'limit'=>100,
		));

		$this->render('purcharse',array(
			'purcharses'=>$purcharses,
			'pending'=>$pending,
			'request'=>$request,
		));
	}


	/**
	 * Displays the login page
	 */
	public function actionShopAjax()
	{
	    header('Content-type: application/json');

	    if(r('#user')->isGuest)
	    {
			echo CJSON::encode(array(
				'success'=>2,
				'message'=>Yii::t('app','Error authentication'),
				'data'=>null,
			));
	    	r()->end();
	    }

		if(($model=CartShipmentData::model()->find('users_users_id=?',array(r('#user')->id)))===null)
		{
			$model=new CartShipmentData;
			$model->users_users_id=r('#user')->id;
		}

		$model->attributes=$_REQUEST;

        if($model->save()) {

			r('cart')->setShippingData($model->id);
			r('cart')->setShippingUser($model->users_users_id);

			if(($data=r('cart')->checkConfirm())!==null)
				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','Entrando a la pasarela de pagos'),'data'=>$data));
			else
				echo CJSON::encode(array('success'=>2,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));

        } else {

            echo CJSON::encode(array(
                'success'=>0,
                'data'=>$model->getErrors(),
                'error_code'=>'unprocessable_entity',
                'message'=>Yii::t('app','Form validation errors'),
                'params'=>$_REQUEST,
            ));
        }
	}

	/**
	 * Displays the login page
	 */
	public function actionShopIdAjax()
	{
	    header('Content-type: application/json');

	    if(r('#user')->isGuest)
	    {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error authentication'),
				'data'=>null,
			));
	    	r()->end();
	    }


		if(($data=r('cart')->checkConfirm($_REQUEST['purcharse_id']))!==null)
		{
			echo CJSON::encode(array(
				'success'=>1,
				'message'=>Yii::t('app','Entrando a la pasarela de pagos'),
				'data'=>$data,
			));
		}
		else
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null,
			));
		}

	}

	/**
	 * Displays the login page
	 */
	public function actionRequestAjax()
	{
	    header('Content-type: application/json');

	    if(r('#user')->isGuest)
	    {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error authentication'),
				'data'=>null,
			));
	    	r()->end();
	    }

	    $userData=Users::model()->findByPk(r('#user')->id);

	    if($userData->data===null) {
	    	$datas=new CartShipmentData;;
		} else {
	    	$datas=$userData->data;
	    }

    	$datas->users_users_id=$userData->id;
    	$datas->users_city_delivery_id=$_REQUEST['locality_request'];
    	$datas->address_delivery=$_REQUEST['address_delivery_request'];
    	$datas->contact_receiving=$userData->name;
    	$datas->contact_phone=$userData->phone;
    	$datas->comment=$_REQUEST['comment'];
    	$datas->deliver_same_address=1;
    	$datas->contact_mobile=$userData->phone;
    	$datas->contact_id=$userData->card_identity;
    	$datas->save();

		r('cart')->setShippingData($datas->id);
		r('cart')->setShippingUser(r('#user')->id);

		if(($data=r('cart')->saveShopping(null,$_REQUEST['type'],$_REQUEST['comment']))!==null)
		{
			r('cart')->drop();
			$states=CartStates::model()->findByPk($_REQUEST['type']);

			$content=$this->renderPartial('_email_request',array('shop'=>$data,'states'=>$states,'showCodigoOrmos'=>true),true);
			$params=array(
				'body'=>'<h1>['.strtoupper($states->description).']</h1>'.$content,
				'label'=>'Ver en el CMS',
				'url'=>$this->createAbsoluteUrl('/cart/purchases/view',array('id'=>$data->id)),
			);
			#Yii::app()->email->fromName=$data->user->name;
			#Yii::app()->email->fromEmail=$data->user->email;
			Yii::app()->email->add(r()->params['adminEmail'],'Admin '.strip_tags(r()->name));
			Yii::app()->email->sendBody('['.strtoupper($states->description).'] en '.strip_tags(r()->name),$params);

			$message='';
			if(isset($_REQUEST['type']) and $_REQUEST['type']==5) {
				$message=Yii::t('app','Pedido enviado, pronto recibirás tu pedido');
			} else {
				$message=Yii::t('app','Cotización enviada, pronto recibirás tu cotización');
			}

			echo CJSON::encode(array(
				'success'=>1,
				'message'=>$message,
				'data'=>$data,
			));
		}
		else
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null,
			));
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionShopRemoveAjax()
	{
	    header('Content-type: application/json');

	    if(r('#user')->isGuest)
	    {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error authentication'),
				'data'=>null,
			));
	    	r()->end();
	    }

	    $model=CartShoppingHeader::model()->findByPk($_REQUEST['purcharse_id']);

		if($model->delete())
		{
			echo CJSON::encode(array(
				'success'=>1,
				'message'=>Yii::t('app','Compra o pedido eliminado'),
				'data'=>$model,
			));
		}
		else
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null,
			));
		}

	}

	public function actionStep2()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if($this->module->checkOwn($_POST))
			{
				$cart=$this->module->getCart();
				$delivery=null;
				if($cart['users_id']!==null)
					$delivery=CartShipmentData::model()->find('users_users_id=?',array($cart['users_id']->id));

				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','OK'),'data'=>$cart,'delivery'=>$delivery));
			}
			else
				echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Validation errors')));
		}
		else
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	public function actionStep3()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if(($result=$this->module->checkData($_POST))===true)
				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','OK'),'data'=>$this->module->getCart()));
			else
				echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Validation errors'),'data'=>$result));
		}
		else
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	// Here is lets go to create a ref shopping
	public function actionConfirm()
	{
		if(($data=$this->module->checkConfirm())!==null)
			echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','Entrando a la pasarela de pagos'),'data'=>$data));
		else
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	public function actionRemove()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if($this->module->removeToCart($_POST['id']))
				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','OK'),'data'=>$this->module->getCart()));
			else
				echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Validation errors')));
		}
		else
		{

			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null
			));
		}
	}

	public function actionUpdate()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$amount=CatalogoProductos::model()->findByPk($_POST['id']);
			$available=$amount->inventario;
			if($available<=0 or $available<$_POST['quantity'])
			{
				$message='Las unidades disponibles para este producto son <strong>'.$amount->inventario.'</strong>';
				echo CJSON::encode(array(
					'success'=>0,
					'error_code'=>'amount_error',
					'message'=>$message,
					'data'=>null
				));
				r()->end();
			}

			if($this->module->updateToCart($_POST['id'],$_POST['quantity']))
			{
				$result=$this->module->getCart();
				echo CJSON::encode(array(
					'success'=>1,
					'message'=>Yii::t('app','OK'),
					'data'=>$result
				));
			}
			else
			{
				echo CJSON::encode(array(
					'success'=>0,
					'message'=>Yii::t('app','Validation errors')
				));
			}
		}
		else
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null
			));
		}
	}

	public function actionAdd()
	{
		header('Content-type:application/json');

		if(r('#user')->isGuest)
		{
			echo CJSON::encode(array(
				'success'=>0,
				'error_code'=>'logout',
				'message'=>Yii::t('app','Inicio de sessión es necesario'),
				'data'=>$this->module->errorCart
			));
			r()->end();
		}

		if(r('#user')->check('admin','root'))
		{
			echo CJSON::encode(array(
				'success'=>0,
				'error_code'=>'logout_root',
				'message'=>Yii::t('app','Usted esta logueado como administrador, no tiene los roles permitodos para hacer compras'),
				'data'=>$this->module->errorCart
			));
			r()->end();
		}

		if(isset($_POST['id']))
		{
			$quantity=1;
			if(isset($_POST['quantity']))
				$quantity=$_POST['quantity'];

			$type=null;
			if(isset($_POST['type']))
				$type=$_POST['type'];

			$amount=CatalogoProductos::model()->findByPk($_POST['id']);

			$onCart=r('cart')->amountID($_POST['id']);
			$available=$amount->inventario-$onCart;

			if($available<=0 or $available<$_POST['quantity'])
			{
				$message='Las unidades disponibles para este producto son <strong>'.$amount->inventario.'</strong>';
				if($onCart>0)
					$message.=' y en el carrito de compras hay '.$onCart;

				echo CJSON::encode(array(
					'success'=>0,
					'error_code'=>'amount_error',
					'message'=>$message,
					'data'=>null
				));
				r()->end();
			}

			if($this->module->addCart($_POST['id'],$quantity,$type))
			{
				echo CJSON::encode(array(
					'success'=>1,
					'message'=>Yii::t('app','Add to cart successfully'),
					'data'=>$this->module->getCart()
				));
			}
			else
			{
				echo CJSON::encode(array(
					'success'=>0,
					'message'=>Yii::t('app','Validation errors'),
					'data'=>$this->module->errorCart
				));
			}
		}
		else
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error to send parameters'),
				'data'=>null
			));
		}
	}

	public function actionValidateLocality()
	{
		header('Content-type:application/json');

		$locality=1;
		if(isset($_REQUEST['locality']))
			$locality=$_REQUEST['locality'];

		$this->module->setShippingID($locality);
		$cart = $this->module->getCart();

		$result=array();
		$result['price_format'] = "$".r('#format')->money($cart['shipping_cost']);
		$result['price'] = $cart['shipping_cost'];
		$result['total'] = "$".r('#format')->money($cart['total']);

		echo CJSON::encode(array(
			'success'=>1,
			'message'=>Yii::t('app','Operation successfully'),
			'data'=>$result,
		));
	}

	public function actionResponse()
	{
		/*
		 * En este caso ejecutamos el proces desde
		 * la página de respuesta solo porque
		 * pagosonline no nos puede enviar el post
		 * a la accion de confirmacion en local
		*/
		if(YII_DEBUG)
			$this->procesarPago($_GET['referenceCode'],$_GET['transactionState'],$_REQUEST['signature'],$_REQUEST['message'],$_REQUEST['lapTransactionState']);

		if($this->module->redirectResponse!==null)
			$this->redirect(CHtml::normalizeUrl(array($this->module->redirectResponse))."?".http_build_query($_REQUEST));
		$this->render("response");
	}

	public function actionTest()
	{
		$this->procesarPago($_GET['referenceCode'],$_GET['transactionState'],$_REQUEST['signature']);
	}

	public function procesarPago($refVenta,$state_pol,$signature=null,$message='',$code2_response_pay='')
	{
		$model=CartShoppingHeader::model()->find('ref_venta=?',array($refVenta));
		// echo CJSON::encode(array($model,$_REQUEST));
		// exit;
		// here validate model
		if($model===null)
		{
			Yii::log("REF:[{$refVenta}] SHOPPING NOT FOUND POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
			return;
		}

		// $ApiKey=Yii::app()->pol->ApiKey;/////llave de usuario de pruebas 2 6u39nqhq8ftd0hlvnjfs66eh8c
		// $merchant_id=isset($_GET['merchantId'])?$_GET['merchantId']:@$_POST['merchant_id'];
		// $referenceCode=isset($_GET['referenceCode'])?$_GET['referenceCode']:@$_POST['reference_sale'];
		// $TX_VALUE=$_GET['TX_VALUE'];
		// $New_value=number_format($TX_VALUE, 1, '.', '');
		// $currency=$_GET['currency'];
		// $transactionState=$_GET['transactionState'];
		// $firma_cadena= "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
		// $firmacreada = md5($firma_cadena);//firma que generaron ustedes
		// $firma =$_GET['signature'];//firma que envía nuestro sistema

		// if($firmacreada!=$firma)
		// {
		// 	Yii::log("REF:[{$refVenta}] SIGNARURE IS WRONG POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
		// 	return;
		// }

		if($state_pol==4)
		{
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->cart_states_id=3; // aprobada

			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'cart_states_id',
			));
			Yii::log("REF:[{$refVenta}] PAY SUCCESSFULLY :".CJSON::encode($model),"trace","cart");

			foreach($model->items as $data)
			{
				$catalogo=CatalogoProductos::model()->findByPk($data->product_id);
				$catalogo->inventario=($catalogo->inventario-$data->quantity);
				$catalogo->save(true,array('inventario'));
			}

			$content=$this->renderPartial('_email_request',array('shop'=>$model,'states'=>null,'showCodigoOrmos'=>true),true);
			Yii::app()->email->add(Yii::app()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			Yii::app()->email->sendBody(Yii::t('app','New shop on').' '.strip_tags(Yii::app()->name),array(
				'body'=>Yii::t('app','There is a new shop on').' '.strip_tags(Yii::app()->name).' <br>'.$content,
				'url'=>$this->createAbsoluteUrl('/'.$this->module->id.'/purchases/view',array('id'=>$model->id)),
				'label'=>'Ver compra',
			));
			
			$content=$this->renderPartial('_email_request',array('shop'=>$model,'states'=>null),true);
			Yii::app()->email->add($model->user->email,$model->user->name." ".$model->user->lastname);
			Yii::app()->email->sendBody(Yii::t('app','Confirmación de compra').' '.strip_tags(Yii::app()->name),array(
				'body'=>$content,
				'url'=>$this->createAbsoluteUrl('/'.$this->module->id.'/page/purcharse'),
				'label'=>'Ir al sitio',
			));
			return;
		}
		else if($state_pol==6)
		{
			$model->save(true,array("cart_states_id"));
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->cart_states_id=4; // pendiente

			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'cart_states_id',
			));
			Yii::log("REF:[{$refVenta}] PAY PENDING :".CJSON::encode($model),"warning","cart");

			Yii::app()->email->add(Yii::app()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			Yii::app()->email->sendBody(Yii::t('app','New shop on').' '.strip_tags(Yii::app()->name),array(
				'body'=>Yii::t('app','There is a new shop on').' '.strip_tags(Yii::app()->name),
				'url'=>$this->createAbsoluteUrl('/'.$this->module->id.'/purchases/view',array('id'=>$model->id)),
				'label'=>'Ver compra',
			));
		}
		else
		{
			$model->save(true,array("cart_states_id"));
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->cart_states_id=2; // rechazada

			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'cart_states_id',
			));

			Yii::log("REF:[{$refVenta}] PAY REJECT :".CJSON::encode($model),"error","cart");
			Yii::app()->email->add(Yii::app()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			Yii::app()->email->sendBody(Yii::t('app','New shop on').' '.strip_tags(Yii::app()->name),array(
				'body'=>Yii::t('app','There is a new shop on').' '.strip_tags(Yii::app()->name),
				'url'=>$this->createAbsoluteUrl('/'.$this->module->id.'/purchases/view',array('id'=>$model->id)),
				'label'=>'Ver compra',
			));
		}
	}

	/**
	 * Esta acción es invocada por pagos online y
	 * no hay necesidad de renderizar datos
	 */
	public function actionConfirmation()
	{
		// public function procesarPago($refVenta,$state_pol,$signature=null,$message='',$code2_response_pay='')
		// Yii::log("RESPONSE: POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
		$this->procesarPago($_POST['reference_sale'],$_POST['state_pol'],$_POST['sign'],$_POST['response_message_pol'],$_POST['response_message_pol']);
	}

}
