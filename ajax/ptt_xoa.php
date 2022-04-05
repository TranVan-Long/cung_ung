<?
include("config.php");
$id        = getValue('id', 'int', 'POST', '');
$ep_id     = getValue('user_id', 'int', 'POST', '');
if ($id == "") {
    echo ("Phiếu thanh toán không tồn tại.");
} else {
    //save log
    $noi_dung = 'Bạn đã xóa phiếu thanh toán: PH-' . $id;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung')");
    $delete_ycvt = new db_query("DELETE FROM `phieu_thanh_toan` WHERE `id` = '$id' ");
}
