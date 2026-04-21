<?php

define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

if (file_exists(ROOTDIR . 'App/functions.php')) {
    require_once ROOTDIR . 'App/functions.php';
} elseif (file_exists(ROOTDIR . 'app/functions.php')) {
    require_once ROOTDIR . 'app/functions.php';
}

$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();


try {
    $PDO = (new App\Models\PDOFactory())->create([
        'dbhost' => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
        'dbuser' => $_ENV['DB_USER'],
        'dbpass' => $_ENV['DB_PASS'],
    ]);
} catch (Exception $ex) {
    echo 'Không thể kết nối đến PostgreSQL, kiểm tra lại cấu hình .env.<br>';
    if (function_exists('dd')) {
        dd($ex);
    } else {
        die($ex->getMessage());
    }
}

session_start();


$timeout_duration = 300; //5p

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Phiên đăng nhập hết hạn do không hoạt động.'
    ];
    header("Location: /login");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();

$AUTHGUARD = new App\Models\SessionGuard();
