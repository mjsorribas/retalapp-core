<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingVideos::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingVideos;
 * $model->link='value';
 * $model->link_vimeo='value';
 * $model->titulo='value';
 * $model->descripcion='value';
 * $last=ShoppingVideos::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->shopping_items_id='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_videos=ShoppingVideos::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_videos as $data): ?>
 * <?=$data->id;?>
 * <?=$data->link;?>
 * <?=$data->link_vimeo;?>
 * <?=$data->titulo;?>
 * <?=r()->format->toBr($data->descripcion);?>
 * <?=$data->orden_id;?>
 * <?=$data->shopping_items_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_videos=ShoppingVideos::model()->find();
 * <?=$shopping_videos->id;?>
 * <?=$shopping_videos->link;?>
 * <?=$shopping_videos->link_vimeo;?>
 * <?=$shopping_videos->titulo;?>
 * <?=r()->format->toBr($shopping_videos->descripcion);?>
 * <?=$shopping_videos->orden_id;?>
 * <?=$shopping_videos->shopping_items_id;?>
 * 
 * This is the model class for table "shopping_videos".
 *
 * The followings are the available columns in table 'shopping_videos':
 * @property integer $id
 * @property string $link
 * @property string $link_vimeo
 * @property string $titulo
 * @property string $descripcion
 * @property integer $orden_id
 * @property integer $shopping_items_id
 */
class BaseShoppingVideos extends Model
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
		return 'shopping_videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, descripcion, orden_id, shopping_items_id', 'required'),
			array('orden_id, shopping_items_id', 'numerical', 'integerOnly'=>true),
			array('link, link_vimeo', 'url'),
			array('titulo', 'length', 'max'=>100),
			array('orden_id, shopping_items_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, link, link_vimeo, titulo, descripcion, orden_id, shopping_items_id', 'safe', 'on'=>'search'),
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
			'link' => Yii::t('app','Link'),
			'link_vimeo' => Yii::t('app','Vimeo'),
			'titulo' => Yii::t('app','Título'),
			'descripcion' => Yii::t('app','Descripción'),
			'orden_id' => Yii::t('app','Orden'),
			'shopping_items_id' => Yii::t('app','Shopping Items'),
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('link_vimeo',$this->link_vimeo,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->order='orden_id';
		$criteria->compare('orden_id',$this->orden_id);
		$criteria->compare('shopping_items_id',$this->shopping_items_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','link');
	}
}