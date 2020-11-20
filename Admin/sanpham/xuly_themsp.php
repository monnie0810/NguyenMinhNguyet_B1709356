<?php
 include_once(__DIR__.'/../../../dbconnect.php'); 
// 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
if (isset($_POST['btnthemsp'])) {
// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
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
    
    // Câu lệnh INSERT
    $sql2 = "INSERT INTO `sanpham` (sp_ten, sp_mausac, sp_slkho, sp_mota, sp_kichthuoc, sp_giabandau, sp_giaban, lsp_id, th_id)
     VALUES ('$ten', '$mausac', $slnhap, '$motasp', '$kichthuoc', $gianhapkho, $giaban, $lsp,  $th) ";

    // Thực thi INSERT
    mysqli_query($conn, $sql2) or die( mysqli_error($conn));

    // Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header("location: /Du_an_nien_luan/backend/pages/sanpham/danhsach_sp.php");
}
?>
<!-- End block content -->