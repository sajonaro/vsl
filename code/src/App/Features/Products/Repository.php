<?php
declare(strict_types=1);

namespace App\Features\Products;

use Common\ConnectionProvider as Database;
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

    public function create(array $data):string
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare('INSERT INTO products (name, description, price) VALUES (:name, :description, :price)');
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    public function update(array $data):bool
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare('UPDATE products SET name = :name, description = :description, price = :price  WHERE id = :id ');
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}