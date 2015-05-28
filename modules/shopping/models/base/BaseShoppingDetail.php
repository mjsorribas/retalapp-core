<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingDetail::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingDetail;
 * $model->shopping_items_id='value';
 * $model->name='value';
 * $model->slug='value';
 * $model->image='value';
 * $model->description='value';
 * $model->description_detail='value';
 * $model->price='value';
 * $model->amount='value';
 * $model->state='value';
 * $model->shopping_header_id='value';
 * $model->shopping_categories_name='value';
 * $last=ShoppingDetail::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->created_at=date('Y-m-d H:i:s');
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_detail=ShoppingDetail::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_detail as $data): ?>
 * <?=$data->id;?>
 * <?=$data->shopping_items_id;?>
 * <?=$data->name;?>
 * <?=$data->slug;?>
 * <?=$data->image_path;?>
 * <?=CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($data->description);?>
 * <?=r()->format->toBr($data->description_detail);?>
 * <?=r()->format->money($data->price);?>
 * <?=$data->amount;?>
 * <?=$data->state;?>
 * <?=$data->shopping_header_id;?>
 * <?=$data->shopping_categories_name;?>
 * <?=$data->orden_id;?>
 * <?=r()->format->formatShort($data->created_at);?>
 * <?=r()->format->formatAgoComment($data->created_at);?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_detail=ShoppingDetail::model()->find();
 * <?=$shopping_detail->id;?>
 * <?=$shopping_detail->shopping_items_id;?>
 * <?=$shopping_detail->name;?>
 * <?=$shopping_detail->slug;?>
 * <?=$shopping_detail->image_path;?>
 * <?=CHtml::image($shopping_detail->image_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($shopping_detail->description);?>
 * <?=r()->format->toBr($shopping_detail->description_detail);?>
 * <?=r()->format->money($shopping_detail->price);?>
 * <?=$shopping_detail->amount;?>
 * <?=$shopping_detail->state;?>
 * <?=$shopping_detail->shopping_header_id;?>
 * <?=$shopping_detail->shopping_categories_name;?>
 * <?=$shopping_detail->orden_id;?>
 * <?=r()->format->formatShort($shopping_detail->created_at);?>
 * <?=r()->format->formatAgoComment($shopping_detail->created_at);?>
 * 
 * This is the model class for table "shopping_detail".
 *
 * The followings are the available columns in table 'shopping_detail':
 * @property integer $id
 * @property integer $shopping_items_id
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property string $description_detail
 * @property double $price
 * @property integer $amount
 * @property integer $state
 * @property integer $shopping_header_id
 * @property string $shopping_categories_name
 * @property integer $orden_id
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property ShoppingHeader $shoppingHeader
 */
class BaseShoppingDetail extends Model
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
		return 'shopping_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shopping_items_id, name, description, description_detail, price, shopping_header_id, shopping_categories_name, orden_id, created_at', 'required'),
			array('shopping_items_id, amount, shopping_header_id, orden_id', 'numerical', 'integerOnly'=>true),
			array('state', 'boolean'),
			array('price', 'numerical'),
			array('created_at', 'type', 'type'=>'datetime', 'datetimeFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format should be yyyy-MM-dd hh:mm:ss'),
			array('shopping_items_id, amount, shopping_header_id, orden_id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>60),
			array('slug, shopping_categories_name', 'length', 'max'=>255),
			array('image', 'length', 'max'=>100),
			array('state', 'safe'),
			array('shopping_header_id', 'exist', 'attributeName'=>'id', 'className'=>'ShoppingHeader'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shopping_items_id, name, slug, image, description, description_detail, price, amount, state, shopping_header_id, shopping_categories_name, orden_id, created_at', 'safe', 'on'=>'search'),
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
			'shoppingHeader' => array(self::BELONGS_TO, 'ShoppingHeader', 'shopping_header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'shopping_items_id' => Yii::t('app','Shopping Items'),
			'name' => Yii::t('app','Nombre'),
			'slug' => Yii::t('app','Slug'),
			'image' => Yii::t('app','Image'),
			'description' => Yii::t('app','Descripción corta'),
			'description_detail' => Yii::t('app','Descripción'),
			'price' => Yii::t('app','Precio'),
			'amount' => Yii::t('app','Unds'),
			'state' => Yii::t('app','Estado'),
			'shopping_header_id' => Yii::t('app','Shopping Header'),
			'shopping_categories_name' => Yii::t('app','Categoría'),
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
		$criteria->compare('shopping_items_id',$this->shopping_items_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_detail',$this->description_detail,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('state',$this->state);
		$criteria->compare('shopping_header_id',$this->shopping_header_id);
		$criteria->compare('shopping_categories_name',$this->shopping_categories_name,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','shopping_items_id');
	}
}