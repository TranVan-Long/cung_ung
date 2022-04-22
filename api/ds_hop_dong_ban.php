<?
include("config.php");

$id_com = getValue('id_com', 'int', 'POST', '0');


if($id_com != 0){
    $qr_hd = "SELECT `id`,`noi_dung_hd`, `noi_dung_luu_y`, `gia_tri_svat`, `phan_loai`, `ngay_tao`, `nguoi_lap`, `quyen_nlap` FROM `hop_dong`
                            WHERE `id_cong_ty` = $id_com AND `phan_loai` = 2  ";
    $qr_hd1 = new db_query($qr_hd);
    $list_hd = $qr_hd1->result_array();
    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $id_com AND `phan_loai` = 2 ");
    $total = $qr_total->objectItems()->total;

    echo result_data($list_hd, null, $total);
} else {
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}
