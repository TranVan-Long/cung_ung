<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$get_ycvt = new db_query("SELECT `id`, `id_nguoi_yc`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`, `trang_thai`, `id_kho`, `ly_do_tu_choi`, `id_nguoi_duyet`, `ngay_duyet`, `ngay_tao`, `ngay_chinh_sua`, `id_cong_ty` FROM `yeu_cau_vat_tu` WHERE `id` = $id ");

$item = mysql_fetch_assoc($get_ycvt->result);
$id_nyc = $item['id_nguoi_yc'];
$ngay_tao = date('d/m/Y', $item['ngay_tao']);
$ngay_ht = date('d/m/Y', $item['ngay_ht_yc']);
$cong_trinh = $item['id_cong_trinh'];
$dien_giai = $item['dien_giai'];
$trang_thai = $item['trang_thai'];
$ngay_duyet = date('d/m/Y', $item['ngay_duyet']);
$nguoi_duyet = $item['id_nguoi_duyet'];
$ly_do_tu_choi = $item['ly_do_tu_choi'];



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

foreach ($data_list_nv as $key => $items) {
    if ($id_nyc == $items['ep_id']) {
        $user_name = $items['ep_name'];
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
        $com_id = $items['com_id'];
    }
    if ($nguoi_duyet == $items['ep_id']) {
        $ten_nguoi_duyet = $items['ep_name'];
    }
}

$get_vtyc = new db_query("SELECT `id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet` FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $id");


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

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];

$stt = 1;

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-yeu-cau-vat-tu.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin phiếu yêu cầu vật tư: YC-' . $item['id'] . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số phiếu yêu cầu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">YC - <?= $item['id'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người yêu cầu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $user_name ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Phòng ban:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dept_name ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày tạo yêu cầu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ngay_tao ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày phải hoàn thành yêu cầu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ngay_ht ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Công trình:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $cong_trinh_data[$cong_trinh]['ctr_name'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Diễn giải:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dien_giai ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Trạng thái:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><? if ($trang_thai == 1) { ?>
            Chưa duyệt
        <? } elseif ($trang_thai == 2) { ?>
            Đã duyệt
        <? } elseif ($trang_thai == 3) { ?>
            Đã bị từ chối
        <? } ?>
    </td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Danh sách vật tư</td>
</tr>
<? while ($row = mysql_fetch_assoc($get_vtyc->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Mã vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;"><?= $vat_tu[$row['id_vat_tu']]['dsvt_maVatTuThietBi']?>-<?= $vat_tu[$row['id_vat_tu']]['dsvt_id'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu[$row['id_vat_tu']]['dsvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị tính:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu[$row['id_vat_tu']]['dvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số lượng yêu cầu duyệt:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['so_luong_yc_duyet'] ?></td>
    </tr>
<? } ?>