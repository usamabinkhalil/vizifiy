<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'GetColors' => [
            'class' => 'backend\components\GetColorsComponent',
        ],
        'GetTags' => [
            'class' => 'backend\components\GetTagsComponent',
        ],
    ],
];
