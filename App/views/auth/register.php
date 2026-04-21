<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start('page') ?>

<div class="container-fluid text-center text-white main-content3">
    <div class="container">
        <div class="p-4 rounded-2 shadow-lg text-white">
            <h2 class="text-center mb-4 fw-bold">Đăng Ký</h2>

            <!-- Hiển thị lỗi chung (nếu có) -->
            <?php if (isset($errors['email'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->e($errors['email']) ?>
                </div>
            <?php elseif (isset($errors['password'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->e($errors['password']) ?>
                </div>
            <?php endif ?>

            <!-- Bắt đầu form, loại bỏ form lồng nhau -->
            <form action="/register" method="POST">
                <div class="mb-3 text-start">
                    <label for="emailOrUsername" class="form-label">Email</label>
                    <input type="text"
                        class="form-control login-input"
                        id="emailOrUsername"
                        name="email"
                        placeholder="Nhập email"
                        value="<?= $this->e($old['email'] ?? '') ?>"
                        required>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password"
                        class="form-control login-input"
                        id="password"
                        name="password"
                        placeholder="Nhập mật khẩu"
                        required>
                </div>

                <div class="mb-3 text-start">
                    <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password"
                        class="form-control login-input"
                        id="confirmPassword"
                        name="password_confirmation"
                        placeholder="Nhập lại mật khẩu"
                        required>
                </div>

                <button type="submit" class="btn btn-outline-light w-100 py-2 fs-5 fw-bold mb-3 login-button">Đăng Ký</button>

                <p class="text-center m-0">
                    Bạn đã có tài khoản? <a href="/login" class="text-white">Đăng nhập</a>
                </p>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>