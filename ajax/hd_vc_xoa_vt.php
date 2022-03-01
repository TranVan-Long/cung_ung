<?

include("config.php");
$id = $_POST['id'];

$xoa_vat_tu = new db_query("DELETE FROM `vat_tu_hd_vc` WHERE `vat_tu_hd_vc`.`id` = $id");
if(isset($xoa_vat_tu)){
    echo "";
}else{
    echo "Xóa vật tư không thành công!";
}
?>