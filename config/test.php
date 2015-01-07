<?php
$db=require(Yii::getPathOfAlias('app').'/config/database.php');
if(isset($db['testing']))
{
	$componentsForTest=array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'db'=>$db['testing'],
		),
	);
}
else
{
	$componentsForTest=array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	);
}

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	$componentsForTest
);
