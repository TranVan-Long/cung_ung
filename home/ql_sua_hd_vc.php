<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $role = 1;
    } else if ($_COOKIE['role'] == 2) {
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
}

$date = date('m-d-Y', time());
if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = $hd_id AND `id_cong_ty` = $com_id  ");
    $hd_detail = mysql_fetch_assoc($hd_get->result);
    $giatri_tr = $hd_detail['gia_tri_trvat'];
    $giatri_s = $hd_detail['gia_tri_svat'];
    $ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
    $cong_trinh = $hd_detail['id_du_an_ctrinh'];
    $id_ncc = $hd_detail['id_nha_cc_kh'];
    if ($hd_detail['thoi_han_blanh'] != 0) {
        $thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);
    } else {
        $thoi_han_bl = "";
    }

    if ($hd_detail['tg_bd_thuc_hien'] != 0) {
        $ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
    } else {
        $ngay_bat_dau = "";
    }

    if ($hd_detail['tg_kt_thuc_hien'] != 0) {
        $ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);
    } else {
        $ngay_ket_thuc = 0;
    }


    $hd_vat_tu = new db_query("SELECT * FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = '" . $hd_id . "' ");

    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $list_cong_trinh = json_decode($response, true);
    $cong_trinh_data = $list_cong_trinh['data']['items'];

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

    $vat_tu = [];
    for ($i = 0; $i < count($vat_tu_data); $i++) {
        $items_vt = $vat_tu_data[$i];
        $vat_tu[$items_vt['dsvt_id']] = $items_vt;
    }
} else {
    header('Location: /quan-ly-trang-chu.html');
}



