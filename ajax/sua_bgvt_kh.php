<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_bg = getValue('id_bg', 'int', 'POST', '');
$id_kh = getValue('id_kh', 'int', 'POST', '');
$ngay_bd = strtotime($_POST['ngay_bd']);
$ngay_kt = strtotime($_POST['ngay_kt']);
$noi_dung_ph = $_POST['noi_dung_ph'];

$id_v = $_POST['id_v'];
$cou = count($id_v);

$id_vt = $_POST['id_vt'];
$cou1 = count($id_vt);

$so_luong = $_POST['so_luong'];
$cou2 = count($so_luong);

$don_gia = $_POST['don_gia'];
$cou3 = count($don_gia);

$new_id_vt = $_POST['new_id_vt'];
$co1 = count($new_id_vt);

$new_so_luong = $_POST['new_so_luong'];
$co2 = count($new_so_luong);

$new_don_gia = $_POST['new_don_gia'];
$co3 = count($new_don_gia);

$noi_dung_nk = "Bạn đã cập nhật phiếu báo giá khách hàng phiếu: BG - " . $id_bg;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($cou == 0 || ($cou == 0 && $co1 == 0)) {
    echo "Chọn vật tư báo giá";
} else if ($com_id != "" && $id_bg != "" && ($cou > 0 || $co1 > 0)) {
    if ($cou > 0 && $co1 == 0) {
        if ($cou != $cou1 || $cou1 != $cou2 || $cou2 != $cou3) {
            echo "Điền đầy đủ thông tin vật tư báo giá";
        } else if ($cou == $cou1 && $cou1 == $cou2 && $cou2 == $cou3) {
            $upda_bg = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_kh',`noi_dung_thu`='$noi_dung_ph',`ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt'
                                WHERE `id_cong_ty` = $com_id AND `id` = $id_bg ");

            for ($i = 0; $i < $cou; $i++) {
                $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$id_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]',`don_gia`='$don_gia[$i]'
                                        WHERE `id` = $id_v[$i] AND `id_yc_bg` = $id_bg ");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
        }
    } else if ($cou == 0 && $co1 > 0) {
        if ($co1 != $co2 || $co2 != $co3) {
            echo "Điền đầy đủ thông tin vật tư báo giá";
        } else if ($co1 == $co2 && $co2 == $co3) {
            $upda_bg = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_kh',`noi_dung_thu`='$noi_dung_ph',`ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt'
                                WHERE `id_cong_ty` = $com_id AND `id` = $id_bg ");

            for ($j = 0; $j < $co1; $j++) {
                $inser_vt = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`, `don_gia`)
                                        VALUES ('','$id_bg','$new_id_vt[$j]','$new_so_luong[$j]', '$new_don_gia[$j]')");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
        }
    } else if ($cou > 0 && $co1 > 0) {
        if ($cou != $cou1 || $cou1 != $cou2 || $cou2 != $cou3 || $co1 != $co2 || $co2 != $co3) {
            echo "Điền đầy đủ thông tin vật tư báo giá";
        } else if ($cou == $cou1 && $cou1 == $cou2 && $cou2 == $cou3 && $co1 == $co2 && $co2 == $co3) {
            $upda_bg = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_kh',`noi_dung_thu`='$noi_dung_ph',`ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt'
                                WHERE `id_cong_ty` = $com_id AND `id` = $id_bg ");

            for ($i = 0; $i < $cou; $i++) {
                $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$id_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]',`don_gia`='$don_gia[$i]'
                                        WHERE `id` = $id_v[$i] AND `id_yc_bg` = $id_bg ");
            };

            for ($j = 0; $j < $co1; $j++) {
                $inser_vt = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`, `don_gia`)
                                        VALUES ('','$id_bg','$new_id_vt[$j]','$new_so_luong[$j]', '$new_don_gia[$j]')");
            };


            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
        }
    }
} else {
    echo "Bạn cập nhật phiếu báo giá cho khách hàng không thành công, vui lòng thử lại!";
}
