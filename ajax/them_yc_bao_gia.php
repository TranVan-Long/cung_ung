<?
include("config.php");
$user_id = $_POST['user_id'];
$com_id = $_POST['com_id'];
$ngay_lap = $_POST['ngay_lap'];
$id_nhacc = $_POST['nhacc_id'];
$id_nguoi_lh = $_POST['id_nguoi_lh'];
$id_ctrinh = $_POST['id_ctrinh'];
$noi_dung = $_POST['noi_dung'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];

$gui_mail = $_POST['gui_mail'];
$gui_mail = str_replace('_',',',$gui_mail);
$gui_mail = rtrim($gui_mail,',');

$gia_baog_vat = $_POST['gia_baog_vat'];
$gia_baog_vat = str_replace('_',',',$gia_baog_vat);
$gia_baog_vat = rtrim($gia_baog_vat,',');

$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);

$so_luong = $_POST['so_luong'];
$co1 = count($so_luong);

$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));

if(isset($user_id) && $user_id != "" && $id_nhacc != "" && $cou > 0 && $cou == $co1){
    $inser_ycbg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`,
    `noi_dung_thu`, `mail_nhan_bg`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`,`id_cong_ty`)
    VALUES (NULL,'$user_id','$id_nhacc','$id_ctrinh','$id_nguoi_lh','$noi_dung','$mail_nhan_bg',NULL,NULL,'$gia_baog_vat',1,1,'$ngay_lap',NULL,'$com_id')");

    $id_ycbg = new db_query("SELECT LAST_INSERT_ID() AS yc_id");
    $yc_id = mysql_fetch_assoc($id_ycbg -> result)['yc_id'];

    for($j = 0; $j < $cou; $j++){
        $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$yc_id','$ma_vt[$j]','$so_luong[$j]')");
    }

    $noi_dung_thu = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " .$yc_id;
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$noi_dung_thu')");



}
else{
    echo "Bạn yêu cầu báo giá không thành công, vui lòng thử lại!";
}




?>