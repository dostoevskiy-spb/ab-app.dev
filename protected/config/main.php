<?php
/**
 * Файл основных настроек приложения для production сервера:
 **/
$webroot = $_SERVER['DOCUMENT_ROOT'];
$config  = array(
    'import'       => array(),
    'rules'        => array(),
    'components'   => array(),
    'preload'      => array(),
    'modules'      => array(),
    'cache'        => array(),
    'enableAssets' => TRUE,
    'register'     => array(),
);

$modules = require 'modules.php';
foreach ($modules as $moduleName) {
    $path = "$webroot/protected/modules/$moduleName/config/default.php";

    $moduleConfig = array();
    if (file_exists($path)) {
        $moduleConfig = include($path);
    }

//    # Если это наш модуль
//    if ($moduleName == 'honey') {
//        if (!YII_DEBUG)
//            $config['cache'] = array();
//        $config['enableAssets'] = true;
//    }

    # Засунем модуль в модули
//        echo CVarDumper::dumpAsString($moduleConfig, 10, TRUE);
    if (isset($moduleConfig['module'])) {
        $config['modules'][$moduleName] = $moduleConfig['module'];
    } else {
        array_push($config['modules'], $moduleName);
    }

    # Объединяем настройки модулей
    if (!empty($moduleConfig['import']))
        $config['import'] = CMap::mergeArray($config['import'], $moduleConfig['import']);
    if (!empty($moduleConfig['rules']))
        $config['rules'] = CMap::mergeArray($config['rules'], $moduleConfig['rules']);
    if (!empty($moduleConfig['components']))
        $config['components'] = CMap::mergeArray($config['components'], $moduleConfig['components']);
    if (!empty($moduleConfig['preload']))
        $config['preload'] = CMap::mergeArray($config['preload'], $moduleConfig['preload']);
    if (!empty($moduleConfig['cache']))
        $config['cache'] = CMap::mergeArray($config['cache'], $moduleConfig['cache']);
    if (!empty($moduleConfig['register']))
        $config['register'] = CMap::mergeArray($config['register'], $moduleConfig['register']);


}

$result = array(
    'basePath'   => dirname(__FILE__) . '/..',
//    'defaultController' => 'site', // контроллер по умолчанию
    'name'       => 'MotaAB', // название приложения
    'language'   => 'ru', // язык по умолчанию
//    'sourceLanguage'    => 'SYS',
    'theme'      => 'default', // тема оформления по умолчанию
    'charset'    => 'UTF-8',
    'aliases'    => array( //        'mota-ab' => 'application.modules.mota-ab',
//        'yiistrap'  => 'application.extensions.yiistrap',
//        'yiiwheels' => 'application.extensions.yiiwheels',
    ),
    'preload'    => $config['preload'],
    'import'     => CMap::mergeArray(
                        array(
                // подключение основых путей
                'application.components.*',
//                'application.components.db.*',
//                'application.components.behaviors.*',
                'application.models.*',
//                'yiistrap.helpers.TbHtml',
//                                   'honey.extensions.registrator.components.OnBeginRequestHandler',
            ), $config['import']
        ),

    // подключение и конфигурирование модулей,
    // подробнее: http://www.yiiframework.ru/doc/guide/ru/basics.module
    'modules'    => CMap::mergeArray(
                        array(
                            'gii' => array(
                                'class'          => 'system.gii.GiiModule',
                                'password'       => '0000',
                                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                                'ipFilters'      => array('176.117.143.48', '127.0.0.1'),
                                'generatorPaths' => array(
                                    'bootstrap.gii',
                                ),
                            ),
                        ), $config['modules']
        ),
//    'onBeginRequest'    => array('OnBeginRequestHandler', 'run'),
    'params'     => require dirname(__FILE__) . '/params.php',
    // конфигурирование основных компонентов (подробнее http://www.yiiframework.ru/doc/guide/ru/basics.component)
    'components' => CMap::mergeArray(
                        array(
                            // assetsManager:
                            'assetsManager' => array(
                                'forceCopy' => FALSE,
                            ),
                            'format'        => array(
                                'class' => 'application.components.CCFormatter',
                            ),
                            'db'            => require($_SERVER['DOCUMENT_ROOT'] . '/protected/config/db.php'),
                            // конфигурирование urlManager, подробнее: http://www.yiiframework.ru/doc/guide/ru/topics.url
                            'urlManager'    => array(
//                                       'class'          => 'honey.components.urlManager.LangUrlManager',
//                                       'languageInPath' => TRUE,
//                                       'langParam'      => 'language',
                                'urlFormat'      => 'path',
                                'showScriptName' => FALSE, // чтобы убрать index.php из url, читаем: http://yiiframework.ru/doc/guide/ru/quickstart.apache-nginx-config
                                'caseSensitive'  => FALSE,
//                                       'cacheID'        => 'cache',
                                'rules'          => CMap::mergeArray(
                                                        CMap::mergeArray(
                                                            array(
                                                                'gii'                               => 'gii',
                                                                'gii/<controller:\w+>'              => 'gii/<controller>',
                                                                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                                                            ),
                                                                $config['rules']
                                                        ),
                                                            array(

                                                                // общие правила
//                                                                '<module:\w+>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
//                                                                '<module:\w+>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>'          => '<module>/<controller>/<action>',
//                                                                '<module:\w+>/<controller:\w+>'                                   => '<module>/<controller>/index',
                                                                '<controller:\w+>/<action:[0-9a-zA-Z_\-]+>' => '<controller>/<action>',
                                                                '<controller:\w+>'                          => '<controller>/index',
                                                            )
                                    ),
                            ),

                            // настройки кэширования, подробнее http://www.yiiframework.ru/doc/guide/ru/caching.overview
                            'cache'         => CMap::mergeArray(
                                                   array(
                                                       'class' => 'CDummyCache',
                                                   ), $config['cache']
                                ),

                            // Yii strap
                            /*'yiistrap'      => array(
                                'class' => 'yiistrap.components.TbApi',
                            ),
                            // Yii wheels
                            'yiiwheels'     => array(
                                'class' => 'yiiwheels.YiiWheels',
                            ),*/

                            # Регистрация слушателей событий
                            /*'registrator'   => array(
                                'class'    => 'honey.extensions.registrator.Registrator',
                                'register' => $config['register'],
                            ),*/

                        ), $config['components']
        ),

    /*'behaviors'         => array(
        'onInitFrontController'   => array(
            'class' => 'honey.components.events.OnInitFrontControllerEvent'
        ),
        'onInitUrlManager'        => array(
            'class' => 'honey.components.events.OnInitUrlManagerEvent'
        ),
        'onAfterInitUrlManager'   => array(
            'class' => 'honey.components.events.OnAfterInitUrlManagerEvent'
        ),
        'onUploadFile'            => array(
            'class' => 'honey.components.events.OnUploadFileEvent',
        ),
        'onUploadImage'           => array(
            'class' => 'honey.components.events.OnUploadImageEvent',
        ),
        'onUploadDocument'        => array(
            'class' => 'honey.components.events.OnUploadDocumentEvent',
        ),
        'onDeleteModel'           => array(
            'class' => 'honey.components.events.OnDeleteModelEvent',
        ),
        'onSendModelToTrash'      => array(
            'class' => 'honey.components.events.OnSendModelToTrashEvent',
        ),
        'onRestoreModelFromTrash' => array(
            'class' => 'honey.components.events.OnRestoreModelFromTrashEvent',
        ),
    ),*/
);
//echo CVarDumper::dumpAsString($result, 10, TRUE);
//echo Yii::getPathOfAlias('mota-ab');
//die();

return $result;