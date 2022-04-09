<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_bg = getValue('id_bg', 'int', 'POST', '');
$id_nha_cc = getValue('id_nha_cc', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');
$noi_dung = $_POST['noi_dung_thu'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$gui_mail = getValue('gui_mail', 'int', 'POST', '');

$gia_baog_vat = getValue('gia_baog_vat', 'int', 'POST', '');

$id_vatt = $_POST['id_vatt'];
$cou = count($id_vatt);

$ma_vt = $_POST['ma_vt'];
$cou1 = count($ma_vt);

$so_luong = $_POST['so_luong'];
$cou2 = count($so_luong);

$new_ma_vt = $_POST['new_ma_vt'];
$co1 = count($new_ma_vt);

$new_sl = $_POST['new_sl'];
$co2 = count($new_sl);

$noi_dung_thu = "Bạn đã sửa phiếu yêu cầu báo giá: BG - " . $id_bg;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($com_id != "" && $user_id != "" && $id_bg != "" && ($cou > 0 || $co1 > 0)) {
    if ($cou > 0 && $co1 == 0) {
        if ($cou != $cou1 || $cou1 != $cou2) {
            echo "Điền đầy đủ thông tin vật tư";
        } else if ($cou == $cou1 && $cou1 == $cou2) {
            $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou; $i++) {
                $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
        }
    } else if ($cou == 0 && $co1 > 0) {
        if ($co1 != $co2) {
            echo "Điền đầy đủ thông tin vật tư";
        } else if ($co1 == $co2) {
            $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

            for ($j = 0; $j < $co1; $j++) {
                $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
        }
    } else if ($cou > 0 && $co1 > 0) {
        if ($cou != $cou1 || $cou1 != $cou2 || $co1 != $co2) {
            echo "Điền đầy đủ thông tin vật tư";
        } else if ($cou == $cou1 && $cou1 == $cou2 && $co1 == $co2) {
            $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou; $i++) {
                $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
            };

            for ($j = 0; $j < $co1; $j++) {
                $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
        }
    }
} else {
    echo "Bạn sửa yêu cầu báo giá không thành công, vui lòng thử lại!";
}
