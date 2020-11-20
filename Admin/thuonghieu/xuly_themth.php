<!-- rang buoc du lieu phia client -->
<?php 
   if (session_id() === '') {
    session_start();
  }
// include_once(__DIR__.'/../../scripts.php'); 
include_once(__DIR__.'/../../../dbconnect.php'); 
if(isset($_POST['btn_themth'] )){
    $th_ten = $_POST['txttenth'];
    if (!empty($th_ten)){
        $sql1="SELECT * FROM thuonghieu WHERE th_ten = '$th_ten'";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows( $result1) > 0){
            header("location: /Du_an_nien_luan/backend/pages/thuonghieu/danhsach_th.php");
        } else{
            $sql = "INSERT INTO thuonghieu(th_ten) VALUES ('$th_ten');";
            $result = mysqli_query($conn, $sql);
        } 
        
} 
    header("location: /Du_an_nien_luan/backend/pages/thuonghieu/danhsach_th.php");
    
}
mysqli_close($conn);

?>