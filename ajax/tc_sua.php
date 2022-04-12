<?
include("config.php");
$tc_id              = getValue('tc_id', 'int', 'POST', '');
$tieu_chi_danh_gia  = $_POST['tieu_chi_danh_gia'];

$id_gia_tri_old         = $_POST['id_gia_tri_old'];
$cou1 = count($id_gia_tri_old);
$ten_hien_thi_old       = $_POST['ten_hien_thi_old'];


$gia_tri            = $_POST['gia_tri'];
$co1 = count($gia_tri);
$ten_hien_thi       = $_POST['ten_hien_thi'];
$co2 = count($ten_hien_thi);

$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$kieu_gia_tri = getValue('kieu_gia_tri', 'int', 'POST', '');

$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($tieu_chi_danh_gia != "") {
    if ($kieu_gia_tri == 1 && $count1 = 1) {

        $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia' WHERE `id`= $tc_id AND `id_cong_ty` = $com_id ");

        $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                         VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");

    } elseif ($kieu_gia_tri == 2 && ($cou1 > 0 || $co1 > 0)) {
        if($co1 == 0 && $cou1 == 0){
            echo "Vui lòng thêm ít tiêu chí đánh giá.";
        }
        else if($cou1 > 0 && $co1 == 0){
            $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia' WHERE `id`= $tc_id AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou1; $i++) {
                $ds_gt = new db_query("UPDATE `ds_gia_tri_dg` SET `ten_gia_tri` = '$ten_hien_thi_old[$i]' WHERE `id` = $id_gia_tri_old[$i]");
            }

            $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                         VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }else if($cou1 == 0 && $co1 > 0){
            $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia' WHERE `id`= $tc_id AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $co1; $i++) {
                $gt_new = new db_query("INSERT INTO `ds_gia_tri_dg`(`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`)
                                        VALUES ('', '$tc_id', '$gia_tri[$i]', '$ten_hien_thi[$i]')");
            }

            $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                         VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }else if($cou1 > 0 && $co1 > 0){
            $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia' WHERE `id`= $tc_id AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $cou1; $i++) {
                $ds_gt = new db_query("UPDATE `ds_gia_tri_dg` SET `ten_gia_tri` = '$ten_hien_thi_old[$i]' WHERE `id` = $id_gia_tri_old[$i]");
            }

            for ($j = 0; $j < $co1; $j++) {
                $gt_new = new db_query("INSERT INTO `ds_gia_tri_dg`(`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`)
                                        VALUES ('', '$tc_id', '$gia_tri[$j]', '$ten_hien_thi[$j]')");
            }

            $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                         VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }
} else {
    echo "Bạn cập nhật tiêu chí đánh giá không thành công, vui lòng thử lại";
}
