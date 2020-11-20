<?php
include_once(__DIR__.'/../../../dbconnect.php');

$sp_id = $_GET['sp_id'];

// -----------------xóa hình sản phẩm ------------------------------
$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE sp_id=".$sp_id;
$resultSelect = mysqli_query($conn, $sqlSelect);
$hinhsanpham = [];
while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
    $hinhsanpham[] = array(
        'hsp_ten' => $row['hsp_ten'],
        'hsp_id' => $row['hsp_id'],
        'sp_id' => $row['sp_id']
    );
}
foreach ($hinhsanpham as $data){
    $upload_dir = __DIR__ . "/../../../assets/img/upload_img/";
    $old_file = $upload_dir . $data['hsp_ten'];
    if (file_exists($old_file)) {
        // Hàm unlink(filepath) dùng để xóa file trong PHP
        unlink($old_file);
    }
    // 5. Thực thi câu lệnh DELETE
    $hsp_id = $data['hsp_id'];
    
    $sql_hsp = "DELETE FROM `hinhsanpham` WHERE hsp_id=" . $hsp_id;
    mysqli_query($conn, $sql_hsp);
}

// ------------------xóa sản phẩm ----------------------------------
$sql= "DELETE FROM `sanpham` WHERE sp_id=" . $sp_id;

mysqli_query($conn, $sql);

mysqli_close($conn);
    
header('location:danhsach_sp.php');
?>