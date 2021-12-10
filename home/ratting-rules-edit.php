<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cung ứng xây dựng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>
<body>
<div class="main-container">
    <!--    a-side menu-->
    <?php include("../includes/sidebar.php") ?>
    <!--    a-side menu end-->

    <div class="container">
        <!--        header-->
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <!--        header end-->
        <div class="content">
            <div class="mt-30">
                <h4 class="mt-5">Chỉnh sửa tiêu chí đánh giá</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="tieu-chi-danh-gia">Tiêu chí đánh giá<span class="text-red">&ast;</span></label>
                            <input type="text" id="tieu-chi-danh-gia" name="tieu-chi-danh-gia"
                                   placeholder="Nhập tiêu chí đánh giá" value="Chất lượng sản phẩm">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="he-so">Hệ số</label>
                            <input type="text" id="he-so" name="he-so"
                                   placeholder="Nhập hệ số" value="1">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <div class="v-select2">
                                <label for="nha-cung-cap">Chọn kiểu giá trị</label>
                                <select id="value-type" name="nha-cung-cap" class="share_select">
                                    <option value="">-- Chọn kiểu giá trị --</option>
                                    <option value="1">Nhập tay</option>
                                    <option value="2">Danh sách</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 left w-100 manual-value">
                    <div class="border-bottom">
                        <p class="d-inline text-bold">Danh sách giá trị</p>
                        <p class="text-blue link-text d-inline pl-20" id="add-rules-value">&plus; Thêm mới tài giá trị</p>
                    </div>
                    <div id="rules-value">
                        <div class="value border-bottom left w-100 pb-20">
                            <div class="form-row left">
                                <div class="form-col-50 left">
                                    <label for="gia-tri">Giá trị<span
                                            class="text-red">*</span></label>
                                    <input type="number" id="gia-tri" name="gia-tri"
                                           placeholder="Nhập giá trị" value="10">
                                </div>
                                <div class="form-col-50 left ml-10-p">
                                    <label for="ten-hien-thi">Tên hiển thị</label>
                                    <input type="text" id="ten-hien-thi" name="ten-hien-thi" placeholder="Nhập tên hiển thị" value="Tốt">
                                </div>
                            </div>
                            <div class="right">
                                <p class="removeItem3"><i class="ic-delete2"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-foot mt-30">
                    <div class="right">
                        <p class="v-btn btn-outline-blue modal-btn">Hủy</p>
                        <div class="modal text-center">
                            <div class="m-content">
                                <div class="m-head ">
                                    Thông báo <span class="dismiss cancel">&times;</span>
                                </div>
                                <div class="m-body">
                                    <p>Bạn có chắc chắn muốn hủy việc thêm tiêu chí đánh giá?</p>
                                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                                </div>
                                <div class="m-foot d-inline-block">
                                    <div class="left">
                                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                    </div>
                                    <div class="right">
                                        <a href="ratting-rules-index.php" class="v-btn btn-green right">Đồng ý</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="ratting-rules-index.php" class="v-btn btn-blue ml-20">Xong</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script type="text/javascript" src="../js/select.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>