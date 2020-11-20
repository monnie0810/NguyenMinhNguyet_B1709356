<?php
include_once(__DIR__.'/../../../dbconnect.php');

$th_id = $_GET['th_id'];
// echo $th_id;

$sql= "DELETE FROM thuonghieu WHERE th_id=" . $th_id;

 mysqli_query($conn, $sql);

mysqli_close($conn);
    
header('location:danhsach_th.php');
?>