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
    <title>Monnie Store - Thêm sản phẩm</title>
    <?php include_once(__DIR__.'/../../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/dangky.css" type="text/css " />

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
                        <a href="#"> <span>Thêm sản phẩm</span> </a>
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
                    <div class="col-md-12 dangky_form">
                        <!-- form dang ky du lieu  -->
                        <form name="form_themsp" id="form_themsp"
                            action="/Du_an_nien_luan/backend/pages/sanpham/xuly_themsp.php" method="POST">
                            <div class="row title_formdangky">
                                <div class="col-md-12">
                                    <h4>Nhập thông tin sản phẩm </h4>
                                </div>
                            </div>
                            <div class="row body_formdangky">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtHoTen">Tên sản phẩm:</label>
                                        <input type="text" class="form-control" name="txttensp" id="txttensp"
                                            aria-describedby="nameHelp" placeholder="Tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Màu sắc</label>
                                        <input type="text" class="form-control" name="txtmausp" id="txtmausp"
                                            aria-describedby="nameHelp" placeholder="Màu sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Số lượng nhập kho</label>
                                        <input type="number" class="form-control" name="txtslnhap" id="txtslnhap"
                                            aria-describedby="nameHelp" placeholder="Số lượng sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Kích thước</label>
                                        <input type="text" class="form-control" name="txtkichthuoc" id="txtkichthuoc"
                                            aria-describedby="nameHelp" placeholder="kích thước sản phẩm">
                                    </div>
                                    <!-- select loai san pham va thuong hieu -->
                                    <?php
                                    include_once(__DIR__.'/../../../dbconnect.php'); 
                                    $sql ="SELECT * FROM loaisanpham";
                                    $result = mysqli_query($conn, $sql);
                                    $data=[];
                                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                        $data[] = array (
                                            'lsp_id' => $row['lsp_id'],
                                            'lsp_ten' => $row['lsp_ten'],

                                        );
                                    }
                                      ?>
                                    <div class="form-group">
                                        <label for="txtHoTen">Loại sản phẩm</label>
                                        <select class="form-control" id="txtlsp" name="txtlsp">
                                            <?php foreach($data as $loaisanpham): ?>
                                            <option value="<?=$loaisanpham['lsp_ten']?>">
                                                <?=$loaisanpham['lsp_ten']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    include_once(__DIR__.'/../../../dbconnect.php'); 
                                    $sql ="SELECT * FROM thuonghieu";
                                    $result = mysqli_query($conn, $sql);
                                    $data=[];
                                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                        $data[] = array (
                                            'th_id' => $row['th_id'],
                                            'th_ten' => $row['th_ten'],

                                        );
                                    }
                                      ?>
                                    <div class="form-group">
                                        <label for="txtHoTen">Loại sản phẩm</label>
                                        <select class="form-control" id="txtthuonghieu" name="txtthuonghieu">
                                            <?php foreach($data as $loaisanpham): ?>
                                            <option value="<?=$loaisanpham['th_ten']?>">
                                                <?=$loaisanpham['th_ten']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Giá nhập sẩn phẩm:</label>
                                        <input type="number" class="form-control" name="txtgianhap" id="txtgianhap"
                                            aria-describedby="nameHelp" placeholder="Giá nhập sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Giá bán sẩn phẩm:</label>
                                        <input type="number" class="form-control" name="txtgiaban" id="txtgiaban"
                                            aria-describedby="nameHelp" placeholder="Giá bán sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Mô tả sản phẩm:</label>
                                        <textarea class="form-control" name="txtmotasp" id="txtmotasp" cols="30"
                                            rows="5" placeholder="Mô tả sản phẩm"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                            </div>
                            <div class="row submit_formdangky">
                                <div class="col-md-12">
                                    <button type="submit" name="btnthemsp" id="btnthemsp" class="btn">Thêm sản
                                        phẩm</button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12" style="text-align: center;">
                                    <?php
                                    
                                    // if(isset( $_SESSION["thongbao"])){
                                    //     echo  $_SESSION["thongbao"];
                                    //     session_unset();
                                    // }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <?php include_once(__DIR__.'/../../partials/footer.php'); ?>

        <?php include_once(__DIR__.'/../../scripts.php'); ?>
 <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  

        <!-- file xu ly rang buoc du lieu phia client -->
        <script src="/Du_an_nien_luan/backend/pages/sanpham/them_sp.js"></script>


</body>

</html>