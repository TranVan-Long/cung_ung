<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$role = getValue('role', 'int', 'POST', '');

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

$cou1 = count($ten_nh);

$ten_ch_nh = $_POST['ten_ch_nh'];

$cou2 = count($ten_ch_nh);

$so_tai_khoan = $_POST['so_tai_khoan'];

$cou3 = count($so_tai_khoan);

$chu_tk = $_POST['chu_tk'];


$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if($ten_kh != "" && $com_id != "" && $user_id != "" && $cou1 > 0){
    if($cou1 != $cou2 || $cou2 != $cou3){
        echo "Điền đầy đủ thông tin tài khoản";
    }else{
        $them_kh = new db_query("INSERT INTO `nha_cc_kh`(`id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `ten_giao_dich`, `dia_chi_dkkd`,
                        `so_dkkd`, `dia_chi_lh`, `fax`, `so_dien_thoai`, `website`, `email`, `sp_cung_ung`, `thong_tin_khac`, `phan_loai`, `ngay_tao`, `ngay_sua`, `id_cong_ty`)
                    VALUES ('','" . $ten_goi_tat . "','" . $ten_kh . "','" . $ma_so_thue . "','" . $ten_giao_dich . "',
                    '" . $dia_chi_dkkd . "','" . $so_dkkd . "','" . $dia_chi_lh . "','" . $fax . "','" . $so_dien_thoai . "','" . $website . "','" . $email . "',
                    '','','2','" . $ngay_tao . "','','$com_id')");
        $row = new db_query("SELECT LAST_INSERT_ID() AS kh_id");
        $row0 = mysql_fetch_assoc($row->result);
        $id_kh = $row0['kh_id'];

        for ($j = 0; $j < $count; $j++) {
            $nh_kh = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                VALUES ('','$id_kh','$ten_nh[$j]','$ten_ch_nh[$j]','$so_tai_khoan[$j]','$chu_tk[$j]')");
        };

        $noi_dung_nk = "Bạn đã thêm khách hàng: ".$id_kh." - ".$ten_kh;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
    }

}else{
    echo "Bạn thêm khách hàng không thành công";
}

?>