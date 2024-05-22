<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use DI\ContainerBuilder;
use App\Middleware\AddJsonREsponseHeader;

define ('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$builder = new ContainerBuilder ();

$container = $builder->addDefinitions(APP_ROOT .'/config/definitions.php')
                     ->build (); 

AppFactory::setContainer($container);

$app = AppFactory::create();

$error_middleware = $app->addErrorMiddleware(true, true, true);
$error_handler = $error_middleware->getDefaultErrorHandler();
$error_handler->forceContentType('application/json');


$app->get('/', function (Request $request,Response $response, $args) {
    $response->getBody()->write("welcome to products app!");
    $response->getBody()->write("<br> this app is a client of VSA library.<br> please check https://github.com/sajonaro/vsl");
    return $response;
});


$app->get('/api/products', App\Features\Products\Controller::class . ':getAll')
    ->add(AddJsonREsponseHeader::class);


$app->get('/api/products/{id:[0-9]+}', App\Features\Products\Controller::class . ':getById')
    ->add(AddJsonREsponseHeader::class);


$app->run();