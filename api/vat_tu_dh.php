<?
include("config.php");

$id_com = getValue('com_id', 'int', 'POST', '0');
$id_dh = getValue('dh_id', 'int', 'POST', '0');

if($id_com != 0 && $id_dh != 0){
    $qr_dh = new db_query("SELECT `id`, `id_don_hang`, `id_vat_tu`, `so_luong_ky_nay`, `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`,
                        `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang` FROM `vat_tu_dh_mua_ban`
                        WHERE `id_cong_ty` = $id_com AND `id_don_hang` = $id_dh ");
    $list_vt = $qr_dh -> result_array();

    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `vat_tu_dh_mua_ban` WHERE `id_cong_ty` = $id_com AND `id_don_hang` = $id_dh ");
    $total = $qr_total -> objectItems() -> total;

    echo result_data($list_vt, null, $total);
}else{
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}

?>