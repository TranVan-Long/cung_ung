<?
include("config.php");
$id        = getValue('id_hs', 'int', 'POST', '');
$ep_id     = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
if ($id == "") {
    echo ("Hồ sơ không tồn tại.");
} else {
    //save log
    $noi_dung = 'Bạn đã xóa hồ sơ thanh toán: HS-' . $id;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                        VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
    $delete_ycvt = new db_query("DELETE FROM `ho_so_thanh_toan` WHERE `id` = '$id' ");
}
