<?php $this->layout("layouts/admin_default", ["title" => "Quản lý Bàn"]) ?>

<h2 class="mb-4">Quản lý Số Lượng Bàn</h2>

<?php if (!empty($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $this->e($_SESSION['alert']['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<div class="row g-4">

    <!-- Thông tin tình trạng hôm nay -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tình trạng tổng quan nhà hàng</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-3 border-bottom">
                    <span>Tổng số bàn:</span>
                    <span class="fw-bold fs-5"><?= $this->e($totalTables) ?></span>
                </div>
                <div class="d-flex justify-content-between py-3 border-bottom text-danger">
                    <span>Đã đặt:</span>
                    <span class="fw-bold fs-5"><?= $this->e($bookedCount) ?></span>
                </div>
                <div class="d-flex justify-content-between pt-3 text-success">
                    <span>Còn trống:</span>
                    <span class="fw-bold fs-4"><?= $this->e($available) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form cài đặt tổng bàn -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Cài đặt Tổng số bàn</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="/admin/tables/store">
                    <div class="mb-3">
                        <label for="total_tables" class="form-label">Nhập tổng số bàn của nhà hàng:</label>
                        <input type="number"
                            id="total_tables"
                            class="form-control form-control-lg"
                            name="total_tables"
                            value="<?= $this->e($totalTables) ?>"
                            min="1"
                            required>
                        <div class="form-text">Dùng để tính số bàn trống mỗi ngày.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Lưu Cài Đặt
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>