<?php
if (session_id() === '') {
  session_start();
}
if(!isset($_SESSION['user'])){
    header("location: /Du_an_nien_luan/index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonStore - Đơn hàng</title>


    <?php include_once(__DIR__.'/../../styles.php'); ?>

    <!-- DataTable CSS -->
    <link href="/Du_an_nien_luan/assets/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet" />
    <link href="/Du_an_nien_luan/assets/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css"
        type="text/css" rel="stylesheet" />
    <style>
    .content_lsp {
        width: 100%;
        margin: auto;
        text-align: center;
    }

    .content_pages {
        margin: auto;
    }

    .tables_div {
        margin: auto;
    }

    .dataTables_length {
        width: 50%;
        float: left;
        margin-top: 20px;
    }

    .dataTables_filter {
        width: 50%;
        float: left;
        margin-top: 20px;
    }

    .user_khachhang span {
        color: #FACC2E;
        font-weight: bold;
    }

    .user_khachhang {
        text-align: center;
        padding-top: 7px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <div class="container-fluid">
        <!-- start navbar-header -->
        <?php include_once(__DIR__.'/../../partials/header.php'); ?>
        <!-- end navbar-header -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="/Du_an_nien_luan/backend/index.php"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="#"> <span>Chi tiết đơn hàng</span> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2"></div>

        </div>
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-8 ">
                <main role="main" class=" ml-sm-auto px-4 mb-2  content_lsp">
                    <!-- Block content -->
                    <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $i=1;
                    $hoadon = $_GET['hd_id'];
                    $sql_hoadon = "SELECT  * FROM hoadon where hd_id=".$hoadon;
                    $result = mysqli_query($conn, $sql_hoadon);
                    while ($row_hoadon = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $hoadon_thongtin = array(
                            'hd_id' => $row_hoadon['hd_id'],
                            'hd_ngaylap' => $row_hoadon['hd_ngaylap'],
                            'hd_trangthai' => $row_hoadon['hd_trangthai'],
                            'hd_tongtien' => $row_hoadon['hd_tongtien'],
                           
                        );
                    }
                   
                    $sql_hd = "SELECT * FROM hoadon_chitiet hdct JOIN sanpham sp ON sp.sp_id = hdct.sp_id WHERE hd_id =".$hoadon;
                    $result_hd = mysqli_query($conn, $sql_hd);
                    $hoadon_ct = [];
                    while ($row_hd = mysqli_fetch_array($result_hd, MYSQLI_ASSOC)) {
                        $hoadon_ct[] = array(
                            'sp_id' => $row_hd['sp_id'],
                            'sp_ten' => $row_hd['sp_ten'],
                            'sp_mausac' => $row_hd['sp_mausac'],
                            'sp_kichthuoc' => $row_hd['sp_kichthuoc'],
                            'sp_giaban' => $row_hd['sp_giaban'],
                            'hd_slsp' => $row_hd['hd_slsp'],
                        );
                    }
                   
                    ?>
                    <div
                        class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
                        <h1 class="h2">Chi tiết đơn hàng</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="donhang_user.php" class="btn btn-warning">
                                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                                Danh sách đơn hàng
                            </a>
                            <a href="/Du_an_nien_luan/backend/pages/donhang/xoa_donhang.php?hd_id=<?= $hoadon_thongtin['hd_id'] ?>"
                                class="btn btn-danger"> <i class="fa fa-ban" aria-hidden="true"></i>
                                Hủy
                            </a>
                        </div>
                        <div class="col-md-6">
                            <ul style="list-style-type: none; padding-left: 0px; margin: 0px">
                                <li>
                                    <p>Ngày đặt: <?=$hoadon_thongtin['hd_ngaylap']?></p>
                                </li>
                                <?php if($hoadon_thongtin['hd_trangthai'] == 0) :?>
                                <li> Trạng thái: đã đặt hàng</p>
                                </li>
                                <?php else: ?>
                                <li> Trạng thái: đã giao hàng</p>
                                    <?php endif;?>
                            </ul>
                        </div>



                    </div>

                    <div class="row content_pages">
                        <div class="tables_div">
                            <table id="tblDanhSach_sp"
                                class="table table-hover table-sm table-responsive mt-5 trangchu_pages">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình</th>
                                        <th>Tên SP</th>
                                        <th>Màu</th>
                                        <th>Kích thước</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Thành tiền</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hoadon_ct as $dondathang) : ?>

                                    <?php
                                             $sql = "SELECT  MAX(hsp_id), hsp_ten FROM hinhsanpham WHERE sp_id=".$dondathang['sp_id'];
                                             $result = mysqli_query($conn, $sql);
                                             while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                 $hinhsanpham = array(
                                                     'hsp_ten' => $row['hsp_ten'],
                                                    //  'hsp_id' => $row['hsp_id'],
                                                 );
                                             }
                                        ?>
                                    <tr>
                                        <td><?php echo $i; $i++ ?></td>
                                        <td>
                                            <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $hinhsanpham['hsp_ten'] ?>"
                                                class="img-fluid" width="100px" />
                                        </td>
                                        <td><?= $dondathang['sp_ten'] ?></td>
                                        <td><?= $dondathang['sp_mausac'] ?></td>
                                        <td><?= $dondathang['sp_kichthuoc'] ?></td>
                                        <td><?= $dondathang['hd_slsp'] ?></td>
                                        <td> <?=number_format($dondathang['sp_giaban'], 0, ".", ",")?> vnđ</td>
                                        <td>
                                            <?=number_format($dondathang['hd_slsp'] * $dondathang['sp_giaban'], 0, ".", ",")?>
                                            vnđ
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="10" style="font-size: 20px;">
                                            <span style="font-weight: bold">Tổng tiền: </span>
                                            <?=number_format($hoadon_thongtin['hd_tongtien'], 0, ".", ",")?> vnđ
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End block content -->
                </main>
            </div>
            <div class="col-md-2"></div>
        </div>
        <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>
    </div>

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- DataTable JS -->
    <script src="/Du_an_nien_luan/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/Du_an_nien_luan/assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/Du_an_nien_luan/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/Du_an_nien_luan/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>

    <!-- SweetAlert -->
    <script src="/Du_an_nien_luan/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tblDanhSach').DataTable({
            dom: 'Blfrtip',
            buttons: [

            ]
        });


    });
    </script>


</body>

</html>