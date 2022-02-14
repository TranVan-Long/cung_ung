<?
include("config.php");
$id_ncc_kh          = $_POST['id_ncc_kh'];
$ten_nha_cc_kh      = $_POST['ten_nha_cc_kh'];
$ten_vt             = $_POST['ten_vt'];
$ten_giao_dich      = $_POST['ten_giao_dich'];
$ma_so_thue         = $_POST['ma_so_thue'];
$dia_chi_dkkd       = $_POST['dia_chi_dkkd'];
$so_dkkd            = $_POST['so_dkkd'];
$dia_chi_lh         = $_POST['dia_chi_lh'];
$fax                = $_POST['fax'];
$so_dien_thoai      = $_POST['so_dien_thoai'];
$website            = $_POST['website'];
$email              = $_POST['email'];
$sp_cung_ung        = $_POST['sp_cung_ung'];
$thong_tin_khac     = $_POST['thong_tin_khac'];

//ngan hang cu
$id_ngan_hang_old       = $_POST['id_ngan_hang_old'];
$ten_ngan_hang_old      = $_POST['ten_ngan_hang_old'];
$ten_chi_nhanh_old      = $_POST['ten_chi_nhanh_old'];
$so_tk_old              = $_POST['so_tk_old'];
$chu_tk_old             = $_POST['chu_tk_old'];

//ngan hang moi
$ten_ngan_hang      = $_POST['ten_ngan_hang'];
$ten_chi_nhanh      = $_POST['ten_chi_nhanh'];
$so_tk              = $_POST['so_tk'];
$chu_tk             = $_POST['chu_tk'];

//nguoi lien he cu
$id_nguoi_lh_old   = $_POST['id_nguoi_lh_old'];
$ten_nguoi_lh_old       = $_POST['ten_nguoi_lh_old'];
$chuc_vu_old            = $_POST['chuc_vu_old'];
$so_dien_thoai_lh_old   = $_POST['so_dien_thoai_lh_old'];
$email_lh_old           = $_POST['email_lh_old'];

//nguoi lien he moi
$ten_nguoi_lh       = $_POST['ten_nguoi_lh'];
$chuc_vu            = $_POST['chuc_vu'];
$so_dien_thoai_lh   = $_POST['so_dien_thoai_lh'];
$email_lh           = $_POST['email_lh'];

$ep_id              = $_POST['ep_id'];

$ngay_sua = strtotime(date('Y-m-d H:i:s', time()));

// cap nhat nha cung cap 
$sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
`ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
`so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
`website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
`thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

//cap nhat ngan hang da ton tai
for ($j = 0; $j < count($ten_ngan_hang_old); $j++) {
    $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',`so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]'
    WHERE `id` = '$id_ngan_hang_old[$j]' ");
}

//cap nhat nguoi lien he da ton tai
for ($i = 0; $i < count($ten_nguoi_lh_old); $i++) {
    $nguoi_lh_old = new db_query("UPDATE `nguoi_lien_he` SET `ten_nguoi_lh`='$ten_nguoi_lh_old[$i]', `chuc_vu`='$chuc_vu_old[$i]', `so_dien_thoai`='$so_dien_thoai_lh_old[$i]', `email`='$email_lh_old[$i]'
    WHERE `id` = '$id_nguoi_lh_old[$i]' ");
}

//them ngan hang moi
if ($ten_ngan_hang != "") {
    for ($i = 0; $i < count($ten_ngan_hang); $i++) {
        $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$i]','$ten_chi_nhanh[$i]','$so_tk[$i]','$chu_tk[$i]')");
    }
}
//them nguoi lien he moi
if ($ten_nguoi_lh != "") {
    for ($i = 0; $i < count($ten_nguoi_lh); $i++) {
        $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`) 
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$i]', '$chuc_vu[$i]', '$so_dien_thoai_lh[$i]', '$email_lh[$i]')");
    }
}

//save log
$noi_dung = 'Bạn đã sửa nhà cung cấp: ' .$ten_nha_cc_kh. '. Mã: NCC-'.$id_ncc_kh;
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                    VALUES('', '$ep_id', '$ngay_sua', '$noi_dung')");

if ((isset($sua_ncc) && (isset($nguoi_lh_old)||isset($nguoi_lh_new))) && (isset($tk_ncc_old) || isset($tk_ncc_new))) {
    echo "";
} else {
    echo "fail!";
}
