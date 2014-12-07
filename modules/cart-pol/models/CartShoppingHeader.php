<?php

/**
 * This is the model class for table "cart_shopping_header".
 *
 * The followings are the available columns in table 'cart_shopping_header':
 * @property integer $id
 * @property string $ref_venta
 * @property integer $users_id
 * @property double $total
 * @property double $shipping_cost
 * @property integer $cart_states_id
 * @property string $created_at
 * @property string $updated_at
 */
class CartShoppingHeader extends BaseCartShoppingHeader
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
			'cart_shipment_data'=>array(self::HAS_ONE,'CartShipmentData',array('users_users_id'=>'users_id')),
			'state'=>array(self::BELONGS_TO,'CartStates','cart_states_id'),
			'items'=>array(self::HAS_MANY,'CartShoppingDetail','cart_shoping_header_id'),
			'user'=>array(self::BELONGS_TO,'Users','users_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
			'shipping_data'=>Yii::t('app','Shipping Data')
		));
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

	public function getTotalShipping()
	{
		$total=0;
		$total+=$this->getTotalShippingBase();
		$total+=$this->getTotalShippingTax();
		$total+=$this->getTotalShippingCost();
		return $total;
	}

	public function getTotalShippingTax()
	{
		return Yii::app()->getModule('cart')->taxValue($this->getTotalShippingBase(),$this->overall_tax);
	}

	public function getTotalShippingBase()
	{
		$total=0;
		foreach($this->items as $data)
			$total+=$data->unit_value*$data->quantity;
		return $total;
	}

	public function getTotalShippingCost()
	{
		return $this->shipping_cost;
	}

	public function valitadeSignature()
	{
		return true;
	}
}
