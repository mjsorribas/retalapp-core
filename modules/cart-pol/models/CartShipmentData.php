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
			'city'=>array(self::BELONGS_TO,'UsersCities','users_city_delivery_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return parent::attributeLabels();
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
}
