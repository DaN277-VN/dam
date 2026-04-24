<?php
class AdminauthController {
    public $adminaccount;
    
    public function __construct() {
        $this->adminaccount = new Adminaccount();
    }
    
    // Hiển thị form đăng nhập
    public function showLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->handleLogin();
        }
        require_once './views/auth/login.php';
    }
    
    // Xử lý đăng nhập
    public function handleLogin() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $errors = [];
        
        if (empty($email)) {
            $errors['email'] = 'Email không được để trống';
        }
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu không được để trống';
        }
        
        if (empty($errors)) {
            $admin = $this->adminaccount->getByEmail($email);
            
            if ($admin && password_verify($password, $admin['mat_khau'])) {
                if ($admin['trang_thai'] == 1) {
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_name'] = $admin['ho_ten'];
                    header("Location: " . BASE_URL_ADMIN . "?act=dashboard");
                    exit();
                } else {
                    $errors['general'] = 'Tài khoản của bạn đã bị khóa';
                }
            } else {
                $errors['general'] = 'Email hoặc mật khẩu không chính xác';
            }
        }
        
        require_once './views/auth/login.php';
    }
    
    // Hiển thị form đăng ký
    public function showRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->handleRegister();
        }
        require_once './views/auth/register.php';
    }
    
    // Xử lý đăng ký
    public function handleRegister() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';
        $ho_ten = $_POST['ho_ten'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $errors = [];
        
        if (empty($email)) {
            $errors['email'] = 'Email không được để trống';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
        } elseif ($this->adminaccount->emailExists($email)) {
            $errors['email'] = 'Email này đã được sử dụng';
        }
        
        if (empty($password)) {
            $errors['password'] = 'Mật khẩu không được để trống';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải ít nhất 6 ký tự';
        }
        
        if ($password !== $password_confirm) {
            $errors['password_confirm'] = 'Mật khẩu nhập lại không khớp';
        }
        
        if (empty($ho_ten)) {
            $errors['ho_ten'] = 'Họ tên không được để trống';
        }
        
        if (empty($so_dien_thoai)) {
            $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
        }
        
        if (empty($errors)) {
            if ($this->adminaccount->create($email, $password, $ho_ten, $so_dien_thoai)) {
                header("Location: " . BASE_URL_ADMIN . "?act=login&msg=register_success");
                exit();
            } else {
                $errors['general'] = 'Lỗi khi đăng ký. Vui lòng thử lại';
                require_once './views/auth/register.php';
            }
        } else {
            require_once './views/auth/register.php';
        }
    }
    
    // Hiển thị dashboard
    public function showDashboard() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        require_once './views/auth/dashboard.php';
    }
    
    // Đăng xuất
    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL_ADMIN . "?act=login");
        exit();
    }
    
    // Hiển thị danh sách tài khoản admin
    public function listAccounts() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        $accounts = $this->adminaccount->getAll();
        require_once './views/auth/list_accounts.php';
    }
    
    // Hiển thị form chỉnh sửa tài khoản
    public function showEditForm() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        
        $id = $_GET['id'] ?? '';
        if (empty($id)) {
            header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts");
            exit();
        }
        
        $account = $this->adminaccount->getById($id);
        if (!$account) {
            header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts");
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->handleUpdate();
        }
        
        require_once './views/auth/edit_account.php';
    }
    
    // Xử lý cập nhật tài khoản
    public function handleUpdate() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        
        $id = $_POST['id'] ?? '';
        $ho_ten = $_POST['ho_ten'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? 1;
        $errors = [];
        
        if (empty($ho_ten)) {
            $errors['ho_ten'] = 'Họ tên không được để trống';
        }
        
        if (empty($so_dien_thoai)) {
            $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
        }
        
        if (empty($errors)) {
            if ($this->adminaccount->update($id, $ho_ten, $so_dien_thoai, $trang_thai)) {
                $_SESSION['admin_name'] = $ho_ten;
                header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts&success=1");
                exit();
            } else {
                $errors['general'] = 'Lỗi khi cập nhật tài khoản';
            }
        }
        
        $account = $this->adminaccount->getById($id);
        require_once './views/auth/edit_account.php';
    }
    
    // Hiển thị form thay đổi mật khẩu
    public function showChangePasswordForm() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->handleChangePassword();
        }
        require_once './views/auth/change_password.php';
    }
    
    // Xử lý thay đổi mật khẩu
    public function handleChangePassword() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        
        $admin_id = $_SESSION['admin_id'];
        $old_password = $_POST['old_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $new_password_confirm = $_POST['new_password_confirm'] ?? '';
        $errors = [];
        
        if (empty($old_password)) {
            $errors['old_password'] = 'Mật khẩu cũ không được để trống';
        }
        
        if (empty($new_password)) {
            $errors['new_password'] = 'Mật khẩu mới không được để trống';
        } elseif (strlen($new_password) < 6) {
            $errors['new_password'] = 'Mật khẩu mới phải ít nhất 6 ký tự';
        }
        
        if ($new_password !== $new_password_confirm) {
            $errors['new_password_confirm'] = 'Mật khẩu nhập lại không khớp';
        }
        
        if (empty($errors)) {
            $admin = $this->adminaccount->getById($admin_id);
            
            if (!password_verify($old_password, $admin['mat_khau'])) {
                $errors['old_password'] = 'Mật khẩu cũ không chính xác';
            } else {
                if ($this->adminaccount->updatePassword($admin_id, $new_password)) {
                    $success = 'Thay đổi mật khẩu thành công!';
                    require_once './views/auth/change_password.php';
                    return;
                } else {
                    $errors['general'] = 'Lỗi khi thay đổi mật khẩu';
                }
            }
        }
        
        require_once './views/auth/change_password.php';
    }
    
    // Xóa tài khoản admin
    public function deleteAccount() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL_ADMIN . "?act=login");
            exit();
        }
        
        $id = $_GET['id'] ?? '';
        if (empty($id)) {
            header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts");
            exit();
        }
        
        if ($this->adminaccount->delete($id)) {
            header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts&success=1");
            exit();
        } else {
            header("Location: " . BASE_URL_ADMIN . "?act=manage_accounts&error=1");
            exit();
        }
    }
}
?>
