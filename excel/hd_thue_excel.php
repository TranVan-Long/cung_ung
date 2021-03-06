<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `thue_noi_bo`, `hinh_thuc_hd`, `ten_ngan_hang`, `so_tk`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $id");
$hd_detail = mysql_fetch_assoc($hd_get->result);

$ncc_id = $hd_detail['id_nha_cc_kh'];
$ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
    }
}
$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_ct = json_decode($response, true);
$cong_trinh_data = $list_ct['data']['items'];

$cong_trinh_detail = [];
for ($i = 0; $i < count($cong_trinh_data); $i++) {
    $items_ct = $cong_trinh_data[$i];
    $cong_trinh_detail[$items_ct['ctr_id']] = $items_ct;
}
$get_tb_detail = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $id");

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-hop-dong-thue-thiet-bi.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Th??ng tin h???p ?????ng thu?? thi???t b???: H??-' . $id . '</th></tr>';

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
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nh?? cung c???p:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ncc['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">D??? ??n / C??ng tr??nh:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $cong_trinh_detail[$hd_detail['id_du_an_ctrinh']]['ctr_name'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thu?? n???i b???:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['thue_noi_bo']) ? "C??" : "Kh??ng" ?></td>
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
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh s??ch thi???t b???</td>
</tr>
<? while ($thiet_bi = mysql_fetch_assoc($get_tb_detail->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Lo???i t??i s???n thi???t b???:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;"><?= $thiet_bi['loai_tai_san'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Th??ng s??? k??? thu???t:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['thong_so_kthuat'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">S??? l?????ng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['so_luong'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Th???i gian thu??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">
            <?
            if ($thiet_bi['thue_tu_ngay'] == 0 && $thiet_bi['thue_den_ngay'] == 0) { ?>
                Kh??ng c?? d??? li???u.
            <? } else { ?>
                <?= date('d/m/Y', $thiet_bi['thue_tu_ngay']) ?> - <?= date('d/m/Y', $thiet_bi['thue_den_ngay']) ?>
            <? } ?>
        </td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n v??? t??nh:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['don_vi_tinh'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Kh???i l?????ng d??? ki???n:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['khoi_luong_du_kien'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">H???n m???c ca m??y:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($thiet_bi['han_muc_ca_may']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n gi?? thu??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($thiet_bi['don_gia_thue']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">????n gi?? ca m??y ph??? tr???i:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($thiet_bi['dg_ca_may_phu_troi']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Th??nh ti???n d??? ki???n:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($thiet_bi['thanh_tien_du_kien']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Th???a thu???n kh??c:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['thoa_thuan_khac'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">L??u ??:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $thiet_bi['luu_y'] ?></td>
    </tr>
<? } ?>