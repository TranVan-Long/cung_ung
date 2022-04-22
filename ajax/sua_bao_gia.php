<?

include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_bao_gia = getValue('id_bao_gia', 'int', 'POST', '');
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$id_phieu_yc = getValue('id_phieu_yc', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

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

$noi_dung_nk = "Bạn đã cập nhật phiếu báo giá: BG - ".$id_bao_gia;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if($id_ncc != "" && $id_phieu_yc != "" ){
    if($co1 > 0){
        if($co2 == $co3 && $co1 == $co2){
            $up_bao_gia = new db_query("UPDATE `bao_gia` SET `id_yc_bg`='$id_phieu_yc',`id_nha_cc`='$id_ncc',
                                `ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt' WHERE `id` = $id_bao_gia AND `id_cong_ty` = $com_id ");

            $remo_bg = new db_query("DELETE FROM `vat_tu_da_bao_gia` WHERE `id_bao_gia` = $id_bao_gia ");

            for ($i = 0; $i < $co2; $i++) {
                $inser_bg = new db_query("INSERT INTO `vat_tu_da_bao_gia`(`id`, `id_bao_gia`, `id_vat_tu`, `so_luong_bg`, `don_gia`, `tong_tien_trvat`,
                                    `thue_vat`, `tong_tien_svat`, `cs_kem_theo`, `sl_da_dat_hang`)
                                    VALUES ('','$id_bao_gia','$new_ma_vt[$i]','$new_sl_bg[$i]','$new_dgia[$i]','$new_tongtr[$i]',
                                    '$new_thue[$i]','$new_tongs[$i]','$new_cs_kt[$i]','$new_ddh[$i]')");
            }

            $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`,`id_cong_ty`)
                                VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao','$noi_dung_nk','$com_id')");
        }else if($co2 != $co3 || $co1 != $co2){
            echo "Điền đầy đủ thông tin vật tư";
        }
    }else{
        echo "Điền đầy đủ thông tin vật tư";
    }
}
else{
    echo "Bạn cập nhật phiếu báo giá không thành công, vui lòng cập nhật lại!";
}
