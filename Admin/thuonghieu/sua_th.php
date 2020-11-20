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
    
   <style>

.body_formdangky {
    margin-top: 10px;
    text-align: center;
}

.body_formdangky label {
    font-weight: 600;
    
}

.title_formdangky {
    text-align: center;
    /* padding-top: 10px; */
}

.title_formdangky h4 {
    font-weight: 600;
    color: #8A2908;
}

.form-gioitinh span {
    padding-right: 20px;
    padding-left: 5px;
}

.form-gioitinh {
    margin-left: 20px;
}

.submit_formdangky {
    text-align: center;
    margin-top: 10px;
}

.submit_formdangky button {
    border: 2px solid #FF8000;
    border-radius: 20px;
    background-color: #FF8000;
    width: 300px;
    color: white;
    font-weight: bolder;
    transition: all 0.2s ease-in-out;
}

.submit_formdangky button:hover {
    background-color: white;
    color: #FF4000;
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
                        <a href="#"> <span>Cập nhật thương hiệu</span> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2"></div>

        </div>
        <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
                <main role="main" class=" ml-sm-auto px-4 mb-2  content_lsp">
                    <!-- Block content -->
                    <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $th_id = $_GET['th_id'];
                   
                    $sql = "SELECT * FROM thuonghieu WHERE th_id =".$th_id;
    
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
                    <!-- start form them loai san pham -->
                    <form name="Form_suath" id="Form_suath"
                        action="/Du_an_nien_luan/backend/pages/thuonghieu/xuly_suath.php" method="POST">
                        <div class="row body_formdangky">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php foreach($data as $loaisanpham): ?>
                                    <label for="txtHoTen">Tên thương hiệu cập nhập</label>
                                    <input type="text" class="form-control" name="txttenth" id="txttenth"
                                        aria-describedby="nameHelp" value="<?= $loaisanpham['th_ten']?>">
                                        <input type="hidden" name="thid" id="thid" value="<?= $loaisanpham['th_id'] ?>">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row body_formdangky">
                            <div class="col-md-12">
                                <div class="form-group">
                                <?php
                                    if(isset( $_SESSION["thongbaoth"])){
                                        echo  $_SESSION["thongbaoth"];
                                        session_unset();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row submit_formdangky">
                            <div class="col-md-12">
                                <button type="submit" name="btn_suath" id="btn_suath" class="btn">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                    <!-- end form them lai san pham  -->

                </main>
            </div>
            <div class="col-md-4"></div>
        </div>
        <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>
    </div>


    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->


    <!-- SweetAlert -->
    <script src="/Du_an_nien_luan/backend/pages/loaisanpham/them_sua_th.js"></script>

</body>

</html>




