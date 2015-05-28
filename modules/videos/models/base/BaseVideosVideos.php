<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=VideosVideos::model()->findByPk($id);
 * // Or create a new record
 * // $model=new VideosVideos;
 * $model->video='value';
 * $model->titulo='value';
 * $model->descripcion='value';
 * $last=VideosVideos::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $videos_videos=VideosVideos::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($videos_videos as $data): ?>
 * <?=$data->id;?>
 * <?=$data->video;?>
 * <?=$data->titulo;?>
 * <?=r()->format->toBr($data->descripcion);?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $videos_videos=VideosVideos::model()->find();
 * <?=$videos_videos->id;?>
 * <?=$videos_videos->video;?>
 * <?=$videos_videos->titulo;?>
 * <?=r()->format->toBr($videos_videos->descripcion);?>
 * <?=$videos_videos->orden_id;?>
 * 
 * This is the model class for table "videos_videos".
 *
 * The followings are the available columns in table 'videos_videos':
 * @property integer $id
 * @property string $video
 * @property string $titulo
 * @property string $descripcion
 * @property integer $orden_id
 */
class BaseVideosVideos extends Model
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
		return 'videos_videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('video, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('video', 'url'),
			array('titulo', 'length', 'max'=>255),
			array('orden_id', 'length', 'max'=>11),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, video, titulo, descripcion, orden_id', 'safe', 'on'=>'search'),
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
			'video' => Yii::t('app','Video'),
			'titulo' => Yii::t('app','Título'),
			'descripcion' => Yii::t('app','Descripción'),
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
		$criteria->compare('video',$this->video,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','video');
	}
}