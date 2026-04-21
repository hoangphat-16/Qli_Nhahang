<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?> | Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 100;
        }

        .main-content {
            margin-left: 250px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <nav class="sidebar bg-dark text-white p-3 border-end">
            <h5 class="mb-4">VENUS PALACE</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/admin">
                        <i class="fas fa-chart-bar me-2"></i>Bảng điều khiển
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/admin/menu">
                        <i class="fas fa-utensils me-2"></i>Quản lý Món ăn
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/admin/bookings">
                        <i class="fas fa-calendar-check me-2"></i>Quản lý Đặt bàn
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/admin/tables">
                        <i class="fas fa-chair me-2"></i>Quản lý Bàn
                    </a>
                </li>
            </ul>
            <div class="mt-auto border-top pt-3">
                <a class="nav-link text-danger" href="/logout">
                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                </a>
            </div>
            <div class="mt-auto pt-3">
                <a class="nav-link text-warning" href="/">
                    <i class="fas fa-sign-out-alt me-2"></i>Trở về trang chủ
                </a>
            </div>
        </nav>

        <main class="flex-grow-1 p-4 main-content">
            <?= $this->section('content') ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>