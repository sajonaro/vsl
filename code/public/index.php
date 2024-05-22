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


$app->get('/api/products', function (Request $request,Response $response, $args) {
 
    $db = $this->get(App\Database::class); 
    $repository = new App\Features\Products\Repository($db);
    $products = $repository->getAll();
    $data = json_encode($products);
    $response->getBody()->write($data);
    
    return $response;
})->add(AddJsonREsponseHeader::class);


$app->get('/api/products/{id:[0-9]+}', function (Request $request,Response $response, $args) {
 
    $id = $args['id']; 

    $db = $this->get(App\Database::class); 
    $repository = new App\Features\Products\Repository($db);
    $result = $repository->getById((int) $id);
    if($result === false){
        throw new \Slim\Exception\HttpNotFoundException ($request, message:'product not found');
    }
    $body = json_encode($result);
    $response->getBody()->write($body);
    
    return $response;
})->add(AddJsonREsponseHeader::class);





$app->run();