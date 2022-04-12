<?
include("config.php");
$id        = getValue('id', 'int', 'POST', '');
$user_id     = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id','int','POST','');
$role     = getValue('role', 'int', 'POST', '');
$ncc_name   = $_POST['ncc_name'];

//save log
$noi_dung = 'Bạn đã xóa nhà cung cấp: ' . $ncc_name . '. Mã: NCC-' . $id;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));



if ($id != "" && $com_id != "" && $user_id != "") {
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
    VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");

    $delete_ncc = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' AND `id_cong_ty` = $com_id ");
} else {
    echo "Xóa không thành công.";
}
