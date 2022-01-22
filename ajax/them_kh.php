<?
include("config.php");

$ten_kh = $_POST['ten_kh'];
$ten_goi_tat = $_POST['ten_goi_tat'];
$ten_giao_dich = $_POST['ten_giao_dich'];
$ma_so_thue = $_POST['ma_so_thue'];
$dia_chi_dkkd = $_POST['dia_chi_dkkd'];
$so_dkkd = $_POST['so_dkkd'];
$dia_chi_lh = $_POST['dia_chi_lh'];
$fax = $_POST['fax'];
$so_dien_thoai = $_POST['so_dien_thoai'];
$website = $_POST['website'];
$email = $_POST['email'];

$ten_nh = $_POST['ten_nh'];


$ten_ch_nh = $_POST['ten_ch_nh'];
$ten_ch_nh = str_replace('_', ',', $ten_ch_nh);
$ten_ch_nh = rtrim($ten_ch_nh, ',');
$ten_ch_nh = explode(',', $ten_ch_nh);

$so_tai_khoan = $_POST['so_tai_khoan'];
$so_tai_khoan = str_replace('_', ',', $so_tai_khoan);
$so_tai_khoan = rtrim($so_tai_khoan, ',');
$so_tai_khoan = explode(',', $so_tai_khoan);

$chu_tk = $_POST['chu_tk'];
$chu_tk = str_replace('_', ',', $chu_tk);
$chu_tk = rtrim($chu_tk, ',');
$chu_tk = explode(',', $chu_tk);


$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));


$them_kh = new db_query("INSERT INTO `nha_cc_kh`(`id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `ten_giao_dich`, `dia_chi_dkkd`,
                    `so_dkkd`, `dia_chi_lh`, `fax`, `so_dien_thoai`, `website`, `email`, `sp_cung_ung`, `thong_tin_khac`, `phan_loai`, `ngay_tao`, `ngay_sua`)
                VALUES ('','".$ten_goi_tat."','".$ten_kh."','".$ma_so_thue."','".$ten_giao_dich."',
                '".$dia_chi_dkkd."','".$so_dkkd."','".$dia_chi_lh."','".$fax."','".$so_dien_thoai."','".$website."','".$email."',
                '','','2','".$ngay_tao."','')");
$row = new db_query("SELECT LAST_INSERT_ID() AS kh_id");
$row0 = mysql_fetch_assoc($row -> result);
$id_kh = $row0['kh_id'];

if($ten_nh != '_' && $ten_nh != ""){
    $ten_nh = str_replace('_', ',', $ten_nh);
    $ten_nh = rtrim($ten_nh, ',');
    $ten_nh = explode(',', $ten_nh);
    $count = count($ten_nh);

    for($j = 0; $j < $count; $j++){
        $nh_kh = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                VALUES ('','$id_kh','$ten_nh[$j]','$ten_ch_nh[$j]','$so_tai_khoan[$j]','$chu_tk[$j]')");
    }
}


if(isset($them_kh) && isset($nh_kh)){
    echo "";
}else{
    echo "Bạn thêm khách hàng không thành công";
}

?>