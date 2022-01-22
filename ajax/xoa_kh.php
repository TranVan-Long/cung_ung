<?
    include("config.php");
    $id = $_POST['id'];

    $delete_kh = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' ");
    if(isset($delete_kh)){
        echo "";
    }else{
        echo "Lỗi";
    }
?>