<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `hd_nguyen_tac`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `ten_ngan_hang`, `so_tk`, `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $id");
$hd_detail = mysql_fetch_assoc($hd_get->result);

$ncc_id = $hd_detail['id_nha_cc_kh'];
$ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);

$ep_name = $_SESSION['ep_name'];
$ep_id = $_SESSION['ep_id'];


if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
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
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);
    }
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

$get_vat_tu = new db_query("SELECT `id`, `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id");

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-hop-dong-ban-vat-tu.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Th??ng tin h???p ?????ng b??n v???t t??: H??-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? h???p ?????ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">H?? - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ng??y k?? h???p ?????ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= (!empty($hd_detail['ngay_ky_hd'])) ? date('d/m/Y', $hd_detail['ngay_ky_hd']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Kh??ch h??ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ncc['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">H???p ?????ng nguy??n t???c:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['hd_nguyen_tac']) ? "C??" : "Kh??ng" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Gi?? tr??? tr?????c VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($hd_detail['gia_tri_trvat']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n gi?? ???? bao g???m VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['bao_gom_vat']) ? "C??" : "Kh??ng" ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thu??? su???t VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['thue_vat'] ?>%</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Th???i gian th???c hi???n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">
        <?
        if (($hd_detail['tg_bd_thuc_hien'] != 0 || !empty($hd_detail['tg_bd_thuc_hien'])) && ($hd_detail['tg_kt_thuc_hien'] != 0 || !empty($hd_detail['tg_kt_thuc_hien']))) { ?>
            <?= date('d/m/Y', $hd_detail['tg_bd_thuc_hien']) ?> - <?= date('d/m/Y', $hd_detail['tg_kt_thuc_hien']) ?>
        <? } ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Gi?? tr??? sau VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($hd_detail['gia_tri_svat']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">T??n ng??n h??ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['ten_ngan_hang'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? t??i kho???n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['so_tk'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Y??u c???u v??? ti???n ?????:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['yc_tien_do'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">N???i dung h???p ?????ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['noi_dung_hd'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">N???i dung c???n l??u ??:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['noi_dung_luu_y'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">??i???u kho???n thanh to??n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['dieu_khoan_tt'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh s??ch v???t t??</td>
</tr>
<? while ($vat_tu = mysql_fetch_assoc($get_vat_tu->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">M?? v???t t??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;">VT - <?= $vat_tu['id'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">T??n v???t t??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dsvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n v??? t??nh:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">H??ng s???n xu???t:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['hsx_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Xu???t x???:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['xx_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? l?????ng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu['so_luong'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n gi??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['don_gia']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">T???ng ti???n tr?????c VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['tien_trvat']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thu??? VAT (%):</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu['thue_vat'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">T???ng ti???n sau VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['tien_svat']) ?></td>
    </tr>
<? } ?>