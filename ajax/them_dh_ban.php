<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_kh = getValue('id_kh', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');
$id_hd = getValue('id_hd', 'int', 'POST', '');

if($_POST['ngayky_dh'] != ""){
    $ngayky_dh = strtotime($_POST['ngayky_dh']);
}else if($_POST['ngayky_dh'] == ""){
    $ngayky_dh = 0;
}
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');

if ($_POST['thoi_han_dh'] != "") {
    $thoi_han_dh = strtotime($_POST['thoi_han_dh']);
} else {
    $thoi_han_dh = 0;
};

$dv_nha_hang = $_POST['dv_nha_hang'];
$pb_nguoi_nhan = $_POST['pb_nguoi_nhan'];
$nguoi_nhan = $_POST['nguoi_nhan'];
$dt_nguoi_nhan = $_POST['dt_nguoi_nhan'];
$baoh_hd = getValue('baoh_hd', 'int', 'POST', '');
$gia_tri_bh = getValue('gia_tri_bh', 'int', 'POST', '');
$ghi_chu = sql_injection_rp($_POST['ghi_chu']);
$giatr_vat = $_POST['giatr_vat'];
$dgia_vat = getValue('dgia_vat', 'int', 'POST', '');
$thue_vat = getValue('thue_vat', 'int', 'POST', '');
$phan_loai_nk = getValue('phan_loai_nk', 'int', 'POST', '');
$tien_chkhau = $_POST['tien_chkhau'];
$gias_vat = $_POST['gias_vat'];
$chi_phi_vc = $_POST['chi_phi_vc'];
$ghic_vc = sql_injection_rp($_POST['ghic_vc']);

$id_vt = $_POST['id_vt'];
$cou = count($id_vt);

$so_luong = $_POST['so_luong'];
$thoi_han_gh = $_POST['thoi_han_gh'];
$don_gia = $_POST['don_gia'];
$ttien_tr = $_POST['ttien_tr'];
$thuevat = $_POST['thuevat'];
$ttien_s = $_POST['ttien_s'];
$dia_chi_g = $_POST['dia_chi_g'];
$so_luong_hd = $_POST['so_luong_hd'];

$trang_thai = 1;
$phan_loai = 2;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($com_id != "" && $id_kh != "" && $cou > 0) {
    $inser_dhb = new db_query("INSERT INTO `don_hang`(`id`, `id_nha_cc_kh`, `id_nguoi_lh`, `id_hop_dong`, `id_du_an_ctrinh`, `ngay_ky`, `thoi_han`,
                            `don_vi_nhan_hang`, `phong_ban`, `nguoi_nhan_hang`, `dien_thoai_nn`, `giu_lai_bao_hanh`, `gia_tri_tuong_duong`, `ghi_chu`,
                            `gia_tri_don_hang`, `thue_vat`, `gia_tri_svat`, `bao_gom_vat`, `chiet_khau`, `chi_phi_vchuyen`, `ghi_chu_vchuyen`, `phan_loai`,
                            `gui_mail`, `hieu_luc`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`, `nhap_xuat_kho`, `id_cong_ty`) VALUES ('','$id_kh',
                            '$id_nguoi_lh','$id_hd','$id_ctrinh','$ngayky_dh','$thoi_han_dh','$dv_nha_hang',
                            '$pb_nguoi_nhan','$nguoi_nhan','$dt_nguoi_nhan','$baoh_hd','$gia_tri_bh','$ghi_chu','$giatr_vat','$thue_vat','$gias_vat','$dgia_vat',
                            '$tien_chkhau','$chi_phi_vc','$ghic_vc','$phan_loai','',1,'$trang_thai','$ngay_tao','','','$com_id')");


    $id_si = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS id_dhb "))->result);
    $id_dhb = $id_si['id_dhb'];

    for ($i = 0; $i < $cou; $i++) {
        $thoi_han = strtotime($thoi_han_gh[$i]);
        $inser_vt = new db_query("INSERT INTO `vat_tu_dh_mua_ban`(`id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`,
                                 `so_luong_ky_nay`, `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`,
                                `tong_tien_svat`, `dia_diem_giao_hang`,`id_cong_ty`) VALUES ('','$id_dhb',$id_hd,'$id_vt[$i]','$so_luong_hd[$i]',
                                '$so_luong[$i]','$thoi_han','$don_gia[$i]','$ttien_tr[$i]','$thuevat[$i]','$ttien_s[$i]','$dia_chi_g[$i]','$com_id')");
    };

    $noi_dung_nk = "Bạn đã thêm đơn hàng bán vật tư: ĐH - " . $id_dhb;
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                        VALUES('', '$user_id','$phan_loai_nk', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
} else {
    echo "Bạn thêm đơn hàng thất bại, vui lòng thử lại";
}
