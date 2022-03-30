<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$rat_get = new db_query("SELECT d.`id`, d.`ngay_danh_gia`, d.`nguoi_danh_gia`, d.`phong_ban`, d.`id_nha_cc`, d.`danh_gia_khac`,
                            n.`ten_nha_cc_kh`, n.`ten_vt`, n.`dia_chi_lh`, n.`sp_cung_ung`
                            FROM `danh_gia` AS d
                            INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id`
                            WHERE d.`id` = $id AND d.`id_cong_ty` = $com_id ");
$item = mysql_fetch_assoc($rat_get->result);

$id_dg = $item['id'];

$list_gtri = new db_query("SELECT s.`id`, s.`id_danh_gia`, s.`id_tieu_chi`, s.`diem_danh_gia`, s.`tong_diem_danh_gia`, s.`danh_gia_chi_tiet`, t.`id`, t.`he_so`,
                                t.`tieu_chi`, g.`id`
                                FROM `chi_tiet_danh_gia` AS s
                                INNER JOIN `tieu_chi_danh_gia` AS t ON s.`id_tieu_chi` = t.`id`
                                INNER JOIN `danh_gia` AS g ON s.`id_danh_gia` = g.`id`
                                WHERE s.`id_danh_gia` = $id AND g.`id_cong_ty` = $com_id ");

$user_id = $item['nguoi_danh_gia'];

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2) {
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

    $user = [];
    for ($i = 0; $i < $count; $i++) {
        $item1 = $data_list_nv[$i];
        $user[$item1["ep_id"]] = $item1;
    }

    $ep_name = $user[$user_id]['ep_name'];
    $phong_ban = $user[$user_id]['dep_name'];
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-phieu-danh-gia-nha-cung-cap.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin phiếu đánh giá nhà cung cấp: PH-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số phiếu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">PH-<?= $item['id'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày đánh giá:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date("d-m-Y", $item['ngay_danh_gia']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người đánh giá:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ep_name ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Phòng ban:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $phong_ban ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">NCC - <?= $item['id_nha_cc'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Địa chỉ:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['dia_chi_lh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Sản phẩm cung ứng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['sp_cung_ung'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Điểm đánh giá:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $tong_diem ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đánh giá khác:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['danh_gia_khac'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh sách tiêu chí đánh giá</td>
</tr>
<? while ($row = mysql_fetch_assoc($list_gtri->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Tiêu chí đánh giá:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;"><?= $row['tieu_chi'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hệ số:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['he_so'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Điểm đánh giá:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['diem_danh_gia'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Điểm:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['tong_diem_danh_gia'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đánh giá chi tiết:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['danh_gia_chi_tiet'] ?></td>
    </tr>
<? } ?>