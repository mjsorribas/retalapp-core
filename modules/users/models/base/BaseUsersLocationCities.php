<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=UsersLocationCities::model()->findByPk($id);
 * // Or create a new record
 * // $model=new UsersLocationCities;
 * $model->name='value';
 * $model->code='value';
 * $model->users_location_states_id='value';
 * $last=UsersLocationCities::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $users_location_cities=UsersLocationCities::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($users_location_cities as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=$data->code;?>
 * <?=$data->users_location_states_id;?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $users_location_cities=UsersLocationCities::model()->find();
 * <?=$users_location_cities->id;?>
 * <?=$users_location_cities->name;?>
 * <?=$users_location_cities->code;?>
 * <?=$users_location_cities->users_location_states_id;?>
 * <?=$users_location_cities->orden_id;?>
 * 
 * This is the model class for table "users_location_cities".
 *
 * The followings are the available columns in table 'users_location_cities':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $users_location_states_id
 * @property integer $orden_id
 *
 * The followings are the available model relations:
 * @property UsersLocationStates $usersLocationStates
 */
class BaseUsersLocationCities extends Model
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
		return 'users_location_cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, users_location_states_id, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('code', 'unique', 'attributeName'=>'code', 'className'=>'UsersLocationCities'),
			array('name', 'length', 'max'=>255),
			array('code', 'length', 'max'=>4),
			array('orden_id', 'length', 'max'=>11),
			array('users_location_states_id', 'exist', 'attributeName'=>'id', 'className'=>'UsersLocationStates'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, users_location_states_id, orden_id', 'safe', 'on'=>'search'),
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
			'usersLocationStates' => array(self::BELONGS_TO, 'UsersLocationStates', 'users_location_states_id'),
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
			'code' => Yii::t('app','Code'),
			'users_location_states_id' => Yii::t('app','Users Location States'),
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('users_location_states_id',$this->users_location_states_id);
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