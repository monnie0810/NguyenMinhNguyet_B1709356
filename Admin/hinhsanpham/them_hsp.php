<?php
 if (session_id() === '') {
    session_start();
  }
  if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sql_ad = "SELECT * FROM thanhvien WHERE tv_sdt = '$user'";
    $result_ad = mysqli_query($conn,$sql_ad);
    while($row_ad = mysqli_fetch_array($result_ad,MYSQLI_ASSOC)){
        $data_ad = array(
            'tv_id' => $row_ad['tv_id'],
            'quyen_id' => $row_ad['quyen_id'],
        );   
    }
    if ($data_ad['quyen_id'] == 1){
            header("location: /Du_an_nien_luan/index.php");
    }
} else {
    header("location: /Du_an_nien_luan/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monnie Store - Hình sản phẩm</title>
    <?php include_once(__DIR__.'/../../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/dangky.css" type="text/css " />
    <style>
    .preview-img-container img {
        height: 250px;
        width: 210px;
    }
    </style>
</head>

<body>
    <div class="container-fluid ">
        <?php include_once(__DIR__.'/../../partials/header_admin.php'); ?>


        <!-- duong dan  -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="/Du_an_nien_luan/backend/pages/index_admin.php"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="#"> <span>Thêm hình sản phẩm</span> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2"></div>

        </div>
        <!-- content dang nhap -->
        <!-- trang dang ky  -->
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row trang_dangky">
                    <div class="col-md-7 dangky_form">
                        <!-- form dang ky du lieu  -->
                        <form name="form_themhsp" id="form_themhsp"
                            action="/Du_an_nien_luan/backend/pages/hinhsanpham/xuly_themhsp.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="row title_formdangky">
                                <div class="col-md-12">
                                    <h4>Nhập thông tin sản phẩm </h4>
                                </div>
                            </div>
                            <!-- select san pham va thuong hieu -->
                            <?php
                                 include_once(__DIR__.'/../../../dbconnect.php'); 
                                 $sp_id = $_GET['sp_id'];
                                $sql ="SELECT * FROM sanpham WHERE sp_id=".$sp_id;
                                $result = mysqli_query($conn, $sql);                                
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                    $data = array (
                                        'sp_id' => $row['sp_id'],
                                        'sp_ten' => $row['sp_ten'],

                                    );
                                }
                            ?>
                            <div class="row body_formdangky">
                                <!-- id sản phẩm  -->
                                <input type="hidden" value="<?= $data['sp_id']?>" name="txt_spid" id="txt_spid">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtHoTen">Tên sản phẩm:</label>
                                        <h4><?= $data['sp_ten']?></h4>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="hsp_tentaptin">Chọn hình sản phẩm</label>
                                        <input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
                                        <?php if(isset( $_SESSION["thongbao_hsp"])):?>
                                        <label for="txt_nhacnho" style="color: red;">  <?= $_SESSION["thongbao_hsp"]; ?></label>
                                        <?php session_unset(); ?>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row submit_formdangky">
                                <div class="col-md-12">
                                    <button type="submit" name="btnthem_hsp" id="btnthem_hsp" class="btn">Thêm hình sản
                                        phẩm</button>
                                       

                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="col-md-5">
                        <!-- -----------------hien thi hinh anh-------------------- -->
                        <div class="preview-img-container">
                            <img src="/Du_an_nien_luan/assets/img/Image_default.jpg" id="preview-img" />
                        </div>

                        <!-- -----------------hien thi hinh anh-------------------- -->
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <script>
        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tentaptin");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
        </script>

        <?php include_once(__DIR__.'/../../partials/footer.php'); ?>

        <?php include_once(__DIR__.'/../../scripts.php'); ?>
        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->


        <!-- file xu ly rang buoc du lieu phia client -->
        <script src="/Du_an_nien_luan/backend/pages/sanpham/them_sp.js"></script>


</body>

</html>