<?php
declare(strict_types=1);

namespace App\Features\Products;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Features\Products\Repository;
use \Slim\Exception\HttpNotFoundException;

class Controller{

    public function __construct(private Repository $repository){

    }


    public function getAll(Request $request, Response $response): Response
    {
        $products = $this->repository->getAll();
        $data = json_encode($products);
        $response->getBody()->write($data);
        return $response;
    }


    public function getById(Request $request, Response $response, $args): Response    {

        $id = $args['id']; 
        $result = $this->repository->getById((int) $id);
        if($result === false){
            throw new  HttpNotFoundException($request, message:'product not found');
        }
        $body = json_encode($result);
        $response->getBody()->write($body);
    
        return $response;
    }
}

