<?php

declare(strict_types=1);
namespace Common;
use PDO;

class ConnectionProvider
{

    public static function getConnection($dbHost, $dbUser, $dbPassword, $dbName)
    {
        return new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName . '', '' . $dbUser . '', null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
    
    
}
