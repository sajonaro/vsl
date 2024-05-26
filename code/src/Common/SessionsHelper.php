<?php

declare(strict_types=1);

namespace Common;

use Aws\DynamoDb\SessionHandler;
use Aws\DynamoDb\DynamoDbClient;

class SessionsHelper{

    public function __construct(){ 
        $this->registerSessionHandler();
    }

    private function registerSessionHandler(){
        
        $dynamoDb = DynamoDbClient::factory(array(
            'region'  => $_ENV["AWS_REGION"],
            'endpoint' => $_ENV["DYNAMO_DB_ENDPOINT"],
            'credentials' => [
              'key' => $_ENV["AWS_KEY"],
              'secret'  => $_ENV["AWS_SECRET"],
            ]
          ));

        
        $sessionHandler = SessionHandler::fromClient($dynamoDb, [
            'table_name' => 'sessions'
        ]);
        
        $sessionHandler->register();
    }


    public function countSession() {
        $count = isset($_SESSION['count']) ? $_SESSION['count'] : 1;
        $_SESSION['count'] = ++$count;
        return $count;
    }   


    public function startSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
}


