<?
include('config.php');
$ycvt_id = getValue('ycvt_id', 'int', 'POST', '');
$id_kho = getValue('id_kho', 'int', 'POST', '');
$ep_id = getValue('ep_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_vat_tu = $_POST['id_vat_tu'];
$cou1 = count($id_vat_tu);

$so_luong_duyet = $_POST['so_luong_duyet'];
$cou = count($so_luong_duyet);

$date = strtotime(date('Y-m-d', time()));


if ($ycvt_id != "" && $com_id != "" && $id_kho != "" && $cou > 0 && $cou1 == $cou) {
    $duyet_yeu_cau = new db_query("UPDATE `yeu_cau_vat_tu` SET `id_kho` = $id_kho, `trang_thai` = 2, `id_nguoi_duyet` = $ep_id, `ngay_duyet` = $date WHERE `id` = $ycvt_id AND `id_cong_ty` = $com_id ");

    for ($i = 0; $i < $cou1; $i++) {
        $duyet_vat_tu = new db_query("UPDATE `chi_tiet_yc_vt` SET `so_luong_duyet` = $so_luong_duyet[$i] WHERE `id` = $id_vat_tu[$i]");
    }
    //save log
    $noi_dung = 'Bạn đã duyệt yêu cầu vật tư: YC - ' . $ycvt_id;
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$date','$gio_tao', '$noi_dung')");
} else {
    echo "Duyệt phiếu yêu cầu vật tư không thành công, vui lòng thử lại!";
}
