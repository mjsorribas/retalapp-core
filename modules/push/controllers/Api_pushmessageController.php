<?php
/**
 * Api_pushmessageController class file.
 *
 * @author Root Root <root@email.com>
 * @link http://localhost/chat/public * @copyright 2015 Chat Software 
 * @license http://localhost/chat/public/license/
 */

/**
 * Api_pushmessageController this is a controller for response 
 * a request of this kind push/api_pushmessage.
 * and this class implement a simple Slim application just for REST use
 *
 * @author Root Root <root@email.com>
 * @package push.api_pushmessage
 * @since 1.0
 */

Yii::import('push.utils.Notifier');
Yii::import('registro.models.RegistroUsuario');

class Api_pushmessageController extends JsonController
{

	public function missingAction($actionID)
	{
		$app=new \Slim\Slim();
		$module=$this->module;

		$app->notFound(function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

		    $res
			->status(404)
            ->json($req, Yii::t('app','The resourse requested does not exist'));
			$app->stop();

		});

		$cb = function () use ($module, $app) {
		    return function() use ($module, $app) {
	        	if(!Yii::app()->user->checkToken($module->getAllowPermissoms()))
				{
					$app->response
					->status(403)
		            ->json($app->request, Yii::t('app','You do not have access to take this action'));
					$app->stop();
				}
		    };
		};

