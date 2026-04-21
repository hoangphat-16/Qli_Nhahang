<?php

namespace App\Models;

use PDO;

class Category
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

 
    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM categories ORDER BY category_name ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
