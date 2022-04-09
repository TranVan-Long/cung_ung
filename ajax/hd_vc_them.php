<?
include("config.php");

$user_id                = getValue('user_id', 'int', 'POST', '');
$com_id                 = getValue('com_id', 'int', 'POST', '');
$role                 = getValue('role', 'int', 'POST', '');

$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = getValue('id_nha_cung_cap', 'int', 'POST', '');


$dan_ctrinh             = getValue('dan_ctrinh', 'int', 'POST', '');
$truoc_vat              = $_POST['truoc_vat'];
$don_gia_vat            = $_POST['don_gia_vat'];
$thue_vat               = $_POST['thue_vat'];
$sau_vat                = $_POST['sau_vat'];
$bao_hanh               = $_POST['bao_hanh'];
$gt_bao_hanh            = $_POST['gt_bao_hanh'];
$bao_lanh               = $_POST['bao_lanh'];
$gt_bao_lanh            = $_POST['gt_bao_lanh'];

if ($_POST['han_bao_lanh'] == "") {
    $han_bao_lanh = 0;
} else {
    $han_bao_lanh = strtotime($_POST['han_bao_lanh']);
};

if ($_POST['ngay_bat_dau'] == "") {
    $ngay_bat_dau = 0;
} else {
    $ngay_bat_dau = strtotime($_POST['ngay_bat_dau']);
};

if ($_POST['ngay_ket_thuc'] == "") {
    $ngay_ket_thuc = 0;
} else {
    $ngay_ket_thuc = strtotime($_POST['ngay_ket_thuc']);
};

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

$vt_vat_tu              = $_POST['vt_vat_tu'];
$cou1 = count($vt_vat_tu);


$vt_don_vi_tinh         = $_POST['vt_don_vi_tinh'];
$cou2 = count($vt_don_vi_tinh);

$vt_khoi_luong          = $_POST['vt_khoi_luong'];
$cou3 = count($vt_khoi_luong);

$vt_don_gia             = $_POST['vt_don_gia'];
$cou4 = count($vt_don_gia);

$vt_thanh_tien          = $_POST['vt_thanh_tien'];
$cou5 = count($vt_thanh_tien);

$count = count($vt_vat_tu);

if ($com_id != "" && $user_id != "" && $id_nha_cung_cap != "" && $cou1 > 0) {
    if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4 || $cou4 != $cou5) {
        echo " Điền đầy đủ thông tin vật tư thiết bị";
    } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $cou4 == $cou5) {
        $them_hd_ban = new db_query("INSERT INTO `hop_dong` (`id`, `ngay_ky_hd`, `id_nha_cc_kh`,`id_du_an_ctrinh`, `gia_tri_trvat`, `bao_gom_vat`,
                                    `thue_vat`, `gia_tri_svat`,`giu_lai_bhanh`,`gia_tri_bhanh`,`bao_lanh_hd`,`gia_tri_blanh`,`thoi_han_blanh`,
                                    `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `bgom_vchuyen`, `han_muc_tin_dung`,`yc_tien_do`,`noi_dung_hd`, `noi_dung_luu_y`,
                                    `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk`,`phan_loai`, `trang_thai`, `id_cong_ty`)
                                    VALUES (NULL,'$ngay_ky_hd','$id_nha_cung_cap','$dan_ctrinh', '$truoc_vat', '$don_gia_vat','$thue_vat','$sau_vat',
                                    '$bao_hanh','$gt_bao_hanh','$bao_lanh','$gt_bao_lanh','$han_bao_lanh', '$ngay_bat_dau', '$ngay_ket_thuc',
                                    '$bao_gom_van_chuyen','$hmuc_tind', '$yc_tiendo', '$noi_dung_hd', '$noi_dung_luu_y', '$dieu_khoan_tt','$ten_nh',
                                    '$so_taik', '$phan_loai','$trang_thai', '$com_id')");

        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS hd_id"))->result);
        $id_hd = $row['hd_id'];

        for ($i = 0; $i < $cou1; $i++) {
            $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_vc` (`id`, `vat_tu`, `id_hd_vc`, `don_vi_tinh`, `khoi_luong`, `don_gia`, `thanh_tien`)
                                        VALUES (NULL, '$vt_vat_tu[$i]', '$id_hd', '$vt_don_vi_tinh[$i]', '$vt_khoi_luong[$i]', '$vt_don_gia[$i]', '$vt_thanh_tien[$i]')");
        }

        $noi_dung = 'Bạn đã thêm hợp đồng thuê vận chuyển: HĐ - ' . $id_hd;
        $ngay_tao = strtotime(date('Y-m-d', time()));
        $gio_tao = strtotime(date('H:i:s', time()));
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
        VALUES('', '$user_id','$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
