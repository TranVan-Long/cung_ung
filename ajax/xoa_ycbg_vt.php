<?
include("config.php");
$id = getValue('id','int','POST','');
$user_id = getValue('user_id','int','POST','');
$noi_dung = "Bạn đã xóa phiếu yêu cầu báo giá: BG - " . $id;
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if (isset($id) && $id != "") {
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                        VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung', '$com_id')");
    $remo_yc = new db_query("DELETE FROM `yeu_cau_bao_gia` WHERE `id` = $id ");
}else{
    echo "Bạn xóa phiếu yêu cầu vật tư không thành công, vui lòng thử lại!";
}
