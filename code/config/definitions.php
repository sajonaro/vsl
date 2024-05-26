<?php

use Common\ConnectionProvider;
use Common\SessionsHelper;
use function DI\create;

return [
    ConnectionProvider::class => function () {
        return new ConnectionProvider(host: $_ENV["DB_HOST"],
                            user: $_ENV["MYSQL_USER"],
                            password: $_ENV["MYSQL_PASSWORD"],
                            dbname: $_ENV["MYSQL_DATABASE"]);         
    },
    SessionsHelper::class => create(SessionsHelper::class)
    

];