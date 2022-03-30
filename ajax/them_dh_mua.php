<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_ncc = getValue('ten_ncc', 'int', 'POST', '');
$nguoi_lh = getValue('nguoi_lh', 'int', 'POST', '');
$hop_dong = getValue('hop_dong', 'int', 'POST', '');
// echo $hop_dong; die();

if ($_POST['ngay_ky_dh'] == "") {
    $ngay_ky_dh = 0;
} else if ($_POST['ngay_ky_dh'] != "") {
    $ngay_ky_dh = strtotime($_POST['ngay_ky_dh']);
}

$id_cong_trinh = $_POST['id_cong_trinh'];

if ($_POST['thoi_han'] == "") {
    $thoi_han = 0;
} else if ($_POST['thoi_han'] != "") {
    $thoi_han = strtotime($_POST['thoi_han']);
}

$dv_nhan_hang = $_POST['dv_nhan_hang'];
$nguoi_nhan_hang = getValue('nguoi_nhan_hang', 'int', 'POST', '');
$phong_ban = getValue('phong_ban', 'int', 'POST', '');
$dient_nnhan = $_POST['dient_nnhan'];
$phan_tram_bh = $_POST['phan_tram_bh'];
$gia_tri_bh = $_POST['gia_tri_bh'];
$ghi_chu = $_POST['ghi_chu'];
$giatr_vat = $_POST['giatr_vat'];
$baogom_dg_vat = $_POST['baogom_dg_vat'];
$thue_vat = $_POST['thue_vat'];
$tien_ckhau = $_POST['tien_ckhau'];
$gias_vat = $_POST['gias_vat'];
$chi_phi_vc = $_POST['chi_phi_vc'];
$ghic_vc = $_POST['ghic_vc'];
$phan_loai = 1;
$trang_thai = 1;
$ngay_tao = strtotime(date('Y-m-d', time()));

$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);
$don_gia = $_POST['don_gia'];
$so_luong_hd = $_POST['so_luong_hd'];
$sl_knay = $_POST['sl_knay'];
$thoig_ghang = $_POST['thoig_ghang'];
$ttr_vat = $_POST['ttr_vat'];
$thue_vat_vt = $_POST['thue_vat_vt'];
$tts_vat = $_POST['tts_vat'];
$dia_chi_g = $_POST['dia_chi_g'];

if ($com_id != "" && $hop_dong != "" && $cou > 0) {
    $inser_dhm = new db_query("INSERT INTO `don_hang`(`id`, `id_nha_cc_kh`, `id_nguoi_lh`, `id_hop_dong`, `id_du_an_ctrinh`, `ngay_ky`,
                                `thoi_han`, `don_vi_nhan_hang`, `phong_ban`, `nguoi_nhan_hang`, `dien_thoai_nn`, `giu_lai_bao_hanh`, `gia_tri_tuong_duong`,
                                `ghi_chu`, `gia_tri_don_hang`, `thue_vat`, `gia_tri_svat`, `bao_gom_vat`, `chiet_khau`, `chi_phi_vchuyen`, `ghi_chu_vchuyen`,
                                `phan_loai`, `gui_mail`, `hieu_luc`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`, `nhap_xuat_kho`, `id_cong_ty`)
                                VALUES ('','$id_ncc','$nguoi_lh','$hop_dong','$id_cong_trinh','$ngay_ky_dh','$thoi_han','$dv_nhan_hang','$phong_ban',
                                '$nguoi_nhan_hang','$dient_nnhan','$phan_tram_bh','$gia_tri_bh','$ghi_chu','$giatr_vat','$thue_vat','$gias_vat','$baogom_dg_vat',
                                '$tien_ckhau','$chi_phi_vc','$ghic_vc','$phan_loai','',1,'$trang_thai','$ngay_tao','','','$com_id')");

    $ids_inser = new db_query("SELECT LAST_INSERT_ID() AS id_dhm ");
    $id_dhm = mysql_fetch_assoc($ids_inser->result)['id_dhm'];

    for ($i = 0; $i < $cou; $i++) {
        $thoi_gian_gh = strtotime($thoig_ghang[$i]);
        $inser_vt = new db_query("INSERT INTO `vat_tu_dh_mua_ban`(`id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`,
                                `so_luong_ky_nay`, `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`,
                                `id_cong_ty`) VALUES ('','$id_dhm','$hop_dong','$ma_vt[$i]','$so_luong_hd[$i]','$sl_knay[$i]','$thoi_gian_gh','$don_gia[$i]',
                                '$ttr_vat[$i]','$thue_vat_vt[$i]','$tts_vat[$i]','$dia_chi_g[$i]','$com_id')");
    }

    $noi_dung = 'Bạn đã thêm đơn hàng mua vật tư: ĐH-' . $id_dhm;
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung')");
} else {
    echo "Bạn thêm đơn hàng mua thất bại, vui lòng thử lại!";
}
