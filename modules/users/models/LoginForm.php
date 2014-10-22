<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			#array('username', 'email'),
			array('rememberMe', 'boolean'),
			array('username', 'validateEmailEnabled'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>Yii::t('app','Remember me next time'),
			'username'=>Yii::t('app','Username or email'),
			'password'=>Yii::t('app','Password'),
		);
	}

	public function validateEmailEnabled($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$model=Users::model()->find('email=? AND trash=0',array($this->username));
			if($model!==null and $model->state_email==0)
				$this->addError('username',Yii::t('app',"Your email dosen't has been verified yet, please click {here} for resend email.",
					array('{here}'=>CHtml::link(Yii::t('app','Here'),array('/users/page/resendVerify','email'=>$model->email)))));
			if($model!==null and $model->state!=1)
				$this->addError('username',Yii::t('app',"Your username has been desabled"));
		}
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password',Yii::t('app','Incorrect username or password.'));
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
