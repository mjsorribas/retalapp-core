<?php
/**
 * Api_itemsController class file.
 *
 * @author Root Root <root@email.com>
 * @link http://localhost/www.escueladefinanzasynegocios.com/public * @copyright 2015 Escuela Software 
 * @license http://localhost/www.escueladefinanzasynegocios.com/public/license/
 */

/**
 * Api_itemsController this is a controller for response 
 * a request of this kind shopping/api_items.
 * and this class implement a simple Slim application just for REST use
 *
 * @author Root Root <root@email.com>
 * @package shopping.api_items
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
		 * This action retrive all ShoppingItems resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link shopping/api_items/
		 * @method GET
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(100) $image Imagen is string(100) input type
		 * @param string(100) $video_promocional Promocional is string(100) input type
		 * @param string(60) $name Nombre is string(60) input type
		 * @param string(255) $slug Slug is string(255) input type
		 * @param text $description Descripción corta is text input type
		 * @param text $description_detail Descripción is text input type
		 * @param float(9,2) $price Precio is float(9,2) input type
		 * @param boolean(1) $free Es gratis is boolean(1) input type
		 * @param boolean(1) $state Estado is boolean(1) input type
		 * @param integer(11) $shopping_categories_id Categoría is integer(11) input type
		 * @param text $temas_relacionados Temas Relacionados is text input type
		 * @param integer(11) $shopping_facilitador_id Facilitador is integer(11) input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @param datetime format (yyyy-MM-dd hh:mm:ss) $created_at Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
		 *     	            "id" => "integer(11)",
		 *     	            "image" => "string(100)",
		 *     	            "video_promocional" => "string(100)",
		 *     	            "name" => "string(60)",
		 *     	            "slug" => "string(255)",
		 *     	            "description" => "text",
		 *     	            "description_detail" => "text",
		 *     	            "price" => "float(9,2)",
		 *     	            "free" => "boolean(1)",
		 *     	            "state" => "boolean(1)",
		 *     	            "shopping_categories_id" => "integer(11)",
		 *     	            "temas_relacionados" => "text",
		 *     	            "shopping_facilitador_id" => "integer(11)",
		 *     	            "orden_id" => "integer(11)",
		 *     	            "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
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

	    		$model=new ShoppingItems('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=ShoppingItems::model()->arrayAll($criteria,null,array(
					'id',
					'image',
					'image_path',
					'video_promocional',
					'name',
					'slug',
					'description',
					'description_detail',
					'price',
					'free',
					'state',
					'shopping_categories_id',
					'temas_relacionados',
					'shopping_facilitador_id',
					'orden_id',
					'created_at',
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a ShoppingItems selected.
		 * 
		 * @link shopping/api_items/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "image" => "string(100)",
		 *               "video_promocional" => "string(100)",
		 *               "name" => "string(60)",
		 *               "slug" => "string(255)",
		 *               "description" => "text",
		 *               "description_detail" => "text",
		 *               "price" => "float(9,2)",
		 *               "free" => "boolean(1)",
		 *               "state" => "boolean(1)",
		 *               "shopping_categories_id" => "integer(11)",
		 *               "temas_relacionados" => "text",
		 *               "shopping_facilitador_id" => "integer(11)",
		 *               "orden_id" => "integer(11)",
		 *               "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
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

				$model=ShoppingItems::model()->findByPk($id);
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
					'image',
					'image_path',
					'video_promocional',
					'name',
					'slug',
					'description',
					'description_detail',
					'price',
					'free',
					'state',
					'shopping_categories_id',
					'temas_relacionados',
					'shopping_facilitador_id',
					'orden_id',
					'created_at',
		            )));
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a ShoppingItems selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link shopping/api_items/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "image" => "string(100)",
		 *               "video_promocional" => "string(100)",
		 *               "name" => "string(60)",
		 *               "slug" => "string(255)",
		 *               "description" => "text",
		 *               "description_detail" => "text",
		 *               "price" => "float(9,2)",
		 *               "free" => "boolean(1)",
		 *               "state" => "boolean(1)",
		 *               "shopping_categories_id" => "integer(11)",
		 *               "temas_relacionados" => "text",
		 *               "shopping_facilitador_id" => "integer(11)",
		 *               "orden_id" => "integer(11)",
		 *               "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
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
			
			$model=ShoppingItems::model()->findByPk($id);
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
					'image',
					'image_path',
					'video_promocional',
					'name',
					'slug',
					'description',
					'description_detail',
					'price',
					'free',
					'state',
					'shopping_categories_id',
					'temas_relacionados',
					'shopping_facilitador_id',
					'orden_id',
					'created_at',
				));
				if($model->delete()) {
					$res
					->status(200)
		            ->json($modelArray, "Productos ".Yii::t('app','has been deleted successfully').".");
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
		 * This action is for Create a new ShoppingItems.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link shopping/api_items/create
		 * @method POST
		 * @param string(100) $image Imagen is string(100) input type
		 * @param string(100) $video_promocional Promocional is string(100) input type
		 * @param string(60) $name Nombre is string(60) input type
		 * @param string(255) $slug Slug is string(255) input type
		 * @param text $description Descripción corta is text input type
		 * @param text $description_detail Descripción is text input type
		 * @param float(9,2) $price Precio is float(9,2) input type
		 * @param boolean(1) $free Es gratis is boolean(1) input type
		 * @param boolean(1) $state Estado is boolean(1) input type
		 * @param integer(11) $shopping_categories_id Categoría is integer(11) input type
		 * @param text $temas_relacionados Temas Relacionados is text input type
		 * @param integer(11) $shopping_facilitador_id Facilitador is integer(11) input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @param datetime format (yyyy-MM-dd hh:mm:ss) $created_at Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "image" => "string(100)",
		 *               "video_promocional" => "string(100)",
		 *               "name" => "string(60)",
		 *               "slug" => "string(255)",
		 *               "description" => "text",
		 *               "description_detail" => "text",
		 *               "price" => "float(9,2)",
		 *               "free" => "boolean(1)",
		 *               "state" => "boolean(1)",
		 *               "shopping_categories_id" => "integer(11)",
		 *               "temas_relacionados" => "text",
		 *               "shopping_facilitador_id" => "integer(11)",
		 *               "orden_id" => "integer(11)",
		 *               "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "image"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "video_promocional"=>array(
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

				$model=new ShoppingItems;
				$model->attributes=$req->params();
				// In oreder to create chronologically asc 
				//$last=ShoppingItems::model()->findAll();
				//$model->orden_id=count($last)+1;
				// In oreder to create chronologically desc 
				$last=ShoppingItems::model()->findAll(array('order'=>'orden_id'));
				$i=2;
				foreach($last as $data)
				{
					$data->orden_id=$i++;
					$data->save(true,array('orden_id'));
				}
				$model->orden_id=1;
				$model->created_at=date('Y-m-d H:i:s');
		
				$modelArray=$model->toArray(array(
					'id',
					'image',
					'image_path',
					'video_promocional',
					'name',
					'slug',
					'description',
					'description_detail',
					'price',
					'free',
					'state',
					'shopping_categories_id',
					'temas_relacionados',
					'shopping_facilitador_id',
					'orden_id',
					'created_at',
				));
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"Productos ".Yii::t('app','has been created successfully')."");
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
		 * This action is for Update a ShoppingItems.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link shopping/api_items/update/{id}
		 * @method POST
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(100) $image Imagen is string(100) input type
		 * @param string(100) $video_promocional Promocional is string(100) input type
		 * @param string(60) $name Nombre is string(60) input type
		 * @param string(255) $slug Slug is string(255) input type
		 * @param text $description Descripción corta is text input type
		 * @param text $description_detail Descripción is text input type
		 * @param float(9,2) $price Precio is float(9,2) input type
		 * @param boolean(1) $free Es gratis is boolean(1) input type
		 * @param boolean(1) $state Estado is boolean(1) input type
		 * @param integer(11) $shopping_categories_id Categoría is integer(11) input type
		 * @param text $temas_relacionados Temas Relacionados is text input type
		 * @param integer(11) $shopping_facilitador_id Facilitador is integer(11) input type
		 * @param integer(11) $orden_id Orden is integer(11) input type
		 * @param datetime format (yyyy-MM-dd hh:mm:ss) $created_at Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "image" => "string(100)",
		 *               "video_promocional" => "string(100)",
		 *               "name" => "string(60)",
		 *               "slug" => "string(255)",
		 *               "description" => "text",
		 *               "description_detail" => "text",
		 *               "price" => "float(9,2)",
		 *               "free" => "boolean(1)",
		 *               "state" => "boolean(1)",
		 *               "shopping_categories_id" => "integer(11)",
		 *               "temas_relacionados" => "text",
		 *               "shopping_facilitador_id" => "integer(11)",
		 *               "orden_id" => "integer(11)",
		 *               "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "image"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
		 *	     "video_promocional"=>array(
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
			$model=ShoppingItems::model()->findByPk($id);
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
				$model->created_at=date('Y-m-d H:i:s');
				$modelArray=$model->toArray(array(
					'id',
					'image',
					'image_path',
					'video_promocional',
					'name',
					'slug',
					'description',
					'description_detail',
					'price',
					'free',
					'state',
					'shopping_categories_id',
					'temas_relacionados',
					'shopping_facilitador_id',
					'orden_id',
					'created_at',
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"Productos ".Yii::t('app','has been updated successfully')."");
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