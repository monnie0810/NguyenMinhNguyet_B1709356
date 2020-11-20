<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Store - Trang chủ</title>
    <?php include_once(__DIR__.'/backend/styles.php'); ?>
    <link rel="stylesheet" href="/NguyenMinhNguyet_B1709356/User/assets/pages/index.css" type="text/css " />
    <link href="/NguyenMinhNguyet_B1709356/User/assets/pages/header.css" type=" text/css" rel="stylesheet " />
    <style>
    .user_khachhang span {
        color: #FACC2E;
        font-weight: bold;
    }

    .user_khachhang {
        text-align: center;
        padding-top: 7px;
    }

    .xemthem_sp a {
        font-size: 15px;
        color: #6E6E6E;
        /* #FA8258; */
        vertical-align: middle;

    }
    </style>
</head>

<body>
    <div class="container-fluid ">
        <!-- start navbar-header -->
        <?php include_once(__DIR__.'/User/partials/header.php'); ?>
        <!-- end navbar-header -->

        <!-- slider anh home -->
        <?php include_once(__DIR__.'/User/partials/hinh_index.php'); ?>

        <!-- danh mục sản phẩm -->
        <div class="row ">
            <div class="col-md-2 ">

            </div>
            <div class="col-md-8 ">
                <!--start gioi thieu chinh sach -->
                <?php include_once(__DIR__.'/User/partials/hotro.php'); ?>
                <!--start gioi thieu chinh sach -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 title_danhmuc">
                                <span>SẢN PHẨM BÁN CHẠY</span> <br>
                                <img src="/NguyenMinhNguyet_B1709356/User/assets/img/icon&logo/icon_product.PNG" alt="">

                            </div>
                        </div>
                        <div class="row danhmuc_sp">
                            <div class="col-md-6 danhmuc_col1">
                                <div class="img_col">
                                    <a href="/Du_an_nien_luan/backend/pages/sp_new.php?page=1">
                                        <img src="/NguyenMinhNguyet_B1709356/User/assets/img/icon&logo/banner_col_2.jpg" alt="">
                                        <Span>Hàng mới</Span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 danhmuc_col1">
                                        <div class="img_col">
                                            <a href="/Du_an_nien_luan/backend/pages/sp_caocap.php?page=1">
                                                <img src="/Du_an_nien_luan/assets/img/icon&logo/banner_col_3.jpg"
                                                    alt="">
                                                <Span>Cao cấp</Span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row ">
                                            <div class="col-md-12 danhmuc_col2">
                                                <a href="/Du_an_nien_luan/backend/pages/sp_slit.php?page=1">
                                                    <img src="/Du_an_nien_luan/assets/img/icon&logo/banner_col_4.jpg"
                                                        alt="">
                                                    <Span>Bán chạy</Span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 danhmuc_col3">
                                                <a href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=1">
                                                    <img src="/Du_an_nien_luan/assets/img/icon&logo/banner_col_1.jpg"
                                                        alt="">
                                                    <Span>Còn nhiều</Span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tuan deal hot  -->
                <div class="row card_sanpham">
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-md-6 title_cardsp">
                                <span>HÀNG MỚI VỀ</span>
                            </div>
                            <div class="col-md-4 xemthem_cardsp">
                                <a href="">Xem thêm sản phẩm >></a>
                            </div>
                            <div class="col-md-2">
                                <div class="thanhngang"></div>
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------- -->
                        <?php
                         include_once(__DIR__ . '/dbconnect.php');
                         $sql="SELECT * FROM sanpham  ORDER BY sp_id DESC LIMIT 4";
                         $result = mysqli_query($conn, $sql);
                         $data = [];
                         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                             $data[] = array(
                                 'sp_id' => $row['sp_id'],
                                 'sp_ten' => $row['sp_ten'],  
                                 'sp_giaban' => number_format($row['sp_giaban'], 0, ".", ",") . ' vnđ',
                             );
                         }
                        ?>

                        <!-- -------------hien thi san pham----------------------- -->
                        <div class="row row-cols-1 row-cols-md-4 row_sanpham">
                            <?php foreach($data as $sanpham):?>
                            <?php
                                //  include_once(__DIR__ . '/dbconnect.php');
                                 $sql_hsp="SELECT MAX(hsp_id), hsp_ten FROM hinhsanpham hsp WHERE sp_id =".$sanpham['sp_id'];
                                 $result_hsp = mysqli_query($conn, $sql_hsp);
                                 
                                 while ($row1 = mysqli_fetch_array($result_hsp, MYSQLI_ASSOC)) {
                                     $hinhsanpham = array(
                                        //  'hsp_id' => $row1['hsp_id'],
                                         'hsp_ten' => $row1['hsp_ten'],                                        
                                     );
                                 }
                            ?>
                            <div class="card h-80 shadow-sm card-fa card-body ele-card">
                                <div class="div_img_card">
                                    <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $hinhsanpham['hsp_ten'] ?>"
                                        class="card-img-top news-item-img image-card"
                                        style=" height: 300px; width: 240px;">
                                    <div class="overlay">
                                        <!-- <div class="icon_thanhtoan">
                                            <a href="">
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </a>
                                        </div> -->
                                        <div class="icon_xemthem">
                                            <a
                                                href="/Du_an_nien_luan/backend/pages/chitiet_sanpham.php?sp_id=<?=$sanpham['sp_id']?>">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i> </a>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bodyCard">
                                    <h5 class="card-title text-center"><?=$sanpham['sp_ten']?></h5>
                                    <p class="card-text"><?=$sanpham['sp_giaban']?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- ------------------------- -->

                        </div>
                        <!-- --------------------------------------- -->

                    </div>
                </div>


            </div>
            <div class="col-md-2 ">

            </div>
        </div>

        <div class="row giamgiasau_area">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <!-- giam gia sau -->
                <div class="row row_giamgiasau">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 title_danhmuc">
                                <span>GIÁ RẺ CỦA SHOP</span> <br>
                                <div class="row giamgiasau_icon ">
                                    <div class="col-md-12">
                                        <i style="margin-right: 5px;" class="fa fa-angle-left" aria-hidden="true"></i>
                                        <span class="xemthem_sp"><a href="">Xem thêm sản phẩm</a></span>

                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- -------------------------------------------------------------- -->
                        <?php
                         include_once(__DIR__ . '/dbconnect.php');
                         $sql_re="SELECT * FROM sanpham  ORDER BY sp_giaban ASC  LIMIT 4";
                         $result_re = mysqli_query($conn, $sql_re);
                         $data_re = [];
                         while ($row_re = mysqli_fetch_array($result_re, MYSQLI_ASSOC)) {
                             $data_re[] = array(
                                 'sp_id' => $row_re['sp_id'],
                                 'sp_ten' => $row_re['sp_ten'],  
                                 'sp_giaban' => number_format($row_re['sp_giaban'], 0, ".", ",") . ' vnđ',
                             );
                         }
                        ?>

                        <!-- -------------hien thi san pham----------------------- -->
                        <div class="row row-cols-1 row-cols-md-4 row_sanpham">
                            <?php foreach($data_re as $sanpham_re):?>
                            <?php
                                //  include_once(__DIR__ . '/dbconnect.php');
                                 $sql_hspre="SELECT MAX(hsp_id), hsp_ten FROM hinhsanpham hsp WHERE sp_id =".$sanpham_re['sp_id'];
                                 $result_hspre = mysqli_query($conn, $sql_hspre);
                                 
                                 while ($row_hspre = mysqli_fetch_array($result_hspre, MYSQLI_ASSOC)) {
                                     $hinhsanpham_re = array(
                                        //  'hsp_id' => $row1['hsp_id'],
                                         'hsp_ten' => $row_hspre['hsp_ten'],                                        
                                     );
                                 }
                            ?>
                            <div class="card h-80 shadow-sm card-fa card-body ele-card">
                                <div class="div_img_card">
                                    <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $hinhsanpham_re['hsp_ten'] ?>"
                                        class="card-img-top news-item-img image-card"
                                        style=" height: 300px; width: 240px; padding: 10px 0px 0px 10px;">
                                    <div class="overlay">
                                        <!-- <div class="icon_thanhtoan">
                                            <a href="">
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </a>
                                        </div> -->
                                        <div class="icon_xemthem">
                                            <a
                                                href="/Du_an_nien_luan/backend/pages/chitiet_sanpham.php?sp_id=<?=$sanpham_re['sp_id']?>">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i> </a>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bodyCard">
                                    <h5 class="card-title text-center"><?=$sanpham_re['sp_ten']?></h5>
                                    <p class="card-text"><?=$sanpham_re['sp_giaban']?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- ------------------------- -->

                        </div>
                        <!-- --------------------------------------- -->

                    </div>

                </div>
            </div>
            <div class="col-md-2"></div>

        </div>
        <!-- Danh muc noi bat -->
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <!-- Mục bán chạy -->
                <div class="row card_sanpham">
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-md-6 title_cardsp">
                                <span>HÀNG CAO CẤP</span>
                            </div>
                            <div class="col-md-4 xemthem_cardsp">
                                <a href="#">Xem thêm sản phẩm >></a>
                            </div>
                            <div class="col-md-2">
                                <div class="thanhngang"></div>
                            </div>
                        </div>

                        <!-- -------------------------------------------------------------- -->
                        <?php
                         include_once(__DIR__ . '/dbconnect.php');
                         $sql_cc="SELECT * FROM sanpham  ORDER BY sp_giaban DESC  LIMIT 4";
                         $result_cc = mysqli_query($conn, $sql_cc);
                         $data_cc = [];
                         while ($row_cc = mysqli_fetch_array($result_cc, MYSQLI_ASSOC)) {
                             $data_cc[] = array(
                                 'sp_id' => $row_cc['sp_id'],
                                 'sp_ten' => $row_cc['sp_ten'],  
                                 'sp_giaban' => number_format($row_cc['sp_giaban'], 0, ".", ",") . ' vnđ',
                             );
                         }
                        ?>

                        <!-- -------------hien thi san pham----------------------- -->
                        <div class="row row-cols-1 row-cols-md-4 row_sanpham">
                            <?php foreach($data_cc as $sanpham_cc):?>
                            <?php
                                //  include_once(__DIR__ . '/dbconnect.php');
                                 $sql_hspcc="SELECT MAX(hsp_id), hsp_ten FROM hinhsanpham hsp WHERE sp_id =".$sanpham_cc['sp_id'];
                                 $result_hspcc = mysqli_query($conn, $sql_hspcc);
                                 
                                 while ($row1_cc = mysqli_fetch_array($result_hspcc, MYSQLI_ASSOC)) {
                                     $hinhsanpham_cc = array(
                                        //  'hsp_id' => $row1['hsp_id'],
                                         'hsp_ten' => $row1_cc['hsp_ten'],                                        
                                     );
                                 }
                            ?>
                            <div class="card h-80 shadow-sm card-fa card-body ele-card">
                                <div class="div_img_card">
                                    <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $hinhsanpham_cc['hsp_ten'] ?>"
                                        class="card-img-top news-item-img image-card"
                                        style=" height: 300px; width: 240px; padding: 10px 0px 0px 10px;">
                                    <div class="overlay">
                                        <!-- <div class="icon_thanhtoan">
                                            <a href="">
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </a>
                                        </div> -->
                                        <div class="icon_xemthem">
                                            <a
                                                href="/Du_an_nien_luan/backend/pages/chitiet_sanpham.php?sp_id=<?=$sanpham_cc['sp_id']?>">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i> </a>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bodyCard">
                                    <h5 class="card-title text-center"><?=$sanpham_cc['sp_ten']?></h5>
                                    <p class="card-text"><?=$sanpham_cc['sp_giaban']?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- ------------------------- -->

                        </div>
                        <!-- --------------------------------------- -->
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <!-- start khu vuc quang cao  -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row quangcao_area">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 title_danhmuc">
                                <span>TIN TỨC</span> <br>
                                <div class="row giamgiasau_icon ">
                                    <div class="col-md-12">
                                        <a href="" style="margin-right: 46px;">
                                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php include_once(__DIR__.'/backend/partials/quangcao.php'); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <!-- end khu vuc quang cao  -->
        <!-- start footer  -->
        <?php include_once(__DIR__.'/backend/partials/footer.php'); ?>
        <!-- end footer  -->



    </div>


    <!-- end slider home -->
    <?php include_once(__DIR__.'/backend/scripts.php'); ?>

    <!-- form đăng nhập -->
    <?php include_once(__DIR__.'/backend/partials/dangnhap_popup.php'); ?>
    <!-- end form đăng nhập -->
    <!-- ràng buộc phía client cho form đăng nhập  -->

    <!-- end ràng buột đang nhập  -->


</body>

</html>