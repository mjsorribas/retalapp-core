<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingView::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingView;
 * $model->users_id=r()->user->id;
 * $model->shopping_video_id='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_view=ShoppingView::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_view as $data): ?>
 * <?=$data->id;?>
 * <?=$data->users_id;?>
 * <?=$data->shopping_video_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_view=ShoppingView::model()->find();
 * <?=$shopping_view->id;?>
 * <?=$shopping_view->users_id;?>
 * <?=$shopping_view->shopping_video_id;?>
 * 
 * This is the model class for table "shopping_view".
 *
 * The followings are the available columns in table 'shopping_view':
 * @property integer $id
 * @property integer $users_id
 * @property integer $shopping_video_id
 */
class BaseShoppingView extends Model
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
		return 'shopping_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, shopping_video_id', 'required'),
			array('users_id', 'numerical', 'integerOnly'=>true),
			array('users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, users_id, shopping_video_id', 'safe', 'on'=>'search'),
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
			'users_id' => Yii::t('app','Users'),
			'shopping_video_id' => Yii::t('app','Shopping'),
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
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('shopping_video_id',$this->shopping_video_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','users_id');
	}
}