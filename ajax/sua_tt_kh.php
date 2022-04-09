<?
include("config.php");
$com_id  = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$role = getValue('role', 'int', 'POST', '');

$id = getValue('id', 'int', 'POST', '');
$ten_kh = $_POST['ten_kh'];
$ma_so_thue = $_POST['ma_so_thue'];
$ten_vt = $_POST['ten_vt'];
$ten_giao_dich = $_POST['ten_giao_dich'];
$dia_chi_dkkd = $_POST['dia_chi_dkkd'];
$so_dkkd = $_POST['so_dkkd'];
$dia_chi_lh = $_POST['dia_chi_lh'];
$fax = $_POST['fax'];
$website = $_POST['website'];
$email = $_POST['email'];
$so_dien_thoai = $_POST['so_dien_thoai'];

$id_tk = $_POST['id_tk'];
$cou1 = count($id_tk);

$ten_nh = $_POST['ten_nh'];
$cou2 = count($ten_nh);

$ten_ch_nh = $_POST['chi_nhanh'];
$cou3 = count($ten_ch_nh);

$so_tai_khoan = $_POST['so_tk'];
$cou4 = count($so_tai_khoan);

$chu_tk = $_POST['chu_tk'];


// them ngan hang
$ten_nh_moi = $_POST['ten_nh_moi'];
$co1 = count($ten_nh_moi);

$ten_ch_moi = $_POST['ten_ch_moi'];
$co2 = count($ten_ch_moi);

$so_tk_moi = $_POST['so_tk_moi'];
$co3 = count($so_tk_moi);

$chu_tk_moi = $_POST['chu_tk_moi'];


$noi_dung = "Bạn đã sửa thông tin khách hàng: " . $id . " - " . $ten_kh;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if($com_id != "" && $id != "" && $user_id != ""){
    if($cou1 > 0 && $co1 == 0){
        if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4) {
            echo "Điền đầy đủ thông tin tài khoản";
        } else {
            $sua_kh = new db_query("UPDATE `nha_cc_kh` SET `ten_vt`='$ten_vt',`ten_nha_cc_kh`='$ten_kh',`ma_so_thue`='$ma_so_thue',`ten_giao_dich`='$ten_giao_dich',
                        `dia_chi_dkkd`='$dia_chi_dkkd',`so_dkkd`='$so_dkkd',`dia_chi_lh`='$dia_chi_lh',`fax`='$fax',`so_dien_thoai`='$so_dien_thoai',`website`='$website',
                        `email`='$email',`ngay_sua`='$ngay_tao' WHERE `phan_loai` = 2 AND `id` = '$id' AND `id_cong_ty` = $com_id ");

            for ($j = 0; $j < $cou1; $j++) {
                $nh_kh = new db_query("UPDATE `tai_khoan` SET `id_nha_cc_kh`='$id',`ten_ngan_hang`='$ten_nh[$j]',`ten_chi_nhanh`='$ten_ch_nh[$j]',`so_tk`='$so_tai_khoan[$j]',`chu_tk`='$chu_tk[$j]'
                                WHERE `id` = '$id_tk[$j]' ");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung')");
        }

    }else if($cou1 == 0 && $co1 > 0){
        if ($co1 != $co2 || $co2 != $co3) {
            echo "Điền đầy đủ thông tin tài khoản";
        } else {
            $sua_kh = new db_query("UPDATE `nha_cc_kh` SET `ten_vt`='$ten_vt',`ten_nha_cc_kh`='$ten_kh',`ma_so_thue`='$ma_so_thue',`ten_giao_dich`='$ten_giao_dich',
                        `dia_chi_dkkd`='$dia_chi_dkkd',`so_dkkd`='$so_dkkd',`dia_chi_lh`='$dia_chi_lh',`fax`='$fax',`so_dien_thoai`='$so_dien_thoai',`website`='$website',
                        `email`='$email',`ngay_sua`='$ngay_tao' WHERE `phan_loai` = 2 AND `id` = '$id' AND `id_cong_ty` = $com_id ");

            for ($i = 0; $i < $co1; $i++) {
                $moi_nh = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                VALUES ('','$id','$ten_nh_moi[$i]','$ten_ch_moi[$i]','$so_tk_moi[$i]','$chu_tk_moi[$i]')");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung')");
        }
    }else if($cou1 > 0 && $co1 > 0){
        if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4 || $co1 != $co2 || $co2 != $co3) {
            echo "Điền đầy đủ thông tin tài khoản";
        } else if($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $co1 == $co2 && $co2 == $co3) {
            $sua_kh = new db_query("UPDATE `nha_cc_kh` SET `ten_vt`='$ten_vt',`ten_nha_cc_kh`='$ten_kh',`ma_so_thue`='$ma_so_thue',`ten_giao_dich`='$ten_giao_dich',
                        `dia_chi_dkkd`='$dia_chi_dkkd',`so_dkkd`='$so_dkkd',`dia_chi_lh`='$dia_chi_lh',`fax`='$fax',`so_dien_thoai`='$so_dien_thoai',`website`='$website',
                        `email`='$email',`ngay_sua`='$ngay_tao' WHERE `phan_loai` = 2 AND `id` = '$id' AND `id_cong_ty` = $com_id ");

            for ($j = 0; $j < $cou1; $j++) {
                $nh_kh = new db_query("UPDATE `tai_khoan` SET `id_nha_cc_kh`='$id',`ten_ngan_hang`='$ten_nh[$j]',`ten_chi_nhanh`='$ten_ch_nh[$j]',`so_tk`='$so_tai_khoan[$j]',`chu_tk`='$chu_tk[$j]'
                                WHERE `id` = '$id_tk[$j]' ");
            };

            for ($i = 0; $i < $co1; $i++) {
                $moi_nh = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                VALUES ('','$id','$ten_nh_moi[$i]','$ten_ch_moi[$i]','$so_tk_moi[$i]','$chu_tk_moi[$i]')");
            };

            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung')");
        }
    }
}else{
    echo "Cập nhật thông tin khách hàng không thành công";
}