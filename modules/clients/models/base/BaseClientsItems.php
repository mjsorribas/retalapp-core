<?php

/**
 * This is the model class for table "clients_items".
 *
 * The followings are the available columns in table 'clients_items':
 * @property integer $id
 * @property string $image
 * @property string $image_hover
 * @property integer $orden_id
 */
class BaseClientsItems extends Model
{
	public $image_path;
	public $image_hover_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->image_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image;
		$this->image_hover_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image_hover;
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
		return 'clients_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, image_hover, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('image, image_hover', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, image_hover, orden_id', 'safe', 'on'=>'search'),
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
			'image_hover' => Yii::t('app','Image Hover'),
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
		$criteria->compare('image_hover',$this->image_hover,true);
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