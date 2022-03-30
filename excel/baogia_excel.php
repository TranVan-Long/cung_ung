<?

include("config.php");
$id = getValue('id', 'int', 'GET', 0);

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
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

$qr_ctiet = new db_query("SELECT b.`id`, b.`id_yc_bg`,b.`id_nha_cc`, b.`id_nguoi_lap`, b.`ngay_gui`, b.`ngay_bd`, b.`ngay_kt`,
                                b.`ngay_tao`,b.`id_cong_ty`, n.`ten_nha_cc_kh` FROM `bao_gia` AS b
                                INNER JOIN `nha_cc_kh` AS n ON b.`id_nha_cc` = n.`id`
                                WHERE b.`id` = $id AND b.`id_cong_ty` = $com_id ");
$list_ct = mysql_fetch_assoc($qr_ctiet->result);
$id_yc_bg = $list_ct['id_yc_bg'];

$user_id = $list_ct['id_nguoi_lap'];
$id_nhacc = $list_ct['nha_cc_kh'];

$list_vt = new db_query("SELECT b.`id`, b.`id_yc_bg`, b.`id_cong_ty`, v.`id_vat_tu`, v.`so_luong_bg`, v.`don_gia`, v.`tong_tien_trvat`,
                            v.`thue_vat`, v.`tong_tien_svat`, v.`cs_kem_theo`, v.`sl_da_dat_hang`
                            FROM `bao_gia` AS b
                            INNER JOIN `vat_tu_da_bao_gia` AS v ON b.`id` = v.`id_bao_gia`
                            WHERE b.`id_cong_ty` = $com_id AND b.`id` = $id ");

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response1 = curl_exec($curl);
curl_close($curl);

$vat_tu = json_decode($response1, true);
$vatt = $vat_tu['data']['items'];

$tenvt = [];
for ($j = 0; $j < count($vatt); $j++) {
    $item2 = $vatt[$j];
    $tenvt[$item2['dsvt_id']] = $item2;
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=excel_ds_ts.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="12" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin báo giá vật tư</th></tr>';

?>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Số báo giá:</td>
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">BG - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ngày gửi:</td>
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= date('d/m/Y', $list_ct['ngay_gui']) ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Người lập:</td>
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $user[$user_id]['ep_name'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Nhà cung cấp:</td>
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $list_ct['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Theo yêu cầu báo giá số:</td>
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">BG - <?= $list_ct['id_yc_bg'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Thời gian áp dụng:</td>
    <? if ($list_ct['ngay_bd'] != 0 && $list_ct['ngay_kt'] != 0) { ?>
        <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Từ: <?= date('d/m/Y', $list_ct['ngay_bd']) ?><br> Đến: <?= date('d/m/Y', $list_ct['ngay_kt']) ?></td>
    <? } else if ($list_ct['ngay_bd'] != 0 && $list_ct['ngay_kt'] == 0) { ?>
        <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Từ: <?= date('d/m/Y', $list_ct['ngay_bd']) ?></td>
    <? } else if ($list_ct['ngay_bd'] == 0 && $list_ct['ngay_kt'] != 0) { ?>
        <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Đến: <?= date('d/m/Y', $list_ct['ngay_kt']) ?></td>
    <? } else { ?>
        <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td colspan="12" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Danh sách vật tư báo giá</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Mã vật tư</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Tên đầy đủ vật tư thiết bị</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Hãng sản xuất</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Đơn vị tính</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Số lượng yêu cầu báo giá</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Số lượng báo giá</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Đơn giá</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Tổng tiền trước VAT</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Thuế VAT</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Tổng sau VAT</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Chính sách khác kèm theo</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Số lượng đã đặt hàng</td>
</tr>
<? while ($row = mysql_fetch_assoc($list_vt->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">VT - <?= $row['id_vat_tu'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;"><?= $tenvt[$row['id_vat_tu']]['dsvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;"><?= $tenvt[$row['id_vat_tu']]['dvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;"><?= $tenvt[$row['id_vat_tu']]['dvt_name'] ?></td>
        <? $phieu_ycbg = $row['id_yc_bg'];
        $id_vt = $row['id_vat_tu'];
        $list_sl = mysql_fetch_assoc((new db_query("SELECT `so_luong_yc_bg`FROM `vat_tu_bao_gia`
                                        WHERE `id_yc_bg` = $phieu_ycbg AND `id_vat_tu` = $id_vt "))->result)['so_luong_yc_bg'] ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $list_sl ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $row['so_luong_bg'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $row['don_gia'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= number_format($row['tong_tien_trvat']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= ($row['thue_vat'] != 0) ? $row['thue_vat'] . '%' : "" ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= number_format($row['tong_tien_svat']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $row['cs_kem_theo'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $row['sl_da_dat_hang'] ?></td>
    </tr>
<? } ?>