<?
include("config.php");

$cong_trinh             = $_POST['cong_trinh'];
$ngay_tao_yeu_cau       =  strtotime($_POST['ngay_tao_yeu_cau']);
$ngay_phai_hoan_thanh   =  strtotime($_POST['ngay_phai_hoan_thanh']);
$dien_giai              = $_POST['dien_giai'];
$trang_thai             = 1;

$vat_tu                 = $_POST['vat_tu'];
$dv_tinh                = $_POST['dv_tinh'];
$so_luong               = $_POST['so_luong'];

$user_id                = $_POST['user_id'];
$comp_id                = $_POST['comp_id'];


if ($user_id != "") {
    $them_ycvt = new db_query("INSERT INTO `yeu_cau_vat_tu` (`id`,`id_nguoi_yc`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`, `trang_thai`, `ngay_tao`, `id_cong_ty`) VALUES (NULL, '$user_id', '$cong_trinh', '$ngay_phai_hoan_thanh', '$dien_giai', '$trang_thai', '$ngay_tao_yeu_cau', '$comp_id')");

    $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS yc_id"))->result);
    $id_yc = $row['yc_id'];

    for ($i = 0; $i < count($vat_tu); $i++) {
        $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`) VALUES (NULL, '$id_yc[$i]', '$vat_tu[$i]', '$so_luong[$i]')");
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
