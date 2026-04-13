<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Admin</title>
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
        
        .login-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-box {
            width: 100%;
            max-width: 420px;
        }
        
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            padding: 40px 20px 30px;
            text-align: center;
            color: white;
        }
        
        .login-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .login-icon {
            font-size: 48px;
            margin-bottom: 10px;
            display: inline-block;
        }
        
        .login-body {
            padding: 35px 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
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
            margin-top: 5px;
            font-size: 12px;
        }
        
        .alert {
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
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
        
        .btn-login {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .login-footer {
            padding: 20px 30px;
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            text-align: center;
        }
        
        .login-footer p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        
        .login-footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .login-footer a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h1>Đăng Nhập</h1>
                <p>Quản lý hệ thống</p>
            </div>

            <div class="login-body">
                <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'register_success'): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle"></i> Đăng ký thành công! Vui lòng đăng nhập.
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
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
                        <label>Email</label>
                        <input type="email" class="<?= !empty($errors['email']) ? 'is-invalid' : '' ?>" 
                               name="email" placeholder="Nhập email" value="<?= $_POST['email'] ?? '' ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Mật Khẩu</label>
                        <input type="password" class="<?= !empty($errors['password']) ? 'is-invalid' : '' ?>" 
                               name="password" placeholder="Nhập mật khẩu">
                        <?php if (!empty($errors['password'])): ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-login">Đăng Nhập</button>
                </form>
            </div>

            <div class="login-footer">
                <p>Chưa có tài khoản? <a href="<?= BASE_URL_ADMIN ?>?act=register">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL_ADMIN ?>../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
