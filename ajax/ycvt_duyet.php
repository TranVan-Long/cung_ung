<?
include('config.php');
$ycvt_id = getValue('ycvt_id', 'int', 'POST', '');
$id_kho = getValue('id_kho', 'int', 'POST', '');
$nguoi_duyet = getValue('nguoi_duyet', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nduyet = getValue('phan_quyen_nduyet', 'int', 'POST', '');
$id_vat_tu = $_POST['id_vat_tu'];
$cou1 = count($id_vat_tu);

$so_luong_duyet = $_POST['so_luong_duyet'];
$cou = count($so_luong_duyet);

$date = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($ycvt_id != "" && $com_id != "" && $id_kho != "" ) {
    if($cou == 0 || $cou1 != $cou){
        echo "Điền đầy đủ thông tin cột số lượng duyệt";
    }else if($cou > 0 && $cou == $cou1){
        $duyet_yeu_cau = new db_query("UPDATE `yeu_cau_vat_tu` SET `id_kho` = $id_kho, `trang_thai` = 2, `id_nguoi_duyet` = $nguoi_duyet, `phan_quyen_nduyet` = $phan_quyen_nduyet,
                                    `ngay_duyet` = $date WHERE `id` = $ycvt_id AND `id_cong_ty` = $com_id ");

        for ($i = 0; $i < $cou1; $i++) {
            $duyet_vat_tu = new db_query("UPDATE `chi_tiet_yc_vt` SET `so_luong_duyet` = $so_luong_duyet[$i] WHERE `id` = $id_vat_tu[$i]");
        }
        //save log
        $noi_dung = 'Bạn đã duyệt yêu cầu vật tư: YC - ' . $ycvt_id;

        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                        VALUES('', '$user_id', '$phan_quyen_nduyet', '$date','$gio_tao', '$noi_dung')");
    }
} else {
    echo "Duyệt phiếu yêu cầu vật tư không thành công, vui lòng thử lại!";
}
