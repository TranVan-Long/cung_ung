<?

include("config.php");
$id = $_POST['id'];
$user_id = $_POST['user_id'];
$time = strtotime(date('Y-m-d H:i:s', time()));

if(isset($id) && $id != "" && $user_id != ""){
    $ten_nhacc = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nha_cc`, n.`id`, n.`ten_nha_cc_kh`  FROM `danh_gia` AS d
                                    INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id`
                                    WHERE d.`id` = $id ")) -> result );
    $noi_dung = "Bạn đã xóa đánh giá nhà cung cấp".$ten_nhacc['ten_nha_cc_kh'];

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$time','$noi_dung')");
    $remo_dg = new db_query("DELETE FROM `danh_gia` WHERE `id` = $id ");

}else{
    echo "Bạn xóa đánh giá không thành công, vui lòng thử lại!";
}

?>