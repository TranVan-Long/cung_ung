<?
include("config.php");

$id_com = getValue('id_com', 'int', 'POST', '0');
$id_hd = getValue('id_hd', 'int', 'POST', '0');

if($id_com != 0 && $id_hd != 0){
    $qr_vthd = new db_query("SELECT v.`id`, v.`id_vat_tu`, v.`so_luong`, v.`don_gia`, v.`tien_trvat`, v.`thue_vat`, v.`tien_svat`
                            FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                             WHERE v.`id_hd_mua_ban` = $id_hd AND h.`id_cong_ty` = $id_com ");
    $list_vt = $qr_vthd -> result_array();

    $qr_total = new db_query("SELECT COUNT(v.`id`) AS total FROM `vat_tu_hd_dh` AS v INNER JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                             WHERE v.`id_hd_mua_ban` = $id_hd AND h.`id_cong_ty` = $id_com ");
    $total = $qr_total -> objectItems() -> total;

    echo result_data($list_vt, null, $total);
}else{
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}
