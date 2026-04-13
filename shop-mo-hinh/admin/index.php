<?php 

session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/Admindanhmuccontroller.php';
require_once './controllers/Adminsanphamcontroller.php';
require_once './controllers/AdminauthController.php';

// Require toàn bộ file Models
require_once './models/Admindanhmuc.php';
require_once './models/Adminsanpham.php';
require_once './models/Adminaccount.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    '/' => (new AdminauthController())->showLogin(),
    // roter danh mục

    'danh_muc' => (new Admindanhmuccontroller())->danhsachdanhmuc(),

    'form_them_danh_muc' => (new Admindanhmuccontroller())->formdanhmuc(),

    'them_danh_muc' => (new Admindanhmuccontroller())->postdanhmuc(),

    'form_sua_danh_muc' => (new Admindanhmuccontroller())->formeditdanhmuc(),

    'sua_danh_muc' => (new Admindanhmuccontroller())->posteditdanhmuc(),

    'xoa_danh_muc' => (new Admindanhmuccontroller())->deletedanhmuc(),

    // roter san pham
    'san_pham' => (new Adminsanphamcontroller())->danhsachsanpham(),

    'form-them-san-pham' => (new Adminsanphamcontroller())->formsanpham(),

    'them_san_pham' => (new Adminsanphamcontroller())->postsanpham(),

    'form_sua_san_pham' => (new Adminsanphamcontroller())->formeditsanpham(),

    'sua_san_pham' => (new Adminsanphamcontroller())->posteditsanpham(),

    'sua-album-anh-sanpham' => (new Adminsanphamcontroller())->posteditsanpham(),

    'xoa_san_pham' => (new Adminsanphamcontroller())->deletesanpham(),

    // router auth
    'login' => (new AdminauthController())->showLogin(),
    'register' => (new AdminauthController())->showRegister(),
    'dashboard' => (new AdminauthController())->showDashboard(),
    'logout' => (new AdminauthController())->logout(),
    'manage_accounts' => (new AdminauthController())->listAccounts(),
    'edit_account' => (new AdminauthController())->showEditForm(),
    'change_password_form' => (new AdminauthController())->showChangePasswordForm(),
    'delete_account' => (new AdminauthController())->deleteAccount(),

    'chi-tiet-san-pham' => (new Adminsanphamcontroller())->chitietsanpham(),
};