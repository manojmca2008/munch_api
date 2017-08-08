<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
/**
 * Works only in local environment. No effect in other environments.
 * @param mixed $obj object to be printed
 * @param bool $exit defaults to false. If true exits the app.
 * @return NULL
 */
function pr($obj, $exit = false) {
    if(APPLICATION_ENV != 'local'){
        return ;
    }
    $bt = debug_backtrace();
    $caller = array_shift($bt);
    echo "<pre>";
    echo "\n===== Called from " . $caller['file'] . " " . $caller['line'] . " =====\n\n";
    print_r($obj);
    echo "\n\n";
    if ($exit) {
        exit;
    }
}

/**
 * Works only in local environment. No effect in other environments.
 * @param mixed $obj object to be var_dump(ed]
 * @param bool $exit defaults to false. If true exits the app.
 * @return NULL
 */
function vd($obj, $exit = false) {
    if(APPLICATION_ENV != 'local'){
        return ;
    }
    $bt = debug_backtrace();
    $caller = array_shift($bt);
    echo "<pre>";
    echo "\n===== Called from " . $caller['file'] . " " . $caller['line'] . " =====\n\n";
    var_dump($obj);
    echo "\n\n";
    if ($exit) {
        exit;
    }
}

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => 'mysql:host=localhost;dbname=MunchAdo',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
    'solr' => [
            'protocol' => 'http://',
            //'host' => '192.168.2.12',
            //'port' => 8080,
            //'context' => 'msearch',
          'host' => 'localhost',
          'port' => 8984,
          'context' => 'solr'
        ],
];