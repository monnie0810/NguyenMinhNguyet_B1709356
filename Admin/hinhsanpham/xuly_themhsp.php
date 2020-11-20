<?php
if (session_id() === '') {
  session_start();
}
         include_once(__DIR__.'/../../../dbconnect.php'); 
       
        if (isset($_POST['btnthem_hsp'])) {

            $sp_id = $_POST['txt_spid'];
          

            if (isset($_FILES['hsp_tentaptin']['name'])) {
              // echo $sp_id; 
              $upload_dir = __DIR__ . "/../../../assets/img/upload_img/";
            
             

              // Đối với mỗi file, sẽ có các thuộc tính như sau:
              // $_FILES['hsp_tentaptin']['name']     : Tên của file chúng ta upload
              // $_FILES['hsp_tentaptin']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
              // $_FILES['hsp_tentaptin']['tmp_name'] : Đường dẫn đến file tạm trên web server
              // $_FILES['hsp_tentaptin']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
              // $_FILES['hsp_tentaptin']['size']     : Kích thước của file chúng ta upload

              
              if ($_FILES['hsp_tentaptin']['error'] > 0) {
                $_SESSION['thongbao_hsp']='Vui lòng thêm hình ảnh !';
                header("location: /Du_an_nien_luan/backend/pages/hinhsanpham/them_hsp.php?sp_id=".$sp_id); 

              } else {
          
                $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin;

              
                // var_dump($_FILES['hsp_tentaptin']['tmp_name']);
                // var_dump($upload_dir . $subdir . $tentaptin);

                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $tentaptin);
              $sql = "INSERT INTO `hinhsanpham` (hsp_ten, sp_id) VALUES ('$tentaptin', $sp_id);";
              mysqli_query($conn, $sql);

              // Đóng kết nối
              mysqli_close($conn);

              // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
              header("location: /Du_an_nien_luan/backend/pages/hinhsanpham/danhsach_hsp.php?sp_id=".$sp_id);
              
        }
      }
          else {
            echo "Không tải được file lên !!";
          }
        }
?>