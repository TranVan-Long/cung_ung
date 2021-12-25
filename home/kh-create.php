<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm khách hàng</title>
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
            <div class="left mt-25">
                <p class="page-title">Thêm khách hàng</p>
            </div>
            <div class="w-100 left mt-10">
                <div class="form-control edit-form">
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="ma-khach-hang">Mã khách hàng<span class="text-red">*</span></label>
                            <input type="text" id="ma-khach-hang" name="ma-khach-hang" value="KH-987-554324" disabled
                                   required>
                        </div>
                        <div class="form-col-50 no-border mb_15 right">
                            <label for="ma-so-thue">Mã số thuế</label>
                            <input type="text" id="ma-so-thue" name="ma-so-thue" placeholder="Nhập Mã số thuế">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="ten-khach-hang">Tên khách hàng<span class="text-red">*</span></label>
                            <input type="text" id="ten-khach-hang" name="ten-khach-hang"
                                   placeholder="Nhập tên khách hàng">
                        </div>
                        <div class="form-col-50 no-border mb_15 right">
                            <label for="ten-giao-dich">Tên giao dịch<span class="text-red">*</span></label>
                            <input type="text" id="ten-giao-dich" name="ten-giao-dich" placeholder="Nhập tên giao dịch">
                        </div>

                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="ten-goi-tat">Tên gọi tắt</label>
                            <input type="text" id="ten-goi-tat" name="ten-goi-tat" placeholder="Nhập mã số thuế">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="dia-chi-dkkd">Địa chỉ ĐKKD</label>
                            <input type="text" id="dia-chi-dkkd" name="dia-chi-dkkd" placeholder="Nhập địa chỉ ĐKKD">
                        </div>
                        <div class="form-col-50 no-border mb_15 right">
                            <label for="so-dkkd">Số ĐKKD</label>
                            <input type="text" id="so-dkkd" name="so-dkkd" placeholder="Nhập số ĐKKD">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="dia-chi-lien-he">Địa chỉ liên hệ</label>
                            <input type="text" id="dia-chi-lien-he" name="dia-chi-lien-he"
                                   placeholder="Nhập địa chỉ liên hệ">
                        </div>
                        <div class="form-col-50 no-border mb_15 right">
                            <label for="fax">Fax</label>
                            <input type="text" id="fax" name="fax" placeholder="Nhập Fax">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="dien-thoai">Điện thoại</label>
                            <input type="text" id="dien-thoai" name="dien-thoai" placeholder="Nhập điện thoại">
                        </div>
                        <div class="form-col-50 no-border mb_15 right">
                            <label for="website">Website</label>
                            <input type="text" id="website" name="website" placeholder="Nhập Website">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border mb_15 left">
                            <label for="e-mail">E-mail<span class="text-red">*</span></label>
                            <input type="text" id="e-mail" name="e-mail" placeholder="Nhập E-mail">
                        </div>
                    </div>
                </div>
                <div class="form-control edit-form mt-15 left w-100">
                    <div class="border-bottom pb-10">
                        <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                        <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-bank-acc">&plus; Thêm mới tài khoản ngân
                            hàng</p>
                    </div>
                    <div id="bank-list">
                        <div class="bank border-bottom left w-100 pb-20 mt-10 d-flex spc-btw">
                            <div class="bank-form">
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <div class="v-select2">
                                            <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">*</span></label>
                                            <select name="ten-ngan-hang" class="share_select">
                                                <option value="">-- Chọn ngân hàng --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <div class="v-select2">
                                            <label for="chi-nhanh-ngan-hang">Chi nhánh<span
                                                        class="text-red">*</span></label>
                                            <select name="chi-nhanh-ngan-hang" class="share_select">
                                                <option value="">-- Chọn chi nhánh --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <label for="tai-khoan-ngan-hang">Tài khoản ngân hàng<span
                                                    class="text-red">*</span></label>
                                        <input type="text" id="tai-khoan-ngan-hang" name="tai-khoan-ngan-hang"
                                               placeholder="Nhập số tài khoản">
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <label for="ma-so-thue">Chủ tài khoản</label>
                                        <input type="text" id="ma-so-thue" name="ma-so-thue" placeholder="Nhập mã số thuế">
                                    </div>
                                </div>
                            </div>
                            <div class="removeItem2">
                                <i class="ic-delete2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left">
                <div class="control-btn right">
                    <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                    <p class="v-btn btn-blue mt-20">Xong</p>
                </div>
            </div>
        </div>
        <div class="modal text-center" id="cancel">
            <div class="m-content">
                <div class="m-head ">
                    Thông báo <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>Bạn có chắc chắn muốn hủy việc thêm khách hàng?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right">
                        <a href="quan-ly-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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