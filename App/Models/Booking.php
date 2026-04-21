<?php

namespace App\Models;

use PDO;

class Booking
{
    private PDO $db;

    public int $booking_id = -1;
    public string $customer_name = '';
    public string $customer_phone = '';
    public string $customer_email = '';
    public string $booking_date = '';
    public string $booking_time = '';
    public int $guest_count = 1;
    public string $other_requests = '';
    public string $status = 'Chờ xác nhận';

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /** Lưu booking mới */
    public function save(): bool
    {
        $stmt = $this->db->prepare('
            INSERT INTO bookings 
            (customer_name, customer_phone, customer_email,
             booking_date, booking_time, guest_count, other_requests, status)
            VALUES 
            (:name, :phone, :email, :date, :time, :guest_count, :other, :status)
        ');

        $result = $stmt->execute([
            'name' => $this->customer_name,
            'phone' => $this->customer_phone,
            'email' => $this->customer_email,
            'date' => $this->booking_date,
            'time' => $this->booking_time,
            'guest_count' => $this->guest_count,
            'other' => $this->other_requests,
            'status' => $this->status
        ]);

        if ($result) {
            $this->booking_id = (int)$this->db->lastInsertId();
        }

        return $result;
    }

    /** Thêm món vào booking */
    public function addDishes(array $dishIds)
    {
        if ($this->booking_id <= 0 || empty($dishIds)) return;

        $stmt = $this->db->prepare("INSERT INTO booking_dishes (booking_id, dish_id) VALUES (?, ?)");
        foreach ($dishIds as $dishId) {
            $stmt->execute([$this->booking_id, $dishId]);
        }
    }

    /** Lấy booking theo ngày, kèm danh sách món */
    public function getByDateWithDishes(string $date): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM bookings WHERE booking_date = :date ORDER BY booking_time ASC"
        );
        $stmt->execute(['date' => $date]);
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bookings as &$booking) {
            $booking['dishes'] = $this->getDishesByBooking((int)$booking['booking_id']);
        }

        return $bookings;
    }

    /** Lấy danh sách món theo booking */
    public function getDishesByBooking(int $booking_id): array
    {
        $stmt = $this->db->prepare(
            "SELECT d.name 
             FROM booking_dishes bd
             JOIN dishes d ON bd.dish_id = d.dish_id
             WHERE bd.booking_id = :booking_id"
        );
        $stmt->execute(['booking_id' => $booking_id]);
        $dishes = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $dishes ?: [];
    }

    /** Cập nhật trạng thái */
    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE bookings SET status = :status WHERE booking_id = :id");
        return $stmt->execute([
            'status' => $status,
            'id' => $id
        ]);
    }

    /** Lấy tất cả booking theo trạng thái */
    public function getByStatuses(array $statuses): array
    {
        $placeholders = implode(',', array_fill(0, count($statuses), '?'));
        $stmt = $this->db->prepare(
            "SELECT * FROM bookings WHERE status IN ($placeholders) ORDER BY booking_date DESC, booking_time DESC"
        );
        $stmt->execute($statuses);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Đếm booking theo trạng thái và ngày */
    public function countByStatusAndDate(string $status, string $date): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM bookings WHERE status = :status AND booking_date = :date"
        );
        $stmt->execute(['status' => $status, 'date' => $date]);
        return (int)$stmt->fetchColumn();
    }

    /** Xóa booking và tất cả món liên quan */
    public function delete(int $id): bool
    {
        $this->db->beginTransaction();
        try {
            // Xóa món liên quan
            $stmt1 = $this->db->prepare("DELETE FROM booking_dishes WHERE booking_id = ?");
            $stmt1->execute([$id]);

            // Xóa chính booking
            $stmt2 = $this->db->prepare("DELETE FROM bookings WHERE booking_id = ?");
            $stmt2->execute([$id]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /** Xóa booking cùng tất cả món liên quan */
    public function deleteWithDishes(int $id): bool
    {
        // Xóa tất cả món liên quan trước
        $stmt = $this->db->prepare("DELETE FROM booking_dishes WHERE booking_id = ?");
        $stmt->execute([$id]);

        // Xóa booking
        $stmt2 = $this->db->prepare("DELETE FROM bookings WHERE booking_id = ?");
        return $stmt2->execute([$id]);
    }
}
