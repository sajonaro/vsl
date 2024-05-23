<?php
declare(strict_types=1);

namespace App\Features\Products;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Features\Products\Repository;
use \Slim\Exception\HttpNotFoundException;
use Valitron\Validator;

class Controller{

    public function __construct(private Repository $repository, 
                                private Validator $validator){

        $this->validator->mapFieldsRules([
            "name" => ['required'],
            "price"=> ['required', 'numeric', ['min' , 0]]
        ]);                                

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

    public function create(Request $request, Response $response, $args): Response{

        $data = $request->getParsedBody();

        $this->validator = $this->validator->withData($data);
        
        if( ! $this->validator->validate()){
            $errors = json_encode($this->validator->errors());
            $response->getBody()
                     ->write($errors);
            return $response->withStatus(422);
        }
        $id = $this->repository->create($data);
        $body = json_encode([
            'message' => 'product created',
            'id' => $id
        ]);

        return $response->withStatus(201);
        

    }
}

