<?
include("config.php");
$id = $_POST['id'];

$dele_dg = new db_query("DELETE FROM `chi_tiet_danh_gia` WHERE `id` = $id ");


?>