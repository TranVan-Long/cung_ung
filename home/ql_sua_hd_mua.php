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
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = $hd_id AND `id_cong_ty` = $com_id ");
    $get_vt_ban = new db_query("SELECT * FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);
    $thue1 = $hd_detail['thue_vat'];
    $ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
    $id_ncc = $hd_detail['id_nha_cc_kh'];
    $du_an_ctr = $hd_detail['id_du_an_ctrinh'];

    if ($hd_detail['tg_bd_thuc_hien'] != 0 && $hd_detail['tg_bd_thuc_hien'] != "") {
        $ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
    } else {
        $ngay_bat_dau = "";
    }

    if ($hd_detail['tg_kt_thuc_hien'] != 0) {
        $ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);
    } else {
        $ngay_ket_thuc = "";
    }

    $hinh_thuc_hd = $hd_detail['hinh_thuc_hd'];

    if ($hd_detail['thoi_han_blanh'] != 0) {
        $thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);
    } else {
        $thoi_han_bl = "";
    }

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
$token = $_COOKIE['acc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
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
    <title>Ch???nh s???a h???p ?????ng mua</title>
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
                            Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_one cr_weight_bold mb_20">Ch???nh s???a h???p
                            ?????ng mua</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? h???p ?????ng</label>
                                        <input type="text" name="so_hd" value="H?? - <?= $hd_id ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ng??y k?? h???p ?????ng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= $ngay_hop_dong ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nh?? cung c???p <span class="cr_red">*</span></label>
                                        <select id="id_nha_cung_cap" name="id_nha_cung_cap" class="form-control all_nhacc" data="<?= $com_id ?>">
                                            <option value="">-- Ch???n nh?? cung c???p --</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_ncc == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>D??? ??n / C??ng tr??nh</label>
                                        <select name="id_cong_trinh" class="form-control all_da_ct">
                                            <option value="">-- Ch???n D??? ??n / C??ng tr??nh --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $du_an_ctr) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="hd_nguyen_tac">H???p ?????ng nguy??n t???c</label>
                                        <input type="checkbox" name="hd_nguyen_tac" id="hd_nguyen_tac" <?= ($hd_detail['hd_nguyen_tac'] == 1) ? "checked" : "" ?>>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>H??nh th???c h???p ?????ng</label>
                                        <select name="hinh_thuc" class="form-control all_hthuc_hd">
                                            <option value="">-- Ch???n h??nh th???c h???p ?????ng --</option>
                                            <option value="1" <?= ($hinh_thuc_hd == 1) ? "selected" : "" ?>>H???p ?????ng tr???n g??i</option>
                                            <option value="2" <?= ($hinh_thuc_hd == 2) ? "selected" : "" ?>>H???p ?????ng theo ????n gi?? c??? ?????nh</option>
                                            <option value="3" <?= ($hinh_thuc_hd == 3) ? "selected" : "" ?>>H???p ?????ng theo ????n gi?? ??i???u ch???nh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? tr?????c VAT</label>
                                        <input type="text" name="truoc_vat" id="tong_truoc_vat" value="<?= $hd_detail['gia_tri_trvat'] ?>" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">????n gi?? ???? bao g???m VAT</label>
                                        <input type="checkbox" id="don_gia_vat" name="don_gia_vat" <?= ($hd_detail['bao_gom_vat'] == 1) ? "checked" : "" ?> onclick="dongia_vat(this)">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thu??? su???t VAT</label>
                                        <input type="number" name="thue_vat" value="<?= $thue1 ?>" class="form-control thue_vat_tong" placeholder="Thu??? su???t VAT" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ti???n chi???t kh???u</label>
                                        <input type="number" name="tien_chiet_khau" value="<?= $hd_detail['tien_chiet_khau'] ?>" class="form-control" placeholder="Nh???p s??? ti???n chi???t kh???u">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? sau VAT</label>
                                        <input type="text" name="sau_vat" value="<?= $hd_detail['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gi??? l???i b???o h??nh</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="bao_hanh" onkeyup="baoHanh()" oninput="<?= $oninput ?>" value="<?= $hd_detail['giu_lai_bhanh'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_hanh">
                                            </div>
                                            <span>t????ng ??????ng</span>
                                            <input type="number" name="gt_bao_hanh" value="<?= $hd_detail['gia_tri_bhanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bh" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>B???o l??nh th???c hi???n h???p ?????ng</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="bao_lanh" oninput="<?= $oninput ?>" onkeyup="baoLanh()" value="<?= $hd_detail['bao_lanh_hd'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_lanh">
                                            </div>
                                            <span>t????ng ??????ng</span>
                                            <input type="number" name="gt_bao_lanh" value="<?= $hd_detail['gia_tri_blanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bl" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Th???i h???n b???o l??nh</label>
                                        <input type="date" name="han_bao_lanh" value="<?= $thoi_han_bl ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Th???i gian th???c hi???n</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" value="<?= $ngay_bat_dau ?>" class="gia_tri gr_padd share_fsize_tow">
                                            <span>?????n</span>
                                            <input type="date" name="ngay_ket_thuc" value="<?= $ngay_ket_thuc ?>" class="gia_tri gr_padd share_fsize_tow">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="bao_gom_van_chuyen">H???p ?????ng ???? bao g???m v???n chuy???n</label>
                                        <input type="checkbox" id="bao_gom_van_chuyen" name="bao_gom_van_chuyen" <?= ($hd_detail['bgom_vchuyen'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Y??u c???u v??? ti???n ?????</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nh???p y??u c???u v??? ti???n ?????"><?= $hd_detail['yc_tien_do'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>N???i dung h???p ?????ng</label>
                                    <textarea name="noi_dung_hd" rows="5" class="form-control" placeholder="Nh???p n???i dung h???p ?????ng"><?= $hd_detail['noi_dung_hd'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>N???i dung c???n l??u ??</label>
                                    <textarea name="noi_dung_luu_y" rows="5" class="form-control" placeholder="Nh???p n???i dung c???n l??u ??"><?= $hd_detail['noi_dung_luu_y'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>??i???u kho???n thanh to??n</label>
                                    <textarea name="dieu_khoan_tt" rows="5" class="form-control" placeholder="Nh???p ??i???u kho???n thanh to??n"><?= $hd_detail['dieu_khoan_tt'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group autocomplete">
                                        <label>T??n ng??n h??ng</label>
                                        <input type="text" name="ten_nh" id="ten_nh" value="<?= $hd_detail['ten_ngan_hang'] ?>" class="form-control" autocomplete="off" placeholder="Nh???p t??n ng??n h??ng">
                                    </div>
                                    <div class="form-group">
                                        <label>S??? t??i kho???n</label>
                                        <input type="text" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nh???p s??? t??i kho???n">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>B??o gi??</label>
                                        <select id="bao_gia" name="bao_gia" class="form-control bao_gia" data="<?= $com_id ?>">
                                            <option value="">-- Ch???n phi???u b??o gi?? --</option>
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
                                    <label>Th???a thu???n h??a ????n</label>
                                    <textarea name="tt_hoa_don" rows="5" class="form-control" placeholder="Nh???p th???a thu???n h??a ????n"><?= $hd_detail['thoa_tuan_hoa_don'] ?></textarea>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Th??m
                                        m???i v???t t??</p>
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_three">V???t t?? thi???t b???</th>
                                                    <th class="share_tb_two">????n v??? t??nh</th>
                                                    <th class="share_tb_two">H??ng s???n xu???t</th>
                                                    <th class="share_tb_two">Xu???t x???</th>
                                                    <th class="share_tb_two">S??? l?????ng</th>
                                                    <th class="share_tb_two">????n gi??</th>
                                                    <th class="share_tb_two">T???ng ti???n tr?????c VAT</th>
                                                    <th class="share_tb_two">Thu??? VAT</th>
                                                    <th class="share_tb_two">T???ng ti???n sau VAT</th>
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
                                                                <select name="ma_vt_ban_old" class="ma_vt_ban share_select" onchange="hd_vt_change(this)" data="<?= $com_id ?>">
                                                                    <option value="">-- Ch???n V???t t?? --</option>
                                                                    <?
                                                                    for ($i = 0; $i < count($vat_tu_data); $i++) {
                                                                    ?>
                                                                        <option value="<?= $vat_tu_data[$i]['dsvt_id'] ?>" <?= ($vt_mua_fetch['id_vat_tu'] == $vat_tu_data[$i]['dsvt_id']) ? "selected" : "" ?>><?= $vat_tu_data[$i]['dsvt_name'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="hang_san_xuat_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['hsx_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="xuat_xu_old" value="<?= $vat_tu_detail[$vt_mua_fetch['id_vat_tu']]['xx_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="so_luong_old" oninput="<?= $oninput ?>" value="<?= $vt_mua_fetch['so_luong'] ?>" class="form-control so_luong" onkeyup="sl_doi(this)">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_old" value="<?= $vt_mua_fetch['don_gia'] ?>" class="form-control don_gia" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_tien_tvat_old" value="<?= $vt_mua_fetch['tien_trvat'] ?>" class="form-control tong_trvat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="vt_thue_vat_old" value="<?= $vt_mua_fetch['thue_vat'] ?>" data="<?= ($vt_mua_fetch['don_gia'] * $vt_mua_fetch['so_luong'] * $vt_mua_fetch['thue_vat']) / 100 ?>" class="form-control thue_vat" onkeyup="thue_doi(this)">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="vt_tien_svat_old" value="<?= $vt_mua_fetch['tien_svat'] ?>" class="form-control tong_svat" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="xoa-vt-<?= $vt_mua_fetch['id'] ?>">
                                                        <div class="m-content">
                                                            <div class="m-head ">
                                                                Th??ng b??o <span class="dismiss cancel">&times;</span>
                                                            </div>
                                                            <div class="m-body">
                                                                <p>B???n c?? ch???c ch???n mu???n x??a v???t t??/thi???t b??? n??y?</p>
                                                                <p>Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                                                            </div>
                                                            <div class="m-foot d-inline-block">
                                                                <div class="left mb_10">
                                                                    <p class="v-btn btn-outline-blue left cancel">H???y</p>
                                                                </div>
                                                                <div class="right mb_10">
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right xoa_vt_tb" data-id="<?= $vt_mua_fetch['id'] ?>" onclick="tong_vt(),baoLanh(),baoHanh()">?????ng ??</button>
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
                                        <button type="button" class="cancel_add mb_10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">H???y</button>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">TH??NG B??O</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n h???y vi???c s???a h???p ?????ng mua?</p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hd_dy_pop">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">H???y</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">?????ng
                                        ??</button>
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
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia").select2({
        width: '100%',
    });

    $(".all_hthuc_hd").select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
    })
    // autocomplete(document.getElementById("ten_nh"), bank);

    function hd_vt_change(id) {
        var id_vt = $(id).val();
        var id_v = $(id).parents(".item").attr("data");
        var com_id = $(id).attr("data");
        $.ajax({
            url: '../render/hd_mua_vat_tu.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_v: id_v,
                id_com: com_id,
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
        // var id_p = $("#bao_gia").val();
        var id_ncc = $("#id_nha_cung_cap").val();
        var com_id = <?= $com_id ?>;
        $.ajax({
            url: '../ajax/hd_mua_them_vt.php',
            type: 'POST',
            data: {
                id_com: com_id,
                // id_p: id_p,
                id_ncc: id_ncc
            },
            success: function(data) {
                $("#vat_tu_thiet_bi").append(data);
                RefSelect2();
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
        event.preventDefault();
        event.stopPropagation();
        var errorElements = document.querySelectorAll(".error");
        for (let index = 0; index < errorElements.length; index++) {
            const element = errorElements[index];
            $('html, body').animate({
                scrollTop: $(errorElements[0]).focus().offset().top - 30
            }, 1000);
            return false;
        }
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
            },
            messages: {
                ngay_ky: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
                nha_ccap: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
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

            if (han_bao_lanh != "" && ngay_bat_dau != "" && ngay_ket_thuc != "") {
                if (ngay_bat_dau < ngay_ky_hd) {
                    alert("Ng??y b???t ?????u ph???i l???n h??n ng??y k?? h???p ?????ng");
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau > ngay_ket_thuc) {

                    alert("Ng??y b???t ?????u ph???i nh??? h??n ng??y k???t th??c");
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau < ngay_ket_thuc) {
                    if (han_bao_lanh > ngay_ket_thuc || han_bao_lanh < ngay_bat_dau) {

                        alert("Th???i h???n b???o l??nh ph???i nh??? h??n ng??y k???t th??c v?? l???n h??n ng??y b???t ?????u");

                    } else if (han_bao_lanh > ngay_bat_dau && han_bao_lanh <= ngay_ket_thuc) {
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
                                    alert("S???a h???p ?????ng mua v???t t?? th??nh c??ng!");
                                    window.location.href = 'quan-ly-chi-tiet-hop-dong-mua-<?= $hd_id ?>.html';
                                } else {
                                    alert(data);
                                }
                            }
                        })
                    }
                }
            } else if (ngay_bat_dau == "" && ngay_ket_thuc != "") {
                alert('Nh???p ng??y th???c hi???n b???t ?????u');
            } else if (ngay_bat_dau != "" && ngay_ket_thuc == "") {
                alert('Nh???p ng??y th???c hi???n k???t th??c')
            } else if (ngay_bat_dau != "" && ngay_ket_thuc != "" && han_bao_lanh == "") {
                if (ngay_bat_dau < ngay_ky_hd) {
                    alert("Ng??y b???t ?????u ph???i l???n h??n ng??y k?? h???p ?????ng")
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau > ngay_ket_thuc) {
                    alert("Ng??y b???t ?????u ph???i nh??? h??n ng??y k???t th??c");
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau < ngay_ket_thuc) {
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
                                alert("S???a h???p ?????ng mua v???t t?? th??nh c??ng!");
                                window.location.href = 'quan-ly-chi-tiet-hop-dong-mua-<?= $hd_id ?>.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                }

            } else {
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
                            alert("S???a h???p ?????ng mua v???t t?? th??nh c??ng!");
                            window.location.href = 'quan-ly-chi-tiet-hop-dong-mua-<?= $hd_id ?>.html';
                        } else {
                            alert(data);
                        }
                    }
                })
            }



        }
    });
</script>

</html>