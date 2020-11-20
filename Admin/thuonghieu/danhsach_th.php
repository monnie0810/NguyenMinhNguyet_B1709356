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

    .content_pages {
        margin: auto;
    }

    .tables_div {
        margin: auto;
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
                        <a href="#"> <span>Danh sách thương hiệu</span> </a>
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
                    $sql = "SELECT * FROM thuonghieu";
    
                    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'th_ten' => $row['th_ten'],
                            'th_id' => $row['th_id']
                        );
                    }
                    ?>
                    <div
                        class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
                        <h1 class="h2">Danh sách thương hiệu</h1>
                    </div>
                    <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#popup_themth">
                        Thêm thương hiệu
                    </a>
                    <div class="row content_pages">
                        <div class="tables_div">
                            <table id="tblDanhSach_th"
                                class="table table-hover table-sm table-responsive mt-5 trangchu_pages">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Tên thương hiệu</th>
                                        <th>Tác vụ</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($data as $dondathang) : ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>
                                        <td><?= $dondathang['th_ten'] ?></td>
                                        <td>
                                            <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính -->
                                            <a href="sua_th.php?th_id=<?= $dondathang['th_id'] ?>"
                                                class="btn btn-warning">
                                                Sửa
                                            </a>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                            <a href="xoa_th.php?th_id=<?= $dondathang['th_id'] ?>"
                                                class="btn btn-danger">
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

    <!-- Thêm loại sản phẩm -->
    <div class="modal fade" id="popup_themth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- start form them loai san pham -->
                <form name="Form_themth" id="Form_themth"
                    action="/Du_an_nien_luan/backend/pages/thuonghieu/xuly_themth.php" method="POST">

                    <div class="modal-header">
                        <h5 class="modal-title title-dangnhap" id="exampleModalLabel">Thêm thương hiệu
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tên thương hiệu:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="txttenth" name="txttenth"
                                    placeholder="Tên thương hiệu">
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" name="btn_themth"
                            id="btn_themth">Thêm</button>
                    </div>

                </form>
                <!-- end form them loai san pham  -->
            </div>
        </div>
    </div>
    <!-- end Thêm loại sản phẩm -->




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
        var datatable = $('#tblDanhSach_th').DataTable({
            dom: 'Blfrtip',
            buttons: [

            ]
           
        });
    });
    </script>
    <script src="/Du_an_nien_luan/backend/pages/thuonghieu/them_sua_th.js"></script>

</body>

</html>