<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!AUTHGUARD()->isUserLoggedIn()) redirect('/login');
    }

    /** Danh sách booking chờ duyệt */
    public function index()
    {
        $bookingModel = new Booking(PDO());

        // Lấy tất cả booking theo trạng thái "Chờ xác nhận"
        $pendingBookings = $bookingModel->getByStatuses(['Chờ xác nhận']);

        // Lấy danh sách món cho từng booking
        foreach ($pendingBookings as &$b) {
            $b['dishes'] = $bookingModel->getDishesByBooking((int)$b['booking_id']);
        }
        unset($b); // tránh reference lỗi

        $this->sendPage('admin/bookings', [
            'bookings' => $pendingBookings,
            'title' => 'Danh sách đơn chờ duyệt'
        ]);
    }

    /** Xác nhận booking */
    public function confirm($id)
    {
        $bookingModel = new Booking(PDO());
        $bookingModel->updateStatus((int)$id, 'Đã xác nhận');

        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Đơn đã được xác nhận.'];

        redirect('/admin/bookings'); // redirect về danh sách booking
    }

    /** Xóa booking + món liên quan */
    public function delete($id)
    {
        $bookingModel = new Booking(PDO());

        $deleted = $bookingModel->deleteWithDishes((int)$id);

        if ($deleted) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Đã xóa đơn và tất cả món liên quan!'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Xóa đơn thất bại.'];
        }

        redirect('/admin/bookings'); // redirect về danh sách booking
    }
}
