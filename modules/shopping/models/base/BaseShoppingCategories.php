<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingCategories::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingCategories;
 * $model->name='value';
 * $model->slug='value';
 * $model->color='value';
 * $model->icon='value';
 * $last=ShoppingCategories::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_categories=ShoppingCategories::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_categories as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=$data->slug;?>
 * <?=$data->color;?>
 * <?=$data->icon;?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_categories=ShoppingCategories::model()->find();
 * <?=$shopping_categories->id;?>
 * <?=$shopping_categories->name;?>
 * <?=$shopping_categories->slug;?>
 * <?=$shopping_categories->color;?>
 * <?=$shopping_categories->icon;?>
 * <?=$shopping_categories->orden_id;?>
 * 
 * This is the model class for table "shopping_categories".
 *
 * The followings are the available columns in table 'shopping_categories':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $color
 * @property string $icon
 * @property integer $orden_id
 */
class BaseShoppingCategories extends Model
{

	public function afterFind()
	{
		parent::afterFind();
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
		return 'shopping_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug, color, icon, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('slug', 'ext.validators.alpha','extra'=>array('-'),'allowNumbers'=>true),
			array('slug', 'unique', 'attributeName'=>'slug', 'className'=>'ShoppingCategories'),
			array('name', 'length', 'max'=>60),
			array('color', 'length', 'max'=>6),
			array('icon', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug, color, icon, orden_id', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app','Nombre'),
			'slug' => Yii::t('app','Slug'),
			'color' => Yii::t('app','Color'),
			'icon' => Yii::t('app','Icono'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('icon',$this->icon,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','name');
	}
}