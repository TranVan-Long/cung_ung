<?
include("config.php");

$id_com = getValue('com_id', 'int', 'POST', '0');
$phan_loai = getValue('phan_loai', 'int', 'POST', '0');

if($id_com != 0 && $phan_loai != 0){
    $qr_dh = new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`thoi_han`, d.`phong_ban`, d.`nguoi_nhan_hang`, d.`phan_loai`, n.`ten_nha_cc_kh`
                            FROM `don_hang` AS d
                            INNER JOIN `nha_cc_kh` AS n ON n.`id` = d.`id_nha_cc_kh`
                            WHERE d.`id_cong_ty` = $id_com AND d.`phan_loai` = $phan_loai ");
    $list_dh = $qr_dh -> result_array();

    $qr_total = new db_query("SELECT COUNT(`id`) AS total FROM `don_hang` WHERE `id_cong_ty` = $id_com AND `phan_loai` = $phan_loai ");
    $total = $qr_total -> objectItems() -> total;

    echo result_data($list_dh, null, $total);
}else{
    echo result_data(null, set_error(404, "Thông tin truyền lên không đầy đủ"));
}

?>