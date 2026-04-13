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
            <h1>Sửa sản phẩm <?= $SP['ten_san_pham']?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thông tin sản phẩm</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form action="<?= BASE_URL_ADMIN . '?act=sua_san_pham' ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="san_pham_id" value="<?= $SP['id'] ?>">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?= $SP['ten_san_pham'] ?>">
                <?php if (isset($_SESSION['errors']['ten_san_pham'])) { ?>
                  <span class="text-danger"><?= $_SESSION['errors']['ten_san_pham'] ?></span>
                <?php } ?>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="gia_san_pham">Giá sản phẩm</label>
                  <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?= $SP['gia_san_pham'] ?>">
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="gia_khuyen_mai">Giá khuyế mãi</label>
                    <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?= $SP['gia_khuyen_mai'] ?>">
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="hinh_anh">Hình ảnh</label>
                      <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="so_luong">Số lượng</label>
                        <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?= $SP['so_luong'] ?>">
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                          <label for="ngay_nhap">Ngày nhập</label>
                          <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?= $SP['ngay_nhap'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="inputStatus">Danh mục sản phẩm</label>
                          <select id="inputStatus" name="danh_muc_id" class="form-control custom-select">
                            <?php foreach ($listdanhmuc as $DM): ?>
                              <option <?= $DM['id'] == $SP['danh_muc_id'] ? 'selected' : '' ?> value="<?= $DM['id']; ?>"><?= $DM['ten_danh_muc']; ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="trang_thai">Trạng thái sản phẩm</label>
                          <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                            <option <?= $SP['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn hàng</option>
                            <option <?= $SP['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Dừng hàng</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="mo_ta">Mô tả sản phẩm</label>
                          <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"><?= $SP['mo_ta'] ?></textarea>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                      </div>
                    </div>
          </form>
          <!-- /.card -->
        </div>
        <div class="col-md-12">

          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Album Ảnh sản phẩm</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <form action="<?= BASE_URL_ADMIN . '?act=sua-album-anh-sanpham' ?>" method="post" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table id="faqs" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Ảnh</th>
                        <th>File</th>
                        <th>
                          <div class="text-center"><button type="button" onclick="addfaqs();" class="badge badge-success"><i class="fa fa-plus"></i>Thêm</button></div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="san_pham_id" value="<?= $SP['id'] ?>">
                      <input type="hidden" name="img_delete" id="img_delete">
                      <?php foreach ($listAnhSanPham as $key => $value): ?>
                        <tr id="faqs-row-<?= $key ?>">
                          <input type="hidden" name="current_img_id[]" value="<?= $value['id'] ?>">
                          <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" style="width: 50px; height: 50px;" alt=""></td>
                          <td><input type="file" name="img_array[]" class="form-control"></td>
                          <td class="mt-10"><button class="badge badge-danger" type="button" onclick="removeRow(<?= $key ?>, <?= $value['id'] ?>)"><i class="fa fa-trash"></i> Delete</button></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-primary">Sửa thông tin</button>
            </div>
            </form>

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="<?= BASE_URL_ADMIN . '?act=san_pham' ?>" class="btn btn-secondary">Quay lại</a>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
 <?php include './views/layout/footer.php';?>
 <!-- end footer -->

<script>
  let rowCount = <?= count($listAnhSanPham) ?>;
  let deletedIds = [];

  function addfaqs() {
    const tbody = document.querySelector('#faqs tbody');
    const newRow = document.createElement('tr');
    newRow.id = 'faqs-row-' + rowCount;
    newRow.innerHTML = `
      <input type="hidden" name="current_img_id[]" value="">
      <td>-</td>
      <td><input type="file" name="img_array[]" class="form-control"></td>
      <td class="mt-10"><button class="badge badge-danger" type="button" onclick="removeRow(${rowCount})"><i class="fa fa-trash"></i> Delete</button></td>
    `;
    tbody.appendChild(newRow);
    rowCount++;
  }

  function removeRow(key, imageId = null) {
    const row = document.getElementById('faqs-row-' + key);
    if (row) {
      row.remove();
      if (imageId) {
        deletedIds.push(imageId);
        document.getElementById('img_delete').value = deletedIds.join(',');
      }
    }
  }
</script>

</body>
</html>
<!-- 40:15 -->