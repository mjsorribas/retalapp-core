<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$module=Yii::app()->getModule('gii');
?>
<?php echo "<?php\n"; ?>
require Yii::getPathOfAlias('ext.components.api').'/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
/**
 * <?php echo $this->controllerClass; ?> class file.
 *
 * @author <?php echo Yii::app()->user->name?> <<?php echo Yii::app()->user->email?>>
 * @link <?php echo Yii::app()->request->getBaseUrl(true)?>
 * @copyright <?php echo date('Y')?> <?php echo Yii::app()->name?> Software 
 * @license <?php echo Yii::app()->request->getBaseUrl(true)?>/license/
 */

/**
 * <?php echo $this->controllerClass; ?> this is a controller for response 
 * a request of this kind <?php echo $this->controller?>.
 * and this class implement a simple Slim application just for REST use
 *
 * @author <?php echo Yii::app()->user->name?> <<?php echo Yii::app()->user->email?>>
 * @package <?php echo strtr($this->controller,array('/'=>'.'))."\n"?>
 * @since 1.0
 */
class <?php echo $this->controllerClass; ?> extends JsonController
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
		 * This action retrive all <?php echo $this->modelClass; ?> resources, 
		 * you can also filter according to sended params.
		 * 
		 * @link <?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/
		 * @method GET
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
		 * @param <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> $<?php echo $column->name?> <?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type
<?php endforeach;?>
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 * 	        "status"=>200,
		 * 	        "success"=>true,
		 * 	        "message"=>"Some summary message",
		 * 	        "data"=>array(
		 * 	            array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		 *     	            "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
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
		$app->get("/{$this->module->id}/<?php echo strtr($this->controller,array($this->moduleName.'/'=>'')); ?>/", function () use ($app){

	    	$req=$app->request;
			$res=$app->response;
	    	
	    	try {

	    		$model=new <?php echo $this->modelClass; ?>('search');
				$model->unsetAttributes();  // clear any default values
				$model->attributes=$app->request->params();
				$criteria=$model->search()->getCriteria();
				
				$data=<?php echo $this->modelClass; ?>::model()->arrayAll($criteria,null,array(
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='password')
		continue;

	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_path',\n";
	}
	elseif($tangaColumn['type']==='cms')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_html',\n";
	}
	else
		echo "\t\t\t\t\t'{$column->name}',\n";
}
?>
				));
	            $res->status(200)
	            ->json($data);

	    	} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
	    });

		/**
		 * This action retrive a <?php echo $this->modelClass; ?> selected.
		 * 
		 * @link <?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/view/{id}
		 * @method GET
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		 *               "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->get("/{$this->module->id}/<?php echo strtr($this->controller,array($this->moduleName.'/'=>'')); ?>/view/:id", function ($id) use ($app){

			$req=$app->request;
			$res=$app->response;

			try {

				$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
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
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='password')
		continue;

	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_path',\n";
	}
	elseif($tangaColumn['type']==='cms')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_html',\n";
	}
	else
		echo "\t\t\t\t\t'{$column->name}',\n";
}
?>
		            )));
				}
			
			} catch (Exception $e) {
	    		$res->jsonException($e);
	    	}
		});
		
		/**
		 * This action Delete a <?php echo $this->modelClass; ?> selected.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link <?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/delete/{id}
		 * @method POST
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		 *               "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
		 *	))</code>
		 * error_response
		 * <code>array(
		 * 	    "success"=> false,
		 * 	    "status"=> 404,
		 * 	    "error"=> "A key (e.g. resource_not_found) for the error",
		 * 	    "message"=> "A longer description of the error."
		 * 	)</code>
		*/
		$app->post("/{$this->module->id}/<?php echo strtr($this->controller,array($this->moduleName.'/'=>'')); ?>/delete/:id", $cb(), function ($id) use ($app) {

	    	$req=$app->request;
			$res=$app->response;
			
			$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
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
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='password')
		continue;

	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_path',\n";
	}
	elseif($tangaColumn['type']==='cms')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_html',\n";
	}
	else
		echo "\t\t\t\t\t'{$column->name}',\n";
}
?>
				));
				if($model->delete()) {
					$res
					->status(200)
		            ->json($modelArray, "<?php echo $this->labelName; ?> ".Yii::t('app','has been deleted successfully').".");
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
		 * This action is for Create a new <?php echo $this->modelClass; ?>.
		 * IMPORTANT this action require a admin or root acces-token
		 *
		 * @link <?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/create
		 * @method POST
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
<?php if($column->name=='id') continue;?>
		 * @param <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> $<?php echo $column->name?> <?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type
<?php endforeach;?>
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		 *               "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
<?php $nc=0;?>
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
<?php if($column->name=='id') continue;?>
<?php if($nc>=2) break;?>
		 *	     "<?php echo $column->name?>"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
<?php $nc++;?>
<?php endforeach;?>
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/<?php echo strtr($this->controller,array($this->moduleName.'/'=>'')); ?>/create", $cb(), function () use ($app) {

	    	$req=$app->request;
			$res=$app->response;

			try {

				$model=new <?php echo $this->modelClass; ?>;
				$model->attributes=$req->params();
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($column->name=='orden_id')
	{
		echo "\t\t\t\t\$last=".$this->modelClass."::model()->findAll();\n";
		echo "\t\t\t\t\$model->orden_id=count(\$last)+1;\n";
	}
		if($column->name=='updated_at')
			echo "\t\t\t\t\$model->updated_at=date('Y-m-d H:i:s');\n";
		if($column->name=='created_at')
			echo "\t\t\t\t\$model->created_at=date('Y-m-d H:i:s');\n";
		if($tangaColumn['type']==='users')
			echo "\t\t\t\t\$model->".$column->name."=Yii::app()->user->userToken->id;\n";
}
?>
		
				$modelArray=$model->toArray(array(
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='password')
		continue;

	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_path',\n";
	}
	elseif($tangaColumn['type']==='cms')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_html',\n";
	}
	else
		echo "\t\t\t\t\t'{$column->name}',\n";
}
?>
				));
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"<?php echo $this->labelName; ?> ".Yii::t('app','has been created successfully')."");
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
		 * This action is for Update a <?php echo $this->modelClass; ?>.
		 * IMPORTANT this action require a admin or root acces-token
		 * 
		 * @link <?php echo $this->moduleName; ?>/<?php echo $this->controllerID; ?>/update/{id}
		 * @method POST
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column): $tangaColumn=$module->getParamsField($column); $labelColumn=!empty($tangaColumn['label'])?$tangaColumn['label']:$column->name;?>
		 * @param <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> $<?php echo $column->name?> <?php echo $labelColumn?> is <?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?> input type
