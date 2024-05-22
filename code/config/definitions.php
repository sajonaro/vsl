<?php

use Common\ConnectionProvider;

return [
    ConnectionProvider::class => function () {
        return new ConnectionProvider(host: $_ENV["DB_HOST"],
                            user: $_ENV["MYSQL_USER"],
                            password: $_ENV["MYSQL_PASSWORD"],
                            dbname: $_ENV["MYSQL_DATABASE"]);         
    }
];