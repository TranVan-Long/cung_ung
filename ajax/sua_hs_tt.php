<?
include("config.php");

$id_hs = getValue('id_hs', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$hdong_dhang = getValue('hdong_dhang', 'int', 'POST', '');
$dot_nthu = $_POST['dot_nthu'];

if ($_POST['thoig_nthu'] == "") {
    $thoig_nthu = "";
} else if ($_POST['thoig_nthu'] != "") {
    $thoig_nthu = strtotime($_POST['thoig_nthu']);
};

if ($_POST['thoih_ttoan'] == "") {
    $thoih_ttoan = "";
} else if ($_POST['thoih_ttoan'] != "") {
    $thoih_ttoan = strtotime($_POST['thoih_ttoan']);
};

$id_hs_ct = $_POST['id_hs_ct'];
$cou = count($id_hs_ct);

$id_vt = $_POST['id_vt'];
$cou1 = count($id_vt);
$kl_kn = $_POST['kl_kn'];
$gia_tri_kn = $_POST['gia_tri_kn'];
$tien_trvat = $_POST['tien_trvat'];
$tien_thue = $_POST['tien_thue'];
$chi_phi_khac = $_POST['chi_phi_khac'];
$tien_svat = $_POST['tien_svat'];

$ngay_sua = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$noi_dung_nk = "Bạn đã cập nhật hồ sơ thanh toán: " . $id_hs;

if ($id_hs != "" && $com_id != "" && $user_id != "" && $hdong_dhang != "" && $cou > 0) {

    $up_hoso = new db_query("UPDATE `ho_so_thanh_toan` SET `loai_hs`='$loai_hs',`id_hd_dh`='$hdong_dhang',`dot_nghiem_thu`='$dot_nthu',
                            `tg_nghiem_thu`='$thoig_nthu',`thoi_han_thanh_toan`='$thoih_ttoan',`ngay_chinh_sua`='$ngay_sua',`tong_tien_tt` = '$tien_trvat',
                            `tong_tien_thue` = '$tien_thue', `tong_tien_tatca` = '$tien_svat', `chi_phi_khac` = '$chi_phi_khac'
                            WHERE `id_cong_ty` = $com_id AND `id` = $id_hs ");

    for($i = 0; $i < $cou; $i++){
        $upda_cths = new db_query("UPDATE `chi_tiet_hs` SET `id_hd_dh`='$hdong_dhang',`kl_ky_nay`='$kl_kn[$i]',`gia_tri_ky_nay`='$gia_tri_kn[$i]'
                                WHERE `id` = '$id_hs_ct[$i]' AND `id_cong_ty` = $com_id AND `id_vat_tu`='$id_vt[$i]' ");
    }

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_sua','$gio_tao', '$noi_dung_nk')");

} else {
    echo "Bạn cập nhật hồ sơ thanh toán không thành công, vui lòng thử lại";
}