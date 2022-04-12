<?
include("config.php");
$id = getValue('id', 'int', 'POST','');
$com_id = getValue('com_id', 'int', 'POST', '');
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
if($id != ""){
    // $noi_dung_nk = "Bạn đã xóa phân quyền nhân viên: ID - " . $id_nv . "Mã phân quyền: " . $id;
    // $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
    //                         VALUES('', '$com_id', '1', '$ngay_tao','$gio_tao', '$noi_dung_nk',`$com_id`)");

    $delete_log = new db_query("DELETE FROM `nhat_ky_hd` WHERE `id` = $id AND `id_cong_ty` = $com_id ");
}else{
    echo "Xóa không thành công!";
}
