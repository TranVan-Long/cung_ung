<?
include("config.php");
$id = getValue('id','int','POST','');

$dele_dg = new db_query("DELETE FROM `chi_tiet_danh_gia` WHERE `id` = $id ");


?>