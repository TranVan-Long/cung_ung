<?
include("config.php");
$id        = $_POST['id'];
$ep_id     = $_POST['ep_id'];
$ycvt_id   = $_POST['ycvt_id'];

//save log
$noi_dung = 'Bạn đã xóa phiếu yêu cầu vật tư: YC-' . $id;
$date = strtotime(date('Y-m-d H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                         VALUES('', '$ep_id', '$date', '$noi_dung')");
$delete_ycvt = new db_query("DELETE FROM `yeu_cau_vat_tu` WHERE `id` = '$id' ");


if (isset($delete_ycvt)) {
    echo "";
} else {
    echo "Lỗi";
}
