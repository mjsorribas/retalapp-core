<?php
/**
 * Api_itemsController class file.
 *
 * @author Root Root <root@email.com>
 * @link http://localhost/retalapp-dev/public * @copyright 2014 MY APP Software 
 * @license http://localhost/retalapp-dev/public/license/
 */

/**
 * Api_itemsController this is a controller for response 
 * a request of this kind how_work/api_items.
 * and this class implement a simple Slim application just for REST use
 *
 * @author Root Root <root@email.com>
 * @package how_work.api_items
 * @since 1.0
 */
class Api_itemsController extends JsonController
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
		 * This action retrive all HowWorkItems resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link how_work/api_items/
		 * @method GET
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(255) $label Label is string(255) input type
		 * @param text $text Text is text input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
		 *     	            "id" => "integer(11)",
		 *     	            "label" => "string(255)",
		 *     	            "text" => "text",
		 *     	            "orden_id" => "integer(11)",
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
		$app->get("/{$this->module->id}/api_items/", function () use ($app){

	    	$req=$app->request;
			$res=$app->response;
	    	
	    	try {

	    		$model=new HowWorkItems('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=HowWorkItems::model()->arrayAll($criteria,null,array(
					'id',
					'label',
					'text',
					'orden_id',
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a HowWorkItems selected.
		 * 
		 * @link how_work/api_items/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "label" => "string(255)",
		 *               "text" => "text",
		 *               "orden_id" => "integer(11)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/api_items/view/:id", function ($id) use ($app){

			$req=$app->request;
			$res=$app->response;

			try {

				$model=HowWorkItems::model()->findByPk($id);
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
					'label',
					'text',
					'orden_id',
		            )));
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a HowWorkItems selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link how_work/api_items/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "label" => "string(255)",
		 *               "text" => "text",
		 *               "orden_id" => "integer(11)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->post("/{$this->module->id}/api_items/delete/:id", $cb(), function ($id) use ($app) {

	    	$req=$app->request;
			$res=$app->response;
			
			$model=HowWorkItems::model()->findByPk($id);
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
					'label',
					'text',
					'orden_id',
				));
				if($model->delete()) {
					$res
					->status(200)
		            ->json($modelArray, "API ".Yii::t('app','has been deleted successfully').".");
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
		 * This action is for Create a new HowWorkItems.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link how_work/api_items/create
		 * @method POST
		 * @param string(255) $label Label is string(255) input type
		 * @param text $text Text is text input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "label" => "string(255)",
		 *               "text" => "text",
		 *               "orden_id" => "integer(11)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "label"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "text"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_items/create", $cb(), function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

			try {

				$model=new HowWorkItems;
				$model->attributes=$req->params();
				$last=HowWorkItems::model()->findAll();
				$model->orden_id=count($last)+1;
		
				$modelArray=$model->toArray(array(
					'id',
					'label',
					'text',
					'orden_id',
				));
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"API ".Yii::t('app','has been created successfully')."");
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
		 * This action is for Update a HowWorkItems.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link how_work/api_items/update/{id}
		 * @method POST
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(255) $label Label is string(255) input type
		 * @param text $text Text is text input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "label" => "string(255)",
		 *               "text" => "text",
		 *               "orden_id" => "integer(11)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "label"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "text"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/api_items/update/:id", $cb(), function ($id) use ($app) {
	
	    	$req=$app->request;
			$res=$app->response;
			$model=HowWorkItems::model()->findByPk($id);
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
					'label',
					'text',
					'orden_id',
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"API ".Yii::t('app','has been updated successfully')."");
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