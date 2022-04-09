<?
include("config.php");

$id_com = getValue('id_com','int','POST','0');

if($id_com != 0){
    $qr_ycvt = new db_query("SELECT `id`, `id_nguoi_yc`, `role`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`, `trang_thai`, `id_kho`,
                            `id_nguoi_duyet`, `phan_quyen_nduyet`, `ngay_duyet`, `ngay_tao`, `id_cong_ty` FROM `yeu_cau_vat_tu`
                            WHERE `trang_thai` = 2 AND `id_cong_ty` = $id_com ");
    $list_ycvt = $qr_ycvt -> result_array();
    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `trang_thai` = 2 AND `id_cong_ty` = $id_com ");
    $total = $qr_total -> objectItems() -> total;
    echo result_data($list_ycvt, null, $total);

}else{
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}


?>