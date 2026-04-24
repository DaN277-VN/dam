<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/web/shop-giay-dep/');
define('BASE_URL_ADMIN' , 'http://localhost/web/shop-giay-dep/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123456');
define('DB_NAME'    , 'shop_mo_hinh');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
