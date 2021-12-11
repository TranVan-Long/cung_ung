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
    <div class="main-container ql_them_phieu_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd w_100 fload_l">
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 fload_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm phiếu thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 fload_l" method="">
                                <div class="form-row w_100 fload_l">
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
                                <div class="form-row w_100 fload_l">
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
                                <div class="form-row w_100 fload_l ">
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
                                        <select name="hdong_dhang" class="form-control all_hthuc">
                                            <option value="">-- Chọn hình thức thanh toán --</option>
                                            <option value="1">Tiền mặt</option>
                                            <option value="2">Bằng thẻ</option>
                                            <option value="3">Chuyển khoản</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Đơn vị chi trả</label>
                                        <p class="cr_weight">Cong ty A</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thụ hưởng</label>
                                        <p class="cr_weight">Công ty A</p>
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Số tiền <span class="cr_red">*</span></label>
                                        <input type="text" name="so_tien" class="form-control"
                                            placeholder="Nhập số tiền">
                                    </div>
                                    <div class="form-group">
                                        <label>Tỷ giá</label>
                                        <input type="text" name="ty_gia" class="form-control"
                                            placeholder="Nhập tỷ giá">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Giá trị quy đổi</label>
                                        <input type="text" name="so_tien" class="form-control h_border cr_weight" value="0">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
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
                                <div class="form-them-nganh w_100 fload_l">
                                    <div class="tieu_de  w_100 fload_l d_flex fl_wrap mb_10">
                                        <p class="mr_30 share_fsize_tow share_clr_one cr_weight">Danh sách tài khoản ngân hàng</p>
                                        <p class="share_clr_four share_fsize_tow cr_weight share_cursor">+ Thêm mới tài khoản ngân hàng</p>
                                    </div>
                                    <div class="tien_chi_tra  w_100 fload_l d_flex fl_agi">
                                        <div class="form-ctra  w_100 fload_l">
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
                                        <span class="remove_tnh ml_50 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 fload_l">
                                    <div class="ctn_table w_100 fload_l">
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
                                                    <td class="tex_left share_clr_four cr_weight share_h_52">Tổng</td>
                                                    <td class="share_clr_four cr_weight">25.000.000</td>
                                                    <td></td>
                                                    <td class="share_clr_four cr_weight">25.000.000</td>
                                                </tr>
                                                <tr class="sh_bgr_five">
                                                    <td class="tex_left share_h_52">HS-2021-09089</td>
                                                    <td>25.000.000</td>
                                                    <td>30/10/2021</td>
                                                    <td>25.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="tex_left share_h_52">Công trình xây dựng cầu XYZ</td>
                                                    <td>25.000.000</td>
                                                    <td></td>
                                                    <td>25.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="tex_left">TT-08954</td>
                                                    <td>25.000.000</td>
                                                    <td></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="so_tien_ctra" class="form-group tex_center">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button"
                                            class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="submit"
                                            class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script>
$(".all_nhacc, .ten_nganhang, .chi_nhanh, .chu_taik, .so_taik").select2({
    width: '100%',
});
</script>

</html>