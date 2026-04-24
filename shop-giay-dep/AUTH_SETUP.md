# Hệ Thống Xác Thực Admin

## Giới Thiệu

Hệ thống login/register đầy đủ cho admin panel với:
- Đăng nhập với email/password
- Đăng ký tài khoản admin mới
- Quản lý account admins
- Đổi mật khẩu
- Phân quyền với role (Giám đốc/Sale)

## Cài Đặt Database

### 1. Thực thi SQL setup

Chạy file `admin/setup.sql` để:
- Thêm roles (Giám đốc, Sale)
- Tạo test account

```sql
-- Mở MySQL client hoặc phpmyadmin
-- Copy-paste nội dung admin/setup.sql
-- Test account: 
--   Email: admin@example.com
--   Password: 123456
```

### 2. Database Structure

Sử dụng bảng `tai_khoans` hiện tại với columns:
- `id` - primary key
- `ho_ten` - Họ tên
- `email` - Email (unique)
- `ngay_sinh` - Ngày sinh
- `so_dien_thoai` - Số điện thoại
- `gioi_tinh` - Giới tính
- `dia_chi` - Địa chỉ
- `mat_khau` - Mật khẩu (bcrypt)
- `chuc_vu_id` - Role ID (1=Giám đốc/Admin, 2=Sale)
- `trang_thai` - Status (1=active, 0=blocked)

## Các Route Có Sẵn

| Route | URL | Method | Mô Tả |
|-------|-----|--------|-------|
| login | `?act=login` | GET/POST | Trang đăng nhập |
| register | `?act=register` | GET/POST | Trang đăng ký |
| dashboard | `?act=dashboard` | GET | Dashboard admin |
| manage_accounts | `?act=manage_accounts` | GET | Danh sách admin |
| edit_account | `?act=edit_account&id=X` | GET/POST | Sửa admin |
| change_password_form | `?act=change_password_form` | GET/POST | Đổi mật khẩu |
| delete_account | `?act=delete_account&id=X` | GET | Xóa admin |
| logout | `?act=logout` | GET | Đăng xuất |

## Cấu Trúc File

```
admin/
├── controllers/
│   └── AdminauthController.php      # Logic xác thực
├── models/
│   └── Adminaccount.php             # Model admin account
├── views/
│   ├── auth/
│   │   ├── login.php                # Form login
│   │   ├── register.php             # Form register
│   │   ├── dashboard.php            # Dashboard
│   │   ├── list_accounts.php        # Danh sách admin
│   │   ├── edit_account.php         # Sửa admin
│   │   └── change_password.php      # Đổi mật khẩu
│   └── layout/
│       ├── header.php               # HTML head + CSS
│       ├── navbar.php               # Top navbar
│       ├── sidebar.php              # Side menu
│       └── footer.php               # HTML footer
├── index.php                        # Routes
└── setup.sql                        # Database init
```

## Cách Sử Dụng

### 1. Đăng Nhập Lần Đầu

```
URL: /admin/?act=login
Email: admin@example.com
Password: 123456
```

### 2. Tạo Tài Khoản Admin Mới

```
URL: /admin/?act=register
Điền form:
- Họ tên
- Email (phải unique)
- Số điện thoại
- Mật khẩu (min 6 ký tự)
```

### 3. Quản Lý Tài Khoản

```
URL: /admin/?act=manage_accounts
- Xem danh sách tất cả admin
- Sửa thông tin admin
- Xóa admin
- Xem trạng thái
```

### 4. Đổi Mật Khẩu

```
URL: /admin/?act=change_password_form
- Nhập mật khẩu cũ
- Nhập mật khẩu mới
- Xác nhận mật khẩu mới
```

## Bảo Mật

### Encryption
- Mật khẩu được mã hóa bcrypt (password_hash + password_verify)
- Không lưu password plain text

### Session
- Sử dụng PHP $_SESSION
- Admin ID lưu trong session sau khi login
- Session bị destroy khi logout

### Validation
- Email validation (format + tồn tại?)
- Password validation (min 6 ký tự)
- Input sanitization với htmlspecialchars()

## File Chính

### AdminauthController.php

Key methods:
- `showLogin()` - Render login form + handle POST
- `handleLogin()` - Validate credentials, create session
- `showRegister()` - Render register form + handle POST
- `handleRegister()` - Validate, create new admin
- `showDashboard()` - Render dashboard (requires session)
- `listAccounts()` - Show all admins
- `logout()` - Destroy session, redirect

### Adminaccount.php (Model)

Key methods:
- `getByEmail($email)` - Get admin by email
- `getById($id)` - Get admin by ID
- `getAll()` - Get all admins (chuc_vu_id=1)
- `create($email, $password, $ho_ten, $so_dien_thoai)` - Create new
- `update($id, $ho_ten, $so_dien_thoai, $trang_thai)` - Update info
- `updatePassword($id, $newPassword)` - Update password
- `delete($id)` - Delete admin
- `emailExists($email)` - Check email exists

## Troubleshooting

### "Ko tạo tk dc" (Can't create account)

1. Check if `setup.sql` was imported
2. Check if roles exist in `chuc_vus` table
3. Check database connection in `commons/env.php`
4. Check error logs in browser console

### Login fails

1. Check if user exists: `SELECT * FROM tai_khoans WHERE email='...'`
2. Check password: Use `password_verify()` to test
3. Check user status: `trang_thai` must be 1
4. Check user role: Must have `chuc_vu_id` = 1

### Routes not working

1. Check URL: `/admin/?act=login`
2. Check if route exists in `admin/index.php`
3. Check BASE_URL_ADMIN constant in `commons/env.php`

## Tiếp Theo

- [ ] Test registration flow
- [ ] Test login/logout
- [ ] Test account management
- [ ] Test password change
- [ ] Test permissions (admin only)
