<?php

/**
 * This is the model class for table "blog_posts".
 *
 * The followings are the available columns in table 'blog_posts':
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property string $youtube
 * @property string $vimeo
 * @property string $image
 * @property integer $orden_id
 * @property string $created_at
 */
class BaseBlogPosts extends Model
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
		return 'blog_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, title, text, orden_id, created_at', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('youtube, vimeo', 'url'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('title', 'length', 'max'=>255),
			array('image', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, author_id, title, text, youtube, vimeo, image, orden_id, created_at', 'safe', 'on'=>'search'),
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
			'author_id' => Yii::t('app','Author'),
			'title' => Yii::t('app','Title'),
			'text' => Yii::t('app','Text'),
			'youtube' => Yii::t('app','Youtube'),
			'vimeo' => Yii::t('app','Vimeo'),
			'image' => Yii::t('app','Image'),
			'orden_id' => Yii::t('app','Orden'),
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
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('youtube',$this->youtube,true);
		$criteria->compare('vimeo',$this->vimeo,true);
		$criteria->compare('image',$this->image,true);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','author_id');
	}
}