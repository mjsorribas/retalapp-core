<?php

/**
 * This is the model class for table "portfolio_items".
 *
 * The followings are the available columns in table 'portfolio_items':
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $preview
 * @property string $image
 * @property string $video
 * @property string $audio
 * @property integer $prominent
 * @property double $created_at
 * @property integer $orden_id
 */
class PortfolioItems extends BasePortfolioItems
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
