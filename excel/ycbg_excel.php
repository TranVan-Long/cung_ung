<?
include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}

$id_bg = getValue('id_bg', 'int', 'GET', 0);

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
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
};

$list_nv = [];
for ($i = 0; $i < count($data_list_nv); $i++) {
    $item1 = $data_list_nv[$i];
    $list_nv[$item1['ep_id']] = $item1;
};

$list_ct = new db_query("SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`id_cong_trinh`, y.`id_nguoi_tiep_nhan`, y.`noi_dung_thu`,
                            y.`mail_nhan_bg`, y.`gui_mail`, y.`gia_bg_vat`, y.`phan_loai`, y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`, l.`ten_nguoi_lh`
                            FROM `yeu_cau_bao_gia` AS y
                            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                            INNER JOIN `nguoi_lien_he` AS l ON n.`id` = l.`id_nha_cc`
                            WHERE y.`id_cong_ty` = $com_id AND y.`id` = $id_bg ");
$item_ct = mysql_fetch_assoc($list_ct->result);
$id_nguoi_lap = $item_ct['id_nguoi_lap'];

$ep_name = $list_nv[$id_nguoi_lap]['ep_name'];

$vt_bg = new db_query("SELECT `id`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id_bg ");

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

$list_vttb = json_decode($response1, true);
$data_vttb = $list_vttb['data']['items'];

$vat_tu = [];
for ($j = 0; $j < count($data_vttb); $j++) {
    $item2 = $data_vttb[$j];
    $vat_tu[$item2['dsvt_id']] = $item2;
}

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
$cong_trinh = $data_list1['data']['items'];
$cou1 = count($cong_trinh);
$all_ctrinh = [];
for ($l = 0; $l < $cou1; $l++) {
    $item_ct1 = $cong_trinh[$l];
    $all_ctrinh[$item_ct1['ctr_id']] = $item_ct1;
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=excel_ds_ts.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="5" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin yêu cầu báo giá vật tư</th></tr>';
?>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Số phiếu yêu cầu:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;">BG - <?= $id_bg ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ngày lập:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= date('d-m-Y', $item_ct['ngay_tao']) ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Người lập:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $ep_name ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Nhà cung cấp:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $item_ct['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Người tiếp nhận báo giá:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $item_ct['ten_nguoi_lh'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Công trình:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $all_ctrinh[$item_ct['id_cong_trinh']]['ctr_name'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Nội dung thư:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $item_ct['noi_dung_thu'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="3" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Mail nhận báo giá:</td>
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: left;width: 300px;padding-left: 10px;"><?= $item_ct['mail_nhan_bg'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;font-weight: bold;">Danh sách vật tư yêu cầu báo giá</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Mã vật tư</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Tên đầy đủ vật tư thiết bị</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Hãng sản xuất</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">Đơn vị tính</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">Số lượng</td>
</tr>
<? while ($row1 = mysql_fetch_assoc($vt_bg->result)) {  ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;">VT - <?= $row1['id_vat_tu'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $vat_tu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;"><?= $vat_tu[$row1['id_vat_tu']]['hsx_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu[$row1['id_vat_tu']]['dvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['so_luong_yc_bg'] ?></td>
    </tr>
<? } ?>