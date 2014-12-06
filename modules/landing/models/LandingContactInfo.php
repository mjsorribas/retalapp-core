<?php

/**
 * This is the model class for table "landing_contact_info".
 *
 * The followings are the available columns in table 'landing_contact_info':
 * @property integer $id
 * @property string $call_to_action
 * @property string $email
 * @property string $phone
 * @property string $facebook
 * @property string $google_plus
 * @property string $twitter
 * @property string $linkedin
 * @property string $dribbble
 * @property string $youtube
 * @property string $pinterest
 * @property string $skype
 * @property string $instagram
 * @property string $github
 */
class LandingContactInfo extends BaseLandingContactInfo
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
		return array_merge(parent::attributeLabels(),array(
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
}
