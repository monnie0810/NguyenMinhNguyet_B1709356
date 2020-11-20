<?php
if (session_id() === '') {
  session_start();
}
if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sql_ad = "SELECT * FROM thanhvien WHERE tv_sdt = '$user'";
    $result_ad = mysqli_query($conn,$sql_ad);
    while($row_ad = mysqli_fetch_array($result_ad,MYSQLI_ASSOC)){
        $data_ad = array(
            'tv_id' => $row_ad['tv_id'],
            'quyen_id' => $row_ad['quyen_id'],
        );   
    }
    if ($data_ad['quyen_id'] == 1){
            header("location: /Du_an_nien_luan/index.php");
    }
} else {
    header("location: /Du_an_nien_luan/index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonStore - Thương hiệu</title>


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

    .trangchu_pages td {
        vertical-align: middle;
    }

    .content_pages {
        margin: auto;
    }

    .dataTables_length {
        width: 50%;
        float: left;
    }

    .dataTables_filter {
        width: 50%;
        float: left;
    }

    .tables_div {
        margin: auto;
    }

    .tensp_header {
        color: red;
    }

    .img-fluid {
        height: 100px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <div class="container-fluid">
        <!-- start navbar-header -->
        <?php include_once(__DIR__.'/../../partials/header_admin.php'); ?>
        <!-- end navbar-header -->
        <div class="row duongdan_row">
            <div class="col-md-2"></div>
            <div class="col-md-8 duongdan">
                <ul style="list-style-type: none;">
                    <li class="duongdan_truoc">
                        <a href="/Du_an_nien_luan/backend/pages/index_admin.php"><span>Trang chủ</span> </a>
                    </li>

                    <li class="duongdan_hientai">
                        <a href="#"> <span>Danh sách hình sản phẩm</span> </a>
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
                    $sp_id = $_GET['sp_id'];
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $i=1;
                    // select hinh san pham 
                    $sql = "SELECT * FROM hinhsanpham WHERE sp_id=".$sp_id;
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'hsp_ten' => $row['hsp_ten'],
                            'hsp_id' => $row['hsp_id']
                        );
                    }
                    // select san pham 
                    $sql1 = "SELECT * FROM sanpham WHERE sp_id=".$sp_id;
                    $result1 = mysqli_query($conn, $sql1);
                    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                        $sanpham = array(
                            'sp_ten' => $row1['sp_ten'],
                            'sp_id' => $row1['sp_id']
                        );
                    }
                    ?>
                    <div
                        class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">

                        <h2 class="h2">Danh sách hình sản phẩm </h2>
                        <h2 class="tensp_header"><?= $sanpham['sp_ten'] ?></h2>
                    </div>
                    <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
                    <a href="/Du_an_nien_luan/backend/pages/hinhsanpham/them_hsp.php?sp_id=<?=$sanpham['sp_id']?>"
                        class="btn btn-primary" style="margin-bottom: 20px;">
                        Thêm hình sản phẩm
                    </a>
                    <a href="/Du_an_nien_luan/backend/pages/sanpham/danhsach_sp.php" class="btn btn-secondary"
                        style="margin-bottom: 20px;">
                        Quay về
                    </a>
                    <div class="row content_pages">
                        <div class="tables_div">
                            <table id="tblDanhSach_hsp" class="table table-hover table-responsive mt-5 trangchu_pages">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Tên hình ảnh</th>
                                        <th>Hình ảnh</th>
                                        <th>Tác vụ</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($data as $hinhsanpham) : ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>

                                        <td><?= $hinhsanpham['hsp_ten'] ?></td>
                                        <td>
                                            <img src="/Du_an_nien_luan/assets/img/upload_img/<?= $hinhsanpham['hsp_ten'] ?>"
                                                class="img-fluid" width="100px" />

                                        </td>
                                        <td>

                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                            <a class="btn btn-danger"
                                                href="xuly_xoahsp.php?hsp_id=<?= $hinhsanpham['hsp_id'] ?>">
                                                Xóa
                                            </a>



                                        </td>
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
        $('#tblDanhSach_hsp').DataTable({
            dom: 'Blfrtip',
            buttons: [

            ]
        });

        // Cảnh báo khi xóa
        // $('.btnDelete_th').click(function() {

        //     swal({
        //             title: "Bạn có chắc chắn muốn xóa?",
        //             text: "Sau khi xóa thì không thể phục hồi !",
        //             icon: "warning",
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 var hsp_id = $(this).data('hsp_id');
        //                 var url = "xuly_xoahsp.php?hsp_id=" + hsp_id;
        //                 location.href = url;
        //             }
        //         });

        // });
    });
    </script>
    <script src="/Du_an_nien_luan/backend/pages/thuonghieu/them_sua_th.js"></script>

</body>

</html>