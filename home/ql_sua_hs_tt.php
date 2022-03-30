<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $com_name = $_SESSION['com_name'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `ho_so_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hs_tt = explode(',', $item_nv['ho_so_tt']);
            if (in_array(3, $hs_tt) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$id = getValue('id', 'int', 'GET', '');

if ($id != "") {
    $list_hs = new db_query("SELECT `id`, `loai_hs`, `id_hd_dh`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`, `trang_thai`,
                            `ngay_tao`, `id_nguoi_lap` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $id ");
    $ho_so = mysql_fetch_assoc($list_hs->result);
    $loai_hs = $ho_so['loai_hs'];
    $id_hd_dh = $ho_so['id_hd_dh'];

    if ($loai_hs == 1) {

        $phan_loai_hd = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `hop_dong` AS h
                                    INNER JOIN `nha_cc_kh` AS n ON h.`id_nha_cc_kh` = n.`id`
                                    WHERE h.`id` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        $ploai_hd = mysql_fetch_assoc($phan_loai_hd->result);

        $tong_tien = mysql_fetch_assoc((new db_query("SELECT `id_du_an_ctrinh`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`
                                                        FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);

        $loai_hd = $ploai_hd['phan_loai'];

        if ($loai_hd == 1) {
            $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];
            $vattu_hd_dh = new db_query("SELECT v.`id_vat_tu`, v.`id_hd_mua_ban`, v.`so_luong`, v.`don_gia`, v.`tien_trvat`, v.`thue_vat`, v.`tien_svat`
                                    FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                                    WHERE v.`id_hd_mua_ban` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        } else if ($loai_hd == 2) {
            $dv_thuc_hien = $com_name;

            $vattu_hd_dh = new db_query("SELECT v.`id_vat_tu`, v.`id_hd_mua_ban`, v.`so_luong`, v.`don_gia`, v.`tien_trvat`, v.`thue_vat`, v.`tien_svat`
                                    FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                                    WHERE v.`id_hd_mua_ban` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        } else if ($loai_hd == 3) {
            $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];

            $vattu_hd_dh = new db_query("SELECT v.`id`, v.`id_hd_thue`, v.`loai_tai_san`, v.`thong_so_kthuat`, v.`so_luong`, v.`thue_tu_ngay`, v.`thue_den_ngay`,
                                        v.`don_vi_tinh`, v.`khoi_luong_du_kien`, v.`han_muc_ca_may`, v.`don_gia_thue`, v.`dg_ca_may_phu_troi`, v.`thanh_tien_du_kien`,
                                        v.`thoa_thuan_khac`
                                        FROM `vat_tu_hd_thue` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_thue` = h.`id`
                                        WHERE v.`id_hd_thue` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        } else if ($list_hd == 4) {
            $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];

            $vattu_hd_dh = new db_query("SELECT v.`id`, v.`vat_tu`, v.`id_hd_vc`, v.`don_vi_tinh`, v.`khoi_luong`, v.`don_gia`, v.`thanh_tien`
                                        FROM `vat_tu_hd_vc` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_vc` = h.`id`
                                        WHERE v.`id_hd_vc` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        }
    } else if ($loai_hs == 2) {

        $phan_loai_dh = new db_query("SELECT d.`phan_loai`, n.`ten_nha_cc_kh` FROM `don_hang` AS d
                                    INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                    WHERE d.`id` = $id_hd_dh AND d.`id_cong_ty` = $com_id ");

        $ploai_dh = mysql_fetch_assoc($phan_loai_dh->result);

        $loai_dh = $ploai_dh['phan_loai'];
        if ($loai_dh == 1) {
            $dv_thuc_hien = $ploai_dh['ten_nha_cc_kh'];
        } else if ($loai_dh == 2) {
            $dv_thuc_hien = $com_name;
        };

        $vattu_hd_dh = new db_query("SELECT `id`, `id_don_hang`, `id_vat_tu`, `so_luong_ky_nay`, `don_gia`, `tong_tien_trvat`,
                                `thue_vat`, `tong_tien_svat` FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_hd_dh AND `id_cong_ty` = $com_id ");
    };
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa hồ sơ thanh toán</title>
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
    <div class="main-container ql_sua_hs_tt ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-ho-so-thanh-toan.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Sửa hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data2="<?= $id ?>" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại hồ sơ thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_hs" class="form-control all_loai_hs">
                                            <option value="">-- Chọn loại hồ sơ thanh toán --</option>
                                            <option value="1" <?= ($loai_hs == 1) ? "selected" : "" ?>>Hồ sơ thanh toán hợp đồng</option>
                                            <option value="2" <?= ($loai_hs == 2) ? "selected" : "" ?>>Hồ sơ thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hd_dh">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                            <? if ($loai_hs == 1) {
                                                $all_hd = new db_query("SELECT `id` FROM `hop_dong` WHERE `id_cong_ty` = $com_id ");
                                                while ($row1 = mysql_fetch_assoc($all_hd->result)) {
                                            ?>
                                                    <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $id_hd_dh) ? "selected" : "" ?>>HĐ - <?= $row1['id'] ?></option>
                                                <? }
                                            } else if ($loai_hs == 2) {
                                                $all_dh = new db_query("SELECT `id` FROM `don_hang` WHERE `id_cong_ty` = $com_id ");
                                                while ($row2 = mysql_fetch_assoc($all_dh->result)) {
                                                ?>
                                                    <option value="<?= $row2['id'] ?>" <?= ($row2['id'] == $id_hd_dh) ? "selected" : "" ?>>ĐH - <?= $row2['id'] ?></option>
                                            <? }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group dv_thuc_hien">
                                        <label>Đơn vị thực hiện <span class="cr_red">*</span></label>
                                        <input type="text" name="dia_chi" value="<?= $dv_thuc_hien ?>" class="form-control" placeholder="Nhập địa chỉ" disabled>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đợt nghiệm thu <span class="cr_red">*</span></label>
                                        <input type="text" name="dot_nthu" value="<?= $ho_so['dot_nghiem_thu'] ?>" class="form-control" placeholder="Nhập đợt nghiệm thu">
                                    </div>
                                    <div class="form-group">
                                        <label>Thời gian nghiệm thu</label>
                                        <input type="date" name="thoig_nthu" value="<?= ($ho_so['tg_nghiem_thu'] != 0) ? date('Y-m-d', $ho_so['tg_nghiem_thu']) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời hạn thanh toán</label>
                                        <input type="date" name="thoih_ttoan" value="<?= ($ho_so['thoi_han_thanh_toan'] != 0) ? date('Y-m-d', $ho_so['thoi_han_thanh_toan']) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="table-wrapper mt-10 them_moi_vt">
                                    <div class="table-container table-3900 ds_vat_tu" data="<?= $user_id ?>">
                                        <!-- <div class="tbl-header">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="w-10" rowspan="2">STT</th>
                                                        <th class="w-20" rowspan="2">Tên vật tư</th>
                                                        <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                                        <th class="w-10" rowspan="2">Xuất xứ</th>
                                                        <th class="w-10" rowspan="2">Đơn vị tính</th>
                                                        <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Đơn hàng</th>
                                                        <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                                        <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                                        <th class="w-5" rowspan="2">% Thực hiện</th>
                                                        <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                                    </tr>
                                                    <tr class="border-top-w">
                                                        <th scope="colgroup">Số lượng</th>
                                                        <th scope="colgroup">Đơn giá(VNĐ)</th>
                                                        <th scope="colgroup">Giá trị(VNĐ)</th>
                                                        <th scope="colgroup">Lũy kế kỳ trước</th>
                                                        <th scope="colgroup">Kỳ này</th>
                                                        <th scope="colgroup">Lũy kế đến nay</th>
                                                        <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                                        <th scope="colgroup">Kỳ này(VNĐ)</th>
                                                        <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                                        <th scope="colgroup">Số lượng</th>
                                                        <th scope="colgroup">Giá trị(VNĐ)</th>

                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tbl-content table-2-row">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="w-10">1</td>
                                                        <td class="w-20">Thép</td>
                                                        <td class="w-10">Vina hey</td>
                                                        <td class="w-10">Việt Nam</td>
                                                        <td class="w-10">Lọ</td>
                                                        <td class="w-10">
                                                            <p>10</p>
                                                        </td>
                                                        <td class="w-10">
                                                            <p>10.000</p>
                                                        </td>
                                                        <td class="w-10">
                                                            <p>100.000</p>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="kl_luy_ke_ky_truoc" value="0" readonly>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="kl_luy_ke_ky_nay">
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="kl_luy_ke_den_nay" value="0" readonly>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="gt_luy_ke_ky_truoc" value="0" readonly>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="gt_luy_ke_ky_nay">
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="gt_luy_ke_den_nay" readonly>
                                                        </td>
                                                        <td class="w-5">
                                                            <input type="text" name="phan_tram_thuc_hien" readonly>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="con_lai_so_luong" readonly>
                                                        </td>
                                                        <td class="w-10">
                                                            <input type="text" name="con_lai_gia_tri" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-ed">
                                                        <td class="w-10 text-bold">Tổng cộng trước VAT</td>
                                                        <td class="w-20"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">100.000</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">90.000</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-5"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                    </tr>
                                                    <tr class="bg-ed">
                                                        <td class="w-10 text-bold">Thuế VAT</td>
                                                        <td class="w-20"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">10.000</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">100.000(2)</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-5"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                    </tr>
                                                    <tr class="bg-ed">
                                                        <td class="w-10 text-bold">Chi phí khác</td>
                                                        <td class="w-20"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">Nhập chi phí khác(3)</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-5"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                    </tr>
                                                    <tr class="bg-ed">
                                                        <td class="w-10 text-bold">Tổng cộng sau VAT</td>
                                                        <td class="w-20"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">10000</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10">Tổng tiền = 1+2+3</td>
                                                        <td class="w-10"></td>
                                                        <td class="w-5"></td>
                                                        <td class="w-10"></td>
                                                        <td class="w-10"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hs_button">
                                        <button type="button" class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hồ sơ thanh toán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hs_dy_pop">
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
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".all_loai_hs, .all_hd_dh").select2({
        width: '100%',
    });

    var com_id = $(".form_add_hp_mua").attr("data");
    var loai_hs = $(".all_loai_hs").val();
    var id_hd_dh = $(".all_hd_dh").val();
    var id_hs = $(".form_add_hp_mua").attr("data2");

    $.ajax({
        url: '../render/ds_vattu_sua_hstt.php',
        type: 'POST',
        data: {
            com_id: com_id,
            id_hs: id_hs,
            loai_hs: loai_hs,
            id_hd_dh: id_hd_dh,
        },
        success: function(data) {
            $(".ds_vat_tu").append(data);
        }
    });

    $(".all_nhacc").change(function() {
        var loai_hs = $(this).val();
        var com_id = $(".form_add_hp_mua").attr("data");

        $.ajax({
            url: '../render/ds_hd_dh.php',
            type: 'POST',
            data: {
                loai_hs: loai_hs,
                com_id: com_id,
            },
            success: function(data) {
                $(".all_hd_dh").html(data);
            }
        });

        $.ajax({
            url: '../render/dv_thuc_hien.php',
            type: 'POST',
            data: {
                loai_hs: loai_hs,
                com_id: com_id,
            },
            success: function(data) {
                $(".dv_thuc_hien").html(data);
            }
        });

        // $.ajax({
        //     url: '../render/ds_vattu_hstt.php',
        //     type: 'POST',
        //     data: {
        //         com_id: com_id,
        //         loai_hs: loai_hs,
        //     },
        //     success: function(data) {
        //         $(".ds_vat_tu").html(data);
        //     }
        // });
    });

    $(".all_hd_dh").change(function() {
        var id_hd_dh = $(this).val();
        var loai_hs = $(".all_nhacc").val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var com_name = $(".form_add_hp_mua").attr("data1");
        var id_hs = $(".form_add_hp_mua").attr("data2");

        $.ajax({
            url: '../render/dv_thuc_hien.php',
            type: 'POST',
            data: {
                dh_hd: id_hd_dh,
                loai_hs: loai_hs,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                $(".dv_thuc_hien").html(data);
            }
        });

        // $.ajax({
        //     url: '../render/ds_vattu_sua_hstt.php',
        //     type: 'POST',
        //     data: {
        //         com_id: com_id,
        //         id_hs: id_hs,
        //         loai_hs: loai_hs,
        //         id_hd_dh: id_hd_dh,
        //     },
        //     success: function(data) {
        //         $(".").html(data);
        //     }
        // });
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
                loai_hs: {
                    required: true,
                },
                hdong_dhang: {
                    required: true,
                },
                dot_nthu: {
                    required: true,
                }
            },
            messages: {
                loai_hs: {
                    required: "Không được để trống",
                },
                hdong_dhang: {
                    required: "Không được để trống",
                },
                dot_nthu: {
                    required: "Không được để trống",
                }
            }
        });
        if (form_validate.valid() === true) {
            var loai_hs = $("select[name='loai_hs']").val();
            var hdong_dhang = $("select[name='hdong_dhang']").val();
            var dot_nthu = $("input[name='dot_nthu']").val();
            var thoig_nthu = $("input[name='thoig_nthu']").val();
            var thoih_ttoan = $("input[name='thoih_ttoan']").val();
            var com_id = $(".form_add_hp_mua").attr("data");
            var user_id = $(".form_add_hp_mua").attr("data1");
            var id_hs = $(".form_add_hp_mua").attr("data2");

            var id_hs_ct = [];
            $(".vat_tu_hs").each(function() {
                var idct_hs = $(this).attr("data");
                if (idct_hs != "") {
                    id_hs_ct.push(idct_hs);
                }
            });

            var id_vt = [];
            $(".vat_tu_dh").each(function() {
                var idvt = $(this).attr("data");
                if (idvt != "") {
                    id_vt.push(idvt);
                }
            });

            var kl_kn = [];
            $("input[name='kl_luy_ke_ky_nay']").each(function() {
                var klkn = $(this).val();
                if (klkn != "") {
                    kl_kn.push(klkn);
                } else {
                    klkn = 0;
                    kl_kn.push(klkn);
                }
            });

            var gia_tri_kn = [];
            $("input[name='gt_luy_ke_ky_nay']").each(function() {
                var giatri = $(this).val();
                if (giatri != "") {
                    gia_tri_kn.push(giatri);
                } else {
                    giatri = 0;
                    gia_tri_kn.push(giatri);
                }
            });

            var tien_trvat = $(".tong_tien_ky_nay").text();
            var tien_thue = $(".thue_ky_nay").text();
            console.log(tien_thue);
            var chi_phi_khac = $("input[name='chi_phi_khac']").val();
            var tien_svat = $(".tong_tatca").text();

            $.ajax({
                url: '../ajax/sua_hs_tt.php',
                type: 'POST',
                data: {
                    id_hs: id_hs,
                    com_id: com_id,
                    user_id: user_id,
                    loai_hs: loai_hs,
                    hdong_dhang: hdong_dhang,
                    dot_nthu: dot_nthu,
                    thoig_nthu: thoig_nthu,
                    thoih_ttoan: thoih_ttoan,
                    id_hs_ct: id_hs_ct,
                    id_vt: id_vt,
                    kl_kn: kl_kn,
                    gia_tri_kn: gia_tri_kn,
                    tien_trvat: tien_trvat,
                    tien_thue: tien_thue,
                    chi_phi_khac: chi_phi_khac,
                    tien_svat: tien_svat,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn cập nhật hồ sơ thanh toán thành công");
                        window.location.href = '/quan-ly-ho-so-thanh-toan.html';
                    } else if (data != "") {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>