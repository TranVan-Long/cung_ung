<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm phiếu thanh toán</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_them_phieu_tt ql_sua_phieu_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content mt_20">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm phiếu thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" method="">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_nhacc">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số phiếu <span class="cr_red">*</span></label>
                                        <input type="text" name="so_phieu" value="PH-001" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Nhà cung cấp</label>
                                        <input type="text" name="khachh_nhacc" class="form-control h_border">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thanh toán</label>
                                        <input type="date" name="ngay_ttoan" class="form-control"
                                            placeholder="Chọn ngày thanh toán">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l ">
                                    <div class="form-group share_form_select">
                                        <label>Hình thức thanh toán <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hthuc">
                                            <option value="">-- Chọn hình thức thanh toán --</option>
                                            <option value="1">Tiền mặt</option>
                                            <option value="2">Bằng thẻ</option>
                                            <option value="3">Chuyển khoản</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Loại thanh toán</label>
                                        <select name="lthanh_toan" class="form-control all_ltt">
                                            <option value="">-- Chọn loại thanh toán --</option>
                                            <option value="1">Tạm ứng</option>
                                            <option value="2">Theo hợp đồng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đơn vị chi trả</label>
                                        <p class="cr_weight">Cong ty A</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thụ hưởng</label>
                                        <p class="cr_weight">Công ty A</p>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số tiền <span class="cr_red">*</span></label>
                                        <input type="text" name="so_tien" class="form-control"
                                            placeholder="Nhập số tiền">
                                    </div>
                                    <div class="form-group">
                                        <label>Tỷ giá</label>
                                        <input type="text" name="ty_gia" class="form-control" placeholder="Nhập tỷ giá">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị quy đổi</label>
                                        <input type="text" name="so_tien" class="form-control h_border cr_weight"
                                            value="0">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Phí giao dịch</label>
                                        <input type="text" name="phi_giaod" class="form-control"
                                            placeholder="Nhập phí giao dịch">
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận tiền</label>
                                        <input type="text" name="nguoi_ntien" class="form-control"
                                            placeholder="Nhập người nhận tiền">
                                    </div>
                                </div>
                                <div class="form-them-nganh w_100 float_l"></div>
                                <div class="them_moi_vt w_100 float_l">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_five">Hồ sơ thanh toán</th>
                                                    <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                                    <th class="share_tb_five">Thời hạn thanh toán</th>
                                                    <th class="share_tb_five">Thanh toán</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="sh_bgr_four">
                                                    <td
                                                        class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">
                                                        Tổng</td>
                                                    <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                                    <td class="share_tb_five"></td>
                                                    <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                                </tr>
                                                <tr class="sh_bgr_five">
                                                    <td class="tex_left share_h_52 share_tb_five">HS-2021-09089</td>
                                                    <td class="share_tb_five">25.000.000</td>
                                                    <td class="share_tb_five">30/10/2021</td>
                                                    <td class="share_tb_five">25.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="tex_left share_h_52 share_tb_five">Công trình xây dựng
                                                        cầu XYZ</td>
                                                    <td class="share_tb_five">25.000.000</td>
                                                    <td class="share_tb_five"></td>
                                                    <td class="share_tb_five">25.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="tex_left share_tb_five">TT-08954</td>
                                                    <td class="share_tb_five">25.000.000</td>
                                                    <td class="share_tb_five"></td>
                                                    <td class="share_tb_five">
                                                        <div class="form-group">
                                                            <input type="text" name="so_tien_ctra"
                                                                class="form-control tex_center">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button phieu_button">
                                        <button type="button"
                                            class="cancel_add mb-10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="submit"
                                            class="save_add mb-10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm phiếu thanh
                                    toán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht">
                                <div class="tow_butt_flex d_flex phieu_dy_pop">
                                    <button type="button"
                                        class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button"
                                        class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
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
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
$(".all_nhacc, .ten_nganhang, .chi_nhanh, .chu_taik, .so_taik, .all_ltt").select2({
    width: '100%',
});

function CheckSelect() {
    $(".ten_nganhang, .so_taik, .chu_taik, .chi_nhanh").select2({
        width: '100%',
    });
}

