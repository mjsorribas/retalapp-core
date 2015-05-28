<?php

/**
 * This is the model class for table "shopping_header".
 *
 * The followings are the available columns in table 'shopping_header':
 * @property integer $id
 * @property string $buyer_name
 * @property string $buyer_email
 * @property string $buyer_phone
 * @property string $buyer_address
 * @property string $buyer_message
 * @property string $send_name
 * @property string $send_phone
 * @property string $send_address
 * @property string $send_date
 * @property integer $created_at
 * @property integer $state
 * @property string $pol_response
 */
class ShoppingHeader extends BaseShoppingHeader
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(r('shopping')->addressRequired) {
			return array_merge(parent::rules(),array(
				array('buyer_address','required','on'=>'delivery'),
				array('buyer_id','safe'),
			));
		} else {
			return array_merge(parent::rules(),array(
				// array('buyer_address','required','on'=>'delivery'),
				array('buyer_id','safe'),
			));
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(),array(
			'details'=>array(self::HAS_MANY,'ShoppingDetail','shopping_header_id')
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
			'message_return_pay'=>r('app','Respuesta de PAYU'),
			'datetime_return_pay'=>r('app','Fecha respuesta de PAYU'),
			'code_response_pay'=>r('app','Código respuesta de PAYU'),
			'code2_response_pay'=>r('app','Código 2 respuesta de PAYU'),
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

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ref_venta',$this->ref_venta,true);
		$criteria->compare('buyer_name',$this->buyer_name,true);
		$criteria->compare('buyer_email',$this->buyer_email,true);
		$criteria->compare('buyer_phone',$this->buyer_phone,true);
		$criteria->compare('buyer_address',$this->buyer_address,true);
		$criteria->compare('buyer_message',$this->buyer_message,true);
		$criteria->compare('send_name',$this->send_name,true);
		$criteria->compare('send_phone',$this->send_phone,true);
		$criteria->compare('send_address',$this->send_address,true);
		$criteria->compare('send_date',$this->send_date,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('pol_response',$this->pol_response,true);
		$criteria->compare('datetime_return_pay',$this->datetime_return_pay,true);
		$criteria->compare('message_return_pay',$this->message_return_pay,true);
		$criteria->compare('code_response_pay',$this->code_response_pay,true);
		$criteria->compare('code2_response_pay',$this->code2_response_pay,true);
		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getStatesValues()
	{
		return array(
			'0'=>'Pendiente',
			'1'=>'Pagada',
			'2'=>'Pedido',
			'3'=>'Rechazada',
		);
	}

	public function getStateLabel()
	{
		if($this->state==0)
			return '<span class="label label-warning">'.Yii::t('app','Pendiente').'</span>';
		else if($this->state==1)
			return '<span class="label label-success">'.Yii::t('app','Pagada').'</span>';
		else if($this->state==2)
			return '<span class="label label-info">'.Yii::t('app','Pedido').'</span>';
		else if($this->state==4)
			return '<span class="label label-success">'.Yii::t('app','Gratis').'</span>';
		else if($this->state==3)
			return '<span class="label label-danger">'.Yii::t('app','Rechazada-Cancelada').'</span>';
		return "Sin definir";
	}

	public function getStateName()
	{
		if($this->state==0)
			return Yii::t('app','Pendiente');
		else if($this->state==1)
			return Yii::t('app','Pagada');
		else if($this->state==2)
			return Yii::t('app','Pedido');
		else if($this->state==3)
			return Yii::t('app','Rechazada-Cancelada');
		else if($this->state==4)
			return Yii::t('app','Gratis');
		return "Sin definir";
	}

	public function getTotalPurchase()
	{
		$total=0;
		foreach($this->details as $data)
			$total+=$data->price*$data->amount;
		return $total;
	}
}
