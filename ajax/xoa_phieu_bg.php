<?

include("config.php");
$id = getValue('id','int','POST','');
$com_id = getValue('com_id','int','POST','');

if($id != "" && $com_id != ""){
    $xoa_phieu = new db_query("DELETE FROM `bao_gia` WHERE `id` = $id  AND `id_cong_ty` = $com_id ");
}


?>