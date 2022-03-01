<?
include('config.php');
$ycvt_id = $_POST['ycvt_id'];
$ly_do_tu_choi = $_POST['ly_do_tu_choi'];

$ep_id = $_POST['ep_id'];
$date = strtotime(date('Y-m-d', time()));

$tc_yeu_cau = new db_query("UPDATE `yeu_cau_vat_tu` SET `ly_do_tu_choi` = '$ly_do_tu_choi', `trang_thai` = 3, `id_nguoi_duyet` = $ep_id, `ngay_duyet` = $date WHERE `yeu_cau_vat_tu`.`id` = $ycvt_id;");

//save log
$noi_dung = 'Bạn đã từ chối yêu cầu vật tư: YC-' . $ycvt_id;

$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                         VALUES('', '$ep_id', '$date', '$noi_dung')");

