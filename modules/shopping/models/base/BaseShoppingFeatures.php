<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingFeatures::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingFeatures;
 * $model->image='value';
 * $model->title='value';
 * $model->description='value';
 * $last=ShoppingFeatures::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_features=ShoppingFeatures::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_features as $data): ?>
 * <?=$data->id;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->title;?>
 * <?=r()->format->toBr($data->description);?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_features=ShoppingFeatures::model()->find();
 * <?=$shopping_features->id;?>
 * <?=$shopping_features->image_path;?>
 * <?=CHtml::image($shopping_features->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$shopping_features->title;?>
 * <?=r()->format->toBr($shopping_features->description);?>
 * <?=$shopping_features->orden_id;?>
 * 
 * This is the model class for table "shopping_features".
 *
 * The followings are the available columns in table 'shopping_features':
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property integer $orden_id
 */
class BaseShoppingFeatures extends Model
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
		return 'shopping_features';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, title, description, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('image, title', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, title, description, orden_id', 'safe', 'on'=>'search'),
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
			'title' => Yii::t('app','Título'),
			'description' => Yii::t('app','Descripción'),
			'orden_id' => Yii::t('app','Orden'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);

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