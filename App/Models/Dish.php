<?php

namespace App\Models;

use PDO;

class Dish
{
    private PDO $db;

    public int $id = -1;
    public string $name = '';
    public string $description = '';
    public float $price = 0;
    public string $image_url = '';
    public int $category_id = 0;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /** Lấy tất cả món ăn kèm category_id & category_name */
    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT d.dish_id, d.name, d.description, d.price, d.image_url, 
                    d.category_id, c.category_name 
             FROM dishes d 
             LEFT JOIN categories c ON d.category_id = c.category_id 
             ORDER BY d.dish_id DESC'
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lấy tất cả category */
    public function categories(): array
    {
        $stmt = $this->db->query('SELECT * FROM categories ORDER BY category_name ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lưu món ăn (thêm hoặc cập nhật) */
    public function save(): bool
    {
        if ($this->id > 0) {
            $stmt = $this->db->prepare(
                'UPDATE dishes 
                 SET name = :name, description = :description, price = :price, 
                     image_url = :image_url, category_id = :category_id 
                 WHERE dish_id = :id'
            );
            return $stmt->execute([
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image_url' => $this->image_url,
                'category_id' => $this->category_id
            ]);
        } else {
            $stmt = $this->db->prepare(
                'INSERT INTO dishes (name, description, price, image_url, category_id) 
                 VALUES (:name, :description, :price, :image_url, :category_id)'
            );
            $result = $stmt->execute([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image_url' => $this->image_url,
                'category_id' => $this->category_id
            ]);

            if ($result) {
                $this->id = $this->db->lastInsertId();
            }
            return $result;
        }
    }

    /** Xóa món ăn */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM dishes WHERE dish_id = :id');
        return $stmt->execute(['id' => $id]);
    }

    /** Lấy đường dẫn hình ảnh hợp lệ */
    public function getImageUrl(): string
    {
        if (!empty($this->image_url)) {
            $full_path = __DIR__ . '/../../public' . $this->image_url;
            if (file_exists($full_path)) {
                return $this->image_url;
            }
        }
        return '/images/default_dish.png';
    }
}
