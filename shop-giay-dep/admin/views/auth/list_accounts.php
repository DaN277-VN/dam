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
            <h1>Quản lý tài khoản admin</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?= BASE_URL_ADMIN . '?act=register'?>">
                  <button class="btn btn-success">Tạo tài khoản mới</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if (!empty($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle"></i> Thành công!
                    </div>
                <?php endif; ?>
                
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Email</th>
                    <th>Họ Tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Sinh</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($accounts)): ?>
                        <?php foreach ($accounts as $i => $acc): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($acc['email']) ?></td>
                                <td><?= htmlspecialchars($acc['ho_ten']) ?></td>
                                <td><?= htmlspecialchars($acc['so_dien_thoai']) ?></td>
                                <td>
                                    <?php if ($acc['trang_thai'] == 1): ?>
                                        <span class="badge badge-success">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Khóa</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($acc['ngay_sinh'])) ?></td>
                                <td>
                                    <a href="<?= BASE_URL_ADMIN . '?act=edit_account&id=' . $acc['id']?>">
                                        <button class="btn btn-warning btn-sm">Sửa</button>
                                    </a>
                                    <a href="<?= BASE_URL_ADMIN . '?act=delete_account&id=' . $acc['id']?>"
                                     onclick="return confirm('Bạn có đồng ý xóa không?')">
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Không có tài khoản</td></tr>
                    <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>STT</th>
                    <th>Email</th>
                    <th>Họ Tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Sinh</th>
                    <th>Thao tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php include './views/layout/footer.php';?>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
