<?
include("config.php");
$id = getValue('id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$role = getValue('role', 'int', 'POST', '');
$ten_kh = $_POST['ten_kh'];
$com_id = getValue('com_id', 'int', 'POST', '');

$noi_dung = "Bạn đã xóa khách hàng: " . $id . " - " . $ten_kh;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($id != "") {
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`, `id_cong_ty`)
                        VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");

    $delete_kh = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' AND `id_cong_ty` = $com_id ");
} else {
    echo "Khách hàng không tồn tại.";
}
