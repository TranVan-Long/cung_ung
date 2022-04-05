<?php
include "../includes/icon.php";
include("config.php");
$date = date('m-d-Y', time());
$com_id = "";
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $role = 1;
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $role = 2;
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

    $ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
    $id_ncc = $hd_detail['id_nha_cc_kh'];
    $du_an_ctr = $hd_detail['id_du_an_ctrinh'];
    $ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
    $ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);
    $hinh_thuc_hd = $hd_detail['hinh_thuc_hd'];
    $thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);
    $id_bao_gia = $hd_detail['id_bao_gia'];
} else {
    header('Location: /quan-ly-trang-chu.html');
}



$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_ct = json_decode($response, true);
$cong_trinh_data = $list_ct['data']['items'];

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa hợp đồng mua</title>
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
    <div class="main-container ql_ctiet_hd">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one mb_20 share_clr_one" href="quan-ly-chi-tiet-hop-dong-mua-<?= $hd_id ?>.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_one cr_weight_bold mb_20">Chỉnh sửa hợp
                            đồng mua</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" value="HĐ - <?= $hd_id ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= $ngay_hop_dong ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <select id="id_nha_cung_cap" name="id_nha_cung_cap" class="form-control all_nhacc" data="<?= $com_id ?>">
                                            <option value="">-- Chọn nhà cung cấp --</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_ncc == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="id_cong_trinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $du_an_ctr) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="hd_nguyen_tac">Hợp đồng nguyên tắc</label>
                                        <input type="checkbox" name="hd_nguyen_tac" id="hd_nguyen_tac" <?= ($hd_detail['hd_nguyen_tac'] == 1) ? "checked" : "" ?>>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Hình thức hợp đồng</label>
                                        <select name="hinh_thuc" class="form-control all_hthuc_hd">
                                            <option value="">-- Chọn hình thức hợp đồng --</option>
                                            <option value="1" <?= ($hinh_thuc_hd == 1) ? "selected" : "" ?>>Hợp đồng trọn gói</option>
                                            <option value="2" <?= ($hinh_thuc_hd == 2) ? "selected" : "" ?>>Hợp đồng theo đơn giá cố định</option>
                                            <option value="3" <?= ($hinh_thuc_hd == 3) ? "selected" : "" ?>>Hợp đồng theo đơn giá điều chỉnh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="truoc_vat" id="tong_truoc_vat" value="<?= $hd_detail['gia_tri_trvat'] ?>" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" id="don_gia_vat" name="don_gia_vat" <?= ($hd_detail['bao_gom_vat'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thuế suất VAT</label>
                                        <input type="text" name="thue_vat" value="<?= $hd_detail['thue_vat'] ?>" class="form-control thue_vat_tong" onkeyup="tong_vt()" placeholder="Nhập thuế suất VAT">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiền chiết khấu</label>
                                        <input type="number" name="tien_chiet_khau" value="<?= $hd_detail['tien_chiet_khau'] ?>" class="form-control" placeholder="Nhập số tiền chiết khấu">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="sau_vat" value="<?= $hd_detail['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="bao_hanh" onkeyup="baoHanh()" value="<?= $hd_detail['giu_lai_bhanh'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_hanh">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="number" name="gt_bao_hanh" value="<?= $hd_detail['gia_tri_bhanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bh" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Bảo lãnh thực hiện hợp đồng</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="bao_lanh" onkeyup="baoLanh()" value="<?= $hd_detail['bao_lanh_hd'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_lanh">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="number" name="gt_bao_lanh" value="<?= $hd_detail['gia_tri_blanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bl" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn bảo lãnh</label>
                                        <input type="date" name="han_bao_lanh" value="<?= $thoi_han_bl ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời gian thực hiện</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" value="<?= $ngay_bat_dau ?>" class="gia_tri gr_padd share_fsize_tow">
                                            <span>đến</span>
                                            <input type="date" name="ngay_ket_thuc" value="<?= $ngay_ket_thuc ?>" class="gia_tri gr_padd share_fsize_tow">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="bao_gom_van_chuyen">Hợp đồng đã bao gồm vận chuyển</label>
                                        <input type="checkbox" id="bao_gom_van_chuyen" name="bao_gom_van_chuyen" <?= ($hd_detail['bgom_vchuyen'] == 1) ? "checked" : "" ?>>
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
                                        <input type="text" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Báo giá</label>
                                        <select id="bao_gia" name="bao_gia" class="form-control bao_gia" data="<?= $com_id ?>">
                                            <option value="">-- Chọn phiếu báo giá --</option>
                                            <?
                                            $get_bg = new db_query("SELECT * FROM `bao_gia`  WHERE `id_nha_cc` = $id_ncc");
                                            while ($bg_fetch = mysql_fetch_assoc($get_bg->result)) {
                                            ?>
                                                <option value="<?= $bg_fetch['id'] ?>" <?= ($id_ncc == $bg_fetch['id_nha_cc']) ? "selected" : "" ?>> BG - <?= $bg_fetch['id'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Thỏa thuận hóa đơn</label>
                                    <textarea name="tt_hoa_don" rows="5" class="form-control" placeholder="Nhập thỏa thuận hóa đơn"><?= $hd_detail['thoa_tuan_hoa_don'] ?></textarea>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm
                                        mới vật tư</p>
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
                                            <tbody id="vat_tu_thiet_bi">
                                                <?
                                                $get_vt_mua = new db_query("SELECT * FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $hd_id");
                                                while ($vt_mua_fetch = mysql_fetch_assoc($get_vt_mua->result)) {
                                                ?>
                                                    <tr class="item" data="<?= $vt_mua_fetch['id'] ?>">
                                                        <td class="share_tb_one">
                                                            <p class="modal-btn" data-target="xoa-vt-<?= $vt_mua_fetch['id'] ?>"><i class="ic-delete remove-btn"></i></p>
                                                            <input type="hiden" name="id_vt_ban_old" value="<?= $vt_mua_fetch['id'] ?>" class="share_dnone">
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group share_form_select">
                                                                <select name="ma_vt_ban_old" class="ma_vt_ban share_select" onchange="hd_vt_change(this)">
                                                                    <option value="">-- Chọn Vật tư --</option>
                                                                    <?
                                                                    $list_vt_data = new db_query("SELECT `id_vat_tu` FROM `vat_tu_da_bao_gia` WHERE `id_bao_gia` = $id_bao_gia AND `id_cong_ty` = $com_id");
                                                                    while ($list_vt_fetch = mysql_fetch_assoc($list_vt_data->result)) {
                                                                    ?>
                                                                        <option value="<?= $list_vt_fetch['id_vat_tu'] ?>" <?= ($list_vt_fetch['id_vat_tu'] == $vt_mua_fetch['id_vat_tu']) ? "selected" : "" ?>><?= $vat_tu_detail[$list_vt_fetch['id_vat_tu']]['dsvt_name'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['dvt_name'] ?>" class="form-control" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="hang_san_xuat_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['hsx_name'] ?>" class="form-control" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="xuat_xu_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['xx_name'] ?>" class="form-control" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_old" value="<?= $vt_mua_fetch['so_luong'] ?>" class="form-control so_luong" onkeyup="sl_doi(this),tong_vt()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_old" value="<?= $vt_mua_fetch['don_gia'] ?>" class="form-control don_gia" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_tien_tvat_old" value="<?= $vt_mua_fetch['tien_trvat'] ?>" class="form-control tong_trvat" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_thue_vat_old" value="<?= $vt_mua_fetch['thue_vat'] ?>" class="form-control thue_vat" onkeyup="thue_doi(this),tong_vt()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="vt_tien_svat_old" value="<?= $vt_mua_fetch['tien_svat'] ?>" class="form-control tong_svat" disabled>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="xoa-vt-<?= $vt_mua_fetch['id'] ?>">
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
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right xoa_vt_tb" data-id="<?= $vt_mua_fetch['id'] ?>" onclick="tong_vt(),baoLanh(),baoHanh()">Đồng ý</button>
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
                                        <button type="button" class="cancel_add mb_10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add mb_10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hợp đồng mua?</p>
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
    $(window).on("load", function() {
        tong_vt();
        baoLanh();
        baoHanh();
    });
    $(document).on('click', '.remo_cot_ngang, .remove-btn', function() {
        tong_vt();
        baoLanh();
        baoHanh();
    })
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia").select2({
        width: '100%',
    });

    $(".all_hthuc_hd").select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
    })
    autocomplete(document.getElementById("ten_nh"), bank);

    function hd_vt_change(id) {
        var id_p = $("#bao_gia").val();
        var id_vt = $(id).val();
        var id_v = $(id).parents(".item").attr("data");
        var com_id = $(".form_add_hp_mua").attr("data");
        $.ajax({
            url: '../render/hd_mua_vat_tu.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_v: id_v,
                id_com: com_id,
                id_p: id_p,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });
    };
    $("#id_nha_cung_cap").change(function() {
        var com_id = $(this).attr("data");
        var id_ncc = $(this).val();
        $.ajax({
            url: '../render/hd_mua_ds_bg.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_ncc: id_ncc,
            },
            success: function(data) {
                $("#bao_gia").html(data);
            }
        });
    });

    $('.add_vat_tu').click(function() {
        var id_p = $("#bao_gia").val();
        var id_ncc = $("#id_nha_cung_cap").val();
        var com_id = <?= $com_id ?>;
        $.ajax({
            url: '../ajax/hd_mua_them_vt.php',
            type: 'POST',
            data: {
                id_com: com_id,
                id_p: id_p,
                id_ncc: id_ncc
            },
            success: function(data) {
                $("#vat_tu_thiet_bi").append(data);
                RefSelect2();
            }
        });
    });

    $('#bao_gia').change(function() {
        var id_p = $("#bao_gia").val();
        var id_ncc = $("#id_nha_cung_cap").val();
        var com_id = <?= $com_id ?>;
        var id_vt = new Array();
        $("input[name='id_vt_ban_old'").each(function() {
            var id_vt_cu = $(this).val();
            if (id_vt_cu != "") {
                id_vt.push(id_vt_cu);
            }
        });
        $.ajax({
            url: '../ajax/hd_mua_sua_xoa_vt.php',
            type: 'POST',
            data: {
                id: id_vt,
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

    $('.xoa_vt_tb').click(function() {
        var id_v = $(this).attr('data-id');
        $.ajax({
            url: '../ajax/hd_ban_xoa_vt.php',
            type: 'POST',
            data: {
                id: id_v,
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

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
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
                nha_ccap: {
                    required: true,
                },
                dan_ctrinh: {
                    required: true,
                }
            },
            messages: {
                ngay_ky: {
                    required: "Không được để trống",
                },
                nha_ccap: {
                    required: "Không được để trống",
                },
                dan_ctrinh: {
                    required: "Không được để trống",
                }
            },
        });

        if (form_add_mua.valid() === true) {
            var user_id = $(".form_add_hp_mua").attr("data2");
            var com_id = $(".form_add_hp_mua").attr("data1");
            var role = $(".form_add_hp_mua").attr("data");

            var hd_id = <?= $hd_id ?>;
            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_nha_cung_cap = $("select[name='id_nha_cung_cap']").val();
            var dan_ctrinh = $("select[name='id_cong_trinh']").val();
            var hd_nguyen_tac = 0;
            if ($("input[name='hd_nguyen_tac']").is(":checked")) {
                hd_nguyen_tac = 1;
            }
            var hinh_thuc = $("select[name='hinh_thuc']").val();
            var truoc_vat = $("input[name='truoc_vat']").val();
            var don_gia_vat = 0;
            if ($("input[name='don_gia_vat']").is(":checked")) {
                don_gia_vat = 1;
            }
            var thue_vat = $("input[name='thue_vat']").val();
            var chiet_khau = $("input[name='tien_chiet_khau']").val();
            var sau_vat = $("input[name='sau_vat']").val();
            var bao_hanh = $("input[name='bao_hanh']").val();
            var gt_bao_hanh = $("input[name='gt_bao_hanh']").val();
            var bao_lanh = $("input[name='bao_lanh']").val();
            var gt_bao_lanh = $("input[name='gt_bao_lanh']").val();
            var han_bao_lanh = $("input[name='han_bao_lanh']").val();
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
            var bao_gia = $("select[name='bao_gia']").val();
            var tthuan_hdon = $("textarea[name='tt_hoa_don']").val();



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

            $.ajax({
                url: '../ajax/hd_mua_sua.php',
                type: 'POST',
                data: {
                    user_id: user_id,
                    com_id: com_id,
                    role: role,

                    hd_id: hd_id,
                    ngay_ky_hd: ngay_ky_hd,
                    id_nha_cung_cap: id_nha_cung_cap,
                    dan_ctrinh: dan_ctrinh,
                    hd_nguyen_tac: hd_nguyen_tac,
                    hinh_thuc: hinh_thuc,
                    truoc_vat: truoc_vat,
                    don_gia_vat: don_gia_vat,
                    thue_vat: thue_vat,
                    chiet_khau: chiet_khau,
                    sau_vat: sau_vat,
                    bao_hanh: bao_hanh,
                    gt_bao_hanh: gt_bao_hanh,
                    bao_lanh: bao_lanh,
                    gt_bao_lanh: gt_bao_lanh,
                    han_bao_lanh: han_bao_lanh,
                    ngay_bat_dau: ngay_bat_dau,
                    ngay_ket_thuc: ngay_ket_thuc,
                    bao_gom_van_chuyen: bao_gom_van_chuyen,
                    yc_tiendo: yc_tiendo,
                    noi_dung_hd: noi_dung_hd,
                    noi_dung_luu_y: noi_dung_luu_y,
                    dieu_khoan_tt: dieu_khoan_tt,
                    ten_nh: ten_nh,
                    so_taik: so_taik,
                    bao_gia: bao_gia,
                    tthuan_hdon: tthuan_hdon,

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
                        alert("Sửa hợp đồng mua vật tư thành công!");
                        window.location.href = 'quan-ly-chi-tiet-hop-dong-mua-<?= $hd_id ?>.html';
                    } else {
                        alert(data);
                    }
                }
            })

        }
    });
</script>

</html>