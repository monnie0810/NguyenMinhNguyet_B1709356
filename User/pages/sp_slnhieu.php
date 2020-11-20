<?php 
// if(!isset($_SESSION['user'])){
//     header("location: /Du_an_nien_luan/index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monnie Store - Sản phẩm còn nhiều</title>
    <?php include_once(__DIR__.'/../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/index.css" type="text/css " />
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/tatcasanpham.css" type="text/css " />
    <link href="/Du_an_nien_luan/assets/partials/header.css" type=" text/css" rel="stylesheet " />

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
        <?php include_once(__DIR__.'/../partials/header.php'); ?>
        <!-- end navbar-header -->
        <!-- duong dan  -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="/Du_an_nien_luan/index.php"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="#"> <span>Sản phẩm còn nhiều</span> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2"></div>

        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" id="app">
                <div class="row ">
                    <div class="col-md-2 boloc_sanpham">
                        <div class="row" style=" margin-right: 20px;">
                            <div class="col-md-12 loc_giasanpham">
                                <div class="tiltle_boloc ">
                                    <h4>Thương hiệu</h4>
                                </div>
                                <?php
                                include_once(__DIR__ . '/../../dbconnect.php');
                                $sql_th="SELECT * FROM thuonghieu  ";
                                $result_th = mysqli_query($conn, $sql_th);
                                $data_th = [];
                                while ($row_th = mysqli_fetch_array($result_th, MYSQLI_ASSOC)) {
                                    $data_th[] = array(
                                        'th_id' => $row_th['th_id'],
                                        'th_ten' => $row_th['th_ten'],  
                                    );
                                }
                               ?>
                                <?php foreach($data_th as $thuonghieu): ?>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" value="<?=$thuonghieu['th_id']?>">
                                    </div>
                                    <span><?=$thuonghieu['th_ten']?></span>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="row " style=" margin-right: 20px;">
                            <div class="col-md-12 loc_giasanpham">
                                <div class="tiltle_boloc ">
                                    <h4>Giá sản phẩm</h4>
                                </div>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </div>
                                    <span>Dưới 100.000vnd</span>
                                </div>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </div>
                                    <span>100.000 - 200.000vnd</span>
                                </div>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </div>
                                    <span>200.000 - 300.000vnd</span>
                                </div>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </div>
                                    <span>300.000 - 500.000vnd</span>
                                </div>
                                <div class="input-group mb-3 content_loc">
                                    <div class="">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </div>
                                    <span>trên 500.000vnd</span>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="col-md-10" style="margin-bottom: 280px;">
                        <!-- Mục bán chạy -->
                        <div class="row card_sanpham">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-6 title_cardsp">
                                        <span>Sản phẩm còn nhiều</span>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">

                                    </div>

                                </div>
                                <!-- -------------------------------------------------------------- -->
                                <?php
                                include_once(__DIR__ . '/../../dbconnect.php');
                                $page = $_GET['page'];
                              
                                $start = $page*8 -8;
                               
                                $sql_re="SELECT * FROM sanpham  ORDER BY sp_slkho DESC  LIMIT ". $start." , 8";
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
                                                    <a href="/Du_an_nien_luan/backend/pages/chitiet_sanpham.php?sp_id=<?=$sanpham_re['sp_id']?>">
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

                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item" style="color: orange;">
                            <?php if ($page == 1): ?>
                            <a class="page-link" href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=<?=$page;?>"
                                tabindex="-1" style="color: #FF4000;">Previous</a>
                            <?php else: ?>
                            <a class="page-link"
                                href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=<?=$page-1;?>" tabindex="-1"
                                style="color: #FF4000;">Previous</a>
                            <?php endif; ?>
                        </li>

                        <?php
                            include_once(__DIR__ . '/../../dbconnect.php');
                            $sql_page="SELECT * FROM sanpham ";
                            $result_page = mysqli_query($conn, $sql_page);
                            $result_page_1 = mysqli_num_rows($result_page);
                            $page_sl = (int)($result_page_1 / 8) +1;
                        ?>
                        <?php for($i=1;$i<=$page_sl;$i++): ?>
                        <li class="page-item">
                            <a class="page-link" href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=<?=$i;?>"
                                style="color: #FF4000;"> <?=$i;?> </a>
                        </li>
                        <?php endfor; ?>


                        <li class="page-item">
                            <?php if ($page == $page_sl): ?>
                            <a class="page-link" href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=<?=$page;?>"
                                style="color: #FF4000;">Next</a>
                            <?php else: ?>
                            <a class="page-link" href="/Du_an_nien_luan/backend/pages/sp_slnhieu.php?page=<?=$page + 1;?>"
                                style="color: #FF4000;">Next</a>
                            <?php endif; ?>
                        </li>
                        <?php unset($page) ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-1"></div>

        </div>

        <!-- start footer  -->
        <?php include_once(__DIR__.'/../partials/footer.php'); ?>
        <!-- end footer  -->

    </div>


    <!-- end slider home -->
    <?php include_once(__DIR__.'/../scripts.php'); ?>

    <!-- form đăng nhập -->
    <?php include_once(__DIR__.'/../partials/dangnhap_popup.php'); ?>
    <!-- end form đăng nhập -->
    <!-- ràng buộc phía client cho form đăng nhập  -->

    <!-- end ràng buột đang nhập  -->


</body>

</html>