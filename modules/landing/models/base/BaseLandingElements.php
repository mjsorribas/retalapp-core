<?php

/**
 * This is the model class for table "landing_elements".
 *
 * The followings are the available columns in table 'landing_elements':
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $module
 * @property string $type
 * @property integer $landing_elements_positions_id
 * @property integer $orden_id
 */
class BaseLandingElements extends Model
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
		return 'landing_elements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, name, module, type, landing_elements_positions_id, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('image, name, type', 'length', 'max'=>100),
			array('module', 'length', 'max'=>255),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, name, module, type, landing_elements_positions_id, orden_id', 'safe', 'on'=>'search'),
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
			'image' => Yii::t('app','Image'),
			'name' => Yii::t('app','Name'),
			'module' => Yii::t('app','Module'),
			'type' => Yii::t('app','Type'),
			'landing_elements_positions_id' => Yii::t('app','Landing Elements Positions'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('landing_elements_positions_id',$this->landing_elements_positions_id);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>100
			),
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