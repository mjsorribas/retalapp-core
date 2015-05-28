<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingHeader::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingHeader;
 * $model->ref_venta='value';
 * $model->buyer_name='value';
 * $model->buyer_email='value';
 * $model->buyer_phone='value';
 * $model->buyer_address='value';
 * $model->buyer_message='value';
 * $model->send_name='value';
 * $model->send_phone='value';
 * $model->send_address='value';
 * $model->send_date='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->state='value';
 * $model->pol_response='value';
 * $model->datetime_return_pay='value';
 * $model->message_return_pay='value';
 * $model->code_response_pay='value';
 * $model->code2_response_pay='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_header=ShoppingHeader::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_header as $data): ?>
 * <?=$data->id;?>
 * <?=$data->ref_venta;?>
 * <?=$data->buyer_name;?>
 * <?=$data->buyer_email;?>
 * <?=$data->buyer_phone;?>
 * <?=$data->buyer_address;?>
 * <?=r()->format->toBr($data->buyer_message);?>
 * <?=$data->send_name;?>
 * <?=$data->send_phone;?>
 * <?=$data->send_address;?>
 * <?=r()->format->formatShort($data->send_date);?>
 * <?=r()->format->formatAgoComment($data->send_date);?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?=$data->state;?>
 * <?=$data->pol_response;?>
 * <?=r()->format->formatShort($data->datetime_return_pay);?>
 * <?=r()->format->formatAgoComment($data->datetime_return_pay);?>
 * <?=$data->message_return_pay;?>
 * <?=$data->code_response_pay;?>
 * <?=$data->code2_response_pay;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_header=ShoppingHeader::model()->find();
 * <?=$shopping_header->id;?>
 * <?=$shopping_header->ref_venta;?>
 * <?=$shopping_header->buyer_name;?>
 * <?=$shopping_header->buyer_email;?>
 * <?=$shopping_header->buyer_phone;?>
 * <?=$shopping_header->buyer_address;?>
 * <?=r()->format->toBr($shopping_header->buyer_message);?>
 * <?=$shopping_header->send_name;?>
 * <?=$shopping_header->send_phone;?>
 * <?=$shopping_header->send_address;?>
 * <?=r()->format->formatShort($shopping_header->send_date);?>
 * <?=r()->format->formatAgoComment($shopping_header->send_date);?>
 * <?=r()->format->formatShort($shopping_header->created_at);?>
 * <?=r()->format->formatAgoComment($shopping_header->created_at);?>
 * <?=$shopping_header->state;?>
 * <?=$shopping_header->pol_response;?>
 * <?=r()->format->formatShort($shopping_header->datetime_return_pay);?>
 * <?=r()->format->formatAgoComment($shopping_header->datetime_return_pay);?>
 * <?=$shopping_header->message_return_pay;?>
 * <?=$shopping_header->code_response_pay;?>
 * <?=$shopping_header->code2_response_pay;?>
 * 
 * This is the model class for table "shopping_header".
 *
 * The followings are the available columns in table 'shopping_header':
 * @property integer $id
 * @property string $ref_venta
 * @property string $buyer_name
 * @property string $buyer_email
 * @property string $buyer_phone
 * @property string $buyer_address
 * @property string $buyer_message
 * @property string $send_name
 * @property string $send_phone
 * @property string $send_address
 * @property string $send_date
 * @property string $created_at
 * @property integer $state
 * @property string $pol_response
 * @property string $datetime_return_pay
 * @property string $message_return_pay
 * @property string $code_response_pay
 * @property string $code2_response_pay
 *
 * The followings are the available model relations:
 * @property ShoppingDetail[] $shoppingDetails
 */
class BaseShoppingHeader extends Model
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
		return 'shopping_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_venta, buyer_name, buyer_email, created_at', 'required'),
			array('state', 'numerical', 'integerOnly'=>true),
			array('buyer_email', 'email'),
			array('created_at, datetime_return_pay', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('send_date', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd'),
			array('ref_venta, buyer_name, buyer_email, buyer_phone, buyer_address, send_name, send_phone, send_address, pol_response, message_return_pay, code_response_pay, code2_response_pay', 'length', 'max'=>255),
			array('state', 'length', 'max'=>1),
			array('buyer_message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_venta, buyer_name, buyer_email, buyer_phone, buyer_address, buyer_message, send_name, send_phone, send_address, send_date, created_at, state, pol_response, datetime_return_pay, message_return_pay, code_response_pay, code2_response_pay', 'safe', 'on'=>'search'),
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
			'shoppingDetails' => array(self::HAS_MANY, 'ShoppingDetail', 'shopping_header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'ref_venta' => Yii::t('app','Ref Venta'),
			'buyer_name' => Yii::t('app','Nombre comprador'),
			'buyer_email' => Yii::t('app','Correo comprador'),
			'buyer_phone' => Yii::t('app','Teléfono comprador'),
			'buyer_address' => Yii::t('app','Dirección comprador'),
			'buyer_message' => Yii::t('app','Mensaje para el destinatario'),
			'send_name' => Yii::t('app','Nombre destinatario'),
			'send_phone' => Yii::t('app','Teléfono destanatario'),
			'send_address' => Yii::t('app','Dirección destinatario'),
			'send_date' => Yii::t('app','Fecha de entrega'),
			'created_at' => Yii::t('app','Fecha de la compra'),
			'state' => Yii::t('app','Estado de la compra'),
			'pol_response' => Yii::t('app','Respuesta de pasarela de pagos'),
			'datetime_return_pay' => Yii::t('app','Datetime Return Pay'),
			'message_return_pay' => Yii::t('app','Message Return Pay'),
			'code_response_pay' => Yii::t('app','Response Pay'),
			'code2_response_pay' => Yii::t('app','Code2 Response Pay'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','ref_venta');
	}
}