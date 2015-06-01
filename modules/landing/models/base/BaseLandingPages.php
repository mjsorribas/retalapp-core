<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=LandingPages::model()->findByPk($id);
 * // Or create a new record
 * // $model=new LandingPages;
 * $model->name='value';
 * $model->slug='value';
 * $model->video='value';
 * $model->image='value';
 * $model->call='value';
 * $model->call_text='value';
 * $model->code='value';
 * $model->created_at=date('Y-m-d H:i:s');
 * $last=LandingPages::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $landing_pages=LandingPages::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($landing_pages as $data): ?>
 * <?=$data->id;?>
 * <?=$data->name;?>
 * <?=$data->slug;?>
 * <?=$data->video;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($data->call);?>
 * <?=r()->format->toBr($data->call_text);?>
 * <?=$data->code;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $landing_pages=LandingPages::model()->find();
 * <?=$landing_pages->id;?>
 * <?=$landing_pages->name;?>
 * <?=$landing_pages->slug;?>
 * <?=$landing_pages->video;?>
 * <?=$landing_pages->image_path;?>
 * <?=CHtml::image($landing_pages->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($landing_pages->call);?>
 * <?=r()->format->toBr($landing_pages->call_text);?>
 * <?=$landing_pages->code;?>
 * <?=r()->format->formatShort($landing_pages->created_at);?>
 * <?=r()->format->formatAgoComment($landing_pages->created_at);?>
 * <?=$landing_pages->orden_id;?>
 * 
 * This is the model class for table "landing_pages".
 *
 * The followings are the available columns in table 'landing_pages':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $video
 * @property string $image
 * @property string $call
 * @property string $call_text
 * @property string $code
 * @property string $created_at
 * @property integer $orden_id
 */
class BaseLandingPages extends Model
{
	public $image_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->image_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image;
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
		return 'landing_pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug, call, code, created_at, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('slug', 'ext.validators.alpha','extra'=>array('-'),'allowNumbers'=>true),
			array('slug', 'unique', 'attributeName'=>'slug', 'className'=>'LandingPages'),
			array('name', 'length', 'max'=>255),
			array('video, image', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			array('call_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug, video, image, call, call_text, code, created_at, orden_id', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app','Título'),
			'slug' => Yii::t('app','Slug'),
			'video' => Yii::t('app','Video (Opcional)'),
			'image' => Yii::t('app','Imagen (Opcional)'),
			'call' => Yii::t('app','Texto llamado acción'),
			'call_text' => Yii::t('app','Texto largo llamado acción'),
			'code' => Yii::t('app','Code'),
			'created_at' => Yii::t('app','Created At'),
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('call',$this->call,true);
		$criteria->compare('call_text',$this->call_text,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('created_at',$this->created_at,true);
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