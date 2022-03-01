<?
include("config.php");
$id = $_POST['id'];
$user_id = $_POST['user_id'];
$noi_dung = "Bạn đã xóa phiếu yêu cầu báo giá: BG - " .$id;
$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));
if(isset($id) && $id != ""){
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$noi_dung')");
    $remo_yc = new db_query("DELETE FROM `yeu_cau_bao_gia` WHERE `id` = $id ");
}

?>