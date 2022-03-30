<?

include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}

$id_ncc = getValue('id_ncc', 'int', 'GET', 0);
$query = new db_query("SELECT `id`, `ten_nha_cc_kh`, `ma_so_thue`, `ten_giao_dich`, `dia_chi_dkkd`, `so_dkkd`, `dia_chi_lh`, `fax`, `so_dien_thoai`,
                    `website`, `email`, `sp_cung_ung`, `thong_tin_khac` FROM `nha_cc_kh` WHERE `id_cong_ty` = $com_id AND `id` = $id_ncc AND `phan_loai` = 1 ");

$tai_khoan = new db_query("SELECT `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk` FROM `tai_khoan` WHERE `id_nha_cc_kh` = $id_ncc ");

$nguoi_lh = new db_query("SELECT `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email` FROM `nguoi_lien_he` WHERE `id_nha_cc` = $id_ncc ");

$item = mysql_fetch_assoc($query->result);

header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=excel_ds_ts.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1px solid black">';
echo '<tr><th colspan="2" style="font-size:18px;height:60px;vertical-align: middle;">Thông tin nhà cung cấp: ' . $item['ten_nha_cc_kh'] . '</th></tr>';

?>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Mã nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;">NCC - <?= $item['id'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên nhà cung cấp:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ten_nha_cc_kh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Tên giao dịch:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ten_giao_dich'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Mã số thuế:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['ma_so_thue'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Địa chỉ ĐKKD:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['dia_chi_dkkd'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số ĐKKD:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['so_dkkd'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Địa chỉ liên hệ:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['dia_chi_lh'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Điện thoại:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['so_dien_thoai'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Fax:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['fax'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Website:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['website'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Email:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['email'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Sản phẩm cung ứng:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['sp_cung_ung'] ?></td>
</tr>
<tr style="height:40px">
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Thông tin khác:</td>
    <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $item['thong_tin_khac'] ?></td>
</tr>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Danh sách tài khoản ngân hàng</td>
</tr>
<? while ($row = mysql_fetch_assoc($tai_khoan->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Tên người liên hệ:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;"><?= $row['ten_ngan_hang'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Chi nhánh:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['ten_chi_nhanh'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số tài khoản:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['so_tk'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Chủ tài khoản:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row['chu_tk'] ?></td>
    </tr>
<? } ?>
<tr style="height:40px">
    <td colspan="2" style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;font-weight: bold;">Danh sách người liên hệ</td>
</tr>
<? while ($row1 = mysql_fetch_assoc($nguoi_lh->result)) { ?>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px;border-top: 1px solid;">Tên người liên hệ:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;border-top: 1px solid;"><?= $row1['ten_nguoi_lh'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Chức vụ:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['chuc_vu'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Số điện thoại:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['so_dien_thoai'] ?></td>
    </tr>
    <tr style="height:40px">
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 200px">Email:</td>
        <td style="vertical-align: middle;font-size: 14px;text-align: center;width: 300px;"><?= $row1['email'] ?></td>
    </tr>
<? } ?>