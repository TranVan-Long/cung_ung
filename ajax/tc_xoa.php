<?
    include("config.php");
    $id = $_POST['id'];

    $delete_tc = new db_query("DELETE FROM `tieu_chi_danh_gia` WHERE `id` = '$id' ");
    if(isset($delete_tc)){
        echo "";
    }else{
        echo "Lỗi";
    }
?>