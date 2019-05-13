<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// MongoClient database library 
$container['db'] = function ($c) {    
    $settings = $c->get('settings')['db'];
    $dsn = "mongodb://" .$settings['user'].':'.
    $settings['pass'].'@'. $settings['host'].'/'.
    $settings['dbname'];
    $mgClient = new \Sokil\Mongo\Client($dsn);
    $mgDB = $mgClient->getDatabase($settings['dbname']);

    return $mgDB;
};

