<?php

/**
 * This is the model class for table "cart_shopping_detail".
 *
 * The followings are the available columns in table 'cart_shopping_detail':
 * @property integer $id
 * @property integer $cart_shoping_header_id
 * @property integer $product_id
 * @property string $table_related
 * @property double $unit_value
 * @property string $currency
 * @property integer $quantity
 * @property integer $tax_rate
 * @property string $created_at
 */
class BaseCartShoppingDetail extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart_shopping_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cart_shoping_header_id, product_id, table_related, unit_value, quantity, tax_rate, created_at', 'required'),
			array('cart_shoping_header_id, product_id, quantity, tax_rate', 'numerical', 'integerOnly'=>true),
			array('unit_value', 'numerical'),
			array('cart_shoping_header_id, product_id, quantity, tax_rate', 'length', 'max'=>11),
			array('table_related', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cart_shoping_header_id, product_id, table_related, unit_value, currency, quantity, tax_rate, created_at', 'safe', 'on'=>'search'),
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
			'cart_shoping_header_id' => Yii::t('app','Cart Shoping Header'),
			'product_id' => Yii::t('app','Product'),
			'table_related' => Yii::t('app','Table Related'),
			'unit_value' => Yii::t('app','Unit Value'),
			'currency' => Yii::t('app','Currency'),
			'quantity' => Yii::t('app','Quantity'),
			'tax_rate' => Yii::t('app','Tax Rate'),
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
		$criteria->compare('cart_shoping_header_id',$this->cart_shoping_header_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('table_related',$this->table_related,true);
		$criteria->compare('unit_value',$this->unit_value);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('tax_rate',$this->tax_rate);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
