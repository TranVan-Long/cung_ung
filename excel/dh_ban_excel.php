<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}
$id = getValue('id', 'int', 'GET', 0);

$ctiet_dh = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`id_du_an_ctrinh`, d.`ngay_ky`,
                                d.`thoi_han`, d.`don_vi_nhan_hang`, d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`,
                                d.`ghi_chu`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`phan_loai`, d.`hieu_luc`, d.`trang_thai`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`
                                FROM `don_hang` AS d
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                WHERE d.`id` = $id AND d.`id_cong_ty` = $com_id "))->result);

$list_vt = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`, `so_luong_ky_nay`,
                                `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id AND `id_cong_ty` = $com_id ");


if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
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
};
$all_nv = [];
for ($i = 0; $i < $count; $i++) {
    $item = $data_list_nv[$i];
    $all_nv[$item['ep_id']] = $item;
};

$curl = curl_init();
$token = $_COOKIE['accc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$list_ctrinh = $data_list['data']['items'];
$cou1 = count($list_ctrinh);


$all_ctrinh = [];
for ($k = 0; $k < $cou1; $k++) {
    $item2 = $list_ctrinh[$k];
    $all_ctrinh[$item2['ctr_id']] = $item2;
};


$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$list_vattu = $data_list['data']['items'];
$cou1 = count($list_vattu);

$all_vattu = [];
for ($l = 0; $l < $cou1; $l++) {
    $item3 = $list_vattu[$l];
    $all_vattu[$item3['dsvt_id']] = $item3;
};

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=chi-tiet-don-hang-ban-vat-tu.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin đơn hàng bán vật tư: ĐH-' . $id . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số đơn hàng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">ĐH - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên khách hàng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Địa chỉ:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['dia_chi_lh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người liên hệ:</td>
    <? if ($ctiet_dh['phan_loai'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'] ?></td>
    <? } else if ($ctiet_dh['phan_loai'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['id_nguoi_lh'] ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số điện thoại / Fax:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['so_dien_thoai'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hợp đồng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">HĐ - <?= $ctiet_dh['id_hop_dong'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số đơn hàng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">ĐH - <?= $id ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ngày ký:</td>
    <? if ($ctiet_dh['ngay_ky'] != 0 && $ctiet_dh['ngay_ky'] != "") { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= date('d/m/Y', $ctiet_dh['ngay_ky']) ?></td>
    <? } else { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Dự án / Công trình:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_ctrinh[$ctiet_dh['id_du_an_ctrinh']]['ctr_name'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời hạn đơn hàng:</td>
    <? if ($ctiet_dh['thoi_han'] != "" && $ctiet_dh['thoi_han'] != 0) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['ten_ngan_hang'] ?><?= date('d/m/Y', $ctiet_dh['thoi_han']) ?></td>
    <? } else { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $hd_detail['ten_ngan_hang'] ?></td>

    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị nhận hàng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['don_vi_nhan_hang'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Người nhận hàng:</td>
    <? if ($ctiet_dh['phan_loai'] == 1) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_nv[$ctiet_dh['nguoi_nhan_hang']]['ep_name'] ?></td>
    <? } else if ($ctiet_dh['phan_loai'] == 2) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['nguoi_nhan_hang'] ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Phòng ban:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['phong_ban'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số điện thoại người nhận:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['dien_thoai_nn'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giữ lại bảo hành:</td>
    <? if ($ctiet_dh['giu_lai_bao_hanh'] == 0) { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"></td>
    <? } else if ($ctiet_dh['giu_lai_bao_hanh'] != 0 && $ctiet_dh['giu_lai_bao_hanh'] != "") { ?>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['giu_lai_bao_hanh'] ?>% tương đương
            <?= number_format($ctiet_dh['gia_tri_tuong_duong']) ?></td>
    <? } ?>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ghi chú:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['ghi_chu'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giá trị trước VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($ctiet_dh['gia_tri_don_hang']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn giá đã bao gồm VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($ctiet_dh['bao_gom_vat'] == 0) ? 'Không' : 'Có' ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thuế suất VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['thue_vat'] ?>%</td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tiền chiết khấu:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($ctiet_dh['chiet_khau']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Giá trị sau VAT:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($ctiet_dh['gia_tri_svat']) ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Chi phí vận chuyển:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $ctiet_dh['chi_phi_vchuyen'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Ghi chú vận chuyển:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($ctiet_dh['ghi_chu_vchuyen'] != "") ? $ctiet_dh['ghi_chu_vchuyen'] : "Không có" ?></td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold; border-top: 1px solid;">Danh sách vật tư</td>
</tr>
<? while ($row1 = mysql_fetch_assoc($list_vt->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Mã vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;">VT - <?= $vat_tu['id'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên vật tư:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn vị tính:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Hãng sản xuất:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số lượng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['so_luong_ky_nay'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thời gian giao hàng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= ($row1['thoi_gian_giao_hang'] != 0) ? date('d/m/Y', $row1['thoi_gian_giao_hang']) : "" ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Đơn giá:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($all_vattu[$row1['id_vat_tu']]['dsvt_donGia']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tổng tiền trước VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($row1['tong_tien_trvat']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thuế VAT (%):</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['thue_vat'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tổng tiền sau VAT:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= number_format($row1['tong_tien_svat']) ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Địa điểm giao hàng:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['dia_diem_giao_hang'] ?></td>
    </tr>
<? } ?>