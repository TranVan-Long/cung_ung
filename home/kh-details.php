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
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

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
                <h5 class="text-blue mt-20 mb_25">Chi tiết Khách hàng</h5>
            </div>
            <div class="w-100 left">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left pl-10 mb_12">
                            <p class="left text-left w-50">Mã khách hàng</p>
                            <p class="right text-right w-50 cr_weight">KH-000-99999</p>
                        </div>
                        <div class="form-col-50 right pr-10 mb_12">
                            <p class="left text-left w-50">Tên gọi tắt</p>
                            <p class="right text-right w-50 cr_weight">NVA</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50">Tên khách hàng</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Văn A</p>
                        </div>
                        <div class="form-col-50 right pr-10 mb_12 pt-10">
                            <p class="left text-left w-50">Tên giao dịch</p>
                            <p class="right text-right w-50 cr_weight">NVA01</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50"> Mã số thuế</p>
                            <p class="right text-right w-50 cr_weight">09988776485</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10 ">
                            <p class="left text-left w-50">Địa chỉ ĐKKD</p>
                            <p class="right text-right w-50 cr_weight">Số 5, phố X, phường X, quận X</p>
                        </div>
                        <div class="form-col-50 right pr-10 mb_12 pt-10">
                            <p class="left text-left w-50">Số ĐKKD</p>
                            <p class="right text-right w-50 cr_weight">15339876543210</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50">Địa chỉ liên hệ</p>
                            <p class="right text-right w-50 cr_weight">Số 5, phố X, phường X, quận X</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50">Điện thoại</p>
                            <p class="right text-right w-50 cr_weight">01234567889</p>
                        </div>
                        <div class="form-col-50 right pr-10 mb_12 pt-10">
                            <p class="left text-left w-50">Fax</p>
                            <p class="right text-right w-50 cr_weight">0123456789</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50">Website</p>
                            <p class="right text-right w-50 cr_weight">ncca.com.vn</p>
                        </div>
                        <div class="form-col-50 right pr-10 mb_12 pt-10">
                            <p class="left text-left w-50">E-mail</p>
                            <p class="right text-right w-50 cr_weight">ncca@gmail.com</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10 mb_12 pt-10">
                            <p class="left text-left w-50">Mã số thuế</p>
                            <p class="right text-right w-50 cr_weight">009927363528</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <p class="cr_weight">Danh sách tài khoản ngân hàng</p>
                <div class="left w-100 bordered mt-10 ds_tk_nhang">
                    <div class="form-row left">
                        <div class="form-col-50 left mb_12">
                            <p class="left text-left w-50">Tên ngân hàng</p>
                            <p class="right text-right w-50 cr_weight">Ngân hàng A</p>
                        </div>
                        <div class="form-col-50 right mb_12">
                            <p class="left text-left w-50">Chi nhánh</p>
                            <p class="right text-right w-50 cr_weight">Chi nhánh 1</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Số tài khoản</p>
                            <p class="right text-right w-50 cr_weight">0364777829845</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Chủ tài khoản</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Văn A</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left">
                <div class="left mt-30">
                    <p class="v-btn btn-green">Xuất excel</p>
                </div>
                <div class="right mt-30">
                    <p class="v-btn btn-outline-red modal-btn" data-target="delete">Xóa</p>
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
                    <a href="chinh-sua-khach-hang.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                </div>
            </div>
            <div class=""></div>
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