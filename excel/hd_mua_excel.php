<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `hd_nguyen_tac`, `hinh_thuc_hd`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`,`tien_chiet_khau`, `giu_lai_bhanh`, `gia_tri_bhanh`, `thoi_han_blanh`,`bao_lanh_hd`,`gia_tri_blanh`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `bgom_vchuyen`, `ten_ngan_hang`, `so_tk`,`id_bao_gia`, `thoa_tuan_hoa_don`,  `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $id");
$hd_detail = mysql_fetch_assoc($hd_get->result);
$ncc_id = $hd_detail['id_nha_cc_kh'];
$ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);

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

$get_vat_tu = new db_query("SELECT `id`, `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id");

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-hop-dong-mua-vat-tu.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin hợp đồng mua vật tư: HĐ-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">HĐ - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày ký hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date('d/m/Y', $hd_detail['ngay_ky_hd']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ncc['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Dự án / Công trình:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $cong_trinh_data[$hd_detail['id_du_an_ctrinh']]['ctr_name'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hợp đồng nguyên tắc:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['hd_nguyen_tac']) ? "Có" : "Không" ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hình thức hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><? if ($hd_detail['hinh_thuc_hd'] == 1) { ?>
            Hợp đồng trọn gói
        <? } elseif ($hd_detail['hinh_thuc_hd'] == 2) { ?>
            Hợp đồng theo đơn giá cố định
        <? } elseif ($hd_detail['hinh_thuc_hd'] == 3) { ?>
            Hợp đồng theo đơn giá điều chỉnh
        <? } ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giá trị trước VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($hd_detail['gia_tri_trvat']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn giá đã bao gồm VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['bao_gom_vat']) ? "Có" : "Không" ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thuế suất VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['thue_vat'] ?>%</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tiền chiết khấu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($hd_detail['tien_chiet_khau']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giá trị sau VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($hd_detail['gia_tri_svat']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giữ lại bảo hành:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['giu_lai_bhanh'] ?>% tương đương <?= formatMoney($hd_detail['gia_tri_bhanh']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Bảo lãnh thực hiện hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['bao_lanh_hd'] ?>% tương đương <?= formatMoney($hd_detail['gia_tri_blanh']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời hạn bảo lãnh:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date('d/m/Y', $hd_detail['thoi_han_blanh']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời gian thực hiện:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date('d/m/Y', $hd_detail['tg_bd_thuc_hien']) ?> - <?= date('d/m/Y', $hd_detail['tg_kt_thuc_hien']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hợp đồng bao gồm vận chuyển:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($hd_detail['bao_gom_vat']) ? "Có" : "Không" ?>
    </td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên ngân hàng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['ten_ngan_hang'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số tài khoản:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['so_tk'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Báo giá:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">BG - <?= $hd_detail['id_bao_gia'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thỏa thuận hóa đơn:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['thoa_tuan_hoa_don'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Yêu cầu về tiến độ:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['yc_tien_do'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nội dung hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['noi_dung_hd'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Nội dung cần lưu ý:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['noi_dung_luu_y'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Điều khoản thanh toán:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['dieu_khoan_tt'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh sách vật tư</td>
</tr>
<? while ($vat_tu = mysql_fetch_assoc($get_vat_tu->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Mã vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;">VT - <?= $vat_tu['id'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dsvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị tính:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hãng sản xuất:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['hsx_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Xuất xứ:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['xx_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số lượng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu['so_luong'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn giá:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['don_gia']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tổng tiền trước VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['tien_trvat']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thuế VAT (%):</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $vat_tu['thue_vat'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tổng tiền sau VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= formatMoney($vat_tu['tien_svat']) ?></td>
    </tr>
<? } ?>