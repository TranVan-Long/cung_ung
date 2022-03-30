<?
include("config.php");
$id        = getValue('id', 'int', 'POST', '');
$ep_id     = getValue('ep_id', 'int', 'POST', '');
$ncc_name   = $_POST['ncc_name'];

//save log
$noi_dung = 'Bạn đã xóa nhà cung cấp: ' . $ncc_name . '. Mã: NCC-' . $id;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung')");

$delete_ncc = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' ");


if (isset($delete_ncc)) {
    echo "";
} else {
    echo "Xóa không thành công.";
}
