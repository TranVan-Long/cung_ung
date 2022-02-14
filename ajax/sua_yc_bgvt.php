<?
include("config.php");
$id_bg = $_POST['id_bg'];
$id_nha_cc = $_POST['id_nha_cc'];
$id_nguoi_lh = $_POST['id_nguoi_lh'];
$id_ctrinh = $_POST['id_ctrinh'];
$noi_dung_thu = $_POST['noi_dung_thu'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];

$gui_mail = $_POST['gui_mail'];
$gui_mail = str_replace('_',',',$gui_mail);
$gui_mail = rtrim($gui_mail,',');

$gia_baog_vat = $_POST['gia_baog_vat'];
$gia_baog_vat = str_replace('_',',',$gia_baog_vat);
$gia_baog_vat = rtrim($gia_baog_vat,',');

$id_vatt = $_POST['id_vatt'];
$cou2 = count($id_vatt);

$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);

$so_luong = $_POST['so_luong'];
$co1 = count($so_luong);

$new_ma_vt = $_POST['new_ma_vt'];
if(isset($new_ma_vt) && $new_ma_vt != ""){
    $coun1 = count($new_ma_vt);
}

$new_sl = $_POST['new_sl'];
if(isset($new_sl) && $new_sl != ""){
    $coun2 = count($new_sl);
}

if($id_bg != "" && (($cou > 0 && $cou == $co1 && $cou == $cou2) || ($coun1 > 0 && $coun1 == $coun2)) ){
    $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
    `noi_dung_thu`='$noi_dung_thu',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat' WHERE `id` = $id_bg ");

    for($i = 0; $i < $cou2; $i++){
        $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
    }

    if(isset($new_ma_vt) && $new_ma_vt != ""){
        for($j = 0; $j < $coun1; $j++){
            $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`, `so_luong_bg`, `don_gia`, `tong_tien_trvat`,
                                    `thue_vat`, `tong_tien_svat`, `cs_kem_theo`, `sl_da_dat_hang`) VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]','','','','','','','')");
        }
    }

}else{
    echo "Bạn sửa yêu cầu báo giá không thành công, vui lòng thử lại!";
}

?>