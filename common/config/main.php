<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // setting up the auth manager for authorization
        // Yii provides two types of authorization managers: yii\rbac\PhpManager and yii\rbac\DbManager. The former uses a PHP script file to store authorization data, while the latter stores authorization data in a database
        'authManager' => [
	        'class' => 'yii\rbac\DbManager',
        ],
    ],
    'name' => 'My-Yii Blog',// this setting is available under:  Yii::$app->name
    // fix for assets not working
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];
