<?php
declare(strict_types=1);

namespace App\Features\Products;

use App\Database;
use PDO;

class Repository {

    private $pdo;

    public function __construct(private Database $db){
        
    }

    public function getAll()
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->query('SELECT * FROM products') or die($pdo->errorInfo()); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}