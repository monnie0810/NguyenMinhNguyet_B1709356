<?php
 if(!isset($_SESSION)) { 
    session_start(); 
} 
if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header("location: /Du_an_nien_luan/index.php"); 
} else {
    header("location: /Du_an_nien_luan/index.php"); 
}
?>
