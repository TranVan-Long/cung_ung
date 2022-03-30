<?
include('config.php');

$com_id = getValue('com_id', 'int', 'POST', '');
$ycvt_id = getValue('ycvt_id', 'int', 'POST', '');
$ly_do_tu_choi = $_POST['ly_do_tu_choi'];

$ep_id = getValue('ep_id', 'int', 'POST', '');
$date = strtotime(date('Y-m-d', time()));

if ($ycvt_id != "" && $com_id != "" && $ly_do_tu_choi != "") {
    $tc_yeu_cau = new db_query("UPDATE `yeu_cau_vat_tu` SET `ly_do_tu_choi` = '$ly_do_tu_choi', `trang_thai` = 3, `id_nguoi_duyet` = '$ep_id', `ngay_duyet` = '$date' WHERE `id` = $ycvt_id;");

    $noi_dung = 'Bạn đã từ chối yêu cầu vật tư: YC-' . $ycvt_id;
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$date','$gio_tao', '$noi_dung')");
} else {
    echo "Từ chối yêu cầu không thành công, vui lòng thử lại!";
}
