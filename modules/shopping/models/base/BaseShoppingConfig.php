<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingConfig::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingConfig;
 * $model->request_message='value';
 * $model->shopping_description='value';
 * $model->allow_request='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_config=ShoppingConfig::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_config as $data): ?>
 * <?=$data->id;?>
 * <?=$data->request_message;?>
 * <?=$data->shopping_description;?>
 * <?=$data->allow_request;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_config=ShoppingConfig::model()->find();
 * <?=$shopping_config->id;?>
 * <?=$shopping_config->request_message;?>
 * <?=$shopping_config->shopping_description;?>
 * <?=$shopping_config->allow_request;?>
 * 
 * This is the model class for table "shopping_config".
 *
 * The followings are the available columns in table 'shopping_config':
 * @property integer $id
 * @property string $request_message
 * @property string $shopping_description
 * @property integer $allow_request
 */
class BaseShoppingConfig extends Model
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
		return 'shopping_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_message, shopping_description', 'required'),
			array('allow_request', 'boolean'),
			array('shopping_description', 'length', 'max'=>255),
			array('allow_request', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_message, shopping_description, allow_request', 'safe', 'on'=>'search'),
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
			'request_message' => Yii::t('app','Instrucción para pedidos'),
			'shopping_description' => Yii::t('app','Descripción de la compra'),
			'allow_request' => Yii::t('app','Habilitar pago consignación'),
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
		$criteria->compare('request_message',$this->request_message,true);
		$criteria->compare('shopping_description',$this->shopping_description,true);
		$criteria->compare('allow_request',$this->allow_request);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','request_message');
	}
}