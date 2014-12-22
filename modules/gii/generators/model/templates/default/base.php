<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
$module=Yii::app()->getModule('gii');
?>
<?php echo "<?php\n"; ?>

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=<?php echo $modelClass; ?>::model()->findByPk($id);
 * // Or create a new record
 * // $model=new <?php echo $modelClass; ?>;
<?php 
foreach($columns as $column)
{
	if($column->name=='id')
		continue;
	if($column->name=='orden_id')
	{
		echo " * \$last=".$modelClass."::model()->findAll();\n";
		echo " * \$model->orden_id=count(\$last)+1;\n";
	}
	elseif($column->name=='updated_at')
		echo " * \$model->updated_at=date('Y-m-d H:i:s');\n";
	elseif($column->name=='created_at')
		echo " * \$model->created_at=date('Y-m-d H:i:s');\n";
	elseif($column->name=='users_id' or $column->name=='users_users_id' or $column->name=='user_id')
		echo " * \$model->".$column->name."=Yii::app()->user->id;\n";
	elseif(stripos($column->name, "money_")!==false)
		echo " * \$model->".$column->name."=strtr(\$model->".$column->name.",array(\",\"=>\"\"));\n";
	else
		echo " * \$model->".$column->name."='value';\n";

}
?>
 * $model->save();
 *
 *
 * Retrive Severals records
 * $<?php echo strtolower($tableName); ?>=<?php echo $modelClass; ?>::model()->findAll(array('order'=>'orden_id'));
 * <?php echo "<?php foreach(\$".strtolower($tableName)." as \$data): ?>\n"?>
<?php foreach($columns as $column): ?><?php $tangaColumn=$module->getParamsField($column);?>
<?php if($tangaColumn['type']==='file'): ?>
* <?php echo "<?=\$data->".$column->name."_path;?>\n"; ?>
* <?php echo "<?=CHtml::link('<i class=\"fa fa-download\"></i>',\$data->".$column->name."_path,array('font-size:100%'));?>\n"; ?>
<?php elseif($tangaColumn['type']==='img'): ?>
* <?php echo "<?=\$data->".$column->name."_path;?>\n"; ?>
* <?php echo "<?=CHtml::image(\$data->".$column->name."_path,'',array('class'=>'img-responsive img-thumbnail'));?>\n"; ?>
<?php elseif($tangaColumn['type']==='money'): ?>
* <?php echo "<?=r()->format->money(\$data->".$column->name.");?>\n"; ?>
<?php elseif($tangaColumn['type']==='text'): ?>
* <?php echo "<?=r()->format->toBr(\$data->".$column->name.");?>\n"; ?>
<?php elseif($tangaColumn['type']==='date' or $tangaColumn['type']==='datetime'): ?>
* <?php echo "<?=r()->format->formatShort(\$data->".$column->name.");?>\n"; ?>
* <?php echo "<?=r()->format->formatAgoComment(\$data->".$column->name.");?>\n"; ?>
<?php else: ?>
* <?php echo "<?=\$data->".$column->name.";?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
 * <?php echo "<?php endforeach; ?>\n"?>
 * 
 *
 * Retrive first record
 * $<?php echo strtolower($tableName); ?>=<?php echo $modelClass; ?>::model()->find();
<?php foreach($columns as $column): ?><?php $tangaColumn=$module->getParamsField($column);?>
<?php if($tangaColumn['type']==='file'): ?>
* <?php echo "<?=\$".strtolower($tableName)."->".$column->name."_path;?>\n"; ?>
* <?php echo "<?=CHtml::link('<i class=\"fa fa-download\"></i>',\$".strtolower($tableName)."->".$column->name."_path,array('font-size:100%'));?>\n"; ?>
<?php elseif($tangaColumn['type']==='img'): ?>
* <?php echo "<?=\$".strtolower($tableName)."->".$column->name."_path;?>\n"; ?>
* <?php echo "<?=CHtml::image(\$".strtolower($tableName)."->".$column->name."_path,'',array('class'=>'img-responsive img-thumbnail'));?>\n"; ?>
<?php elseif($tangaColumn['type']==='money'): ?>
* <?php echo "<?=r()->format->money(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php elseif($tangaColumn['type']==='text'): ?>
* <?php echo "<?=r()->format->toBr(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php elseif($tangaColumn['type']==='date' or $tangaColumn['type']==='datetime'): ?>
* <?php echo "<?=r()->format->formatShort(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
* <?php echo "<?=r()->format->formatAgoComment(\$".strtolower($tableName)."->".$column->name.");?>\n"; ?>
<?php else: ?>
* <?php echo "<?=\$".strtolower($tableName)."->".$column->name.";?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
 * 
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
 * The followings are the available model relations:
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class Base<?php echo $modelClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
<?php
foreach($columns as $name=>$column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
		echo "\tpublic \${$column->name}_path;\n";
	if($tangaColumn['type']==='cms')
		echo "\tpublic \${$column->name}_html;\n";
}
?>

	public function afterFind()
	{
		parent::afterFind();
<?php
foreach($columns as $name=>$column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='img' or $tangaColumn['type']==='file')
		echo "\t\t\$this->{$column->name}_path=Yii::app()->request->getBaseUrl(true).\"/uploads/\".\$this->{$column->name};\n";
	if($tangaColumn['type']==='cms')
		echo "\t\t\$this->{$column->name}_html=Yii::app()->format->sirToHtml(\$this->".$column->name.");\n";
}
?>
	}

	protected function beforeValidate()
	{
<?php
foreach($columns as $name=>$column)
{
	$tangaColumn=$module->getParamsField($column);
	if($tangaColumn['type']==='decimal' or $tangaColumn['type']==='float' or $tangaColumn['type']==='money')
		echo "\t\t\$this->".$column->name."=strtr(\$this->".$column->name.",array(\",\"=>\"\"));\n";
}
?>
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
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
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => Yii::t('app','$label'),\n"; ?>
<?php endforeach; ?>
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

<?php
foreach($columns as $name=>$column)
{
	if($column->name==='orden_id')
		echo "\t\t\$criteria->order='$name';\n";
		
	if($column->type==='string')
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
	}
	else
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
	}
}
?>

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

<?php if($connectionId!='db'):?>
	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()-><?php echo $connectionId ?>;
	}
<?php endif?>

<?php foreach($columns as $name=>$column):?>
<?php if($column->name=='id' or $column->name=='created_at' or $column->name=='updated_at'):?>
<?php continue;?>
<?php else:?>
	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','<?php echo $column->name?>');
	}
<?php break;?>
<?php endif;?>
<?php endforeach;?>
}