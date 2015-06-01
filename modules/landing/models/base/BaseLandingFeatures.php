<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=LandingFeatures::model()->findByPk($id);
 * // Or create a new record
 * // $model=new LandingFeatures;
 * $model->name='value';
 * $model->description='value';
 * $model->icon='value';
 * $model->landing_pages_id='value';
 * $last=LandingFeatures::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $landing_features=LandingFeatures::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($landing_features as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=r()->format->toBr($data->description);?>
 * <?=$data->icon;?>
 * <?=$data->landing_pages_id;?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $landing_features=LandingFeatures::model()->find();
 * <?=$landing_features->id;?>
 * <?=$landing_features->name;?>
 * <?=r()->format->toBr($landing_features->description);?>
 * <?=$landing_features->icon;?>
 * <?=$landing_features->landing_pages_id;?>
 * <?=$landing_features->orden_id;?>
 * 
 * This is the model class for table "landing_features".
 *
 * The followings are the available columns in table 'landing_features':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $icon
 * @property integer $landing_pages_id
 * @property integer $orden_id
 */
class BaseLandingFeatures extends Model
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
		return 'landing_features';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, icon, landing_pages_id, orden_id', 'required'),
			array('landing_pages_id, orden_id', 'numerical', 'integerOnly'=>true),
			array('name, icon', 'length', 'max'=>100),
			array('landing_pages_id, orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, icon, landing_pages_id, orden_id', 'safe', 'on'=>'search'),
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
			'description' => Yii::t('app','Descripción'),
			'icon' => Yii::t('app','Icon'),
			'landing_pages_id' => Yii::t('app','Landing Pages'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('landing_pages_id',$this->landing_pages_id);
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