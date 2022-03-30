<?
include("config.php");
$id = getValue('id','int','POST','');
$user_id = getValue('user_id','int','POST','');
$noi_dung = "Bạn đã xóa phiếu yêu cầu báo giá: BG - " . $id;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if (isset($id) && $id != "") {
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung')");
    $remo_yc = new db_query("DELETE FROM `yeu_cau_bao_gia` WHERE `id` = $id ");
}
