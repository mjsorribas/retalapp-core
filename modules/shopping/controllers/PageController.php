<?php

class PageController extends FrontController
{
	public $title='Shopping';
	public $subTitle='Administrar shopping';
	public $itemSelected=null;
	
	public function actionIndex($id=null)
	{
		$header=r()->user->getState('header',array());
		$shopping_categories=ShoppingCategories::model()->findAll(array('order'=>'orden_id'));
		$shopping_info=ShoppingInfo::model()->find();
		$shopping_features=ShoppingFeatures::model()->findAll(array('order'=>'orden_id'));
		$this->render('index',array(
			'shopping_categories'=>$shopping_categories,
			'header'=>$header,
			'shopping_info'=>$shopping_info,
			'shopping_features'=>$shopping_features,
			'id'=>$id,
		));
	}

	public function actionItems()
	{
		$criteria=new CDbCriteria; 
        if(isset($_GET['cat_id']) and $_GET['cat_id']!=="")
        {
            $criteria->compare('shopping_categories_id',$_GET['cat_id']);
            //$criteria->compare('description',$_GET['search'],true,'OR');
            //$criteria->compare('year',$_GET['search'],false,'OR');
        }

        $dataProvider=new CActiveDataProvider('ShoppingItems',array('criteria'=>$criteria));
		$shopping_categories=ShoppingCategories::model()->findAll(array('order'=>'orden_id'));
        
        $typeRender='render';
        if(r()->request->isAjaxRequest)
            $typeRender='renderPartial';

        $this->{$typeRender}('items',array(
            'dataProvider'=>$dataProvider,
            'shopping_categories'=>$shopping_categories,
        ));
	}

	public function actionMyitems()
	{
		if(r()->user->isGuest)
			throw new CHttpException(403,"Para ingresar a sus cursos debe estar autenticado");
		
		$criteria=new CDbCriteria; 
        if(isset($_GET['cat_id']) and $_GET['cat_id']!=="")
        {
            $criteria->compare('shopping_categories_id',$_GET['cat_id']);
            //$criteria->compare('description',$_GET['search'],true,'OR');
            //$criteria->compare('year',$_GET['search'],false,'OR');
        }
        
        $ids=array();
        $result=r()->db->createCommand('SELECT sd.shopping_items_id
        	FROM shopping_header sh 
        	INNER JOIN shopping_detail sd ON sd.shopping_header_id=sh.id
        	WHERE (sh.state=1 OR sh.state=4) AND buyer_id=?
        	')->queryAll(true,array(r()->user->id));
        // Just the shopping state 1
        foreach($result as $row) {
			$ids[]=$row['shopping_items_id'];        	
        }
        $criteria->addInCondition('id',$ids);
		$dataProvider=new CActiveDataProvider('ShoppingItems',array('criteria'=>$criteria));
		$shopping_categories=ShoppingCategories::model()->findAll(array('order'=>'orden_id'));
        
        $typeRender='render';
        if(r()->request->isAjaxRequest)
            $typeRender='renderPartial';

        $this->{$typeRender}('myitems',array(
            'dataProvider'=>$dataProvider,
            'shopping_categories'=>$shopping_categories,
        ));
	}

	public function actionMyshop()
	{
		if(r()->user->isGuest)
			throw new CHttpException(403,"Para ver sus compras debe estar autenticado");
		
		$model=new ShoppingHeader('search');
		$model->unsetAttributes();  // clear any default values
		$model->buyer_id=r()->user->id;  // clear any default values
		if(isset($_GET['ShoppingHeader']))
			$model->attributes=$_GET['ShoppingHeader'];

        $typeRender='render';
        if(r()->request->isAjaxRequest)
            $typeRender='renderPartial';

        $this->{$typeRender}('myshop',array(
            'model'=>$model,
        ));
	}

	public function actionViewmyshop($id)
	{
		if(r()->user->isGuest)
			throw new CHttpException(403,"Para ver sus compras debe estar autenticado");
		
		$model=ShoppingHeader::model()->find('id=? AND buyer_id=?',array($id,r()->user->id));
		
		$detail=new ShoppingDetail;
		$criteria=new CDbCriteria;
		$criteria->compare('shopping_header_id',$id);
		$criteria->order='orden_id';
		$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
		    "criteria"=>$criteria,
		));


