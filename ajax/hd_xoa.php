<?
include("config.php");
$id        = getValue('id', 'int', 'POST', '');
$ep_id     = getValue('ep_id', 'int', 'POST', '');
$hd_id   = getValue('hd_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$loai = $_POST['loai'];

//save log
$noi_dung = 'Bạn đã xóa hợp đồng ' . $loai . ': HĐ-' . $id;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
$delete_ycvt = new db_query("DELETE FROM `hop_dong` WHERE `id` = '$id' ");


if (isset($delete_ycvt)) {
    echo "";
} else {
    echo "Lỗi";
}
