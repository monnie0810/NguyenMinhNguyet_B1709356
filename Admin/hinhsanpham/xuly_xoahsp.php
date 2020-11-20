<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__ . '/../../../dbconnect.php');

$hsp_id = $_GET['hsp_id'];
$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_id=$hsp_id;";
$resultSelect = mysqli_query($conn, $sqlSelect);
while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
    $hinhsanpham = array(
        'hsp_ten' => $row['hsp_ten'],
        'hsp_id' => $row['hsp_id'],
        'sp_id' => $row['sp_id']
    );
}
$sp_id = $hinhsanpham['sp_id'];

$upload_dir = __DIR__ . "/../../../assets/img/upload_img/";

$old_file = $upload_dir . $hinhsanpham['hsp_ten'];
if (file_exists($old_file)) {
    // Hàm unlink(filepath) dùng để xóa file trong PHP
    unlink($old_file);
}
$sql = "DELETE FROM `hinhsanpham` WHERE hsp_id=" . $hsp_id;

// 5. Thực thi câu lệnh DELETE
$result = mysqli_query($conn, $sql);

// 6. Đóng kết nối
mysqli_close($conn);

// Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
header("location: /Du_an_nien_luan/backend/pages/hinhsanpham/danhsach_hsp.php?sp_id= $sp_id");



