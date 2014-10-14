<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CBaseUserIdentity
{

//        const ERROR_NONE=0;
//	const ERROR_USERNAME_INVALID=1;
//	const ERROR_PASSWORD_INVALID=2;
//	const ERROR_UNKNOWN_IDENTITY=100;

	const ERROR_CANNOT_ORDER = 3;

	public $_id;
	public $email;

	/**
	 * @var string username
	 */
	public $username;

	/**
	 * @var string password
	 */
	public $password;

	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

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
		$email = strtolower($this->email);
		$user = User::model()->find('email=?', array(
			$email));

		if($user === NULL)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if(!$user->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$this->_id = $user->userId;
			$this->email = $user->email;
			$this->setState('userType', $user->type);
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode === self::ERROR_NONE;
	}

	public function checkoutAuthenticate()
	{
		$email = strtolower($this->email);
		$user = User::model()->find('email=?', array(
			$email));

		if($user === NULL)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else
		{
			if($user->type == 3 || $user->type == 4 || $user->type == 5 || $user->type == 6)
			{
				$this->errorCode = self::ERROR_CANNOT_ORDER;
			}
			else
			{
				if(!$user->validatePassword($this->password))
				{
					$this->errorCode = self::ERROR_PASSWORD_INVALID;
				}
				else
				{
					$this->_id = $user->userId;
					$this->email = $user->email;
					$this->setState('userType', $user->type);
					$supplierId = $user->getSupplierId();
					if(isset($supplierId))
					{
						$this->setState('supplierId', $user->getSupplierId());
					}
					$this->errorCode = self::ERROR_NONE;
				}
			}
		}
		return $this->errorCode === self::ERROR_NONE;
	}

	/**
	 * Authenticates a user based on {@link username} and {@link password}.
	 * Derived classes should override this method, or an exception will be thrown.
	 * This method is required by {@link IUserIdentity}.
	 * @return boolean whether authentication succeeds.
	 */
//	public function authenticate()
//	{
//		throw new CException(Yii::t('yii','{class}::authenticate() must be implemented.',array('{class}'=>get_class($this))));
//	}

	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->email;
	}

}
