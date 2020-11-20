<?php
if (session_id() === '') {
    session_start();
  }
include_once(__DIR__.'/../../../dbconnect.php');

$hd_id = $_GET['hd_id'];
$sql_hd = "SELECT * FROM hoadon_chitiet hdct JOIN sanpham sp ON sp.sp_id = hdct.sp_id WHERE hd_id =".$hd_id;
$result_hd = mysqli_query($conn, $sql_hd);
$hoadon_ct = [];
while ($row_hd = mysqli_fetch_array($result_hd, MYSQLI_ASSOC)) {
    $hoadon_ct[] = array(
        'sp_id' => $row_hd['sp_id'],
        'hd_slsp' => $row_hd['hd_slsp'],
    );
}

foreach($hoadon_ct as $sp_xoa){
    $soluong = $sp_xoa['hd_slsp'];
    $id = $sp_xoa['sp_id'];
    $sql_soluongkho = <<<EOT
    UPDATE sanpham SET
    sp_slkho=sp_slkho + $soluong
   WHERE sp_id = $id
EOT;
mysqli_query($conn, $sql_soluongkho);
}



$sql_ct= "DELETE FROM `hoadon_chitiet` WHERE hd_id=".$hd_id;
mysqli_query($conn, $sql_ct);
$sql= "DELETE FROM `hoadon` WHERE hd_id=".$hd_id;

mysqli_query($conn, $sql);
    
mysqli_close($conn);
$sqltv="select * from thanhvien where tv_sdt =". $_SESSION["user"];
$resulttv = mysqli_query($conn,$sqltv);
while ($rowtv = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
    $datatv = array(
        'tv_ten' => $rowtv['tv_ten'],
        'quyen_id' => $rowtv['quyen_id'],
    );
}
if ($datatv['quyen_id']==1){
    header('location: /Du_an_nien_luan/backend/pages/giohang/donhang_user.php');
} else {
    header('location: /Du_an_nien_luan/backend/pages/donhang/ds_donhang.php');
}

?>