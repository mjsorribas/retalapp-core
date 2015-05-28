<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=EquipoEquipo::model()->findByPk($id);
 * // Or create a new record
 * // $model=new EquipoEquipo;
 * $model->imagen='value';
 * $model->nombre='value';
 * $model->cargo='value';
 * $model->perfil='value';
 * $last=EquipoEquipo::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $equipo_equipo=EquipoEquipo::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($equipo_equipo as $data): ?>
 * <?=$data->id;?>
 * <?=$data->imagen_path;?>
 * <?=CHtml::image($data->imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$data->nombre;?>
 * <?=$data->cargo;?>
 * <?=r()->format->toBr($data->perfil);?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $equipo_equipo=EquipoEquipo::model()->find();
 * <?=$equipo_equipo->id;?>
 * <?=$equipo_equipo->imagen_path;?>
 * <?=CHtml::image($equipo_equipo->imagen_path,'',array('class'=>'img-responsive img-thumbnail'));?>
 * <?=$equipo_equipo->nombre;?>
 * <?=$equipo_equipo->cargo;?>
 * <?=r()->format->toBr($equipo_equipo->perfil);?>
 * <?=$equipo_equipo->orden_id;?>
 * 
 * This is the model class for table "equipo_equipo".
 *
 * The followings are the available columns in table 'equipo_equipo':
 * @property integer $id
 * @property string $imagen
 * @property string $nombre
 * @property string $cargo
 * @property string $perfil
 * @property integer $orden_id
 */
class BaseEquipoEquipo extends Model
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
		return 'equipo_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imagen, nombre, cargo, perfil, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('imagen', 'length', 'max'=>100),
			array('nombre, cargo', 'length', 'max'=>50),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, imagen, nombre, cargo, perfil, orden_id', 'safe', 'on'=>'search'),
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
			'nombre' => Yii::t('app','Nombre'),
			'cargo' => Yii::t('app','Cargo'),
			'perfil' => Yii::t('app','Perfil'),
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('perfil',$this->perfil,true);
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