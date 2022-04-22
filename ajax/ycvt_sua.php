<?
include("config.php");

$id_ycvt =  getValue('id_ycvt', 'int', 'POST', '');
$ngay_ht = strtotime($_POST['ngay_ht']);

$dien_giai = $_POST['dien_giai'];
$dien_giai = sql_injection_rp($dien_giai);
$cong_trinh = getValue('cong_trinh', 'int', 'POST', '');

$id_vat_tu_old = $_POST['id_vat_tu_old'];
$cou = count($id_vat_tu_old);

$vat_tu_old = $_POST['vat_tu_old'];
$cou1 = count($vat_tu_old);

$so_luong_old = $_POST['so_luong_old'];
$cou2 = count($so_luong_old);

$vat_tu = $_POST['vat_tu'];
$cou3 = count($vat_tu);

$so_luong = $_POST['so_luong'];
$cou4 = count($so_luong);

//user id
$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');

$role = getValue('role', 'int', 'POST', '');
$date = strtotime(date('Y-m-d', time()));

$noi_dung = 'Bạn đã chỉnh sửa phiếu yêu cầu vật tư: YC-' . $id_ycvt;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if($id_ycvt != "" && $com_id != ""){
    if($cou == 0 && $cou3 == 0){
        echo "Thêm ít nhất 1 vật tư";
    }else if($cou > 0 && $cou3 == 0){
        if($cou != $cou1 || $cou1 != $cou2){
            echo "Điền đầy đủ thông tin vật tư và số lượng duyệt phải lớn hơn 0";
        }else if($cou == $cou1 && $cou1 == $cou2){
            $sua_ycvt = new db_query("UPDATE `yeu_cau_vat_tu` SET `ngay_ht_yc` = $ngay_ht, `dien_giai` = '$dien_giai', `ngay_chinh_sua`= $date, `id_cong_trinh` = '$cong_trinh'
                            WHERE `id` = $id_ycvt AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou; $i++) {
                $sua_vt_old = new db_query("UPDATE `chi_tiet_yc_vt` SET `id_vat_tu` = $vat_tu_old[$i],`so_luong_yc_duyet` = $so_luong_old[$i] WHERE `id` = $id_vat_tu_old[$i]");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                        VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }else if($cou == 0 && $cou3 > 0){
        if($cou3 != $cou4){
            echo "Điền đầy đủ thông tin vật tư và số lượng duyệt phải lớn hơn 0";
        }else if($cou3 == $cou4){
            $sua_ycvt = new db_query("UPDATE `yeu_cau_vat_tu` SET `ngay_ht_yc` = $ngay_ht, `dien_giai` = '$dien_giai', `ngay_chinh_sua`= $date, `id_cong_trinh` = '$cong_trinh'
                            WHERE `id` = $id_ycvt AND `id_cong_ty` = $com_id ");

            for ($j = 0; $j < $cou3; $j++) {
                $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet`) VALUES (NULL, $id_ycvt, $vat_tu[$j], $so_luong[$j], '0')");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                        VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($cou > 0 && $cou3 > 0){
        if($cou != $cou1 || $cou1 != $cou2 || $cou3 != $cou4){
            echo "Điền đầy đủ thông tin vật tư và số lượng duyệt phải lớn hơn 0";
        }else if($cou == $cou1 && $cou1 == $cou2 && $cou3 == $cou4){
            $sua_ycvt = new db_query("UPDATE `yeu_cau_vat_tu` SET `ngay_ht_yc` = $ngay_ht, `dien_giai` = '$dien_giai', `ngay_chinh_sua`= $date, `id_cong_trinh` = '$cong_trinh'
                            WHERE `id` = $id_ycvt AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou; $i++) {
                $sua_vt_old = new db_query("UPDATE `chi_tiet_yc_vt` SET `id_vat_tu` = $vat_tu_old[$i],`so_luong_yc_duyet` = $so_luong_old[$i] WHERE `id` = $id_vat_tu_old[$i]");
            }

            for ($j = 0; $j < $cou3; $j++) {
                $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`, `so_luong_duyet`) VALUES (NULL, $id_ycvt, $vat_tu[$j], $so_luong[$j], '0')");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                        VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }
} else {
    echo "Bạn cập nhật phiếu yêu cầu vật tư thất bại, vui lòng thử lại!";
}
