<?php
    include_once(__DIR__.'/../scripts.php'); 
    include_once(__DIR__.'/../styles.php'); 
    include_once(__DIR__.'/../../dbconnect.php'); 
      
?>

<link href="/Du_an_nien_luan/assets/partials/header_admin.css" type=" text/css" rel="stylesheet " />

<div class="row header ">
    <div class="col-md-4 search-button ">
        <form class="form-inline d-flex  form-sm active-white active-cyan-2 ml-auto justify-content-center">
            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <img src="/Du_an_nien_luan/assets/img/icon&logo/search-icon.png" alt="">
            </a>
          
        </form>

    </div>
    <div class="col-md-4 ">
        <div class="row">
            <div class="col-md-12 logo-header animate__animated animate__flipInX">
                <img src="/Du_an_nien_luan/assets/img/icon&logo/logo.PNG " class="animate__jello">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 user_khachhang " style="text-align: center;padding-top: 7px;">
                <?php if (isset($_SESSION["user"])):?>
                <?php
                    $sql="select * from thanhvien where tv_sdt =". $_SESSION["user"];
                    $result = mysqli_query($conn,$sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'tv_ten' => $row['tv_ten'],
                        );
                    }
                    ?>
                <?php foreach($data as $thanhvien): ?>
                <span style="color: #FACC2E; font-weight: bold;" ><?= $thanhvien['tv_ten']; ?> </span>
                <?php endforeach; ?>
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
                        <a href="/Du_an_nien_luan/index.php" tabindex="-1" data-target="#exampleModal">
                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                            <span> Trang chủ</span>
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
                    <a class="nav-link active item-navbar " href="/Du_an_nien_luan/backend/pages/index_admin.php ">Thống kê</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link item-navbar " href="/Du_an_nien_luan/backend/pages/donhang/ds_donhang.php">Đơn hàng</a>
                </li>
                <li class="nav-item sanpham-block ">
                    <a class="nav-link item-navbar " href="#">Quản lý</a>
                    <div class="sanpham-content ">
                        <div class="sanpham-level ">

                            <ul style="list-style-type:none; ">
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/sanpham/danhsach_sp.php">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/loaisanpham/danhsach_lsp.php">Danh sách loại sản phẩm</a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right " aria-hidden="true "></i>
                                    <a href="/Du_an_nien_luan/backend/pages/thuonghieu/danhsach_th.php">Danh sách thương hiệu</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link item-navbar " href="/Du_an_nien_luan/backend/pages/lienhe.php">Thành viên</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end navbar-header -->
<?php include_once(__DIR__.'/dangnhap_popup.php'); ?>