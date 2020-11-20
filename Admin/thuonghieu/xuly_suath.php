<?php
if (session_id() === '') {
    session_start();
  }
  include_once(__DIR__.'/../../scripts.php'); 
    include_once(__DIR__.'/../../../dbconnect.php');
    if (isset($_POST['btn_suath'])) {
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $th_id = $_POST['thid'];
    $th_ten = $_POST['txttenth'];
    //không cập nhật tên loại sản phẩm đã có trong dữ liệu
    $sql1 ="SELECT * FROM thuonghieu WHERE th_ten = '$th_ten'";
    $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows( $result1) > 0){
            $_SESSION['thongbaoth'] = "Loại sản phẩm đã tồn tại trong hệ thống !";
            header('location: sua_th.php?th_id='.$th_id);
        } 
        else{
            $sql = "UPDATE `thuonghieu` SET th_ten='$th_ten' WHERE th_id = $th_id;";
            mysqli_query($conn, $sql);
            header('location: danhsach_th.php');
        }  
     
}
mysqli_close($conn); 
?>