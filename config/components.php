<?php
return array(
    
    /**
     * yiistrap configuration for use widgets
     * I want to remove this but this give me mor
     * inut files widgets for backend
    */
    'bootstrap' => array(
        'class' => 'bootstrap.components.TbApi',
    ),

    /**
     * yiiwheels configuration for use widgets
     * I want to remove this but this give me mor
     * inut files widgets for backend
    */
    'yiiwheels' => array(
        'class' => 'yiiwheels.YiiWheels',   
    ),
    'editable' => array(
        'class' => 'core.extensions.components.editable.DEEditable'
    ),
    'format' => array(
        'class' => 'core.extensions.components.format.BFormatter',
    ),
    'security' => array(
        'class' => 'core.extensions.components.security.GSecurityManager',
    ),
    'user' => array(
        'class' => 'core.extensions.components.auth.GSWebUser',
        'allowAutoLogin' => true,
        'loginUrl' => array('/users/page/login'),
        'loginRequiredAjaxResponse' => 'YII_LOGIN_REQUIRED',
    ),
    'cache' => array(
        'class' => 'CFileCache',
        'enabled'=>!YII_DEBUG,
    ),
    'authManager' => array(
        "class" => "CDbAuthManager",
        "connectionID" => "db",
        "itemTable" => 'users_authitem',
        "itemChildTable" => 'users_authitemchild',
        "assignmentTable" => 'users_authassignment',
    ),
    'errorHandler' => array(
        // use 'site/error' action to display errors
        'errorAction' => '/site/error',
    ),
);