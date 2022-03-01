<?
include("config.php");

$ep_id                  = $_POST['ep_id'];
$com_id                 = $_POST['com_id'];

$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_khach_hang          = $_POST['id_khach_hang'];
$hd_nguyen_tac          = $_POST['hd_nguyen_tac'];
$truoc_vat              = $_POST['truoc_vat'];
$don_gia_vat            = $_POST['don_gia_vat'];
$thue_vat               = $_POST['thue_vat'];
$sau_vat                = $_POST['sau_vat'];
$ngay_bat_dau           = strtotime($_POST['ngay_bat_dau']);
$ngay_ket_thuc          = strtotime($_POST['ngay_ket_thuc']);
$bao_gom_van_chuyen     = $_POST['bao_gom_van_chuyen'];
$yc_tiendo              = $_POST['yc_tiendo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$phan_loai              = 2;
$trang_thai             = 1;

$vt_vat_tu                 = $_POST['vt_vat_tu'];
$vt_so_luong               = $_POST['vt_so_luong'];
$vt_don_gia                = $_POST['vt_don_gia'];
$vt_truoc_vat              = $_POST['vt_truoc_vat'];
$vt_vat_tax                = $_POST['vt_vat_tax'];
$vt_sau_vat                = $_POST['vt_sau_vat'];

// foreach ($vat_tu as $item) {
//     echo $so_luong;
// }
// die();
$count = count($vt_vat_tu);
$count2 = count($vt_so_luong);
// echo $count;
// die();

$ngay_tao = strtotime(date('Y-m-d H:i:s', time()));

if ($ngay_ky_hd != "" && $id_khach_hang != "") {
    if ($count != 0 && $count2 != 0) {
        $them_hd_ban = new db_query("INSERT INTO `hop_dong` (`id`, `ngay_ky_hd`, `id_nha_cc_kh`, `hd_nguyen_tac`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `bgom_vchuyen`, `yc_tien_do`,`noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`,`phan_loai`, `trang_thai`, `id_cong_ty`) VALUES (NULL, '$ngay_ky_hd', '$id_khach_hang', '$hd_nguyen_tac', '$truoc_vat', '$don_gia_vat', '$thue_vat', '$sau_vat', '$ngay_bat_dau', '$ngay_ket_thuc', '$bao_gom_van_chuyen', '$yc_tiendo', '$noi_dung_hd', '$noi_dung_luu_y', '$dieu_khoan_tt', '$ten_nh', '$so_taik', '$phan_loai','$trang_thai', '$com_id')");
        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS hd_id"))->result);
        $id_hd = $row['hd_id'];


        for ($i = 0; $i < $count; $i++) {
            if ($vt_vat_tu[$i] != 0 && $vt_so_luong[$i] != 0 && $vt_vat_tax[$i] != 0) {
                $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_dh` (`id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`) VALUES (NULL, '$vt_vat_tu[$i]', '$id_hd', '$vt_so_luong[$i]', '$vt_don_gia[$i]', '$vt_truoc_vat[$i]', '$vt_vat_tax[$i]', '$vt_sau_vat[$i]');");
            } else {
                echo "Vui lòng điền đầy đủ thông tin!";
            }
        }

        //save log
        $noi_dung = 'Bạn đã thêm hợp đồng bán vật tư: HĐ - ' . $id_hd;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                      VALUES('', '$ep_id', '$ngay_tao', '$noi_dung')");
    } else {
        echo "Thêm ít nhất 1 vật tư!";
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
