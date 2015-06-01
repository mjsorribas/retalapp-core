<?php

/**
 * This is the model class for table "landing_pages".
 *
 * The followings are the available columns in table 'landing_pages':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $video
 * @property string $image
 * @property string $call
 * @property string $call_text
 * @property string $code
 * @property string $created_at
 * @property integer $orden_id
 */
class LandingPages extends BaseLandingPages
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
			'features'=>array(self::HAS_MANY,'LandingFeatures','landing_pages_id')
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
