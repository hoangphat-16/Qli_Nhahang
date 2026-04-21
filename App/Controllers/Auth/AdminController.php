<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Booking;
use App\Models\Setting;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!AUTHGUARD()->isUserLoggedIn()) redirect('/login');
    }

    /** Trang Dashboard */
    public function index()
    {
        $pdo = PDO(); // kết nối PDO
        $settingModel = new Setting($pdo);
        $bookingModel = new Booking($pdo);

        $totalTables = (int)($settingModel->get('total_tables') ?: 20);

        // Lấy 5 ngày từ hôm nay
        $dates = [];
        $tablesLeft = [];
        $pendingOrders = [];
        $bookingsByDate = [];

        for ($i = 0; $i < 5; $i++) {
            $date = date('Y-m-d', strtotime("+$i days"));
            $dates[] = $date;

            $confirmedCount = $bookingModel->countByStatusAndDate('Đã xác nhận', $date);
            $tablesLeft[$date] = max(0, $totalTables - $confirmedCount);

            $pendingOrders[$date] = $bookingModel->countByStatusAndDate('Chờ xác nhận', $date);

            $bookingsByDate[$date] = $bookingModel->getByDateWithDishes($date);
        }

        $this->sendPage('admin/admin', [
            'title' => 'Bảng điều khiển',
            'dates' => $dates,
            'tablesLeft' => $tablesLeft,
            'pendingOrders' => $pendingOrders,
            'bookingsByDate' => $bookingsByDate
        ]);
    }

    public function delete($id)
    {
        $bookingModel = new Booking(PDO());

        $deleted = $bookingModel->deleteWithDishes((int)$id);

        if ($deleted) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Đã xóa đơn và tất cả món liên quan!'
            ];
        } else {
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Xóa đơn thất bại.'
            ];
        }

        redirect('/admin');
    }
}
