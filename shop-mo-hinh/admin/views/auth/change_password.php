<!-- header -->
 <?php require './views/layout/header.php';?>
<!-- end header -->
  <!-- Navbar -->
 <?php include './views/layout/navbar.php';?>
<!-- end Navbar -->
  <!-- Main Sidebar Container -->
 <?php include './views/layout/sidebar.php';?>
<!-- end Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Đổi mật khẩu</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thay đổi mật khẩu</h3>
              </div>

              <?php if (!empty($success)): ?>
                  <div class="alert alert-success m-2">
                      <i class="fas fa-check-circle"></i> <?= $success ?>
                  </div>
              <?php endif; ?>

              <?php if (!empty($errors['general'])): ?>
                  <div class="alert alert-danger m-2">
                      <i class="fas fa-exclamation-circle"></i> <?= $errors['general'] ?>
                  </div>
              <?php endif; ?>

              <form method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Mật Khẩu Cũ</label>
                    <input type="password" class="form-control" name="old_password" placeholder="Nhập mật khẩu cũ">
                    <?php if (!empty($errors['old_password'])): ?>
                        <small class="text-danger"><?= $errors['old_password'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label>Mật Khẩu Mới</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới (min 6 ký tự)">
                    <?php if (!empty($errors['new_password'])): ?>
                        <small class="text-danger"><?= $errors['new_password'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label>Xác Nhận Mật Khẩu Mới</label>
                    <input type="password" class="form-control" name="new_password_confirm" placeholder="Nhập lại mật khẩu">
                    <?php if (!empty($errors['new_password_confirm'])): ?>
                        <small class="text-danger"><?= $errors['new_password_confirm'] ?></small>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                  <a href="<?= BASE_URL_ADMIN ?>?act=dashboard" class="btn btn-secondary">Quay lại</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- footer -->
 <?php include './views/layout/footer.php';?>
 <!-- end footer -->
