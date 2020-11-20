<!-- rang buoc du lieu phia client -->
<?php 
   if (session_id() === '') {
    session_start();
  }
// include_once(__DIR__.'/../../scripts.php'); 
include_once(__DIR__.'/../../../dbconnect.php'); 
if(isset($_POST['btn_themlsp'] )){
    $lsp_ten = $_POST['txttenlsp'];
    if (!empty($lsp_ten)){
        $sql1="SELECT * FROM loaisanpham WHERE lsp_ten = '$lsp_ten'";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows( $result1) > 0){
            header("location: /Du_an_nien_luan/backend/pages/loaisanpham/danhsach_lsp.php");
            die();
        } else{
            $sql = "INSERT INTO loaisanpham(lsp_ten) VALUES ('$lsp_ten');";
            $result = mysqli_query($conn, $sql);
        } 
        
} 
    header("location: /Du_an_nien_luan/backend/pages/loaisanpham/danhsach_lsp.php");
    
}
mysqli_close($conn);

?>