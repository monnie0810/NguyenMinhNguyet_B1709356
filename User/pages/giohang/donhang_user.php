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
                        <a href="#"> <span>Danh sách đơn hàng</span> </a>
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
                    $user = $_SESSION['user'];
                    $sql_tv = "SELECT * FROM thanhvien WHERE tv_sdt = '$user'";
                    $result_tv = mysqli_query($conn, $sql_tv);
                    while ($row_tv = mysqli_fetch_array($result_tv, MYSQLI_ASSOC)) {
                        $user_tv = array(
                            'tv_id' => $row_tv['tv_id']
                        );
                    }
                    $user_id = $user_tv['tv_id'];
                    $sql = "SELECT * FROM hoadon WHERE hoadon.tv_id = $user_id ORDER BY hoadon.hd_trangthai";
    
                    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'hd_id' => $row['hd_id'],
                            'hd_ngaylap' => $row['hd_ngaylap'],
                            'hd_trangthai' => $row['hd_trangthai'],
                            'hd_tongtien' => $row['hd_tongtien'],
                        );
                    }
                    ?>
                    <div
                        class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
                        <h1 class="h2">Danh sách đơn hàng</h1>
                    </div>

                    <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                        <a href="/Du_an_nien_luan/backend/pages/giohang/giohang.php" class="btn btn-warning">
                                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                                Danh sách đơn hàng
                            </a>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row content_pages">
                        <div class="tables_div">
                            <table id="tblDanhSach"
                                class="table table-hover table-sm table-responsive mt-5 trangchu_pages">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Mã hóa đơn</th>
                                        <th>Ngày lập</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Tác vụ</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($data as $dondathang) : ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>

                                        <td><?= $dondathang['hd_id'] ?></td>
                                        <td><?= $dondathang['hd_ngaylap'] ?></td>
                                        <td><?= number_format($dondathang['hd_tongtien'], 0, ".", ",")?> vnđ</td>
                                        <?php if($dondathang['hd_trangthai'] == 0):?>
                                        <td>Chưa giao</td>
                                        <td>
                                            <a href="/Du_an_nien_luan/backend/pages/donhang/xoa_donhang.php?hd_id=<?= $dondathang['hd_id'] ?>"
                                                class="btn btn-danger">
                                                Hủy
                                            </a>
                                            <a href="xemchitiet_donhang_user.php?hd_id=<?= $dondathang['hd_id'] ?>"
                                                class="btn btn-primary">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                        <?php elseif($dondathang['hd_trangthai'] == 1): ?>
                                        <td>Đã giao</td>
                                        <td>
                                            <a href="xemchitiet_donhang_user.php?hd_id=<?= $dondathang['hd_id'] ?>"
                                                class="btn btn-primary">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                        <?php endif; ?>

                                    </tr>
                                    <?php endforeach; ?>
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