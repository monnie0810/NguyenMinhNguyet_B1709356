<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monnie Store - Liên hệ</title>
    <?php include_once(__DIR__.'/../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/lienhe.css" type="text/css " />

</head>

<body>
    <div class="container-fluid ">
        <?php include_once(__DIR__.'/../partials/header.php'); ?>
        <!-- Phan lien he  -->
        <!-- duong dan  -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="../HtmlFile/index.html"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="../HtmlFile/Lien_he.html"> <span>Liên hệ</span> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2"></div>

        </div>
        <!-- Phan lien he  -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 content_trang">
                <div class="row ">
                    <div class="col-md-4 ">
                        <div class="row">
                            <div class="col-md-12 content_Thongtin">
                                <h5>Liên hệ</h5>
                                <ul style="list-style-type: none;">
                                    <li>
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span> Tầng 8 Ladeco, 266 Đội Cấn, Hà Nội</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <span> <a href="tel:0123456789">0123456789</a> </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <span><a href="mailto:nmnguyetd20012@cusc.ctu.edu.vn
                                            "> nmnguyetd20012@cusc.ctu.edu.vn
                                            </a> </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 content_lienhe">
                                <h5>Đặt thắc mắc cho chúng tôi</h5>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Hoten" placeholder="Họ và Tên">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="sodienthoai"
                                            placeholder="Số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email"
                                            placeholder="name@example.com">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" id="cauhoi" rows="3"
                                            placeholder="Câu hỏi của bạn dành cho chúng tôi"></textarea>
                                    </div>
                                    <div class="form-group button_cauhoi">
                                        <button type="button" class="btn "><span>Gửi ngay</span> </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 nhung_bando">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9042744516196!2d105.81368901461404!3d21.036515885994135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab128b45bf23%3A0xd1d32b58169417cd!2zMjY2IMSQ4buZaSBD4bqlbiwgTGnhu4V1IEdpYWksIEJhIMSQw6xuaCwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1601606556619!5m2!1svi!2s"
                            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>


        <?php include_once(__DIR__.'/../partials/footer.php'); ?>

        <!-- form đăng nhập -->
        <?php include_once(__DIR__.'/../partials/dangnhap_popup.php'); ?>

        <!-- end form đăng nhập -->
        <!-- end form đăng nhập -->
        <?php include_once(__DIR__.'/../scripts.php'); ?>



</body>

</html>