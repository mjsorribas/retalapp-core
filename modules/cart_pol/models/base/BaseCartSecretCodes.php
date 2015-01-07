<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=CartSecretCodes::model()->findByPk($id);
 * // Or create a new record
 * // $model=new CartSecretCodes;
 * $model->secret_code='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->state='value';
 * $model->cart_upload_id='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $cart_secret_codes=CartSecretCodes::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($cart_secret_codes as $data): ?>
 * <?=$data->id;?>
 * <?=$data->secret_code;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?=$data->state;?>
 * <?=$data->cart_upload_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $cart_secret_codes=CartSecretCodes::model()->find();
 * <?=$cart_secret_codes->id;?>
 * <?=$cart_secret_codes->secret_code;?>
 * <?=r()->format->formatShort($cart_secret_codes->created_at);?>
 * <?=r()->format->formatAgoComment($cart_secret_codes->created_at);?>
 * <?=$cart_secret_codes->state;?>
 * <?=$cart_secret_codes->cart_upload_id;?>
 * 
 * This is the model class for table "cart_secret_codes".
 *
 * The followings are the available columns in table 'cart_secret_codes':
 * @property integer $id
 * @property string $secret_code
 * @property string $created_at
 * @property integer $state
 * @property integer $cart_upload_id
 */
class BaseCartSecretCodes extends Model
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
		return 'cart_secret_codes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('secret_code, created_at, cart_upload_id', 'required'),
			array('cart_upload_id', 'numerical', 'integerOnly'=>true),
			array('state', 'boolean'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('secret_code', 'unique', 'attributeName'=>'secret_code', 'className'=>'CartSecretCodes'),
			array('secret_code', 'length', 'max'=>100),
			array('cart_upload_id', 'length', 'max'=>11),
			array('state', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, secret_code, created_at, state, cart_upload_id', 'safe', 'on'=>'search'),
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
			'secret_code' => Yii::t('app','Secret Code'),
			'created_at' => Yii::t('app','Created At'),
			'state' => Yii::t('app','State'),
			'cart_upload_id' => Yii::t('app','Cart Upload'),
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
		$criteria->compare('secret_code',$this->secret_code,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('cart_upload_id',$this->cart_upload_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','secret_code');
	}
}