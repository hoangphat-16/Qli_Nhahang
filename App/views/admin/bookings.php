<?php $this->layout("layouts/admin_default", ["title" => $title]) ?>

<h2 class="mb-4"><?= $this->e($title) ?></h2>

<?php if (!empty($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>"><?= $_SESSION['alert']['message'] ?></div>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Khách Hàng</th>
                    <th>Liên hệ</th>
                    <th>Chi tiết</th>
                    <th>Món đã đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td>#<?= $this->e($booking['booking_id']) ?></td>
                            <td><?= $this->e($booking['customer_name']) ?></td>
                            <td>
                                <?= $this->e($booking['customer_phone']) ?><br>
                                <small><?= $this->e($booking['customer_email']) ?></small>
                            </td>
                            <td>
                                <?= date('d/m/Y', strtotime($booking['booking_date'])) ?> - <?= $this->e($booking['booking_time']) ?><br>
                                <small><?= $this->e($booking['guest_count']) ?> khách</small>
                                <?php if (!empty($booking['other_requests'])): ?>
                                    <br><span class="text-info small"><?= $this->e($booking['other_requests']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($booking['dishes'])): ?>
                                    <ul class="mb-0">
                                        <?php foreach ($booking['dishes'] as $dish): ?>
                                            <li><?= $this->e($dish) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <small>(<?= count($booking['dishes']) ?> món)</small>
                                <?php else: ?>
                                    <small>Không có món</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <?php if ($booking['status'] == 'Chờ xác nhận'): ?>
                                        <form method="POST" action="/admin/bookings/confirm/<?= $booking['booking_id'] ?>" class="d-inline">
                                            <button class="btn btn-sm btn-success" onclick="return confirm('Xác nhận đơn này?')">
                                                <i class="fas fa-check me-1"></i>Duyệt
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <form method="POST" action="/admin/bookings/delete/<?= $booking['booking_id'] ?>" class="d-inline">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn này?')">
                                            <i class="fas fa-trash me-1"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            Chưa có đơn nào.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>