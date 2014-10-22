<?php

class Api_usersController extends JsonController
{

	public function routes($app,$r)
	{
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
                if(!Yii::app()->user->checkToken($module->getAllowPermissoms(false)))
                {
                    $app->response
                    ->status(403)
                    ->json($app->request, Yii::t('app','You do not have access to take this action'));
                    $app->stop();
                }
            };
        };

		$app->get("$r/me", $cb, function () use ($app) {
			$req=$app->request;
			$res=$app->response;

			$model=Users::model()->findByPk($res->user->id);
			if($model===null) {
	            $res
                ->status(404)
                ->json($id, Yii::t('app','The resourse requested {id} does not exist or was deleted',
                    array('{id}'=>$id)),
                    "resource_not_found");
    		} else {
				$res
                ->status(200)
                ->json($model);
    		}
        });

		$app->post("$r/register", function () use ($module,$app) {
			$req=$app->request;
			$res=$app->response;

    		$appForm=new AppForm;
			$appForm->attributes=$req->params();

			if(!$appForm->validate()) {
                $res
                ->status(422)
                ->json($appForm->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
            }
			else
				$app=Apps::model()->find('client_id=? AND client_secret=?',
					array($req->params('client_id'),$req->params('client_secret')));


			$model=new Users("signup");
			$model->attributes=$req->params();
			$model->registered=date('Y-m-d H:i:s');
			$model->state_email=0;
			$model->state=1;
			$model->trash=0;
			$model->username=Yii::app()->format->trimAndLower($model->name).'.'.Yii::app()->format->trimAndLower($model->lastname);
	
			if($module->sendPassword)
				$model->password=sha1($model->username);
				
			if($model->validate())
			{
				$model->password=sha1($model->password);
				$model->save();
				
				if($module->sendRegisterMail($model))
				{
					$modelArray=$model->attributes;
					if(($token=$model->getAccessToken($app))!==null)
					{
						if($module->loginInRegister)
						{
							$modelArray['token']=$token;
						    $res
		                    ->status(200)
		                    ->json($modelArray,Yii::t('app','has been created successfully')."");
               			}
						else
						{
							if($module->sendPassword) {
							    $res
			                    ->status(200)
			                    ->json($modelArray,Yii::t('app','Hemos enviado a tu correo tus datos de ingreso.')."");
     						} else {
							    $res
			                    ->status(200)
			                    ->json($modelArray,'Por favor revisa tu correo electrónico para terminar el proceso de registro.');
     						}
						}
					}
					else
					{
						$model->trash=1;
						$model->save(true,array('trash'));

						$res
	                    ->status(403)
	                    ->json($req, Yii::t('app','You do not have access to take this action'));
	                    $app->stop();
					}
				}
				else
				{
					$model->trash=1;
					$model->save(true,array('trash'));
					
					$res
                    ->status(403)
                    ->json($req, Yii::t('app',"Error al enviar el correo de confirmación."));
                    $app->stop();
				}
			} else {

			    $res
                ->status(422)
                ->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
            }
		});

		$app->post("$r/login",function () use ($app) {
			$req=$app->request;
			$res=$app->response;

    		$appForm=new AppForm;
			$appForm->attributes=$req->params();
			
			if(!$appForm->validate()) {
			    $res
                ->status(422)
                ->json($appForm->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
            } else {
            	$app=Apps::model()->find('client_id=? AND client_secret=?',
					array($req->params('client_id'),$req->params('client_secret')));
            }

			$model=new LoginForm;
			$model->attributes=$req->params();
			
			$identity=new UserIdentity($model->username,$model->password);
			if($model->validate() and ($userObject=$identity->authenticateToken())!==false)
			{
			
				/**
				 * Si la atenticacion es de tipo enviar contraseña
				 * entonces cuando se loguea es la unica forma en que
				 * asumismos que su correo existe, porque siempre
				 * se envian las contraseñas al correo
				*/
				if($module->sendPassword)
				{
					$userObject->state_email=1;
					$userObject->save(true,array('state_email'));
				}
				$modelArray=$userObject->attributes;
				$modelArray['token']=$userObject->getAccessToken($app);
			    $res
                ->status(200)
                ->json($modelArray,Yii::t('app','has been successfully')."");
            } else {
        	    $res
                ->status(422)
                ->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
            }
		});

		$app->post("$r/update_profile", $cb, function () use ($app) {
			$req=$app->request;
			$res=$app->response;

			$model=Users::model()->findByPk($res->user->id);
			$model->attributes=$req->params();
			
			if($req->params('newPassword'))
            	$model->newPassword=$req->params('newPassword');
            
			if($model->save())
			{
				if(!empty($model->newPassword))
            	{
            		$model->password=sha1($model->newPassword);
            		$model->save(true,array('password'));
            	}

				$res
				->status(200)
				->json($model,Yii::t('app','has been created successfully')."");
        	} else {
				$res
				->status(422)
				->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
            }
		});

		$app->post("$r/forgot",function () use ($app) {
			$req=$app->request;
			$res=$app->response;

    		$model=new ForgotForm;
			$model->attributes=$req->params();
			if ($model->validate()) 
			{
				$user=Users::model()->find("email=? AND trash=0",array($model->email));
				
				if($module->sendForgotMail($user))
				{
					if($module->sendPassword) {

					    $res
	                    ->status(200)
	                    ->json($model,Yii::t('app','Hemos enviado a tu correo tus datos de ingreso.')."");
       				} else {
   					    $res
	                    ->status(200)
	                    ->json($model,Yii::t('app','Por favor revisa tu correo electrónico para recuperar tu contraseña.')."");
       				}
				} else {

				    $res
                    ->status(500)
                    ->json($model->getErrors(),Yii::t('app','Error al enviar el correo de confirmación, por favor intenta nuevamente.'),"error_send_email");
				}
			} else {
				$res
				->status(422)
				->json($model->getErrors(),Yii::t('app','Form validation errors'),"unprocessable_entity");
        	}
		});

		$app->run();
	}
}