<?
include("config.php");
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

$id_dh = getValue('id', 'int', 'GET', 0);
$list_dhm = new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`ngay_ky`, d.`thoi_han`, d.`don_vi_nhan_hang`,
                                d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`, d.`ghi_chu`,
                                d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`ngay_tao`, h.`id_du_an_ctrinh`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`, l.`ten_nguoi_lh`
                                FROM `don_hang` AS d
                                INNER JOIN `hop_dong` AS h ON d.`id_hop_dong` = h.`id`
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                INNER JOIN `nguoi_lien_he` AS l ON d.`id_nguoi_lh` = l.`id`
                                WHERE  d.`id` = $id_dh AND d.`phan_loai` = 1 AND d.`id_cong_ty` = $com_id ");
$item = mysql_fetch_assoc($list_dhm->result);
$id_ctrinh = $item['id_du_an_ctrinh'];

$list_vt_dhm = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_ky_nay`, `thoi_gian_giao_hang`,
                                    `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                    FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_dh AND `id_cong_ty` = $com_id ");
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
$data_list = json_decode($response, true);
$list_ctrinh = $data_list['data']['items'];
$cou1 = count($list_ctrinh);

$all_ctrinh = [];
for ($i = 0; $i < $cou1; $i++) {
    $item1 = $list_ctrinh[$i];
    $all_ctrinh[$item1['ctr_id']] = $item1;
};
$ten_ctrinh = $all_ctrinh[$id_ctrinh]['ctr_name'];

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

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://chamcong.24hpay.vn/service/detail_company.php?id_com=" . $com_id);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$com0 = json_decode($response, true);
$dep = $com0['data']['list_department'];
$cou5 = count($dep);
$all_pb = [];
for ($l = 0; $l < $cou5; $l++) {
    $item5 = $dep[$l];
    $all_pb[$item5['dep_id']] = $item5;
}

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-don-hang-mua-vat-tu.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="11" style="font-size:18px;height:60px;vertical-align: middle;">Th??ng tin ????n h??ng mua v???t t??</th></tr>';
?>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">T??n nh?? cung c???p:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">?????a ch???:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['dia_chi_lh'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ng?????i li??n h???:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['ten_nguoi_lh'] ?>></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">S??? ??i???n tho???i / Fax:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['so_dien_thoai'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">H???p ?????ng:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">H?? - <?= $item['id_hop_dong'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">S??? ????n h??ng:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">??H - <?= $item['id'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ng??y k??:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= date('d/m/Y', $item['ngay_ky']) ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">D??? ??n / C??ng tr??nh:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $ten_ctrinh ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Th???i h???n ????n h??ng:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= date('d/m/Y', $item['thoi_han']) ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">????n v??? nh???n h??ng:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['don_vi_nhan_hang'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ng?????i nh???n h??ng:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $user[$item['nguoi_nhan_hang']]['ep_name'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ph??ng ban:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $all_pb[$item['phong_ban']]['dep_name'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">S??? ??i???n tho???i ng?????i nh???n:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['dien_thoai_nn'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Gi??? l???i b???o h??nh:</td>
    <? if ($item['giu_lai_bao_hanh']  != 0) { ?>
        <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['giu_lai_bao_hanh'] ?>% t????ng ??????ng <?= $item['gia_tri_tuong_duong'] ?></td>
    <? } else { ?>
        <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ghi ch??:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['ghi_chu'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Gi?? tr??? tr?????c VAT:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= ($item['gia_tri_don_hang'] != 0) ? number_format($item['gia_tri_don_hang']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Thu??? su???t VAT:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= ($item['thue_vat'] != 0) ? $item['thue_vat'] . "%" : "" ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Gi?? tr??? sau VAT:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= ($item['gia_tri_svat'] != 0) ? number_format($item['gia_tri_svat']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ti???n chi???t kh???u:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= number_format($item['chiet_khau']) ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Chi ph?? v???n chuy???n:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= ($item['chi_phi_vchuyen'] != 0) ? number_format($item['chi_phi_vchuyen']) : "" ?></td>
</tr>
<tr style="height:40px">
    <td colspan="6" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;">Ghi ch?? v???n chuy???n:</td>
    <td colspan="5" style="vertical-align: middle;font-size: 14px;text-align: left;width: 200px;padding-left: 10px;"><?= $item['ghi_chu_vchuyen'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="11" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Danh s??ch v???t t?? y??u c???u b??o gi??</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">M?? v???t t??</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">T??n ?????y ????? v???t t?? thi???t b???</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">????n v??? t??nh</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">H??ng s???n xu???t</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">S??? l?????ng</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">Th???i gian giao h??ng</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">????n gi?? (VN??)</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">T???ng ti???n tr?????c VAT (VN??)</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">Thu??? VAT (%)</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">T???ng ti???n sau VAT (VN??)</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;">?????a ??i???m giao h??ng</td>
</tr>
<? while ($row1 = mysql_fetch_assoc($list_vt_dhm->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">VT - <?= $row1['id_vat_tu'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= $row1['so_luong_ky_nay'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= date('d/m/Y', $row1['thoi_gian_giao_hang']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= number_format($row1['don_gia']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= number_format($row1['tong_tien_trvat']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= $row1['thue_vat'] ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= number_format($row1['tong_tien_svat']) ?></td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;font-weight: bold;"><?= $row1['dia_diem_giao_hang'] ?></td>
    </tr>
<? } ?>