<?php

/**
 * This is the model class for table "push_device_type".
 *
 * The followings are the available columns in table 'push_device_type':
 * @property integer $id
 * @property string $tipo
 *
 * The followings are the available model relations:
 * @property PushMobiles[] $pushMobiles
 */
class BasePushDeviceType extends Model
{

	public function afterFind()
	{
		parent::afterFind();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'push_device_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo', 'required'),
			array('tipo', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo', 'safe', 'on'=>'search'),
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
			'pushMobiles' => array(self::HAS_MANY, 'PushMobiles', 'device_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'tipo' => Yii::t('app','Tipo'),
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
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
