<?
include("config.php");

$user_id                  = getValue('user_id', 'int', 'POST', '');
$com_id                 = getValue('com_id', 'int', 'POST', '');
$role                  = getValue('role', 'int', 'POST', '');

$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = getValue('id_nha_cung_cap', 'int', 'POST', '');
$dan_ctrinh             = getValue('dan_ctrinh', 'int', 'POST', '');
$thue_noi_bo            = $_POST['thue_noi_bo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$tong_tien              = $_POST['tong_tien'];

$phan_loai              = 3;
$trang_thai             = 1;

$tb_kho                 = $_POST['tb_kho'];
$tb_thiet_bi            = $_POST['tb_thiet_bi'];
$tb_thong_so            = $_POST['tb_thong_so'];
$tb_so_luong            = $_POST['tb_so_luong'];
$tb_hinh_thuc           = $_POST['tb_hinh_thuc'];
$tb_ngay_bat_dau        = $_POST['tb_ngay_bat_dau'];
$tb_ngay_ket_thuc       = $_POST['tb_ngay_ket_thuc'];
$tb_khoi_luong          = $_POST['tb_khoi_luong'];
$tb_han_muc             = $_POST['tb_han_muc'];
$tb_don_gia             = $_POST['tb_don_gia'];
$tb_don_gia_ca_may      = $_POST['tb_don_gia_ca_may'];
$tb_thanh_tien          = $_POST['tb_thanh_tien'];
$tb_thoa_thuan_khac     = $_POST['tb_thoa_thuan_khac'];
$tb_luu_y               = $_POST['tb_luu_y'];

$count      = count($tb_kho);
$count1     = count($tb_thiet_bi);
$count2     = count($tb_so_luong);
$count3     = count($tb_hinh_thuc);
$count4     = count($tb_khoi_luong);
$count5     = count($tb_han_muc);
$count6     = count($tb_don_gia);
$count7     = count($tb_don_gia_ca_may);
$count8    = count($tb_thanh_tien);

$ngay_tao = strtotime(date('Y-m-d', time()));
if ($ngay_ky_hd != "" && $id_nha_cung_cap != "") {
    if ($count == 0) {
        echo "Thêm ít nhất 1 thiết bị!";
    } else {
        if ($count != $count1 || $count1 != $count2 || $count2 != $count3 || $count3 != $count4 || $count4 != $count5 || $count5 != $count6 || $count6 != $count7 || $count7 != $count8) {
            echo "Vui lòng điền đầy đủ thông tin thiết bị.";
        } else {
            $them_hd_ban = new db_query("INSERT INTO `hop_dong` (`id`, `ngay_ky_hd`, `id_nha_cc_kh`,`id_du_an_ctrinh`, `thue_noi_bo`,`noi_dung_hd`,
            `noi_dung_luu_y`, `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`,`phan_loai`, `trang_thai`,`ngay_tao`,`gia_tri_trvat`,`gia_tri_svat`,`quyen_nlap`,
            `nguoi_lap`, `id_cong_ty`)
            VALUES (NULL,'$ngay_ky_hd','$id_nha_cung_cap','$dan_ctrinh', '$thue_noi_bo', '$noi_dung_hd', '$noi_dung_luu_y', '$dieu_khoan_tt','$ten_nh',
            '$so_taik', '$phan_loai','$trang_thai','$ngay_tao','$tong_tien','$tong_tien', '$role','$user_id', '$com_id')");

            $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS hd_id"))->result);
            $id_hd = $row['hd_id'];


            for ($i = 0; $i < $count; $i++) {
                $start_date = strtotime($tb_ngay_bat_dau[$i]);
                $end_date   = strtotime($tb_ngay_ket_thuc[$i]);

                $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_thue`(`id`, `id_hd_thue`, `id_kho`, `id_vat_tu_thiet_bi`, `thong_so_kthuat`, `so_luong`, `hinh_thuc_thue`, `thue_tu_ngay`, `thue_den_ngay`, `khoi_luong_du_kien`, `han_muc_ca_may`, `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien`, `thoa_thuan_khac`, `luu_y`) VALUES (NULL,'$id_hd','$tb_kho[$i]','$tb_thiet_bi[$i]','$tb_thong_so[$i]','$tb_so_luong[$i]','$tb_hinh_thuc[$i]','$start_date','$end_date','$tb_khoi_luong[$i]','$tb_han_muc[$i]','$tb_don_gia[$i]','$tb_don_gia_ca_may[$i]','$tb_thanh_tien[$i]','$tb_thoa_thuan_khac[$i]','$tb_luu_y[$i]')");
            }

            //save log
            $noi_dung = 'Bạn đã thêm hợp đồng thuê thiết bị: HĐ - ' . $id_hd;

            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
            VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
