<?php
if (session_id() === '') {
    session_start();
  }

    include_once(__DIR__.'/../../../dbconnect.php');
    $hd_id = $_GET['hd_id'];
    $sql1 ="SELECT * FROM hoadon WHERE hd_id = '$hd_id'";
    $result1 = mysqli_query($conn, $sql1);
    // set trang thai
    $sql = "UPDATE `hoadon` SET hd_trangthai= 1 WHERE hd_id = $hd_id;";
    mysqli_query($conn, $sql);
    header('location: /Du_an_nien_luan/backend/pages/donhang/ds_donhang.php');
mysqli_close($conn); 
?>