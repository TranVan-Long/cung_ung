<?
include("config.php");

$id_com = getValue('id_com', 'int', 'POST', '0');

if($id_com != 0){
    $qr_hd = new db_query("SELECT `id`, `id_nha_cc_kh`, `hd_nguyen_tac`, `ngay_ky_hd`, `id_du_an_ctrinh`, `thue_noi_bo`, `hinh_thuc_hd`,
                        `bao_gom_vat`, `tien_chiet_khau`, `giu_lai_bhanh`, `gia_tri_bhanh`, `bao_lanh_hd`, `gia_tri_blanh`, `thoi_han_blanh`,
                        `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `han_muc_tin_dung`, `bgom_vchuyen`, `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`,
                        `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`, `id_bao_gia`, `thoa_tuan_hoa_don`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`,
                        `phan_loai`,  `ngay_tao`, `id_cong_ty` FROM `hop_dong` WHERE `id_cong_ty` = $id_com ");
    $list_hd = $qr_hd->result_array();
    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $id_com ");
    $total = $qr_total->objectItems()->total;

    echo result_data($list_hd, null, $total);
} else {
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}

?>