$(".all_ltt").change(function() {
    var all_ltt = $(this).val();
    if (all_ltt == 1) {
        $(".them_moi_vt .ctn_table").remove();
    } else if (all_ltt == 2) {
        var html = `<div class="ctn_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="share_tb_five">Hồ sơ thanh toán</th>
                                        <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                        <th class="share_tb_five">Thời hạn thanh toán</th>
                                        <th class="share_tb_five">Thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="sh_bgr_four">
                                        <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                        <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                        <td class="share_tb_five"></td>
                                        <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                    </tr>
                                    <tr class="sh_bgr_five">
                                        <td class="tex_left share_h_52 share_tb_five">HS-2021-09089</td>
                                        <td class="share_tb_five">25.000.000</td>
                                        <td class="share_tb_five">30/10/2021</td>
                                        <td class="share_tb_five">25.000.000</td>
                                    </tr>
                                    <tr>
                                        <td class="tex_left share_h_52 share_tb_five">Công trình xây dựng cầu XYZ</td>
                                        <td class="share_tb_five">25.000.000</td>
                                        <td class="share_tb_five"></td>
                                        <td class="share_tb_five">25.000.000</td>
                                    </tr>
                                    <tr>
                                        <td class="tex_left share_tb_five">TT-08954</td>
                                        <td class="share_tb_five">25.000.000</td>
                                        <td class="share_tb_five"></td>
                                        <td class="share_tb_five">
                                            <div class="form-group">
                                                <input type="text" name="so_tien_ctra" class="form-group tex_center">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;
        $(".them_moi_vt ").html(html);
    }
});

$(document).on('click', '.remove_tnh', function() {
    $(this).parents(".tien_chi_tra").remove();
});

$(document).ready(function() {
    if ($(".them_moi_vt .table tbody").height() > 395.5) {
        $(".them_moi_vt .table thead tr").css("width", 'calc(100% - 10px)');
    }
});

var cancel_add = $(".cancel_add");
cancel_add.click(function() {
    modal_share.show();
});

$(".all_hthuc").change(function() {
    var id = $(this).val();
    if (id == 1) {
        $(".form-them-nganh .ctie_form_nhang").remove()
        $(".tien_chi_tra").remove();
    }else if(id == 2 || id == 3){
        var html = `<div class="ctie_form_nhang w_100 float_l">
                        <div class="tieu_de  w_100 float_l d_flex fl_wrap mb_10">
                            <p class="mr_30 share_fsize_tow share_clr_one cr_weight cate_bank">Danh sách
                                tài khoản ngân hàng</p>
                            <p
                                class="add_ngan_hang share_clr_four share_fsize_tow cr_weight share_cursor">
                                + Thêm mới tài khoản ngân hàng</p>
                        </div>
                        <div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                            <div class="form-ctra  w_100 float_l">
                                <div class="form-row">
                                    <div class="form-group share_form_select">
                                        <label>Tên ngân hàng <span class="cr_red">*</span></label>
                                        <select name="ten_nganhang"
                                            class="form-control ten_nganhang"></select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Chi nhánh <span class="cr_red">*</span></label>
                                        <select name="chi_nhanh"
                                            class="form-control chi_nhanh"></select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group share_form_select">
                                        <label>Số tài khoản <span class="cr_red">*</span></label>
                                        <select name="so_taik" class="form-control so_taik"></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Chủ tài khoản </label>
                                        <input type="text" name="chu_taik" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <span class="remove_tnh ml_50 mr_10 share_cursor"><img
                                    src="../img/remove-2.png" alt="xóa"></span>
                        </div>
                    </div>`;

        $(".form-them-nganh").html(html)
    }
});

$(document).on('click','.add_ngan_hang', function(){
    var html = `<div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                    <div class="form-ctra w_100 float_l">
                        <div class="form-row">
                            <div class="form-group share_form_select">
                                <label>Tên ngân hàng <span class="cr_red">*</span></label>
                                <select name="ten_nganhang"
                                    class="form-control ten_nganhang"></select>
                            </div>
                            <div class="form-group share_form_select">
                                <label>Chi nhánh <span class="cr_red">*</span></label>
                                <select name="chi_nhanh" class="form-control chi_nhanh"></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group share_form_select">
                                <label>Số tài khoản <span class="cr_red">*</span></label>
                                <select name="so_taik"
                                    class="form-control so_taik"></select>
                            </div>
                            <div class="form-group">
                                <label>Chủ tài khoản </label>
                                <input type="text" name="chu_taik" class="form-control">
                            </div>
                        </div>
                    </div>
                    <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
                </div>`;
    $(".form-them-nganh").append(html);
    CheckSelect();
});


</script>

</html>