		/**
		 * This action retrive all PushMessage resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link push/api_pushmessage/
		 * @method GET
		 * @param integer(11) $id ID is integer(11) input type
		 * @param integer(11) $mobile_id_from Mobile From is integer(11) input type
		 * @param integer(11) $mobile_id_to Mobile To is integer(11) input type
		 * @param mediumtext $message Message is mediumtext input type
		 * @param time format (hh:mm:ss)stamp $date_created Date Created is time format (hh:mm:ss)stamp input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
		 *     	            "id" => "integer(11)",
		 *     	            "mobile_id_from" => "integer(11)",
		 *     	            "mobile_id_to" => "integer(11)",
		 *     	            "message" => "mediumtext",
		 *     	            "date_created" => "time format (hh:mm:ss)stamp",
		 * 		        )
		 *              ...
		 * 	       ),
		 * )</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/api_pushmessage/", function () use ($app){

	    	$req=$app->request;
			$res=$app->response;
	    	
	    	try {

	    		$model=new PushMessage('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=PushMessage::model()->arrayAll($criteria,null,array(
					'id',
					'mobile_id_from',
					'mobile_id_to',
					'message',
					'date_created',
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a PushMessage selected.
		 * 
		 * @link push/api_pushmessage/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "mobile_id_from" => "integer(11)",
		 *               "mobile_id_to" => "integer(11)",
		 *               "message" => "mediumtext",
		 *               "date_created" => "time format (hh:mm:ss)stamp",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/api_pushmessage/view/:id/:id2", function ($id,$id2) use ($app){

			$req=$app->request;
			$res=$app->response;

			try {

				//$model=PushMessage::model()->findByPk($id);
				$model=PushMessage::model()->findAll(array(
					'order'=>'id',
   					 'condition'=>'(mobile_id_from=:id2 AND mobile_id_to = :id) OR 
   					 				(mobile_id_from=:id AND mobile_id_to = :id2)',
   					 'params'=>array(':id'=>$id,':id2'=>$id2)));

				Yii::log(print_r(sizeof($model)) ,'error','cron');



				if($model===null || sizeof($model) < 0) {
					$res
					->status(404)
		            ->json($id, Yii::t('app','The resourse requested {id} does not exist or was deleted',
		            	array('{id}'=>$id)),
		            	"resource_not_found");
				} else {
					
					$res
		            ->status(200)
		            ->json($model);

					/*$res
		            ->status(200)
		            ->json($model->toArray(array(
					'id',
					'mobile_id_from',
					'mobile_id_to',
					'message',
					'date_created',
		            )));*/
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a PushMessage selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link push/api_pushmessage/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "mobile_id_from" => "integer(11)",
		 *               "mobile_id_to" => "integer(11)",
		 *               "message" => "mediumtext",
		 *               "date_created" => "time format (hh:mm:ss)stamp",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->post("/{$this->module->id}/api_pushmessage/delete/:id", $cb(), function ($id) use ($app) {

	    	$req=$app->request;
			$res=$app->response;
			
			$model=PushMessage::model()->findByPk($id);
			if($model===null) {
				$res
				->status(404)
	            ->json($id, Yii::t('app','The resourse requested {id} does not exist or was deleted',
	            	array('{id}'=>$id)),
	            	"resource_not_found");
				$app->stop();
			}

			try {
				
				$modelArray=$model->toArray(array(
					'id',
					'mobile_id_from',
					'mobile_id_to',
					'message',
					'date_created',
				));
				if($model->delete()) {
					$res
					->status(200)
		            ->json($modelArray, "Messajes ".Yii::t('app','has been deleted successfully').".");
				} else {
					$res
					->status(500)
		            ->json($modelArray, Yii::t('app','Error to database connection. Please try later').".");
				}

			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});

		/**
		 * This action is for Create a new PushMessage.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link push/api_pushmessage/create
		 * @method POST
		 * @param integer(11) $mobile_id_from Mobile From is integer(11) input type
		 * @param integer(11) $mobile_id_to Mobile To is integer(11) input type
		 * @param mediumtext $message Message is mediumtext input type
		 * @param time format (hh:mm:ss)stamp $date_created Date Created is time format (hh:mm:ss)stamp input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "mobile_id_from" => "integer(11)",
		 *               "mobile_id_to" => "integer(11)",
		 *               "message" => "mediumtext",
		 *               "date_created" => "time format (hh:mm:ss)stamp",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "mobile_id_from"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "mobile_id_to"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_pushmessage/create", function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

			try {

				//Yii::log(print_r($_FILES['message']['name'],true) ,'error','cron');


				$model=new PushMessage;
				$model->attributes=$req->params();
		
				/*$modelArray=$model->toArray(array(
					'id',
					'mobile_id_from',
					'mobile_id_to',
					'message',
					'date_created',
				));
				*/

				if (isset($_FILES['img_imagen'])) {

					$random_string_length = 10;
					$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
					$hash = '';
					 for ($i = 0; $i < $random_string_length; $i++) {
					      $hash .= $characters[rand(0, strlen($characters) - 1)];
					 }

					$uploaddir = '/var/www/html/chat/public/uploads/';
					//$uploaddir = '/home/caraquista/Proyectos/htdocs/chat/public/uploads/';

					$hash = $hash.'.'.explode('.', $_FILES['img_imagen']['name'])[1];

					$uploadfile = $uploaddir . $hash;

					move_uploaded_file($_FILES['img_imagen']['tmp_name'], $uploadfile);

					
					$model->img_imagen = $hash;

				} else {
					Yii::log('No hay imagen' ,'error','imagen');
				}


				if($model->save()) {
					
					$device = PushMobiles::model()->findByPk($model->mobile_id_to);

					$usuario = RegistroUsuario::model()->findByAttributes(array('push_id' => $model->mobile_id_from));

					//Yii::log(print_r($usuario,true) ,'error','cron');

					$sound = true;
					$badge = 1;
					$message = array('title' => $usuario->nombre,'message' => $model->message,'user_id' => $model->mobile_id_from,'user_name' => $usuario->nombre);
					//$message = array('title' => 'Notificacion Nueva','message' => $model->message,'user_id' => $model->mobile_id_from,'user_name' => $device->uuid);
					
					$respuesta = Notifier::notify($device->uuid, $device->device_type, $message, '',$sound,$badge);
					Yii::log($respuesta ,'error','cron');
					
					$modelArray=$model->toArray(array(
						'id',
						'mobile_id_from',
						'mobile_id_to',
						'message',
						'date_created',
						'img_imagen',
					));


					$res
					->status(200)
					->json($modelArray,"Messajes ".Yii::t('app','has been created successfully')."");
				} else {
					$res
					->status(422)
					->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
				}

			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});

		/**
		 * This action is for Update a PushMessage.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link push/api_pushmessage/update/{id}
		 * @method POST
		 * @param integer(11) $id ID is integer(11) input type
		 * @param integer(11) $mobile_id_from Mobile From is integer(11) input type
		 * @param integer(11) $mobile_id_to Mobile To is integer(11) input type
		 * @param mediumtext $message Message is mediumtext input type
		 * @param time format (hh:mm:ss)stamp $date_created Date Created is time format (hh:mm:ss)stamp input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "mobile_id_from" => "integer(11)",
		 *               "mobile_id_to" => "integer(11)",
		 *               "message" => "mediumtext",
		 *               "date_created" => "time format (hh:mm:ss)stamp",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "mobile_id_from"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "mobile_id_to"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_pushmessage/update/:id", $cb(), function ($id) use ($app) {
	
	    	$req=$app->request;
			$res=$app->response;
			$model=PushMessage::model()->findByPk($id);
			if($model===null) {
				$res
				->status(404)
	            ->json($id, Yii::t('app','The resourse requested {id} does not exist or was deleted',
	            	array('{id}'=>$id)),
	            	"resource_not_found");
				$app->stop();
			}

			try {

				$model->attributes=$req->params();
				$modelArray=$model->toArray(array(
					'id',
					'mobile_id_from',
					'mobile_id_to',
					'message',
					'date_created',
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"Messajes ".Yii::t('app','has been updated successfully')."");
				} else {
					$res
					->status(422)
					->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
				}

			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});

		$app->run();
	}
}