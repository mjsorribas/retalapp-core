<?php

/**
 * This is the model class for table "contact_info".
 *
 * The followings are the available columns in table 'contact_info':
 * @property integer $id
 * @property string $email
 * @property string $title
 * @property string $subtitle
 * @property string $contact_text
 * @property string $address
 * @property string $phone
 * @property string $facebook
 * @property string $twitter
 * @property string $google_plus
 * @property string $linked_in
 * @property string $youtube
 * @property string $skype
 * @property string $map_address
 * @property double $map_address_lat
 * @property double $map_address_lng
 */
class BaseContactInfo extends Model
{

	public function afterFind()
	{
		parent::afterFind();
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
		return 'contact_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, title, subtitle, contact_text, address, phone, map_address, map_address_lat, map_address_lng', 'required'),
			array('email', 'email'),
			array('facebook, twitter, google_plus, linked_in, youtube', 'url'),
			array('email, skype, map_address', 'length', 'max'=>255),
			array('title, subtitle, phone', 'length', 'max'=>100),
			array('address', 'length', 'max'=>266),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, title, subtitle, contact_text, address, phone, facebook, twitter, google_plus, linked_in, youtube, skype, map_address, map_address_lat, map_address_lng', 'safe', 'on'=>'search'),
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
			'email' => Yii::t('app','Email'),
			'title' => Yii::t('app','Title'),
			'subtitle' => Yii::t('app','Subtitle'),
			'contact_text' => Yii::t('app','Contact Text'),
			'address' => Yii::t('app','Address'),
			'phone' => Yii::t('app','Phone'),
			'facebook' => Yii::t('app','Facebook'),
			'twitter' => Yii::t('app','Twitter'),
			'google_plus' => Yii::t('app','Google Plus'),
			'linked_in' => Yii::t('app','Linked In'),
			'youtube' => Yii::t('app','Youtube'),
			'skype' => Yii::t('app','Skype'),
			'map_address' => Yii::t('app','Address'),
			'map_address_lat' => Yii::t('app','Address Lat'),
			'map_address_lng' => Yii::t('app','Address Lng'),
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('contact_text',$this->contact_text,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('google_plus',$this->google_plus,true);
		$criteria->compare('linked_in',$this->linked_in,true);
		$criteria->compare('youtube',$this->youtube,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('map_address',$this->map_address,true);
		$criteria->compare('map_address_lat',$this->map_address_lat);
		$criteria->compare('map_address_lng',$this->map_address_lng);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','email');
	}
}