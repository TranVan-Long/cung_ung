<?
include("config.php");
$id  = getValue('id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');


if ($id != "") {
    $noi_dung = 'Bạn đã xóa tiêu chí: TC-' . $id ;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                        VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");

    $delete_tc = new db_query("DELETE FROM `tieu_chi_danh_gia` WHERE `id` = '$id' AND `id_cong_ty` = $com_id ");
} else {
    echo "Xóa không thành công.";
}
