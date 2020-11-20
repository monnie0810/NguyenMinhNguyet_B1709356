<?php
if (session_id() === '') {
    session_start();
  }
  include_once(__DIR__.'/../../scripts.php'); 
    include_once(__DIR__.'/../../../dbconnect.php');
    if (isset($_POST['btn_sualsp'])) {
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $lsp_id = $_POST['lspid'];
    $lsp_ten = $_POST['txttenlsp'];
    //không cập nhật tên loại sản phẩm đã có trong dữ liệu
    $sql1 ="SELECT * FROM loaisanpham WHERE lsp_ten = '$lsp_ten'";
    $result1 = mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql1);
        if(mysqli_num_rows( $result1) > 0){
            $_SESSION['thongbaolsp'] = "Loại sản phẩm đã tồn tại trong hệ thống !";
            header('location: sua_lsp.php?lsp_id='.$lsp_id);
        } 
        else{
            $sql = "UPDATE `loaisanpham` SET lsp_ten='$lsp_ten' WHERE lsp_id = $lsp_id;";
            mysqli_query($conn, $sql);
            header('location: danhsach_lsp.php');
        }  
     
}
mysqli_close($conn); 
?>