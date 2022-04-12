<?
include("config.php");

$id_dg = getValue('id_dg', 'int', 'POST', '');
$id_nhacc = getValue('nha_cc', 'int', 'POST', '');
$dg_khac = $_POST['dg_khac'];
$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

// sua danh gia
$id = $_POST['id'];
$cou1 = count($id);

$id_tc = $_POST['id_tc'];
$cou2 = count($id_tc);

$diem_dg = $_POST['diem_dg'];
$cou3 = count($diem_dg);

$tongdiem = $_POST['tongdiem'];
$cou4 = count($tongdiem);

$th_d = $_POST['th_d'];
$cou5 = count($th_d);

$dg_ctiet = $_POST['dg_ctiet'];

// them moi danh gia nha cung cap
$new_tc = $_POST['new_tc'];
$co1 = count($new_tc);

$new_dg = $_POST['new_dg'];
$co2 = count($new_dg);

$new_tongd = $_POST['new_tongd'];
$co3 = count($new_tongd);

$new_thd = $_POST['new_thd'];
$co4 = count($new_thd);

$new_dgct = $_POST['new_dgct'];
$tong_diem = $_POST['tong_diem'];

$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$noi_dung_nk = "Bạn đã cập nhật phiếu đánh giá nhà cung cấp: PH - " . $id_dg;

if ($com_id != "" && $user_id != "" && $id_dg != "" && $id_nhacc != "" ) {
    if ($cou1 > 0 && $co1 == 0) {
        if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4 || $cou4 != $cou5) {
            echo "Điền đầy đủ thông tin tiêu chí đánh giá ";
        } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $cou4 == $cou5) {
            $up_dg = new db_query("UPDATE `danh_gia` SET `id_nha_cc`= '$id_nhacc', `danh_gia_khac`='$dg_khac', `tong_diem` = $tong_diem
                                    WHERE `id` = $id_dg AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou1; $i++) {
                $up_dg = new db_query("UPDATE `chi_tiet_danh_gia` SET `id_tieu_chi`='$id_tc[$i]',`diem_danh_gia`='$diem_dg[$i]',
                                    `tong_diem_danh_gia`='$tongdiem[$i]', `thang_diem`='$th_d[$i]', `danh_gia_chi_tiet`='$dg_ctiet[$i]'
                                    WHERE `id` = $id[$i] ");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                                VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_nk','$com_id')");
        }
    } else if ($cou1 == 0 && $co1 > 0) {
        if ($co1 != $co2 || $co2 != $co3 || $co3 != $co4) {
            echo "Điền đầy đủ thông tin tiêu chí đánh giá ";
        } else if ($co1 == $co2 && $co2 == $co3 && $co3 == $co4) {
            $up_dg = new db_query("UPDATE `danh_gia` SET `id_nha_cc`='$id_nhacc',`danh_gia_khac`='$dg_khac', `tong_diem` = $tong_diem
                                    WHERE `id` = $id_dg AND `id_cong_ty` = $com_id ");

            for ($j = 0; $j < $co1; $j++) {
                $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`, `thang_diem`,
                                    `danh_gia_chi_tiet`) VALUES ('','$id_dg','$new_tc[$j]','$new_dg[$j]','$new_tongd[$j]','$new_thd[$j]','$new_dgct[$j]')");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                                VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_nk','$com_id')");
        }
    } else if ($cou1 > 0 && $co1 > 0) {
        if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4 || $cou4 != $cou5 || $co1 != $co2 || $co2 != $co3 || $co3 != $co4) {
            echo "Điền đầy đủ thông tin tiêu chí đánh giá ";
        } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $cou4 == $cou5 && $co1 == $co2 && $co2 == $co3 && $co3 == $co4) {
            $up_dg = new db_query("UPDATE `danh_gia` SET `id_nha_cc`='$id_nhacc',`danh_gia_khac`='$dg_khac', `tong_diem` = $tong_diem WHERE `id` = $id_dg AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou1; $i++) {
                $up_dg = new db_query("UPDATE `chi_tiet_danh_gia` SET `id_tieu_chi`='$id_tc[$i]',`diem_danh_gia`='$diem_dg[$i]',
                                    `tong_diem_danh_gia`='$tongdiem[$i]', `thang_diem`='$th_d[$i]', `danh_gia_chi_tiet`='$dg_ctiet[$i]' WHERE `id` = $id[$i] ");
            };

            for ($j = 0; $j < $co1; $j++) {
                $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`, `thang_diem`,
                                    `danh_gia_chi_tiet`) VALUES ('','$id_dg','$new_tc[$j]','$new_dg[$j]','$new_tongd[$j]','$new_thd[$j]','$new_dgct[$j]')");
            }

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`, `id_cong_ty`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao', '$gio_tao', '$noi_dung_nk', '$com_id')");
        }
    }
} else {
    echo "Bạn sửa đánh giá nhà cung cấp không thành công, vui lòng thử lại!";
}
