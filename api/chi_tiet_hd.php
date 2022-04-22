<?
include("config.php");

$id_com = getValue('id_com', 'int', 'POST', '0');
$id_hd = getValue('id_hd', 'int', 'POST', '0');

if($id_com != 0 && $id_hd != 0 && $id_hd != "" && $id_com != ""){
    $qr_hd = "SELECT h.`id`, h.`id_nha_cc_kh`, h.`hd_nguyen_tac`, h.`ngay_ky_hd`, h.`id_du_an_ctrinh`, h.`thue_noi_bo`, h.`hinh_thuc_hd`,
                h.`bao_gom_vat`, h.`tien_chiet_khau`, h.`giu_lai_bhanh`, h.`gia_tri_bhanh`, h.`bao_lanh_hd`, h.`gia_tri_blanh`, h.`thoi_han_blanh`,
                h.`tg_bd_thuc_hien`, h.`tg_kt_thuc_hien`, h.`han_muc_tin_dung`, h.`bgom_vchuyen`, h.`yc_tien_do`, h.`noi_dung_hd`, h.`noi_dung_luu_y`,
                h.`dieu_khoan_tt`, h.`ten_ngan_hang`, h.`so_tk`, h.`id_bao_gia`, h.`thoa_tuan_hoa_don`, h.`gia_tri_trvat`, h.`thue_vat`, h.`gia_tri_svat`,
                h.`phan_loai`, h.`ngay_tao`, h.`nguoi_lap`, h.`quyen_nlap`, n.`ten_nha_cc_kh`
                FROM `hop_dong`AS h INNER JOIN `nha_cc_kh` AS n ON h.`id_nha_cc_kh` = n.`id`
                WHERE h.`id_cong_ty` = $id_com AND h.`id` = $id_hd ";
    $qr_hd1 = new db_query($qr_hd);
    $list_hd = $qr_hd1->result_array();
    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $id_com AND `id` = $id_hd ");
    $total = $qr_total->objectItems()->total;

    echo result_data($list_hd, null, $total);
} else {
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}
