<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_id() === '') {
  
    session_start();
}
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("location: /Du_an_nien_luan/index.php");
    die;
} else {
    if (!isset($_SESSION['giohangdata']) || empty($_SESSION['giohangdata'])) {
       $_SESSION['thongbao_giohang'] = "Giỏ hàng rỗng !";
       header("location: /Du_an_nien_luan/backend/pages/giohang/giohang.php");
       
    }
    else{

        include_once(__DIR__ . '/../../../dbconnect.php');
    
        $kh_tendangnhap = $_SESSION['user'];
        $sqlSelectKhachHang = <<<EOT
            SELECT *
            FROM `thanhvien` kh
            WHERE kh.tv_sdt = '$kh_tendangnhap'
    EOT;
    
        $resultSelectKhachHang = mysqli_query($conn, $sqlSelectKhachHang);
        $khachhangRow;
        while ($row = mysqli_fetch_array($resultSelectKhachHang, MYSQLI_ASSOC)) {
            $khachhangRow = array(
                'tv_ten' => $row['tv_ten'],
                'tv_id' => $row['tv_id'],
                'tv_email' => $row['tv_email'],
                'tv_diachi' => $row['tv_diachi'],
                'tv_sdt' => $row['tv_sdt'],
            );
        }
    
        $hd_ngaylap = date('Y-m-d H:i:s', time()); // Lấy ngày hiện tại theo định dạng yyyy-mm-dd
        $hd_noigiao = $khachhangRow['tv_diachi'];
        $hd_trangthai = 0; // Mặc định là 0 chưa thanh toán
        $tv_id = $khachhangRow['tv_id'];
    
        $sqlInsertDonHang = <<<EOT
        INSERT INTO `hoadon` (`hd_ngaylap`, `hd_trangthai`, `tv_id`) 
            VALUES ('$hd_ngaylap', '$hd_trangthai', '$tv_id');
    EOT;
    
        // Thực thi INSERT Đơn hàng
        mysqli_query($conn, $sqlInsertDonHang);
    
    
        $hd_id = $conn->insert_id;
        
        $giohangdata = $_SESSION['giohangdata'];
    
        $hd_tongtien = 0;
        foreach ($giohangdata as $item) {
            $user = $item['tv_id'];
            $sp_id = $item['sp_id'];
            $sp_dh_soluong = $item['sl_mua'];
            $sp_giaban = $item['sp_giaban'];
           
            if($item['tv_id'] == $_SESSION['user']){
                $hd_tongtien += $sp_giaban * $sp_dh_soluong;
                // 4.2. Câu lệnh INSERT
                $sqlInsertSanPhamDonDatHang = <<<EOT
                INSERT INTO `hoadon_chitiet` (`sp_id`, `hd_id`, `hd_slsp`) 
                    VALUES ($sp_id, $hd_id, $sp_dh_soluong);
                EOT;

                // 4.3. Thực thi INSERT
                mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
                $sql_soluongkho = <<<EOT
                UPDATE sanpham SET
                sp_slkho=sp_slkho - $sp_dh_soluong
                WHERE sp_id = $sp_id
                EOT;
                mysqli_query($conn, $sql_soluongkho);
                //update tong tien vai hoa don 
                $sql_updatetongtien = <<<EOT
                UPDATE hoadon
                SET
                hd_tongtien='$hd_tongtien'
                WHERE hd_id=$hd_id
                EOT;
                mysqli_query($conn, $sql_updatetongtien);
                $data = $_SESSION['giohangdata'];
    
                if(isset($data[$sp_id])) {
                    unset($data[$sp_id]);
                }
            
                // lưu dữ liệu giỏ hàng vào session
                $_SESSION['giohangdata'] = $data;
                // unset($_SESSION['giohangdata']);
                $_SESSION['thongbao_giohang'] = "Giỏ hàng rỗng !";
                header("location: /Du_an_nien_luan/backend/pages/giohang/giohang.php");
                }  
            }
           
    }

}