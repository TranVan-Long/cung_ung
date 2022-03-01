<?
include("config.php");

$ep_id                  = $_POST['ep_id'];
$com_id                 = $_POST['com_id'];

$hd_id                  = $_POST['hd_id'];
$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = $_POST['id_ncc'];
$dan_ctrinh             = $_POST['id_cong_trinh'];
$thue_noi_bo            = $_POST['thue_noi_bo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$phan_loai              = 3;
$trang_thai             = 1;

$id_thiet_bi_old        = $_POST['id_thiet_bi_old'];
$loai_tb_old            = $_POST['loai_tb_old'];
$thong_so_old           = $_POST['thong_so_old'];
$so_luong_old           = $_POST['so_luong_old'];
$ngay_bat_dau_thue_old  = $_POST['ngay_bat_dau_thue_old'];
$ngay_ket_thuc_thue_old = $_POST['ngay_ket_thuc_thue_old'];
$don_vi_tinh_old        = $_POST['don_vi_tinh_old'];
$khoi_luong_old         = $_POST['khoi_luong_old'];
$han_muc_old            = $_POST['han_muc_old'];
$don_gia_old            = $_POST['don_gia_old'];
$don_gia_ca_may_old     = $_POST['don_gia_ca_may_old'];
$thanh_tien_old         = $_POST['thanh_tien_old'];
$thoa_thuan_khac_old    = $_POST['thoa_thuan_khac_old'];
$luu_y_old              = $_POST['luu_y_old'];

$loai_tb                = $_POST['loai_tb'];
$thong_so               = $_POST['thong_so'];
$so_luong               = $_POST['so_luong'];
$ngay_bat_dau_thue      = $_POST['ngay_bat_dau_thue'];
$ngay_ket_thuc_thue     = $_POST['ngay_ket_thuc_thue'];
$don_vi_tinh            = $_POST['don_vi_tinh'];
$khoi_luong             = $_POST['khoi_luong'];
$han_muc                = $_POST['han_muc'];
$don_gia                = $_POST['don_gia'];
$don_gia_ca_may         = $_POST['don_gia_ca_may'];
$thanh_tien             = $_POST['thanh_tien'];
$thoa_thuan_khac        = $_POST['thoa_thuan_khac'];
$luu_y                  = $_POST['luu_y'];


// echo count($loai_tb_old);
// die();


$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));

// if ($ngay_ky_hd != "" && $hd_id != "") {

$sua_hd_thue = new db_query("UPDATE `hop_dong` SET `ngay_ky_hd` = '$ngay_ky_hd', `id_nha_cc_kh` = '$id_nha_cung_cap',`id_du_an_ctrinh`= '$dan_ctrinh', `thue_noi_bo` = '$thue_noi_bo',`noi_dung_hd` = '$noi_dung_hd', `noi_dung_luu_y` = '$noi_dung_luu_y', `dieu_khoan_tt` = '$dieu_khoan_tt', `ten_ngan_hang` = '$ten_nh', `so_tk` = '$so_taik',`phan_loai` = '$phan_loai', `trang_thai` = '$trang_thai', `id_cong_ty` = '$com_id' WHERE `id` = '$hd_id'");


for ($i = 0; $i < count($id_thiet_bi_old); $i++) {
    $start_date_old = strtotime($ngay_bat_dau_thue_old[$i]);
    $end_date_old   = strtotime($ngay_ket_thuc_thue_old[$i]);

    $sua_vt_hd = new db_query("UPDATE `vat_tu_hd_thue` SET `loai_tai_san` = '$loai_tb_old[$i]', `thong_so_kthuat` = '$thong_so_old[$i]', `so_luong` = '$so_luong_old[$i]', `thue_tu_ngay` = '$start_date_old', `thue_den_ngay` = '$end_date_old', `don_vi_tinh` = '$don_vi_tinh_old[$i]', `khoi_luong_du_kien` = '$khoi_luong_old[$i]', `han_muc_ca_may` = '$han_muc_old[$i]', `don_gia_thue` = '$don_gia_old[$i]', `dg_ca_may_phu_troi` = '$don_gia_ca_may_old[$i]', `thanh_tien_du_kien` = '$thanh_tien_old[$i]', `thoa_thuan_khac` = '$thoa_thuan_khac_old[$i]', `luu_y` = '$luu_y_old[$i]'WHERE `id` = '$id_thiet_bi_old[$i]'");
}

for ($i = 0; $i < count($loai_tb); $i++) {
    $start_date = strtotime($ngay_bat_dau_thue[$i]);
    $end_date   = strtotime($ngay_ket_thuc_thue[$i]);

    $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_thue` (`id`, `id_hd_thue`, `loai_tai_san`, `thong_so_kthuat`, `so_luong`, `thue_tu_ngay`, `thue_den_ngay`, `don_vi_tinh`, `khoi_luong_du_kien`, `han_muc_ca_may`, `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien`, `thoa_thuan_khac`, `luu_y`) VALUES (NULL, '$hd_id', '$loai_tb[$i]', '$thong_so[$i]', '$so_luong[$i]', '$start_date','$end_date', '$don_vi_tinh[$i]', '$khoi_luong[$i]', '$han_muc[$i]', '$don_gia[$i]', '$don_gia_ca_may[$i]', '$thanh_tien[$i]', '$thoa_thuan_khac[$i]', '$luu_y[$i]')");
}

//save log
// $noi_dung = 'Bạn sửa hợp đồng thuê thiết bị: HĐ - ' . $hd_id;
// $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
//                       VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
// } else {
//     echo "Thao tác thất bại vui lòng thử lại!";
// }
