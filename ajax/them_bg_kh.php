<?
include("config.php");

$com_id = $_POST['com_id'];
$user_id = $_POST['user_id'];
$id_kh = $_POST['id_kh'];
$ngay_bd = strtotime($_POST['ngay_bd']);
$ngay_kt = strtotime($_POST['ngay_kt']);
$noi_dung_ph = $_POST['noi_dung_ph'];
$id_vt = $_POST['id_vt'];
$cou = count($id_vt);

$so_luong = $_POST['so_luong'];
$cou1 = count($so_luong);

$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));

if($com_id != "" && $id_kh != "" && $cou > 0 && $cou == $cou1){

    $inser_bg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`,
                            `noi_dung_thu`, `mail_nhan_bg`, `gui_mail`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`,
                            `ngay_tao`, `ngay_chinh_sua`, `id_cong_ty`) VALUES ('','$user_id','$id_kh','','',
                            '$noi_dung_ph','','','$ngay_bd','$ngay_kt','',2,1,'$thoi_gian','','$com_id') ");
    $list_id = new db_query("SELECT LAST_INSERT_ID() AS id_p ");
    $id_phieu = mysql_fetch_assoc($list_id -> result)['id_p'];

    for($i = 0; $i < $cou; $i++){
        $inser_vt = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$id_phieu','$id_vt[$i]','$so_luong[$i]')");
    };

    $nd_nhatk = "Bạn đã thêm phiếu báo giá khách hàng là: BG - ".$id_phieu;
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$nd_nhatk')");

}else{
    echo "Bạn thêm phiếu báo giá khách hàng không thành công, vui lòng thử lại!";
}


?>