<?

include("config.php");
$id = getValue('id', 'int', 'POST', '');
for ($i = 0; $i < count($id); $i++) {
    $xoa_vat_tu = new db_query("DELETE FROM `vat_tu_hd_dh` WHERE `vat_tu_hd_dh`.`id` = $id[$i]");
}
if (isset($xoa_vat_tu)) {
    echo "";
} else {
    echo "Xóa vật tư không thành công!";
}
