<?php
  if(!isset($_SESSION)) { 
    session_start(); 
} 
if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    include_once(__DIR__ . '/../../dbconnect.php');
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Store - Trang Admin</title>
    <?php include_once(__DIR__.'/../styles.php'); ?>
    <link rel="stylesheet" href="/Du_an_nien_luan/assets/pages/index.css" type="text/css " />

</head>

<body>
    <div class="container-fluid">
        <!-- start navbar-header -->
        <?php include_once(__DIR__.'/../../backend/partials/header_admin.php'); ?>
        <!-- end navbar-header -->

        <div class="row">
            <div class="col-md-1"></div>
            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bảng tin DASHBOARD</h1>
                </div>

                <!-- Block content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-primary mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoSanPham_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số sản phẩm</div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ
                                liệu</button>
                        </div> <!-- Tổng số mặt hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-success mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoKhachHang_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số Khách hàng</div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ
                                liệu</button>
                        </div> <!-- Tổng số khách hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-warning mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoDonHang_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số đơn hàng</div>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ
                                liệu</button>
                        </div> <!-- Tổng số đơn hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-danger mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoloaisanpham_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số loại sản phẩm</div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm form-control" id="refreshBaoCaoloaisanpham">Refresh dữ
                                liệu</button>
                        </div> <!-- Tổng số góp ý -->
                        <div id="ketqua"></div>
                    </div><!-- row -->
                </div>
                <!-- End block content -->
            </main>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- start footer  -->
    <?php include_once(__DIR__.'/../partials/footer.php'); ?>
    <!-- end footer  -->
    <!-- end slider home -->
    <?php include_once(__DIR__.'/../scripts.php'); ?>
    <!-- Liên kết thư viện ChartJS -->
    <script src="/Du_an_nien_luan/assets/vendor/Chart.js/Chart.min.js"></script>
    <!-- Bat su kien -->
    <script>
    $(document).ready(function() {
        // ----------------- Tổng số mặt hàng --------------------------
        function getDuLieuBaoCaoTongSoMatHang() {
            $.ajax('/Du_an_nien_luan/backend/api/tongsosanpham.php', {
                success: function(data) {
                    var dataObj = typeof data === "string" ? JSON.parse(data) : null;
                    if (dataObj) {
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#baocaoSanPham_SoLuong').html(htmlString);
                    }
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoSanPham_SoLuong').html(htmlString);
                }
            });

        }
        $('#refreshBaoCaoSanPham').click(function(event) {
            event.preventDefault();
            getDuLieuBaoCaoTongSoMatHang();
        });

        // ----------------- Tổng số khách hàng --------------------------
        function getDuLieuBaoCaoTongSoKhachHang() {
            $.ajax('/Du_an_nien_luan/backend/api/tongsokhachhang.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoKhachHang_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoKhachHang_SoLuong').html(htmlString);
                }
            });
        }
        $('#refreshBaoCaoKhachHang').click(function(event) {
            event.preventDefault();
            getDuLieuBaoCaoTongSoKhachHang();
        });

        //   // ----------------- Tổng số đơn hàng --------------------------
        function getDuLieuBaoCaoTongSoDonHang() {
            $.ajax('/Du_an_nien_luan/backend/api/tongsodonhang.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoDonHang_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoDonHang_SoLuong').html(htmlString);
                }
            });
        }
        $('#refreshBaoCaoDonHang').click(function(event) {
            event.preventDefault();
            getDuLieuBaoCaoTongSoDonHang();
        });

        //   // ----------------- Tổng số Góp ý --------------------------
        function getDuLieuBaoCaoloaisanpham() {
            $.ajax('/Du_an_nien_luan/backend/api/tongsoloaisanpham.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoloaisanpham_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoloaisanpham_SoLuong').html(htmlString);
                }
            });
        }
        $('#refreshBaoCaoloaisanpham').click(function(event) {
            event.preventDefault();
            getDuLieuBaoCaoloaisanpham();
        });

        getDuLieuBaoCaoTongSoMatHang();
        getDuLieuBaoCaoTongSoKhachHang();
        getDuLieuBaoCaoTongSoDonHang();
        getDuLieuBaoCaoloaisanpham();
        // renderChartThongKeLoaiSanPham();
       
        // var $objChartThongKeLoaiSanPham;
        // var $chartOfobjChartThongKeLoaiSanPham = document.getElementById("chartOfobjChartThongKeLoaiSanPham")
        //     .getContext(
        //         "2d");

        // function renderChartThongKeLoaiSanPham() {
        //     $.ajax({
        //         url: '/php/myhand/backend/api/baocao-thongkeloaisanpham.php',
        //         type: "GET",
        //         success: function(response) {
        //             var data = JSON.parse(response);
        //             var myLabels = [];
        //             var myData = [];
        //             $(data).each(function() {
        //                 myLabels.push((this.TenLoaiSanPham));
        //                 myData.push(this.SoLuong);
        //             });
        //             myData.push(0); // tạo dòng số liệu 0
        //             if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
        //                 $objChartThongKeLoaiSanPham.destroy();
        //             }
        //             $objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
        //                 // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
        //                 type: "bar",
        //                 data: {
        //                     labels: myLabels,
        //                     datasets: [{
        //                         data: myData,
        //                         borderColor: "#9ad0f5",
        //                         backgroundColor: "#9ad0f5",
        //                         borderWidth: 1
        //                     }]
        //                 },
        //                 // Cấu hình dành cho biểu đồ của ChartJS
        //                 options: {
        //                     legend: {
        //                         display: false
        //                     },
        //                     title: {
        //                         display: true,
        //                         text: "Thống kê Loại sản phẩm"
        //                     },
        //                     responsive: true
        //                 }
        //             });
        //         }
        //     });
        // };
        // $('#refreshThongKeLoaiSanPham').click(function(event) {
        //     event.preventDefault();
        //     renderChartThongKeLoaiSanPham();
        // });

     
     

    });
    </script>

</body>

</html>