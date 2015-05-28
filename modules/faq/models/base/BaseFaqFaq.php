<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=FaqFaq::model()->findByPk($id);
 * // Or create a new record
 * // $model=new FaqFaq;
 * $model->icon='value';
 * $model->pregunta='value';
 * $model->respuesta='value';
 * $last=FaqFaq::model()->findAll();
 * $model->orden_id=count($last)+1;
 * $model->save();
 *
 *
 * Retrive Severals records
 * $faq_faq=FaqFaq::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($faq_faq as $data): ?>
 * <?=$data->id;?>
 * <?=$data->icon;?>
 * <?=$data->pregunta;?>
 * <?=r()->format->toBr($data->respuesta);?>
 * <?=$data->orden_id;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $faq_faq=FaqFaq::model()->find();
 * <?=$faq_faq->id;?>
 * <?=$faq_faq->icon;?>
 * <?=$faq_faq->pregunta;?>
 * <?=r()->format->toBr($faq_faq->respuesta);?>
 * <?=$faq_faq->orden_id;?>
 * 
 * This is the model class for table "faq_faq".
 *
 * The followings are the available columns in table 'faq_faq':
 * @property integer $id
 * @property string $icon
 * @property string $pregunta
 * @property string $respuesta
 * @property integer $orden_id
 */
class BaseFaqFaq extends Model
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
		return 'faq_faq';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('icon, pregunta, respuesta, orden_id', 'required'),
			array('orden_id', 'numerical', 'integerOnly'=>true),
			array('icon', 'length', 'max'=>100),
			array('pregunta', 'length', 'max'=>150),
			array('respuesta', 'length', 'max'=>300),
			array('orden_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, icon, pregunta, respuesta, orden_id', 'safe', 'on'=>'search'),
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
			'icon' => Yii::t('app','Icon'),
			'pregunta' => Yii::t('app','Pregunta'),
			'respuesta' => Yii::t('app','Respuesta'),
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
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('respuesta',$this->respuesta,true);
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
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','icon');
	}
}