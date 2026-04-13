  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= BASE_URL ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['admin_id'])): ?>
        <li class="nav-item">
          <span class="nav-link">
            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?>
          </span>
        </li>
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=logout' ?>" class="nav-link" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>