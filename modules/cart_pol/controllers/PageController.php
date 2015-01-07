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

		$users_location_states=UsersLocationStates::model()->findAll(array('order'=>'orden_id'));
		$users_location_cities=UsersLocationCities::model()->findAll(array('order'=>'orden_id'));
		
		$this->render('index',array(
			'config'=>$config,
			'cart'=>$cart,
			'user'=>$user,
			'model'=>$model,
			'modelConfig'=>$this->module->typesAllowed,
			'users_location_states'=>$users_location_states,
			'users_location_cities'=>$users_location_cities,
		));
	}

	public function actionCities()
	{
		$users_location_cities=UsersLocationCities::model()->findAll(array(
			'order'=>'orden_id',
			'condition'=>'users_location_states_id=?',
			'params'=>array($_REQUEST['state_id']),
		));
		echo "<option value=\"\">Ciudad</option>";
		foreach($users_location_cities as $data)
			echo "<option value=\"{$data->id}\">{$data->name}</option>";
	}

	public function actionSameData()
	{
		if($_REQUEST['same']==='true')
		{
			$model=Users::model()->findByPk(r()->user->id);
			echo CJSON::encode(array(
				'success'=>1,
				'data'=>$model
			));
		} 
		else 
		{
			echo CJSON::encode(array(
				'success'=>1,
				'data'=>null
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

	public function actionRequest()
	{
		header('Content-type: application/json');

	    if(r('#user')->isGuest)
	    {
			echo CJSON::encode(array(
				'success'=>0,
				'error_code'=>'autentication',
				'message'=>Yii::t('app','Error authentication'),
				'data'=>null,
			));
	    	r()->end();
	    }
		

	    $userData=CartShipmentData::model()->find('users_users_id=?',array(r('#user')->id));

	    if($userData===null) {
	    	$datas=new CartShipmentData;
    		$datas->users_users_id=r('#user')->id;
		} else {
	    	$datas=$userData;
	    }

    	$datas->attributes=$_REQUEST;
    	
    	if(!$datas->save())
		{
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>Yii::t('app','Error authentication'),
				'data'=>$datas->getErrors(),
			));
			r()->end();
		}

		r('cart')->setShippingData($datas->id);
		r('cart')->setShippingUser(r('#user')->id);

		if(($data=r('cart')->saveShopping(null,1,$_REQUEST['comment']))!==null)
		{
			//echo CJSON::encode(array($data));
			//exit;
			// if(isset(1) and $_REQUEST['type']==5) 
			// {
			// 	foreach($data->items as $item)
			// 	{
			// 		$catalogo=CatalogoProductos::model()->findByPk($item->product_id);
			// 		$catalogo->inventario=($catalogo->inventario-$item->quantity);
			// 		$catalogo->save(true,array('inventario'));
			// 	}
			// }

			r('cart')->drop();
			$states=CartStates::model()->findByPk(1);

			$content=$this->renderPartial('_email_request',array('shop'=>$data,'states'=>$states,'showCodigoOrmos'=>true),true);
			$params=array(
				'body'=>'<h1>['.strtoupper($states->description).']</h1>'.$content,
				'label'=>'Ver en el CMS',
				'url'=>$this->createAbsoluteUrl('/cart/purchases/view',array('id'=>$data->id)),
			);
			#r('email')->fromName=$data->user->name;
			#r('email')->fromEmail=$data->user->email;
			r('email')->add(r()->params['adminEmail'],'Admin '.strip_tags(r()->name));
			r('email')->sendBody('['.strtoupper($states->description).'] en '.strip_tags(r()->name),$params);

			$message='';
			$message=Yii::t('app','Pedido enviado exitosamente!.');

			echo CJSON::encode(array(
				'success'=>1,
				'message'=>$message,
				'data'=>$data,
				'redirect'=>$this->createUrl('/'),
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
			$calculate=$this->module->updateToCartCalculate($_POST['id'],$_POST['quantity']);
			$amountUsersHas=CartCredits::getSummaryPoints(r()->user->id);
			#echo $calculate;
			#exit;
			
			if($calculate>$amountUsersHas)
			{
				$message=Yii::t('app',"You do not have enough points for amount selected");
				$success=0;
				//$error_code='overdue';
				$error_code='none';
				echo CJSON::encode(array(
					'success'=>$success,
					'message'=>$message,
					'error_code'=>$error_code,
					'error_action'=>'none',
				));
				r()->end();
			}
			

			if($this->module->updateToCart($_POST['id'],$_POST['quantity']))
			{
				$cart=$this->module->getCart();
				$message='Carrito actualizado.';
				$success=1;
				$error_code='none';
				
				echo CJSON::encode(array(
					'success'=>$success,
					'message'=>$message,
					'error_action'=>'update',
					'error_code'=>$error_code,
					'data'=>$cart
				));
			}
			else
			{
				echo CJSON::encode(array(
					'success'=>0,
					'error_action'=>'dont_update',
					'error_code'=>'dont_update',
					'message'=>'Error al actualizar la cantidad',
					'data'=>$cart
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

	public function actionHistory()
	{
        $criteria=new CDbCriteria; 
        if(isset($_GET['search']) and $_GET['search']!=="")
        {
            $criteria->compare('id',$_GET['search'],true,'OR');
            //$criteria->compare('description',$_GET['search'],true,'OR');
            //$criteria->compare('year',$_GET['search'],false,'OR');
        }
        $criteria->order='created_at DESC';
        $criteria->compare('users_id',r()->user->id);
        
        $total = CartShoppingHeader::model()->count();

        $pages = new CPagination($total);
        $pages->pageSize = 6;
        $pages->applyLimit($criteria);

        $model = CartShoppingHeader::model()->findAll($criteria);

        $typeRender='render';
        if(r()->request->isAjaxRequest)
            $typeRender='renderPartial';
        
        $this->{$typeRender}('history',array(
            'model' => $model,
            'pages' => $pages,
        ));
	}

   /**
	*
	*	$(document).on('click','.add-to-cart',function(e){
	*
	*	    var that = $(this),
	*	      id = that.attr('data-id'),
	*	      quantity = that.parent().find(':input').val();
	*
	*	    $.ajax({
	*	      type: 'post',
	*	      dataType: 'json',
	*	      data: { 'id': id, 'quantity': quantity },
	*	      url: '<?php echo $this->createUrl("/cart/page/add")?>',
	*	      success: function (data){
	*	        if(data.success) {
	*
	*             var items = $('.total-carro').html();
	*             if(items=='') {
	*          	    items=0;
	*             }
	*             $('.total-carro').html(parseInt(items)+1);
	*
	*
	*	          bootbox.alert('Agregado Exitosamente!'+'Tu Producto aparecerá en el carrito de compras.');
	*	          //bootbox.alert('Agregado Exitosamente! '+data.message);
	*	          //bootbox.alert('Producto agregado exitosamente '+'Cantidad agregada '+amount);
	*	        } else {
	*
	*	          if(data.error_code=='logout') {
	*	            bootbox.alert('Debes autenticarte '+data.message);
	*	          } else if(data.error_code=='amount_error') {
	*	            //bootbox.alert('Cantidad solicitada No disponible. Por favor cambia la cantidad.'+data.message);
	*	            bootbox.alert('Cantidad solicitada No disponible. Por favor cambia la cantidad.'+'Si deseas una cantidad mayor, puedes solicitar una nueva oferta. \nEscríbenos a servicioalcliente@modostore.com.co');
	*	          } else if(data.error_code=='logout_root') {
	*	            bootbox.alert('Perfil no permitido para compras '+data.message);
	*	          } else {
	*	            bootbox.alert('No se cargó el producto '+data.message);
	*	          }
	*
	*	        }
	*	      }
	*		});
	*	});
	*/
	public function actionAdd()
	{
		if(r()->user->isGuest)
		{
			echo CJSON::encode(array(
				'success'=>0,
				'error_code'=>'logout',
				'message'=>Yii::t('app','Para redimir tus puntos debes estar autenticado.'),
				'data'=>null
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
			if($type===null)
			{
				$possiblesKeys=array_keys($this->module->typesAllowed);
				$type=$possiblesKeys[0];
			}
			
			$modelConfig=$this->module->typesAllowed[$type];
			$modelUnitValue=$modelConfig['unit_value'];
	
			$cart=$this->module->getCart();

			$modelRelated=CActiveRecord::model($type)->findByPk($_POST['id']);
			$pointForThis=$modelRelated->{$modelUnitValue};

			$amountCart=$cart['total'];
			$amountRequested=($quantity*$pointForThis);
			$amountUsersHas=CartCredits::getSummaryPoints(r()->user->id);
			
			$userWants=($amountCart+$amountRequested);
			if($userWants>$amountUsersHas)
			{
				echo CJSON::encode(array(
					'success'=>0,
					'error_code'=>'amount_point',
					'message'=>Yii::t('app',"You do not have enough points to order this product"),
					'data'=>$this->module->getCart()
				));
				r()->end();
			}

			if($this->module->addCart($_POST['id'],$quantity,$type))
			{
				// if($this->module->addCart($_POST['id'],$quantity,$_POST['type']))
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

    /**
     * Creates a new model through ajax.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *     
     *  $(document).on('submit','#cart-credits-form',function(e) {
     *    e.preventDefault();
     *    var $form = $(this);
     *    $.ajax({
     *        url: '<?php echo $this->createUrl("creditsAjax");?>',
     *        dataType: 'json', 
     *        type: 'post',
     *        data: $form.serialize(),
     *        success: function (data){
     *
     *          console.log(data);
     *
     *          $.each($form.serializeArray(), function(index, name) {
     *            $('[name='+name.name+']')
     *              .parent()
     *              .find('#validate-'+name.name)
     *              .remove();
     *          });
     *
     *          if(data.success) {
     *            // here submit 
     *            alert(data.message);
     *
     *          } else {
     *
     *            $.each(data.data, function(name, errors) {
     *              $('[name='+name+']')
     *              .parent()
     *              .append($('<p id="validate-'+name+'" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
     *            });
     *          }
     *        }
     *    });
     *  });
     *
    */
    public function actionCreditsAjax()
    {


        $errors=array();
        $success=array();
        if(isset($_REQUEST['secret_code']))
        {
        	foreach($_REQUEST['secret_code'] as $i => $code)
	        {
	        	$model=new CartCredits('add_points');
				$model->users_location_cities_id=$_REQUEST['users_location_cities_id'];
				$model->users_location_states_id=$_REQUEST['users_location_states_id'];
				$model->secret_code=$code;
				
				$model->users_users_id=r()->user->id;
				$model->date_transaction=date('Y-m-d');
				$model->created_at=date('Y-m-d H:i:s');
				$model->quantity=$this->module->pointsPerCode;
				$model->description=r('app','You added a valid code');
				$model->value=$this->module->pointsPerCode;
				$model->state=1;
				$model->sub=0;
				if($this->module->expiryOnDays!==null)
				{
					$date=date("Y-m-d H:i:s",strtotime("+ ".$this->module->expiryOnDays." days"));
					$model->expired_at=$date;
				}
		        if(!$model->save())
		        	$errors[$i]=$model->getErrors();
		        else
		        {
		        	// Update like used
		        	$secretCode=CartSecretCodes::model()->find('secret_code=?',array($model->secret_code));
		        	if($secretCode!==null)
		        	{
		        		$secretCode->state=0;
			        	$secretCode->save(true,array('state'));
		        	}
		        	$success[$i]=array('secret_code'=>array(r('app','Code saved!')));
		        }
			}
        }
		 
        echo CJSON::encode(array(
        	'success'=>0,
        	'datas'=>$errors,
        	'pointsPerCode'=>$this->module->pointsPerCode,
        	'ok'=>$success
    	));
    }

    public function actionSummaryPoints()
    {
    	if(r()->user->isGuest)
    		echo "0";
    	else
    		echo CartCredits::getSummaryPoints(r()->user->id);
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
	// http://localhost/project_name/public/cart/page/CronCredits
	public function actionCronCredits()
	{
		$model=Users::model()->findAll('state=1 AND state_email=1 AND trash=0');
		foreach($model as $data)
		{
			if(($cant=CartCredits::getSummaryPoints($data->id))>0)
			{
				$content="<h1>Hola {$data->name}!</h1>";
				$content.="<p>Tienes {$cant} puntos vigentes";
				$content.=" para redimirlos por grandiosos";
				$content.=" premios que solo de ofrece GASTOP</p>";
				$message=$content;
				
				$subject='Puntos disponibles en '.r()->name;
				$body=$content;
				$url=$this->createAbsoluteUrl("/premios/page/catalogo");
				$label='Ver catálogo de premios';
				r('users')->sendNotification($data->id,$message,$subject,$body,$url,$label);
			}
		}
		echo "Finish...";
	}
	// http://localhost/project_name/public/cart/page/CronCreditsToExpire
	public function actionCronCreditsToExpire()
	{
		$model=CartCredits::model()->findAll('state=1 AND DATE(expired_at)=DATE_ADD(CURDATE(), INTERVAL '.$this->module->dayForNotificationToExpire.' DAY)');
		foreach($model as $data)
		{
			if(($cant=CartCredits::getSummaryPoints($data->user->id))>0)
			{
				$content="<h1>Hola {$data->user->name}!</h1>";
				$content.="<p>Alerta!!! Tienes puntos por vencerce en ".r()->name;
				$content.=" no esperes mas para redimirlos por grandiosos";
				$content.=" premios que solo de ofrece GASTOP</p>";
				$message=$content;
				
				$subject='Puntos por vencerce en '.r()->name;
				$body=$content;
				$url=$this->createAbsoluteUrl("/premios/page/catalogo");
				$label='Ver catálogo de premios';
				r('users')->sendNotification($data->user->id,$message,$subject,$body,$url,$label);
			}
		}
		echo "Finish...";
	}
}