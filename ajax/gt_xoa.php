<?
    include("config.php");
    $id        = $_POST['id'];

     
    $delete_gt = new db_query("DELETE FROM `ds_gia_tri_dg` WHERE `id` = '$id' ");

