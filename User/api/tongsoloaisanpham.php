<?php 
include_once(__DIR__.'/../../dbconnect.php'); 
$sql ="SELECT COUNT(*) as SoLuong FROM `loaisanpham`";
$result =mysqli_query($conn,$sql);
$Tongsoloaisanpham = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $Tongsoloaisanpham[] = array(
        'SoLuong' => $row['SoLuong']
    );
}

echo json_encode($Tongsoloaisanpham[0]);

?>