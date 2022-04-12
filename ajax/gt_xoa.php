<?
    include("config.php");
    $id = getValue('id', 'int', 'POST', '');

    if($id != ""){

        $delete_gt = new db_query("DELETE FROM `ds_gia_tri_dg` WHERE `id` = '$id' ");
    }else{
        echo "Bạn xóa tiêu chí đánh giá không thành công, vui lòng thử lại";
    }
