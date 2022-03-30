<?

include("config.php");
if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $user_name = $_SESSION['com_name'];
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
        $com_name = $_SESSION['com_name'];
        $user_name = $_SESSION['ep_name'];
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
        $cou = count($list_nv);
    }
};

$all_nv = [];
for ($i = 0; $i < $cou; $i++) {
    $row_nv = $list_nv[$i];
    $all_nv[$row_nv['ep_id']] = $row_nv;
}

$id = getValue('id', 'int', 'GET', 0);

if ($id != "") {
    $list_phieu = new db_query("SELECT p.`id`, p.`id_hd_dh`, p.`id_ncc_kh`, p.`loai_phieu_tt`, p.`ngay_thanh_toan`, p.`hinh_thuc_tt`, p.`loai_thanh_toan`,
                                p.`nguoi_nhan_tien`, p.`phi_giao_dich`, p.`phan_loai`, p.`trang_thai`, p.`id_nguoi_lap`, n.`ten_nha_cc_kh`
                                FROM `phieu_thanh_toan` AS p
                                INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                                WHERE p.`id` = $id AND p.`id_cong_ty` = $com_id ");
    $row = mysql_fetch_assoc($list_phieu->result);
    $id_hd_dh = $row['id_hd_dh'];

    if ($row['phan_loai'] == 1 || $row['phan_loai'] == 3 || $row['phan_loai'] == 4 || $row['phan_loai'] ==  5) {
        $dv_chitra = $com_name;
        $dv_thuhuong = $row['ten_nha_cc_kh'];
    } else if ($row['phan_loai'] == 2 || $row['phan_loai'] == 6) {
        $dv_chitra = $row['ten_nha_cc_kh'];
        $dv_thuhuong = $com_name;
    }

    $list_tt = mysql_fetch_assoc((new db_query("SELECT `id_hs`, `da_thanh_toan` FROM `chi_tiet_phieu_tt_vt` WHERE `id_phieu_tt` = $id AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh "))->result);
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-phieu-thanh-toan.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin phiếu thanh toán: PH-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hợp đồng / Đơn hàng:</td>
    <? if ($row['phan_loai'] == 1 || $row['phan_loai'] == 3 || $row['phan_loai'] == 4 || $row['phan_loai'] == 5) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">HĐ - <?= $row['id_hd_dh'] ?></td>
    <? } else if ($row['phan_loai'] == 2 || $row['phan_loai'] == 6) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">ĐH - <?= $row['id_hd_dh'] ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số phiếu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">PH - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày thanh toán:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($row['ngay_thanh_toan'] != 0) ? date('d/m/Y', $row['ngay_thanh_toan']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hình thức thanh toán:</td>
    <? if ($row['hinh_thuc_tt'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Tiền mặt</td>
    <? } else if ($row['hinh_thuc_tt'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Bằng thẻ</td>
    <? } else if ($row['hinh_thuc_tt'] == 3) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Chuyển khoản</td>
    <? } ?>

</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Loại thanh toán:</td>
    <? if ($row['loai_thanh_toan'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Tạm ứng</td>
    <? } else if ($row['loai_thanh_toan'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Theo hợp đồng</td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị chi trả:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dv_chitra  ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị thụ hưởng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dv_thuhuong ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Phí giao dịch:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['phi_giao_dich'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người nhận tiền:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['nguoi_nhan_tien'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Trạng thái:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Hoàn thành</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người lập:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_nv[$row['id_nguoi_lap']]['ep_name'] ?></td>
</tr>
<!-- <tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh sách hồ sơ</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px; border-top: 1px solid;">Còn phải thanh toán:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px; border-top: 1px solid;">25.000.000</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thanh toán:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">25.000.000</td>
</tr> -->