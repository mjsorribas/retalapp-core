<?php

/**
 * This is the model class for table "cart_shipment_data".
 *
 * The followings are the available columns in table 'cart_shipment_data':
 * @property integer $id
 * @property integer $users_users_id
 * @property integer $users_country_delivery_id
 * @property integer $users_state_delivery_id
 * @property integer $users_city_delivery_id
 * @property string $address_delivery
 * @property string $contact_receiving
 * @property string $contact_phone
 * @property string $comment
 * @property integer $deliver_same_address
 * @property string $contact_mobile
 * @property string $contact_id
 */
class BaseCartShipmentData extends Model
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
		return 'cart_shipment_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_users_id, address_delivery, contact_receiving, contact_phone', 'required'),
			array('users_country_delivery_id, users_state_delivery_id, users_city_delivery_id', 'numerical', 'integerOnly'=>true),
			array('deliver_same_address', 'boolean'),
			array('users_users_id', 'exist', 'attributeName'=>'id', 'className'=>'Users'),
			array('users_country_delivery_id, users_state_delivery_id, users_city_delivery_id', 'length', 'max'=>11),
			array('address_delivery, contact_receiving', 'length', 'max'=>255),
			array('contact_phone, contact_mobile', 'length', 'max'=>100),
			array('contact_id', 'length', 'max'=>200),
			array('comment, deliver_same_address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, users_users_id, users_country_delivery_id, users_state_delivery_id, users_city_delivery_id, address_delivery, contact_receiving, contact_phone, comment, deliver_same_address, contact_mobile, contact_id', 'safe', 'on'=>'search'),
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
			'users_users_id' => Yii::t('app','Users Users'),
			'users_country_delivery_id' => Yii::t('app','Users Country Delivery'),
			'users_state_delivery_id' => Yii::t('app','Users State Delivery'),
			'users_city_delivery_id' => Yii::t('app','Users City Delivery'),
			'address_delivery' => Yii::t('app','Address Delivery'),
			'contact_receiving' => Yii::t('app','Contact Receiving'),
			'contact_phone' => Yii::t('app','Contact Phone'),
			'comment' => Yii::t('app','Comment'),
			'deliver_same_address' => Yii::t('app','Deliver Same Address'),
			'contact_mobile' => Yii::t('app','Contact Mobile'),
			'contact_id' => Yii::t('app','Contact'),
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
		$criteria->compare('users_users_id',$this->users_users_id);
		$criteria->compare('users_country_delivery_id',$this->users_country_delivery_id);
		$criteria->compare('users_state_delivery_id',$this->users_state_delivery_id);
		$criteria->compare('users_city_delivery_id',$this->users_city_delivery_id);
		$criteria->compare('address_delivery',$this->address_delivery,true);
		$criteria->compare('contact_receiving',$this->contact_receiving,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('deliver_same_address',$this->deliver_same_address);
		$criteria->compare('contact_mobile',$this->contact_mobile,true);
		$criteria->compare('contact_id',$this->contact_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
