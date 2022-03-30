<?
    include("config.php");
    $id = getValue('id', 'int', 'POST', '');

    $delete_kh = new db_query("DELETE FROM `nha_cc_kh` WHERE `id` = '$id' ");
    if(isset($delete_kh)){
        echo "";
    }else{
        echo "Xóa không thành công.";
    }
?>