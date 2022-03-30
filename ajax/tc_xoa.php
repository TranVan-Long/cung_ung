<?
include("config.php");
$id          = getValue('id', 'int', 'POST', '');
$ep_id       = getValue('ep_id', 'int', 'POST', '');


if ($id != "") {
    $noi_dung = 'Bạn đã xóa tiêu chí: TC-' . $id . '.';
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung')");

    $delete_tc = new db_query("DELETE FROM `tieu_chi_danh_gia` WHERE `id` = '$id' ");
} else {
    echo "Xóa không thành công.";
}
