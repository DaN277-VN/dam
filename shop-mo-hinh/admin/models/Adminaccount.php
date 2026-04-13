<?php
class Adminaccount {
    public $conn;
    
    public function __construct(){
        $this->conn = connectDB();
    }
    
    // Lấy tài khoản admin theo email (chuc_vu_id = 1 là Giám đốc)
    public function getByEmail($email) {
        try {
            $sql = 'SELECT * FROM `tai_khoans` WHERE email = :email AND chuc_vu_id = 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Lấy tài khoản admin theo ID
    public function getById($id) {
        try {
            $sql = 'SELECT * FROM `tai_khoans` WHERE id = :id AND chuc_vu_id = 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Lấy danh sách tất cả tài khoản admin (Giám đốc)
    public function getAll() {
        try {
            $sql = 'SELECT * FROM `tai_khoans` WHERE chuc_vu_id = 1 ORDER BY id DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Tạo tài khoản admin mới
    public function create($email, $password, $ho_ten, $so_dien_thoai) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $ngay_sinh = date('Y-m-d');
            
            $sql = 'INSERT INTO `tai_khoans` (ho_ten, ngay_sinh, email, so_dien_thoai, gioi_tinh, dia_chi, mat_khau, chuc_vu_id, trang_thai)
                    VALUES (:ho_ten, :ngay_sinh, :email, :so_dien_thoai, 1, :dia_chi, :mat_khau, 1, 1)';
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':ngay_sinh' => $ngay_sinh,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => 'Địa chỉ chưa cập nhật',
                ':mat_khau' => $hashedPassword
            ]);
            return $result;
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Cập nhật tài khoản admin
    public function update($id, $ho_ten, $so_dien_thoai, $trang_thai) {
        try {
            $sql = 'UPDATE `tai_khoans` SET ho_ten = :ho_ten, so_dien_thoai = :so_dien_thoai, trang_thai = :trang_thai WHERE id = :id AND chuc_vu_id = 1';
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':id' => $id,
                ':ho_ten' => $ho_ten,
                ':so_dien_thoai' => $so_dien_thoai,
                ':trang_thai' => $trang_thai
            ]);
            return $result;
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Cập nhật mật khẩu
    public function updatePassword($id, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = 'UPDATE `tai_khoans` SET mat_khau = :mat_khau WHERE id = :id AND chuc_vu_id = 1';
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':id' => $id,
                ':mat_khau' => $hashedPassword
            ]);
            return $result;
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Xóa tài khoản admin
    public function delete($id) {
        try {
            $sql = 'DELETE FROM `tai_khoans` WHERE id = :id AND chuc_vu_id = 1';
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([':id' => $id]);
            return $result;
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // Kiểm tra email đã tồn tại hay chưa
    public function emailExists($email) {
        try {
            $sql = 'SELECT COUNT(*) as count FROM `tai_khoans` WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch();
            return $result['count'] > 0;
        } catch(Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
?>
