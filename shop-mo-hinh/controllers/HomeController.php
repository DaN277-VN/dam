<?php 

class HomeController
{
    public $modelsanpham;
    public function __construct()
    {
        $this->modelsanpham = new sanpham();
    }
    public function home()
    {
        echo "Trang chủ";
    }
    public function trangchu()
    {
        echo "Trang chủ";
    }
    public function danhsachsanpham()
    {
        $listProduct = $this->modelsanpham->getAllProduct();
        require_once './views/listproduct.php';
    }

}