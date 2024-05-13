<?php

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

$app = AppFactory::create();

$app->get('/', function (Request $request,Response $response, $args) {
    $response->getBody()->write("Hello, World!");
    return $response;
});

$app->run();