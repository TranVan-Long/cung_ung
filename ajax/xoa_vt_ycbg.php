<?
include("config.php");
$id = getValue('id','int','POST','');
$remove_vt = new db_query("DELETE FROM `vat_tu_bao_gia` WHERE `id` = $id ");
?>