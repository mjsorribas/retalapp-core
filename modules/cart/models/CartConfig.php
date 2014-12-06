<?php

/**
 * This is the model class for table "cart_config".
 *
 * The followings are the available columns in table 'cart_config':
 * @property integer $id
 * @property integer $overall_tax
 * @property double $shipping_cost
 * @property integer $shipping_data_required
 * @property string $editor_purchase_terms
 * @property string $email_just_test
 * @property string $pol_api_key
 * @property string $pol_merchant_id
 * @property integer $pol_test
 * @property string $pol_currency
 * @property string $pol_description
 */
class CartConfig extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('editor_purchase_terms', 'required'),
			array('overall_tax', 'numerical', 'integerOnly'=>true),
			array('shipping_data_required, pol_test', 'boolean'),
			array('shipping_cost', 'numerical'),
			array('email_just_test', 'email'),
			array('overall_tax', 'length', 'max'=>11),
			array('email_just_test, pol_api_key, pol_merchant_id, pol_description', 'length', 'max'=>255),
			array('pol_currency', 'length', 'max'=>3),
			array('shipping_data_required, pol_test', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, overall_tax, shipping_cost, shipping_data_required, editor_purchase_terms, email_just_test, pol_api_key, pol_merchant_id, pol_test, pol_currency, pol_description', 'safe', 'on'=>'search'),
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
			'overall_tax' => Yii::t('app','Overall Tax'),
			'shipping_cost' => Yii::t('app','Shipping Cost'),
			'shipping_data_required' => Yii::t('app','Shipping Data Required'),
			'editor_purchase_terms' => Yii::t('app','Editor Purchase Terms'),
			'email_just_test' => Yii::t('app','Email Just Test'),
			'pol_api_key' => Yii::t('app','Pol Api Key'),
			'pol_merchant_id' => Yii::t('app','Pol Merchant'),
			'pol_test' => Yii::t('app','Pol Test'),
			'pol_currency' => Yii::t('app','Pol Currency'),
			'pol_description' => Yii::t('app','Pol Description'),
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
		$criteria->compare('overall_tax',$this->overall_tax);
		$criteria->compare('shipping_cost',$this->shipping_cost);
		$criteria->compare('shipping_data_required',$this->shipping_data_required);
		$criteria->compare('editor_purchase_terms',$this->editor_purchase_terms,true);
		$criteria->compare('email_just_test',$this->email_just_test,true);
		$criteria->compare('pol_api_key',$this->pol_api_key,true);
		$criteria->compare('pol_merchant_id',$this->pol_merchant_id,true);
		$criteria->compare('pol_test',$this->pol_test);
		$criteria->compare('pol_currency',$this->pol_currency,true);
		$criteria->compare('pol_description',$this->pol_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CartConfig the static model class
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
