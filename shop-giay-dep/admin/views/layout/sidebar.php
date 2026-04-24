  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASE_URL_ADMIN ?>" class="brand-link">
      <span class="brand-text font-weight-light">shop giày dép</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?= isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin' ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=dashboard'?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=danh_muc'?>" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san_pham'?>" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Sản phẩm</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=manage_accounts'?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Quản lý tài khoản</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=change_password_form'?>" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>Cài Đặt</p>
            </a>
          </li>

          
        </ul>
      </nav>
    </div>
  </aside>