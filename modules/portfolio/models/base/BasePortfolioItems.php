<?php

/**
 * This is the model class for table "portfolio_items".
 *
 * The followings are the available columns in table 'portfolio_items':
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $preview
 * @property string $image
 * @property string $video
 * @property string $audio
 * @property integer $prominent
 * @property double $created_at
 * @property integer $orden_id
 * @property integer $portfolio_categories_id
 */
class BasePortfolioItems extends Model
{
	public $preview_path;
	public $image_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->preview_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->preview;
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
		return 'portfolio_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, date, preview, prominent, created_at, orden_id, portfolio_categories_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('prominent', 'boolean'),
			array('video, audio', 'url'),
			array('date', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd'),
			array('title', 'length', 'max'=>255),
			array('preview, image', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			array('prominent', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, date, preview, image, video, audio, prominent, created_at, orden_id, portfolio_categories_id', 'safe', 'on'=>'search'),
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
			'title' => Yii::t('app','Title'),
			'date' => Yii::t('app','Date'),
			'preview' => Yii::t('app','Preview'),
			'image' => Yii::t('app','Image'),
			'video' => Yii::t('app','Video'),
			'audio' => Yii::t('app','Audio'),
			'prominent' => Yii::t('app','Prominent'),
			'created_at' => Yii::t('app','Created At'),
			'orden_id' => Yii::t('app','Orden'),
			'portfolio_categories_id' => Yii::t('app','Portfolio Categories'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('audio',$this->audio,true);
		$criteria->compare('prominent',$this->prominent);
		$criteria->compare('created_at',$this->created_at);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);
		$criteria->compare('portfolio_categories_id',$this->portfolio_categories_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','title');
	}
}