<?
include("config.php");
$id = getValue('id', 'int', 'POST', '');

$xoa_vat_tu = new db_query("DELETE FROM `vat_tu_hd_thue` WHERE `id` = $id");

if (isset($xoa_vat_tu)) {
    echo "";
} else {
    echo "Xóa thiết bị không thành công!";
}
