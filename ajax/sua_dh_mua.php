<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$nguoi_lh = getValue('nguoi_lh', 'int', 'POST', '');
$hop_dong = getValue('hop_dong', 'int', 'POST', '');
$id_dh = getValue('id_dh', 'int', 'POST', '');

if ($_POST['ngay_ky'] != "") {
    $ngay_ky = strtotime($_POST['ngay_ky']);
} else {
    $ngay_ky = 0;
}

if ($_POST['thoi_han'] != "") {
    $thoi_han = strtotime($_POST['thoi_han']);
} else {
    $thoi_han = 0;
}

$donv_nh = $_POST['donv_nh'];
$phong_ban = $_POST['phong_ban'];
$nguoi_nh = $_POST['nguoi_nh'];
$dient_nnhan = $_POST['dient_nnhan'];
$baoh_hd = $_POST['baoh_hd'];
$gia_tri = $_POST['gia_tri'];
$ghi_chu = $_POST['ghi_chu'];
$giatr_vat = $_POST['giatr_vat'];
$thue_vat = $_POST['thue_vat'];
$dgia_vat = $_POST['dgia_vat'];
$tien_ckhau = $_POST['tien_ckhau'];
$gias_vat = $_POST['gias_vat'];
$chi_phi_vc = $_POST['chi_phi_vc'];
$ghic_vc = $_POST['ghic_vc'];
$phan_loai = getValue('phan_loai', 'int', 'POST', '');

$id_vt_dc = $_POST['id_vt_dc'];
$co1 = count($id_vt_dc);
$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);
$so_luong_hd = $_POST['so_luong_hd'];
$so_luong_kn = $_POST['so_luong_kn'];
$thoi_gian_gh = $_POST['thoi_gian_gh'];
$don_gia = $_POST['don_gia'];
$ttr_vat = $_POST['ttr_vat'];
$thue_vat_vt = $_POST['thue_vat_vt'];
$tts_vat = $_POST['tts_vat'];
$dia_chi_g = $_POST['dia_chi_g'];


if ($com_id != "" && $id_dh != "" && $hop_dong != "") {

    $up_dh = new db_query("UPDATE `don_hang` SET `id_nha_cc_kh`='$id_ncc',`id_nguoi_lh`='$nguoi_lh',`id_hop_dong`='$hop_dong',
                        `ngay_ky`='$ngay_ky',`thoi_han`='$thoi_han',`don_vi_nhan_hang`='$donv_nh',`phong_ban`='$phong_ban',
                        `nguoi_nhan_hang`='$nguoi_nh',`dien_thoai_nn`='$dient_nnhan',`giu_lai_bao_hanh`='$baoh_hd',`gia_tri_tuong_duong`='$gia_tri',
                        `ghi_chu`='$ghi_chu',`gia_tri_don_hang`='$giatr_vat',`thue_vat`='$thue_vat',`gia_tri_svat`='$gias_vat',`bao_gom_vat`='$dgia_vat',
                        `chiet_khau`='$tien_ckhau',`chi_phi_vchuyen`='$chi_phi_vc',`ghi_chu_vchuyen`='$ghic_vc' WHERE `phan_loai` = 1
                        AND `id_cong_ty` = $com_id AND `id` = $id_dh ");

    $check_tt = new db_query("SELECT `id` FROM `don_hang` WHERE `id` = $id_dh AND `id_cong_ty` = $com_id AND `id_hop_dong` = $hop_dong ");
    if(mysql_num_rows($check_tt -> result) > 0){
        for($a = 0; $a < $co1; $a++){
            $tgian_giao_hang = strtotime($thoi_gian_gh[$a]);
            $upda_vtdh = new db_query("UPDATE `vat_tu_dh_mua_ban` SET `id_hd`='$hop_dong',`id_vat_tu`='$ma_vt[$a]',
                                    `so_luong_theo_hd`='$so_luong_hd[$a]',`so_luong_ky_nay`='$so_luong_kn[$a]',`thoi_gian_giao_hang`='$tgian_giao_hang',
                                    `don_gia`='$don_gia[$a]',`tong_tien_trvat`='$ttr_vat[$a]',`thue_vat`='$thue_vat_vt[$a]',`tong_tien_svat`='$tts_vat[$a]',
                                    `dia_diem_giao_hang`='$dia_chi_g[$a]' WHERE `id`='$id_vt_dc[$a]' AND `id_don_hang`='$id_dh' AND `id_cong_ty`='$com_id' ");
        }
    }else{
        $dele_dhc = new db_query("DELETE FROM `vat_tu_dh_mua_ban` WHERE `id_cong_ty` = $com_id AND `id_don_hang` = $id_dh ");

        for ($j = 0; $j < $cou; $j++) {
            $tgian_giao_hang = strtotime($thoi_gian_gh[$j]);
            $inser_vtdh = new db_query("INSERT INTO `vat_tu_dh_mua_ban`(`id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`,
                                    `so_luong_ky_nay`, `thoi_gian_giao_hang`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`,
                                    `id_cong_ty`) VALUES ('','$id_dh','$hop_dong','$ma_vt[$j]','$so_luong_hd[$j]','$so_luong_kn[$j]','$tgian_giao_hang',
                                    '$don_gia[$j]','$ttr_vat[$j]','$thue_vat_vt[$j]','$tts_vat[$j]','$dia_chi_g[$j]','$com_id')");
        }
    }

    $noi_dung = 'Bạn đã cập nhật đơn hàng mua vật tư: ĐH-' . $id_dh;
    $ngay_tao = strtotime(date('Y-m-d', time()));
    $gio_tao = strtotime(date('H:i:s', time()));
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`)
                            VALUES('','$user_id','$phan_loai','$ngay_tao','$gio_tao', '$noi_dung')");

} else {
    echo  "Bạn cập nhật đơn hàng không thành công, vui lòng thử lại!";
}
