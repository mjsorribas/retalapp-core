<?php

/**
 * This is the model class for table "users_notifications".
 *
 * The followings are the available columns in table 'users_notifications':
 * @property integer $id
 * @property string $subject
 * @property string $body
 * @property string $message
 * @property integer $send
 * @property integer $read
 * @property integer $users_users_id
 * @property string $created_at
 * @property string $url
 * @property string $label
 */
class BaseUsersNotifications extends Model
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
		return 'users_notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message, send, read, users_users_id, created_at', 'required'),
			array('send, read', 'boolean'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('subject, message, url, label', 'length', 'max'=>255),
			array('body, send, read', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject, body, message, send, read, users_users_id, created_at, url, label', 'safe', 'on'=>'search'),
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
			'subject' => Yii::t('app','Subject'),
			'body' => Yii::t('app','Body'),
			'message' => Yii::t('app','Message'),
			'send' => Yii::t('app','Send'),
			'read' => Yii::t('app','Read'),
			'users_users_id' => Yii::t('app','Users Users'),
			'created_at' => Yii::t('app','Created At'),
			'url' => Yii::t('app','Url'),
			'label' => Yii::t('app','Label'),
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('send',$this->send);
		$criteria->compare('read',$this->read);
		$criteria->compare('users_users_id',$this->users_users_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','subject');
	}
}