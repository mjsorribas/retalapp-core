<?php

/**
 * This is the model class for table "landing_contact_info".
 *
 * The followings are the available columns in table 'landing_contact_info':
 * @property integer $id
 * @property string $call_to_action
 * @property string $email
 * @property string $phone
 * @property string $facebook
 * @property string $google_plus
 * @property string $twitter
 * @property string $linkedin
 * @property string $dribbble
 * @property string $youtube
 * @property string $pinterest
 * @property string $skype
 * @property string $instagram
 * @property string $github
 */
class BaseLandingContactInfo extends Model
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
		return 'landing_contact_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'email'),
			array('facebook, google_plus, twitter, linkedin, dribbble, youtube, pinterest, instagram, github', 'url'),
			array('email, skype', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>100),
			array('call_to_action', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, call_to_action, email, phone, facebook, google_plus, twitter, linkedin, dribbble, youtube, pinterest, skype, instagram, github', 'safe', 'on'=>'search'),
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
			'call_to_action' => Yii::t('app','Call To Action'),
			'email' => Yii::t('app','Email'),
			'phone' => Yii::t('app','Phone'),
			'facebook' => Yii::t('app','Facebook'),
			'google_plus' => Yii::t('app','Google Plus'),
			'twitter' => Yii::t('app','Twitter'),
			'linkedin' => Yii::t('app','Linkedin'),
			'dribbble' => Yii::t('app','Dribbble'),
			'youtube' => Yii::t('app','Youtube'),
			'pinterest' => Yii::t('app','Pinterest'),
			'skype' => Yii::t('app','Skype'),
			'instagram' => Yii::t('app','Instagram'),
			'github' => Yii::t('app','Github'),
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
		$criteria->compare('call_to_action',$this->call_to_action,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('google_plus',$this->google_plus,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('linkedin',$this->linkedin,true);
		$criteria->compare('dribbble',$this->dribbble,true);
		$criteria->compare('youtube',$this->youtube,true);
		$criteria->compare('pinterest',$this->pinterest,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('instagram',$this->instagram,true);
		$criteria->compare('github',$this->github,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','call_to_action');
	}
}