<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết khách hàng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>

    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-20 left">
                <a class="text-black" href="quan-ly-khach-hang.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title text-blue mt-20">Chi tiết Khách hàng</p>
            </div>
            <div class="w-100 left mt-10">
                <div class="form-control detail-form">
                    <div class="form-row left">
                        <div class="form-col-50 left p-10 no-border">
                            <p class="detail-title">Mã khách hàng</p>
                            <p class="detail-data text-500">KH-000-99999</p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Tên gọi tắt</p>
                            <p class="detail-data text-500">NVA</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Tên khách hàng</p>
                            <p class="detail-data text-500">Nguyễn Văn A</p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Tên giao dịch</p>
                            <p class="detail-data text-500">NVA01</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title"> Mã số thuế</p>
                            <p class="detail-data text-500">09988776485</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10 ">
                            <p class="detail-title">Địa chỉ ĐKKD</p>
                            <p class="detail-data text-500">Số 5, phố X, phường X, quận X</p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Số ĐKKD</p>
                            <p class="detail-data text-500">15339876543210</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Địa chỉ liên hệ</p>
                            <p class="detail-data text-500">Số 5, phố X, phường X, quận X</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Điện thoại</p>
                            <p class="detail-data text-500">01234567889</p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Fax</p>
                            <p class="detail-data text-500">0123456789</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Website</p>
                            <p class="detail-data text-500">ncca.com.vn</p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">E-mail</p>
                            <p class="detail-data text-500">ncca@gmail.com</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Mã số thuế</p>
                            <p class="detail-data text-500">009927363528</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <p class="cr_weight">Danh sách tài khoản ngân hàng</p>
                <div class="left w-100 bordered mt-10 ds_tk_nhang detail-form">
                    <div class="form-row left">
                        <div class="form-col-50 left mb_15 no-border">
                            <p class="detail-title">Tên ngân hàng</p>
                            <p class="detail-data text-500">Ngân hàng A</p>
                        </div>
                        <div class="form-col-50 right mb_15 no-border">
                            <p class="detail-title">Chi nhánh</p>
                            <p class="detail-data text-500">Chi nhánh 1</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left mb_15 no-border">
                            <p class="detail-title">Số tài khoản</p>
                            <p class="detail-data text-500">0364777829845</p>
                        </div>
                        <div class="form-col-50 right mb_15 no-border">
                            <p class="detail-title">Chủ tài khoản</p>
                            <p class="detail-data text-500">Nguyễn Văn A</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left">
                <div class="control-btn right">
                    <p class="v-btn btn-outline-red modal-btn mr-20 mt-15" data-target="delete">Xóa</p>
                    <a href="chinh-sua-khach-hang.html" class="v-btn btn-blue mt-15">Chỉnh sửa</a>
                </div>
                <div class="control-btn left mr-10">
                    <button class="v-btn btn-green mr-20 mt-15">Xuất excel</button>
                    <p class="v-btn"></p>
                </div>
            </div>
        </div>
        <div class="modal text-center" id="delete">
            <div class="m-content huy-them">
                <div class="m-head ">
                    Xóa đơn hàng <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>Bạn có chắc chắn muốn xóa khách hàng này?</p>
                    <p>Thao tác này sẽ không thể hoàn tác.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right">
                        <p class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../modals/modal_logout.php"?>
<? include("../modals/modal_menu.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>