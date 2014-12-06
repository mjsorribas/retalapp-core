<?php
/**
 * Api_textController class file.
 *
 * @author Root Root <root@email.com>
 * @link http://localhost/retalapp-dev/public * @copyright 2014 MY APP Software 
 * @license http://localhost/retalapp-dev/public/license/
 */

/**
 * Api_textController this is a controller for response 
 * a request of this kind how_work/api_text.
 * and this class implement a simple Slim application just for REST use
 *
 * @author Root Root <root@email.com>
 * @package how_work.api_text
 * @since 1.0
 */
class Api_textController extends JsonController
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
		 * This action retrive all HowWorkText resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link how_work/api_text/
		 * @method GET
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(255) $title Title is string(255) input type
		 * @param text $text Text is text input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
		 *     	            "id" => "integer(11)",
		 *     	            "title" => "string(255)",
		 *     	            "text" => "text",
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
		$app->get("/{$this->module->id}/api_text/", function () use ($app){

	    	$req=$app->request;
			$res=$app->response;
	    	
	    	try {

	    		$model=new HowWorkText('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=HowWorkText::model()->arrayAll($criteria,null,array(
					'id',
					'title',
					'text',
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a HowWorkText selected.
		 * 
		 * @link how_work/api_text/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "title" => "string(255)",
		 *               "text" => "text",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/api_text/view/:id", function ($id) use ($app){

			$req=$app->request;
			$res=$app->response;

			try {

				$model=HowWorkText::model()->findByPk($id);
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
					'title',
					'text',
		            )));
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a HowWorkText selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link how_work/api_text/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "title" => "string(255)",
		 *               "text" => "text",
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->post("/{$this->module->id}/api_text/delete/:id", $cb(), function ($id) use ($app) {

	    	$req=$app->request;
			$res=$app->response;
			
			$model=HowWorkText::model()->findByPk($id);
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
					'title',
					'text',
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
		 * This action is for Create a new HowWorkText.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link how_work/api_text/create
		 * @method POST
		 * @param string(255) $title Title is string(255) input type
		 * @param text $text Text is text input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "title" => "string(255)",
		 *               "text" => "text",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "title"=>array(
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
		$app->post("/{$this->module->id}/api_text/create", $cb(), function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

			try {

				$model=new HowWorkText;
				$model->attributes=$req->params();
		
				$modelArray=$model->toArray(array(
					'id',
					'title',
					'text',
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
		 * This action is for Update a HowWorkText.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link how_work/api_text/update/{id}
		 * @method POST
		 * @param integer(11) $id ID is integer(11) input type
		 * @param string(255) $title Title is string(255) input type
		 * @param text $text Text is text input type
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
		 *               "id" => "integer(11)",
		 *               "title" => "string(255)",
		 *               "text" => "text",
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
		 *	     "title"=>array(
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
		$app->post("/{$this->module->id}/api_text/update/:id", $cb(), function ($id) use ($app) {
	
	    	$req=$app->request;
			$res=$app->response;
			$model=HowWorkText::model()->findByPk($id);
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
					'title',
					'text',
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