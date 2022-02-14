<?
include("config.php");
$id = $_POST['id'];
$remove_vt = new db_query("DELETE FROM `vat_tu_bao_gia` WHERE `id` = $id ");
?>