<?
include("config.php");

$id_ycvt = $_POST['id_ycvt'];
$ngay_ht = strtotime($_POST['ngay_ht']);
$dien_giai = $_POST['dien_giai'];

$id_vat_tu_old = $_POST['id_vat_tu_old'];
$vat_tu_old = $_POST['vat_tu_old'];
$so_luong_old = $_POST['so_luong_old'];

$vat_tu = $_POST['vat_tu'];
$so_luong = $_POST['so_luong'];

//user id
$ep_id = $_POST['ep_id'];
$date = strtotime(date('Y-m-d H:i:s', time()));

//cap nhat phieu ycvt
$sua_ycvt = new db_query("UPDATE `yeu_cau_vat_tu` SET `ngay_ht_yc` = $ngay_ht, `dien_giai` = '$dien_giai', `ngay_chinh_sua`= $date WHERE `yeu_cau_vat_tu`.`id` = $id_ycvt");

//cap nhat vat tu cu
for ($i = 0; $i < count($id_vat_tu_old); $i++) {
    $sua_vt_old = new db_query("UPDATE `chi_tiet_yc_vt` SET `id_vat_tu` = $vat_tu_old[$i],`so_luong_yc_duyet` = $so_luong_old[$i] WHERE `chi_tiet_yc_vt`.`id` = $id_vat_tu_old[$i]");
}

//them vat tu moi
for ($i = 0; $i < count($vat_tu); $i++) {
    $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet`) VALUES (NULL, $id_ycvt, $vat_tu[$i], $so_luong[$i], '0')");
}

//save log
$noi_dung = 'Bạn đã chỉnh sửa phiếu yêu cầu vật tư: YC-' . $id_ycvt;
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                  VALUES('', '$ep_id', '$date', '$noi_dung')");
