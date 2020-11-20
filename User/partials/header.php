<?php
     
    include_once(__DIR__.'/../scripts.php'); 
    include_once(__DIR__.'/../styles.php'); 
    include_once(__DIR__.'/../../dbconnect.php'); 
        if(!isset($_SESSION)) { 
            session_start(); 
        } 
   
        
?>

<link href="/Du_an_nien_luan/assets/partials/header.css" type=" text/css" rel="stylesheet " />

<div class="row header ">
    <div class="col-md-4 search-button mx-auto">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
               
            </div>

        </div>
    </div>
    <div class="col-md-4 ">
        <div class="row">
            <div class="col-md-12 logo-header animate__animated animate__flipInX">
                <img src="/Du_an_nien_luan/assets/img/icon&logo/logo.PNG " class="animate__jello">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 user_khachhang">
                <?php if (isset($_SESSION["user"])):?>
                <?php
                    $sql="select * from thanhvien where tv_sdt =". $_SESSION["user"];
                    $result = mysqli_query($conn,$sql);  
                    while ($row_ten = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $tentv = array(
                            'tv_ten' => $row_ten['tv_ten'],
                        );
                    }
                    ?>
                <span><?= $tentv['tv_ten']; ?> </span>
                <?php endif; ?>


            </div>
        </div>
    </div>
    <div class="col-md-4 header-icon ">
        <div class="row ">
            <div class="col-md-12 icon-button ">

                <div class="row justify-content-center">
                    <!-- ------------------------------------------------------- -->
                    <?php if (isset($_SESSION["user"])):?>
                    <div class="col-md-6 danhnhap-button">
                        <a href="/Du_an_nien_luan/backend/pages/giohang/giohang.php" tabindex="-1"
                            data-target="#exampleModal">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <span>giỏ hàng</span>
                        </a>
                    </div>
                    <div class="col-md-6 giohang-button ">
                        <a href="/Du_an_nien_luan/assets/backend/dangxuat.php">
                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                            <span> Đăng xuất</span>
                        </a>
                    </div>
                    <?php else : ?>
                    <!-- ------------------------------------------------------- -->
                    <div class="col-md-6 danhnhap-button">
                        <a href="#" tabindex="-1" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            <span>Đăng nhập </span>
                        </a>
                    </div>
                    <div class="col-md-6 giohang-button ">
                        <a href="/Du_an_nien_luan/backend/pages/dangky.php">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <span> Đăng ký</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    <!-- ------------------------------------------ -->

                </div>
            </div>

        </div>
    </div>
</div>
<!-- start navbar-header -->
<div class="sticky-top">
    <div class="row navbar-header ">
        <div class="col-md-12">
            <ul class="nav justify-content-center ">
                <li class="navbar-header ">
                    <a class="nav-link active item-navbar " href="/Du_an_nien_luan/index.php ">Trang chủ</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link item-navbar " href="/Du_an_nien_luan/backend/pages/gioithieu.php">Giới thiệu</a>
                </li>
                <li class="nav-item sanpham-block ">
                    <a class="nav-link item-navbar " href="/Du_an_nien_luan/backend/pages/tatcasanpham.php?page=1">Tất
                        cả sản phẩm</a>
                    <div class="sanpham-content ">
                        <div class="sanpham-level ">

                            <ul style="list-style-type:none; ">
                                <h6>DANH MỤC SẢN PHẨM</h6>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_new.php?page=1"> Sản phẩm mới</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=1">Sản phẩm còn
                                        nhiều</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_slit.php?page=1"> Sản phẩm còn ít</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sanpham-level ">
                            <ul style="list-style-type:none; ">
                                <h6>DANH MỤC SẢN PHẨM</h6>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_caocap.php?page=1"> Sản phẩm cao cấp</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_giare.php?page=1">Sản phẩm giá rẻ</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_slit.php?page=1"> Sản phẩm bán chạy</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sanpham-level ">
                            <ul style="list-style-type:none; ">
                                <h6>DANH MỤC SẢN PHẨM</h6>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_new.php?page=1"> Sản phẩm mới</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=1">Sản phẩm còn
                                        nhiều</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sp_slit.php?page=1"> Sản phẩm còn ít</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                </li>
                <li class="nav-item ">
                    <a class="nav-link item-navbar " href="/Du_an_nien_luan/backend/pages/lienhe.php">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end navbar-header -->