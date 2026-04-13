<?php require './views/layout/header.php';?>
<?php include './views/layout/navbar.php';?>
<?php include './views/layout/sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Danh Mục</h3>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>?act=danh_muc" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Sản Phẩm</h3>
              </div>
              <div class="icon">
                <i class="fas fa-box"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>?act=san_pham" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Tài Khoản</h3>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>?act=manage_accounts" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Cài Đặt</h3>
              </div>
              <div class="icon">
                <i class="fas fa-key"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>?act=change_password_form" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php include './views/layout/footer.php';?>
