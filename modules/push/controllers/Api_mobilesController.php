<?php
/**
 * Api_mobilesController class file.
 *
 * @author Root Root <root@email.com>
 * @link http://localhost/motorola * @copyright 2014 Motorola Solutions Software 
 * @license http://localhost/motorola/license/
 */

/** 
 * Api_mobilesController this is a controller for response 
 * a request of this kind push/api_mobiles.
 * and this clas implement a simple Slim application just for REST use
 *
 * @author Root Root <root@email.com>
 * @package push.api_mobiles
 * @since 1.0
 */
class Api_mobilesController extends JsonController
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
		 * This action retrive all PushMobiles resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link push/api_mobiles/
		 * @method GET
		 * @param integer $id id is integer input type
		 * @param string $uuid uuid is string input type
		 * @param integer $device_type device_type is integer input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
		 *     	            "id" => "integer",
		 *     	            "uuid" => "string",
		 *     	            "device_type" => "integer",
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
		$app->get("/{$this->module->id}/api_mobiles/", function () use ($app){

	    	$req=$app->request;
			$res=$app->response;
	    	
	    	try {

	    		$model=new PushMobiles('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=PushMobiles::model()->arrayAll($criteria,null,array(
					'id',
					'uuid',
					'device_type',
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a PushMobiles selected.
		 * 
		 * @link push/api_mobiles/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer",
		 *               "uuid" => "string",
		 *               "device_type" => "integer",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/api_mobiles/view/:id", function ($id) use ($app){

			$req=$app->request;
			$res=$app->response;

			try {

				$model=PushMobiles::model()->findByPk($id);
				if($model===null) {
					$res
					->status(404)
		            ->json($id, Yii::t('app','The resourse requested {id} does not exist or was deleted',
		            	array('{id}'=>$id)),
		            	"resource_not_found");
				} else {
					$res
		            ->status(200)
		            ->json($model->toArray(array(
					'id',
					'uuid',
					'device_type',
		            )));
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a PushMobiles selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link push/api_mobiles/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer",
		 *               "uuid" => "string",
		 *               "device_type" => "integer",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->post("/{$this->module->id}/api_mobiles/delete/:id", $cb(), function ($id) use ($app) {

	    	$req=$app->request;
			$res=$app->response;
			
			$model=PushMobiles::model()->findByPk($id);
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
					'uuid',
					'device_type',
				));
				if($model->delete()) {
					$res
					->status(200)
		            ->json($modelArray, "Mobils ".Yii::t('app','has been deleted successfully').".");
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
		 * This action is for Create a new PushMobiles.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link push/api_mobiles/create
		 * @method POST
		 * @param string $uuid uuid is string input type
		 * @param integer $device_type device_type is integer input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer",
		 *               "uuid" => "string",
		 *               "device_type" => "integer",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "uuid"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "device_type"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_mobiles/create",  function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

			$uuid = $_POST['uuid'];

			$model=PushMobiles::model()->findByAttributes(array('uuid'=>$uuid));
			if($model===null) {
				try {
					$model=new PushMobiles;
					$model->attributes=$req->params();
			
					$modelArray=$model->toArray(array(
						'id',
						'uuid',
						'device_type',
					));
					if($model->save()) {
						$res
						->status(200)
						->json($modelArray,"Mobils ".Yii::t('app','has been created successfully')."");
					} else {
						$res
						->status(422)
						->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
					}

				} catch (Exception $e) {
		    		$res->jsonException($e);
		    	}
			}

			try {

				$model->attributes=$req->params();
				$modelArray=$model->toArray(array(
					'id',
					'uuid',
					'device_type',
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"Mobils ".Yii::t('app','has been updated successfully')."");
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
		 * This action is for Update a PushMobiles.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link push/api_mobiles/update/{id}
		 * @method POST
		 * @param integer $id id is integer input type
		 * @param string $uuid uuid is string input type
		 * @param integer $device_type device_type is integer input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer",
		 *               "uuid" => "string",
		 *               "device_type" => "integer",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "uuid"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "device_type"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_mobiles/update/:id", $cb(), function ($id) use ($app) {
	
	    	$req=$app->request;
			$res=$app->response;
			$model=PushMobiles::model()->findByPk($id);
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
					'uuid',
					'device_type',
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"Mobils ".Yii::t('app','has been updated successfully')."");
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