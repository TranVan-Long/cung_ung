<?
include("config.php");

$ep_id                  = getValue('ep_id', 'int', 'POST', '');
$com_id                 = getValue('com_id', 'int', 'POST', '');

$hd_id                  = getValue('hd_id', 'int', 'POST', '');
$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = getValue('id_nha_cung_cap', 'int', 'POST', '');
$dan_ctrinh             = $_POST['dan_ctrinh'];
$hd_nguyen_tac          = $_POST['hd_nguyen_tac'];
$hinh_thuc              = $_POST['hinh_thuc'];
$truoc_vat              = $_POST['truoc_vat'];
$don_gia_vat            = $_POST['don_gia_vat'];
$thue_vat               = $_POST['thue_vat'];
$chiet_khau             = $_POST['chiet_khau'];
$sau_vat                = $_POST['sau_vat'];
$bao_hanh               = $_POST['bao_hanh'];
$gt_bao_hanh            = $_POST['gt_bao_hanh'];
$bao_lanh               = $_POST['bao_lanh'];
$gt_bao_lanh            = $_POST['gt_bao_lanh'];
$han_bao_lanh           = strtotime($_POST['han_bao_lanh']);
$ngay_bat_dau           = strtotime($_POST['ngay_bat_dau']);
$ngay_ket_thuc          = strtotime($_POST['ngay_ket_thuc']);
$bao_gom_van_chuyen     = $_POST['bao_gom_van_chuyen'];
$yc_tiendo              = $_POST['yc_tiendo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$bao_gia                = $_POST['bao_gia'];
$tthuan_hdon            = $_POST['tthuan_hdon'];
$phan_loai              = 3;
$trang_thai             = 1;

$vt_id_vat_tu_old       = $_POST['vt_id_vat_tu_old'];
$vt_vat_tu_old          = $_POST['vt_vat_tu_old'];
$vt_so_luong_old        = $_POST['vt_so_luong_old'];
$vt_don_gia_old         = $_POST['vt_don_gia_old'];
$vt_tien_tvat_old       = $_POST['vt_tien_tvat_old'];
$vt_thue_vat_old        = $_POST['vt_thue_vat_old'];
$vt_tien_svat_old       = $_POST['vt_tien_svat_old'];

$vt_vat_tu              = $_POST['vt_vat_tu'];
$vt_so_luong            = $_POST['vt_so_luong'];
$vt_don_gia             = $_POST['vt_don_gia'];
$vt_tien_tvat           = $_POST['vt_tien_tvat'];
$vt_thue_vat            = $_POST['vt_thue_vat'];
$vt_tien_svat           = $_POST['vt_tien_svat'];

if ($id_nha_cung_cap != "") {
    if ($vt_id_vat_tu_old != "" || $vt_vat_tu != "") {
        $sua_hd_mua_vt = new db_query("UPDATE `hop_dong` SET `ngay_ky_hd` = '$ngay_ky_hd', `id_nha_cc_kh` = '$id_nha_cung_cap',`hd_nguyen_tac` = '$hd_nguyen_tac', `hinh_thuc_hd` = '$hinh_thuc', `gia_tri_trvat` = '$truoc_vat', `bao_gom_vat` = '$don_gia_vat', `thue_vat` = '$thue_vat', `tien_chiet_khau` = '$chiet_khau', `gia_tri_svat` = '$sau_vat',`giu_lai_bhanh` = '$bao_hanh',`gia_tri_bhanh` = '$gt_bao_hanh',`bao_lanh_hd` = '$bao_lanh',`gia_tri_blanh` = '$gt_bao_lanh',`thoi_han_blanh` = '$han_bao_lanh', `tg_bd_thuc_hien` = '$ngay_bat_dau', `tg_kt_thuc_hien` = '$ngay_ket_thuc', `bgom_vchuyen` = '$bao_gom_van_chuyen',`yc_tien_do` = '$yc_tiendo',`noi_dung_hd` = '$noi_dung_hd', `noi_dung_luu_y` = '$noi_dung_luu_y', `dieu_khoan_tt` = '$dieu_khoan_tt', `ten_ngan_hang` = '$ten_nh', `so_tk` = '$so_taik', `id_bao_gia` = '$bao_gia', `thoa_tuan_hoa_don`= '$tthuan_hdon' WHERE `id` = '$hd_id'");


        for ($i = 0; $i < count($vt_id_vat_tu_old); $i++) {
            $sua_vt_hd_ban = new db_query("UPDATE `vat_tu_hd_dh` SET `id_vat_tu` = '$vt_vat_tu_old[$i]',`so_luong` = '$vt_so_luong_old[$i]',`don_gia` = '$vt_don_gia_old[$i]',`tien_trvat` = '$vt_tien_tvat_old[$i]', `thue_vat` = '$vt_thue_vat_old[$i]', `tien_svat` = '$vt_tien_svat_old[$i]' WHERE `vat_tu_hd_dh`.`id` = '$vt_id_vat_tu_old[$i]';");
        }

        for ($i = 0; $i < count($vt_vat_tu); $i++) {
            $them_vt_hd_ban = new db_query("INSERT INTO `vat_tu_hd_dh` (`id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`) VALUES (NULL, '$vt_vat_tu[$i]', '$hd_id', '$vt_so_luong[$i]', '$vt_don_gia[$i]', '$vt_tien_tvat[$i]', '$vt_thue_vat[$i]', '$vt_tien_svat[$i]');");
        }
        $noi_dung = 'Bạn đã chỉnh sửa hợp đồng mua vật tư: HĐ - ' . $hd_id;
        $ngay_tao = strtotime(date('Y-m-d', time()));
        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`)
                          VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung')");
    } else {
        echo "Thêm ít nhất một vật tư.";
    }
} else {
    echo "Khách hàng không được để trống.";
}
