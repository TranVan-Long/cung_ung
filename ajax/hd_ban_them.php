<?
include("config.php");

$user_id =  getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$role = getValue('role', 'int', 'POST', '');
$ngay_ky_hd = strtotime($_POST['ngay_ky_hd']);
$id_khach_hang = getValue('id_khach_hang', 'int', 'POST', '');
$hd_nguyen_tac = $_POST['hd_nguyen_tac'];
$truoc_vat = $_POST['truoc_vat'];

$don_gia_vat = getValue('don_gia_vat', 'int', 'POST', '');

$thue_vat = getValue('thue_vat', 'int', 'POST', '');

$sau_vat = $_POST['sau_vat'];

if($_POST['ngay_bat_dau'] != ""){
    $ngay_bat_dau = strtotime($_POST['ngay_bat_dau']);
}else{
    $ngay_bat_dau = 0;
}

if($_POST['ngay_ket_thuc'] != ""){
    $ngay_ket_thuc = strtotime($_POST['ngay_ket_thuc']);
}else{
    $ngay_ket_thuc = 0;
}

$bao_gom_van_chuyen = $_POST['bao_gom_van_chuyen'];
$yc_tiendo = $_POST['yc_tiendo'];
$yc_tiendo = sql_injection_rp($yc_tiendo);

$noi_dung_hd = $_POST['noi_dung_hd'];
$noi_dung_hd = sql_injection_rp($noi_dung_hd);

$noi_dung_luu_y = $_POST['noi_dung_luu_y'];
$noi_dung_luu_y = sql_injection_rp($noi_dung_luu_y);

$dieu_khoan_tt = $_POST['dieu_khoan_tt'];
$dieu_khoan_tt = sql_injection_rp($dieu_khoan_tt);

$ten_nh = $_POST['ten_nh'];
$ten_nh = sql_injection_rp($ten_nh);

$so_taik = $_POST['so_taik'];
$phan_loai = 2;
$trang_thai = 1;

$vt_vat_tu = $_POST['vt_vat_tu'];
$count = count($vt_vat_tu);

$vt_so_luong = $_POST['vt_so_luong'];
$count2 = count($vt_so_luong);

$vt_don_gia = $_POST['vt_don_gia'];
$vt_truoc_vat = $_POST['vt_truoc_vat'];
$vt_vat_tax = $_POST['vt_vat_tax'];
$vt_sau_vat = $_POST['vt_sau_vat'];

$ngay_tao = strtotime(date('Y-m-d', time()));
if ($ngay_ky_hd != "" && $id_khach_hang != "") {
    if ($count > 0 && $count == $count2) {
        $them_hd_ban = new db_query("INSERT INTO `hop_dong` (`id`, `ngay_ky_hd`, `id_nha_cc_kh`, `hd_nguyen_tac`, `gia_tri_trvat`, `bao_gom_vat`,
    `thue_vat`, `gia_tri_svat`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `bgom_vchuyen`, `yc_tien_do`,`noi_dung_hd`, `noi_dung_luu_y`,
    `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`,`phan_loai`, `trang_thai`,`ngay_tao`,`quyen_nlap`,`nguoi_lap`, `id_cong_ty`) VALUES (NULL, '$ngay_ky_hd', '$id_khach_hang',
    '$hd_nguyen_tac', '$truoc_vat', '$don_gia_vat', '$thue_vat', '$sau_vat', '$ngay_bat_dau', '$ngay_ket_thuc', '$bao_gom_van_chuyen',
    '$yc_tiendo', '$noi_dung_hd', '$noi_dung_luu_y', '$dieu_khoan_tt', '$ten_nh', '$so_taik', '$phan_loai','$trang_thai','$ngay_tao','$role','$user_id', '$com_id')");

        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS hd_id"))->result);
        $id_hd = $row['hd_id'];

        for ($i = 0; $i < $count; $i++) {
            $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_dh` (`id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`,
                                    `thue_vat`, `tien_svat`) VALUES (NULL, '$vt_vat_tu[$i]', '$id_hd', '$vt_so_luong[$i]', '$vt_don_gia[$i]', '$vt_truoc_vat[$i]',
                                    '$vt_vat_tax[$i]', '$vt_sau_vat[$i]')");
        }

        $noi_dung = 'B???n ???? th??m h???p ?????ng b??n v???t t??: H?? - ' . $id_hd;

        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                          VALUES('', '$user_id','$role','$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
    } else {
        echo "??i???n ?????y ????? th??ng tin v???t t?? v?? s??? l?????ng ph???i l???n h??n 0";
    }
} else {
    echo "Thao t??c th???t b???i vui l??ng th??? l???i!";
}
