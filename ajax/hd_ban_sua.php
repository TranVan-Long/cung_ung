<?
include("config.php");

$user_id  = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$hd_id  = getValue('hd_id', 'int', 'POST', '');
$role  = getValue('role', 'int', 'POST', '');

$ngay_ky_hd = strtotime($_POST['ngay_ky_hd']);
$id_khach_hang = getValue('id_khach_hang', 'int', 'POST', '');
$hd_nguyen_tac = getValue('hd_nguyen_tac', 'int', 'POST', '');
$truoc_vat = $_POST['truoc_vat'];
$don_gia_vat = $_POST['don_gia_vat'];
$thue_vat = $_POST['thue_vat'];
$sau_vat = $_POST['sau_vat'];
$ngay_bat_dau = strtotime($_POST['ngay_bat_dau']);
$ngay_ket_thuc = strtotime($_POST['ngay_ket_thuc']);
$bao_gom_van_chuyen = $_POST['bao_gom_van_chuyen'];
$yc_tiendo = $_POST['yc_tiendo'];
$noi_dung_hd = $_POST['noi_dung_hd'];
$noi_dung_luu_y = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt = $_POST['dieu_khoan_tt'];
$ten_nh = $_POST['ten_nh'];
$so_taik = $_POST['so_taik'];
$phan_loai = 3;
$trang_thai = 1;

$vt_id_vat_tu_old = $_POST['vt_id_vat_tu_old'];
$vt_vat_tu_old = $_POST['vt_vat_tu_old'];
$vt_so_luong_old = $_POST['vt_so_luong_old'];
$vt_don_gia_old = $_POST['vt_don_gia_old'];
$vt_tien_tvat_old = $_POST['vt_tien_tvat_old'];
$vt_thue_vat_old = $_POST['vt_thue_vat_old'];
$vt_tien_svat_old = $_POST['vt_tien_svat_old'];

$count_vt_o = count($vt_vat_tu_old);
$count_vt_o_2 = count($vt_so_luong_old);


$vt_vat_tu = $_POST['vt_vat_tu'];
$vt_so_luong  = $_POST['vt_so_luong'];
$vt_don_gia = $_POST['vt_don_gia'];
$vt_tien_tvat = $_POST['vt_tien_tvat'];
$vt_thue_vat = $_POST['vt_thue_vat'];
$vt_tien_svat = $_POST['vt_tien_svat'];

$count_vt = count($vt_vat_tu);
$count_vt_2 = count($vt_so_luong);

$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($id_khach_hang != "" && ($count_vt_o > 0  || $count_vt > 0)) {
    if (($count_vt_o != $count_vt_o_2) || ($count_vt != $count_vt_2)) {
        echo "Điền đầy đủ thông tin vật tư.";
    } else {
        $sua_hd_ban_vc = new db_query("UPDATE `hop_dong` SET `ngay_ky_hd` = '$ngay_ky_hd', `id_nha_cc_kh` = '$id_khach_hang',`hd_nguyen_tac` = '$hd_nguyen_tac', `gia_tri_trvat` = '$truoc_vat', `bao_gom_vat` = '$don_gia_vat', `thue_vat` = '$thue_vat', `gia_tri_svat` = '$sau_vat', `tg_bd_thuc_hien` = '$ngay_bat_dau', `tg_kt_thuc_hien` = '$ngay_ket_thuc', `bgom_vchuyen` = '$bao_gom_van_chuyen',`yc_tien_do` = '$yc_tiendo',`noi_dung_hd` = '$noi_dung_hd', `noi_dung_luu_y` = '$noi_dung_luu_y', `dieu_khoan_tt` = '$dieu_khoan_tt', `ten_ngan_hang` = '$ten_nh', `so_tk` = '$so_taik' WHERE `id` = '$hd_id'");

        for ($i = 0; $i < count($vt_id_vat_tu_old); $i++) {
            $sua_vt_hd_ban = new db_query("UPDATE `vat_tu_hd_dh` SET `id_vat_tu` = '$vt_vat_tu_old[$i]',`so_luong` = '$vt_so_luong_old[$i]',`don_gia` = '$vt_don_gia_old[$i]',`tien_trvat` = '$vt_tien_tvat_old[$i]', `thue_vat` = '$vt_thue_vat_old[$i]', `tien_svat` = '$vt_tien_svat_old[$i]' WHERE `vat_tu_hd_dh`.`id` = '$vt_id_vat_tu_old[$i]';");
        }

        for ($i = 0; $i < count($vt_vat_tu); $i++) {
            $them_vt_hd_ban = new db_query("INSERT INTO `vat_tu_hd_dh` (`id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`) VALUES (NULL, '$vt_vat_tu[$i]', '$hd_id', '$vt_so_luong[$i]', '$vt_don_gia[$i]', '$vt_tien_tvat[$i]', '$vt_thue_vat[$i]', '$vt_tien_svat[$i]');");
        }

        $noi_dung = 'Bạn đã chỉnh sửa hợp đồng bán vật tư: HĐ - ' . $hd_id;
        $ngay_tao = strtotime(date('Y-m-d', time()));
        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`, `id_cong_ty`)
                          VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung', '$com_id')");
    }
} else {
    echo "Khách hàng không được để trống.";
}
