<?php $this->layout("layouts/admin_default", ["title" => "Quản lý Món ăn"]) ?>

<?php if (!empty($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
        <?= $_SESSION['alert']['message'] ?>
    </div>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<div class="row">
    <!-- Form thêm món -->
    <div class="col-md-4">
        <h4>Thêm Món</h4>
        <form id="dishForm" method="POST" action="/admin/menu/store" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên món</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="100" placeholder="Nhập tên món">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" maxlength="500" placeholder="Mô tả món (tối đa 500 ký tự)"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" min="1" required placeholder="Nhập giá món">
            </div>

            <div class="mb-3">
                <label for="image_file" class="form-label">Hình ảnh món</label>
                <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                <small class="form-text text-muted">Chỉ chấp nhận ảnh (jpg, png, gif), max 2MB</small>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>-- Chọn danh mục --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm Món</button>
        </form>
    </div>

    <!-- Danh sách món -->
    <div class="col-md-8">
        <h4>Danh sách Món</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên món</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Hình ảnh</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dishes)): ?>
                        <tr>
                            <td colspan="7" class="text-muted">Chưa có món</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dishes as $dish): ?>
                            <tr>
                                <td><?= $dish['dish_id'] ?></td>
                                <td><?= htmlspecialchars($dish['name']) ?></td>
                                <td><?= htmlspecialchars($dish['description'] ?: 'Chưa có mô tả') ?></td>
                                <td><?= number_format($dish['price'], 0, ',', '.') ?> VND</td>
                                <td><?= htmlspecialchars($dish['category_name']) ?></td>
                                <td>
                                    <?php
                                    $img = !empty($dish['image_url']) && file_exists(__DIR__ . '/../../../public' . $dish['image_url'])
                                        ? $dish['image_url']
                                        : '/images/default_dish.png';
                                    ?>
                                    <img src="<?= $img ?>" alt="<?= htmlspecialchars($dish['name']) ?>" style="width:60px; height:60px; object-fit:cover;">
                                </td>
                                <td>
                                    <form method="POST" action="/admin/menu/delete/<?= $dish['dish_id'] ?>" onsubmit="return confirm('Bạn có chắc muốn xóa món này?')">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('dishForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const price = document.getElementById('price').value;
        const fileInput = document.getElementById('image_file');
        const category = document.getElementById('category_id').value;

        let errors = [];

        // Validate tên
        if (name.length === 0 || name.length > 100) {
            errors.push("Tên món không hợp lệ (1-100 ký tự)");
        }

        // Validate giá
        if (price <= 0) {
            errors.push("Giá món phải lớn hơn 0");
        }

        // Validate ảnh nếu có
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                errors.push("File ảnh không hợp lệ (chỉ jpg, png, gif)");
            }
            if (file.size > 2 * 1024 * 1024) {
                errors.push("File ảnh quá lớn (max 2MB)");
            }
        }

        // Validate danh mục
        if (!category) {
            errors.push("Bạn phải chọn một danh mục cho món ăn");
        }

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
        }
    });
</script>