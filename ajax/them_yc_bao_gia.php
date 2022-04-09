<?
include("config.php");
$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$ngay_lap = $_POST['ngay_lap'];
$id_nhacc = getValue('nhacc_id', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$noi_dung = $_POST['noi_dung'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];

$gui_mail = getValue('gui_mail', 'int', 'POST', '');

$gia_baog_vat = getValue('gia_baog_vat', 'int', 'POST', '');

$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);

$so_luong = $_POST['so_luong'];
$co1 = count($so_luong);

if ($user_id != "" && $com_id != "" && $id_nhacc != "" && $cou > 0) {
    if ($co1 != $cou) {
        echo "Điền đầy đủ thông tin yêu vầu vật tư";
    } else if ($cou == $co1) {
        $inser_ycbg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`, `noi_dung_thu`,
        `mail_nhan_bg`, `gui_mail`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`, `quyen_nlap`, `ngay_tao`, `ngay_chinh_sua`, `id_cong_ty`)
        VALUES (NULL,'$user_id','$id_nhacc','$id_ctrinh','$id_nguoi_lh','$noi_dung','$mail_nhan_bg','$gui_mail',
                '','','$gia_baog_vat',1,1,'$phan_quyen_nk','$ngay_lap','','$com_id')");

        $id_ycbg = new db_query("SELECT LAST_INSERT_ID() AS yc_id");
        $yc_id = mysql_fetch_assoc($id_ycbg->result)['yc_id'];

        for ($j = 0; $j < $cou; $j++) {
            $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$yc_id','$ma_vt[$j]','$so_luong[$j]')");
        }

        $noi_dung_thu = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " . $yc_id;
        $ngay_tao = strtotime(date('Y-m-d', time()));
        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                            VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
    }
} else {
    echo "Bạn yêu cầu báo giá không thành công, vui lòng thử lại!";
}
