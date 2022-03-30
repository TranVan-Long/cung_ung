<?php
include "../includes/icon.php";
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];

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
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $com_name = $_SESSION['com_name'];
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
    $list_nv = $data_list['data']['items'];

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `ho_so_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $hs_tt = explode(',', $item_nv['ho_so_tt']);
        if (in_array(1, $hs_tt) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
};

$user = [];
for ($i = 0; $i < count($list_nv); $i++) {
    $item1 = $list_nv[$i];
    $user[$item1["ep_id"]] = $item1;
};

$id = getValue('id', 'int', 'GET', '');

if ($id != "") {
    $list_hs = new db_query("SELECT `id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`, `tong_tien_tatca`,`tong_tien_tt`, `tong_tien_thue`, `chi_phi_khac` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $id");

    $ho_so = mysql_fetch_assoc($list_hs->result);
    $loai_hs = $ho_so['loai_hs'];
    $id_hd_dh = $ho_so['id_hd_dh'];

    $ds_vattu_hs = new db_query("SELECT `id`, `id_vat_tu`, `kl_ky_nay`, `gia_tri_ky_nay`, `ngay_tao`, `id_cong_ty`
                                FROM `chi_tiet_hs` WHERE `id_hs` = $id AND `id_hd_dh` = $id_hd_dh ");



    if ($loai_hs == 1) {
        $phan_loai_hd = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `hop_dong` AS h
                                    INNER JOIN `nha_cc_kh` AS n ON h.`id_nha_cc_kh` = n.`id`
                                    WHERE h.`id` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");

        $ploai_hd = mysql_fetch_assoc($phan_loai_hd->result);

        $loai_hd = $ploai_hd['phan_loai'];

        if ($loai_hd == 1) {
            $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];

            $vattu_hd_dh = new db_query("SELECT v.`id_vat_tu`, v.`id_hd_mua_ban`, v.`so_luong`, v.`don_gia`, v.`tien_trvat`, v.`thue_vat`, v.`tien_svat`
                                    FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                                    WHERE v.`id_hd_mua_ban` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");

            $tong_tien = mysql_fetch_assoc((new db_query("SELECT `id_du_an_ctrinh`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`
                                                        FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);
        } else if ($loai_hd == 2) {
            $dv_thuc_hien = $com_name;

            $vattu_hd_dh = new db_query("SELECT v.`id_vat_tu`, v.`id_hd_mua_ban`, v.`so_luong`, v.`don_gia`, v.`tien_trvat`, v.`thue_vat`, v.`tien_svat`
                                    FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                                    WHERE v.`id_hd_mua_ban` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");

            $tong_tien = mysql_fetch_assoc((new db_query("SELECT `id_du_an_ctrinh`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`
                                                        FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);
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

            $tong_tien = mysql_fetch_assoc((new db_query("SELECT `id_du_an_ctrinh`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`
                                                        FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);
        }
    } else if ($loai_hs == 2) {
        $phan_loai_dh = new db_query("SELECT  d.`phan_loai`, n.`ten_nha_cc_kh`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat` 
                                        FROM `don_hang` AS d
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

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);
    $data_list1 = json_decode($response1, true);
    $list_vattu = $data_list1['data']['items'];
    $cou2 = count($list_vattu);

    $all_vattu = [];
    for ($j = 0; $j < $cou2; $j++) {
        $item2 = $list_vattu[$j];
        $all_vattu[$item2['dsvt_id']] = $item2;
    };
}

// echo "<pre>";
// print_r($list_vattu);
// echo "</pre>";
// die();
$stt = 1;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết hồ sơ thanh toán</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_ct_phieu ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-ho-so-thanh-toan.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi tiết hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng / Đơn hàng</p>
                                    <? if ($ho_so['loai_hs'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $ho_so['id_hd_dh'] ?></p>
                                    <? } else if ($ho_so['loai_hs'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">ĐH - <?= $ho_so['id_hd_dh'] ?></p>
                                    <? } ?>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị thực hiện</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $dv_thuc_hien ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đợt nghiệm thu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ho_so['dot_nghiem_thu'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời gian</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($ho_so['tg_nghiem_thu'] != 0) ? date('d/m/Y', $ho_so['tg_nghiem_thu']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời hạn thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($ho_so['thoi_han_thanh_toan'] != 0) ? date('d/m/Y', $ho_so['thoi_han_thanh_toan']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Trạng thái</p>
                                    <? if ($ho_so['trang_thai'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one cr_red">Chưa hoàn thành</p>
                                    <? } else if ($ho_so['trang_thai'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one text_green">Hoàn thành</p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $user[$ho_so['id_nguoi_lap']]['ep_name'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= date('d/m/Y', $ho_so['ngay_tao']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper mt-10 them_moi_vt">
                            <div class="table-container table-3900 ds_vat_tu" data="<?= $user_id ?>">
                                <div class="tbl-header">
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
                                            <? while ($row1 = mysql_fetch_assoc($vattu_hd_dh->result)) {
                                                $id_vt = $row1['id_vat_tu'];
                                                $all_vt = mysql_fetch_assoc((new db_query("SELECT `id`, `kl_ky_nay`, `gia_tri_ky_nay` FROM `chi_tiet_hs`
                                                                                WHERE `id_hs` = $id AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh AND `id_vat_tu` = $id_vt "))->result);

                                                $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                                            INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                                            WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
                                                                            AND h.`loai_hs` = 2 AND c.`id_vat_tu` = $id_vt AND h.`id` != $id ");
                                                $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                                $sum_one = $list_sum['sum_one'];
                                                $sum_two = $list_sum['sum_two'];

                                            ?>
                                                <tr>
                                                    <td class="w-10"><?= $stt++ ?></td>
                                                    <td class="w-20"><?= $all_vattu[$id_vt]['dsvt_name'] ?></td>
                                                    <td class="w-10"><?= $all_vattu[$id_vt]['hsx_name'] ?></td>
                                                    <td class="w-10"><?= $all_vattu[$id_vt]['xx_name'] ?></td>
                                                    <td class="w-10"><?= $all_vattu[$id_vt]['dvt_name'] ?></td>
                                                    <td class="w-10"><?= $row1['so_luong_ky_nay'] ?></td>
                                                    <td class="w-10"><?= $row1['don_gia'] ?></td>
                                                    <td class="w-10"><?= $row1['tong_tien_trvat'] ?></td>
                                                    <td class="w-10"><?= $list_sum['sum_one'] ?></td>
                                                    <td class="w-10"><?= $all_vt['kl_ky_nay'] ?></td>
                                                    <td class="w-10"><?= $sum_one + $all_vt['kl_ky_nay'] ?></td>
                                                    <td class="w-10"><?= $sum_two ?></td>
                                                    <td class="w-10"><?= $all_vt['gia_tri_ky_nay'] ?></td>
                                                    <td class="w-10"><?= $sum_two + $all_vt['gia_tri_ky_nay'] ?>
                                                    <td class="w-5"><?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['tong_tien_trvat']) * 100 ?></td>
                                                    <td class="w-10"><?= $row1['so_luong_ky_nay'] - ($sum_one + $all_vt['kl_ky_nay']) ?></td>
                                                    <td class="w-10"><?= $row1['tong_tien_trvat'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?></td>
                                                </tr>
                                            <? } ?>
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
                                                <td class="w-10">100.000(1)</td>
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
                                                <td class="w-10">100.000(2)</td>
                                                <td class="w-10"></td>
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
                                                <td class="w-10">Nhập chi phí khác(3)</td>
                                                <td class="w-10"></td>
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
                                                <td class="w-10"></td>
                                                <td class="w-10"></td>
                                                <td class="w-10"></td>
                                                <td class="w-10"></td>
                                                <td class="w-10">Tổng tiền = 1+2+3</td>
                                                <td class="w-10"></td>
                                                <td class="w-10"></td>
                                                <td class="w-5"></td>
                                                <td class="w-10"></td>
                                                <td class="w-10"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <!-- <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Mã vật tư</th>
                                            <th class="share_tb_four">Tên vật tư</th>
                                            <th class="share_tb_two">Đơn vị tính</th>
                                            <th class="share_tb_two">Hãng sản xuất</th>
                                            <th class="share_tb_two">Xuất xứ</th>
                                            <th class="share_tb_one">Số lượng</th>
                                            <th class="share_tb_two">Đơn giá</th>
                                            <th class="share_tb_four mr-10">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="sh_bgr_four">
                                            <td class="share_tb_one share_clr_four cr_weight">I</td>
                                            <td class="share_tb_two share_clr_four cr_weight">Nâng cấp nhà thi đấu</td>
                                            <td class="share_tb_four"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_four share_clr_four cr_weight">1.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one">1</td>
                                            <td class="share_tb_two">VT-0001</td>
                                            <td class="share_tb_four">Xi măng</td>
                                            <td class="share_tb_two">m3</td>
                                            <td class="share_tb_two">Công ty A</td>
                                            <td class="share_tb_two">Việt Nam</td>
                                            <td class="share_tb_one">100</td>
                                            <td class="share_tb_two">100.000</td>
                                            <td class="share_tb_four">1.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one">1</td>
                                            <td class="share_tb_two">VT-0001</td>
                                            <td class="share_tb_four">Xi măng</td>
                                            <td class="share_tb_two">m3</td>
                                            <td class="share_tb_two">Công ty A</td>
                                            <td class="share_tb_two">Việt Nam</td>
                                            <td class="share_tb_one">100</td>
                                            <td class="share_tb_two">100.000</td>
                                            <td class="share_tb_four">1.000.000</td>
                                        </tr>
                                        <tr class="sh_bgr_four">
                                            <td class="share_tb_one share_clr_four cr_weight">II</td>
                                            <td class="share_tb_two share_clr_four cr_weight">Phải thanh toán</td>
                                            <td class="share_tb_four"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_four share_clr_four cr_weight">1.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two">Tổng cộng trước VAT</td>
                                            <td class="share_tb_four"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_four">1.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two">Thuế VAT</td>
                                            <td class="share_tb_four"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_four">10%</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two">Tổng cộng sau VAT</td>
                                            <td class="share_tb_four"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_one"></td>
                                            <td class="share_tb_two"></td>
                                            <td class="share_tb_four">1.000.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc right d_flex mb-10">
                                <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hs">Xóa</p>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                        <a href="chinh-sua-ho-so-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                    </p>
                                    <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(4, $hs_tt)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hs">Xóa</p>
                                    <? }
                                    if (in_array(3, $hs_tt)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-ho-so-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                        </p>
                                <? }
                                } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc left d_flex mb-10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data=<?= $id ?>>Xuất Excel</p>
                                <p class="share_w_148 ml_20"></p>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỒ SƠ THANH TOÁN</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hồ sơ thanh toán này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
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
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
    var remove_hs = $(".remove_hs");

    remove_hs.click(function() {
        modal_share.show();
    });
    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/hstt_excel.php?id=' + id;
    });
</script>

</html>