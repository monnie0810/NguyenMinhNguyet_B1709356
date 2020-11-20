<?php
include_once(__DIR__.'/../../../dbconnect.php');

$lsp_id = $_GET['lsp_id'];

$sql= "DELETE FROM `loaisanpham` WHERE lsp_id=" . $lsp_id;

$result = mysqli_query($conn, $sql);


mysqli_close($conn);
    
header('location:danhsach_lsp.php');
?>