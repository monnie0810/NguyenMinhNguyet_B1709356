<?php
if(!isset($_SESSION)) { 
    session_start(); 
} 
// include_once(__DIR__.'/../../dbconnect.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include file cấu hình ban đầu của `Twig`
include_once(__DIR__.'/../../styles.php'); 

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../../dbconnect.php');

// Lấy thông tin người dùng gởi đến
$sp_id = $_POST['sp_id'];
$tv_id = $_SESSION['user'];
// Lưu trữ giỏ hàng trong session
// Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    if($data['tv_id'] === $_SESSION['user']){
        if(isset($data[$sp_id])) {
            unset($data[$sp_id]);
        }
    }
    

    // lưu dữ liệu giỏ hàng vào session
    $_SESSION['giohangdata'] = $data;
}

echo json_encode($_SESSION['giohangdata']);