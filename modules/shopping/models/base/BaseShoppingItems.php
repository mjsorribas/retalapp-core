<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingItems::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingItems;
 * $model->image='value';
 * $model->video_promocional='value';
 * $model->name='value';
 * $model->slug='value';
 * $model->description='value';
 * $model->description_detail='value';
 * $model->price='value';
 * $model->free='value';
 * $model->state='value';
 * $model->shopping_categories_id='value';
 * $model->temas_relacionados='value';
 * $model->shopping_facilitador_id='value';
 * $last=ShoppingItems::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_items=ShoppingItems::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_items as $data): ?>
 * <?=$data->id;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->video_promocional;?>
 * <?=$data->name;?>
 * <?=$data->slug;?>
 * <?=r()->format->toBr($data->description);?>
 * <?=$data->description_detail;?>
 * <?=r()->format->money($data->price);?>
 * <?=$data->free;?>
 * <?=$data->state;?>
 * <?=$data->shopping_categories_id;?>
 * <?=r()->format->toBr($data->temas_relacionados);?>
 * <?=$data->shopping_facilitador_id;?>
 * <?=$data->orden_id;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_items=ShoppingItems::model()->find();
 * <?=$shopping_items->id;?>
 * <?=$shopping_items->image_path;?>
 * <?=CHtml::image($shopping_items->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$shopping_items->video_promocional;?>
 * <?=$shopping_items->name;?>
 * <?=$shopping_items->slug;?>
 * <?=r()->format->toBr($shopping_items->description);?>
 * <?=$shopping_items->description_detail;?>
 * <?=r()->format->money($shopping_items->price);?>
 * <?=$shopping_items->free;?>
 * <?=$shopping_items->state;?>
 * <?=$shopping_items->shopping_categories_id;?>
 * <?=r()->format->toBr($shopping_items->temas_relacionados);?>
 * <?=$shopping_items->shopping_facilitador_id;?>
 * <?=$shopping_items->orden_id;?>
 * <?=r()->format->formatShort($shopping_items->created_at);?>
 * <?=r()->format->formatAgoComment($shopping_items->created_at);?>
 * 
 * This is the model class for table "shopping_items".
 *
 * The followings are the available columns in table 'shopping_items':
 * @property integer $id
 * @property string $image
 * @property string $video_promocional
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $description_detail
 * @property double $price
 * @property integer $free
 * @property integer $state
 * @property integer $shopping_categories_id
 * @property string $temas_relacionados
 * @property integer $shopping_facilitador_id
 * @property integer $orden_id
 * @property string $created_at
 */
class BaseShoppingItems extends Model
{
	public $image_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->image_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->image;
	}

	protected function beforeValidate()
	{
		$this->price=strtr($this->price,array(","=>""));
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shopping_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, video_promocional, name, slug, description, description_detail, price, shopping_categories_id, shopping_facilitador_id, orden_id, created_at', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('free, state', 'boolean'),
			array('price', 'numerical'),
			array('video_promocional', 'url'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('slug', 'ext.validators.alpha','extra'=>array('-'),'allowNumbers'=>true),
			array('slug', 'unique', 'attributeName'=>'slug', 'className'=>'ShoppingItems'),
			array('image', 'length', 'max'=>100),
			array('name', 'length', 'max'=>60),
			array('orden_id', 'length', 'max'=>11),
			array('free, state, temas_relacionados', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, video_promocional, name, slug, description, description_detail, price, free, state, shopping_categories_id, temas_relacionados, shopping_facilitador_id, orden_id, created_at', 'safe', 'on'=>'search'),
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
			'image' => Yii::t('app','Imagen'),
			'video_promocional' => Yii::t('app','Promocional'),
			'name' => Yii::t('app','Nombre'),
			'slug' => Yii::t('app','Slug'),
			'description' => Yii::t('app','Descripción corta'),
			'description_detail' => Yii::t('app','Descripción'),
			'price' => Yii::t('app','Precio'),
			'free' => Yii::t('app','Es gratis'),
			'state' => Yii::t('app','Estado'),
			'shopping_categories_id' => Yii::t('app','Categoría'),
			'temas_relacionados' => Yii::t('app','Temas Relacionados'),
			'shopping_facilitador_id' => Yii::t('app','Facilitador'),
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video_promocional',$this->video_promocional,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_detail',$this->description_detail,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('free',$this->free);
		$criteria->compare('state',$this->state);
		$criteria->compare('shopping_categories_id',$this->shopping_categories_id);
		$criteria->compare('temas_relacionados',$this->temas_relacionados,true);
		$criteria->compare('shopping_facilitador_id',$this->shopping_facilitador_id);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','image');
	}
}