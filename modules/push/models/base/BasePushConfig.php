<?php

/**
 * This is the model class for table "push_config".
 *
 * The followings are the available columns in table 'push_config':
 * @property integer $id
 * @property string $android_api_key
 * @property string $android_host
 * @property string $ios_pwd
 * @property string $ios_cert
 * @property string $ios_host
 * @property integer $activo
 */
class BasePushConfig extends Model
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
		return 'push_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activo', 'boolean'),
			array('android_api_key', 'length', 'max'=>1000),
			array('android_host', 'length', 'max'=>250),
			array('ios_pwd, ios_host', 'length', 'max'=>500),
			array('ios_cert', 'length', 'max'=>100),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, android_api_key, android_host, ios_pwd, ios_cert, ios_host, activo', 'safe', 'on'=>'search'),
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
			'android_api_key' => Yii::t('app','Android Api Key'),
			'android_host' => Yii::t('app','Android Host'),
			'ios_pwd' => Yii::t('app','Ios Pwd'),
			'ios_cert' => Yii::t('app','Ios Cert'),
			'ios_host' => Yii::t('app','Ios Host'),
			'activo' => Yii::t('app','Activo'),
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
		$criteria->compare('android_api_key',$this->android_api_key,true);
		$criteria->compare('android_host',$this->android_host,true);
		$criteria->compare('ios_pwd',$this->ios_pwd,true);
		$criteria->compare('ios_cert',$this->ios_cert,true);
		$criteria->compare('ios_host',$this->ios_host,true);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
