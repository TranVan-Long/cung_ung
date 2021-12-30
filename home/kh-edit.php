<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa khách hàng</title>
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
                <p class="page-title">Chỉnh sửa khách hàng</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Mã khách hàng<span class="text-red">&ast;</span></label>
                                <input type="text" name="ma_khach_hang" value="KH-000-88876"
                                       readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Mã số thuế</label>
                                <input type="text" name="ma_so_thue" placeholder="Nhập mã số thuế"
                                       value="0986555777821">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Tên khách hàng<span class="text-red">&ast;</span></label>
                                <input type="text" name="ten_khach_hang"
                                       placeholder="Nhập tên khách hàng" value="Công ty X">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Tên giao dịch<span class="text-red">&ast;</span></label>
                                <input type="text" name="ten_giao_dich"
                                       placeholder="Nhập tên giao dịch" value="CTX001">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Tên gọi tắt</label>
                                <input type="text" name="ten_goi_tat" placeholder="Nhập tên gọi tắt" value="X">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Địa chỉ ĐKKD</label>
                                <input type="text" name="dia_chi_dkkd"
                                       placeholder="Nhập địa chỉ ĐKKD" value="Số 22, đường X, phường X, quận X">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Số ĐKKD</label>
                                <input type="text" name="so_dkkd" placeholder="Nhập số ĐKKD" value="KD-0987654472103">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Địa chỉ liên hệ</label>
                                <input type="text" name="dia_chi_lien_he"
                                       placeholder="Nhập địa chỉ liên hệ" value="Số 22, đường X, phường X, quận X">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Fax</label>
                                <input type="text" name="fax" placeholder="Nhập Fax" value="0223756524">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Điện thoại</label>
                                <input type="text" name="dien_thoai" placeholder="Nhập điện thoại" value="0223756524">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Website</label>
                                <input type="text" name="website" placeholder="Nhập Website" value="congtyx.com.vn">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>E-mail</label>
                                <input type="text" name="e_mail" placeholder="Nhập E-mail" value="ctx0000000@gmail.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-control edit-form mt-30 left w-100">
                        <div class="border-bottom pb-10">
                            <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                            <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-bank-acc">&plus; Thêm
                                mới tài khoản ngân
                                hàng</p>
                        </div>
                        <div id="bank-list">
                            <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                <div class="bank-form">
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15 v-select2">
                                            <label for="ten-ngan-hang">Tên ngân hàng<span
                                                        class="text-red">&ast;</span></label>
                                            <select name="ten_ngan_hang" class="share_select">
                                                <option value="">-- Chọn ngân hàng --</option>
                                                <option value="VCB" selected>VCB</option>
                                            </select>
                                        </div>
                                        <div class="form-col-50 right mb_15 v-select2">
                                            <label for="chi-nhanh-ngan-hang">Chi nhánh<span
                                                        class="text-red">&ast;</span></label>
                                            <select name="chi_nhanh_ngan_hang" class="share_select">
                                                <option value="">-- Chọn chi nhánh --</option>
                                                <option value="1" selected>Chi nhánh 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15">
                                            <label>Số tài khoản<span
                                                        class="text-red">&ast;</span></label>
                                            <input type="text" name="so_tai_khoan"
                                                   placeholder="Nhập số tài khoản" value="090909090909090">
                                        </div>
                                        <div class="form-col-50 right mb_15">
                                            <label>Chủ tài khoản</label>
                                            <input type="text" name="chu_tai_khoan"
                                                   placeholder="Nhập tên chủ tài khoản" value="Nguyễn Văn A">
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
                        <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa khách hàng?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-chi-tiet-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ma_khach_hang: {
                    required: true,
                },
                ten_khach_hang: {
                    required: true,
                },
                ten_giao_dich: {
                    required: true,
                },
                ten_ngan_hang:{
                    required: true,
                },
                chi_nhanh_ngan_hang:{
                    required: true,
                },
                so_tai_khoan:{
                    required: true,
                    number:true,
                }

            },
            messages: {
                ma_khach_hang: {
                    required: "Mã khách hàng không được để trống.",
                },
                ten_khach_hang: {
                    required: "Tên khách hàng không được để trống.",
                },
                ten_giao_dich: {
                    required: "Tên giao dịch không được để trống.",
                },
                ten_ngan_hang:{
                    required: "Vui lòng chọn ngân hàng.",
                },
                chi_nhanh_ngan_hang:{
                    required: "Vui lòng chọn chi nhánh.",
                },
                so_tai_khoan:{
                    required: "Số tài khoản không được để trống.",
                    number: "Số tài khoản không đúng định dạng.",
                }
            }
        });
        if (form.valid() === true) {
            alert("pass");
        }
    });
</script>
</html>