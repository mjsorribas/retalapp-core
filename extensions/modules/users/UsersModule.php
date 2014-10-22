<?php

class UsersModule extends Module
{

	public $copyWelcomeEmail;
	
	public $copySendPasswordForgot;
	
	public $copyForgotEmail;

	public $copySendPassword;

	public $enableOAuth=false;
	

	public $allowBasicOAuth=false;
	
	/**
	 * Para loguear al usuario un a vez este
     * se registra y no tener que esperar si
     * confirmo correo o no
    */
	public $loginInRegister=false;
	
	/**
	 * @sendPassword
	 * Es para usar la modalidad de resgistro 
	 * de usuarios con envío de password
	 * si este campo es falso es necesario que en el 
	 * formulario de registro el usuario ingrese su contraseña
	*/
	public $sendPassword=false;
	
	/**
	 * Particularmente es para saber donde se hace el redirect
	 * despues del login por ejemplo aunque podria tener mas
	 * utilidades mas adelante
	*/
	public $adminRoles=array('admin','root');

	// Urls for put on home or other modules if you need 
	public $urlProfile=array("/users/page/profile");
	
	public $urlLogin=array("/users/page/login");
	
	public $urlRegister=array("/users/page/register");
	
	public $urlLogout=array("/users/page/logout");
	
	public $urlForgot=array("/users/page/forgot");
	
	public $urlAdminProfile=array("/users/users/profile");
	
	// Redirects
	public $redirectLogin=array("/");
	
	public $redirectLoginAdmin=array("/admin");
	
	public $redirectLogout=array("/");
	
	public $redirectLogoutAdmin=array("/users/users/login");
	
	// Enabled create news roles
	public $canCreateRoles=false;

	// deprecated
	public $subMenu=false;
	
