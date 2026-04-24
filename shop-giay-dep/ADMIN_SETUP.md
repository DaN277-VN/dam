# Hệ Thống Admin - Hướng Dẫn Cài Đặt

## 🚀 Bước 1: Chạy File SQL

Chạy file `admin/setup.sql` để:
- Tạo dữ liệu chức vụ (Giám đốc, Sale)
- Tạo tài khoản admin mẫu

**Thông tin tài khoản mẫu:**
- Email: `admin@example.com`
- Mật khẩu: `123456`

## 🔐 Bước 2: Đăng Nhập Lần Đầu

1. Truy cập: `http://localhost/web/shop-mo-hinh/admin/?act=login`
2. Nhập email: `admin@example.com`
3. Nhập mật khẩu: `123456`

## ⚠️ Bước 3: Thay Đổi Mật Khẩu Ngay

1. Vào Dashboard → Đổi Mật Khẩu
2. Nhập mật khẩu cũ và mật khẩu mới
3. Lưu thay đổi

## 📋 Chức Năng Chính

- **Đăng nhập/Đăng xuất**
- **Đăng ký tài khoản admin mới**
- **Quản lý tài khoản admin** (xem, sửa, xóa)
- **Đổi mật khẩu**

## 🔗 URL Routes

| Route | Mô tả |
|-------|-------|
| `?act=login` | Đăng nhập |
| `?act=register` | Đăng ký tài khoản mới |
| `?act=dashboard` | Dashboard chính |
| `?act=manage_accounts` | Quản lý tài khoản |
| `?act=change_password_form` | Đổi mật khẩu |
| `?act=logout` | Đăng xuất |

## ⚙️ Ghi Chú

- Chỉ tài khoản có **chức vụ "Giám đốc"** (chuc_vu_id=1) mới truy cập được admin
- Mật khẩu được mã hóa bằng bcrypt
- Tất cả tài khoản mới sẽ có chức vụ "Giám đốc"

## 🛠️ Cấu Trúc File

```
admin/
├── controllers/AdminauthController.php
├── models/Adminaccount.php
├── views/auth/
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── list_accounts.php
│   ├── edit_account.php
│   └── change_password.php
└── setup.sql
```
