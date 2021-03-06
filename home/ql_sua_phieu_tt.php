<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['com_id'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['ep_id'];
        $phan_quyen_nk = 2;

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `phieu_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $phieu_tt3 = explode(',', $item_nv['phieu_tt']);
            if (in_array(3, $phieu_tt3) == FALSE) {
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
                            p.`nguoi_nhan_tien`, p.`so_tien`, p.`ty_gia`, p.`phi_giao_dich`, p.`gia_tri_quy_doi`, p.`trang_thai`, p.`ngay_tao`, p.`id_nguoi_lap`,
                            n.`id`, n.`ten_nha_cc_kh`
                            FROM `phieu_thanh_toan` AS p
                            INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                            WHERE p.`id` = $id AND p.`id_cong_ty` = $com_id ");
    $item = mysql_fetch_assoc($list_ptt->result);
    $id_hd_dh = $item['id_hd_dh'];
    $ngay_tao_phieu = $item['ngay_tao'];

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
    <title>Ch???nh s???a phi???u thanh to??n</title>
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
                        <a class="prew_href share_fsize_one share_clr_one" href="chi-tiet-phieu-thanh-toan-<?= $id ?>.html">
                            Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Ch???nh s???a phi???u thanh to??n </h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $id ?>" data1="<?= $com_name ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? phi???u </label>
                                        <input type="text" name="so_phieu" value="PH - <?= $id ?>" data="<?= $id ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Lo???i phi???u thanh to??n <span class="cr_red">*</span></label>
                                        <select name="loai_ptt" class="form-control loai_phieu" data="<?= $com_id ?>">
                                            <option value="">-- Ch???n lo???i phi???u thanh to??n --</option>
                                            <option value="1" <?= ($item['loai_phieu_tt'] == 1) ? "selected" : "" ?>>Phi???u thanh to??n h???p ?????ng</option>
                                            <option value="2" <?= ($item['loai_phieu_tt'] == 2) ? "selected" : "" ?>>Phi???u thanh to??n ????n h??ng</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>H???p ?????ng / ????n h??ng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hd_dh">
                                            <option value="">-- Ch???n h???p ?????ng / ????n h??ng --</option>
                                            <? if ($item['loai_phieu_tt'] == 1) {
                                                $list_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id ");
                                                while ($row_hs = mysql_fetch_assoc($list_hd->result)) { ?>
                                                    <option value="<?= $row_hs['id_hd_dh'] ?>" <?= ($row_hs['id_hd_dh'] == $item['id_hd_dh']) ? "selected" : "" ?>> H?? - <?= $row_hs['id_hd_dh'] ?></option>
                                                <? }
                                            } else if ($item['loai_phieu_tt'] == 2) {
                                                $list_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id");
                                                while ($row_hs = mysql_fetch_assoc($list_hd->result)) { ?>
                                                    <option value="<?= $row_hs['id_hd_dh'] ?>" <?= ($row_hs['id_hd_dh'] == $item['id_hd_dh']) ? "selected" : "" ?>> ??H - <?= $row_hs['id_hd_dh'] ?></option>
                                            <? }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group nha_cc_kh">
                                        <? if ($item['phan_loai'] == 1 || $item['phan_loai'] == 3 || $item['phan_loai'] == 4 || $item['phan_loai'] == 5) { ?>
                                            <label>Nh?? cung c???p</label>
                                            <input type="text" name="khachh_nhacc" value="<?= $item['ten_nha_cc_kh'] ?>" data="<?= $item['id'] ?>" data1="<?= $item['phan_loai'] ?>" class="form-control cr_weight h_border">
                                        <? } else if ($item['phan_loai'] == 2 || $item['phan_loai'] == 6) { ?>
                                            <label>Kh??ch h??ng</label>
                                            <input type="text" name="khachh_nhacc" value="<?= $item['ten_nha_cc_kh'] ?>" data="<?= $item['id'] ?>" data1="<?= $item['phan_loai'] ?>" class="form-control cr_weight h_border">
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Ng??y thanh to??n</label>
                                        <input type="date" name="ngay_ttoan" class="form-control" value="<?= ($item['ngay_thanh_toan'] != 0) ? date('Y-m-d', $item['ngay_thanh_toan']) : "" ?>" placeholder="Ch???n ng??y thanh to??n">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l ">
                                    <div class="form-group share_form_select">
                                        <label>H??nh th???c thanh to??n <span class="cr_red">*</span></label>
                                        <select name="hinh_thuc" class="form-control all_hthuc">
                                            <option value="">-- Ch???n h??nh th???c thanh to??n --</option>
                                            <option value="1" <?= ($item['hinh_thuc_tt'] == 1) ? "selected" : "" ?>>Ti???n m???t</option>
                                            <option value="2" <?= ($item['hinh_thuc_tt'] == 2) ? "selected" : "" ?>>B???ng th???</option>
                                            <option value="3" <?= ($item['hinh_thuc_tt'] == 3) ? "selected" : "" ?>>Chuy???n kho???n</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select loai_thanht">
                                        <label>Lo???i thanh to??n</label>
                                        <select name="lthanh_toan" class="form-control all_ltt" data="<?= $com_id ?>" onchange="loai_tt_doi(this)">
                                            <option value="">-- Ch???n lo???i thanh to??n --</option>
                                            <option value="1" <?= ($item['loai_thanh_toan'] == 1) ? "selected" : "" ?>>T???m ???ng</option>
                                            <option value="2" <?= ($item['loai_thanh_toan'] == 2) ? "selected" : "" ?>>Theo h???p ?????ng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>????n v??? chi tr???</label>
                                        <p class="cr_weight"><?= $dv_chitra ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>????n v??? th??? h?????ng</label>
                                        <p class="cr_weight"><?= $dv_thuhuong ?></p>
                                    </div>
                                </div>
                                <div class="ct_form w_100 float_l">
                                    <? if ($item['loai_thanh_toan'] == 1) { ?>
                                        <div class="ctn_ct_from w_100 float_l">
                                            <div class="form-row w_100 float_l">
                                                <div class="form-group">
                                                    <label>S??? ti???n <span class="cr_red">*</span></label>
                                                    <input type="text" name="so_tien" value="<?= $item['so_tien'] ?>" onkeyup="so_tien_doi(this)" oninput="<?= $oninput ?>" class="form-control so_tien" placeholder="Nh???p s??? ti???n">
                                                </div>
                                                <div class="form-group">
                                                    <label>T??? gi??</label>
                                                    <input type="text" name="ty_gia" value="<?= $item['ty_gia'] ?>" onkeyup="ty_gia_doi(this)" oninput="<?= $oninput ?>" class="form-control ty_gia" placeholder="Nh???p t??? gi??">
                                                </div>
                                            </div>
                                            <div class="form-row w_100 float_l">
                                                <div class="form-group">
                                                    <label>Gi?? tr??? quy ?????i</label>
                                                    <input type="text" name="gia_quy_doi" value="<?= $item['gia_tri_quy_doi'] ?>" oninput="<?= $oninput ?>" class="form-control h_border cr_weight gia_qdoi" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    <? } else if ($item['loai_thanh_toan'] == 2) {
                                        echo "";
                                    } ?>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Ph?? giao d???ch</label>
                                        <input type="text" name="phi_giaod" class="form-control" value="<?= ($item['phi_giao_dich'] == 0) ? "" : $item['phi_giao_dich'] ?>" oninput="<?= $oninput ?>" placeholder="Nh???p ph?? giao d???ch">
                                    </div>
                                    <div class="form-group">
                                        <label>Ng?????i nh???n ti???n</label>
                                        <input type="text" name="nguoi_ntien" class="form-control" value="<?= $item['nguoi_nhan_tien'] ?>" placeholder="Nh???p ng?????i nh???n ti???n">
                                    </div>
                                </div>
                                <div class="form-them-nganh w_100 float_l">
                                    <? if ($item['hinh_thuc_tt'] == 2 || $item['hinh_thuc_tt'] == 3) {
                                        $tai_khoan = new db_query("SELECT `id`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`
                                                                    FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id  ");
                                    ?>
                                        <div class="ctie_form_nhang w_100 float_l">
                                            <div class="tieu_de w_100 float_l d_flex fl_wrap mb_10">
                                                <p class="mr_30 share_fsize_tow share_clr_one cr_weight cate_bank">Danh s??ch t??i kho???n ng??n h??ng</p>
                                                <p class="share_clr_four share_fsize_tow cr_weight share_cursor add_ngan_hang">+ Th??m m???i t??i kho???n ng??n h??ng</p>
                                            </div>
                                            <? while ($row1 = mysql_fetch_assoc($tai_khoan->result)) { ?>
                                                <div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                                                    <div class="form-ctra w_100 float_l">
                                                        <div class="form-row">
                                                            <div class="form-group ">
                                                                <label>T??n ng??n h??ng <span class="cr_red">*</span></label>
                                                                <input name="ten_nhanhang" class="form-control" type="text" value="<?= $row1['ten_ngan_hang'] ?>">
                                                            </div>
                                                            <div class="form-group share_form_select">
                                                                <label>Chi nh??nh <span class="cr_red">*</span></label>
                                                                <input type="text" class="form-control" name="chi_nhanh" value="<?= $row1['ten_chi_nhanh'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group share_form_select">
                                                                <label>S??? t??i kho???n <span class="cr_red">*</span></label>
                                                                <input type="number" class="form-control" name="so_tk" value="<?= $row1['so_tk'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ch??? t??i kho???n </label>
                                                                <input type="text" name="chu_taik" class="form-control" value="<?= ($row1['chu_tk'] != 0) ? $row1['chu_tk'] : "" ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="x??a"></span>
                                                </div>
                                            <? } ?>
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

                                        $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan`
                                                                                    WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh
                                                                                    AND `loai_hs` = $loai_phieu_tt "))->result)['tongtien'];

                                        $ds_phieu = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id AND `id_cong_ty` = $com_id AND `ngay_tao` < $ngay_tao_phieu
                                                                AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $id_hd_dh AND `loai_phieu_tt` = $loai_phieu_tt ");

                                        if (mysql_num_rows($ds_phieu->result) > 0) {
                                            $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS tongtien_tra FROM `phieu_thanh_toan` WHERE `id` != $id
                                                                AND `id_cong_ty` = $com_id
                                                                AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $id_hd_dh
                                                                AND `loai_phieu_tt` = $loai_phieu_tt "))->result)['tongtien_tra'];
                                        } else {
                                            $tong_da_tt = 0;
                                        }

                                        $gia_tri_tt = $tong_tatca - $tong_da_tt;

                                        $tong_datt = mysql_fetch_assoc((new db_query("SELECT `so_tien` FROM `phieu_thanh_toan`
                                                                        WHERE `loai_phieu_tt` = $loai_phieu_tt AND `loai_thanh_toan` = 2
                                                                        AND `id_hd_dh` = $id_hd_dh AND `id_cong_ty` = $com_id AND `id` = $id "))->result)['so_tien'];
                                    ?>

                                        <div class="ctn_table w_100 float_l">
                                            <table class="table" data="<?= $id ?>">
                                                <thead>
                                                    <tr>
                                                        <th class="share_tb_five">H??? s?? thanh to??n</th>
                                                        <th class="share_tb_five">Gi?? tr??? c??n ph???i thanh to??n</th>
                                                        <th class="share_tb_five">Th???i h???n thanh to??n</th>
                                                        <th class="share_tb_five">Thanh to??n</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="sh_bgr_four">
                                                        <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">T???ng</td>
                                                        <td class="share_clr_four cr_weight share_tb_five"><?= formatMoney($gia_tri_tt) ?></td>
                                                        <td class="share_tb_five"></td>
                                                        <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= $tong_datt ?></td>
                                                    </tr>
                                                    <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                                                        $id_hs = $row1['id_hs'];

                                                        $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                                WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);

                                                        $check_ttoan_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id AND `id_cong_ty` = $com_id
                                                                                AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2
                                                                                AND `id_hd_dh` = $id_hd_dh AND `loai_phieu_tt` = $loai_phieu_tt ");

                                                        if (mysql_num_rows($check_ttoan_tt->result) > 0) {
                                                            $tienda_tt = mysql_fetch_assoc((new db_query("SELECT SUM(c.`da_thanh_toan`) AS tongda_ttoan FROM `chi_tiet_phieu_tt_vt` AS c
                                                                                INNER JOIN `phieu_thanh_toan` AS p ON c.`id_phieu_tt` = p.`id`
                                                                                WHERE c.`id_cong_ty` = $com_id AND c.`id_hs` = $id_hs AND c.`id_phieu_tt` != $id
                                                                                AND c.`id_hd_dh` = $id_hd_dh AND p.`ngay_tao` < $ngay_tao_phieu
                                                                                AND p.`loai_phieu_tt` = $loai_phieu_tt AND p.`loai_thanh_toan` = 2 "))->result)['tongda_ttoan'];
                                                        } else {
                                                            $tienda_tt = 0;
                                                        }

                                                    ?>

                                                        <tr>
                                                            <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                                            <td class="share_tb_five tongtien" data="<?= $than_tient['tong_tien_tatca'] - $tienda_tt ?>"><?= formatMoney($than_tient['tong_tien_tatca'] - $tienda_tt) ?></td>
                                                            <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                                            <td class="share_tb_five">
                                                                <div class="form-group">
                                                                    <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" oninput="<?= $oninput ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
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
                                        <button type="button" class="cancel_add share_cursor mb_10 share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">H???y</button>
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
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n h???y vi???c s???a phi???u thanh to??n?</p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex phieu_dy_pop">
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
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".all_hd_dh").select2({
        width: '100%',
    });

    $(".loai_phieu, .all_hthuc, .all_ltt").select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $(".loai_phieu").change(function() {
        var loai_phieu = $(this).val();
        var com_id = $(this).attr("data");
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        var hs_phieu = 2;
        $.ajax({
            url: '../render/ds_hd_dh.php',
            type: 'POST',
            data: {
                loai_hs: loai_phieu,
                com_id: com_id,
                hs_phieu: hs_phieu,
            },
            success: function(data) {
                $(".all_hd_dh").html(data);
            }
        });

        $.ajax({
            url: '../render/phieu_ncc_kh.php',
            type: 'POST',
            data: {
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".nha_cc_kh").html(data);
            }
        });

        $.ajax({
            url: '../render/lthanh_toan.php',
            type: 'POST',
            data: {
                loai_phieu: loai_phieu,
                com_id: com_id,
                id_phieu: id_phieu,
            },
            success: function(data) {
                $(".them_moi_vt").html(data);
            }
        });
    });

    $(".all_hd_dh").change(function() {
        var loai_phieu = $(".loai_phieu").val();
        var hd_dh = $(this).val();
        var com_id = $(".loai_phieu").attr("data");
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        var com_name = $(".ctiet_dk_hp").attr("data1");

        $.ajax({
            url: '../render/phieu_ncc_kh.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".nha_cc_kh").html(data);
            }
        });

        $.ajax({
            url: '../render/dv_ctra_hthu.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                $(".dv_ctra_hthu").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_loai_tt.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".loai_thanht").html(data);
                RefSelect2();
            }
        });

        $.ajax({
            url: '../render/lthanh_toan.php',
            type: 'POST',
            data: {
                loai_phieu: loai_phieu,
                hd_dh: hd_dh,
                com_id: com_id,
                id_phieu: id_phieu,
            },
            success: function(data) {
                $(".them_moi_vt").html(data);
            }
        });

    });

    $(document).on('click', '.add_ngan_hang', function() {
        var html = `<div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                        <div class="form-ctra w_100 float_l">
                            <div class="form-row">
                                <div class="form-group share_form_select">
                                    <label>T??n ng??n h??ng <span class="cr_red">*</span></label>
                                    <input type="text" name="ten_nhanhang" class="form-control" placeholder="Nh???p t??n ng??n h??ng">
                                </div>
                                <div class="form-group share_form_select">
                                    <label>Chi nh??nh <span class="cr_red">*</span></label>
                                    <input type="text" name="chi_nhanh" class="form-control" placeholder="Nh???p t??n chi nh??nh ng??n h??ng">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group share_form_select">
                                    <label>S??? t??i kho???n <span class="cr_red">*</span></label>
                                    <input type="text" name="so_tk" class="form-control" placeholder="Nh???p s??? t??i kho???n ng??n h??ng">
                                </div>
                                <div class="form-group">
                                    <label>Ch??? t??i kho???n </label>
                                    <input type="text" name="chu_taik" class="form-control" placeholder="Nh???p t??n ch??? t??i kho???n">
                                </div>
                            </div>
                        </div>
                        <span class="remove_tnh ml_50 share_cursor"><img src="../img/remove-2.png" alt="x??a"></span>
                    </div>`;
        $(".form-them-nganh .ctie_form_nhang").append(html);
        // CheckSelect();
    });

    $(".all_hthuc").change(function() {
        var hthuc_tt = $(this).val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var id_phieu = $(".ctiet_dk_hp").attr("data");
        var loai_phieu = $(".loai_phieu").val();
        var id_hd_dh = $(".all_hd_dh").val();
        $.ajax({
            url: '../render/hinh_thuc_tt.php',
            type: 'POST',
            data: {
                hthuc_tt: hthuc_tt,
                com_id: com_id,
                id_phieu: id_phieu,
                loai_phieu: loai_phieu,
                id_hd_dh: id_hd_dh,
            },
            success: function(data) {
                if (hthuc_tt == 1) {
                    $(".form-them-nganh .ctie_form_nhang").remove()
                    $(".tien_chi_tra").remove();
                } else if (hthuc_tt == 2 || hthuc_tt == 3) {
                    $(".form-them-nganh").html(data);
                }
            }
        });
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
                }
            },
            messages: {
                loai_ptt: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
                hdong_dhang: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
                hinh_thuc: {
                    required: "Kh??ng ???????c ????? tr???ng",
                },
                so_tien: {
                    required: "Kh??ng ???????c ????? tr???ng",
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

            var new_tngan_hang = [];
            $("input[name='ten_nhanhang']").each(function() {
                var n_tnh = $(this).val();
                if (n_tnh != "") {
                    new_tngan_hang.push(n_tnh);
                }
            });

            var new_chi_nhanh = [];
            $("input[name='chi_nhanh']").each(function() {
                var n_cnhanh = $(this).val();
                if (n_cnhanh != "") {
                    new_chi_nhanh.push(n_cnhanh);
                }
            });

            var new_so_tk = [];
            $("input[name='so_tk']").each(function() {
                var n_stk = $(this).val();
                if (n_stk != "") {
                    new_so_tk.push(n_stk);
                }
            });

            var new_chu_tk = [];
            $("input[name='chu_taik']").each(function() {
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

            var tong_tien_tatca_tr = $(".tong_tien_tatca_tr").attr("data");

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
                    tong_tien_tatca_tr: tong_tien_tatca_tr,
                },
                success: function(data) {
                    if (data == "") {
                        alert("B???n ???? c???p nh???t phi???u thanh to??n th??nh c??ng");
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