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
 */
class CartShipmentData extends BaseCartShipmentData
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
			array('users_users_id, address_delivery, contact_receiving, contact_phone, users_city_delivery_id', 'required'),
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(),array(
			'city'=>array(self::BELONGS_TO,'CartShippingRates','users_city_delivery_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'users_users_id' => Yii::t('app','Users'),
			'users_country_delivery_id' => Yii::t('app','Country Delivery'),
			'users_state_delivery_id' => Yii::t('app','State Delivery'),
			'users_city_delivery_id' => Yii::t('app','Ciudad'),
			'address_delivery' => Yii::t('app','Dirección'),
			'contact_receiving' => Yii::t('app','Nombre'),
			'contact_phone' => Yii::t('app','Teléfono'),
			'contact_mobile' => Yii::t('app','Celular'),
			'comment' => Yii::t('app','Comment'),
			'deliver_same_address' => Yii::t('app','Dirección'),
			'contact_mobile' => Yii::t('app','Celular'),
			'contact_id' => Yii::t('app','No.decula'),
		);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * This method is in order to 
	 * Return listData element for fill the select input "dropDownList"
	 * in others forms
	 * @return array key value
	 */
	public static function listData()
	{
		return CHtml::listData(self::model()->findAll(),'id','description'); // change description for your input naem in db table
	}
}
