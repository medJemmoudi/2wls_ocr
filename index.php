<?php
// include Composer Autoload file
require 'vendor/autoload.php';

// Define some configuration for database
$database = [
    'host' => 'localhost',
    'name' => '2wls',
    'user' => 'root',
    'pass' => '',
];


$app = new \RKA\Slim();



// Register the default Controller 
$app->container->singleton('App\MainController', function ( $container ) {
    return new \App\Controller\MainController;
});

// Register the ORM
$app->container->singleton('ORM', function ( $container ) use ( $database ) {
    $pdo = new PDO("mysql:host=". $database['host'] .";dbname=". $database['name'], $database['user'], $database['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return new Voodoo\VoodOrm($pdo);
});

$app->post('/parse', 'App\MainController:index');

$app->run();