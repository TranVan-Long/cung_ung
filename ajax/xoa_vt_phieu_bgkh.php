<?
include("config.php");
$id_vt = getValue('id_vt', 'int', 'POST', '');
$id_p = getValue('id_p', 'int', 'POST', '');

if($id_p != "" && $id_vt != ""){
    $remo_vattu = new db_query("DELETE FROM `vat_tu_bao_gia` WHERE `id` = $id_vt AND `id_yc_bg` = $id_p  ");
}

?>