<?php 
include_once(__DIR__.'/../../dbconnect.php'); 
$sql ="SELECT COUNT(*) as SoLuong FROM `sanpham`";
$result =mysqli_query($conn,$sql);
$Tongsokhachhang = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $Tongsokhachhang[] = array(
        'SoLuong' => $row['SoLuong']
    );
}

echo json_encode($Tongsokhachhang[0]);

?>