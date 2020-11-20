<?php
  if(!isset($_SESSION)) { 
    session_start(); 
} 
include_once(__DIR__ . '/../../../dbconnect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sp_id = $_POST['sp_id'];
$sl_mua = $_POST['sl_mua'];

// select san pham tu sp_id
$sql = <<<EOT
    SELECT sp.sp_id, sp.sp_ten, sp.sp_mausac, sp.sp_kichthuoc, sp.sp_giaban, thuonghieu.th_ten
    FROM sanpham sp
    JOIN thuonghieu ON sp.th_id = thuonghieu.th_id
    WHERE sp_id=$sp_id                
EOT;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $sanpham = array(
        'sp_ten' => $row['sp_ten'],
        'sp_id' => $row['sp_id'],
        'sp_mausac' => $row['sp_mausac'],
        'sp_kichthuoc' => $row['sp_kichthuoc'],
        'sp_giaban' => $row['sp_giaban'],
        'th_ten' => $row['th_ten'],

    );
}
// select hinhsanpham tu sp_id 
$sql_hsp="SELECT MIN(hsp_id), hsp_ten FROM hinhsanpham hsp WHERE sp_id =".$sp_id;
$result_hsp = mysqli_query($conn, $sql_hsp);               
while ($row_hsp = mysqli_fetch_array($result_hsp, MYSQLI_ASSOC)) {
    $hinhsanpham = array(
        //  'hsp_id' => $row1['hsp_id'],
        'hsp_ten' => $row_hsp['hsp_ten'],                                        
    );
}

$sp_ten = $sanpham['sp_ten'];
$sp_giaban = $sanpham['sp_giaban'];
$sp_mausac = $sanpham['sp_mausac'];
$sp_kichthuoc = $sanpham['sp_kichthuoc'];
$th_ten = $sanpham['th_ten'];
$hinhdaidien = $hinhsanpham['hsp_ten'];
$thanhtien =($sl_mua * $sp_giaban);
$user = $_SESSION['user'];

if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $data[$sp_id] = array(
        'tv_id' => $user,
        'sp_id' => $sp_id,
        'sp_ten' => $sp_ten,
        'sl_mua' => $sl_mua,
        'sp_mausac' => $sp_mausac,
        'sp_kichthuoc' => $sp_kichthuoc,
        'th_ten' => $th_ten,
        'sp_giaban' => $sp_giaban,
        'thanhtien' => ($sl_mua * $sp_giaban),
        'hinhdaidien' => $hinhdaidien,
    );

    $_SESSION['giohangdata'] = $data;
} else { 
    $data[$sp_id] = array(
        'tv_id' => $user,
        'sp_id' => $sp_id,
        'sp_ten' => $sp_ten,
        'sl_mua' => $sl_mua,
        'sp_mausac' => $sp_mausac,
        'sp_kichthuoc' => $sp_kichthuoc,
        'th_ten' => $th_ten,
        'sp_giaban' => $sp_giaban,
        'thanhtien' => ($sl_mua * $sp_giaban),
        'hinhdaidien' => $hinhdaidien,
    );
    $_SESSION['giohangdata'] = $data;
}
echo json_encode($_SESSION['giohangdata']);