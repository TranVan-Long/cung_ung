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
    }
};

$user = [];
for ($i = 0; $i < count($list_nv); $i++) {
    $item1 = $list_nv[$i];
    $user[$item1["ep_id"]] = $item1;
};

$id = getValue('id', 'int', 'GET', 0);

if ($id != "") {
    $list_ptt = new db_query("SELECT p.`id`, p.`id_hd_dh`, p.`id_ncc_kh`, p.`loai_phieu_tt`, p.`ngay_thanh_toan`, p.`hinh_thuc_tt`, p.`loai_thanh_toan`, p.`phan_loai`,
                            p.`nguoi_nhan_tien`, p.`so_tien`, p.`ty_gia`, p.`phi_giao_dich`, p.`gia_tri_quy_doi`, p.`trang_thai`, p.`id_nguoi_lap`, n.`ten_nha_cc_kh`
                            FROM `phieu_thanh_toan` AS p
                            INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                            WHERE p.`id` = $id AND p.`id_cong_ty` = $com_id AND p.`loai_thanh_toan` = 1 ");
    $item = mysql_fetch_assoc($list_ptt->result);

    if ($item['hinh_thuc_tt'] == 1) {
        $hinh_thuc_tt = "Ti???n m???t";
    } else if ($item['hinh_thuc_tt'] == 2) {
        $hinh_thuc_tt = "B???ng th???";
    } else if ($item['hinh_thuc_tt'] == 3) {
        $hinh_thuc_tt = "Chuy???n kho???n";
    };

    if ($item['phan_loai'] == 1 || $item['phan_loai'] == 3 || $item['phan_loai'] == 4 || $item['phan_loai'] ==  5) {
        $dv_chitra = $com_name;
        $dv_thuhuong = $item['ten_nha_cc_kh'];
    } else if ($item['phan_loai'] == 2 || $item['phan_loai'] == 6) {
        $dv_chitra = $item['ten_nha_cc_kh'];
        $dv_thuhuong = $com_name;
    }
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-phieu-thanh-toan-tam-ung.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Th??ng tin phi???u thanh to??n t???m ???ng: PH-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">H???p ?????ng / ????n h??ng:</td>
    <? if ($item['loai_phieu_tt'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">H?? - <?= $item['id_hd_dh'] ?></td>
    <? } else if ($item['loai_phieu_tt'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">??H - <?= $item['id_hd_dh'] ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? phi???u:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">PH - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nh?? cung c???p:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ng??y thanh to??n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($item['ngay_thanh_toan'] != 0) ? date('d/m/Y', $item['ngay_thanh_toan']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">H??nh th???c thanh to??n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hinh_thuc_tt ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Lo???i thanh to??n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">T???m ???ng</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n v??? chi tr???:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dv_chitra  ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n v??? th??? h?????ng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $dv_thuhuong ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? ti???n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($item['so_tien'] != 0) ? number_format($item['so_tien']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">T??? gi??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ty_gia'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Gi?? tr??? quy ?????i:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($item['gia_tri_quy_doi'] != 0) ? number_format($item['gia_tri_quy_doi']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ph?? giao d???ch:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($item['phi_giao_dich'] != 0) ? number_format($item['phi_giao_dich']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ng?????i nh???n ti???n:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['nguoi_nhan_tien'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tr???ng th??i:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">Ho??n th??nh</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ng?????i l???p:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($item['id_nguoi_lap'] == $user_id) ? $user_name : $user[$item['id_nguoi_lap']]['ep_name'] ?></td>
</tr>