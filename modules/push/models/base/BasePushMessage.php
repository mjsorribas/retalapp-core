<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=PushMessage::model()->findByPk($id);
 * // Or create a new record
 * // $model=new PushMessage;
 * $model->mobile_id_from='value';
 * $model->mobile_id_to='value';
 * $model->message='value';
 * $model->img_imagen='value';
 * $model->date_created='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $push_message=PushMessage::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($push_message as $data): ?>
 * <?=$data->id;?>
 * <?=$data->mobile_id_from;?>
 * <?=$data->mobile_id_to;?>
 * <?=r()->format->toBr($data->message);?>
 * <?=$data->img_imagen_path;?>
 * <?=CHtml::image($data->img_imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->date_created;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $push_message=PushMessage::model()->find();
 * <?=$push_message->id;?>
 * <?=$push_message->mobile_id_from;?>
 * <?=$push_message->mobile_id_to;?>
 * <?=r()->format->toBr($push_message->message);?>
 * <?=$push_message->img_imagen_path;?>
 * <?=CHtml::image($push_message->img_imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$push_message->date_created;?>
 * 
 * This is the model class for table "push_message".
 *
 * The followings are the available columns in table 'push_message':
 * @property integer $id
 * @property integer $mobile_id_from
 * @property integer $mobile_id_to
 * @property string $message
 * @property string $img_imagen
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property PushMobiles $mobileIdFrom
 * @property PushMobiles $mobileIdTo
 */
class BasePushMessage extends Model
{
	public $img_imagen_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->img_imagen_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->img_imagen;
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
		return 'push_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobile_id_from, mobile_id_to, date_created', 'required'),
			array('mobile_id_from, mobile_id_to', 'numerical', 'integerOnly'=>true),
			array('mobile_id_from, mobile_id_to', 'length', 'max'=>11),
			array('img_imagen', 'length', 'max'=>50),
			array('message', 'safe'),
			array('mobile_id_from', 'exist', 'attributeName'=>'id', 'className'=>'PushMobiles'),
			array('mobile_id_to', 'exist', 'attributeName'=>'id', 'className'=>'PushMobiles'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mobile_id_from, mobile_id_to, message, img_imagen, date_created', 'safe', 'on'=>'search'),
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
			'mobileIdFrom' => array(self::BELONGS_TO, 'PushMobiles', 'mobile_id_from'),
			'mobileIdTo' => array(self::BELONGS_TO, 'PushMobiles', 'mobile_id_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'mobile_id_from' => Yii::t('app','Mobile From'),
			'mobile_id_to' => Yii::t('app','Mobile To'),
			'message' => Yii::t('app','Message'),
			'img_imagen' => Yii::t('app','Imagen'),
			'date_created' => Yii::t('app','Date Created'),
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
		$criteria->compare('mobile_id_from',$this->mobile_id_from);
		$criteria->compare('mobile_id_to',$this->mobile_id_to);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('img_imagen',$this->img_imagen,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','mobile_id_from');
	}
}