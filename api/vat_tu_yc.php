<?
include("config.php");

$id_phieu = getValue('id_phieu','int','POST','0');

if($id_phieu != 0){
    $qr_vatt = new db_query("SELECT `id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet` FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $id_phieu ");
    $list_vatt = $qr_vatt -> result_array();

    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $id_phieu ");
    $total = $qr_total -> objectItems() -> total;

    echo result_data($list_vatt, null, $total);
}else{
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}

?>