	private $_config;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'users.models.base.*',
			'users.models.*',
			'users.components.*',
		));
		parent::init();
	}

	public function getToLogin()
	{
		return CHtml::normalizeUrl($this->urlLogin);
	}
	
	public function getToRegister()
	{
		return CHtml::normalizeUrl($this->urlRegister);
	}

	public function getToForgot()
	{
		return CHtml::normalizeUrl($this->urlForgot);
	}
	
	public function getToProfile()
	{
		return CHtml::normalizeUrl($this->urlProfile);
	}
	
	public function getToLogout()
	{
		return CHtml::normalizeUrl($this->urlLogout);
	}
	
	public function getLoginUrl()
	{
		return $this->getToLogin();
	}
	
	public function getRegisterUrl()
	{
		return $this->getToRegister();
	}

	public function getForgotUrl()
	{
		return $this->getToForgot();
	}
	
	public function getProfileUrl()
	{
		return $this->getToProfile();
	}
	
	public function getLogoutUrl()
	{
		return $this->getToLogout();
	}
	
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function listRoles($currentUser=false)
	{
		$result=array();
		foreach(r()->authManager->getAuthItems() as $data)
		{
 			if($currentUser)
 			{
 				if(r()->user->checkAccess($data->name))
 					$result[$data->name]=$data->name;
 			}
 			else
 				$result[$data->name]=$data->name;
 		}
		return $result;
	}


	public function sendRegisterMail($model,$resend=false)
	{
		if($model===null)
			return false;
		if($this->sendPassword)
		{
			$model->password=sha1($pass=r()->security->randomWord(4));
			$model->save(true,array('password'));

			$body=$this->copySendPassword;
			$body=strtr($body,array(
				'{{name}}'=>$model->name,
				'{{lastname}}'=>$model->lastname,
				'{{appname}}'=>strip_tags(r()->name),
				'{{fullname}}'=>$model->name." ".$model->lastname,
				'{{email}}'=>$model->email,
				'{{password}}'=>$pass,
			));
			$contex=array(
				"body"=>$body,
			);
			r('smtp')->add($model->email,$model->name);
			return r('smtp')->sendBody(Yii::t('app','Your credentials').' '.strip_tags(r()->name),$contex);
		}
		else
		{
			$resendMessage='';
			if($resend)
				$resendMessage=Yii::t('app','RESENDED').' ';
			$body=$this->copyWelcomeEmail;
			$body=strtr($body,array(
				'{{name}}'=>$model->name,
				'{{lastname}}'=>$model->lastname,
				'{{appname}}'=>strip_tags(r()->name),
				'{{fullname}}'=>$model->name." ".$model->lastname,
				'{{email}}'=>$model->email,
			));
			$contex=array(
				"body"=>$body,
				"label"=>Yii::t('app','Confirm email'),
				"url"=>r()->createAbsoluteUrl("/users/page/confirm",array(
					"key"=>r()->security->encrypt($model->email
				))),
			);
			r('smtp')->add($model->email,$model->name);
			return r('smtp')->sendBody($resendMessage.Yii::t('app','Confirm register on').' '.strip_tags(r()->name),$contex);
		}	
	}

	public function sendForgotMail($model)
	{
		if($this->sendPassword)
		{
			$model->password=sha1($pass=r()->security->randomWord(4));
			$model->save(true,array('password'));
			
			$body=$this->copySendPasswordForgot;
			$body=strtr($body,array(
				'{{name}}'=>$model->name,
				'{{lastname}}'=>$model->lastname,
				'{{appname}}'=>strip_tags(r()->name),
				'{{fullname}}'=>$model->name." ".$model->lastname,
				'{{email}}'=>$model->email,
				'{{password}}'=>$pass,
			));

			$contex=array(
				"body"=>$body,
			);
			r('smtp')->add($model->email,$model->name);
			return r('smtp')->sendBody(Yii::t('app','New password').' '.strip_tags(r()->name),$contex);
		}
		else
		{
			$body=$this->copyForgotEmail;
			$body=strtr($body,array(
				'{{name}}'=>$model->name,
				'{{lastname}}'=>$model->lastname,
				'{{appname}}'=>strip_tags(r()->name),
				'{{fullname}}'=>$model->name." ".$model->lastname,
				'{{email}}'=>$model->email,
			));

			$contex=array(
				"body"=>$body,
				"label"=>Yii::t('app','Go to change password'),
				"url"=>r()->createAbsoluteUrl("/users/page/password",array("key"=>r()->security->encrypt($model->email))),
			);
			r('smtp')->add($model->email,$model->name);
			return r('smtp')->sendBody(Yii::t('app','Recover password').' '.strip_tags(r()->name),$contex);
		}
		return false;	
	}

	public function encryptEmail($decriptEmail)
	{
		return r()->security->encrypt($decriptEmail);
	}

	public function decryptEmail($encriptEmail)
	{
		return r()->security->decrypt($encriptEmail);
	}

	/*
	For more then one link
	You can also to use 'items'=>array('label'=>'My other link'...)
	until two levels
	*/
	public function menuItems()
	{
		if($this->enableOAuth)
		{
			return array(
	            array('label'=>$this->labelMenu!==null?$this->labelMenu:Yii::t('app','Users'), 'icon'=>'fa fa-user', 'url'=>'#','items'=>array(
	        		array('label'=>Yii::t('app','Users system'), 'icon'=>'fa fa-users', 'url'=>array('/'.$this->id.'/users')),
    		        array('label'=>Yii::t('app','Profiles system'), 'icon'=>'fa fa-sitemap', 'url'=>array('/'.$this->id.'/profiles/admin'),'visible'=>r()->user->check('root')),
	        		array('label'=>Yii::t('app','Applications'), 'icon'=>'fa fa-mobile', 'url'=>array('/'.$this->id.'/apps'),'visible'=>r()->user->check('root')),
    		        array('label'=>Yii::t('app','API'), 'icon'=>'fa fa-code', 'url'=>array('/'.$this->id.'/api'),'visible'=>r()->user->check('root')),
      
	        	)),
	        );
		}
		return array(
            array('label'=>$this->labelMenu!==null?$this->labelMenu:Yii::t('app','Users system'), 'icon'=>'fa fa-users', 'url'=>array('/'.$this->id.'/users')),
        );
	}
	
	public function validateAjaxLogin($model,$formID='login-form-other')
	{
		// if it is ajax validation request
		if((isset($_POST['ajax']) && $_POST['ajax']==='login-form') or
			(isset($_POST['ajax']) && $_POST['ajax']===$formID))
		{
			if($model->getErrors()!==array())
			{
				foreach($model->getErrors() as $attribute=>$errors)
					$result[CHtml::activeId($model,$attribute)]=$errors;	
				echo CJSON::encode($result);
				r()->end();
			}
		}
	}

	public function validateAjaxSignUp($model,$formID='registration-form')
	{
		// if it is ajax validation request
		if((isset($_POST['ajax']) && $_POST['ajax']==='signup-form') or
			(isset($_POST['ajax']) && $_POST['ajax']===$formID))
		{
			if($model->getErrors()!==array())
			{
				foreach($model->getErrors() as $attribute=>$errors)
					$result[CHtml::activeId($model,$attribute)]=$errors;	
				echo CJSON::encode($result);
				r()->end();
			}
		}
	}

	public function actionLogin()
	{
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			return $model->validate() && $model->login();
		}
		return false;
	}

	public function loadModel()
	{
		if(!r()->user->isGuest)
			return Users::model()->findByPk(r()->user->id);
		return null;
	}

	public function getListUsers()
	{
		return CHtml::listData(Users::model()->findAll('state=1'),'id','fullname');
	}

	public function check($roles=null)
	{
		$args=func_get_args();
		if($args!==array() and count($args)>1)
			$roles=$args;
		return r()->user->check($roles);
	}
	
	public function getName()
	{
		return r()->user->name;
	}

	public function getEmail()
	{
		return r()->user->email;
	}

	public function configItems()
	{
		return array(
	    	// array('label'=>Yii::t('app','Users'), 'icon'=>'fa fa-cogs', 'url'=>array('/'.$this->id.'/config'),'visible'=>$this->check('root')),
			array('label'=>Yii::t('app','Welcome email copies'), 'icon'=>'fa fa-envelope', 'url'=>array('/'.$this->id.'/email_welcome')),
			array('label'=>Yii::t('app','Password email copies'), 'icon'=>'fa fa-envelope', 'url'=>array('/'.$this->id.'/email_password')),
    	);
	}


	public function builtApp($ctr)
	{
		if($this->_config===null)
			$this->_config=UsersConfig::model()->find();
	
		if($this->_config!==null)
		{
			$this->copyWelcomeEmail=($this->_config->copyWelcomeEmail!==null)?$this->_config->copyWelcomeEmail:$this->copyWelcomeEmail;
			$this->copySendPasswordForgot=($this->_config->copySendPasswordForgot!==null)?$this->_config->copySendPasswordForgot:$this->copySendPasswordForgot;
			$this->copyForgotEmail=($this->_config->copyForgotEmail!==null)?$this->_config->copyForgotEmail:$this->copyForgotEmail;
			$this->copySendPassword=($this->_config->copySendPassword!==null)?$this->_config->copySendPassword:$this->copySendPassword;
		}
	}
}