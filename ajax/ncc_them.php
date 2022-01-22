<?
include("config.php");

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
$phan_loai          = 1;

$ten_ngan_hang      = $_POST['ten_ngan_hang'];
$ten_chi_nhanh      = $_POST['ten_chi_nhanh'];
$so_tk              = $_POST['so_tk'];
$chu_tk             = $_POST['chu_tk'];

$ten_nguoi_lh       = $_POST['ten_nguoi_lh'];

$chuc_vu            = $_POST['chuc_vu'];
$so_dien_thoai_lh   = $_POST['so_dien_thoai_lh'];
$email_lh           = $_POST['email_lh'];

$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));

$co1 = count($ten_ngan_hang);
$co2 = count($ten_nguoi_lh);

if ($ten_nha_cc_kh != "" && $co1 > 0 && $co2 > 0) {
    $them_ncc = new db_query("INSERT INTO `nha_cc_kh`(`id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `ten_giao_dich`, `dia_chi_dkkd`,
                    `so_dkkd`, `dia_chi_lh`, `fax`, `so_dien_thoai`, `website`, `email`, `sp_cung_ung`, `thong_tin_khac`, `phan_loai`, `ngay_tao`, `ngay_sua`)
                    VALUES ('','" . $ten_vt . "','" . $ten_nha_cc_kh . "','" . $ma_so_thue . "','" . $ten_giao_dich . "',
                    '" . $dia_chi_dkkd . "','" . $so_dkkd . "','" . $dia_chi_lh . "','" . $fax . "','" . $so_dien_thoai . "','" . $website . "','" . $email . "',
                    '" . $sp_cung_ung . "','" . $thong_tin_khac . "','" . $phan_loai . "','" . $ngay_tao . "','')");
    $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS kh_id"))->result);
    $id_ncc = $row['kh_id'];

    for ($j = 0; $j < count($ten_ngan_hang); $j++) {
        $tk_ncc = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc ','$ten_ngan_hang[$j]','$ten_chi_nhanh[$j]','$so_tk[$j]','$chu_tk[$j]')");
    }
    for ($i = 0; $i < count($ten_nguoi_lh); $i++) {
        $nguoi_lh = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`) 
                                VALUES ('', '$id_ncc ', '$ten_nguoi_lh[$i]', '$chuc_vu[$i]', '$so_dien_thoai_lh[$i]', '$email_lh[$i]')");
    }
} else {
    echo "fail!";
}
