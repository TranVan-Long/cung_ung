<?
include("config.php");
$id        = $_POST['id'];
$ep_id     = $_POST['ep_id'];
$hd_id   = $_POST['hd_id'];
$loai = $_POST['loai'];

//save log
$noi_dung = 'Bạn đã xóa hợp đồng '.$loai.': HĐ-' . $id;
$date = strtotime(date('Y-m-d H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                         VALUES('', '$ep_id', '$date', '$noi_dung')");
$delete_ycvt = new db_query("DELETE FROM `hop_dong` WHERE `id` = '$id' ");


if (isset($delete_ycvt)) {
    echo "";
} else {
    echo "Lỗi";
}
