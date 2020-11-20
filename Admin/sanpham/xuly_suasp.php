<?php
if (session_id() === '') {
    session_start();
  }
  include_once(__DIR__.'/../../scripts.php'); 
 include_once(__DIR__.'/../../../dbconnect.php'); 
// 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
if (isset($_POST['btnsuasp'])) {
// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $sp_id = $_POST['sp_id'];
    $ten = $_POST['txttensp'];
    $mausac = $_POST['txtmausp'];
    $slnhap = $_POST['txtslnhap'];
    $kichthuoc = $_POST['txtkichthuoc'];
    $gianhapkho = $_POST['txtgianhap'];
    $giaban = $_POST['txtgiaban'];
    $motasp = $_POST['txtmotasp'];
    $lsp_ten = $_POST['txtlsp'];
    $th_ten = $_POST['txtthuonghieu'];
    // select loai san pham 
    $sql_lsp = "SELECT * FROM loaisanpham WHERE lsp_ten = '$lsp_ten'";
    $result = mysqli_query($conn, $sql_lsp)  or die( mysqli_error($conn));
    $data=[];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $data = array (
            'lsp_id' => $row['lsp_id'],
            'lsp_ten' => $row['lsp_ten'],

        );
    }
    // select thuong hieu 
    $sql_th = "SELECT * FROM thuonghieu WHERE th_ten = '$th_ten'";
    $result1 = mysqli_query($conn, $sql_th) or die( mysqli_error($conn));
    
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
        $data1 = array (
            'th_id' => $row1['th_id'],
            'th_ten' => $row1['th_ten'],

        );
    }
    $lsp = $data['lsp_id'];
    $th = $data1['th_id'];
    if(empty($ten) || empty($mausac) || empty($kichthuoc) || empty($slnhap) || empty($gianhapkho) || empty($giaban)){
        $_SESSION['thongbaosp_sua'] = "Vui lòng nhập đầy đủ thông tin !";
        header('location: /Du_an_nien_luan/backend/pages/sanpham/sua_sp.php?sp_id='.$sp_id);
       
    } 
    else{
        $sql2 =  <<<EOT
        UPDATE `sanpham` SET sp_ten='$ten', sp_mausac='$mausac', sp_slkho=$slnhap, 
        sp_mota='$motasp', sp_kichthuoc='$kichthuoc', sp_giabandau=$gianhapkho,
        sp_giaban= $giaban, lsp_id= $lsp, th_id=$th WHERE sp_id = $sp_id;
    EOT;
        // Thực thi UPDATE
        mysqli_query($conn, $sql2) or die( mysqli_error($conn));
        header('location: /Du_an_nien_luan/backend/pages/sanpham/danhsach_sp.php');
    }  
  

}
mysqli_close($conn);
?>