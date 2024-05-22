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

    public function getById($id)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}