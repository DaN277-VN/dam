<?php
class Adminsanpham{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAllsanpham(){
        try{
            $sql = 'SELECT `san_phams`.*, `danh_mucs`.ten_danh_muc
            FROM `san_phams`
            INNER JOIN `danh_mucs` ON `san_phams`.danh_muc_id = `danh_mucs`.id
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function insertsanpham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh){
        try{
            $sql = 'INSERT INTO `san_phams` (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                    VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh
            ]);

            return $this->conn->lastInsertId();
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh){
        try{
            $sql = 'INSERT INTO `hinh_anh_san_phams` (san_pham_id, link_hinh_anh)
                    VALUES (:san_pham_id, :link_hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,
            ]);
            
            return true;
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function deleteAlbumAnhSanPham($id){
        try{
            $sql = 'DELETE FROM `hinh_anh_san_phams` WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function getAnhSanPhamById($id){
        try{
            $sql = 'SELECT * FROM `hinh_anh_san_phams` WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function getDetaisanpham($id){
        try{
            $sql = 'SELECT `san_phams`.*, `danh_mucs`.ten_danh_muc
            FROM `san_phams`
            INNER JOIN `danh_mucs` ON `san_phams`.danh_muc_id = `danh_mucs`.id
            WHERE `san_phams`.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function getlistanhsanpham($id){
        try{
            $sql = 'SELECT * FROM `hinh_anh_san_phams` WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "loi" . $e->getMessage();
        }
    }

    public function updatesanpham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh){
        try{
            $sql = 'UPDATE `san_phams` 
            SET ten_san_pham = :ten_san_pham,
                gia_san_pham = :gia_san_pham, 
                gia_khuyen_mai = :gia_khuyen_mai, 
                so_luong = :so_luong, 
                ngay_nhap = :ngay_nhap, 
                danh_muc_id = :danh_muc_id, 
                trang_thai = :trang_thai, 
                mo_ta = :mo_ta, 
                hinh_anh = :hinh_anh 
                WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id,
            ]);

            // Lấy ID sản phẩm mới thêm
            return true;
        }catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function deletesanpham($id){
        try{
            // Lấy sản phẩm để xóa hình ảnh
            $sanpham = $this->getDetaisanpham($id);
            if ($sanpham) {
                // Xóa ảnh chính
                deleteFile($sanpham['hinh_anh']);
                
                // Lấy danh sách ảnh album
                $listAnh = $this->getlistanhsanpham($id);
                foreach ($listAnh as $anh) {
                    deleteFile($anh['link_hinh_anh']);
                    $this->deleteAlbumAnhSanPham($anh['id']);
                }
            }
            
            // Xóa sản phẩm
            $sql = 'DELETE FROM `san_phams` WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            
            return true;
        }catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
    
}