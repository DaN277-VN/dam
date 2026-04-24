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
            <h1>Quản lý sản phẩm</h1>
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
                <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham'?>">
                  <button class="btn btn-success">Thêm</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá tiền</th>
                    <th>Giá giảm</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listsanpham as $key=>$SP){?>
                  <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $SP['ten_san_pham'] ?></td>
                    <td>
                        <img src="<?= BASE_URL . $SP['hinh_anh'] ?>" style="width: 100px" alt=""
                        onerror="this.onerror=null; this.src='https://bizweb.dktcdn.net/thumb/grande/100/524/018/products/efdf01ef-5d88-4b8f-a8f2-9d715cecea0a-1719203756821.jpg?v=1723543214810'"
                        >
                    </td>
                    <td><?= $SP['gia_san_pham'] ?></td>
                    <td><?= $SP['gia_khuyen_mai'] ?></td>
                    <td><?= $SP['so_luong'] ?></td>
                    <td><?= $SP['ten_danh_muc'] ?></td>
                    <td><?= $SP['trang_thai'] == 1 ? 'Còn hàng':'Hết hàng'; ?></td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $SP['id']?>">
                        <button class="btn btn-info">Chi tiết</button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . '?act=form_sua_san_pham&id_san_pham=' . $SP['id']?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . '?act=xoa_san_pham&id_san_pham=' . $SP['id']?>"
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
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá tiền</th>
                    <th>Giá giảm</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
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
