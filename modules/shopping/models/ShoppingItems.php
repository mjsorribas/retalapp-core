<?php

/**
 * This is the model class for table "shopping_items".
 *
 * The followings are the available columns in table 'shopping_items':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $description_detail
 * @property double $price
 * @property integer $state
 * @property integer $shopping_categories_id
 * @property integer $orden_id
 * @property string $created_at
 */
class ShoppingItems extends BaseShoppingItems
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
			'shoppingCategories'=>array(self::BELONGS_TO,'ShoppingCategories','shopping_categories_id'),
			'images'=>array(self::HAS_MANY,'ShoppingImages','shopping_items_id','order'=>'images.orden_id'),
			'videos'=>array(self::HAS_MANY,'ShoppingVideos','shopping_items_id','order'=>'videos.orden_id'),
			'facilitador'=>array(self::BELONGS_TO,'ShoppingFacilitador','shopping_facilitador_id'),
			'material'=>array(self::HAS_MANY,'ShoppingMaterial','shopping_items_id','order'=>'material.orden_id'),
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



	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','name');
	}
}
