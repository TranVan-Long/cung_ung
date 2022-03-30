<?php

include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];

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
        $cou = count($list_nv);
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang = explode(',', $item_nv['don_hang']);
            if (in_array(3, $don_hang) == FALSE) {
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
                                WHERE d.`id` = $id_dh AND d.`id_cong_ty` = $com_id "))->result);

    $list_vt = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`, `so_luong_ky_nay`,
                                `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_dh AND `id_cong_ty` = $com_id ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
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

    $list_kh = new db_query("SELECT DISTINCT n.`id`, n.`ten_nha_cc_kh`, n.`id_cong_ty` FROM `nha_cc_kh` AS n
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
    <title>Chỉnh sửa đơn hàng bán vật tư</title>
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
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Chỉnh sửa đơn hàng bán vật tư</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên khách hàng <span class="cr_red">*</span></label>
                                        <select name="ten_khach_hang" class="form-control all_nhacc">
                                            <option value="">Nhập tên khách hàng</option>
                                            <? while ($row1 = mysql_fetch_assoc($list_kh->result)) { ?>
                                                <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $ctiet_dh['id_nha_cc_kh']) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="dia_chi" class="form-control" value="<?= $ctiet_dh['dia_chi_lh'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Người liên hệ</label>
                                        <input type="text" name="nguoi_lh" class="form-control" value="<?= $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'] ?>" data="<?= $ctiet_dh['id_nguoi_lh'] ?>" readonly>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Số điện thoại / Fax</label>
                                        <input type="text" name="so_dthoai" value="<?= $ctiet_dh['so_dien_thoai'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng <span class="cr_red">*</span></label>
                                        <select name="hop_dong" class="form-control all_hd" data="<?= $com_id ?>" data1="<?= $ctiet_dh['id_hop_dong'] ?>" data2="<?= $ctiet_dh['id_nha_cc_kh'] ?>">
                                            <option value="">-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số đơn hàng</label>
                                        <input type="text" name="so_dh" value="ĐH - <?= $id_dh ?>" data="<?= $id_dh ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký đơn hàng</label>
                                        <input type="date" name="ngay_ky" value="<?= ($ctiet_dh['ngay_ky'] != 0) ? date('Y-m-d', time()) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="duan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                            <? for ($a = 0; $a < $cou3; $a++) { ?>
                                                <option value="<?= $list_ctrinh[$a]['ctr_id'] ?>" <?= ($list_ctrinh[$a]['ctr_id'] == $ctiet_dh['id_du_an_ctrinh']) ? "selected" : "" ?>><?= $list_ctrinh[$a]['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn đơn hàng</label>
                                        <input type="date" name="thoi_han" value="<?= ($ctiet_dh['thoi_han'] != 0) ? date('Y-m-d', $ctiet_dh['thoi_han']) : "" ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đơn vị nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control" placeholder="Nhập đơn vị nhận hàng" value="<?= $ctiet_dh['don_vi_nhan_hang'] ?>">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Phòng ban</label>
                                        <? if ($ctiet_dh['phan_loai'] == 1) { ?>
                                            <select name="phong_ban" class="phong_ban">
                                                <option value=""> -- Chọn phòng ban -- </option>
                                                <? for ($b = 0; $b < $cou2; $b++) { ?>
                                                    <option value="<?= $list_dep['dep_id'] ?>" <?= ($list_dep['dep_id'] == $ctiet_dh['phong_ban']) ? "selected" : "" ?>><?= $list_dep['dep_name'] ?></option>
                                                <? } ?>
                                            </select>
                                        <? } else if ($ctiet_dh['phan_loai'] == 2) { ?>
                                            <input type="text" name="phong_ban" value="<?= $ctiet_dh['phong_ban'] ?>" class="form-control phong_ban" placeholder="Nhập phòng ban người nhận">
                                        <? } ?>

                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="nguoi_nh" value="<?= $ctiet_dh['nguoi_nhan_hang'] ?>" class="form-control" placeholder="Nhập người nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số điện thoại người nhận</label>
                                        <input type="text" name="dient_nnhan" value="<?= ($ctiet_dh['dien_thoai_nn'] == 0) ? "" : $ctiet_dh['dien_thoai_nn'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" value="<?= ($ctiet_dh['giu_lai_bao_hanh'] != 0) ? $ctiet_dh['giu_lai_bao_hanh'] : "" ?>" class="baoh_pt pt_bao_hanh pl-10 share_fsize_one" onkeyup="baoHanh()">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri" value="<?= ($ctiet_dh['gia_tri_tuong_duong'] != 0) ? $ctiet_dh['gia_tri_tuong_duong'] : "" ?>" class="gia_tri gia_tri_bh pl-10 share_fsize_one" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nhập ghi chú"><?= $ctiet_dh['ghi_chu'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="giatr_vat" value="<?= $ctiet_dh['gia_tri_don_hang'] ?>" id="tong_truoc_vat" class="form-control h_border cr_weight">
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label>Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" name="dgia_vat" value="1" <?= ($ctiet_dh['bao_gom_vat'] == 0) ? "" : "checked" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Thuế suất VAT</label>
                                        <input type="text" name="thue_vat_tong" class="form-control thue_vat_tong" value="<?= $ctiet_dh['thue_vat'] ?>" onkeyup="tong_vt()" oninput="<?= $oninput ?>" placeholder="Nhập thuế suất VAT">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiền chiết khấu</label>
                                        <input type="text" name="tien_ckhau" class="form-control" value="<?= $ctiet_dh['chiet_khau'] ?>" placeholder="Nhập số tiền chiết khấu">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="gias_vat" value="<?= $ctiet_dh['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control h_border cr_weight">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Chi phí vận chuyển</label>
                                        <input type="text" name="chi_phi_vc" class="form-control" value="<?= $ctiet_dh['chi_phi_vchuyen'] ?>" placeholder="Nhập chi phí vận chuyển">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú vận chuyển</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control" placeholder="Nhập ghi chú vận chuyển"><?= $ctiet_dh['ghi_chu_vchuyen'] ?></textarea>
                                </div>

                                <div class="them_moi_vt w_100 float_l mt_25">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_two">Vật tư thiết bị</th>
                                                    <th class="share_tb_one">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_eight">Số lượng theo hợp đồng</th>
                                                    <th class="share_tb_two">Số lượng lũy kế kỳ trước</th>
                                                    <th class="share_tb_one">Số lượng kỳ này</th>
                                                    <th class="share_tb_one">Thời gian giao hàng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_one">Thuế VAT</th>
                                                    <th class="share_tb_eight">Tổng tiền sau VAT</th>
                                                    <th class="share_tb_two">Địa điểm giao hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? while ($row2 = mysql_fetch_assoc($list_vt->result)) { ?>
                                                    <tr class="item">
                                                        <td class="share_tb_seven">
                                                            <p>
                                                                <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                                                            </p>
                                                        </td>
                                                        <td class="share_tb_seven"><?= $stt++ ?></td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="ma_vatt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" data-id="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control tex_center" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="hsan_xuat" class="form-control tex_center" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_hd" class="form-control tex_center" value="<?= $row2['so_luong_theo_hd'] ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="so_luong_kt" class="form-control tex_center" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="number" name="sl_knay" value="<?= $row2['so_luong_ky_nay'] ?>" class="form-control tex_center so_luong" onkeyup="sl_doi(this)">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="date" name="thoig_ghang" value="<?= ($row2['thoi_gian_giao_hang'] != 0) ? date("Y-m-d", $row2['thoi_gian_giao_hang']) : "" ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control tex_center don_gia" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="ttr_vat" value="<?= $row2['tong_tien_trvat'] ?>" class="form-control tex_center tong_trvat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="number" name="thue_vat_vt" value="<?= $row2['thue_vat'] ?>" class="form-control tex_center thue_vat" onkeyup="thue_doi(this)">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="number" name="tts_vat" value="<?= $row2['tong_tien_svat'] ?>" class="form-control tex_center tong_svat" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="dia_chi_g" value="<?= $row2['dia_diem_giao_hang'] ?>" class="form-control tex_center">
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
                                        <button type="button" class="cancel_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa đơn hàng
                                    bán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex dh_dy_pop">
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
    $(".all_nhacc, .all_nguoilh, .all_da_ct, .all_hd, .ma_vatt").select2({
        width: '100%',
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    var com_id = $(".all_hd").attr("data");
    var id_kh = $(".all_hd").attr("data2");
    var id_hd = $(".all_hd").attr("data1");

    $.ajax({
        url: '../render/dh_hdongban.php',
        type: 'POST',
        data: {
            id_kh: id_kh,
            com_id: com_id,
            id_hd: id_hd,
        },
        success: function(data) {
            $(".all_hd").html(data);
        }
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
                    required: "Vui lòng chọn khách hàng",
                },
                hop_dong: {
                    required: "Vui lòng chọn hợp đồng",
                },
                donv_nh: {
                    required: "Đơn vị nhận hàng không được để trống.",
                },
                nguoi_nh: {
                    required: "Người nhận hàng không được để trống."
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

            var ma_vatt = new Array();
            $("input[name='ma_vatt']").each(function() {
                var vatt = $(this).attr("data-id");
                ma_vatt.push(vatt);
            });

            var soluong_hd = new Array();
            $("input[name='so_luong_hd']").each(function() {
                var sl_hd = $(this).val();
                soluong_hd.push(sl_hd);
            });

            var sl_knay = new Array();
            $("input[name='sl_knay']").each(function() {
                var sl_kn = $(this).val();
                if (sl_kn == 0 && sl_kn == "") {
                    sl_kn = 0;
                    sl_knay.push(sl_kn);
                } else if (sl_kn != 0) {
                    sl_knay.push(sl_kn);
                }
            });

            var thoig_ghang = new Array();
            $("input[name='thoig_ghang']").push(function() {
                var tg_gh = $(this).val();
                if (tg_gh == 0 && tg_gh == "") {
                    tg_gh = 0;
                    thoig_ghang.push(tg_gh);
                } else if (tg_gh != 0) {
                    thoig_ghang.push(tg_gh);
                }
            });

            var don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dgia = $(this).val();
                don_gia.push(dgia);
            });

            var ttr_vat = new Array();
            $("input[name='ttr_vat']").each(function() {
                var tvat = $(this).val();
                if (tvat == "" && tvat == 0) {
                    tvat = 0;
                    ttr_vat.push(tvat);
                } else if (tvat != 0) {
                    ttr_vat.push(tvat);
                }
            });

            var thue_vat_vt = new Array();
            $("input[name='thue_vat_vt']").each(function() {
                var thvat = $(this).val();
                if (thvat == "" && thvat == 0) {
                    thvat = 0;
                    thue_vat_vt.push(thvat);
                } else if (thvat != 0) {
                    thue_vat_vt.push(thvat);
                }
            });

            var tts_vat = new Array();
            $("input[name='tts_vat']").each(function() {
                var svat = $(this).val();
                if (svat == "" && svat == 0) {
                    svat = 0;
                    tts_vat.push(svat);
                } else if (svat != 0) {
                    tts_vat.push(svat);
                }
            });

            var dia_chi_g = new Array();
            $("input[name='dia_chi_g']").each(function() {
                var dc_gh = $(this).val();
                if (dc_gh == "" && dc_gh == 0) {
                    dc_gh = 0;
                    dia_chi_g.push(dc_gh);
                } else if (dc_gh != 0) {
                    dia_chi_g.push(dc_gh);
                }
            });

            $.ajax({
                url: '../ajax/sua_dh_ban.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
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

                    ma_vatt: ma_vatt,
                    soluong_hd: soluong_hd,
                    sl_knay: sl_knay,
                    thoig_ghang: thoig_ghang,
                    don_gia: don_gia,
                    ttr_vat: ttr_vat,
                    thue_vat_vt: thue_vat_vt,
                    tts_vat: tts_vat,
                    dia_chi_g: dia_chi_g,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã sửa đơn hàng thành công");
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