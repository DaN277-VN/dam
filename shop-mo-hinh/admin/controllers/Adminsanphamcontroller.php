<?php
class Adminsanphamcontroller{

    public $modelsanpham;
    public $modeldanhmuc;
    public function __construct(){
        $this->modelsanpham = new adminsanpham();
        $this->modeldanhmuc = new admindanhmuc();
    }
    public function danhsachsanpham(){

        $listsanpham = $this->modelsanpham->getAllsanpham();
        require_once './views/sanpham/listsanpham.php';
    }
    // thêm
    public function formsanpham(){
        // Hiển thị

        $listdanhmuc = $this->modeldanhmuc->getAlldanhmuc();
        require_once './views/sanpham/addsanpham.php';

        deleteSessionError();
    }
    public function postsanpham(){ 
        // Sử lý
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten_san_pham   = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham   = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong       = $_POST['so_luong'] ?? '';
            $ngay_nhap      = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id    = $_POST['danh_muc_id'] ?? '';
            $trang_thai     = $_POST['trang_thai'] ?? '';
            $mo_ta          = $_POST['mo_ta'] ?? '';

            $hinh_anh   = $_FILES['hinh_anh'] ?? null; // hình ảnh đơn

            $file_thumb = uploadFile($hinh_anh, './uploads/');
            
            $img_array  = $_FILES['img_array']; // mảng hình ảnh


            $errors = [];
            if (empty($ten_san_pham)){
                $errors['ten_san_pham'] = 'Tên sản phẩm ko đc để trống';
            }

            if (empty($gia_san_pham)){
                $errors['gia_san_pham'] = 'giá sản phẩm ko đc để trống';
            }

            if (empty($gia_khuyen_mai)){
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi ko đc để trống';
            }

            if (empty($so_luong)){
                $errors['so_luong'] = 'Số lượng ko đc để trống';
            }

            if (empty($ngay_nhap)){
                $errors['ngay_nhap'] = 'Ngày nhập ko đc để trống';
            }

            if (empty($danh_muc_id)){
                $errors['danh_muc_id'] = 'Tên danh mục ko đc để trống';
            }

            if (empty($trang_thai)){
                $errors['trang_thai'] = 'Trạng thái ko đc để trống';
            }
            if ($hinh_anh['error'] != 0){
                $errors['$hinh_anh'] = 'Không được để trống ảnh';
            }

            $_SESSION['error'] = $errors;
            if (empty($errors)){
                // var_dump('oke');
                $san_pham_id = $this->modelsanpham->insertsanpham($ten_san_pham,
                                                    $gia_san_pham,
                                                    $gia_khuyen_mai,
                                                    $so_luong,
                                                    $ngay_nhap,
                                                    $danh_muc_id,
                                                    $trang_thai,
                                                    $mo_ta,
                                                    $file_thumb);

                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]
                        ];

                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelsanpham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }
                               
                header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
                exit();
            } else {
                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }


    // // sửa
    public function formeditsanpham(){
        // Hiển thị
        $id = $_GET['id_san_pham'];
        $SP = $this->modelsanpham->getDetaisanpham($id);
        $listAnhSanPham = $this->modelsanpham->getlistanhsanpham($id);
        $listdanhmuc = $this->modeldanhmuc->getAlldanhmuc($id);

        // var_dump($DM);
        // die();
        if ($SP) {
            require_once './views/sanpham/editsanpham.php';
            deleteSessionError();
        }else{
            header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
            exit();
        }
    }
    public function posteditsanpham(){ 
        // Sử lý
        // Xử lý thêm dữ liệu
        // var_dump($_POST);

        // Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            // Lấy ra giữu liệu cũ của sản phẩm
            // var_dump('abc');die;
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // Truy vấn
            $sanPhamOld = $this->modelsanpham->getDetaisanpham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; // Lấy ảnh cũ để phục vụ cho sửa ảnh

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;

            // // Lưu hình ảnh vào
            // $file_thumb = uploadFile($hinh_anh, './uploads/');

            // // Mảng hình ảnh
            $img_array = $_FILES['img_array'] ?? null;

            // Tạo mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
            }


            $_SESSION['errors'] = $errors;
            // var_dump($errors);die;

            // Logic sửa ảnh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) { // nếu có ảnh cũ thì xóa ảnh cũ
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file; // Nếu không có ảnh mới thì giữ nguyên ảnh cũ
            }

            // Nếu không có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {

                // Nếu  ko có lỗi thì tiến hành thêm sản phẩm
                // var_dump('Oke');

                $this->modelsanpham->updatesanpham($san_pham_id,
                                                    $ten_san_pham,
                                                    $gia_san_pham,
                                                    $gia_khuyen_mai,
                                                    $so_luong,
                                                    $ngay_nhap,
                                                    $danh_muc_id,
                                                    $trang_thai,
                                                    $mo_ta,
                                                    $new_file);

                // Xử lý ảnh album
                // Xóa ảnh cũ nếu user đánh dấu  
                if (isset($_POST['img_delete']) && !empty($_POST['img_delete'])) {
                    $img_delete_ids = explode(',', $_POST['img_delete']);
                    foreach ($img_delete_ids as $img_id) {
                        $anhCu = $this->modelsanpham->getAnhSanPhamById($img_id);
                        if ($anhCu) {
                            deleteFile($anhCu['link_hinh_anh']);
                            $this->modelsanpham->deleteAlbumAnhSanPham($img_id);
                        }
                    }
                }

                // Upload ảnh mới
                if (!empty($img_array['name'][0])) {
                    foreach ($img_array['name'] as $key => $value) {
                        if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                            $file = [
                                'name' => $img_array['name'][$key],
                                'type' => $img_array['type'][$key],
                                'tmp_name' => $img_array['tmp_name'][$key],
                                'error' => $img_array['error'][$key],
                                'size' => $img_array['size'][$key]
                            ];

                            $link_hinh_anh = uploadFile($file, './uploads/');
                            $this->modelsanpham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                        }
                    }
                }

                // var_dump($san_pham_id); die;
                header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
                exit();
            } else {
                // Trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form    
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL_ADMIN . '?act=form-sua-san_pham&id_san_pham=' . $san_pham_id);
            }
        }
    }

    public function deletesanpham(){
        $id = $_GET['id_san_pham'] ?? null;
        if ($id) {
            $sanpham = $this->modelsanpham->getDetaisanpham($id);
            if ($sanpham) {
                $this->modelsanpham->deletesanpham($id);
            }
        }
        header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
        exit();
    }

    public function chitietsanpham(){
        $id = $_GET['id_san_pham'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
            exit();
        }

        $SP = $this->modelsanpham->getDetaisanpham($id);
        $listAnhSanPham = $this->modelsanpham->getlistanhsanpham($id);

        if ($SP) {
            require_once './views/sanpham/chitietsanpham.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san_pham');
            exit();
        }
    }

    // public function deletedanhmuc(){
    //     $id = $_GET['id_danh_muc'];
    //     $DM = $this->modeldanhmuc->getDetaidanhmuc($id);

    //     if($DM){
    //         $this->modeldanhmuc->destroydanhmuc($id);
    //     }
    //     header("Location: " . BASE_URL_ADMIN . '?act=danh_muc');
    //     exit();
    // }
}