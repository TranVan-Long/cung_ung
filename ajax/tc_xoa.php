<?
    include("config.php");
    $id = $_POST['id'];
    $ep_id     = $_POST['ep_id'];


    //save log
    $noi_dung = 'Bạn đã xóa tiêu chí: TC-' .$id. '.';
    $ngay_tao = strtotime(date('Y-m-d H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                        VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
    $delete_tc = new db_query("DELETE FROM `tieu_chi_danh_gia` WHERE `id` = '$id' ");
    if(isset($delete_tc)){
        echo "";
    }else{
        echo "Lỗi";
    }
?>