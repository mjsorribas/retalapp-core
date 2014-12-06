<?php

/**
 * This is the model class for table "job_messages".
 *
 * The followings are the available columns in table 'job_messages':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $file
 * @property integer $read
 * @property string $created_at
 */
class BaseJobMessages extends Model
{
	public $file_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->file_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->file;
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
		return 'job_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, email, message, file, read, created_at', 'required'),
			array('read', 'boolean'),
			array('email', 'email'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('name, email', 'length', 'max'=>255),
			array('phone, file', 'length', 'max'=>100),
			array('read', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, email, message, file, read, created_at', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app','Name'),
			'phone' => Yii::t('app','Phone'),
			'email' => Yii::t('app','Email'),
			'message' => Yii::t('app','Message'),
			'file' => Yii::t('app','File'),
			'read' => Yii::t('app','Read'),
			'created_at' => Yii::t('app','Created At'),
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
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('created_at',$this->created_at,true);

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