<?php

class PageController extends FrontController
{
	public $title='Cart';
	public $subTitle='Administrar cart';

	public function actionIndex()
	{
		$config=CartConfig::model()->find();
		$cart=$this->module->getCart();
		if(($model=$cart['shipping_data'])===null)
			$model=new CartShipmentData;
		if(($user=$cart['users_id'])===null)
			$user=new Users;

		$this->render('index',array(
			'config'=>$config,
			'cart'=>$cart,
			'user'=>$user,
			'model'=>$model,
			'modelConfig'=>$this->module->typesAllowed,
		));
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
			// echo CJSON::encode($_POST);
			// exit;
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
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	public function actionUpdate()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if($this->module->updateToCart($_POST['id'],$_POST['quantity']))
				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','OK'),'data'=>$this->module->getCart()));
			else
				echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Validation errors')));
		}
		else
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	public function actionAdd()
	{
		if(isset($_POST['id']))
		{
			$quantity=1;
			if(isset($_POST['quantity']))
				$quantity=$_POST['quantity'];

			$type=null;
			if(isset($_POST['type']))
				$type=$_POST['type'];

			if($this->module->addCart($_POST['id'],$quantity,$type))
			// if($this->module->addCart($_POST['id'],$quantity,$_POST['type']))
				echo CJSON::encode(array('success'=>1,'message'=>Yii::t('app','Add to cart successfully'),'data'=>$this->module->getCart()));
			else
				echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Validation errors'),'data'=>$this->module->errorCart));
		}
		else
			echo CJSON::encode(array('success'=>0,'message'=>Yii::t('app','Error to send parameters'),'data'=>null));
	}

	public function actionResponse()
	{
		if(file_exists(Yii::getPathOfAlias('app.config.cart').'/CartEvents.php')) {
			Yii::import('app.config.cart.CartEvents');
			if(method_exists('CartEvents','onResponse')) {
				CartEvents::onResponse($_REQUEST);
			}
		}

		/*
		 * En este caso ejecutamos el proces desde
		 * la página de respuesta solo porque
		 * pagosonline no nos puede enviar el post
		 * a la accion de confirmacion en local
		*/
		if(YII_DEBUG) {
			// public function procesarPago($refVenta,$state_pol,$signature=null,$message='',$code2_response_pay='')
			Yii::log("RESPONSE: POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
			if(Yii::app()->pol->typePlataform ==='payu')
				$this->procesarPago($_GET['referenceCode'],$_GET['transactionState'],$_REQUEST['signature'],$_REQUEST['message'],$_REQUEST['lapTransactionState']);
			else {

				$response_message_pol='Sin mensaje';

				if($_GET['estado_pol']==4){
					$response_message_pol='Transacción aprobada.';
				}
				if($_GET['estado_pol']==6 and $_GET['codigo_respuesta_pol']==5){
					$response_message_pol='Transacción Fallida';
				}
				if($_GET['estado_pol']==6 and $_GET['codigo_respuesta_pol']==4){
					$response_message_pol='Transacción Rechazada';
				}
				if($_GET['estado_pol']==6 and $_GET['codigo_respuesta_pol']==15){
					$response_message_pol='En proceso de validación';
				}
				if($_GET['estado_pol']==12 and $_GET['codigo_respuesta_pol']==9994){
					$response_message_pol='Pendiente, Por favor revisar si el débito fue realizado en el Banco';
				}
				$this->procesarPago($_GET['ref_venta'],$_GET['estado_pol'],$_GET['firma'],$response_message_pol,$response_message_pol);
			}
		}

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


		
		// here validate model
		if($model===null)
		{
			Yii::log("REF:[{$refVenta}] SHOPPING NOT FOUND POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
			return;
		}

		r('email')->add(r()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
		r('email')->sendBody(Yii::t('app','New shop on').' '.strip_tags(Yii::app()->name),array(
			'body'=>'
				<br> NAME:'.$model->user->name.' 
				<br> EMAIL:'.$model->user->email.' 
				<br> REF:'.$model->ref_venta.' 
				<br> MESSAGE:'.$message.' 
				<br> RESPONSE:'.$code2_response_pay.' 
				<br> CODE RESPONSE:'.$state_pol.' 
			',
			'url'=>$this->createAbsoluteUrl('/'.$this->module->id.'/purchases/view',array('id'=>$model->id)),
			'label'=>r('app','Details'),
		));

		// @TODO validate signature
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

			if($this->module->successCallback!==array())
				call_user_func_array($this->module->successCallback, array($model,$message));
			
			if(file_exists(Yii::getPathOfAlias('app.config.cart').'/CartEvents.php')) {
				Yii::import('app.config.cart.CartEvents');
				if(method_exists('CartEvents','successCallback')) {
					CartEvents::successCallback($model,$message);
				}
			}
			
			return;
		}
		else if($state_pol==6)
		{
			#$model->save(true,array("cart_states_id"));
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


			if($this->module->penddingCallback!==array())
				call_user_func_array($this->module->penddingCallback, array($model,$message));

			if(file_exists(Yii::getPathOfAlias('app.config.cart').'/CartEvents.php')) {
				Yii::import('app.config.cart.CartEvents');
				if(method_exists('CartEvents','penddingCallback')) {
					CartEvents::penddingCallback($model,$message);
				}
			}
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

			if($this->module->rejectCallback!==array())
				call_user_func_array($this->module->rejectCallback, array($model,$message));

			if(file_exists(Yii::getPathOfAlias('app.config.cart').'/CartEvents.php')) {
				Yii::import('app.config.cart.CartEvents');
				if(method_exists('CartEvents','rejectCallback')) {
					CartEvents::rejectCallback($model,$message);
				}
			}
		}
	}

	/**
	 * Esta acción es invocada por pagos online y
	 * no hay necesidad de renderizar datos
	 */
	public function actionConfirmation()
	{
		// public function procesarPago($refVenta,$state_pol,$signature=null,$message='',$code2_response_pay='')
	    Yii::log("CONFIRMATION: POST:".CJSON::encode($_POST),"error","cart");
   
		if(file_exists(Yii::getPathOfAlias('app.config.cart').'/CartEvents.php')) {
			Yii::import('app.config.cart.CartEvents');
			if(method_exists('CartEvents','onConfirmation')) {
				CartEvents::onConfirmation($_REQUEST);
			}
		}

		if(Yii::app()->pol->typePlataform ==='payu')
			$this->procesarPago($_POST['reference_sale'],$_POST['state_pol'],$_POST['sign'],$_POST['response_message_pol'],$_POST['response_message_pol']);
		else {

			$response_message_pol='Sin mensaje';

			if($_POST['estado_pol']==4){
				$response_message_pol='Transacción aprobada.';
			}
			if($_POST['estado_pol']==6 and $_POST['codigo_respuesta_pol']==5){
				$response_message_pol='Transacción Fallida';
			}
			if($_POST['estado_pol']==6 and $_POST['codigo_respuesta_pol']==4){
				$response_message_pol='Transacción Rechazada';
			}
			if($_POST['estado_pol']==6 and $_POST['codigo_respuesta_pol']==15){
				$response_message_pol='En proceso de validación';
			}
			if($_POST['estado_pol']==12 and $_POST['codigo_respuesta_pol']==9994){
				$response_message_pol='Pendiente, Por favor revisar si el débito fue realizado en el Banco';
			}
			$this->procesarPago($_POST['ref_venta'],$_POST['estado_pol'],$_POST['firma'],$response_message_pol,$response_message_pol);
		}
	}

}
