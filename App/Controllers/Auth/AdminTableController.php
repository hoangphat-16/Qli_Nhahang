<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Setting;
use App\Models\Booking;

class AdminTableController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!AUTHGUARD()->isUserLoggedIn()) {
            redirect('/login');
        }
    }

    /** Trang quản lý bàn */
    public function index()
    {
        $pdo = PDO();

        $settingModel = new Setting($pdo);
        $totalTables = (int)($settingModel->get('total_tables') ?: 20);

        $bookingModel = new Booking($pdo);
        $today = date('Y-m-d');

        // Sử dụng method đã có để đếm số bàn đã đặt
        $bookedCount = $bookingModel->countByStatusAndDate('Đã xác nhận', $today);

        $available = max(0, $totalTables - $bookedCount);

        $this->sendPage('admin/tables', [
            'title' => 'Quản lý Bàn',
            'totalTables' => $totalTables,
            'bookedCount' => $bookedCount,
            'available' => $available,
            'today' => date('d/m/Y')
        ]);
    }

    /** Lưu cài đặt tổng số bàn */
    public function store()
    {
        $total = (int)($_POST['total_tables'] ?? 0);

        if ($total > 0) {
            $settingModel = new Setting(PDO());
            $settingModel->set('total_tables', $total);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Cập nhật số bàn thành công!'
            ];
        } else {
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Số bàn không hợp lệ!'
            ];
        }

        redirect('/admin/tables');
    }
}
