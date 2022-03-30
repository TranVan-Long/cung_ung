<?
include("config.php");
$id        = getValue('id','int','POST','');
$ep_id     = getValue('ep_id','int','POST','');

//save log
if ($id != "") {
    $noi_dung = 'Bạn đã xóa phiếu yêu cầu vật tư: YC-' . $id;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao  = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung`)
                          VALUES('', '$ep_id', '$ngay_tao', '$gio_tao', '$noi_dung')");

    $delete_ycvt = new db_query("DELETE FROM `yeu_cau_vat_tu` WHERE `id` = '$id' ");
} else {
    echo "Lỗi! Xóa không thành công.";
}
