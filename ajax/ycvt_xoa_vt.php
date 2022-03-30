<?

include("config.php");
$id = getValue('id','int','POST','');

$xoa_vat_tu = new db_query("DELETE FROM `chi_tiet_yc_vt` WHERE `chi_tiet_yc_vt`.`id` = $id");
if(isset($xoa_vat_tu)){
    echo "";
}else{
    echo "Xóa vật tư không thành công!";
}
?>