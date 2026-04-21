<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start('page') ?>

<div class="container-fluid text-center text-white main-content3">
    <div class="container">
        <div class="p-4 rounded-2 shadow-lg text-white">
            <h2 class="text-center mb-4 fw-bold">Đăng Nhập</h2>


            <?php if (isset($messages['success'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $this->e($messages['success']) ?>
                </div>
            <?php endif ?>


            <?php if (isset($errors['email']) || isset($errors['password'])): ?>
                <div class="alert alert-danger" role="alert">

                    <?= $this->e($errors['email'] ?? $errors['password']) ?>
                </div>
            <?php endif ?>

            <form action="/login" method="POST">
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

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check text-start">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ghi nhớ tôi</label>
                    </div>
                    <a href="#" class="text-white">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn btn-outline-light w-100 py-2 fs-5 fw-bold mb-3 login-button">Đăng Nhập</button>

                <p class="text-center m-0">
                    Chưa có tài khoản? <a href="/register" class="text-white">Đăng ký ngay</a>
                </p>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>