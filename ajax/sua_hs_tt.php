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
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$ngay_sua = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$noi_dung_nk = "Bạn đã cập nhật hồ sơ thanh toán: " . $id_hs;

if ($id_hs != "" && $com_id != "" && $user_id != "" && $hdong_dhang != "") {

    $check_tt = new db_query("SELECT `id` FROM `ho_so_thanh_toan` WHERE `id` = $id_hs AND `id_hd_dh`= $hdong_dhang AND `id_cong_ty` = $com_id AND `loai_hs` = $loai_hs ");
    if(mysql_num_rows($check_tt -> result) > 0){
        $up_hoso = new db_query("UPDATE `ho_so_thanh_toan` SET  `dot_nghiem_thu` = '$dot_nthu', `tg_nghiem_thu` = '$thoig_nthu',
                            `thoi_han_thanh_toan` = '$thoih_ttoan', `ngay_chinh_sua` = '$ngay_sua', `tong_tien_tt` = '$tien_trvat',
                            `tong_tien_thue` = '$tien_thue', `tong_tien_tatca` = '$tien_svat', `chi_phi_khac` = '$chi_phi_khac'
                            WHERE `id_cong_ty` = $com_id AND `id` = $id_hs ");

        for ($i = 0; $i < $cou; $i++) {
            $upda_cths = new db_query("UPDATE `chi_tiet_hs` SET `kl_ky_nay`='$kl_kn[$i]',`gia_tri_ky_nay`='$gia_tri_kn[$i]'
                                WHERE `id` = '$id_hs_ct[$i]' AND `id_cong_ty` = $com_id AND `id_vat_tu`='$id_vt[$i]' AND `id_hd_dh`='$hdong_dhang' ");
        }
        $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_sua','$gio_tao', '$noi_dung_nk','$com_id')");
    }else{

        $up_hoso = new db_query("UPDATE `ho_so_thanh_toan` SET `loai_hs` = '$loai_hs', `id_hd_dh` = '$hdong_dhang', `dot_nghiem_thu` = '$dot_nthu',
                            `tg_nghiem_thu` = '$thoig_nthu', `thoi_han_thanh_toan`= '$thoih_ttoan', `ngay_chinh_sua` = '$ngay_sua', `tong_tien_tt` = '$tien_trvat',
                            `tong_tien_thue` = '$tien_thue', `tong_tien_tatca` = '$tien_svat', `chi_phi_khac` = '$chi_phi_khac'
                            WHERE `id_cong_ty` = $com_id AND `id` = $id_hs ");


        $dele_hs_ct = new db_query("DELETE FROM `chi_tiet_hs` WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id ");

        for($j = 0; $j < $cou1; $j++){
            $inser_hs_ct = new db_query("INSERT INTO `chi_tiet_hs`(`id`, `id_hs`, `id_hd_dh`, `id_vat_tu`, `kl_ky_nay`, `gia_tri_ky_nay`,
                                    `ngay_tao`, `id_cong_ty`) VALUES ('','$id_hs','$hdong_dhang','$id_vt[$j]','$kl_kn[$j]','$gia_tri_kn[$j]','$ngay_sua','$com_id')");
        }

        $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_sua','$gio_tao', '$noi_dung_nk','$com_id')");
    }

} else {
    echo "Bạn cập nhật hồ sơ thanh toán không thành công, vui lòng thử lại";
}
