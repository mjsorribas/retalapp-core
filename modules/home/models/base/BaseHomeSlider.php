<?php

/**
 * This is the model class for table "home_slider".
 *
 * The followings are the available columns in table 'home_slider':
 * @property integer $id
 * @property string $image
 * @property string $image_front
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property string $text4
 * @property integer $orden_id
 */
class BaseHomeSlider extends Model
{
	public $image_path;
	public $image_front_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->image_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image;
		$this->image_front_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image_front;
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
		return 'home_slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('image, image_front', 'length', 'max'=>100),
			array('text1, text2, text3, text4', 'length', 'max'=>200),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, image_front, text1, text2, text3, text4, orden_id', 'safe', 'on'=>'search'),
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
			'image_front' => Yii::t('app','Image Front'),
			'text1' => Yii::t('app','Text1'),
			'text2' => Yii::t('app','Text2'),
			'text3' => Yii::t('app','Text3'),
			'text4' => Yii::t('app','Text4'),
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
		$criteria->compare('image_front',$this->image_front,true);
		$criteria->compare('text1',$this->text1,true);
		$criteria->compare('text2',$this->text2,true);
		$criteria->compare('text3',$this->text3,true);
		$criteria->compare('text4',$this->text4,true);
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