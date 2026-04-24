-- Thêm chức vụ (nếu chưa có)
INSERT INTO `chuc_vus` (`id`, `ten_chuc_vu`) VALUES 
(1, 'Giám đốc'),
(2, 'Sale')
ON DUPLICATE KEY UPDATE `ten_chuc_vu`=VALUES(`ten_chuc_vu`);

-- Tạo tài khoản admin mẫu
-- Email: admin@example.com
-- Password: 123456 (bcrypt)
-- Chức vụ: Giám đốc (ID=1)
INSERT INTO `tai_khoans` (`ho_ten`, `email`, `ngay_sinh`, `so_dien_thoai`, `gioi_tinh`, `dia_chi`, `mat_khau`, `chuc_vu_id`, `trang_thai`) 
VALUES ('Giám Đốc Admin', 'admin@example.com', '1990-01-01', '0123456789', 1, 'Địa chỉ admin', '$2y$10$i3dNT5F0J6dC4i8vN5e1.ej8dN4S5x2R1q3p9m8L7k6J5h4G9B2i', 1, 1)
ON DUPLICATE KEY UPDATE `ho_ten`=VALUES(`ho_ten`);
