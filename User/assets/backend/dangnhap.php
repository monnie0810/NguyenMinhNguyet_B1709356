
<?php
if (session_id() === '') {
    session_start();
}
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
include_once(__DIR__.'/../../backend/scripts.php'); 
include_once(__DIR__.'/../../dbconnect.php');
if(isset($_POST['btn_dangnhap'])){
    $sdt = htmlentities($_POST['txtsodienthoai']);
    $matkhau = addslashes(sha1($_POST['txtmatkhau']));
    if(empty($sdt) || empty($matkhau)){
        $_SESSION["thongbao"]= "vui lòng nhập thông tin đầy đủ !";
        header("location: /Du_an_nien_luan/index.php"); 
    } else {
        $sql = "SELECT * FROM thanhvien WHERE  tv_sdt = '$sdt' AND tv_matkhau = '$matkhau' ";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 0){
            $_SESSION["thongbao"]= "Bạn chưa đăng ký tài khoản !"; 
            header("location: /Du_an_nien_luan/index.php"); 
        } else {
            $_SESSION["user"]= $sdt; 
            $sql="select * from thanhvien where tv_sdt =". $sdt;
            $result = mysqli_query($conn,$sql);
            $data = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = array(
                    'quyen_id' => $row['quyen_id'],

                );
            }
            foreach($data as $thanhvien)
            $quyen_id = $thanhvien['quyen_id'];
            // echo $quyen_id;
            if($quyen_id == 1){
                header("location: /Du_an_nien_luan/index.php"); 
            } 
            if($quyen_id == 0){
                header("location: /Du_an_nien_luan/backend/pages/index_admin.php"); 
            } 

        }
    }
}
mysqli_close($conn);

?>
 