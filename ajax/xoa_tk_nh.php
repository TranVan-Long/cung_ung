<?

include("config.php");
$id = $_POST['id'];

$xoa_tk = new db_query("DELETE FROM `tai_khoan` WHERE  `id` = '$id' ");
if(isset($xoa_tk)){
    echo "";
}else{
    echo "Bạn xóa ngân hàng không thành công";
}



?>