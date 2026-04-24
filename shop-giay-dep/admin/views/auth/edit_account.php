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
            <h1>Chỉnh sửa tài khoản</h1>
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
                <h3 class="card-title">Thông tin tài khoản</h3>
              </div>

              <?php if (!empty($errors['general'])): ?>
                  <div class="alert alert-danger m-2">
                      <i class="fas fa-exclamation-circle"></i> <?= $errors['general'] ?>
                  </div>
              <?php endif; ?>

              <form method="POST">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?= $account['id'] ?>">

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= htmlspecialchars($account['email']) ?>" disabled>
                    <small class="text-muted">Email không thể thay đổi</small>
                  </div>

                  <div class="form-group">
                    <label>Họ Tên</label>
                    <input type="text" class="form-control" name="ho_ten" value="<?= htmlspecialchars($account['ho_ten']) ?>">
                    <?php if (!empty($errors['ho_ten'])): ?>
                        <small class="text-danger"><?= $errors['ho_ten'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input type="tel" class="form-control" name="so_dien_thoai" value="<?= htmlspecialchars($account['so_dien_thoai']) ?>">
                    <?php if (!empty($errors['so_dien_thoai'])): ?>
                        <small class="text-danger"><?= $errors['so_dien_thoai'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="trang_thai">
                      <option value="1" <?= $account['trang_thai'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                      <option value="0" <?= $account['trang_thai'] == 0 ? 'selected' : '' ?>>Khóa</option>
                    </select>
                  </div>

                  <small class="text-muted">
                    Ngày sinh: <?= date('d/m/Y', strtotime($account['ngay_sinh'])) ?>
                  </small>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                  <a href="<?= BASE_URL_ADMIN ?>?act=manage_accounts" class="btn btn-secondary">Quay lại</a>
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
