<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_kh = getValue('id_kh', 'int', 'POST', '');
$id_hd = getValue('id_hd', 'int', 'POST', '');
$so_dh = getValue('so_dh', 'int', 'POST', '');
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');

if ($_POST['ngay_ky'] != "") {
    $ngay_ky = strtotime($_POST['ngay_ky']);
} else {
    $ngay_ky = 0;
};
if ($_POST['thoi_han'] != "") {
    $thoi_han = strtotime($_POST['thoi_han']);
} else {
    $thoi_han = 0;
};
$donv_nh = $_POST['donv_nh'];
$phong_ban = $_POST['phong_ban'];
$nguoi_nh = $_POST['nguoi_nh'];
$dient_nnhan = $_POST['dient_nnhan'];
$baoh_hd = $_POST['baoh_hd'];
$gia_tri = $_POST['gia_tri'];
$ghi_chu = $_POST['ghi_chu'];
$giatr_vat = $_POST['giatr_vat'];
$bg_gia_vat = $_POST['bg_gia_vat'];
$thue_vat = $_POST['thue_vat'];
$tien_ckhau = $_POST['tien_ckhau'];
$gias_vat = $_POST['gias_vat'];
$chi_phi_vc = $_POST['chi_phi_vc'];
$ghic_vc = $_POST['ghic_vc'];
$ma_vatt = $_POST['ma_vatt'];
$cou = count($ma_vatt);
$soluong_hd = $_POST['soluong_hd'];
$sl_knay = $_POST['sl_knay'];
$thoig_ghang = $_POST['thoig_ghang'];
$don_gia = $_POST['don_gia'];
$ttr_vat = $_POST['ttr_vat'];
$thue_vat_vt = $_POST['thue_vat_vt'];
$tts_vat = $_POST['tts_vat'];
$dia_chi_g = $_POST['dia_chi_g'];

if ($com_id != "" && $so_dh != "") {
    $upda_dhb = new db_query("UPDATE `don_hang` SET `id_nha_cc_kh`='$id_kh',`id_hop_dong`='$id_hd',`id_du_an_ctrinh`='$id_ctrinh',`ngay_ky`='$ngay_ky',
                            `thoi_han`='$thoi_han',`don_vi_nhan_hang`='$donv_nh',`phong_ban`='$phong_ban',`nguoi_nhan_hang`='$nguoi_nh',
                            `dien_thoai_nn`='$dient_nnhan',`giu_lai_bao_hanh`='$baoh_hd',`gia_tri_tuong_duong`='$gia_tri',`ghi_chu`='$ghi_chu',
                            `gia_tri_don_hang`='$giatr_vat',`thue_vat`='$thue_vat',`gia_tri_svat`='$gias_vat',`bao_gom_vat`='$bg_gia_vat',
                            `chiet_khau`='$tien_ckhau',`chi_phi_vchuyen`='$chi_phi_vc',`ghi_chu_vchuyen`='$ghic_vc'
                            WHERE `id` = $so_dh AND `id_cong_ty` = $com_id AND `phan_loai` = 2 ");

    $dele_vtb_old = new db_query("DELETE FROM `vat_tu_dh_mua_ban` WHERE `id_cong_ty` = $com_id AND `id_don_hang` = $so_dh ");

    for ($i = 0; $i < $cou; $i++) {
        $thoi_gian_giao = strtotime($thoig_ghang[$i]);
        $inser_vtb = new db_query("INSERT INTO `vat_tu_dh_mua_ban`(`id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`,
                    `so_luong_ky_nay`, `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`, `id_cong_ty`)
                    VALUES ('','$so_dh','$id_hd','$ma_vatt[$i]','$soluong_hd[$i]','$sl_knay[$i]','$thoi_gian_giao','$don_gia[$i]',
                    '$ttr_vat[$i]','$thue_vat_vt[$i]','$tts_vat[$i]','$dia_chi_g[$i]','$com_id')");
    }

    $noi_dung = 'Bạn đã cập nhật đơn hàng bán vật tư: ĐH-' . $so_dh;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung')");
} else {
    echo "Bạn cập nhật không thành công phiếu đơn hàng mua, vui lòng thử lại!";
}
