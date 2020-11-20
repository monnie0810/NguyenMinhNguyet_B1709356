<?php
 if (session_id() === '') {
    session_start();
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
                        <a href="#"> <span>Sửa sản phẩm</span> </a>
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
                        <!-- select su lieu  -->

                        <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sp_id = $_GET['sp_id'];
                $sql = <<<EOT
     SELECT sp.sp_id,sp.sp_ten,sp.sp_mausac,sp.sp_kichthuoc,sp.sp_giabandau,sp.sp_giaban,sp.sp_slkho, lsp.lsp_ten, th.th_ten, sp.sp_mota
    FROM sanpham sp 
    JOIN loaisanpham lsp ON lsp.lsp_id = sp.lsp_id
    JOIN thuonghieu th ON th.th_id = sp.th_id
    WHERE sp_id = $sp_id;
EOT;

                // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_mausac' => $row['sp_mausac'],
                        'sp_kichthuoc' => $row['sp_kichthuoc'],
                        'sp_slkho' => $row['sp_slkho'],
                        'sp_mota' => $row['sp_mota'],
                        'lsp_ten' => $row['lsp_ten'],
                        'th_ten' => $row['th_ten'],
                        'sp_giabandau' => number_format($row['sp_giabandau'], 0, ".", ",") . ' vnđ',
                        'sp_giaban' => number_format($row['sp_giaban'], 0, ".", ",") . ' vnđ',
                    );
                }
                ?>

                        <!-- form dang ky du lieu  -->
                        <form name="form_themsp" id="form_themsp" action="/Du_an_nien_luan/backend/pages/sanpham/xuly_suasp.php" method="POST">
                            <div class="row title_formdangky">
                                <div class="col-md-12">
                                    <h4>Cập nhật thông tin sản phẩm </h4>
                                </div>
                            </div>
                            <?php foreach($data as $sanpham): ?>
                            <div class="row body_formdangky">
                                <div class="col-md-6">
                                <input type="hidden" name="sp_id" id="sp_id" value="<?= $sanpham['sp_id'] ?>">
                                    <div class="form-group">
                                        <label for="txtHoTen">Tên sản phẩm:</label>
                                        <input type="text" class="form-control" name="txttensp" id="txttensp"
                                            aria-describedby="nameHelp" value="<?= $sanpham['sp_ten'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Màu sắc</label>
                                        <input type="text" class="form-control" name="txtmausp" id="txtmausp"
                                            aria-describedby="nameHelp" value="<?= $sanpham['sp_mausac'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Số lượng nhập kho</label>
                                        <input type="number" class="form-control" name="txtslnhap" id="txtslnhap"
                                            aria-describedby="nameHelp" value="<?= $sanpham['sp_slkho'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Kích thước</label>
                                        <input type="text" class="form-control" name="txtkichthuoc" id="txtkichthuoc"
                                            aria-describedby="nameHelp" value="<?= $sanpham['sp_kichthuoc'] ?>">
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
                                            <?php foreach($data as $thuonghieu): ?>
                                            <option value="<?=$thuonghieu['th_ten']?>">
                                                <?=$thuonghieu['th_ten']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Giá nhập sẩn phẩm:</label>
                                        <input type="number" class="form-control" name="txtgianhap" id="txtgianhap"
                                            aria-describedby="nameHelp" placeholder="<?= $sanpham['sp_giabandau'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Giá bán sẩn phẩm:</label>
                                        <input type="number" class="form-control" name="txtgiaban" id="txtgiaban"
                                            aria-describedby="nameHelp" placeholder="<?= $sanpham['sp_giaban'] ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="txtHoTen">Mô tả sản phẩm:</label>
                                        <textarea class="form-control" name="txtmotasp" id="txtmotasp" cols="30"
                                            rows="5" placeholder="<?= $sanpham['sp_mota'] ?>"></textarea>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                            </div>
                            <div class="row submit_formdangky">
                                <div class="col-md-12">
                                    <button type="submit" name="btnsuasp" id="btnsuasp" class="btn">Cập nhật sản
                                        phẩm</button>
                                </div>
                                
                            </div>
                            <div class="row ">
                                <div class="col-md-12" style="text-align: center;">
                                    <?php
                                    
                                    if(isset( $_SESSION["thongbaosp_sua"])){
                                        echo  $_SESSION["thongbaosp_sua"];
                                        session_unset();
                                    }
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