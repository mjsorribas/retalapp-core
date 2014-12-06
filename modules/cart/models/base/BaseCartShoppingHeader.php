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
 * @property integer $overall_tax
 * @property integer $cart_states_id
 * @property string $signature
 * @property string $created_at
 * @property string $updated_at
 * @property string $datetime_go_pay
 * @property string $datetime_return_pay
 * @property string $message_return_pay
 * @property string $code_response_pay
 * @property string $code2_response_pay
 * @property string $comment
 */
class BaseCartShoppingHeader extends Model
{

	public function afterFind()
	{
		parent::afterFind();
	}

	protected function beforeValidate()
	{
		$this->total=strtr($this->total,array(","=>""));
		$this->shipping_cost=strtr($this->shipping_cost,array(","=>""));
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart_shopping_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, total, overall_tax, cart_states_id, created_at, updated_at', 'required'),
			array('users_id, overall_tax, cart_states_id', 'numerical', 'integerOnly'=>true),
			array('total, shipping_cost', 'numerical'),
			#array('created_at, updated_at, datetime_go_pay, datetime_return_pay', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('ref_venta', 'length', 'max'=>50),
			array('users_id, overall_tax, cart_states_id', 'length', 'max'=>11),
			array('signature', 'length', 'max'=>255),
			array('code_response_pay, code2_response_pay', 'length', 'max'=>100),
			array('message_return_pay, comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_venta, users_id, total, shipping_cost, overall_tax, cart_states_id, signature, created_at, updated_at, datetime_go_pay, datetime_return_pay, message_return_pay, code_response_pay, code2_response_pay, comment', 'safe', 'on'=>'search'),
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
			'ref_venta' => Yii::t('app','Ref Venta'),
			'users_id' => Yii::t('app','Users'),
			'total' => Yii::t('app','Total'),
			'shipping_cost' => Yii::t('app','Shipping Cost'),
			'overall_tax' => Yii::t('app','Overall Tax'),
			'cart_states_id' => Yii::t('app','Cart States'),
			'signature' => Yii::t('app','Signature'),
			'created_at' => Yii::t('app','Created At'),
			'updated_at' => Yii::t('app','Updated At'),
			'datetime_go_pay' => Yii::t('app','Datetime Go Pay'),
			'datetime_return_pay' => Yii::t('app','Datetime Return Pay'),
			'message_return_pay' => Yii::t('app','Message Return Pay'),
			'code_response_pay' => Yii::t('app','Response Pay'),
			'code2_response_pay' => Yii::t('app','Code2 Response Pay'),
			'comment' => Yii::t('app','Comment'),
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
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('total',$this->total);
		$criteria->compare('shipping_cost',$this->shipping_cost);
		$criteria->compare('overall_tax',$this->overall_tax);
		$criteria->compare('cart_states_id',$this->cart_states_id);
		$criteria->compare('signature',$this->signature,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('datetime_go_pay',$this->datetime_go_pay,true);
		$criteria->compare('datetime_return_pay',$this->datetime_return_pay,true);
		$criteria->compare('message_return_pay',$this->message_return_pay,true);
		$criteria->compare('code_response_pay',$this->code_response_pay,true);
		$criteria->compare('code2_response_pay',$this->code2_response_pay,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->order='created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
