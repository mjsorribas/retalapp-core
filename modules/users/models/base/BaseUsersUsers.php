<?php

/**
 * This is the model class for table "users_users".
 *
 * The followings are the available columns in table 'users_users':
 * @property integer $id
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $lastname
 * @property string $username
 * @property integer $state
 * @property integer $state_email
 * @property string $img
 * @property string $registered
 * @property integer $trash
 */
class BaseUsersUsers extends Model
{
	public $img_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->img_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->img;
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password', 'ext.validators.PasswordStrength','strength'=>'weak'/*weak or strong*/),
			array('password, email, name, lastname, username, state, registered', 'required'),
			array('state, state_email, trash', 'boolean'),
			array('registered', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('password, email', 'length', 'max'=>128),
			array('name, lastname, username, img', 'length', 'max'=>255),
			array('state, state_email, trash', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, password, email, name, lastname, username, state, state_email, img, registered, trash', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'password' => Yii::t('app','Password'),
			'email' => Yii::t('app','Email'),
			'name' => Yii::t('app','Name'),
			'lastname' => Yii::t('app','Lastname'),
			'username' => Yii::t('app','Username'),
			'state' => Yii::t('app','State'),
			'state_email' => Yii::t('app','State Email'),
			'img' => Yii::t('app','Image'),
			'registered' => Yii::t('app','Registered'),
			'trash' => Yii::t('app','Trash'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('state_email',$this->state_email);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('registered',$this->registered,true);
		$criteria->compare('trash',$this->trash);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','password');
	}
}