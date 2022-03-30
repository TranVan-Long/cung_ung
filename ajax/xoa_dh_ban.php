<?
include("config.php");
$id_dh = getValue('id_dh','int','POST','');
$com_id = getValue('com_id','int','POST','');

if($id_dh != "" && $com_id != ""){
    $remo_dh = new db_query("DELETE FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $id_dh ");
}else{
    echo "Bạn xóa đơn hàng thất bại, vui lòng thử lại!";
}

?>