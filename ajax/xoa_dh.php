<?

include("config.php");
$id_dh = getValue('id_dh', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$noi_dung_nk = "Bạn đã xóa đơn hàng: BG - " . $id_dh;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($id_dh != "" && $com_id != "" && $user_id != "") {

    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                        VALUES('', '$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao', '$noi_dung_nk', '$com_id')");

    $remo_dh = new db_query("DELETE FROM `don_hang` WHERE `id` = $id_dh AND `id_cong_ty` = $com_id ");
} else {
    echo "Bạn xóa đơn hàng không thành công, vui lòng thử lại!";
}
