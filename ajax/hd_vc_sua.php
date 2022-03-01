<?
include("config.php");

$ep_id                  = $_POST['ep_id'];
$com_id                 = $_POST['com_id'];

$hd_id                  = $_POST['hd_id'];
$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = $_POST['id_nha_cung_cap'];
$dan_ctrinh             = $_POST['dan_ctrinh'];
$truoc_vat              = $_POST['truoc_vat'];
$don_gia_vat            = $_POST['don_gia_vat'];
$thue_vat               = $_POST['thue_vat'];
$sau_vat                = $_POST['sau_vat'];
$bao_hanh               = $_POST['bao_hanh'];
$gt_bao_hanh            = $_POST['gt_bao_hanh'];
$bao_lanh               = $_POST['bao_lanh'];
$gt_bao_lanh            = $_POST['gt_bao_lanh'];
$han_bao_lanh           = strtotime($_POST['han_bao_lanh']);
$ngay_bat_dau           = strtotime($_POST['ngay_bat_dau']);
$ngay_ket_thuc          = strtotime($_POST['ngay_ket_thuc']);
$bao_gom_van_chuyen     = $_POST['bao_gom_van_chuyen'];
$hmuc_tind              = $_POST['hmuc_tind'];
$yc_tiendo              = $_POST['yc_tiendo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$phan_loai              = 4;
$trang_thai             = 1;

$vt_id_vat_tu_old              = $_POST['vt_id_vat_tu_old'];
$vt_vat_tu_old              = $_POST['vt_vat_tu_old'];
$vt_don_vi_tinh_old         = $_POST['vt_don_vi_tinh_old'];
$vt_khoi_luong_old          = $_POST['vt_khoi_luong_old'];
$vt_don_gia_old             = $_POST['vt_don_gia_old'];
$vt_thanh_tien_old          = $_POST['vt_thanh_tien_old'];

$vt_vat_tu              = $_POST['vt_vat_tu'];
$vt_don_vi_tinh         = $_POST['vt_don_vi_tinh'];
$vt_khoi_luong          = $_POST['vt_khoi_luong'];
$vt_don_gia             = $_POST['vt_don_gia'];
$vt_thanh_tien          = $_POST['vt_thanh_tien'];

$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));

// cap nhat hop dong thue van chuyen
$sua_hd_thue_vc = new db_query("UPDATE `hop_dong` SET `ngay_ky_hd` = '$ngay_ky_hd', `id_nha_cc_kh` = '$id_nha_cung_cap',`id_du_an_ctrinh` = '$dan_ctrinh', `gia_tri_trvat` = '$truoc_vat', `bao_gom_vat` = '$don_gia_vat', `thue_vat` = '$thue_vat', `gia_tri_svat` = '$sau_vat',`giu_lai_bhanh` = '$bao_hanh',`gia_tri_bhanh` = '$gt_bao_hanh',`bao_lanh_hd` = '$bao_lanh',`gia_tri_blanh` = '$gt_bao_lanh',`thoi_han_blanh` = '$han_bao_lanh', `tg_bd_thuc_hien` = '$ngay_bat_dau', `tg_kt_thuc_hien` = '$ngay_ket_thuc', `bgom_vchuyen` = '$bao_gom_van_chuyen', `han_muc_tin_dung` = '$hmuc_tind',`yc_tien_do` = '$yc_tiendo',`noi_dung_hd` = '$noi_dung_hd', `noi_dung_luu_y` = '$noi_dung_luu_y', `dieu_khoan_tt` = '$dieu_khoan_tt', `ten_ngan_hang` = '$ten_nh', `so_tk` = '$so_taik' WHERE `id` = '$hd_id'");

//cap nhat vat tu, thiet bi da co
for ($i = 0; $i < count($vt_id_vat_tu_old); $i++) {
    $sua_vt_hd_vc = new db_query("UPDATE `vat_tu_hd_vc` SET `vat_tu` = '$vt_vat_tu_old[$i]', `don_vi_tinh` = '$vt_don_vi_tinh_old[$i]', `khoi_luong` = '$vt_khoi_luong_old[$i]', `don_gia` = '$vt_don_gia_old[$i]', `thanh_tien` = '$vt_thanh_tien_old[$i]' WHERE `id` = '$vt_id_vat_tu_old[$i]';");
}
//them vat tu, thiet bi moi
for ($i = 0; $i < count($vt_vat_tu); $i++) {
    $them_vt_hd_vc = new db_query("INSERT INTO `vat_tu_hd_vc` (`id`, `vat_tu`, `id_hd_vc`, `don_vi_tinh`, `khoi_luong`, `don_gia`, `thanh_tien`) VALUES (NULL, '$vt_vat_tu[$i]', '$hd_id', '$vt_don_vi_tinh[$i]', '$vt_khoi_luong[$i]', '$vt_don_gia[$i]', '$vt_thanh_tien[$i]');");
}

// save log
$noi_dung = 'Bạn đã chỉnh sửa hợp đồng thuê vận chuyển: HĐ - ' . $id_hd;
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                          VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
if ((isset($sua_hd_thue_vc) && (isset($sua_vt_hd_vc) || isset($them_vt_hd_vc)))) {
    echo "";
} else {
    echo "Lỗi!";
}
