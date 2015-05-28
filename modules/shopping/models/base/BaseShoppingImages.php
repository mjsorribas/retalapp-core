<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingImages::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingImages;
 * $model->image='value';
 * $last=ShoppingImages::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->shopping_items_id='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_images=ShoppingImages::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_images as $data): ?>
 * <?=$data->id;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->orden_id;?>
 * <?=$data->shopping_items_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_images=ShoppingImages::model()->find();
 * <?=$shopping_images->id;?>
 * <?=$shopping_images->image_path;?>
 * <?=CHtml::image($shopping_images->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$shopping_images->orden_id;?>
 * <?=$shopping_images->shopping_items_id;?>
 * 
 * This is the model class for table "shopping_images".
 *
 * The followings are the available columns in table 'shopping_images':
 * @property integer $id
 * @property string $image
 * @property integer $orden_id
 * @property integer $shopping_items_id
 */
class BaseShoppingImages extends Model
{
	public $image_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->image_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image;
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shopping_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, orden_id, shopping_items_id', 'required'),
			array('orden_id, shopping_items_id', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>100),
			array('orden_id, shopping_items_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, orden_id, shopping_items_id', 'safe', 'on'=>'search'),
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
			'image' => Yii::t('app','Imagen'),
			'orden_id' => Yii::t('app','Orden'),
			'shopping_items_id' => Yii::t('app','Shopping Items'),
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
		$criteria->compare('image',$this->image,true);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);
		$criteria->compare('shopping_items_id',$this->shopping_items_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','image');
	}
}