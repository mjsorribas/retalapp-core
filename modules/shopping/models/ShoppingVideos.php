<?php

/**
 * This is the model class for table "shopping_videos".
 *
 * The followings are the available columns in table 'shopping_videos':
 * @property integer $id
 * @property string $link
 * @property string $link_vimeo
 * @property integer $orden_id
 * @property integer $shopping_items_id
 */
class ShoppingVideos extends BaseShoppingVideos
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
		));
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

	public function estaVistoHtml()
	{
		if(r()->user->isGuest)
			return "";
		else {
			$userID=r()->user->id;
			$query=r()->db->createCommand("SELECT COUNT(*) 
				FROM 
				shopping_view sw 
				WHERE sw.users_id='".$userID."' AND sw.shopping_video_id='".$this->id."'")->queryScalar();
			if($query>0)
				return "<span class=\"label label-success\">Completado</span>";
		}
		return "";
	}

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
			'pagination'=>array(
				'pageSize'=>100
			)
		));
	}
}
