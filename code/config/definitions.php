<?php

use App\Database;

return [
    Database::class => function () {
        return new Database(host: $_ENV["DB_HOST"],
                            user: $_ENV["MYSQL_USER"],
                            password: $_ENV["MYSQL_PASSWORD"],
                            dbname: $_ENV["MYSQL_DATABASE"]);         
    }
];