<?php endforeach;?>
		 * @return a one of this responses
		 * success_response  
		 * <code>array(
		 *	        "status"=>200,
		 *	        "message"=>"A longer message ;)",
		 *	        "success"=>true,
		 *	        "data"=>array(
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
		 *               "<?php echo $column->name?>" => "<?php echo strtr($column->dbType,Yii::app()->getModule('gii')->arrayReplaceInputs)?>",
<?php endforeach;?>
		 *	))</code>
		 * error_response
		 * <code>array(
		 *   "status"=> 422,
		 *   "success"=> false,
		 *   "error"=> "unprocessable_entity",
		 *   "message"=> "Validations errors",
		 *   "data"=> array(
<?php $nc=0;?>
<?php foreach(CActiveRecord::model($this->modelClass)->getMetaData()->columns as $column):?>
<?php if($column->name=='id') continue;?>
<?php if($nc>=2) break;?>
		 *	     "<?php echo $column->name?>"=>array(
		 *		   array(
		 *			  "Reason error eg. Nombre no puede ser nulo.",
		 *			  "Reason 2 error eg. numer value is required.",
		 *		   )
		 *	     ),
<?php $nc++;?>
<?php endforeach;?>
		 *   ),
		 * )</code>
		*/
		$app->post("/{$this->module->id}/<?php echo strtr($this->controller,array($this->moduleName.'/'=>'')); ?>/update/:id", $cb(), function ($id) use ($app) {
	
	    	$req=$app->request;
			$res=$app->response;
			$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
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
<?php 
foreach($this->tableSchema->columns as $column)
{
		if($column->name=='created_at')
			echo "\t\t\t\t\$model->created_at=date('Y-m-d H:i:s');\n";
		if($column->name=='users_id' or $column->name=='users_users_id' or $column->name=='user_id')
			echo "\t\t\t\t\$model->".$column->name."=Yii::app()->user->userToken->id;\n";
}
?>
				$modelArray=$model->toArray(array(
<?php 
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='password')
		continue;

	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_path',\n";
	}
	elseif($tangaColumn['type']==='cms')
	{
		echo "\t\t\t\t\t'{$column->name}',\n";
		echo "\t\t\t\t\t'{$column->name}_html',\n";
	}
	else
		echo "\t\t\t\t\t'{$column->name}',\n";
}
?>
				));	
				if($model->save()) {
					$res
					->status(200)
					->json($modelArray,"<?php echo $this->labelName; ?> ".Yii::t('app','has been updated successfully')."");
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