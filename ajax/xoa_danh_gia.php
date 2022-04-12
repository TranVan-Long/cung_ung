<?

include("config.php");
$id = getValue('id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');


$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if (isset($id) && $id != "" && $user_id != "") {
    $ten_nhacc = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nha_cc`, n.`id`, n.`ten_nha_cc_kh`  FROM `danh_gia` AS d
                                    INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id`
                                    WHERE d.`id` = $id "))->result);
    $noi_dung = "Bạn đã xóa đánh giá nhà cung cấp" . $ten_nhacc['ten_nha_cc_kh'] ." phiếu đánh giá : PH - " .$id;

    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`, `id_cong_ty`)
                        VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung', '$com_id)");

    $remo_dg = new db_query("DELETE FROM `danh_gia` WHERE `id` = $id AND `id_cong_ty` = $com_id ");
} else {
    echo "Bạn xóa đánh giá không thành công, vui lòng thử lại!";
}
