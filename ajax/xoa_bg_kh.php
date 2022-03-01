<?

include("config.php");
$id_bg = $_POST['id_bg'];
$user_id = $_POST['user_id'];

$noi_dung_nk = "Bạn đã xóa phiếu báo giá khách hàng phiếu: BG - ".$id_bg;
$thoi_gian = strototime(date('Y-m-d H:i:s', time()));
if($id_bg != "" && $user_id != ""){
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$noi_dung_nk')");
    $remo_phieu = new db_query("DELETE FROM `yeu_cau_bao_gia` WHERE `id` = $id_bg ");
}else{
    echo "Bạn xóa phiếu báo giá khách hàng không thành công, vui lòng thử lại!";
}

?>