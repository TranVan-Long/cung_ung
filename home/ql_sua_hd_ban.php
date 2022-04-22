<?php
include "../includes/icon.php";
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $role = 1;
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $list_vt = json_decode($response, true);
    $vat_tu_data = $list_vt['data']['items'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $role = 2;
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $list_vt = json_decode($response, true);
    $vat_tu_data = $list_vt['data']['items'];

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `hop_dong` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $hop_dong2 = explode(',', $item_nv['hop_dong']);
        if (in_array(3, $hop_dong2) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
}

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = '" . $hd_id . "' ");
    $get_vt_ban = new db_query("SELECT * FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);
}

$id_kh = $hd_detail['id_nha_cc_kh'];

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response1 = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response1, true);
$vat_tu_data = $list_vt['data']['items'];

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa hợp đồng bán</title>
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
    <div class="main-container ql-sua-hd-ban">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content ">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-chi-tiet-hop-dong-ban-<?= $hd_id ?>.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Sửa hợp đồng bán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>" data3="<?= $hd_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" value="HĐ - <?= $hd_id ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= (!empty($hd_detail['ngay_ky_hd'])) ? date('Y-m-d', $hd_detail['ngay_ky_hd']) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Khách hàng <span class="cr_red">*</span></label>
                                        <select name="id_khach_hang" class="form-control all_nhacc">
                                            <option value="">-- Chọn khách hàng --</option>
                                            <?
                                            $get_kh = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ORDER BY `id` DESC ");
                                            while ($kh_fetch = mysql_fetch_assoc($get_kh->result)) {
                                            ?>
                                                <option value="<?= $kh_fetch['id'] ?>" <?= ($id_kh == $kh_fetch['id']) ? "selected" : "" ?>><?= $kh_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="hd_nguyen_tac">Hợp đồng nguyên tắc</label>
                                        <input type="checkbox" name="hd_nguyen_tac" id="hd_nguyen_tac" <?= ($hd_detail['hd_nguyen_tac'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="number" name="truoc_vat" id="tong_truoc_vat" value="<?= $hd_detail['gia_tri_trvat'] ?>" class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" id="don_gia_vat" name="don_gia_vat" <?= ($hd_detail['bao_gom_vat'] == 1) ? "checked" : "" ?> onclick="dongia_vat(this)">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thuế suất VAT</label>
                                        <input type="number" name="thue_vat" value="<?= $hd_detail['thue_vat'] ?>" class="form-control thue_vat_tong" placeholder="Nhập thuế suất VAT" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="number" name="sau_vat" value="<?= $hd_detail['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control cr_weight h_border" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời gian thực hiện</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" value="<?= (!empty($hd_detail['tg_bd_thuc_hien'])) ? date('Y-m-d', $hd_detail['tg_bd_thuc_hien']) : "" ?>" class="gia_tri">
                                            <span>đến</span>
                                            <input type="date" name="ngay_ket_thuc" value="<?= (!empty($hd_detail['tg_kt_thuc_hien'])) ? date('Y-m-d', $hd_detail['tg_kt_thuc_hien']) : "" ?>" class="gia_tri">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="bao_gom_van_chuyen">Hợp đồng đã bao gồm vận chuyển</label>
                                        <input type="checkbox" name="bao_gom_van_chuyen" id="bao_gom_van_chuyen" <?= ($hd_detail['bgom_vchuyen'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Yêu cầu về tiến độ</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nhập yêu cầu về tiến độ"><?= $hd_detail['yc_tien_do'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noi_dung_hd" rows="5" class="form-control" placeholder="Nhập nội dung hợp đồng"><?= $hd_detail['noi_dung_hd'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noi_dung_luu_y" rows="5" class="form-control" placeholder="Nhập nội dung cần lưu ý"><?= $hd_detail['noi_dung_luu_y'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieu_khoan_tt" rows="5" class="form-control" placeholder="Nhập điều khoản thanh toán"><?= $hd_detail['dieu_khoan_tt'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group autocomplete">
                                        <label>Tên ngân hàng</label>
                                        <input type="text" name="ten_nh" id="ten_nh" value="<?= $hd_detail['ten_ngan_hang'] ?>" class="form-control" autocomplete="off" placeholder="Nhập tên ngân hàng">
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="number" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor" id="add_vat_tu">+ Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_three">Vật tư thiết bị</th>
                                                    <th class="share_tb_two">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_two">Xuất xứ</th>
                                                    <th class="share_tb_two">Số lượng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_two">Thuế VAT</th>
                                                    <th class="share_tb_two">Tổng tiền sau VAT</th>
                                                </tr>
                                            </thead>
                                            <tbody id="vt_hd_ban">
                                                <?
                                                while ($vt_ban_fetch = mysql_fetch_assoc($get_vt_ban->result)) {
                                                ?>
                                                    <tr class="item" data="<?= $vt_ban_fetch['id'] ?>">
                                                        <td class="share_tb_one">
                                                            <p class="modal-btn" data-target="xoa-vt-<?= $vt_ban_fetch['id'] ?>"><i class="ic-delete remove-btn"></i></p>
                                                            <input type="hiden" name="id_vt_ban_old" value="<?= $vt_ban_fetch['id'] ?>" class="share_dnone">
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group share_form_select">
                                                                <select name="ma_vt_ban_old" class="ma_vt_ban share_select" onchange="hd_vt_change(this)">
                                                                    <option value="">-- Chọn Vật tư --</option>
                                                                    <? foreach ($vat_tu_detail as $key => $items) { ?>
                                                                        <option value="<?= $items['dsvt_id'] ?>" <?= ($items['dsvt_id'] == $vt_ban_fetch['id_vat_tu']) ? "selected" : "" ?>><?= $items['dsvt_name'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vat_tu_detail[$vt_ban_fetch['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="hang_san_xuat_old" value="<?= $vat_tu_detail[$vt_ban_fetch['id_vat_tu']]['hsx_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="xuat_xu_old" value="<?= $vat_tu_detail[$vt_ban_fetch['id_vat_tu']]['xx_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_old" value="<?= $vt_ban_fetch['so_luong'] ?>" class="form-control so_luong" onkeyup="check_slnhap(this),sl_doi(this),tong_vt()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_old" value="<?= $vt_ban_fetch['don_gia'] ?>" class="form-control don_gia" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_tien_tvat_old" value="<?= $vt_ban_fetch['tien_trvat'] ?>" class="form-control tong_trvat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_thue_vat_old" value="<?= $vt_ban_fetch['thue_vat'] ?>" data="" class="form-control thue_vat" onkeyup="thue_doi(this),tong_vt()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="vt_tien_svat_old" value="<?= $vt_ban_fetch['tien_svat'] ?>" class="form-control tong_svat" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="xoa-vt-<?= $vt_ban_fetch['id'] ?>">
                                                        <div class="m-content">
                                                            <div class="m-head ">
                                                                Thông báo <span class="dismiss cancel">&times;</span>
                                                            </div>
                                                            <div class="m-body">
                                                                <p>Bạn có chắc chắn muốn xóa vật tư/thiết bị này?</p>
                                                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                            </div>
                                                            <div class="m-foot d-inline-block">
                                                                <div class="left mb_10">
                                                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                                </div>
                                                                <div class="right mb_10">
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right xoa_vt_tb" data-id="<?= $vt_ban_fetch['id'] ?>" onclick="tong_vt(),baoLanh(),baoHanh()">Đồng ý</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
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
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hợp đồng bán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hd_dy_pop">
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
<script type="text/javascript" src="../js/bank-name.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

<script>
    $(document).on('click', '.remo_cot_ngang, .remove-btn', function() {
        tong_vt();
        baoLanh();
        baoHanh();
    })
    $(document).ready(function() {
        // var dongiavat = $("#don_gia_vat").val();
        if ($("#don_gia_vat").is(":checked")) {
            $(".thue_vat").attr("readonly", true);
        }
    })
    // autocomplete(document.getElementById("ten_nh"), bank);

    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia").select2({
        width: '100%',
    });
    $("#add_vat_tu").click(function() {
        var com_id = <?= $com_id ?>;
        $.ajax({
            url: '../ajax/hd_them_vt.php',
            type: 'POST',
            data: {
                id_com: com_id,
            },
            success: function(data) {
                $('#vt_hd_ban').append(data);
                RefSelect2();
            }
        });
    });

    function hd_vt_change(id) {
        var id_vt = $(id).val();
        var _this = $(id);
        var id_v = _this.parents(".item").attr("data");
        var com_id = <?= $com_id ?>;
        $.ajax({
            url: '../render/hd_vat_tu.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_v: id_v,
                id_com: com_id,
            },
            success: function(data) {
                _this.parents(".item").html(data);
                RefSelect2();
            }
        });

    };

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".xoa_vt_tb").click(function() {

        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/hd_ban_xoa_vt.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert(data);
                }
            }
        });
    });

    $(".save_add").click(function() {
        var form_add_mua = $(".form_add_hp_mua");
        form_add_mua.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky: {
                    required: true,
                },
                khach_hang: {
                    required: true,
                }
            },
            messages: {
                ngay_ky: {
                    required: "Không được để trống",
                },
                khach_hang: {
                    required: "Không được để trống",
                }
            },
        });

        if (form_add_mua.valid() === true) {
            var hd_id = $(".form_add_hp_mua").attr("data3");
            var user_id = $(".form_add_hp_mua").attr("data2");
            var com_id = $(".form_add_hp_mua").attr("data1");
            var role = $(".form_add_hp_mua").attr("data");

            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_khach_hang = $("select[name='id_khach_hang']").val();
            var hd_nguyen_tac = 0;
            if ($("input[name='hd_nguyen_tac']").is(":checked")) {
                hd_nguyen_tac = 1;
            }
            var truoc_vat = $("input[name='truoc_vat']").val();
            var don_gia_vat = 0;
            if ($("input[name='don_gia_vat']").is(":checked")) {
                don_gia_vat = 1;
            }
            var thue_vat = $("input[name='thue_vat']").val();
            var sau_vat = $("input[name='sau_vat']").val();
            var ngay_bat_dau = $("input[name='ngay_bat_dau']").val();
            var ngay_ket_thuc = $("input[name='ngay_ket_thuc']").val();
            var bao_gom_van_chuyen = 0
            if ($("input[name='bao_gom_van_chuyen']").is(":checked")) {
                bao_gom_van_chuyen = 1;
            }
            var yc_tiendo = $("textarea[name='yc_tiendo']").val();
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();

            //old
            var vt_id_vat_tu_old = new Array();
            $("input[name='id_vt_ban_old']").each(function() {
                var id_vat_tu_old = $(this).val();
                if (id_vat_tu_old != "") {
                    vt_id_vat_tu_old.push(id_vat_tu_old);
                }
            });
            var vt_vat_tu_old = new Array();
            $("select[name='ma_vt_ban_old']").each(function() {
                var ten_vat_tu_old = $(this).val();
                if (ten_vat_tu_old != "") {
                    vt_vat_tu_old.push(ten_vat_tu_old);
                }
            });
            var vt_so_luong_old = new Array();
            $("input[name='so_luong_old']").each(function() {
                var sl_old = $(this).val();
                if (sl_old != "") {
                    vt_so_luong_old.push(sl_old);
                }
            });
            var vt_don_gia_old = new Array();
            $("input[name='don_gia_old']").each(function() {
                var dg_vat_old = $(this).val();
                if (dg_vat_old != "") {
                    vt_don_gia_old.push(dg_vat_old);
                }
            });
            var vt_tien_tvat_old = new Array();
            $("input[name='vt_tien_tvat_old']").each(function() {
                var vt_tr_vat_old = $(this).val();
                if (vt_tr_vat_old != "") {
                    vt_tien_tvat_old.push(vt_tr_vat_old);
                }
            });
            var vt_thue_vat_old = new Array();
            $("input[name='vt_thue_vat_old']").each(function() {
                var vt_vat_old = $(this).val();
                if (vt_vat_old != "") {
                    vt_thue_vat_old.push(vt_vat_old);
                }
            });
            var vt_tien_svat_old = new Array();
            $("input[name='vt_tien_svat_old']").each(function() {
                var vt_s_vat_old = $(this).val();
                if (vt_s_vat_old != "") {
                    vt_tien_svat_old.push(vt_s_vat_old);
                }
            });

            //new
            var vt_vat_tu = new Array();
            $("select[name='ma_vt_ban']").each(function() {
                var ten_vat_tu = $(this).val();
                if (ten_vat_tu != "") {
                    vt_vat_tu.push(ten_vat_tu);
                }
            });
            var vt_so_luong = new Array();
            $("input[name='so_luong']").each(function() {
                var sl = $(this).val();
                if (sl != "") {
                    vt_so_luong.push(sl);
                }
            });
            var vt_don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dg_vat = $(this).val();
                if (dg_vat != "") {
                    vt_don_gia.push(dg_vat);
                }
            });
            var vt_tien_tvat = new Array();
            $("input[name='vt_tien_tvat']").each(function() {
                var vt_tr_vat = $(this).val();
                if (vt_tr_vat != "") {
                    vt_tien_tvat.push(vt_tr_vat);
                }
            });
            var vt_thue_vat = new Array();
            $("input[name='vt_thue_vat']").each(function() {
                var vt_vat = $(this).val();
                if (vt_vat != "") {
                    vt_thue_vat.push(vt_vat);
                }
            });
            var vt_tien_svat = new Array();
            $("input[name='vt_tien_svat']").each(function() {
                var vt_s_vat = $(this).val();
                if (vt_s_vat != "") {
                    vt_tien_svat.push(vt_s_vat);
                }
            });

            if (ngay_bat_dau != "" && ngay_ket_thuc != "") {
                if (ngay_bat_dau > ngay_ky_hd) {
                    alert("Thời gian bắt đầu phửi lớn hơn ngày ký hợp đồng");
                } else if (ngay_bat_dau > ngay_ket_thuc) {
                    alert("Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc");
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau <= ngay_ket_thuc) {
                    $.ajax({
                        url: '../ajax/hd_ban_sua.php',
                        type: 'POST',
                        data: {
                            user_id: user_id,
                            com_id: com_id,
                            hd_id: hd_id,
                            role: role,
                            ngay_ky_hd: ngay_ky_hd,
                            id_khach_hang: id_khach_hang,
                            hd_nguyen_tac: hd_nguyen_tac,
                            truoc_vat: truoc_vat,
                            don_gia_vat: don_gia_vat,
                            thue_vat: thue_vat,
                            sau_vat: sau_vat,
                            ngay_bat_dau: ngay_bat_dau,
                            ngay_ket_thuc: ngay_ket_thuc,
                            bao_gom_van_chuyen: bao_gom_van_chuyen,
                            yc_tiendo: yc_tiendo,
                            noi_dung_hd: noi_dung_hd,
                            noi_dung_luu_y: noi_dung_luu_y,
                            dieu_khoan_tt: dieu_khoan_tt,
                            ten_nh: ten_nh,
                            so_taik: so_taik,

                            vt_id_vat_tu_old: vt_id_vat_tu_old,
                            vt_vat_tu_old: vt_vat_tu_old,
                            vt_so_luong_old: vt_so_luong_old,
                            vt_don_gia_old: vt_don_gia_old,
                            vt_tien_tvat_old: vt_tien_tvat_old,
                            vt_thue_vat_old: vt_thue_vat_old,
                            vt_tien_svat_old: vt_tien_svat_old,

                            vt_vat_tu: vt_vat_tu,
                            vt_so_luong: vt_so_luong,
                            vt_don_gia: vt_don_gia,
                            vt_tien_tvat: vt_tien_tvat,
                            vt_thue_vat: vt_thue_vat,
                            vt_tien_svat: vt_tien_svat,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Chỉnh sửa hợp đồng bán vật tư thành công!");
                                window.location.href = 'quan-ly-chi-tiet-hop-dong-ban-<?= $hd_id ?>.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                }
            }
        }
    });
</script>

</html>