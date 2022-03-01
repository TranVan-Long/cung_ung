<?

include("config.php");
$com_id = $_POST['com_id'];
$id_bao_gia = $_POST['id_bao_gia'];
$id_ncc = $_POST['id_ncc'];
$id_phieu_yc = $_POST['id_phieu_yc'];

if($_POST['ngay_bd'] != ""){
    $ngay_bd = strtotime($_POST['ngay_bd']);
}else{
    $ngay_bd = "";
};

if($_POST['ngay_kt'] != ""){
    $ngay_kt = strtotime($_POST['ngay_kt']);
}else{
    $ngay_kt = "";
}

$new_ma_vt = $_POST['new_ma_vt'];
$co1 = count($new_ma_vt);

$new_sl_bg = $_POST['new_sl_bg'];
$co2 = count($new_sl_bg);

$new_dgia = $_POST['new_dgia'];
$co3 = count($new_dgia);

$new_tongtr = $_POST['new_tongtr'];
$co4 = count($new_tongtr);

$new_thue = $_POST['new_thue'];
$new_tongs = $_POST['new_tongs'];
$co5 = count($new_tongs);

$new_cs_kt = $_POST['new_cs_kt'];
$new_ddh = $_POST['new_ddh'];

if($id_ncc != "" && $id_phieu_yc != "" && $co2 == $co3 && $co4 == $co5 && $co2 == $co4){

    $up_bao_gia = new db_query("UPDATE `bao_gia` SET `id_yc_bg`='$id_phieu_yc',`id_nha_cc`='$id_ncc',
                                `ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt' WHERE `id` = $id_bao_gia AND `id_cong_ty` = $com_id ");

    $remo_bg = new db_query("DELETE FROM `vat_tu_da_bao_gia` WHERE `id_bao_gia` = $id_bao_gia ");

    for($i = 0; $i < $co2; $i++){
        $inser_bg = new db_query("INSERT INTO `vat_tu_da_bao_gia`(`id`, `id_bao_gia`, `id_vat_tu`, `so_luong_bg`, `don_gia`, `tong_tien_trvat`,
                                 `thue_vat`, `tong_tien_svat`, `cs_kem_theo`, `sl_da_dat_hang`)
                                 VALUES ('','$id_bao_gia','$new_ma_vt[$i]','$new_sl_bg[$i]','$new_dgia[$i]','$new_tongtr[$i]',
                                 '$new_thue[$i]','$new_tongs[$i]','$new_cs_kt[$i]','$new_ddh[$i]')");
    }


}
else{
    echo "Bạn cập nhật phiếu báo giá không thành công, vui lòng cập nhật lại!";
}

?>