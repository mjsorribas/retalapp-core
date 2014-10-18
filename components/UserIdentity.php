<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		#$user=Users::model()->find("LOWER(email)=?",array(strtolower($this->username)));
		$user=Users::model()->find("(LOWER(email)=? OR LOWER(username)=?) AND papelera=0 AND state=1",array(strtolower($this->username),strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(sha1($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->setState("email",$user->email);
			$this->setState("name",$user->name." ".$user->lastname);
			$this->setState("img",$user->getImageUrl());
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticateToken()
	{
		$user=Users::model()->find("(LOWER(email)=? OR LOWER(username)=?) AND papelera=0",array(strtolower($this->username),strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!in_array(sha1($this->password), array($user->password)))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($user->state==2)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		
		if($this->errorCode===self::ERROR_NONE)
			return $user;
		else
			return false;
	}

	public function authenticateFree()
	{
		$user=Users::model()->find("LOWER(email)=?",array(strtolower($this->username)));
		$this->_id=$user->id;
		$this->setState("email",$user->email);
		$this->setState("name",$user->name." ".$user->lastname);
		$this->setState("img",$user->getImageUrl());
		$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}