<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Dish;

class BookingController extends Controller
{
    public function create()
    {
        $pdo = PDO();


        $categoryModel = new Category($pdo);
        $categories = $categoryModel->getAll();


        $dishModel = new Dish($pdo);
        $dishes = $dishModel->all();


        $this->sendPage('booking', [
            'title' => 'Đặt bàn',
            'categories' => $categories,
            'dishes' => $dishes
        ]);
    }

    public function store()
    {
        $booking = new Booking(PDO());
        $booking->customer_name = $_POST['name'] ?? '';
        $booking->customer_phone = $_POST['phone'] ?? '';
        $booking->customer_email = $_POST['email'] ?? '';
        $booking->booking_date = $_POST['date'] ?? '';
        $booking->booking_time = $_POST['time'] ?? '';
        $booking->guest_count = (int)($_POST['guests'] ?? 1);
        $booking->other_requests = $_POST['other_requests'] ?? '';

        header('Content-Type: application/json');

        if ($booking->save()) {
            if (!empty($_POST['dishes'])) {
                $booking->addDishes($_POST['dishes']);
            }
            echo json_encode(['success' => true, 'message' => 'Đặt bàn thành công!, thông tin sẽ được chúng tôi liên lạc bạn qua số điện thoại']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Đặt bàn thất bại!']);
        }
        exit;
    }
}
