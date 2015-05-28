<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingUpdates::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingUpdates;
 * $model->message='value';
 * $last=ShoppingUpdates::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->shopping_items_id='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_updates=ShoppingUpdates::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_updates as $data): ?>
 * <?=$data->id;?>
 * <?=$data->message;?>
 * <?=$data->orden_id;?>
 * <?=$data->shopping_items_id;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_updates=ShoppingUpdates::model()->find();
 * <?=$shopping_updates->id;?>
 * <?=$shopping_updates->message;?>
 * <?=$shopping_updates->orden_id;?>
 * <?=$shopping_updates->shopping_items_id;?>
 * <?=r()->format->formatShort($shopping_updates->created_at);?>
 * <?=r()->format->formatAgoComment($shopping_updates->created_at);?>
 * 
 * This is the model class for table "shopping_updates".
 *
 * The followings are the available columns in table 'shopping_updates':
 * @property integer $id
 * @property string $message
 * @property integer $orden_id
 * @property integer $shopping_items_id
 * @property string $created_at
 */
class BaseShoppingUpdates extends Model
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
		return 'shopping_updates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message, orden_id, shopping_items_id, created_at', 'required'),
			array('orden_id, shopping_items_id', 'numerical', 'integerOnly'=>true),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('orden_id, shopping_items_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, message, orden_id, shopping_items_id, created_at', 'safe', 'on'=>'search'),
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
			'message' => Yii::t('app','Message'),
			'orden_id' => Yii::t('app','Orden'),
			'shopping_items_id' => Yii::t('app','Shopping Items'),
			'created_at' => Yii::t('app','Created At'),
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
		$criteria->compare('message',$this->message,true);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);
		$criteria->compare('shopping_items_id',$this->shopping_items_id);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','message');
	}
}