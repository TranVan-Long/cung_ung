<?
include("config.php");
$id_vt = $_POST['id_vt'];
$id_p = $_POST['id_p'];

if($id_p != "" && $id_vt != ""){
    $remo_vattu = new db_query("DELETE FROM `vat_tu_bao_gia` WHERE `id` = $id_vt AND `id_yc_bg` = $id_p  ");
}

?>