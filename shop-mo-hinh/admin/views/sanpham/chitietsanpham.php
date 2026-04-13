<!-- header -->
<?php require './views/layout/header.php'; ?>
<!-- end header -->
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- end Navbar -->
<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>
<!-- end Sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi tiết sản phẩm: <?= $SP['ten_san_pham'] ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- Ảnh chính -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <img src="<?= BASE_URL . $SP['hinh_anh'] ?>" 
                 style="width: 100%; height: auto; border-radius: 8px;"
                 alt="<?= $SP['ten_san_pham'] ?>"
                 onerror="this.onerror=null; this.src='https://bizweb.dktcdn.net/thumb/grande/100/524/018/products/efdf01ef-5d88-4b8f-a8f2-9d715cecea0a-1719203756821.jpg?v=1723543214810'">
          </div>
        </div>

        <!-- Album ảnh -->
        <?php if (!empty($listAnhSanPham)): ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Album ảnh</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <?php foreach ($listAnhSanPham as $anh): ?>
              <div class="col-6 mb-2">
                <img src="<?= BASE_URL . $anh['link_hinh_anh'] ?>" 
                     style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px;"
                     alt="">
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Thông tin sản phẩm -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Thông tin chung</h3>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <tr>
                <td style="font-weight: bold; width: 30%;">ID</td>
                <td><?= $SP['id'] ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Tên sản phẩm</td>
                <td><?= $SP['ten_san_pham'] ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Danh mục</td>
                <td><?= $SP['ten_danh_muc'] ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Giá sản phẩm</td>
                <td><?= number_format($SP['gia_san_pham'], 0, ',', '.') ?> VNĐ</td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Giá khuyến mãi</td>
                <td><?= number_format($SP['gia_khuyen_mai'], 0, ',', '.') ?> VNĐ</td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Số lượng</td>
                <td><?= $SP['so_luong'] ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Ngày nhập</td>
                <td><?= date('d/m/Y', strtotime($SP['ngay_nhap'])) ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Trạng thái</td>
                <td>
                  <span class="badge <?= $SP['trang_thai'] == 1 ? 'badge-success' : 'badge-danger' ?>">
                    <?= $SP['trang_thai'] == 1 ? 'Còn hàng' : 'Dừng hàng' ?>
                  </span>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Mô tả sản phẩm</h3>
          </div>
          <div class="card-body">
            <?= !empty($SP['mo_ta']) ? $SP['mo_ta'] : 'Không có mô tả' ?>
          </div>
        </div>

        <!-- Thao tác -->
        <div class="card-footer text-center" style="background-color: #f8f9fa; padding: 15px; border-radius: 0 0 6px 6px;">
          <a href="<?= BASE_URL_ADMIN . '?act=form_sua_san_pham&id_san_pham=' . $SP['id'] ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Sửa
          </a>
          <a href="<?= BASE_URL_ADMIN . '?act=xoa_san_pham&id_san_pham=' . $SP['id'] ?>" 
             onclick="return confirm('Bạn có đồng ý xóa sản phẩm này không?')" 
             class="btn btn-danger">
            <i class="fas fa-trash"></i> Xóa
          </a>
          <a href="<?= BASE_URL_ADMIN . '?act=san_pham' ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->

</body>
</html>
