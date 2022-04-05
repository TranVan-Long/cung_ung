<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$dot_nthu = $_POST['dot_nthu'];

$id_vt = $_POST['id_vt'];

$sl_kynay = $_POST['sl_kynay'];
$giatri_kn = $_POST['giatri_kn'];
$tong_tien_ky_nay = $_POST['tong_tien_ky_nay'];
$chi_phi_khac = $_POST['chi_phi_khac'];
$tien_thue =  $_POST['tien_thue'];
$tien_svat = $_POST['tien_svat'];

if($_POST['thoig_nthu'] != ""){
    $thoig_nthu = strtotime($_POST['thoig_nthu']);
}else{
    $thoig_nthu = "";
};

if($_POST['thoi_han_tt'] != ""){
    $thoi_han_tt = strtotime($_POST['thoi_han_tt']);
}else{
    $thoi_han_tt = "";
};

$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if($tong_tien_ky_nay == "" && $tien_svat == ""){
    echo "Điền đầy đủ thông tin hồ sơ thanh toán";
}
else if($com_id != "" && $hd_dh != "" && $loai_hs != "" && $tong_tien_ky_nay != "" && $tien_svat != ""){

    $inser_hs = new db_query("INSERT INTO `ho_so_thanh_toan`(`id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`,
                            `tong_tien_tt`, `tong_tien_thue`, `tong_tien_tatca`, `chi_phi_khac`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`,
                            `id_nguoi_lap`, `id_cong_ty`) VALUES ('','$hd_dh','$loai_hs','$dot_nthu','$thoig_nthu','$thoi_han_tt','$tong_tien_ky_nay',
                            '$tien_thue','$tien_svat','$chi_phi_khac','1','$ngay_tao','','$user_id','$com_id')");

    $id_sinser = new db_query("SELECT LAST_INSERT_ID() AS id_hs ");
    $id_hs = mysql_fetch_assoc($id_sinser -> result)['id_hs'];

    for($i = 0; $i < count($id_vt); $i++){
        $inser_ct_hs = new db_query("INSERT INTO `chi_tiet_hs`(`id`, `id_hs`, `id_hd_dh`, `id_vat_tu`, `kl_ky_nay`, `gia_tri_ky_nay`, `ngay_tao`, `id_cong_ty`)
                                VALUES ('','$id_hs','$hd_dh','$id_vt[$i]','$sl_kynay[$i]','$giatri_kn[$i]','$ngay_tao','$com_id')");
    }

    $noi_dung_nk = "Bạn đã thêm hồ sơ thanh toán: ".$id_hs;
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung_nk')");

}
else{
    echo "Bạn thêm hồ sơ thanh toán không thành công, vui lòng thử lại!";
}


?>