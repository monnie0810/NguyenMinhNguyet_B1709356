<?php 
include_once(__DIR__.'/../../dbconnect.php'); 
$sql ="SELECT COUNT(*) as SoLuong FROM `hoadon`";
$result =mysqli_query($conn,$sql);
$Tongsohoadon = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $Tongsohoadon[] = array(
        'SoLuong' => $row['SoLuong']
    );
}

echo json_encode($Tongsohoadon[0]);

?>