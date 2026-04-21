<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Dish;
use App\Models\Category;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!AUTHGUARD()->isUserLoggedIn()) {
            redirect('/login');
        }
    }

    /** Trang danh sách món */
    public function index()
    {
        $pdo = PDO();
        $dishModel = new Dish(PDO());
        $dishes = $dishModel->all();
        $categoryModel = new Category($pdo);
        $categories = $categoryModel->getAll();

        $this->sendPage('admin/menu', [
            'dishes' => $dishes,
            'categories' => $categories,
            'title' => 'Quản lý Món ăn'
        ]);
    }

    /** Thêm món ăn mới */
    public function store()
    {
        $dishModel = new Dish(PDO());
        $dishModel->name = $_POST['name'] ?? '';
        $dishModel->description = $_POST['description'] ?? '';
        $dishModel->price = (float)($_POST['price'] ?? 0);
        $dishModel->category_id = (int)($_POST['category_id'] ?? 0);

        $errors = [];

        if (empty($dishModel->name) || strlen($dishModel->name) > 100) {
            $errors[] = "Tên món không hợp lệ";
        }

        if ($dishModel->price <= 0) {
            $errors[] = "Giá phải lớn hơn 0";
        }

        // Xử lý file upload
        $upload_dir = __DIR__ . '/../../../public/uploads/';
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        if (!empty($_FILES['image_file']['name'])) {
            $file = $_FILES['image_file'];
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($file['type'], $allowed_types) && $file['size'] <= 2 * 1024 * 1024) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $new_name = uniqid('dish_') . '.' . $ext;
                move_uploaded_file($file['tmp_name'], $upload_dir . $new_name);
                $dishModel->image_url = '/uploads/' . $new_name;
            } else {
                $errors[] = "File ảnh không hợp lệ hoặc quá lớn (max 2MB)";
            }
        } else {
            // Nếu không có file upload, dùng ảnh mặc định
            $dishModel->image_url = '/images/default_dish.png'; // đặt ảnh mặc định trong folder public/images/
        }

        if ($errors) {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => implode('<br>', $errors)];
        } else {
            if ($dishModel->save()) {
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Thêm món thành công!'];
            } else {
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Thêm món thất bại!'];
            }
        }

        redirect('/admin/menu');
    }


    public function destroy($id)
    {
        $dishModel = new Dish(PDO());

        // Kiểm tra xem món đã có người đặt chưa
        $stmt = PDO()->prepare('SELECT COUNT(*) FROM booking_dishes WHERE dish_id = :id');
        $stmt->execute(['id' => $id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Món đang được đặt → không xóa
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Món này đã có người đặt, không thể xóa!'
            ];
        } else {
            // Món chưa có booking → xóa
            if ($dishModel->delete($id)) {
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Xóa món thành công!'
                ];
            } else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Xóa món thất bại!'
                ];
            }
        }

        redirect('/admin/menu');
    }
}
