<?php
if (session_id() === '') {
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: /Du_an_nien_luan/index.php");
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonStore - Giỏ hàng</title>


    <?php include_once(__DIR__.'/../../styles.php'); ?>

    <!-- DataTable CSS -->
    <link href="/Du_an_nien_luan/assets/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet" />
    <link href="/Du_an_nien_luan/assets/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css"
        type="text/css" rel="stylesheet" />
    <style>
    .hinhdaidien {
        width: 100px;
        height: 100px;
    }

    .content_lsp {
        width: 100%;
        margin: auto;
        text-align: center;
    }

    .content_pages {

        margin-top: 30px;
    }

    .tables_div {
        margin: auto;
    }

    .table_giohang td {
        vertical-align: middle;
    }
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
                        <a href="/Du_an_nien_luan/backend/pages/index_admin.php"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="#"> <span>Giỏ hàng</span> </a>
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
                    $tongtien = 0;
                    $giohangdata = [];
                    if (isset($_SESSION['giohangdata'])) {
                        $giohangdata = $_SESSION['giohangdata'];
                    } else {
                        $giohangdata = [];
                    }
                    ?>
                    <div
                        class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
                        <h1 class="h2"> Danh sách giỏ hàng</h1>
                    </div>
                    <!-- Vùng ALERT hiển thị thông báo -->
                    <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                        <div id="thongbao">&nbsp;</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
                    <a href="/Du_an_nien_luan/backend/pages/giohang/donhang_user.php" class="btn btn-info btn-md">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    Đơn hàng
                </a>
                    <a href="/Du_an_nien_luan/backend/pages/donhang/xuly_donhang.php" class="btn btn-success btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Đặt hàng</a>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12" style="color: red; font-weight:bold;font-size:20px;">
                                <?php
                                if(isset($_SESSION['thongbao_giohang'])){
                                    echo $_SESSION['thongbao_giohang'];
                                    unset($_SESSION['thongbao_giohang']);
                                }
                                ?>
                            </div>
                        </div>

                    <div class="row content_pages">
                        <div class="tables_div">
                            <table id="tblGioHang" class="table table-bordered table_giohang">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu</th>
                                        <th>kích thước</th>
                                        <th>Thương hiệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Tác vụ</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($giohangdata as $sanpham) : ?>
                                        <?php if($sanpham['tv_id'] === $_SESSION['user']) :?>
                                    <tr>
                                        <td><?= $i; $i++ ?></td>
                                        <td>
                                            <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $sanpham['hinhdaidien'] ?>"
                                                class="img-fluid hinhdaidien" />
                                        </td>
                                        <td><?= $sanpham['sp_ten'] ?></td>
                                        <td><?= $sanpham['sp_mausac'] ?></td>
                                        <td><?= $sanpham['sp_kichthuoc'] ?></td>
                                        <td><?= $sanpham['th_ten'] ?></td>
                                        <td>
                                            <?= $sanpham['sl_mua'] ?>

                                        </td>
                                        <td><?= number_format($sanpham['sp_giaban'], 0, ".", ",")?> vnđ</td>
                                        <td><?= number_format($sanpham['thanhtien'], 0, ".", ",")?> vnđ</td>
                                        <?php
                                        $tongtien+=$sanpham['thanhtien'];
                                        ?>
                                        <td>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_id` -->
                                            <a id="delete_<?= $i ?>" data-sp-id="<?= $sanpham['sp_id'] ?>"
                                                class="btn btn-danger btn-delete-sanpham">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="10" style="font-size: 20px;">
                                            <span style="font-weight: bold">Tổng tiền: </span>
                                            <?=number_format($tongtien, 0, ".", ",")?> vnđ
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
    <script src="/Du_an_nien_luan/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/Du_an_nien_luan/backend/pages/loaisanpham/them_sua_lsp.js"></script>
    <script>
    $(document).ready(function() {
        function removeSanPhamVaoGioHang(id) {
            var dulieugoi = {
                sp_id: id
            };

            $.ajax({
                url: '/Du_an_nien_luan/backend/pages/giohang/giohang_xoasp.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    // Refresh lại trang
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    // var htmlString = `<h1>Không thể xử lý</h1>`;
                    // $('#thongbao').html(htmlString);
                    // $('.alert').removeClass('d-none').addClass('show');
                    location.reload();
                }
            });
        };

        $('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
            // debugger;
            event.preventDefault();
            var id = $(this).data('sp-id');
            console.log(id);
            removeSanPhamVaoGioHang(id);
            location.reload();
        });
    });
    </script>

</body>

</html>