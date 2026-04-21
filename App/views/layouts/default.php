<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENUS PALACE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar text-white navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/logo.png">
                <?= $this->e($title) ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link active fs-5" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link active fs-5" href="/menu">Menu</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link active fs-5" href="/booking">Booking</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (!AUTHGUARD()->isUserLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="login">
                                <i class="fa-solid fa-user"></i>
                                <span class="ms-2 d-none d-lg-inline">Đăng nhập</span>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropstart">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <?= $this->e(AUTHGUARD()->user()->name) ?> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" class="d-none" action="/logout" method="POST">
                                </form>
                                <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                                    <a class="dropdown-item" href="/admin">
                                        Quản trị
                                    </a>
                                <?php endif; ?>
                                <form id="admin-form" class="d-none" action="/admin" method="POST">
                                </form>
                            </div>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->section("page") ?>

    <footer class="footer pt-3 pb-2 mt-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 mx-auto mb-3">
                    <h6 class="fw-bold mb-2">
                        VENUS PALACE
                    </h6>
                    <p style="text-align: justify;">
                        Nhà hàng chuyên cung cấp các món ăn đa dạng và chất lượng, mang đến trải nghiệm ẩm thực tuyệt
                        vời cho khách hàng. Đồng thời, chúng tôi cũng tổ chức các sự kiện đặc biệt và cung cấp dịch vụ
                        đặt chỗ tiện
                        lợi.
                    </p>
                </div>

                <div class="col-md-3 mx-auto mb-3">
                    <h6 class="text-uppercase mb-2">
                        Contact us
                    </h6>
                    <p><i class="fas fa-home me-3"></i>123, 3/2, Ninh Kiều, Cần Thơ</p>
                    <p><i class="fas fa-phone me-3"></i> + 01 234 567 89</p>
                    <p><i class="fas fa-envelope me-3"></i> info@example.com</p>
                </div>

                <div class="col-md-3 mx-auto mb-3">
                    <h6 class="text-uppercase mb-2">
                        Social media
                    </h6>
                    <p><a href="https://www.facebook.com" target="_blank" class="text-white me-4">
                            <i class="fab fa-facebook-f me-2"></i>Facebook</a></p>
                    <p><a href="https://www.instagram.com" target="_blank" class="text-white me-4">
                            <i class="fab fa-instagram me-2"></i>Instagram</a></p>
                    <p><a href="https://www.tiktok.com" target="_blank" class="text-white me-4">
                            <i class="fab fa-tiktok me-2"></i>Tiktok</a></p>
                </div>
            </div>
        </div>

        <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Bản quyền thuộc về:
            <a class="text-white text-decoration-none" href="#"><?= $this->e($title) ?></a>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?= $this->section("page_specific_js") ?>
</body>

</html>