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
		$users = array(
			// username => password
			'demo' => 'demo',
			'admin' => 'admin',
		);
		if (!isset($users[$this->username]))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		elseif ($users[$this->username] !== $this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode = self::ERROR_NONE;
		return !$this->errorCode;
	}

	/**
	 * @return bool
	 *
	 * replace {user} with your Variable

	public function authenticate()
	{
		$username = strtolower($this->username);
		${user} = {UserModel}::model()->find('username=?', array(
			$username));

		if(${user} === NULL)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if(!${user}->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else if(${user}->status == 2 || ${user}->status == 3)
		{
			$this->errorCode = self::ERROR_STATUS_WRONG;
		} else
		{
			$this->_id = ${user}->{user}Id;
			$this->username = ${user}->username;
			$this->errorCode = self::ERROR_NONE;
		}

		return $this->errorCode === self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}
	*/

	/**
	 * put this in your user model
	 */

	/*
	 public function validatePassword($password)
	{
		return $this->hashPassword($this->username, $password) === $this->password;
	}

	public function hashPassword($username, $password)
	{
		return md5($username . $password);
	}
	 */

}

