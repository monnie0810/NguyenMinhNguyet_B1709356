<!-- rang buoc du lieu phia client -->
<?php 
    session_start();
include_once(__DIR__.'/../../backend/scripts.php'); 
include_once(__DIR__.'/../../dbconnect.php'); 
if(isset($_POST['btndangky'] )){
    $tendangnhap = $_POST['txtHoTen'];
    $ngaysinh = $_POST['txtngaysinh'];
    $gioitinh = $_POST['txtgioitinh'];
    $email = $_POST['txtEmail'];
    $sdt = $_POST['txtsodienthoai'];
    $diachi = $_POST['txtdiachi'];
    $matkhau = sha1($_POST['txtmatkhau']);
    $nhaplaimatkhau = sha1($_POST['txtnhaplaimatkhau']);
    $quantri = 1;
    if ($tendangnhap != '' && $email != '' && $sdt != '' && $diachi != '' && $matkhau != '' && $nhaplaimatkhau != ''){
        if($matkhau != $nhaplaimatkhau){
            $_SESSION["thongbaodk"] = "Mật khẩu không khớp !";
            header("location: /Du_an_nien_luan/backend/pages/dangky.php");
            die();
        }
    
        $sql1="SELECT * FROM thanhvien WHERE tv_sdt = '$sdt'";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows( $result1) > 0){
            $_SESSION["thongbaodk"] = "Số điện thoại đã có người dùng sử dụng !";
            header("location: /Du_an_nien_luan/backend/pages/dangky.php");
            die();
        }
        
        $sql = <<<EOT
        INSERT INTO thanhvien(
            tv_ten, tv_ngaysinh, tv_gioitinh, tv_email, tv_sdt, tv_diachi, tv_matkhau, quyen_id) 
            VALUES 
            ('$tendangnhap', '$ngaysinh', '$gioitinh', '$email', '$sdt', '$diachi', '$matkhau', $quantri);                  
EOT;
        $result = mysqli_query($conn, $sql) or die("khong thể chạy !");
        $_SESSION["user"] = $sdt;
        header("location: /Du_an_nien_luan/index.php");   
    
} else{
    $_SESSION["thongbaodk"] = "Vui lòng nhập thông tin đầy đủ !";
    header("location: /Du_an_nien_luan/backend/pages/dangky.php");
    }

    mysqli_close($conn);
}

?>