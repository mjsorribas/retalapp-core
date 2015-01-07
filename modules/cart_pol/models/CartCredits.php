<?php

/**
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
 * @property integer $sub
 */
class CartCredits extends BaseCartCredits
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
			array('users_location_cities_id, users_location_states_id, secret_code','required','on'=>'add_points'),
			array('secret_code','validateCode','on'=>'add_points'),
		));
	}

	public function validateCode($attr,$params)
	{
		if(!empty($this->secret_code))
		{
			$model=CartSecretCodes::model()->find('secret_code=?',array($this->secret_code));
			if($model===null)
				$this->addError('secret_code',r('app','This code {code} is invalid',array('{code}'=>$this->secret_code)));
			else if($model->state==0)
				$this->addError('secret_code',r('app','This code {code} has been used',array('{code}'=>$this->secret_code)));
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
			'user'=>array(self::BELONGS_TO,'Users','users_users_id')
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
			'id' => Yii::t('app','ID'),
			'date_transaction' => Yii::t('app','Fecha'),
			'quantity' => Yii::t('app','Quantity'),
			'users_users_id' => Yii::t('app','User'),
			'created_at' => Yii::t('app','Created At'),
			'description' => Yii::t('app','Description'),
			'value' => Yii::t('app','Value'),
			'state' => Yii::t('app','State'),
			'secret_code' => Yii::t('app','Secret Code'),
			'users_location_cities_id' => Yii::t('app','City'),
			'users_location_states_id' => Yii::t('app','Location State'),
			'sub' => Yii::t('app','Sub'),
			'expired_at' => Yii::t('app','Expired At'),
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

	public static function getSummaryPoints($userID=null)
	{
		if($userID!==null)
		{
			$sub=r()->db->createCommand("SELECT SUM(quantity)
				FROM cart_credits WHERE sub=1 AND users_users_id={$userID}")->queryScalar();
			$add=r()->db->createCommand("SELECT SUM(quantity)
				FROM cart_credits WHERE sub=0 AND users_users_id={$userID} AND expired_at > NOW()")->queryScalar();
			return ($add-$sub);
		}
		return 0;
	}
}
