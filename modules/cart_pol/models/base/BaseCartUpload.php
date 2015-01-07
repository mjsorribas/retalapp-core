<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=CartUpload::model()->findByPk($id);
 * // Or create a new record
 * // $model=new CartUpload;
 * $model->file='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->users_users_id=r()->user->id;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $cart_upload=CartUpload::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($cart_upload as $data): ?>
 * <?=$data->id;?>
 * <?=$data->file_path;?>
 * <?=CHtml::link('<i class="fa fa-download"></i>',$data->file_path,array('font-size:100%'));?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?=$data->users_users_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $cart_upload=CartUpload::model()->find();
 * <?=$cart_upload->id;?>
 * <?=$cart_upload->file_path;?>
 * <?=CHtml::link('<i class="fa fa-download"></i>',$cart_upload->file_path,array('font-size:100%'));?>
 * <?=r()->format->formatShort($cart_upload->created_at);?>
 * <?=r()->format->formatAgoComment($cart_upload->created_at);?>
 * <?=$cart_upload->users_users_id;?>
 * 
 * This is the model class for table "cart_upload".
 *
 * The followings are the available columns in table 'cart_upload':
 * @property integer $id
 * @property string $file
 * @property string $created_at
 * @property integer $users_users_id
 */
class BaseCartUpload extends Model
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
		return 'cart_upload';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file, created_at, users_users_id', 'required'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('users_users_id', 'exist', 'attributeName'=>'id', 'className'=>'Users'),
			array('file', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file, created_at, users_users_id', 'safe', 'on'=>'search'),
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
			'file' => Yii::t('app','File'),
			'created_at' => Yii::t('app','Created At'),
			'users_users_id' => Yii::t('app','Users Users'),
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
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('users_users_id',$this->users_users_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','file');
	}
}