<?

include("config.php");
$id = $_POST['id'];

$xoa_nlh = new db_query("DELETE FROM `nguoi_lien_he` WHERE  `id` = '$id' ");
if(isset($xoa_nlh)){
    echo "";
}else{
    echo "Bạn xóa ngân hàng không thành công";
}



?>