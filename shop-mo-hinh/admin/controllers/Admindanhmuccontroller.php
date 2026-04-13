<?php
class Admindanhmuccontroller{

    public $modeldanhmuc;
    public function __construct(){
        $this->modeldanhmuc = new admindanhmuc();
    }
    public function danhsachdanhmuc(){
        $listdanhmuc = $this->modeldanhmuc->getAlldanhmuc();
        require_once './views/danhmuc/listdanhmuc.php';
    }
    // thêm
    public function formdanhmuc(){
        // Hiển thị
        require_once './views/danhmuc/adddanhmuc.php';
    }
    public function postdanhmuc(){
        // Sử lý
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $errors = [];
            if (empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục ko đc để trống';
            }
            if (empty($errors)){
                // var_dump('oke');
                $this->modeldanhmuc->insertdanhmuc($ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh_muc');
                exit();
            } else {
                require_once './views/danhmuc/adddanhmuc.php';
            }
        }
    }
    // sửa
    public function formeditdanhmuc(){
        // Hiển thị
        $id = $_GET['id_danh_muc'];
        $DM = $this->modeldanhmuc->getDetaidanhmuc($id);
        // var_dump($DM);
        // die();
        if ($DM) {
            require_once './views/danhmuc/editdanhmuc.php';
        }else{
            header("Location: " . BASE_URL_ADMIN . '?act=danh_muc');
            exit();
        }
    }
    public function posteditdanhmuc(){
        // Sử lý
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $errors = [];
            if (empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục ko đc để trống';
            }
            if (empty($errors)){
                // var_dump('oke');
                $this->modeldanhmuc->updatedanhmuc($id, $ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh_muc');
                exit();
            } else {
                $DM = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editdanhmuc.php';
            }
        }
    }
    public function deletedanhmuc(){
        $id = $_GET['id_danh_muc'];
        $DM = $this->modeldanhmuc->getDetaidanhmuc($id);

        if($DM){
            $this->modeldanhmuc->destroydanhmuc($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=danh_muc');
        exit();
    }
}