<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_kh = getValue('id_kh', 'int', 'POST', '');
$ngay_bd = strtotime($_POST['ngay_bd']);
$ngay_kt = strtotime($_POST['ngay_kt']);
$noi_dung_ph = $_POST['noi_dung_ph'];
$noi_dung_ph = sql_injection_rp($noi_dung_ph);
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$id_vt = $_POST['id_vt'];
$cou = count($id_vt);

$so_luong = $_POST['so_luong'];
$cou1 = count($so_luong);

$don_gia = $_POST['don_gia'];
$cou2 = count($don_gia);

$ngay_tao = strtotime(date('Y-m-d', time()));

$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));

if ($cou == 0) {
    echo "Chọn vật tư báo giá";
} else if ($com_id != "" && $id_kh != "" && $cou > 0) {
    if ($cou != $cou1 || $cou1 != $cou2) {
        echo "Điền đầy đủ thông tin vật tư báo giá";
    } else if ($cou == $cou1 && $cou1 == $cou2) {
        $inser_bg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`,
                                `noi_dung_thu`, `mail_nhan_bg`, `gui_mail`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`,
                                `quyen_nlap`, `ngay_tao`, `ngay_chinh_sua`, `id_cong_ty`) VALUES ('','$user_id','$id_kh','','',
                                '$noi_dung_ph','','','$ngay_bd','$ngay_kt','',2,1,'$phan_quyen_nk','$ngay_tao','','$com_id') ");
        $list_id = new db_query("SELECT LAST_INSERT_ID() AS id_p ");
        $id_phieu = mysql_fetch_assoc($list_id->result)['id_p'];

        for ($i = 0; $i < $cou; $i++) {
            $inser_vt = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`, `don_gia`)
                                    VALUES ('','$id_phieu','$id_vt[$i]','$so_luong[$i]', '$don_gia[$i]')");
        };

        $nd_nhatk = "Bạn đã thêm phiếu báo giá khách hàng là: BG - " . $id_phieu;
        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$nd_nhatk','$com_id')");
    }
} else {
    echo "Bạn thêm phiếu báo giá khách hàng không thành công, vui lòng thử lại!";
}
