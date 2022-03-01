<?
include('config.php');
$ycvt_id = $_POST['ycvt_id'];
$id_kho = $_POST['id_kho'];
$ep_id = $_POST['ep_id'];
$id_vat_tu = $_POST['id_vat_tu'];
$so_luong_duyet = $_POST['so_luong_duyet'];

$date = strtotime(date('Y-m-d', time()));


$duyet_yeu_cau = new db_query("UPDATE `yeu_cau_vat_tu` SET `id_kho` = $id_kho, `trang_thai` = 2, `id_nguoi_duyet` = $ep_id, `ngay_duyet` = $date WHERE `yeu_cau_vat_tu`.`id` = $ycvt_id;");

for ($i = 0; $i < count($id_vat_tu); $i++) {
    $duyet_vat_tu = new db_query("UPDATE `chi_tiet_yc_vt` SET `so_luong_duyet` = $so_luong_duyet[$i] WHERE `chi_tiet_yc_vt`.`id` = $id_vat_tu[$i]");
}
//save log
$noi_dung = 'Bạn đã duyệt yêu cầu vật tư: YC-' . $ycvt_id;

$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                         VALUES('', '$ep_id', '$date', '$noi_dung')");
