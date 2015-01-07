<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=CartCredits::model()->findByPk($id);
 * // Or create a new record
 * // $model=new CartCredits;
 * $model->date_transaction='value';
 * $model->quantity='value';
 * $model->users_users_id=r()->user->id;
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->description='value';
 * $model->value='value';
 * $model->state='value';
 * $model->secret_code='value';
 * $model->users_location_cities_id='value';
 * $model->users_location_states_id='value';
 * $model->sub='value';
 * $model->expired_at='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $cart_credits=CartCredits::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($cart_credits as $data): ?>
 * <?=$data->id;?>
 * <?=r()->format->formatShort($data->date_transaction);?>
 * <?=r()->format->formatAgoComment($data->date_transaction);?>
 * <?=$data->quantity;?>
 * <?=$data->users_users_id;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?=r()->format->toBr($data->description);?>
 * <?=$data->value;?>
 * <?=$data->state;?>
 * <?=$data->secret_code;?>
 * <?=$data->users_location_cities_id;?>
 * <?=$data->users_location_states_id;?>
 * <?=$data->sub;?>
 * <?=r()->format->formatShort($data->expired_at);?>
 * <?=r()->format->formatAgoComment($data->expired_at);?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $cart_credits=CartCredits::model()->find();
 * <?=$cart_credits->id;?>
 * <?=r()->format->formatShort($cart_credits->date_transaction);?>
 * <?=r()->format->formatAgoComment($cart_credits->date_transaction);?>
 * <?=$cart_credits->quantity;?>
 * <?=$cart_credits->users_users_id;?>
 * <?=r()->format->formatShort($cart_credits->created_at);?>
 * <?=r()->format->formatAgoComment($cart_credits->created_at);?>
 * <?=r()->format->toBr($cart_credits->description);?>
 * <?=$cart_credits->value;?>
 * <?=$cart_credits->state;?>
 * <?=$cart_credits->secret_code;?>
 * <?=$cart_credits->users_location_cities_id;?>
 * <?=$cart_credits->users_location_states_id;?>
 * <?=$cart_credits->sub;?>
 * <?=r()->format->formatShort($cart_credits->expired_at);?>
 * <?=r()->format->formatAgoComment($cart_credits->expired_at);?>
 * 
 * This is the model class for table "cart_credits".
 *
 * The followings are the available columns in table 'cart_credits':
 * @property integer $id
 * @property string $date_transaction
 * @property integer $quantity
 * @property integer $users_users_id
 * @property string $created_at
 * @property string $description
 * @property integer $value
 * @property integer $state
 * @property string $secret_code
 * @property integer $users_location_cities_id
 * @property integer $users_location_states_id
 * @property integer $sub
 * @property string $expired_at
 */
class BaseCartCredits extends Model
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
		return 'cart_credits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_transaction, quantity, users_users_id, created_at, description, value', 'required'),
			array('quantity, value, users_location_cities_id, users_location_states_id', 'numerical', 'integerOnly'=>true),
			array('state, sub', 'boolean'),
			array('created_at, expired_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('date_transaction', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd'),
			array('users_users_id', 'exist', 'attributeName'=>'id', 'className'=>'Users'),
			array('secret_code', 'unique', 'attributeName'=>'secret_code', 'className'=>'CartCredits'),
			array('quantity, value, users_location_cities_id, users_location_states_id', 'length', 'max'=>11),
			array('secret_code', 'length', 'max'=>255),
			array('state, sub', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_transaction, quantity, users_users_id, created_at, description, value, state, secret_code, users_location_cities_id, users_location_states_id, sub, expired_at', 'safe', 'on'=>'search'),
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
			'date_transaction' => Yii::t('app','Fecha'),
			'quantity' => Yii::t('app','Quantity'),
			'users_users_id' => Yii::t('app','Users Users'),
			'created_at' => Yii::t('app','Created At'),
			'description' => Yii::t('app','Description'),
			'value' => Yii::t('app','Value'),
			'state' => Yii::t('app','Estado de transacción'),
			'secret_code' => Yii::t('app','Secret Code'),
			'users_location_cities_id' => Yii::t('app','Users Location Cities'),
			'users_location_states_id' => Yii::t('app','Users Location States'),
			'sub' => Yii::t('app','Sub'),
			'expired_at' => Yii::t('app','Expired At'),
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
		$criteria->compare('date_transaction',$this->date_transaction,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('users_users_id',$this->users_users_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('state',$this->state);
		$criteria->compare('secret_code',$this->secret_code,true);
		$criteria->compare('users_location_cities_id',$this->users_location_cities_id);
		$criteria->compare('users_location_states_id',$this->users_location_states_id);
		$criteria->compare('sub',$this->sub);
		$criteria->compare('expired_at',$this->expired_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','date_transaction');
	}
}