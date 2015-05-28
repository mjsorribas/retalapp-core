<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=TestimoniosTestimonios::model()->findByPk($id);
 * // Or create a new record
 * // $model=new TestimoniosTestimonios;
 * $model->imagen='value';
 * $model->testimonio='value';
 * $model->nombre_usuario='value';
 * $model->ocupacion_usuario='value';
 * $last=TestimoniosTestimonios::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $testimonios_testimonios=TestimoniosTestimonios::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($testimonios_testimonios as $data): ?>
 * <?=$data->id;?>
 * <?=$data->imagen_path;?>
 * <?=CHtml::image($data->imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($data->testimonio);?>
 * <?=$data->nombre_usuario;?>
 * <?=$data->ocupacion_usuario;?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $testimonios_testimonios=TestimoniosTestimonios::model()->find();
 * <?=$testimonios_testimonios->id;?>
 * <?=$testimonios_testimonios->imagen_path;?>
 * <?=CHtml::image($testimonios_testimonios->imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=r()->format->toBr($testimonios_testimonios->testimonio);?>
 * <?=$testimonios_testimonios->nombre_usuario;?>
 * <?=$testimonios_testimonios->ocupacion_usuario;?>
 * <?=$testimonios_testimonios->orden_id;?>
 * 
 * This is the model class for table "testimonios_testimonios".
 *
 * The followings are the available columns in table 'testimonios_testimonios':
 * @property integer $id
 * @property string $imagen
 * @property string $testimonio
 * @property string $nombre_usuario
 * @property string $ocupacion_usuario
 * @property integer $orden_id
 */
class BaseTestimoniosTestimonios extends Model
{
	public $imagen_path;

	public function afterFind()
	{
		parent::afterFind();
		$this->imagen_path=Yii::app()->request->getBaseUrl(true)."/uploads/".$this->imagen;
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
		return 'testimonios_testimonios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imagen, testimonio, nombre_usuario, ocupacion_usuario, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('imagen, nombre_usuario, ocupacion_usuario', 'length', 'max'=>100),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, imagen, testimonio, nombre_usuario, ocupacion_usuario, orden_id', 'safe', 'on'=>'search'),
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
			'imagen' => Yii::t('app','Imagen'),
			'testimonio' => Yii::t('app','Testimonio'),
			'nombre_usuario' => Yii::t('app','Nombre Usuario'),
			'ocupacion_usuario' => Yii::t('app','Ocupacion Usuario'),
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
		$criteria->compare('imagen',$this->imagen,true);
		$criteria->compare('testimonio',$this->testimonio,true);
		$criteria->compare('nombre_usuario',$this->nombre_usuario,true);
		$criteria->compare('ocupacion_usuario',$this->ocupacion_usuario,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','imagen');
	}
}