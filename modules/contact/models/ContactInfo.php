<?php

/**
 * This is the model class for table "contact_info".
 *
 * The followings are the available columns in table 'contact_info':
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $contact_text
 * @property string $address
 * @property string $phone
 * @property string $facebook
 * @property string $twitter
 * @property string $google_plus
 * @property string $linked_in
 * @property string $youtube
 * @property string $skype
 * @property string $map_address
 * @property double $map_address_lat
 * @property double $map_address_lng
 */
class ContactInfo extends BaseContactInfo
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
			'id' => Yii::t('app','ID'),
			'email' => Yii::t('app','Email'),
			'title' => Yii::t('app','Título'),
			'subtitle' => Yii::t('app','Subtitle'),
			'contact_text' => Yii::t('app','Texto informativo'),
			'address' => Yii::t('app','Dirección'),
			'phone' => Yii::t('app','Teléfono'),
			'facebook' => Yii::t('app','Facebook'),
			'twitter' => Yii::t('app','Twitter'),
			'google_plus' => Yii::t('app','Google Plus'),
			'linked_in' => Yii::t('app','Linked In'),
			'youtube' => Yii::t('app','Youtube'),
			'skype' => Yii::t('app','Skype'),
			'map_address' => Yii::t('app','Dirección'),
			'map_address_lat' => Yii::t('app','Address Lat'),
			'map_address_lng' => Yii::t('app','Address Lng'),
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
