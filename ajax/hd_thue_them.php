<?
include("config.php");

$ep_id                  = $_POST['ep_id'];
$com_id                 = $_POST['com_id'];

$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = $_POST['id_nha_cung_cap'];
$dan_ctrinh             = $_POST['dan_ctrinh'];
$thue_noi_bo            = $_POST['thue_noi_bo'];

$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];

$phan_loai              = 3;
$trang_thai             = 1;

$tb_thiet_bi            = $_POST['tb_thiet_bi'];
$tb_thong_so            = $_POST['tb_thong_so'];
$tb_so_luong            = $_POST['tb_so_luong'];
$tb_ngay_bat_dau        = $_POST['tb_ngay_bat_dau'];
$tb_ngay_ket_thuc       = $_POST['tb_ngay_ket_thuc'];
$tb_don_vi_tinh         = $_POST['tb_don_vi_tinh'];
$tb_khoi_luong          = $_POST['tb_khoi_luong'];
$tb_han_muc             = $_POST['tb_han_muc'];
$tb_don_gia             = $_POST['tb_don_gia'];
$tb_don_gia_ca_may      = $_POST['tb_don_gia_ca_may'];
$tb_thanh_tien          = $_POST['tb_thanh_tien'];
$tb_thoa_thuan_khac     = $_POST['tb_thoa_thuan_khac'];
$tb_luu_y               = $_POST['tb_luu_y'];


// echo $so_taik;
// die();
$count      = count($tb_thiet_bi);

$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));

if ($ngay_ky_hd != "" && $id_nha_cung_cap != "") {
    if ($count != 0) {
        $them_hd_ban = new db_query("INSERT INTO `hop_dong` (`id`, `ngay_ky_hd`, `id_nha_cc_kh`,`id_du_an_ctrinh`, `thue_noi_bo`,`noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`,`phan_loai`, `trang_thai`, `id_cong_ty`) VALUES (NULL,'$ngay_ky_hd','$id_nha_cung_cap','$dan_ctrinh', '$thue_noi_bo', '$noi_dung_hd', '$noi_dung_luu_y', '$dieu_khoan_tt','$ten_nh', '$so_taik', '$phan_loai','$trang_thai', '$com_id')");

        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS hd_id"))->result);
        $id_hd = $row['hd_id'];


        for ($i = 0; $i < $count; $i++) {
            $start_date = strtotime($tb_ngay_bat_dau[$i]);
            $end_date   = strtotime($tb_ngay_ket_thuc[$i]);

            $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_thue` (`id`, `id_hd_thue`, `loai_tai_san`, `thong_so_kthuat`, `so_luong`, `thue_tu_ngay`, `thue_den_ngay`, `don_vi_tinh`, `khoi_luong_du_kien`, `han_muc_ca_may`, `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien`, `thoa_thuan_khac`, `luu_y`) VALUES (NULL, '$id_hd', '$tb_thiet_bi[$i]', '$tb_thong_so[$i]', '$tb_so_luong[$i]', '$start_date','$end_date', '$tb_don_vi_tinh[$i]', '$tb_khoi_luong[$i]', '$tb_han_muc[$i]', '$tb_don_gia[$i]', '$tb_don_gia_ca_may[$i]', '$tb_thanh_tien[$i]', '$tb_thoa_thuan_khac[$i]', '$tb_luu_y[$i]')");
        }

        //save log
        $noi_dung = 'Bạn đã thêm hợp đồng thuê thiết bị: HĐ - ' . $id_hd;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                      VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
    } else {
        echo "Thêm ít nhất 1 vật tư!";
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
