<?php

include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $phan_loai_nk = 1;

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $list_nv = $data_list['data']['items'];
        $count = count($list_nv);
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $phan_loai_nk = 2;

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $list_nv = $data_list['data']['items'];
        $count = count($list_nv);

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang3 = explode(',', $item_nv['don_hang']);
            if (in_array(3, $don_hang3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$all_nv = [];
for ($i = 0; $i < $count; $i++) {
    $item = $data_list_nv[$i];
    $all_nv[$item['ep_id']] = $item;
};

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://chamcong.24hpay.vn/service/detail_company.php?id_com=" . $com_id);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$com0 = json_decode($response, true);
$list_dep = $com0['data']['list_department'];
$cou2 = count($list_dep);

if (isset($_GET['id']) && $_GET['id'] != "") {
    $id_dh = $_GET['id'];
    $ctiet_dh = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`id_du_an_ctrinh`, d.`ngay_ky`,
                                d.`thoi_han`, d.`don_vi_nhan_hang`, d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`,
                                d.`ghi_chu`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`phan_loai`, d.`hieu_luc`, d.`trang_thai`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`
                                FROM `don_hang` AS d
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                WHERE d.`id` = $id_dh AND d.`id_cong_ty` = $com_id AND d.`phan_loai` = 2 "))->result);

    $id_hop_dong = $ctiet_dh['id_hop_dong'];
    $id_ncc = $ctiet_dh['id_nha_cc_kh'];
    $list_hd = new db_query("SELECT `id_hop_dong` FROM `don_hang` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id AND `id_nha_cc_kh` = $id_ncc ");
    $list_vt = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`, `so_luong_ky_nay`,
                                `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_dh AND `id_cong_ty` = $com_id ");

    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response1 = curl_exec($curl);
    curl_close($curl);
    $data_list1 = json_decode($response1, true);
    $list_ctrinh = $data_list1['data']['items'];
    $cou3 = count($list_ctrinh);

    $stt = 1;

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list2 = json_decode($response, true);
    $list_vattu = $data_list2['data']['items'];
    $cou4 = count($list_vattu);

    $all_vattu = [];
    for ($l = 0; $l < $cou4; $l++) {
        $item3 = $list_vattu[$l];
        $all_vattu[$item3['dsvt_id']] = $item3;
    };

    $list_kh = new db_query("SELECT DISTINCT n.`id`, n.`ten_nha_cc_kh` FROM `nha_cc_kh` AS n
                        INNER JOIN `hop_dong` AS h ON n.`id` = h.`id_nha_cc_kh`
                        WHERE n.`phan_loai` = 2 AND n.`id_cong_ty` = $com_id AND h.`phan_loai` = 2 ");
} else {
    echo "";
};

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ch???nh s???a ????n h??ng b??n v???t t??</title>
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
    <div class="main-container ql_sua_dh_ban">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-don-hang.html">
                            Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Ch???nh s???a ????n h??ng b??n v???t t??</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $phan_loai_nk ?>" data1="<?= $id_dh ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>T??n kh??ch h??ng <span class="cr_red">*</span></label>
                                        <select name="ten_khach_hang" class="form-control all_nhacc">
                                            <option value="">Nh???p t??n kh??ch h??ng</option>
                                            <? while ($row1 = mysql_fetch_assoc($list_kh->result)) { ?>
                                                <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $ctiet_dh['id_nha_cc_kh']) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>?????a ch???</label>
                                        <input type="text" name="dia_chi" class="form-control" value="<?= $ctiet_dh['dia_chi_lh'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Ng?????i li??n h???</label>
                                        <? if ($phan_loai_nk == 1) { ?>
                                            <select name="nguoi_lh" class="form-control share_select all_nvct">
                                                <option value="">-- Ch???n ng?????i li??n h??? --</option>
                                                <? for ($k = 0; $k < $count; $k++) { ?>
                                                    <option value="<?= $list_nv[$k]['ep_id'] ?>" <?= ($list_nv[$k]['ep_id'] == $ctiet_dh['id_nguoi_lh']) ? "selected" : "" ?>>(<?= $list_nv[$k]['ep_id'] ?>) <?= $list_nv[$k]['ep_name'] ?></option>
                                                <? } ?>
                                            </select>
                                        <? } else if ($phan_loai_nk == 2) { ?>
                                            <input type="text" name="nguoi_lh" class="form-control all_nvct" value="<?= $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'] ?>" data="<?= $ctiet_dh['id_nguoi_lh'] ?>" readonly>
                                        <? } ?>

                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>S??? ??i???n tho???i / Fax</label>
                                        <input type="text" name="so_dthoai" value="<?= $ctiet_dh['so_dien_thoai'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>H???p ?????ng <span class="cr_red">*</span></label>
                                        <select name="hop_dong" class="form-control all_hd" data="<?= $com_id ?>" data1="<?= $ctiet_dh['id_hop_dong'] ?>" data2="<?= $ctiet_dh['id_nha_cc_kh'] ?>">
                                            <option value="">-- Ch???n h???p ?????ng --</option>
                                            <? while ($item_hd = mysql_fetch_assoc($list_hd->result)) { ?>
                                                <option value="<?= $item_hd['id_hop_dong'] ?>" <?= ($item_hd['id_hop_dong'] == $id_hop_dong) ? "selected" : "" ?>>H?? - <?= $item_hd['id_hop_dong'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? ????n h??ng</label>
                                        <input type="text" name="so_dh" value="??H - <?= $id_dh ?>" data="<?= $id_dh ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ng??y k?? ????n h??ng</label>
                                        <input type="date" name="ngay_ky" value="<?= ($ctiet_dh['ngay_ky'] != 0) ? date('Y-m-d', time()) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>D??? ??n / C??ng tr??nh</label>
                                        <select name="duan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Ch???n D??? ??n / C??ng tr??nh --</option>
                                            <? for ($a = 0; $a < $cou3; $a++) { ?>
                                                <option value="<?= $list_ctrinh[$a]['ctr_id'] ?>" <?= ($list_ctrinh[$a]['ctr_id'] == $ctiet_dh['id_du_an_ctrinh']) ? "selected" : "" ?>><?= $list_ctrinh[$a]['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Th???i h???n ????n h??ng</label>
                                        <input type="date" name="thoi_han" value="<?= ($ctiet_dh['thoi_han'] != 0) ? date('Y-m-d', $ctiet_dh['thoi_han']) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>????n v??? nh???n h??ng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control" placeholder="Nh???p ????n v??? nh???n h??ng" value="<?= $ctiet_dh['don_vi_nhan_hang'] ?>">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Ph??ng ban</label>
                                        <? if ($ctiet_dh['phan_loai'] == 1) { ?>
                                            <select name="phong_ban" class="phong_ban">
                                                <option value=""> -- Ch???n ph??ng ban -- </option>
                                                <? for ($b = 0; $b < $cou2; $b++) { ?>
                                                    <option value="<?= $list_dep['dep_id'] ?>" <?= ($list_dep['dep_id'] == $ctiet_dh['phong_ban']) ? "selected" : "" ?>><?= $list_dep['dep_name'] ?></option>
                                                <? } ?>
                                            </select>
                                        <? } else if ($ctiet_dh['phan_loai'] == 2) { ?>
                                            <input type="text" name="phong_ban" value="<?= $ctiet_dh['phong_ban'] ?>" class="form-control phong_ban" placeholder="Nh???p ph??ng ban ng?????i nh???n">
                                        <? } ?>

                                    </div>
                                    <div class="form-group">
                                        <label>Ng?????i nh???n h??ng <span class="cr_red">*</span></label>
                                        <input type="text" name="nguoi_nh" value="<?= $ctiet_dh['nguoi_nhan_hang'] ?>" class="form-control" placeholder="Nh???p ng?????i nh???n h??ng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? ??i???n tho???i ng?????i nh???n</label>
                                        <input type="text" name="dient_nnhan" value="<?= ($ctiet_dh['dien_thoai_nn'] == 0) ? "" : $ctiet_dh['dien_thoai_nn'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gi??? l???i b???o h??nh</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" value="<?= ($ctiet_dh['giu_lai_bao_hanh'] != 0) ? $ctiet_dh['giu_lai_bao_hanh'] : "" ?>" class="baoh_pt pt_bao_hanh pl-10 share_fsize_one" onkeyup="baoHanh()">
                                            </div>
                                            <span>t????ng ??????ng</span>
                                            <input type="text" name="gia_tri" value="<?= ($ctiet_dh['gia_tri_tuong_duong'] != 0) ? $ctiet_dh['gia_tri_tuong_duong'] : "" ?>" class="gia_tri gia_tri_bh pl-10 share_fsize_one" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi ch??</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nh???p ghi ch??"><?= $ctiet_dh['ghi_chu'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? tr?????c VAT</label>
                                        <input type="text" name="giatr_vat" value="<?= $ctiet_dh['gia_tri_don_hang'] ?>" id="tong_truoc_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label>????n gi?? ???? bao g???m VAT</label>
                                        <input type="checkbox" name="dgia_vat" value="1" <?= ($ctiet_dh['bao_gom_vat'] == 0) ? "" : "checked" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Thu??? su???t VAT</label>
                                        <input type="text" name="thue_vat_tong" class="form-control thue_vat_tong" value="<?= $ctiet_dh['thue_vat'] ?>" placeholder="Nh???p thu??? su???t VAT" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ti???n chi???t kh???u</label>
                                        <input type="text" name="tien_ckhau" class="form-control" value="<?= $ctiet_dh['chiet_khau'] ?>" placeholder="Nh???p s??? ti???n chi???t kh???u">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? sau VAT</label>
                                        <input type="text" name="gias_vat" value="<?= $ctiet_dh['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Chi ph?? v???n chuy???n</label>
                                        <input type="text" name="chi_phi_vc" class="form-control" value="<?= $ctiet_dh['chi_phi_vchuyen'] ?>" placeholder="Nh???p chi ph?? v???n chuy???n">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi ch?? v???n chuy???n</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control" placeholder="Nh???p ghi ch?? v???n chuy???n"><?= $ctiet_dh['ghi_chu_vchuyen'] ?></textarea>
                                </div>

                                <div class="them_moi_vt w_100 float_l mt_25">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_one">M?? v???t t??</th>
                                                    <th class="share_tb_two">T??n ?????y ????? v???t t?? thi???t b???</th>
                                                    <th class="share_tb_seven">????n v??? t??nh</th>
                                                    <th class="share_tb_two">H??ng s???n xu???t</th>
                                                    <th class="share_tb_eight">S??? l?????ng theo h???p ?????ng</th>
                                                    <th class="share_tb_eight">S??? l?????ng l??y k??? k??? tr?????c</th>
                                                    <th class="share_tb_one">S??? l?????ng k??? n??y</th>
                                                    <th class="share_tb_eight">Th???i gian giao h??ng</th>
                                                    <th class="share_tb_two">????n gi??</th>
                                                    <th class="share_tb_two">T???ng ti???n tr?????c VAT</th>
                                                    <th class="share_tb_seven">Thu??? VAT</th>
                                                    <th class="share_tb_eight">T???ng ti???n sau VAT</th>
                                                    <th class="share_tb_two">?????a ??i???m giao h??ng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? while ($row2 = mysql_fetch_assoc($list_vt->result)) {
                                                    $id_vttu = $row2['id_vat_tu'];
                                                    $so_luong_kn = $row2['so_luong_ky_nay'];
                                                    $sum_vt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_luong_ky_nay`) AS sum_vt FROM `vat_tu_dh_mua_ban`
                                                            WHERE `id_cong_ty` = $com_id AND `id_hd` = $id_hop_dong AND `id_vat_tu` = $id_vttu "))->result)['sum_vt']; ?>

                                                    <tr class="item">
                                                        <td class="share_tb_seven">
                                                            <p>
                                                                <img src="../img/remove.png" alt="x??a" class="dele_cot_ngang share_cursor">
                                                            </p>
                                                        </td>
                                                        <td class="share_tb_seven">
                                                            <p><?= $stt++ ?></p>
                                                            <input type="hidden" name="vat_tu" value="<?= $row2['id'] ?>">
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group share_form_select">
                                                                <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group share_form_select">
                                                                <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_seven">
                                                            <div class="form-group">
                                                                <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_hd" value="<?= $row2['so_luong_theo_hd'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_kt" value="<?= $sum_vt - $so_luong_kn ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="type" name="sl_knay" value="<?= $row2['so_luong_ky_nay'] ?>" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="date" name="thoig_ghang" value="<?= ($row2['thoi_gian_giao_hang'] != 0) ? date('Y-m-d', $row2['thoi_gian_giao_hang']) : "" ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="ttr_vat" value="<?= $row2['tong_tien_trvat'] ?>" class="form-control tong_trvat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_seven">
                                                            <div class="form-group">
                                                                <input type="type" name="thue_vat" data="<?= $row2['don_gia'] * $row2['so_luong_ky_nay'] * ($row2['thue_vat'] / 100) ?>" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="number" name="tts_vat" value="<?= $row2['tong_tien_svat'] ?>" class="form-control tong_svat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="dia_chi_g" value="<?= $row2['dia_diem_giao_hang'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button dh_button">
                                        <button type="button" class="cancel_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">H???y</button>
                                        <button type="button" class="save_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n h???y vi???c s???a ????n h??ng
                                    b??n?</p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex dh_dy_pop">
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
    $(".all_nhacc, .all_da_ct, .all_hd").select2({
        width: '100%',
    });

    $(".all_nhacc").change(function() {
        var id_kh = $(this).val();
        var com_id = $(".form_add_hp_mua").attr("data");
        $.ajax({
            url: '../render/dh_hdongban.php',
            type: 'POST',
            data: {
                id_kh: id_kh,
                com_id: com_id,
            },
            success: function(data) {
                $(".all_hd").html(data);
            }
        });

        $.ajax({
            url: '../render/diachi_lh_dhb.php',
            type: 'POST',
            data: {
                id_kh: id_kh,
                com_id: com_id,
            },
            success: function(data) {
                $(".thay_doi_dc").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_vattu_hdb.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_kh: id_kh
            },
            success: function(data) {
                $(".table tbody").html(data);
            }
        });

    });

    $(".all_hd").change(function() {
        var id_hd = $(this).val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var id_kh = $(".all_nhacc").val();
        var id_dh = $(".ctiet_dk_hp").attr("data1");
        $.ajax({
            url: '../render/ds_vattu_hdb.php',
            type: 'POST',
            data: {
                id_hd: id_hd,
                com_id: com_id,
                id_kh: id_kh,
                id_dh: id_dh,
            },
            success: function(data) {
                $(".table tbody").html(data);
            }
        });
    });
    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $('.save_add').click(function() {
        var form = $('.form_add_hp_mua');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-group'));
                error.wrap('<span class="error">');
            },
            rules: {
                ten_khach_hang: {
                    required: true,
                },
                hop_dong: {
                    required: true,
                },
                donv_nh: {
                    required: true,
                },
                nguoi_nh: {
                    required: true,
                }
            },
            messages: {
                ten_khach_hang: {
                    required: "Vui l??ng ch???n kh??ch h??ng",
                },
                hop_dong: {
                    required: "Vui l??ng ch???n h???p ?????ng",
                },
                donv_nh: {
                    required: "????n v??? nh???n h??ng kh??ng ???????c ????? tr???ng.",
                },
                nguoi_nh: {
                    required: "Ng?????i nh???n h??ng kh??ng ???????c ????? tr???ng."
                }
            }
        });
        if (form.valid() === true) {
            var com_id = $(".form_add_hp_mua").attr("data");
            var user_id = $(".form_add_hp_mua").attr("data1");
            var id_kh = $("select[name='ten_khach_hang']").val();
            var id_hd = $("select[name='hop_dong']").val();
            var so_dh = $("input[name='so_dh']").attr("data");
            var ngay_ky = $("input[name='ngay_ky']").val();
            var id_ctrinh = $("select[name = 'duan_ctrinh']").val();
            var thoi_han = $("input[name='thoi_han']").val();
            var donv_nh = $("input[name='donv_nh']").val();
            var phong_ban = $("input[name='phong_ban']").val();
            var nguoi_nh = $("input[name='nguoi_nh']").val();
            var dient_nnhan = $("input[name='dient_nnhan']").val();
            var baoh_hd = $("input[name='baoh_hd']").val();

            var gia_tri = $("input[name='gia_tri']").val();
            var ghi_chu = $("textarea[name='yc_tiendo']").val();
            var giatr_vat = $("input[name='giatr_vat']").val();
            var bg_gia_vat = 0;
            if ($("input[name='dgia_vat']").is(":checked")) {
                bg_gia_vat = 1;
            };
            var thue_vat = $("input[name='thue_vat_tong']").val();
            var tien_ckhau = $("input[name='tien_ckhau']").val();
            var gias_vat = $("input[name='gias_vat']").val();
            var chi_phi_vc = $("input[name='chi_phi_vc']").val();
            var ghic_vc = $("textarea[name='ghic_vc']").val();
            var phan_loai_nk = $(".ctiet_dk_hp").attr("data");
            if (phan_loai_nk == 1) {
                var id_nguoi_lh = $(".all_nvct").val();
            } else if (phan_loai_nk == 2) {
                var id_nguoi_lh = $(".all_nvct").attr("data");
            }

            var id_vt_dc = [];
            $("input[name='vat_tu']").each(function() {
                var idvt = $(this).val();
                if (idvt != "") {
                    id_vt_dc.push(idvt);
                }
            });

            var ma_vt = [];
            $("input[name='ma_vattu']").each(function() {
                var mavt = $(this).attr("data");
                ma_vt.push(mavt);
            });

            var so_luong_hd = [];
            $("input[name='so_luong_hd']").each(function() {
                var sl_hd = $(this).val();
                if (sl_hd != "") {
                    so_luong_hd.push(sl_hd);
                }
            });

            var so_luong_kn = [];
            $("input[name='sl_knay']").each(function() {
                var sl = $(this).val();
                if (sl == "") {
                    sl = 0;
                    so_luong_kn.push(sl);
                } else {
                    so_luong_kn.push(sl);
                }
            });

            var thoi_gian_gh = [];
            $("input[name='thoig_ghang']").each(function() {
                var tg_gh = $(this).val();
                if (tg_gh == "") {
                    tg_gh = 0;
                    thoi_gian_gh.push(tg_gh);
                } else {
                    thoi_gian_gh.push(tg_gh);
                }
            });

            var don_gia = [];
            $("input[name='don_gia']").each(function() {
                var dg_vt = $(this).val();
                if (dg_vt != "") {
                    don_gia.push(dg_vt);
                }
            });

            var ttr_vat = [];
            $("input[name='ttr_vat']").each(function() {
                var tien_tr = $(this).val();
                if (tien_tr == "") {
                    tien_tr = 0;
                    ttr_vat.push(tien_tr);
                } else {
                    ttr_vat.push(tien_tr);
                }
            });

            var thue_vat_vt = [];
            $("input[name='thue_vat']").each(function() {
                var thue_vt = $(this).val();
                if (thue_vt == "") {
                    thue_vt = 0;
                    thue_vat_vt.push(thue_vt);
                } else if (thue_vt != "") {
                    thue_vat_vt.push(thue_vt);
                }
            });

            var tts_vat = [];
            $("input[name='tts_vat']").each(function() {
                var tien_s = $(this).val();
                if (tien_s == "") {
                    tien_s = 0;
                    tts_vat.push(tien_s);
                } else if (tien_s != "") {
                    tts_vat.push(tien_s);
                }
            });

            var dia_chi_g = [];
            $("input[name='dia_chi_g']").each(function() {
                var dia_chi = $(this).val()
                dia_chi_g.push(dia_chi);
            });

            $.ajax({
                url: '../ajax/sua_dh_ban.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
                    id_nguoi_lh: id_nguoi_lh,
                    id_kh: id_kh,
                    id_hd: id_hd,
                    so_dh: so_dh,
                    ngay_ky: ngay_ky,
                    id_ctrinh: id_ctrinh,
                    thoi_han: thoi_han,
                    donv_nh: donv_nh,
                    phong_ban: phong_ban,
                    nguoi_nh: nguoi_nh,
                    dient_nnhan: dient_nnhan,
                    baoh_hd: baoh_hd,
                    gia_tri: gia_tri,
                    ghi_chu: ghi_chu,
                    giatr_vat: giatr_vat,
                    bg_gia_vat: bg_gia_vat,
                    thue_vat: thue_vat,
                    tien_ckhau: tien_ckhau,
                    gias_vat: gias_vat,
                    chi_phi_vc: chi_phi_vc,
                    ghic_vc: ghic_vc,
                    phan_loai_nk: phan_loai_nk,
                    id_vt_dc: id_vt_dc,
                    ma_vt: ma_vt,
                    so_luong_hd: so_luong_hd,
                    so_luong_kn: so_luong_kn,
                    thoi_gian_gh: thoi_gian_gh,
                    don_gia: don_gia,
                    ttr_vat: ttr_vat,
                    thue_vat_vt: thue_vat_vt,
                    tts_vat: tts_vat,
                    dia_chi_g: dia_chi_g,
                },
                success: function(data) {
                    if (data == "") {
                        alert("B???n ???? s???a ????n h??ng th??nh c??ng");
                        window.location.href = '/quan-ly-don-hang.html';
                    } else if (data != "") {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>