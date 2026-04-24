<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .register-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .register-box {
            width: 100%;
            max-width: 480px;
        }
        
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .register-header {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            padding: 40px 20px 30px;
            text-align: center;
            color: white;
        }
        
        .register-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .register-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .register-icon {
            font-size: 48px;
            margin-bottom: 10px;
            display: inline-block;
        }
        
        .register-body {
            padding: 35px 30px;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
            font-size: 13px;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #28a745;
            background: white;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }
        
        .form-group input.is-invalid {
            border-color: #dc3545;
            background: #fff8f9;
        }
        
        .form-group input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }
        
        .form-group small {
            display: block;
            margin-top: 4px;
            font-size: 11px;
        }
        
        .alert {
            margin-bottom: 15px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .btn-register {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .register-footer {
            padding: 15px 30px;
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            text-align: center;
        }
        
        .register-footer p {
            margin: 0;
            font-size: 13px;
            color: #666;
        }
        
        .register-footer a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .register-footer a:hover {
            color: #1e7e34;
            text-decoration: underline;
        }
    </style>
</head>
<body class="register-page">
    <div class="register-box">
        <div class="register-card">
            <div class="register-header">
                <div class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Đăng Ký</h1>
                <p>Tạo tài khoản admin mới</p>
            </div>

            <div class="register-body">
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= $success ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors['general'])): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?= $errors['general'] ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input type="text" class="<?= !empty($errors['ho_ten']) ? 'is-invalid' : '' ?>" 
                               name="ho_ten" placeholder="Nhập họ tên" value="<?= $_POST['ho_ten'] ?? '' ?>">
                        <?php if (!empty($errors['ho_ten'])): ?>
                            <small class="text-danger"><?= $errors['ho_ten'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="<?= !empty($errors['email']) ? 'is-invalid' : '' ?>" 
                               name="email" placeholder="Nhập email" value="<?= $_POST['email'] ?? '' ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="tel" class="<?= !empty($errors['so_dien_thoai']) ? 'is-invalid' : '' ?>" 
                               name="so_dien_thoai" placeholder="Nhập số điện thoại" value="<?= $_POST['so_dien_thoai'] ?? '' ?>">
                        <?php if (!empty($errors['so_dien_thoai'])): ?>
                            <small class="text-danger"><?= $errors['so_dien_thoai'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Mật Khẩu</label>
                        <input type="password" class="<?= !empty($errors['password']) ? 'is-invalid' : '' ?>" 
                               name="password" placeholder="Mật khẩu (tối thiểu 6 ký tự)">
                        <?php if (!empty($errors['password'])): ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Xác Nhận Mật Khẩu</label>
                        <input type="password" class="<?= !empty($errors['password_confirm']) ? 'is-invalid' : '' ?>" 
                               name="password_confirm" placeholder="Nhập lại mật khẩu">
                        <?php if (!empty($errors['password_confirm'])): ?>
                            <small class="text-danger"><?= $errors['password_confirm'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-register">Đăng Ký</button>
                </form>
            </div>

            <div class="register-footer">
                <p>Đã có tài khoản? <a href="<?= BASE_URL_ADMIN ?>?act=login">Đăng nhập ngay</a></p>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
