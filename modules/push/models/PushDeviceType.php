<?php

/**
 * This is the model class for table "push_device_type".
 *
 * The followings are the available columns in table 'push_device_type':
 * @property integer $id
 * @property string $tipo
 *
 * The followings are the available model relations:
 * @property PushMobiles[] $pushMobiles
 */
class PushDeviceType extends BasePushDeviceType
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
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return parent::attributeLabels();
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
}
