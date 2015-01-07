<?php

/**
 * This is the model class for table "cart_upload".
 *
 * The followings are the available columns in table 'cart_upload':
 * @property integer $id
 * @property string $file
 * @property string $created_at
 * @property integer $users_users_id
 */
class CartUpload extends BaseCartUpload
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(),array(
			'user'=>array(self::BELONGS_TO,'Users','users_users_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
			'id' => Yii::t('app','ID'),
			'file' => Yii::t('app','File'),
			'created_at' => Yii::t('app','Created At'),
			'users_users_id' => Yii::t('app','User owner'),
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
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('users_users_id',$this->users_users_id);
		$criteria->order='created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
