<?

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
};

$user = [];
for ($i = 0; $i < count($list_nv); $i++) {
    $item1 = $list_nv[$i];
    $user[$item1["ep_id"]] = $item1;
};

$id = getValue('id', 'int', 'GET', 0);

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

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-ho-so-thanh-toan.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin hồ sơ thanh toán: ' . $ho_so['dot_nghiem_thu'] . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hợp đồng / Đơn hàng:</td>
    <? if ($ho_so['loai_hs'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">HĐ - <?= $ho_so['id_hd_dh'] ?></td>
    <? } else if ($ho_so['loai_hs'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">ĐH - <?= $ho_so['id_hd_dh'] ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị thực hiện:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dv_thuc_hien ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đợt nghiệm thu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ho_so['dot_nghiem_thu'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời gian:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"> <?= ($ho_so['tg_nghiem_thu'] != 0) ? date('d/m/Y', $ho_so['tg_nghiem_thu']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời hạn thanh toán:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($ho_so['thoi_han_thanh_toan'] != 0) ? date('d/m/Y', $ho_so['thoi_han_thanh_toan']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Trạng thái:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">
        <? if ($ho_so['trang_thai'] == 1) { ?>
            Chưa hoàn thành
        <? } else if ($ho_so['trang_thai'] == 2) { ?>
            Đã hoàn thành
        <? } ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người lập:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $user[$ho_so['id_nguoi_lap']]['ep_name'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày lập:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date('d/m/Y', $ho_so['ngay_tao']) ?></td>
</tr>