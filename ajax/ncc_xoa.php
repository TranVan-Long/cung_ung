<?
    include("config.php");
    $id = $_POST['id'];

    $delete_ncc = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' ");
    if(isset($delete_ncc)){
        echo "";
    }else{
        echo "Lỗi";
    }
?>