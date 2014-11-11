<?php

/**
 * This is the model class for table "translation_message".
 *
 * The followings are the available columns in table 'translation_message':
 * @property integer $id
 * @property string $language
 * @property string $translation
 */
class TranslationMessage extends BaseTranslationMessage
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
			array('language', 'validateRepeat'),
		));
	}

	public function validateRepeat($attribute,$params)
	{
		if($this->isNewRecord) {
			if(self::model()->exists('id=? and language=?',array($this->id,$this->language))) {
				$this->addError('language',r('translation','Already there is a label for this language'));
			}
		} else {
			if(self::model()->exists('id=? and language=? and id_key <> ?',array($this->id,$this->language,$this->id_key))) {
				$this->addError('language',r('translation','Already there is a label for this language'));
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(),array(
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
