<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingInfo::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingInfo;
 * $model->description='value';
 * $model->title='value';
 * $model->image='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_info=ShoppingInfo::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_info as $data): ?>
 * <?=$data->id;?>
 * <?=r()->format->toBr($data->description);?>
 * <?=$data->title;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_info=ShoppingInfo::model()->find();
 * <?=$shopping_info->id;?>
 * <?=r()->format->toBr($shopping_info->description);?>
 * <?=$shopping_info->title;?>
 * <?=$shopping_info->image_path;?>
 * <?=CHtml::image($shopping_info->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * 
 * This is the model class for table "shopping_info".
 *
 * The followings are the available columns in table 'shopping_info':
 * @property integer $id
 * @property string $description
 * @property string $title
 * @property string $image
 */
class BaseShoppingInfo extends Model
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
		return 'shopping_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, title, image', 'required'),
			array('title', 'length', 'max'=>50),
			array('image', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, title, image', 'safe', 'on'=>'search'),
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
			'description' => Yii::t('app','Descripción'),
			'title' => Yii::t('app','Título'),
			'image' => Yii::t('app','Imagen de fondo'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','description');
	}
}