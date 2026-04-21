<?php

namespace App\Models;

use PDO;

class User
{
    private PDO $db;

    public int $id = -1;
    public string $email = '';
    public string $name = '';
    public string $password = '';
    public bool $is_admin = false;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * Lấy user theo cột và giá trị (email hoặc admin_id)
     */
    public function where(string $column, string $value): User
    {
        // Chỉ cho phép email hoặc admin_id để tránh SQL injection
        if (!in_array($column, ['email', 'admin_id'])) {
            throw new \Exception('Invalid column');
        }

        $statement = $this->db->prepare("SELECT * FROM admins WHERE $column = :value");
        $statement->execute(['value' => $value]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->fillFromDbRow($row);
        }

        return $this;
    }

    /**
     * Lưu hoặc cập nhật user
     */
    public function save(): bool
    {
        if ($this->id >= 0) {
            $statement = $this->db->prepare(
                'UPDATE admins SET email = :email, password_hash = :password, is_admin = :is_admin WHERE admin_id = :id'
            );
            return $statement->execute([
                'id' => $this->id,
                'email' => $this->email,
                'password' => $this->password,
                'is_admin' => $this->is_admin ? 1 : 0
            ]);
        } else {
            $statement = $this->db->prepare(
                'INSERT INTO admins (email, password_hash, is_admin, created_at) VALUES (:email, :password, :is_admin, now())'
            );
            $result = $statement->execute([
                'email' => $this->email,
                'password' => $this->password,
                'is_admin' => $this->is_admin ? 1 : 0
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Fill dữ liệu từ mảng input (register form)
     */
    public function fill(array $data): User
    {
        $this->email = $data['email'];
        $this->name = $data['email'];
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * Fill dữ liệu từ DB
     */
    private function fillFromDbRow(array $row)
    {
        $this->id = $row['admin_id'];
        $this->email = $row['email'];
        $this->name = $row['email'];
        $this->password = $row['password_hash'];
        $this->is_admin = (bool)($row['is_admin'] ?? false); // quan trọng
    }

    /**
     * Kiểm tra email đã tồn tại chưa
     */
    private function isEmailInUse(string $email): bool
    {
        $statement = $this->db->prepare('SELECT COUNT(*) FROM admins WHERE email = :email');
        $statement->execute(['email' => $email]);
        return $statement->fetchColumn() > 0;
    }

    /**
     * Validate dữ liệu register
     */
    public function validate(array $data): array
    {
        $errors = [];

        if (!$data['email']) {
            $errors['email'] = 'Invalid email.';
        } elseif ($this->isEmailInUse($data['email'])) {
            $errors['email'] = 'Email already in use.';
        }

        if (strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters.';
        } elseif ($data['password'] != $data['password_confirmation']) {
            $errors['password'] = 'Password confirmation does not match.';
        }

        return $errors;
    }

    /**
     * Kiểm tra admin
     */
    public function is_admin(): bool
    {
        return $this->is_admin;
    }
}
