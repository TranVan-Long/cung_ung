<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$get_ycvt = new db_query("SELECT `id`, `id_nguoi_yc`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`, `trang_thai`, `id_kho`,
                        `ly_do_tu_choi`, `role`, `phan_quyen_nduyet`, `id_nguoi_duyet`, `ngay_duyet`, `ngay_tao`,
                        `ngay_chinh_sua`, `id_cong_ty` FROM `yeu_cau_vat_tu` WHERE `id` = $id AND `id_cong_ty` = $com_id ");

$item = mysql_fetch_assoc($get_ycvt->result);

$ngay_tao = date('d/m/Y', $item['ngay_tao']);
if($item['ngay_ht_yc'] != 0){
    $ngay_ht = date('d/m/Y', $item['ngay_ht_yc']);
}else{
    $ngay_ht = "";
}
$cong_trinh = $item['id_cong_trinh'];
$dien_giai = $item['dien_giai'];
$trang_thai = $item['trang_thai'];
$ngay_duyet = date('d/m/Y', $item['ngay_duyet']);
$ly_do_tu_choi = $item['ly_do_tu_choi'];


if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nduyet = 1;

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
    $cou = count($data_list_nv);
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nduyet = 2;

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
    $cou = count($data_list_nv);

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `yeu_cau_vat_tu` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $ycvt3 = explode(',', $item_nv['yeu_cau_vat_tu']);
        if (in_array(1, $ycvt3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
};

$all_user = [];
for ($i = 0; $i < $cou; $i++) {
    $user_o = $data_list_nv[$i];
    $all_user[$user_o['ep_id']] = $user_o;
}

if($item['role'] == 1){
    $nguoi_yc = $_SESSION['com_name'];
    $dep_name = "";
}else if($item['role'] == 2){
    $nguoi_yc = $all_user[$item['id_nguoi_yc']]['ep_name'];
    $dep_name = $all_user[$item['id_nguoi_yc']]['dep_name'];;
}

if ($item['phan_quyen_nduyet'] == 1) {
    $nguoi_duyet = $_SESSION['com_name'];
} else if ($item['role'] == 2) {
    $nguoi_duyet = $all_user[$item['id_nguoi_duyet']]['ep_name'];
}

$get_vtyc = new db_query("SELECT `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet` FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $id");


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

$all_ctr = [];
for ($l = 0; $l < count($cong_trinh_data); $l++) {
    $ctr_item = $cong_trinh_data[$l];
    $all_ctr[$ctr_item['ctr_id']] = $ctr_item;
}

$ten_ctr = $all_ctr[$cong_trinh]['ctr_name'];

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
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $nguoi_yc ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Phòng ban:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dep_name ?></td>
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
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ten_ctr ?></td>
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
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;">VT - <?= $row['id_vat_tu'] ?></td>
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