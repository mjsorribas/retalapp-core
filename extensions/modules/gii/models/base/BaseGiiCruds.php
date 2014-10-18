<?php

/**
 * This is the model class for table "gii_cruds".
 *
 * The followings are the available columns in table 'gii_cruds':
 * @property integer $id
 * @property string $moduleName
 * @property string $model
 * @property string $controller
 * @property string $labelName
 * @property string $fontIcon
 * @property string $template
 * @property string $created_at
 */
class BaseGiiCruds extends Model
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
		return 'gii_cruds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('moduleName, model, controller, labelName, template, created_at', 'required'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('moduleName, model, controller, labelName, fontIcon, template', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, moduleName, model, controller, labelName, fontIcon, template, created_at', 'safe', 'on'=>'search'),
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
			'moduleName' => Yii::t('app','Module Name'),
			'model' => Yii::t('app','Model'),
			'controller' => Yii::t('app','Controller'),
			'labelName' => Yii::t('app','Label Name'),
			'fontIcon' => Yii::t('app','Font Icon'),
			'template' => Yii::t('app','Template'),
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
		$criteria->compare('moduleName',$this->moduleName,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('labelName',$this->labelName,true);
		$criteria->compare('fontIcon',$this->fontIcon,true);
		$criteria->compare('template',$this->template,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','moduleName');
	}
}