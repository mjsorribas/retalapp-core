<?php
class PageController extends FrontController
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('profile','changePassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','resendVerify','view','confirm','password','forgot','logout','login','register','registerAjax','loginAjax','changePasswordAjax','forgotAjax','isGuest'),
				// 'roles'=>array('admin'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($id=null)
	{
		if($id===null)
			$id=r()->user->id;
		$model=Users::model()->findByPk($id);

		$followers=new UsersFollowers;
		$criteria=new CDbCriteria;
		$criteria->compare('users_users_id',$id);

		$followersDataProvider=new CActiveDataProvider('UsersFollowers',array(
		    "criteria"=>$criteria,
		));

		$following=new UsersFollowing;
		$criteria=new CDbCriteria;
		$criteria->compare('users_users_id',$id);

		$followingDataProvider=new CActiveDataProvider('UsersFollowing',array(
		    "criteria"=>$criteria,
		));


		$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
		$this->{$typeRender}('index',array(
		    'model'=>$model,
		    'following'=>$following,
		    'followingDataProvider'=>$followingDataProvider,
		    'followers'=>$followers,
		    'followersDataProvider'=>$followersDataProvider,
		));
	}

	public function actionResendVerify()
	{
		$model=Users::model()->find("email=? AND trash=0 AND state=1",array($_GET['email']));
		if($this->module->sendRegisterMail($model,true))
		{
			$message="<h4>{$model->name}!</h4>
			<p>".Yii::t('app','We have forwarded your mail <strong>{email}</strong> a link to confirm, if it is not in your inbox please check your spam folder',array('{email}'=>$model->email))."</p>";
			r()->user->setFlash('success',$message);
		}
		else
		{
			$message="<h4>".Yii::t('app','Email not found')."</h4>
			<p>".Yii::t('app','Your email <strong>{email}</strong> not found on owr database',array("{email}"=>isset($_GET['email'])?$_GET['email']:''))."</p>";
			r()->user->setFlash('danger',$message);
		}
	
		$this->redirect($this->module->redirectLogout);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionConfirm()
	{
		if(!isset($_GET['key']))
			throw new CHttpException(403,Yii::t('app',"Invalid request"));
		
		$email=$this->module->decryptEmail($_GET['key']);
		$model=Users::model()->find("email=? and trash=0",array($email));

		if($model===null)
			throw new CHttpException(404,Yii::t('app',"Invalid request"));
		$model->state_email=1;
		if($model->save(true,array("state_email")))
		{
			$model->login();
			r()->user->setFlash("success",Yii::t('app',"Hi {name}!! Welcome a to {appName}",array('{name}'=>$model->name,'{appName}'=>strip_tags(r()->name))));
			$this->redirect($this->module->redirectLogin);
		}
		else
			throw new CHttpException(500,Yii::t('app',"There has been an inconvenience and could not verify your email."));
	}

	/**
	 * Displays the login page
	 */
	public function actionPassword()
	{
		if(!r()->user->isGuest)
			r()->user->logout();

		if(!isset($_GET['key']))
			throw new CHttpException(404,Yii::t('app',"Invalid request"));
			
		$email=r()->security->decrypt($_GET['key']);
		$model=new PasswordForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			r()->end();
		}

		// collect user input data
		if(isset($_POST['PasswordForm']))
		{
			$model->attributes=$_POST['PasswordForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
			{
				$user=Users::model()->find("email=? AND trash=0",array($email));
				$user->password=sha1($model->password);
				$user->save(true,array("password"));
				r()->user->setFlash("success",Yii::t('app','Correctly updated password.')."<br>".$user->email);
				$this->redirect(array("login","key"=>$_GET['key']));
			}
		}

		$this->render('password',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionChangePassword()
	{
		$model=new ChangePasswordForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='change-password-form')
		{
			echo CActiveForm::validate($model);
			r()->end();
		}

		// collect user input data
		if(isset($_POST['ChangePasswordForm']))
		{
			$model->attributes=$_POST['ChangePasswordForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
			{
				$user=Users::model()->findByPk(r()->user->id);
				$user->password=sha1($model->newPassword);
				$user->save(true,array("password"));
				r()->user->setFlash("success",Yii::t('app'.'Correctly updated password.'));
				$this->redirect(r()->request->urlReferrer);
			}
		}

		$this->render('change_password',array(
			'model'=>$model,
		));
	}

	 /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionProfile()
    {
    	if(r()->user->isGuest and r()->request->isAjaxRequest)
    	{
    		echo r()->user->loginRequiredAjaxResponse;
			r()->end();
    	}
    	if(r()->user->isGuest)
    		throw new CHttpException(403,Yii::t('app','Login is required'));
    		
        $user=Users::model()->findByPk(r()->user->id);
        
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($user);

        if(isset($_POST['Users']))
        {
            $user->attributes=$_POST['Users'];
            if(isset($_POST['Users']['newPassword']))
            	$user->newPassword=$_POST['Users']['newPassword'];
            
            if($user->birthdate=="")
        		$user->birthdate=null;

            if($user->save())
            {
            	if(!empty($user->newPassword))
            	{
            		$user->password=sha1($user->newPassword);
            		$user->save(true,array('password'));
            	}
            
            	r()->user->setFlash("success",Yii::t('app','Profile updated successfully'));
                $this->refresh(r()->request->urlReferrer);
            }
        }

        $this->render('profile',array(
            'user'=>$user,
        ));
    }

	public function actionView($id=null)
	{
		if($id!==null)
			$model=Users::model()->findByPk($id);
		else
			$model=Users::model()->findByPk(r()->user->id);

		$this->render('view',array(
			"model"=>$model,
		));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// display the login form
		$this->render('login',array(
		));
	}

	// @todo this actions can be in user module
	/**
	 * Displays the login page
	 */
	public function actionRegister()
	{
		// $this->layout='//layouts/login';
		// $model=new Users("signup");
		$modelName=$this->module->loadActive();
		$model=new $modelName;
	
		$model->setScenario("signup");
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			$model->confirmPassword=$_REQUEST['password'];
			$model->registered=date('Y-m-d H:i:s');
			$model->state_email=0;
			$model->state=1;
			$model->trash=0;
			$model->username=r()->format->trimAndLower($model->name).'.'.r()->format->trimAndLower($model->lastname);
		
			echo CActiveForm::validate($model);
			r()->end();
		}

		// collect user input data
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			
			if(!$this->module->confirmPasswordRequired and isset($_POST['password'])) {
				$model->confirmPassword=$_POST['password'];
			}

			$model->registered=date('Y-m-d H:i:s');
			$model->state_email=0;
			$model->state=1;
			$model->trash=0;
			$model->conditions=isset($_POST['Users']['conditions'])?$_POST['Users']['conditions']:0;
			$model->username=r()->format->trimAndLower($model->name).'.'.r()->format->trimAndLower($model->lastname);
			if($this->module->sendPassword)
				$model->password=sha1($model->username);
			
			if ($model->validate()) 
			{
				$model->password=sha1($model->password);
				if($model->save(false) and $this->module->sendRegisterMail($model))
				{
					if($this->module->loginInRegister)
					{
						$model->login();
						r()->user->setFlash("success",Yii::t('app','Hi {name}!! Welcome a to {appName}',array('{name}'=>$model->name,'{appName}'=>strip_tags(r()->name))));
					}
					else
					{
						if($this->module->sendPassword)
							r()->user->setFlash("success",Yii::t('app','We have sent a new password to your email'));
						else
							r()->user->setFlash("success",Yii::t('app','We have sent the instructions to your email'));
					}
				}
				else
				{
					$model->trash=1;
					$model->save(true,array('trash'));
					r()->user->setFlash("danger",Yii::t('app','Error sending email!!'));
				}
				$this->redirect($this->module->redirectLogin);
			}
		}
		// display the login form
		$this->render('register',array(
			'model'=>$model
		));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		r()->user->logout();
		$this->redirect($this->module->redirectLogout);
	}

	//////////////////////////
	// Methods reutilizable //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			r()->end();
		}
	}

	//////////////////////////////////
	// AJAX method availables       //
	//////////////////////////////////

	/**
	 * Displays the login page
	 * 
	 * You can use this ajax helper for call this action
	 * 
	 * $(document).on('submit','#register-form',function(e) {
	 *
	 *    e.preventDefault();
	 *    var $form = $(this);
	 *    $.ajax({
	 *        url: '<?php echo $this->createUrl("/users/page/registerAjax");?>',
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
	 *            // $.fn.modal(data.message,'');
	 *            alert(data.message,'');
	 *          } else {
	 *
	 *            $.each(data.data, function(name, errors) {
	 *              $('[name='+name+']')
	 *              .parent()
	 *              .append($('<span id="validate-'+name+'" style="color:red;font-size:11px">'+errors.join(',<br>')+'</span>'));
	 *            });
	 *          }
	 *        }
	 *    });
	 * }); 
	*/
	public function actionRegisterAjax()
	{
	    header('Content-type: application/json');
		//$model=new Users("signup");
        $modelName=$this->module->loadActive();
		$model=new $modelName;
	
		$model->setScenario("signup");

		$model->attributes=$_REQUEST;

		if(!$this->module->confirmPasswordRequired and isset($_REQUEST['password'])) {
			$model->confirmPassword=$_REQUEST['password'];
		}

		$model->registered=date('Y-m-d H:i:s');
		$model->state_email=0;
		$model->state=1;
		$model->trash=0;
		$model->conditions=isset($_REQUEST['conditions'])?$_REQUEST['conditions']:0;
		$model->username=r()->format->trimAndLower($model->name).'.'.r()->format->trimAndLower($model->lastname);
		if($this->module->sendPassword)
		{
			$model->state_email=1;
			$model->password=sha1($model->username);
			$model->confirmPassword=sha1($model->username);
		}
		
		if ($model->validate()) 
		{
			$model->password=sha1($model->password);
			$model->confirmPassword=sha1($model->confirmPassword);
			if($this->module->sendRegisterMail($model))
			{

				if($this->module->loginInRegister)
				{
					if($model->save() and $model->login()) {
						echo CJSON::encode(array(
			                'success'=>1,
			                'data'=>$model,
			                'error_code'=>null,
			                'message'=>Yii::t('app','Hi {name}!! Welcome a to {appName}',array('{name}'=>$model->name,'{appName}'=>strip_tags(r()->name))),
			                'params'=>$_REQUEST,
			            ));
					} else {
						echo CJSON::encode(array(
			                'success'=>0,
			                'data'=>$model->errors,
			                'error_code'=>null,
			                'message'=>Yii::t('app','We did someting wrong {name}!! Please try later',array('{name}'=>$model->name)),
			                'params'=>$_REQUEST,
			            ));
					}
				}
				else
				{
					if($model->save()) {
						$message="";
						if($this->module->sendPassword)
							$message=Yii::t('app','We have sent a new password to your email');
						else
							$message=Yii::t('app','We have sent the instructions to your email');
						
						echo CJSON::encode(array(
			                'success'=>1,
			                'data'=>$model,
			                'error_code'=>null,
			                'message'=>$message,
			                'params'=>$_REQUEST,
			            ));
					} else {
						echo CJSON::encode(array(
			                'success'=>0,
			                'data'=>$model->errors,
			                'error_code'=>null,
			                'message'=>Yii::t('app','We did someting wrong {name}!! Please try later',array('{name}'=>$model->name)),
			                'params'=>$_REQUEST,
			            ));	
					}

				}
			} else {
				
				echo CJSON::encode(array(
	                'success'=>0,
	                'data'=>null,
	                'error_code'=>'dont_sending_email',
	                'message'=>Yii::t('app','Error sending email!!'),
	                'params'=>$_REQUEST,
	            ));
			}
			
		} else {
		    echo CJSON::encode(array(
                'success'=>0,
                'data'=>$model->getErrors(),
                'error_code'=>'unprocessable_entity',
                'message'=>Yii::t('app','Form validation errors'),
                'params'=>$_REQUEST,
            ));
		}
	}

	public function actionFacebookRegisterAjax()
	{
	    header('Content-type: application/json');
	    //$model=new Users("signup");
        $modelName=$this->module->loadActive();
		$model=CActiveRecord::model($modelName)->find('email=? and trash=0',array($_REQUEST['email']));
		// Just login
		if($model!==null) {

			$model->login();
			if(!r()->user->isGuest and r()->user->checkAccessArray($this->module->adminRoles))
				$url=CHtml::normalizeUrl($this->module->redirectLoginAdmin);
			else
				$url=CHtml::normalizeUrl($this->module->redirectLogin);
			

			echo CJSON::encode(array(
                'success'=>1,
                // 'data'=>$modelArray,
                'error_code'=>null,
                'redirect'=>$url,
                'message'=>r('users','Welcome to ').r()->name,
                'params'=>$_REQUEST,
            ));
		} else { // Is new user

			$model=new $modelName;
			$model->setScenario("signup");

			// $model->attributes=$_REQUEST;
			$model->name=$_REQUEST['name'];
			$model->email=$_REQUEST['email'];
			$model->gender=$_REQUEST['gender'];
			$model->fb_id=$_REQUEST['id'];
			$model->fb_img="https://graph.facebook.com/".$_REQUEST['id']."/picture?type=large";
			$model->img="https://graph.facebook.com/".$_REQUEST['id']."/picture?type=large";

			if(!$this->module->confirmPasswordRequired and isset($_REQUEST['password'])) {
				$model->confirmPassword=$_REQUEST['email'];
			}

			$model->registered=date('Y-m-d H:i:s');
			$model->state_email=0;
			$model->state=1;
			$model->trash=0;
			$model->conditions=1;
			$model->username=r()->format->trimAndLower($model->name).'.'.r()->format->trimAndLower($model->lastname);
			$model->state_email=1;
			$model->password=sha1($model->username);
			$model->confirmPassword=sha1($model->username);
			
			if ($model->validate()) 
			{
				$model->password=sha1($model->password);
				if($this->module->sendRegisterMail($model,false,true))
				{
					if($model->save()) {
						$model->login();

						if(!r()->user->isGuest and r()->user->checkAccessArray($this->module->adminRoles))
							$url=CHtml::normalizeUrl($this->module->redirectLoginAdmin);
						else
							$url=CHtml::normalizeUrl($this->module->redirectLogin);
				
						$message=Yii::t('app','Welcome!!, We have sent a new password to your email');
						echo CJSON::encode(array(
			                'success'=>1,
			                'data'=>$model,
			                'error_code'=>null,
			                'message'=>$message,
	            			'redirect'=>$url,
			                //'message'=>Yii::t('app','Hi {name}!! Welcome a to {appName}',array('{name}'=>$model->name,'{appName}'=>strip_tags(r()->name))),
			                'params'=>$_REQUEST,
			            ));
					}

				} else {
					
					echo CJSON::encode(array(
		                'success'=>0,
		                'data'=>null,
		                'error_code'=>'dont_sending_email',
		                'message'=>Yii::t('app','Error sending email!!'),
		                'params'=>$_REQUEST,
		            ));
				}
				
			} else {
			    echo CJSON::encode(array(
	                'success'=>0,
	                'data'=>$model->getErrors(),
	                'error_code'=>'unprocessable_entity',
	                'message'=>Yii::t('app','Form validation errors'),
	                'params'=>$_REQUEST,
	            ));
			}
		}
	}


	/**
	 * Displays the login page
	 * 
	 * You can use this ajax helper for call this action
	 * 
	 * $(document).on('submit','#login-form-2',function(e) {
	 *
	 *    e.preventDefault();
	 *    var $form = $(this);
	 *    $.ajax({
	 *        url: '<?php echo $this->createUrl("/users/page/loginAjax");?>',
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
	 *            // // $.fn.modal(data.message,'');
	 *            // alert(data.message,'');
	 *            window.location.reload(true);
	 *          } else {
	 *
	 *            $.each(data.data, function(name, errors) {
	 *              $('[name='+name+']')
	 *              .parent()
	 *              .append($('<span id="validate-'+name+'" style="color:red;font-size:11px">'+errors.join(',<br>')+'</span>'));
	 *            });
	 *          }
	 *        }
	 *    });
	 * });
	 * 
	*/
	public function actionLoginAjax()
	{
	    header('Content-type: application/json');

		$model=new LoginForm;
		$model->attributes=$_REQUEST;
		$modelArray=$model;
         
        if($model->validate() && $model->login()) {
         	
         	if(!r()->user->isGuest and r()->user->checkAccessArray($this->module->adminRoles))
				$url=CHtml::normalizeUrl($this->module->redirectLoginAdmin);
			else
				$url=CHtml::normalizeUrl($this->module->redirectLogin);
			

			echo CJSON::encode(array(
                'success'=>1,
                'data'=>$modelArray,
                'error_code'=>null,
                'redirect'=>$url,
                'message'=>r('users','Welcome to ').r()->name,
                'params'=>$_REQUEST,
            ));

        } else {

            echo CJSON::encode(array(
                'success'=>0,
                'data'=>$model->getErrors(),
                'error_code'=>'unprocessable_entity',
                'message'=>Yii::t('app','Form validation errors'),
                'params'=>$_REQUEST,
            ));
        }
	}

	/**
	 * Displays the login page
	 * 
	 * You can use this ajax helper for call this action
	 *
	 * $(document).on('submit','#change-password-form',function(e) {
	 *
	 *    e.preventDefault();
	 *    var $form = $(this);
	 *    $.ajax({
	 *        url: '<?php echo $this->createUrl("/users/page/changePasswordAjax");?>',
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
	 *          if(data.success==1 || data.success==2) {
	 *            // here submit 
	 *            // $.fn.modal(data.message,'');
	 *            alert(data.message,'');
	 *          } else {
	 *
	 *            $.each(data.data, function(name, errors) {
	 *              $('[name='+name+']')
	 *              .parent()
	 *              .append($('<span id="validate-'+name+'" style="color:red;font-size:11px">'+errors.join(',<br>')+'</span>'));
	 *            });
	 *          }
	 *        }
	 *    });
	 * });
	 */
	public function actionChangePasswordAjax()
	{
	    header('Content-type: application/json');

	    if(r()->user->isGuest)
	    {
	    	echo CJSON::encode(array(
	            'success'=>2,
	            'data'=>null,
	            'error_code'=>null,
	            'message'=>'Es necesario inicio de sesión',
	            'params'=>$_REQUEST,
	        ));
	        r()->end();
	    }
		$model=new ChangePasswordForm;
		$model->attributes=$_REQUEST;
		

		if($model->validate()) {
			$user=Users::model()->findByPk(r()->user->id);
			$user->password=sha1($model->newPassword);
			$user->save(true,array("password"));
				
			echo CJSON::encode(array(
                'success'=>1,
                'data'=>$model,
                'error_code'=>null,
                'message'=>'Contraseña actualizada!',
                'params'=>$_REQUEST,
            ));

        } else {

            echo CJSON::encode(array(
                'success'=>0,
                'data'=>$model->getErrors(),
                'error_code'=>'unprocessable_entity',
                'message'=>Yii::t('app','Form validation errors'),
                'params'=>$_REQUEST,
            ));
        }
	}

	/**
	 * Displays the login page
	 * You can use this ajax helper for call this action
	 * 
	 * $(document).on('submit','#recover-email',function(e) {
	 *    
	 *    e.preventDefault();
	 *    var $form = $(this);
	 *    $.ajax({
	 *        url: '<?php echo $this->createUrl("/users/page/forgotAjax");?>',
	 *        dataType: 'json', 
	 *        type: 'post',
	 *        data: $form.serialize(),
	 *        success: function (data){
	 *          console.log(data);
	 *          $.each($form.serializeArray(), function(index, name) {
	 *            $('[name='+name.name+']')
	 *              .parent()
	 *              .find('#validate-'+name.name)
	 *              .remove();
	 *          });
	 *          if(data.success) {
	 *            // here submit 
	 *            // $.fn.modal(data.message,'');
	 *            alert(data.message,'');
	 *          } else {
	 *            $.each(data.data, function(name, errors) {
	 *              $('[name='+name+']')
	 *              .parent()
	 *              .append($('<span id="validate-'+name+'" style="color:red;font-size:11px">'+errors.join(',<br>')+'</span>'));
	 *            });
	 *          }
	 *        }
	 *    });
	 * });
	 * 
	 */
	public function actionForgotAjax()
	{
	    header('Content-type: application/json');

		$model=new ForgotForm;
		$model->attributes=$_REQUEST;

		if($model->validate()) {
			$user=Users::model()->find("email=? AND trash=0",array($model->email));
			
			if(r('users')->sendForgotMail($user)) {
				echo CJSON::encode(array(
	                'success'=>1,
	                'data'=>null,
	                'error_code'=>null,
	                'message'=>Yii::t('app','Please review your email and follow the instructions'),
	                'params'=>$_REQUEST,
	            ));
			} else {
				echo CJSON::encode(array(
	                'success'=>0,
	                'data'=>null,
	                'error_code'=>'dont_sending_email',
	                'message'=>Yii::t('app','Error sending email!!'),
	                'params'=>$_REQUEST,
	            ));
			}

        } else {

            echo CJSON::encode(array(
                'success'=>0,
                'data'=>$model->getErrors(),
                'error_code'=>'unprocessable_entity',
                'message'=>Yii::t('app','Form validation errors'),
                'params'=>$_REQUEST,
            ));
        }
	}

	//////////////////////////////////
	// OAUTH2 Implementation method //
	//////////////////////////////////

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionToken()
	{
		$grant_type=isset($_REQUEST['grant_type'])?$_REQUEST['grant_type']:'authorization_code';
		$client_id=isset($_REQUEST['client_id'])?$_REQUEST['client_id']:null;
		$client_secret=isset($_REQUEST['client_secret'])?$_REQUEST['client_secret']:null;
		$code=isset($_REQUEST['code'])?$_REQUEST['code']:null;
		$web_generate=isset($_GET['web_generate']);
		$param=array();
	
		if($client_id===null or $client_secret===null)
		{
			$param=array(
				'error'=>'access_denied',
				'error_description'=>"client_secret and client_id is required",
			);
			$this->endRequest($param,false);
		}

		$model=Apps::model()->find('client_id=? AND client_secret=?',array($client_id,$client_secret));
		if($model===null)
		{
			$param=array(
				'error'=>'access_denied',
				'error_description'=>"Application with this client id has been deleted",
			);
			$this->endRequest($param,false);
		}
		
		if($grant_type!=='code' and $grant_type!=='client_credentials' and $grant_type!=='authorization_code')
		{
			$param=array(
				'error'=>'access_denied',
				'error_description'=>"Invalid grant_type: '{$grant_type}'. Supported types: authorization_code, client_credentials",
			);
			$this->endRequest($param,$model);
		}
			
		$token=new AccessTokens;
		$token->acces_token=r()->security->randomWord(40);
		$token->acces_token_refresh=r()->security->randomWord(60);
		$token->apps_id=$model->id;
		
		if($grant_type==='client_credentials')
			$token->users_id=$model->users_id;
		else if(($grant_type==='authorization_code' and $code===null) or ($grant_type==='code' and $code===null))
		{
			$param=array(
				'error'=>'access_denied',
				'error_description'=>"In code grant type autorization code is required",
			);
			$this->endRequest($param,$model);
		}
		else
		{
			$codeAuth=CodeAuth::model()->find('code=?',array($code));
			if($codeAuth===null)
			{
				$param=array(
					'error'=>'access_denied',
					'error_description'=>"Authorization code is not valid",
				);
				$this->endRequest($param,$model);
			}
			$token->users_id=$codeAuth->users_id;
			$token->code=$codeAuth->code;
		}
		if($token->save() and !$web_generate)
		{
			$param=array(
				'access_token'=>$token->acces_token,
				'token_refresh'=>$token->acces_token_refresh,
				'token_type'=>'Bearer',
				'expires_in'=>86400,
				'scope'=>'grant',
			);	
			$this->endRequest($param,$model);
		}
    
		$this->render('token',array(
			'token'=>$token,
		));
	}

	
	public function endRequest($param,$model=false)
	{
		$web_generate=isset($_GET['web_generate']);
		if($model===false) {
			
			if(r()->request->isPostRequest)
			{
				header('Access-Control-Allow-Origin: *');
				header('Content-Type: application/json');
				echo CJSON::encode($param);
				r()->end();
			}

			$message='';
			foreach($param as $key => $value)
				$message.=$key.': '.$value;
			throw new CHttpException(403,$message);
		}

		if(r()->request->isPostRequest)
		{
			header('Access-Control-Allow-Origin: *');
			header('Content-Type: application/json');
			echo CJSON::encode($param);
			r()->end();
		}
		
		if(!$web_generate)
		{
			$param_redirect_uri=isset($_REQUEST['redirect_uri'])?$_REQUEST['redirect_uri']:null;
			$redirect_uri='';
			if($param_redirect_uri!==null)
				$redirect_uri=urldecode($param_redirect_uri);
			else
			{
				if(!empty($model->redirect_uri))
					$redirect_uri=$model->redirect_uri;
				else
					throw new CHttpException(403,"No redirect URI was supplied or stored");
			}
			if(strpos($redirect_uri, '?')!==false)
				$this->redirect($redirect_uri.'&'.http_build_query($param));
			else
				$this->redirect($redirect_uri.'?'.http_build_query($param));
		}

		$message='';
		foreach($param as $key => $value)
			$message.=$key.': '.$value;
		throw new CHttpException(403,$message);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAuthorize()
	{

		$app=Apps::model()->find('client_id=?',array($_REQUEST['client_id']));
		if($app===null)
			throw new CHttpException(404,"Application with this client id has been deleted");
		
		$model=new LoginForm;

		// if it is ajax validation request
		if((isset($_POST['ajax']) && $_POST['ajax']==='login-form') or
			(isset($_POST['ajax']) && $_POST['ajax']==='login-form-shopping'))
		{
			echo CActiveForm::validate($model);
			r()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->refresh();
		}

		$this->render('authorize',array(
			'model'=>$model,
			'app'=>$app,
			'params'=>$_REQUEST,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAuthorizeSubmit()
	{

		$model=Apps::model()->find('client_id=?',array($_REQUEST['client_id']));
		if($model===null)
			throw new CHttpException(404,"Application with this client id has been deleted");
		
		if(r()->user->isGuest)
		{
			r()->user->setFlash('error','You need login before this action.');
			$this->redirect(array('authorize'));
		}

		if(isset($_REQUEST['authorize']) and $_REQUEST['authorize']==1) // save and validate login
		{
			$code=new CodeAuth;
			$code->users_id=r()->user->id;
			$code->code=r()->security->randomWord(40);
			$code->created_at=date('Y-m-d H:i:s');
			$code->save();
			// var_dump($code);
			
			if(isset($_REQUEST['response_type']) and $_REQUEST['response_type']==='token')
			{
				$token=new AccessTokens;
				$token->acces_token=r()->security->randomWord(40);
				$token->acces_token_refresh=r()->security->randomWord(60);
				$token->apps_id=$model->id;
				
				$token->users_id=$code->users_id;
				$token->code=$code->code;
				
				$token->save();
			}

			
			$param=array();
			if(isset($_REQUEST['response_type']) and $_REQUEST['response_type']==='token')
				$param=array('acces_token'=>$token->acces_token);
			if(isset($_REQUEST['response_type']) and $_REQUEST['response_type']==='code')
				$param=array('code'=>$code->code);
		}
		else
		{
			$param=array(
				'error'=>'access_denied',
				'error_description'=>'The+user+denied+access+to+your+application'
			);
			// error: "insufficient_scope"
			// error_description: "The request requires higher privileges than provided by the access token"
		}

		$redirect_uri='';
		if(isset($_REQUEST['redirect_uri']))
			$redirect_uri=urldecode($_REQUEST['redirect_uri']);
		else
		{
			if(!empty($model->redirect_uri))
				$redirect_uri=$model->redirect_uri;
			else
				throw new CHttpException(403,"No redirect URI was supplied or stored");
		}
		if(strpos($redirect_uri, '?')!==false)
			$this->redirect($redirect_uri.'&'.http_build_query($param));
		else
			$this->redirect($redirect_uri.'?'.http_build_query($param));
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

	public function actionIsGuest()
	{
		if(r()->user->isGuest) {
			echo CJSON::encode(array(
				'success'=>1,
				'data'=>null,
			));
		} else {
			echo CJSON::encode(array(
				'success'=>0,
				'data'=>null,
			));
		}
	}

	/**
	 * http://localhost/project_name/public/users/page/Send
	 * This action is for implement
	 * cron job por see what is user notifications
	 * pendding and send
	 * This apply for push notificacions implementing
	 * and email notificaciotins
	 * Here we need to implement other actions for
	 * Unsuscribe module integration and
	 * And push message new module for implement
	 * @TODO Push notifications implemen
	*/
	public function actionSend()
	{
		$model=UsersNotifications::model()->findAll(array(
			"condition"=>"send=0",
			"order"=>"created_at DESC",
			"limit"=>500,
		));

		foreach($model as $data) {
			
			r('email')->add($data->user->email,$data->user->name);
			r('email')->sendBody($data->subject,array(
				'body'=>$data->body,
				'url'=>$data->url,
				'label'=>$data->label,
			));
			
			$data->send=1;
			$data->save(true,array('send'));
		}
		echo "Finish...";
	}
}
