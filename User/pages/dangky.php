<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monnie Store - Đăng ký</title>
    <?php include_once(__DIR__.'/../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/dangky.css" type="text/css " />

</head>

<body>
    <div class="container-fluid ">
        <?php include_once(__DIR__.'/../partials/header.php'); ?>


        <!-- duong dan  -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="../HtmlFile/index.html"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="../HtmlFile/dang_ky.html"> <span>Đăng ký tài khoản</span> </a>
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
                    <div class="col-md-4 dangky_gioithieu">
                        <img src="/Du_an_nien_luan/assets/img/icon&logo/dangky_image.png" alt="Lỗi tải ảnh">
                        <div class="content_gioithieu">
                            <strong>QUYỀN LỢI THÀNH VIÊN</strong>
                            <ul style="list-style-type: none;">
                                <li>
                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                    <span>Mua hàng khắp thế giới cực dễ dàng, nhanh chóng</span>
                                </li>
                                <li>
                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                    <span>Theo dõi chi tiết đơn hàng, địa chỉ thanh toán dễ dàng</span>
                                </li>
                                <li>
                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                    <span>Nhận nhiều chương trình ưu đãi hấp dẫn từ chúng tôi</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 dangky_form">
                        <!-- form dang ky du lieu  -->

                        <form name="form_dangky" id="form_dangky" action="/Du_an_nien_luan/assets/backend/dangky.php" method="POST">
                            <div class="row title_formdangky">
                                <div class="col-md-12">
                                    <h4>Nhập thông tin đăng ký </h4>
                                </div>
                            </div>
                            <div class="row body_formdangky">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtHoTen">Họ và Tên:</label>
                                        <input type="text" oninput="checkForm()" class="form-control" name="txtHoTen"
                                            id="txtHoTen" aria-describedby="nameHelp" placeholder="Nhập họ tên">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtngaysinh">Ngày sinh:</label>
                                        <input type="date" class="form-control" name="txtngaysinh" id="txtngaysinh"
                                            placeholder=" Nhập ngày sinh">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtgioitinh">Giới tính:</label>
                                        <div class="form-gioitinh">
                                            <input type="radio" name="txtgioitinh" id="txtgioitinh" value="nam"
                                                checked><span>Nam</span>
                                            <input type="radio" name="txtgioitinh" id="txtgioitinh"
                                                value="nu"><span>Nữ</span>
                                            <input type="radio" name="txtgioitinh" id="txtgioitinh"
                                                value="khac"><span>Khác</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtEmail">Email:</label>
                                        <input type="email" class="form-control" name="txtEmail" id="txtEmail"
                                            placeholder="Nhập email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtsodienthoai">Số điện thoại:</label>
                                        <input type="tel" class="form-control" name="txtsodienthoai" id="txtsodienthoai"
                                            placeholder=" Nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtdiachi">Địa chỉ:</label>
                                        <input type="text" class="form-control" name="txtdiachi" id="txtdiachi"
                                            placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtmatkhau">Mật khẩu</label>
                                        <input type="password" class="form-control" name="txtmatkhau" id="txtmatkhau"
                                            placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtnhaplaimatkhau">Nhập lại mật khẩu </label>
                                        <input type="password" class="form-control" name="txtnhaplaimatkhau"
                                            id="txtnhaplaimatkhau" placeholder="Nhập lại mật khẩu ">
                                    </div>
                                </div>
                            </div>
                            <div class="row submit_formdangky">
                                <div class="col-md-12">
                                    <button type="submit" name="btndangky" id="btndangky" class="btn">Đăng ký</button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <?php
                                    if(isset( $_SESSION["thongbaodk"])){
                                        echo  $_SESSION["thongbaodk"];
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

        <?php include_once(__DIR__.'/../partials/footer.php'); ?>




        <?php include_once(__DIR__.'/../partials/dangnhap_popup.php'); ?>

        <?php include_once(__DIR__.'/../scripts.php'); ?>


        <!-- file xu ly rang buoc du lieu phia client -->
        <script src="/Du_an_nien_luan/assets/script/dangky.js"></script>


</body>

</html>