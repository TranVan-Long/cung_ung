<?

include("config.php");
$id = getValue('id','int','POST','');
$com_id = getValue('com_id','int','POST','');
$user_id = getValue('user_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$noi_dung_nk = "Bạn đã xóa phiếu báo giá: BG - " .$id;

if($id != "" && $com_id != ""){

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                            VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao','$noi_dung_nk','$com_id')");

    $xoa_phieu = new db_query("DELETE FROM `bao_gia` WHERE `id` = $id  AND `id_cong_ty` = $com_id ");
}else{
    echo "Bạn xóa phiếu báo giá không thành công, vui lòng thử lại!";
}


?>