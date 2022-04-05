<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `phieu_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $phieu_tt = explode(',', $item_nv['phieu_tt']);
            if (in_array(1, $phieu_tt) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$id  = getValue('id', 'int', 'GET', '');
if ($id != "") {
    $list_ptt = new db_query("SELECT p.`id_hd_dh`, p.`id_ncc_kh`, p.`loai_phieu_tt`, p.`ngay_thanh_toan`, p.`hinh_thuc_tt`, p.`loai_thanh_toan`, p.`phan_loai`,
                            p.`nguoi_nhan_tien`, p.`so_tien`, p.`ty_gia`, p.`phi_giao_dich`, p.`gia_tri_quy_doi`, p.`trang_thai`, p.`id_nguoi_lap`,
                            n.`id`, n.`ten_nha_cc_kh`
                            FROM `phieu_thanh_toan` AS p
                            INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                            WHERE p.`id` = $id AND p.`id_cong_ty` = $com_id ");
    $item = mysql_fetch_assoc($list_ptt->result);
    $id_hd_dh = $item['id_hd_dh'];

    $loai_phieu_tt = $item['loai_phieu_tt'];
    if ($loai_phieu_tt == 1) {
        $gia_tri_svat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id` = $id_hd_dh AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
    } else if ($loai_phieu_tt == 2) {
        $gia_tri_svat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id` = $id_hd_dh AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
    }

    if ($item['phan_loai'] == 1 || $item['phan_loai'] == 3 || $item['phan_loai'] == 4 || $item['phan_loai'] ==  5) {
        $dv_chitra = $com_name;
        $dv_thuhuong = $item['ten_nha_cc_kh'];
    } else if ($item['phan_loai'] == 2 || $item['phan_loai'] == 6) {
        $dv_chitra = $item['ten_nha_cc_kh'];
        $dv_thuhuong = $com_name;
    };
}



?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa phiếu thanh toán</title>
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

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Chỉnh sửa phiếu thanh toán </h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $id ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số phiếu </label>
                                        <input type="text" name="so_phieu" value="PH - <?= $id ?>" data="<?= $id ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại phiếu thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_ptt" class="form-control loai_phieu" data="<?= $com_id ?>">
                                            <option value="">-- Chọn loại phiếu thanh toán --</option>
                                            <option value="1" <?= ($item['loai_phieu_tt'] == 1) ? "selected" : "" ?>>Phiếu thanh toán hợp đồng</option>
                                            <option value="2" <?= ($item['loai_phieu_tt'] == 2) ? "selected" : "" ?>>Phiếu thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hd_dh">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                            <? if ($item['loai_phieu_tt'] == 1) {
                                                $list_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id ");
                                                while ($row_hs = mysql_fetch_assoc($list_hd->result)) { ?>
                                                    <option value="<?= $row_hs['id_hd_dh'] ?>" <?= ($row_hs['id_hd_dh'] == $item['id_hd_dh']) ? "selected" : "" ?>> HĐ - <?= $row_hs['id_hd_dh'] ?></option>
                                                <? }
                                            } else if ($item['loai_phieu_tt'] == 2) {
                                                $list_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id");
                                                while ($row_hs = mysql_fetch_assoc($list_hd->result)) { ?>
                                                    <option value="<?= $row_hs['id_hd_dh'] ?>" <?= ($row_hs['id_hd_dh'] == $item['id_hd_dh']) ? "selected" : "" ?>> ĐH - <?= $row_hs['id_hd_dh'] ?></option>
                                            <? }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <? if ($item['phan_loai'] == 1 || $item['phan_loai'] == 3 || $item['phan_loai'] == 4 || $item['phan_loai'] == 5) { ?>
                                            <label>Nhà cung cấp</label>
                                            <input type="text" name="khachh_nhacc" value="<?= $item['ten_nha_cc_kh'] ?>" data="<?= $item['id'] ?>" data1="<?= $item['phan_loai'] ?>" class="form-control cr_weight h_border">
                                        <? } else if ($item['phan_loai'] == 2 || $item['phan_loai'] == 6) { ?>
                                            <label>Khách hàng</label>
                                            <input type="text" name="khachh_nhacc" value="<?= $item['ten_nha_cc_kh'] ?>" data="<?= $item['id'] ?>" data1="<?= $item['phan_loai'] ?>" class="form-control cr_weight h_border">
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thanh toán</label>
                                        <input type="date" name="ngay_ttoan" class="form-control" value="<?= ($item['ngay_thanh_toan'] != 0) ? date('Y-m-d', $item['ngay_thanh_toan']) : "" ?>" placeholder="Chọn ngày thanh toán">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l ">
                                    <div class="form-group share_form_select">
                                        <label>Hình thức thanh toán <span class="cr_red">*</span></label>
                                        <select name="hinh_thuc" class="form-control all_hthuc">
                                            <option value="">-- Chọn hình thức thanh toán --</option>
                                            <option value="1" <?= ($item['hinh_thuc_tt'] == 1) ? "selected" : "" ?>>Tiền mặt</option>
                                            <option value="2" <?= ($item['hinh_thuc_tt'] == 2) ? "selected" : "" ?>>Bằng thẻ</option>
                                            <option value="3" <?= ($item['hinh_thuc_tt'] == 3) ? "selected" : "" ?>>Chuyển khoản</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Loại thanh toán</label>
                                        <select name="lthanh_toan" class="form-control loai_thanh_toan" data="<?= $com_id ?>" onchange="loai_tt_doi(this)">
                                            <option value="">-- Chọn loại thanh toán --</option>
                                            <option value="1" <?= ($item['loai_thanh_toan'] == 1) ? "selected" : "" ?>>Tạm ứng</option>
                                            <option value="2" <?= ($item['loai_thanh_toan'] == 2) ? "selected" : "" ?>>Theo hợp đồng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đơn vị chi trả</label>
                                        <p class="cr_weight"><?= $dv_chitra ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thụ hưởng</label>
                                        <p class="cr_weight"><?= $dv_thuhuong ?></p>
                                    </div>
                                </div>
                                <div class="ct_form w_100 float_l">
                                    <? if ($item['loai_thanh_toan'] == 1) { ?>
                                        <div class="ctn_ct_from w_100 float_l">
                                            <div class="form-row w_100 float_l">
                                                <div class="form-group">
                                                    <label>Số tiền <span class="cr_red">*</span></label>
                                                    <input type="text" name="so_tien" value="<?= $item['so_tien'] ?>" oninput="<?= $oninput ?>" class="form-control" placeholder="Nhập số tiền">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tỷ giá</label>
                                                    <input type="text" name="ty_gia" value="<?= $item['ty_gia'] ?>" oninput="<?= $oninput ?>" class="form-control" placeholder="Nhập tỷ giá">
                                                </div>
                                            </div>
                                            <div class="form-row w_100 float_l">
                                                <div class="form-group">
                                                    <label>Giá trị quy đổi</label>
                                                    <input type="text" name="gia_quy_doi" value="<?= $item['gia_tri_quy_doi'] ?>" oninput="<?= $oninput ?>" class="form-control h_border cr_weight" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    <? } else if ($item['loai_thanh_toan'] == 2) {
                                        echo "";
                                    } ?>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Phí giao dịch</label>
                                        <input type="text" name="phi_giaod" class="form-control" value="<?= ($item['phi_giao_dich'] == 0) ? "" : $item['phi_giao_dich'] ?>" oninput="<?= $oninput ?>" placeholder="Nhập phí giao dịch">
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận tiền</label>
                                        <input type="text" name="nguoi_ntien" class="form-control" value="<?= $item['nguoi_nhan_tien'] ?>" placeholder="Nhập người nhận tiền">
                                    </div>
                                </div>
                                <div class="form-them-nganh w_100 float_l">
                                    <? if ($item['hinh_thuc_tt'] == 2 || $item['hinh_thuc_tt'] == 3) {
                                        $tai_khoan = new db_query("SELECT `id`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`
                                            FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id  "); ?>
                                        <div class="ctie_form_nhang w_100 float_l">
                                            <div class="tieu_de w_100 float_l d_flex fl_wrap mb_10">
                                                <p class="mr_30 share_fsize_tow share_clr_one cr_weight cate_bank">Danh sách tài khoản ngân hàng</p>
                                                <p class="share_clr_four share_fsize_tow cr_weight share_cursor add_ngan_hang">+ Thêm mới tài khoản ngân hàng</p>
                                            </div>
                                            <? while ($row1 = mysql_fetch_assoc($tai_khoan->result)) { ?>
                                                <div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                                                    <div class="form-ctra w_100 float_l">
                                                        <div class="form-row">
                                                            <div class="form-group share_form_select">
                                                                <label>Tên ngân hàng <span class="cr_red">*</span></label>
                                                                <input name="ten_nhanhang" class="form-control" type="text" value="<?= $row1['ten_ngan_hang'] ?>">
                                                                <input name="id_stk" type="hidden" value="<?= $row1['id'] ?>">
                                                            </div>
                                                            <div class="form-group share_form_select">
                                                                <label>Chi nhánh <span class="cr_red">*</span></label>
                                                                <input type="text" class="form-control" name="chi_nhanh" value="<?= $row1['ten_chi_nhanh'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group share_form_select">
                                                                <label>Số tài khoản <span class="cr_red">*</span></label>
                                                                <input type="number" class="form-control" name="so_tk" value="<?= $row1['so_tk'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Chủ tài khoản </label>
                                                                <input type="text" name="chu_taik" class="form-control" value="<?= $row1['chu_tk'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
                                                </div>
                                            <? } ?>
                                        </div>
                                </div>
                            <? } else if ($item['hinh_thuc_tt'] == 1) {
                                        echo "";
                                    } ?>
                        </div>
                        <div class="them_moi_vt w_100 float_l">
                            <? if ($item['loai_thanh_toan'] == 2) {
                                $list_hs = new db_query("SELECT `id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`
                                                                FROM `chi_tiet_phieu_tt_vt` WHERE `id_cong_ty` = $com_id AND `id_phieu_tt` = $id
                                                                AND `id_hd_dh` = $id_hd_dh ");
                            ?>

                                <div class="ctn_table w_100 float_l">
                                    <table class="table" data="<?= $id ?>">
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
                                                <td class="share_clr_four cr_weight share_tb_five"></td>
                                                <td class="share_tb_five"></td>
                                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"></td>
                                            </tr>
                                            <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                                                $id_hs = $row1['id_hs'];
                                                $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                        WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);
                                                $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS sumtt FROM `chi_tiet_phieu_tt_vt`
                                                                        WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_phieu_tt` != $id "))->result); ?>

                                                <tr>
                                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= $than_tient['tong_tien_tatca'] - $tong_tien['sumtt'] ?></td>
                                                    <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                                    <td class="share_tb_five">
                                                        <div class="form-group">
                                                            <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
                                                        </div>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <? } else if ($item['loai_thanh_toan'] == 1) {
                                echo "";
                            } ?>
                        </div>
                        <div class="form-button w_100">
                            <div class="form_button phieu_button">
                                <button type="button" class="cancel_add share_cursor mb_10 share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                <button type="button" class="save_add share_cursor mb_10 share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa phiếu thanh toán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex phieu_dy_pop">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".all_nhacc, .all_hd_dh").select2({
        width: '100%',
    });

    $(".all_hd_dh").change(function() {
        var loai_phieu = $(".loai_phieu").val();
        var hd_dh = $(this).val();
        var com_id = $(".loai_phieu").attr("data");
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        var loai_tt = $(".loai_thanh_toan").val();
        $.ajax({
            url: '../render/sua_hs_phieu_tt.php',
            type: 'POST',
            data: {
                loai_phieu: loai_phieu,
                hd_dh: hd_dh,
                com_id: com_id,
                id_phieu: id_phieu,
                loai_tt: loai_tt,
            },
            success: function(data) {
                $(".them_moi_vt").html(data);
            }
        });
    });

    $(".all_hthuc").change(function() {
        var hthuc_tt = $(this).val();
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        var loai_phieu = $(".loai_phieu").val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var id_hd_dh = $(".all_hd_dh").val();
        $.ajax({
            url: '../render/hinh_thuc_tt.php',
            type: 'POST',
            data: {
                hthuc_tt: hthuc_tt,
                id_phieu: id_phieu,
                loai_phieu: loai_phieu,
                com_id: com_id,
                id_hd_dh: id_hd_dh,
            },
            success: function(data) {
                if (hthuc_tt == 1) {
                    $(".form-them-nganh .ctie_form_nhang").remove()
                } else if (hthuc_tt == 2 || hthuc_tt == 3) {
                    $(".form-them-nganh").html(data);
                }
            }
        });
    });

    $(".add_ngan_hang").click(function() {
        var html = `<div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                        <div class="form-ctra w_100 float_l">
                            <div class="form-row">
                                <div class="form-group share_form_select">
                                    <label>Tên ngân hàng <span class="cr_red">*</span></label>
                                    <input type="text" name="new_ten_nganh" class="form-control ten_nganhang">
                                </div>
                                <div class="form-group share_form_select">
                                    <label>Chi nhánh <span class="cr_red">*</span></label>
                                    <input type="text" name="new_cnhanh" class="form-control chi_nhanh">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group share_form_select">
                                    <label>Số tài khoản <span class="cr_red">*</span></label>
                                    <input type="text" name="new_so_taik" class="form-control so_taik" oninput="<?= $oninput ?>">
                                </div>
                                <div class="form-group">
                                    <label>Chủ tài khoản </label>
                                    <input type="text" name="new_chu_taik" class="form-control">
                                </div>
                            </div>
                        </div>
                        <span class="remove_tnh ml_50 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
                    </div>`;
        $(".form-them-nganh").append(html);
        CheckSelect();
    });

    function loai_tt_doi(id) {
        var all_ltt = $(id).val();
        var com_id = $(id).attr("data");
        var hd_dh = $(".all_hd_dh").val();
        var loai_phieu = $(".loai_phieu").val();
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        $.ajax({
            url: '../render/loai_thanh_toan.php',
            type: 'POST',
            data: {
                all_ltt: all_ltt,
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
                id_phieu: id_phieu,
            },
            success: function(data) {
                if (hd_dh != "" && loai_phieu != "" && id_phieu != "") {
                    if (all_ltt == 1) {
                        $(".ct_form").html(data);
                        $(".them_moi_vt .ctn_table").remove();
                    } else if (all_ltt == 2) {
                        $(".ct_form .ctn_ct_from").remove();
                        $(".them_moi_vt").html(data);
                    } else {
                        $(".ct_form .ctn_ct_from").remove();
                        $(".them_moi_vt .ctn_table").remove();
                    }
                };
                RefSelect2();
            }
        });
    }

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

    $(".save_add").click(function() {
        var form_validate = $(".form_add_hp_mua");
        form_validate.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                loai_ptt: {
                    required: true,
                },
                hdong_dhang: {
                    required: true,
                },
                hinh_thuc: {
                    required: true,
                },
                so_tien: {
                    required: true,
                },
                ten_nganhang: {
                    required: true,
                },
                chi_nhanh: {
                    required: true,
                },
                so_taik: {
                    required: true,
                }
            },
            messages: {
                loai_ptt: {
                    required: "Không được để trống",
                },
                hdong_dhang: {
                    required: "Không được để trống",
                },
                hinh_thuc: {
                    required: "Không được để trống",
                },
                so_tien: {
                    required: "Không được để trống",
                },
                ten_nganhang: {
                    required: "Không được để trống",
                },
                chi_nhanh: {
                    required: "Không được để trống",
                },
                so_taik: {
                    required: "Không được để trống",
                }
            }
        });
        if (form_validate.valid() === true) {
            var com_id = $(".form_add_hp_mua").attr("data");
            var user_id = $(".form_add_hp_mua").attr("data1");
            var id_phieu = $("input[name='so_phieu']").attr("data");
            var loai_ptt = $("select[name='loai_ptt']").val();
            var hdong_dhang = $("select[name='hdong_dhang']").val();
            var id_ncc_kh = $("input[name='khachh_nhacc']").attr("data");
            var ngay_tt = $("input[name='ngay_ttoan']").val();
            var hinh_thuc_tt = $("select[name='hinh_thuc']").val();
            var lthanh_toan = $("select[name='lthanh_toan']").val();
            var so_tien_tu = $("input[name='so_tien']").val();
            var ty_gia = $("input[name='ty_gia']").val();
            var gia_quy_doi = $("input[name='gia_quy_doi']").val();
            var phi_giaod = $("input[name='phi_giaod']").val();
            var nguoi_ntien = $("input[name='nguoi_ntien']").val();
            var phan_loai = $("input[name='khachh_nhacc']").attr("data1");

            var id_stk = [];
            $("input[name='id_stk']").each(function() {
                var idstk = $(this).val();
                if (idstk != "") {
                    id_stk.push(idstk);
                }
            });

            var ten_nganhang = [];
            $("input[name='ten_nganhang']").each(function() {
                var tnh = $(this).val();
                if (tnh != "") {
                    ten_nganhang.push(tnh);
                }
            });

            var chi_nhanh = [];
            $("input[name='chi_nhanh']").each(function() {
                var cnhanh = $(this).val();
                if (cnhanh != "") {
                    chi_nhanh.push(cnhanh);
                }
            });

            var so_tk = [];
            $("input[name='so_taik']").each(function() {
                var stk = $(this).val();
                if (stk != "") {
                    so_tk.push(stk);
                }
            });

            var chu_tk = [];
            $("input[name='chu_taik']").each(function() {
                var ctk = $(this).val();
                if (ctk != "") {
                    chu_tk.push(ctk);
                } else {
                    ctk = 0;
                    chu_tk.push(ctk);
                }
            });

            var new_tngan_hang = [];
            $("input[name='new_ten_nganh']").each(function() {
                var n_tnh = $(this).val();
                if (n_tnh != "") {
                    new_tngan_hang.push(n_tnh);
                }
            });

            var new_chi_nhanh = [];
            $("input[name='new_cnhanh']").each(function() {
                var n_cnhanh = $(this).val();
                if (n_cnhanh != "") {
                    new_chi_nhanh.push(n_cnhanh);
                }
            });

            var new_so_tk = [];
            $("input[name='new_so_taik']").each(function() {
                var n_stk = $(this).val();
                if (n_stk != "") {
                    new_so_tk.push(n_stk);
                }
            });

            var new_chu_tk = [];
            $("input[name='new_chu_taik']").each(function() {
                var n_ctk = $(this).val();
                if (n_ctk != "") {
                    new_chu_tk.push(n_ctk);
                } else {
                    n_ctk = 0;
                    new_chu_tk.push(n_ctk);
                }
            });

            var id_hs = [];
            $(".ho_so").each(function() {
                var hoso = $(this).attr("data");
                if (hoso != "") {
                    id_hs.push(hoso);
                }
            });

            var tien_ttoan = [];
            $("input[name='so_tien_ctra']").each(function() {
                var tienttoan = $(this).attr("data");
                if (tienttoan != "") {
                    tien_ttoan.push(tienttoan);
                } else if (tienttoan == "") {
                    tienttoan = 0;
                    tien_ttoan.push(tienttoan);
                }
            });

            var tong_tien = [];
            $(".tongtien").each(function() {
                var tongtien = $(this).attr("data");
                if (tongtien != "") {
                    tong_tien.push(tongtien);
                }
            });
            var tongt_thanhtoan = $(".sum_tatca").text();

            var id_ctp = [];
            $(".ho_so").each(function() {
                var idctp = $(this).attr("data1");
                if (idctp != "") {
                    id_ctp.push(idctp);
                }
            });

            $.ajax({
                url: '../ajax/sua_phieu_tt.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
                    id_phieu: id_phieu,
                    loai_ptt: loai_ptt,
                    hdong_dhang: hdong_dhang,
                    id_ncc_kh: id_ncc_kh,
                    ngay_tt: ngay_tt,
                    hinh_thuc_tt: hinh_thuc_tt,
                    lthanh_toan: lthanh_toan,
                    so_tien_tu: so_tien_tu,
                    ty_gia: ty_gia,
                    gia_quy_doi: gia_quy_doi,
                    phi_giaod: phi_giaod,
                    nguoi_ntien: nguoi_ntien,
                    id_stk: id_stk,
                    ten_nganhang: ten_nganhang,
                    chi_nhanh: chi_nhanh,
                    so_tk: so_tk,
                    chu_tk: chu_tk,
                    new_tngan_hang: new_tngan_hang,
                    new_chi_nhanh: new_chi_nhanh,
                    new_so_tk: new_so_tk,
                    new_chu_tk: new_chu_tk,
                    phan_loai: phan_loai,

                    id_hs: id_hs,
                    tien_ttoan: tien_ttoan,
                    tong_tien: tong_tien,
                    tongt_thanhtoan: tongt_thanhtoan,
                    id_ctp: id_ctp,
                },
                success: function(data) {
                    if (data == "") {
                        window.location.href = '/quan-ly-phieu-thanh-toan.html';
                    } else {
                        alert(data);
                    }
                }
            });
        }
    })
</script>

</html>