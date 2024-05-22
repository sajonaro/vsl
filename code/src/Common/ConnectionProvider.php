<?php

declare(strict_types=1);

namespace Common;

use PDO;

class ConnectionProvider
{
    public function __construct(private string $host,
                                private string $dbname,
                                private string $user,
                                private string $password)
    {
    }

    public function getConnection(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";

        $pdo = new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        return $pdo;
    }
}