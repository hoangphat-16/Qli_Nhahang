<?php $this->layout("layouts/admin_default", ["title" => $title]) ?>

<h2 class="mb-4"><?= $this->e($title) ?></h2>

<!-- Tabs chọn ngày -->
<ul class="nav nav-tabs mb-4" id="dateTabs" role="tablist">
    <?php foreach ($dates as $i => $date): ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $i ?>" data-bs-toggle="tab" data-bs-target="#day-<?= $i ?>" type="button" role="tab">
                <?= date('d/m/Y', strtotime($date)) ?>
            </button>
        </li>
    <?php endforeach; ?>
</ul>

<div class="tab-content" id="dateTabsContent">
    <?php foreach ($dates as $i => $date): ?>
        <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="day-<?= $i ?>" role="tabpanel">
            <div class="row g-4 mb-3">
                <div class="col-md-6">
                    <div class="card shadow-sm text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title mb-2">
                                <i class="fas fa-chair me-2"></i>Số bàn còn trống
                            </h5>
                            <p class="display-6 fw-bold mb-0"><?= $this->e($tablesLeft[$date]) ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title mb-2">
                                <i class="fas fa-clock me-2"></i>Đơn chờ xác nhận
                            </h5>
                            <p class="display-6 fw-bold mb-0"><?= $this->e($pendingOrders[$date]) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách booking ngày -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Đơn</th>
                                <th>Khách Hàng</th>
                                <th>Giờ Đặt</th>
                                <th>Số Khách</th>
                                <th>Món đã đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookingsByDate[$date])): ?>
                                <?php foreach ($bookingsByDate[$date] as $booking): ?>
                                    <tr>
                                        <td>#<?= $this->e($booking['booking_id']) ?></td>
                                        <td><?= $this->e($booking['customer_name']) ?></td>
                                        <td><?= $this->e($booking['booking_time']) ?></td>
                                        <td><?= $this->e($booking['guest_count']) ?></td>
                                        <td>
                                            <?php if (!empty($booking['dishes'])): ?>
                                                <ul class="mb-0">
                                                    <?php foreach ($booking['dishes'] as $dish): ?>
                                                        <li><?= $this->e($dish) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <small>Không có món</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($booking['status'] == 'Chờ xác nhận'): ?>
                                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                            <?php elseif ($booking['status'] == 'Đã xác nhận'): ?>
                                                <span class="badge bg-success">Đã xác nhận</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Đã hủy</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form method="POST" action="/admin/delete/<?= $booking['booking_id'] ?>" class="d-inline">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn này?')">
                                                    <i class="fas fa-trash me-1"></i>Xóa
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">Chưa có đơn nào trong ngày này.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>