?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S???a h???p ?????ng thu?? v???n chuy???n</title>
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
    <div class="main-container ql_them_hd_vc ql_ctiet_hd_vc">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-hop-dong.html">
                            Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">S???a h???p ?????ng thu?? v???n chuy???n</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>" data3="<?= $hd_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? h???p ?????ng</label>
                                        <input type="text" name="so_hd" value="H?? - <?= $hd_id ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Ng??y k?? h???p ?????ng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= $ngay_hop_dong ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nh?? cung c???p <span class="cr_red">*</span></label>
                                        <select name="id_nha_cung_cap" class="form-control all_nhacc">
                                            <option value="">-- Ch???n nh?? cung c???p --</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` DESC ");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_ncc == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>D??? ??n / C??ng tr??nh</label>
                                        <select name="dan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Ch???n D??? ??n / C??ng tr??nh --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $cong_trinh) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? tr?????c VAT</label>
                                        <input type="number" name="truoc_vat" id="tong_truoc_vat" value="<?= $giatri_tr ?>" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">????n gi?? ???? bao g???m VAT</label>
                                        <input type="checkbox" id="don_gia_vat" name="don_gia_vat" onclick="dongiavat_vc(this)" <?= ($hd_detail['bao_gom_vat'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thu??? su???t VAT</label>
                                        <input type="number" name="thue_vat" oninput="<?= $oninput ?>" value="<?= $hd_detail['thue_vat'] ?>" class="form-control thue_vat_tong" onkeyup="thue_vc_doi(this)" placeholder="Nh???p thu??? su???t VAT">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? sau VAT</label>
                                        <input type="number" name="sau_vat" value="<?= $giatri_s ?>" id="tong_sau_vat" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gi??? l???i b???o h??nh</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="number" name="bao_hanh" oninput="<?= $oninput ?>" onkeyup="baoHanh(),check_nbhanh(this)" value="<?= $hd_detail['giu_lai_bhanh'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_hanh">
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
                                                <input type="number" name="bao_lanh" oninput="<?= $oninput ?>" onkeyup="baoLanh(),check_nblanh(this)" value="<?= $hd_detail['bao_lanh_hd'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_lanh">
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
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>H???n m???c t??n d???ng</label>
                                        <input type="text" name="hmuc_tind" oninput="<?= $oninput ?>" value="<?= $hd_detail['han_muc_tin_dung'] ?>" class="form-control" placeholder="Nh???p h???n m???c t??n d???ng">
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
                                        <input type="number" name="so_taik" oninput="<?= $oninput ?>" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nh???p s??? t??i kho???n">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Th??m m???i v???t t??</p>
                                    <div class="ctn_table w_100 float_l khac_ctn_vc">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_five">V???t t?? / T??n thi???t b??? / V???t t?? v???n chuy???n</th>
                                                    <th class="share_tb_six mass_pad">
                                                        <div class="w_100 float_l">
                                                            <p class="w_100 float_l khoi_luong share_clr_tow">Kh???i l?????ng</p>
                                                            <div class="d_flex w_100 float_l dvi_khoil">
                                                                <p class="ft-pl share_clr_tow">????n v??? t??nh</p>
                                                                <p class="ft-pl share_clr_tow">Kh???i l?????ng</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="share_tb_four">????n gi??</th>
                                                    <th class="share_tb_four">Th??nh ti???n</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                $get_vt_vc = new db_query("SELECT * FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $hd_id");
                                                while ($vt_vc_fetch = mysql_fetch_assoc($get_vt_vc->result)) {
                                                ?>
                                                    <tr class="item">
                                                        <td class="share_tb_one">
                                                            <p class="modal-btn" data-target="xoa-vt-<?= $vt_vc_fetch['id'] ?>"><i class="ic-delete remove-btn"></i></p>
                                                            <input type="hiden" name="id_tb_vt_old" value="<?= $vt_vc_fetch['id'] ?>" class="share_dnone">
                                                        </td>
                                                        <td class="share_tb_five">
                                                            <div class="form-group v-select2">
                                                                <select name="thietb_vt_old" class="form-control share_select">
                                                                    <option value="">-- Ch???n v???t t??/thi???t b??? --</option>
                                                                    <? foreach ($vat_tu_data as $key => $items) { ?>
                                                                        <option value="<?= $items['dsvt_id'] ?>" <?= ($items['dsvt_id'] == $vt_vc_fetch['vat_tu']) ? 'selected' : '' ?>><?= $items['dsvt_name'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vt_vc_fetch['don_vi_tinh'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group">
                                                                <input type="text" name="khoi_luong_old" oninput="<?= $oninput ?>" value="<?= $vt_vc_fetch['khoi_luong'] ?>" placeholder="Kh???i l?????ng ph???i l???n h??n 0" class="form-control so_luong" onkeyup="sl_vc_doi(this),tong_hd_vc()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_four">
                                                            <div class="form-group">
                                                                <input type="text" name="don_gia_old" oninput="<?= $oninput ?>" value="<?= $vt_vc_fetch['don_gia'] ?>" placeholder="????n gi?? v???t t?? ph???i l???n h??n 0" class="form-control don_gia" onkeyup="dg_vc_doi(this),tong_hd_vc()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_four">
                                                            <div class="form-group">
                                                                <input type="hiden" name="vat_ao" value="0" class="share_dnone thue_vat">
                                                                <input type="number" name="thanh_tien_old" value="<?= $vt_vc_fetch['thanh_tien'] ?>" class="form-control h_border tong_trvat tong_trvat_hd " readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="xoa-vt-<?= $vt_vc_fetch['id'] ?>">
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
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right xoa_vt_tb" data-id="<?= $vt_vc_fetch['id'] ?>" onclick="tong_vt(),baoLanh(),baoHanh()">?????ng ??</button>
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
                                        <button type="button" class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">H???y</button>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">TH??NG B??O</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n h???y vi???c s???a h???p ?????ng thu?? v???n chuy???n?</p>
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

    $(document).ready(function() {
        if ($("#don_gia_vat").is(":checked")) {
            $(".thue_vat_tong").val(0);
            $(".thue_vat_tong").attr("readonly", true);
        }
    })

    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });
    // autocomplete(document.getElementById("ten_nh"), bank);

    $(".add_vat_tu").click(function() {
        var com_id = $(".form_add_hp_mua").attr("data1");
        var bg_vat = 0;
        if ($("input[name='don_gia_vat']").is(":checked")) {
            bg_vat = 1;
        };
        $.ajax({
            url: '../render/add_hdvc_vt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                bg_vat: bg_vat,
            },
            success: function(data) {
                $(".ctn_table .table tbody").append(data);
                RefSelect2();
            }
        });


        if ($(".ctn_table .table tbody").height() > 105.5) {
            $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
        }
    })

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });
    // xoa vat tu trong bang
    $(".xoa_vt_tb").click(function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '../ajax/hd_vc_xoa_vt.php',
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
        var form_edit_vc = $(".form_add_hp_mua");
        form_edit_vc.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky_hd: {
                    required: true,
                },
                id_nha_cung_cap: {
                    required: true,
                }
            },
            messages: {
                ngay_ky_hd: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
                id_nha_cung_cap: {
                    required: "Kh??ng ???????c ????? tr???ng",
                }
            },
        });

        if (form_edit_vc.valid() === true) {
            var hd_id = $(".form_add_hp_mua").attr("data3");
            var user_id = $(".form_add_hp_mua").attr("data2");
            var com_id = $(".form_add_hp_mua").attr("data1");
            var role = $(".form_add_hp_mua").attr("data");

            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_nha_cung_cap = $("select[name='id_nha_cung_cap']").val();
            var dan_ctrinh = $("select[name='dan_ctrinh']").val();

            var truoc_vat = $("input[name='truoc_vat']").val();
            var don_gia_vat = 0;
            if ($("input[name='don_gia_vat']").is(":checked")) {
                don_gia_vat = 1;
            }
            var thue_vat = $("input[name='thue_vat']").val();
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
            var hmuc_tind = $("input[name='hmuc_tind']").val();
            var yc_tiendo = $("textarea[name='yc_tiendo']").val();
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();

            var vt_id_vat_tu_old = [];
            $("input[name='id_tb_vt_old']").each(function() {
                var id_vat_tu_old = $(this).val();
                if (id_vat_tu_old != "") {
                    vt_id_vat_tu_old.push(id_vat_tu_old);
                }
            });

            var vt_vat_tu_old = [];
            $("select[name='thietb_vt_old']").each(function() {
                var ten_vat_tu_old = $(this).val();
                if (ten_vat_tu_old != "") {
                    vt_vat_tu_old.push(ten_vat_tu_old);
                }
            });
            var vt_don_vi_tinh_old = [];
            $("input[name='don_vi_tinh_old']").each(function() {
                var sl_vt_old = $(this).val();
                if (sl_vt_old != "") {
                    vt_don_vi_tinh_old.push(sl_vt_old);
                }
            });
            var vt_khoi_luong_old = [];
            $("input[name='khoi_luong_old']").each(function() {
                var kl_vt_old = $(this).val();
                if (kl_vt_old != "" && kl_vt_old != 0) {
                    vt_khoi_luong_old.push(kl_vt_old);
                }
            });
            var vt_don_gia_old = [];
            $("input[name='don_gia_old']").each(function() {
                var dg_vat_old = $(this).val();
                if (dg_vat_old != "" && dg_vat_old != 0) {
                    vt_don_gia_old.push(dg_vat_old);
                }
            });
            var vt_thanh_tien_old = [];
            $("input[name='thanh_tien_old']").each(function() {
                var tt_vt_old = $(this).val();
                if (tt_vt_old != "") {
                    vt_thanh_tien_old.push(tt_vt_old);
                }
            });

            var vt_vat_tu = [];
            $("select[name='thietb_vt']").each(function() {
                var ten_vat_tu = $(this).val();
                if (ten_vat_tu != "") {
                    vt_vat_tu.push(ten_vat_tu);
                }
            });
            var vt_don_vi_tinh = [];
            $("input[name='don_vi_tinh']").each(function() {
                var sl_vt = $(this).val();
                if (sl_vt != "") {
                    vt_don_vi_tinh.push(sl_vt);
                }
            });
            var vt_khoi_luong = [];
            $("input[name='khoi_luong']").each(function() {
                var kl_vt = $(this).val();
                if (kl_vt != "" && kl_vt != 0) {
                    vt_khoi_luong.push(kl_vt);
                }
            });
            var vt_don_gia = [];
            $("input[name='don_gia']").each(function() {
                var dg_vat = $(this).val();
                if (dg_vat != "" && dg_vat != 0) {
                    vt_don_gia.push(dg_vat);
                }
            });
            var vt_thanh_tien = [];
            $("input[name='thanh_tien']").each(function() {
                var tt_vt = $(this).val();
                if (tt_vt != "") {
                    vt_thanh_tien.push(tt_vt);
                }
            });

            if (han_bao_lanh != "" && ngay_bat_dau != "" && ngay_ket_thuc != "") {
                if (ngay_bat_dau < ngay_ky_hd) {
                    alert("Ng??y b???t ?????u ph???i l???n h??n ng??y k?? h???p ?????ng")
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau > ngay_ket_thuc) {
                    alert("Ng??y b???t ?????u ph???i nh??? h??n ng??y k???t th??c");
                } else if (ngay_bat_dau >= ngay_ky_hd && ngay_bat_dau < ngay_ket_thuc) {
                    if (han_bao_lanh > ngay_ket_thuc || han_bao_lanh < ngay_bat_dau) {
                        alert("Th???i h???n b???o l??nh ph???i nh??? h??n ng??y k???t th??c v?? l???n h??n ng??y b???t ?????u");
                    } else if (han_bao_lanh > ngay_bat_dau && han_bao_lanh <= ngay_ket_thuc) {
                        $.ajax({
                            url: '../ajax/hd_vc_sua.php',
                            type: 'POST',
                            data: {
                                hd_id: hd_id,
                                user_id: user_id,
                                com_id: com_id,
                                role: role,

                                ngay_ky_hd: ngay_ky_hd,
                                id_nha_cung_cap: id_nha_cung_cap,
                                dan_ctrinh: dan_ctrinh,
                                truoc_vat: truoc_vat,
                                don_gia_vat: don_gia_vat,
                                thue_vat: thue_vat,
                                sau_vat: sau_vat,
                                bao_hanh: bao_hanh,
                                gt_bao_hanh: gt_bao_hanh,
                                bao_lanh: bao_lanh,
                                gt_bao_lanh: gt_bao_lanh,
                                han_bao_lanh: han_bao_lanh,
                                ngay_bat_dau: ngay_bat_dau,
                                ngay_ket_thuc: ngay_ket_thuc,
                                bao_gom_van_chuyen: bao_gom_van_chuyen,
                                hmuc_tind: hmuc_tind,
                                yc_tiendo: yc_tiendo,
                                noi_dung_hd: noi_dung_hd,
                                noi_dung_luu_y: noi_dung_luu_y,
                                dieu_khoan_tt: dieu_khoan_tt,
                                ten_nh: ten_nh,
                                so_taik: so_taik,

                                vt_id_vat_tu_old: vt_id_vat_tu_old,
                                vt_vat_tu_old: vt_vat_tu_old,
                                vt_don_vi_tinh_old: vt_don_vi_tinh_old,
                                vt_khoi_luong_old: vt_khoi_luong_old,
                                vt_don_gia_old: vt_don_gia_old,
                                vt_thanh_tien_old: vt_thanh_tien_old,

                                vt_vat_tu: vt_vat_tu,
                                vt_don_vi_tinh: vt_don_vi_tinh,
                                vt_khoi_luong: vt_khoi_luong,
                                vt_don_gia: vt_don_gia,
                                vt_thanh_tien: vt_thanh_tien
                            },
                            success: function(data) {
                                if (data == "") {
                                    alert("Ch???nh s???a h???p ?????ng thu?? v???n chuy???n th??nh c??ng!");
                                    window.location.href = 'quan-ly-chi-tiet-hop-dong-van-chuyen-<?= $hd_id ?>.html';
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
            } else {
                $.ajax({
                    url: '../ajax/hd_vc_sua.php',
                    type: 'POST',
                    data: {
                        hd_id: hd_id,
                        user_id: user_id,
                        com_id: com_id,
                        role: role,

                        ngay_ky_hd: ngay_ky_hd,
                        id_nha_cung_cap: id_nha_cung_cap,
                        dan_ctrinh: dan_ctrinh,
                        truoc_vat: truoc_vat,
                        don_gia_vat: don_gia_vat,
                        thue_vat: thue_vat,
                        sau_vat: sau_vat,
                        bao_hanh: bao_hanh,
                        gt_bao_hanh: gt_bao_hanh,
                        bao_lanh: bao_lanh,
                        gt_bao_lanh: gt_bao_lanh,
                        han_bao_lanh: han_bao_lanh,
                        ngay_bat_dau: ngay_bat_dau,
                        ngay_ket_thuc: ngay_ket_thuc,
                        bao_gom_van_chuyen: bao_gom_van_chuyen,
                        hmuc_tind: hmuc_tind,
                        yc_tiendo: yc_tiendo,
                        noi_dung_hd: noi_dung_hd,
                        noi_dung_luu_y: noi_dung_luu_y,
                        dieu_khoan_tt: dieu_khoan_tt,
                        ten_nh: ten_nh,
                        so_taik: so_taik,

                        vt_id_vat_tu_old: vt_id_vat_tu_old,
                        vt_vat_tu_old: vt_vat_tu_old,
                        vt_don_vi_tinh_old: vt_don_vi_tinh_old,
                        vt_khoi_luong_old: vt_khoi_luong_old,
                        vt_don_gia_old: vt_don_gia_old,
                        vt_thanh_tien_old: vt_thanh_tien_old,

                        vt_vat_tu: vt_vat_tu,
                        vt_don_vi_tinh: vt_don_vi_tinh,
                        vt_khoi_luong: vt_khoi_luong,
                        vt_don_gia: vt_don_gia,
                        vt_thanh_tien: vt_thanh_tien
                    },
                    success: function(data) {
                        if (data == "") {
                            alert("Ch???nh s???a h???p ?????ng thu?? v???n chuy???n th??nh c??ng!");
                            window.location.href = 'quan-ly-chi-tiet-hop-dong-van-chuyen-<?= $hd_id ?>.html';
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