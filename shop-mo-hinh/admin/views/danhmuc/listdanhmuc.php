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
            <h1>Quản lý danh mục sản phẩm</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?= BASE_URL_ADMIN . '?act=form_them_danh_muc'?>">
                  <button class="btn btn-success">Thêm danh mục</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listdanhmuc as $key=>$DM){?>
                  <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $DM['ten_danh_muc'] ?></td>
                    <td><?= $DM['mo_ta'] ?></td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=form_sua_danh_muc&id_danh_muc=' . $DM['id']?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . '?act=xoa_danh_muc&id_danh_muc=' . $DM['id']?>"
                       onclick="return confirm('Bạn có đồng ý xóa không?')">
                        <button class="btn btn-danger">Xóa</button>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
 <?php include './views/layout/footer.php';?>
 <!-- end footer -->
  
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>
</html>
