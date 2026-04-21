<?php

namespace App\Models;

use PDO;

class Setting
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function get($key)
    {
        $stmt = $this->db->prepare("SELECT setting_value FROM settings WHERE setting_key = :key");
        $stmt->execute(['key' => $key]);
        return $stmt->fetchColumn();
    }
    public function set($key, $value)
    {
        $sql = "INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)
                ON CONFLICT (setting_key) 
                DO UPDATE SET setting_value = :value";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['key' => $key, 'value' => $value]);
    }
}
