<?

include("config.php");
$id = getValue('id', 'int', 'POST', '');

$xoa_nlh = new db_query("DELETE FROM `nguoi_lien_he` WHERE  `id` = '$id' ");
if(isset($xoa_nlh)){
    echo "";
}else{
    echo "Bạn xóa ngân hàng không thành công";
}



?>