		$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
		$this->{$typeRender}('viewmyshop',array(
		    'model'=>$model,
		    'detail'=>$detail,
		    'detailDataProvider'=>$detailDataProvider,
		));
	}

	public function actionView($id)
	{
		$model=ShoppingItems::model()->findByPk($id);
		$contact_contact=ContactInfo::model()->find();
		$this->render('view',array(
			'model'=>$model,
			'contact_contact'=>$contact_contact,
		));
	}

	public function actionViewUser($id)
	{
		if(r()->user->isGuest)
			throw new CHttpException(403,"Para ingresar a sus cursos debe estar autenticado");
		
		$model=ShoppingItems::model()->findByPk($id);
		$ids=array();
        $result=r()->db->createCommand('SELECT sd.shopping_items_id
        	FROM shopping_header sh 
        	INNER JOIN shopping_detail sd ON sd.shopping_header_id=sh.id
        	WHERE (sh.state=1 OR sh.state=4) AND buyer_id=?
        	')->queryAll(true,array(r()->user->id));

        // Just the shopping state 1
        foreach($result as $row) {
			$ids[]=$row['shopping_items_id'];        	
        }

		if(!in_array($id, $ids))
			throw new CHttpException(403,"Para ingresar a sus cursos debe estar autenticado. Petición inválida");
		
		$vid=($model->videos!==array())?$vid=$model->videos[0]:null;
		if(isset($_GET['v']))
			$vid=ShoppingVideos::model()->findByPk($_GET['v']);
			
		$this->render('view-user',array(
			'model'=>$model,
			'vid'=>$vid
		));
	}

	public function actionViewVideo($id)
	{

		if(r()->user->isGuest)
			echo "<span class=\"label label-danger\">Iniciar sessión</span>";
			
		$model=ShoppingView::model()->find('users_id=? and shopping_video_id=?',array(r()->user->id,$id));
		if($model===null)
			$model=new ShoppingView;
		$model->users_id=r()->user->id;
		$model->shopping_video_id=$id;
		if($model->save())
			echo "<span class=\"label label-success\">Completado</span>";
		else 
			echo "<span class=\"label label-danger\">Error en el servidor</span>";
	}

	public function actionAddToCart()
	{
		if(!empty($_REQUEST['id']) && (ShoppingItems::model()->findByPk($_REQUEST['id']))!==null) {
			
		
			$id=$_REQUEST['id'];
			$amount=(isset($_REQUEST['amount']))?$_REQUEST['amount']:1;

			$cart=r()->user->getState('cart',array());
			$isset=false;
			foreach($cart as $i => $data) {
				if($data['id']==$id) {
					if($this->module->onePerProduct) {
						$cart[$i]['amount']=$amount;
					} else {
						$cart[$i]['amount']+=$amount;
					}
					$isset=true;
					break;
				}
			}
			if(!$isset) {
				$cart[]=array('id'=>$id,'amount'=>$amount);
			}

			if(r()->user->isGuest) {
				r()->user->setState('is_loging',true);
			}
			
			r()->user->setState('cart',$cart);
			echo CJSON::encode(array(
				'success'=>1,
				'data'=>$cart,
			));
		} else {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>'El producto seleccionado no existe, es posible que haya sido eliminado recientemente',
				'data'=>$cart,
			));
		}
	}

	public function actionAddToCartFree()
	{
		if(!empty($_REQUEST['id']) && ($item=ShoppingItems::model()->findByPk($_REQUEST['id']))!==null) {
		
			if($item->free) {
				
				$model=new ShoppingHeader;
				$model->buyer_name = r()->user->name;
				$model->buyer_email = r()->user->email;
				$model->buyer_id = r()->user->id;
				$model->created_at=date('Y-m-d H:i:s');
				$model->ref_venta=time();
				$model->state=4;
				
				if($model->save()) {

					$model->ref_venta=$this->generateRefVenta($model);
					$model->save();
				
					$detail=new ShoppingDetail;
					$detail->shopping_items_id=$item->id;
					$detail->name=$item->name;
					$detail->image=$item->image;
					// $detail->image=($item->images!==array())?$item->images[0]->image:null;
					$detail->slug=$item->slug;
					$detail->description=r()->format->toBr($item->description);
					$detail->description_detail=r()->format->toBr($item->description_detail);
					$detail->price=$item->price;
					$detail->amount=1;
					$detail->state=$item->state;
					$detail->shopping_header_id=$model->id;
					$detail->shopping_categories_name=$item->shoppingCategories->name;
					$detail->orden_id=$item->orden_id;
					$detail->created_at=date('Y-m-d H:i:s');
					$detail->save();
				}
				
				// 
				echo CJSON::encode(array(
					'success'=>1,
					'data'=>array($detail->errors,$model->errors),
				));
			} else {

				echo CJSON::encode(array(
					'success'=>0,
					'message'=>'Este curso no es gratuito...',
					'data'=>null,
				));
			}

		} else {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>'El producto seleccionado no existe, es posible que haya sido eliminado recientemente',
				'data'=>$cart,
			));
		}
	}

	public function actionDeleteToCart()
	{
		if(!empty($_REQUEST['id'])) {
		
			$id=$_REQUEST['id'];

			$cart=r()->user->getState('cart',array());
			foreach($cart as $i => $data) {
				if($data['id']==$id) {
					unset($cart[$i]);
					break;
				}
			}
			r()->user->setState('cart',$cart);
			echo CJSON::encode(array(
				'success'=>1,
				'data'=>$cart,
			));
		} else {
			echo CJSON::encode(array(
				'success'=>0,
				'message'=>'El producto seleccionado no existe, es posible que haya sido eliminado recientemente',
				'data'=>$cart,
			));
		}
	}

	public function actionLoadToCart()
	{
		$this->renderPartial('_cart',array());
	}


    /**
     * Creates a new model through ajax.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *     
     *  $(document).on('submit','#shopping-header-form',function(e) {
     *    e.preventDefault();
     *    var $form = $(this);
     *    $.ajax({
     *        url: '<?php echo $this->createUrl("createAjax");?>',
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
    public function actionCreateAjax()
    {
    	// if((ShoppingHeader::model()->find('buyer_email=?',array($_REQUEST['buyer_email'])))===null) {
		$model=new ShoppingHeader;
    	if(isset($_REQUEST['delivery']) and $_REQUEST['delivery']==1)
			$model->scenario='delivery';
    	// }
        if($this->module->justBuyRegister) {
        	$model->buyer_name = r()->user->name;
        	$model->buyer_email = r()->user->email;
        	$model->buyer_id = r()->user->id;
		} else {
			$model->attributes = $_REQUEST;
		}

        $model->created_at=date('Y-m-d H:i:s');
    	$model->ref_venta=time();
    	$model->state=0;
        
		r()->user->setState('header',$_REQUEST);
    	$cart=r()->user->getState('cart',array());
        if($cart===array()) {
    		// preguntar si el carrito es mayor que cero para poder irse a pagosonline
			echo CJSON::encode(array(
            	'success'=>2,
            	'data'=>$cart,
	            'message'=>r('app','No hay productos en el carrito, Por favor selecciona los productos que deseas comprar.')
            ));
            r()->end();
        }

        // var_dump($_REQUEST);
        // exit;
        if ($model->save()) {
    		$model->ref_venta=$this->generateRefVenta($model);
			$shopping_config=ShoppingConfig::model()->find();
    		
        	if((isset($_REQUEST['delivery']) and $_REQUEST['delivery']==1) or isset($_REQUEST['delivery']) and $_REQUEST['delivery']==2) {
        		
        		$model->state=2;
        		$model->save(true,array('ref_venta','state'));

        		// preguntar si es contraentrega
				$total=$this->saveAndGetTotal($cart,$model);
				
				// eviamos aqui el tealle de la compra

				$detail=new ShoppingDetail;
				$criteria=new CDbCriteria;
				$criteria->compare('shopping_header_id',$model->id);
				$criteria->order='orden_id';
				$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
				    "criteria"=>$criteria,
				));
				$details=$this->renderPartial('_email',array(
					'model'=>$model,
					'email'=>true,
					'delivery'=>true,
					'type'=>$_REQUEST['delivery'],
					'message'=>$shopping_config->request_message,
					'detail'=>$detail,
					'detailDataProvider'=>$detailDataProvider,
				),true);
				
				$subject=($_REQUEST['delivery']==1)?Yii::t('app','[Pedido pagar contraentrega] - '):Yii::t('app','[Pedido pagar por consignación o giro] - ');
				r('email')->add(r()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
				r('email')->send($subject.' '.strip_tags(Yii::app()->name),$details);

				r('email')->add($model->buyer_email,$model->buyer_name);
				r('email')->send($subject.' '.strip_tags(Yii::app()->name),$details);

				$message=r('app','Estamos preparando tu pedido y enviaremos a uno de nuestros colaboradores a recibir el pago a la dirección suministrada como dirección del comprador.');
	            if($_REQUEST['delivery']==2)
					$message=$shopping_config->request_message;

	            echo CJSON::encode(array(
	            	'success'=>3,
	            	// 'data'=>$cart,
		            'message'=>$message,
	            ));

        	} else {
	        	
	        	// retornar el detalle de pagosonline
        		
				// if(!$this->pol_test or $shopping->user->email==$this->email_just_test)
				// {
				// 	$this->module->test=false;
				//     $this->module->ApiKey=$this->pol_api_key;
				//     $this->module->merchantId=$this->pol_merchant_id;
				// }

				// if($this->module->typePlataform==='pol') {
				// 	$this->module->test=$this->pol_test;
				//     $this->module->ApiKey=$this->pol_api_key;
				//     $this->module->merchantId=$this->pol_merchant_id;
				// }	
								
				// $this->module->currency=$this->pol_currency;
				// $this->module->shipmentValue=(float)$shopping->getTotalShippingCost();
				
        		$total=$this->saveAndGetTotal($cart,$model);
				$this->module->amount=(float)$total;
				// $this->module->tax=(float)$shopping->getTotalShippingTax();
				// $this->module->taxReturnBase=(float)$shopping->getTotalShippingBase();

				$this->module->purchaseID=$model->id;
				$this->module->refVenta=$model->ref_venta;
				$this->module->buyerEmail=$model->buyer_email;
				$this->module->payerFullName=$model->buyer_name;
				$this->module->description=$shopping_config->shopping_description;

				$result=$this->module->actionPay();
        		$model->state=0;
        		$model->save(true,array('ref_venta','state'));
				/*
				if(isset($result['signature']))
					$shopping->signature=$result['signature'];
				if(isset($result['firma']))
					$shopping->signature=$result['firma'];
					$shopping->save(true,array('signature'));
				*/

				//if(false)
				// if(!$this->pol_test)
	            
	            echo CJSON::encode(array(
	            	'success'=>1,
	            	'data'=>$result,
		            'message'=>r('app','Datos enviados')
	            ));
        	}
        
        
        } else {
            echo CJSON::encode(array(
            	'success'=>0,
            	'data'=>$model->getErrors()
        	));
        }
    }

    public function saveAndGetTotal($cart,$model)
    {
    	$total=0;
    	// crear aqui los registros de detalle
		foreach($cart as $data) {
			$item=ShoppingItems::model()->findByPk($data['id']);
			$detail=new ShoppingDetail;
			$detail->shopping_items_id=$data['id'];
			$detail->name=$item->name;
			$detail->image=$item->image;
			// $detail->image=($item->images!==array())?$item->images[0]->image:null;
			$detail->slug=$item->slug;
			$detail->description=r()->format->toBr($item->description);
			$detail->description_detail=r()->format->toBr($item->description_detail);
			$detail->price=$item->price;
			$detail->amount=$data['amount'];
			$detail->state=$item->state;
			$detail->shopping_header_id=$model->id;
			$detail->shopping_categories_name=$item->shoppingCategories->name;
			$detail->orden_id=$item->orden_id;
			$detail->created_at=date('Y-m-d H:i:s');
			$detail->save();
			$total+=$item->price*$data['amount'];
		}
		Yii::app()->user->setState('cart',null);
		return $total;
    }

	public function generateRefVenta($model)
	{
		$siteNameLower=strtoupper(Yii::app()->format->trimAndLower(Yii::app()->name));
		$siteNameLower=strtr($siteNameLower,array(':'=>'','.'=>'','.:'=>'',':.'=>''));
		return substr($siteNameLower, 0,4).sprintf('%05d', $model->id);
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
			if($this->module->typePlataform ==='payu')
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
		$model=ShoppingHeader::model()->find('ref_venta=?',array($refVenta));
		
		// here validate model
		if($model===null)
		{
			Yii::log("REF:[{$refVenta}] SHOPPING NOT FOUND POST:".CJSON::encode($_POST)." | GET:".CJSON::encode($_GET),"error","cart");
			return;
		}

		// @TODO validate signature
		if($state_pol==4)
		{
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->state=1; // aprobada

			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'state',
			));

			$detail=new ShoppingDetail;
			$criteria=new CDbCriteria;
			$criteria->compare('shopping_header_id',$model->id);
			$criteria->order='orden_id';
			$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
			    "criteria"=>$criteria,
			));
			$details=$this->renderPartial('_email',array(
				'model'=>$model,
				'email'=>true,
				'client'=>true,
				'message'=>'Su compra ha sido aprobada y su curso ha sido activado',
				'detail'=>$detail,
				'detailDataProvider'=>$detailDataProvider,
			),true);

			r('email')->add(r()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			r('email')->send(
				Yii::t('app','[Compra aprobada] Nueva compra en ').' '.strip_tags(Yii::app()->name),
				$details
			);

			r('email')->add($model->buyer_email,$model->buyer_email);
			r('email')->send(
				Yii::t('app','[Compra aprobada] ').' '.strip_tags(Yii::app()->name),
				$details
			);

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
			#$model->save(true,array("state"));
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->state=0; // pendiente
			
			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'state',
			));

			$detail=new ShoppingDetail;
			$criteria=new CDbCriteria;
			$criteria->compare('shopping_header_id',$model->id);
			$criteria->order='orden_id';
			$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
			    "criteria"=>$criteria,
			));
			$details=$this->renderPartial('_email',array(
				'model'=>$model,
				'email'=>true,
				'detail'=>$detail,
				'detailDataProvider'=>$detailDataProvider,
			),true);

			r('email')->add(r()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			r('email')->send(Yii::t('app','[Compra pendiente] Nueva compra en ').' '.strip_tags(Yii::app()->name),$details);

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
			$model->save(true,array("state"));
			$model->datetime_return_pay=date('Y-m-d H:i:s');
			$model->message_return_pay=$message;
			$model->code_response_pay=$state_pol;
			$model->code2_response_pay=$code2_response_pay;
			$model->state=3; // rechazada

			$model->save(true,array(
				'datetime_return_pay',
				'message_return_pay',
				'code_response_pay',
				'code2_response_pay',
				'state',
			));


			$detail=new ShoppingDetail;
			$criteria=new CDbCriteria;
			$criteria->compare('shopping_header_id',$model->id);
			$criteria->order='orden_id';
			$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
			    "criteria"=>$criteria,
			));
			$details=$this->renderPartial('_email',array(
				'model'=>$model,
				'email'=>true,
				'detail'=>$detail,
				'detailDataProvider'=>$detailDataProvider,
			),true);

			r('email')->add(r()->params['adminEmail'],"Admin ".strip_tags(Yii::app()->name));
			r('email')->send(Yii::t('app','[Compra rechazada] Nueva compra en ').' '.strip_tags(Yii::app()->name),$details);
			
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

		if($this->module->typePlataform ==='payu')
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