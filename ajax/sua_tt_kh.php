<?
include("config.php");

$id = $_POST['id'];
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
$date = $_POST['date'];
$so_dien_thoai = $_POST['so_dien_thoai'];


$ten_ch_nh = $_POST['chi_nhanh'];
$ten_ch_nh = str_replace('_', ',', $ten_ch_nh);
$ten_ch_nh = rtrim($ten_ch_nh, ',');
$ten_ch_nh = explode(',', $ten_ch_nh);

$so_tai_khoan = $_POST['so_tk'];
$so_tai_khoan = str_replace('_', ',', $so_tai_khoan);
$so_tai_khoan = rtrim($so_tai_khoan, ',');
$so_tai_khoan = explode(',', $so_tai_khoan);

$chu_tk = $_POST['chu_tk'];
$chu_tk = str_replace('_', ',', $chu_tk);
$chu_tk = rtrim($chu_tk, ',');
$chu_tk = explode(',', $chu_tk);


$id_tk = $_POST['id_tk'];

$ten_nh = $_POST['ten_nh'];
$ten_nh = str_replace('_', ',', $ten_nh);
$ten_nh = rtrim($ten_nh, ',');
$ten_nh = explode(',', $ten_nh);

// them ngan hang
$ten_nh_moi = $_POST['ten_nh_moi'];

$ten_ch_moi = $_POST['ten_ch_moi'];
$ten_ch_moi = str_replace('_', ',', $ten_ch_moi);
$ten_ch_moi = rtrim($ten_ch_moi, ',');
$ten_ch_moi = explode(',', $ten_ch_moi);

$so_tk_moi = $_POST['so_tk_moi'];
$so_tk_moi = str_replace('_', ',', $so_tk_moi);
$so_tk_moi = rtrim($so_tk_moi, ',');
$so_tk_moi = explode(',', $so_tk_moi);

$chu_tk_moi = $_POST['chu_tk_moi'];
$chu_tk_moi = str_replace('_', ',', $chu_tk_moi);
$chu_tk_moi = rtrim($chu_tk_moi, ',');
$chu_tk_moi = explode(',', $chu_tk_moi);

$sua_kh = new db_query("UPDATE `nha_cc_kh` SET `ten_vt`='$ten_vt',`ten_nha_cc_kh`='$ten_kh',`ma_so_thue`='$ma_so_thue',`ten_giao_dich`='$ten_giao_dich',
                        `dia_chi_dkkd`='$dia_chi_dkkd',`so_dkkd`='$so_dkkd',`dia_chi_lh`='$dia_chi_lh',`fax`='$fax',`so_dien_thoai`='$so_dien_thoai',`website`='$website',
                        `email`='$email',`ngay_sua`='$date' WHERE `phan_loai` = 2 AND `id` = '$id' ");

if($id_tk != '_' && $id_tk != ""){
    $id_tk = str_replace('_', ',', $id_tk);
    $id_tk = rtrim($id_tk, ',');
    $id_tk = explode(',', $id_tk);
    $count = count($id_tk);

    for($j = 0; $j < $count; $j++){
        $nh_kh = new db_query("UPDATE `tai_khoan` SET `id_nha_cc_kh`='$id',`ten_ngan_hang`='$ten_nh[$j]',`ten_chi_nhanh`='$ten_ch_nh[$j]',`so_tk`='$so_tai_khoan[$j]',`chu_tk`='$chu_tk[$j]'
                                WHERE `id` = '$id_tk[$j]' ");
    }
}

if($ten_nh_moi != '_' && $ten_nh_moi != ""){
    $ten_nh_moi = str_replace('_', ',', $ten_nh_moi);
    $ten_nh_moi = rtrim($ten_nh_moi, ',');
    $ten_nh_moi = explode(',', $ten_nh_moi);
    $co1 = count($ten_nh_moi);

    for($i = 0; $i < $co1; $i++){
        $moi_nh = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                VALUES ('','$id','$ten_nh_moi[$i]','$ten_ch_moi[$i]','$so_tk_moi[$i]','$chu_tk_moi[$i]')");
    }
}

if(isset($sua_kh) && (isset($nh_kh) || isset($moi_nh)) ){
    echo "";
}else{
    echo "Cập nhật thông tin khách hàng không thành công";
}

?>