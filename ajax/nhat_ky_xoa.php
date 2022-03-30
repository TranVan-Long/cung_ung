<?
include("config.php");
$id = getValue('id', 'int', 'POST','');

if($id != ""){
    $delete_log = new db_query("DELETE FROM `nhat_ky_hd` WHERE `id` = $id");
}else{
    echo "Xóa không thành công!";
}
