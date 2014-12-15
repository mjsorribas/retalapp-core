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

    // TODO from PHP to BD
    'coreMessages' => array(
        'language'=>'en_us',
        'class'=>'CPhpMessageSource',
        //'basePath'=>dirname ...'messages',
    ),
    'messages' => array(
        'class'=>'CDbMessageSource',
        "connectionID" => "db",
        "sourceMessageTable" => 'translation_source_message',
        "translatedMessageTable" => 'translation_message',
        "cachingDuration" => 0,
    ),
    'errorHandler' => array(
        // use 'site/error' action to display errors
        'errorAction' => '/site/error',
    ),
    'ePdf' => array(
        'class'         => 'ext.components.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'ext.components.yii-pdf.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.storage'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'ext.components.yii-pdf.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
);