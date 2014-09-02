<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $userId
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $password
 * @property string $cart
 * @property string $wishlist
 * @property integer $newsletter
 * @property string $ip
 * @property integer $status
 * @property integer $approved
 * @property string $token
 * @property integer $type
 * @property integer $isFirstLogin
 * @property string $description
 * @property string $logo
 * @property string $createDateTime
 * @property string $map
 * @property string $minimumOrder
 * @property string $referenceId
 * @property integer $collectedPoint
 * @property integer $collectedOrder
 * @property string $redirectURL
 * @property string $taxNumber
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 * @property Product[] $products
 */
class UserMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, approved, token, type', 'required'),
			array('newsletter, status, approved, type, isFirstLogin, collectedPoint, collectedOrder', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, telephone, fax', 'length', 'max'=>32),
			array('email', 'length', 'max'=>96),
			array('password', 'length', 'max'=>40),
			array('ip', 'length', 'max'=>15),
			array('token', 'length', 'max'=>255),
			array('minimumOrder', 'length', 'max'=>14),
			array('referenceId', 'length', 'max'=>20),
			array('redirectURL', 'length', 'max'=>200),
			array('taxNumber', 'length', 'max'=>45),
			array('cart, wishlist, description, logo, createDateTime, map', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userId, firstname, lastname, email, telephone, fax, password, cart, wishlist, newsletter, ip, status, approved, token, type, isFirstLogin, description, logo, createDateTime, map, minimumOrder, referenceId, collectedPoint, collectedOrder, redirectURL, taxNumber, searchText', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'addresses' => array(self::HAS_MANY, 'Address', 'userId'),
			'products' => array(self::HAS_MANY, 'Product', 'supplierId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'password' => 'Password',
			'cart' => 'Cart',
			'wishlist' => 'Wishlist',
			'newsletter' => 'Newsletter',
			'ip' => 'Ip',
			'status' => 'Status',
			'approved' => 'Approved',
			'token' => 'Token',
			'type' => 'Type',
			'isFirstLogin' => 'Is First Login',
			'description' => 'Description',
			'logo' => 'Logo',
			'createDateTime' => 'Create Date Time',
			'map' => 'Map',
			'minimumOrder' => 'Minimum Order',
			'referenceId' => 'Reference',
			'collectedPoint' => 'Collected Point',
			'collectedOrder' => 'Collected Order',
			'redirectURL' => 'Redirect Url',
			'taxNumber' => 'Tax Number',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->userId = $this->searchText;
			$this->firstname = $this->searchText;
			$this->lastname = $this->searchText;
			$this->email = $this->searchText;
			$this->telephone = $this->searchText;
			$this->fax = $this->searchText;
			$this->password = $this->searchText;
			$this->cart = $this->searchText;
			$this->wishlist = $this->searchText;
			$this->newsletter = $this->searchText;
			$this->ip = $this->searchText;
			$this->status = $this->searchText;
			$this->approved = $this->searchText;
			$this->token = $this->searchText;
			$this->type = $this->searchText;
			$this->isFirstLogin = $this->searchText;
			$this->description = $this->searchText;
			$this->logo = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->map = $this->searchText;
			$this->minimumOrder = $this->searchText;
			$this->referenceId = $this->searchText;
			$this->collectedPoint = $this->searchText;
			$this->collectedOrder = $this->searchText;
			$this->redirectURL = $this->searchText;
			$this->taxNumber = $this->searchText;
		}

		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('firstname',$this->firstname,true, 'OR');
		$criteria->compare('lastname',$this->lastname,true, 'OR');
		$criteria->compare('email',$this->email,true, 'OR');
		$criteria->compare('telephone',$this->telephone,true, 'OR');
		$criteria->compare('fax',$this->fax,true, 'OR');
		$criteria->compare('password',$this->password,true, 'OR');
		$criteria->compare('cart',$this->cart,true, 'OR');
		$criteria->compare('wishlist',$this->wishlist,true, 'OR');
		$criteria->compare('newsletter',$this->newsletter);
		$criteria->compare('ip',$this->ip,true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('token',$this->token,true, 'OR');
		$criteria->compare('type',$this->type);
		$criteria->compare('isFirstLogin',$this->isFirstLogin);
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('logo',$this->logo,true, 'OR');
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('map',$this->map,true, 'OR');
		$criteria->compare('minimumOrder',$this->minimumOrder,true, 'OR');
		$criteria->compare('referenceId',$this->referenceId,true, 'OR');
		$criteria->compare('collectedPoint',$this->collectedPoint);
		$criteria->compare('collectedOrder',$this->collectedOrder);
		$criteria->compare('redirectURL',$this->redirectURL,true, 'OR');
		$criteria->compare('taxNumber',$this->taxNumber,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
