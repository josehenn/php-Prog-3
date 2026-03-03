<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function ($request, $response) {
    return 'Hello, World!';
}

);