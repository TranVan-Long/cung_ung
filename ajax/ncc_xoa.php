<?
include("config.php");
$id        = $_POST['id'];
$ep_id     = $_POST['ep_id'];
$ncc_name   = $_POST['ncc_name'];

//save log
$noi_dung = 'Bạn đã xóa nhà cung cấp: ' . $ncc_name . '. Mã: NCC-' . $id;
$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                         VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
$delete_ncc = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' ");


if (isset($delete_ncc)) {
    echo "";
} else {
    echo "Lỗi";
}
