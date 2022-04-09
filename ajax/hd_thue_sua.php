<?
include("config.php");

$user_id                  = getValue('user_id', 'int', 'POST', '');
$com_id                 = getValue('com_id', 'int', 'POST', '');
$role                  = getValue('role', 'int', 'POST', '');


$hd_id                  = getValue('hd_id', 'int', 'POST', '');
$ngay_ky_hd             = strtotime($_POST['ngay_ky_hd']);
$id_nha_cung_cap        = getValue('id_nha_cung_cap', 'int', 'POST', '');
$id_cong_trinh             = getValue('id_cong_trinh', 'int', 'POST', '');
$thue_noi_bo            = $_POST['thue_noi_bo'];
$noi_dung_hd            = $_POST['noi_dung_hd'];
$noi_dung_luu_y         = $_POST['noi_dung_luu_y'];
$dieu_khoan_tt          = $_POST['dieu_khoan_tt'];
$ten_nh                 = $_POST['ten_nh'];
$so_taik                = $_POST['so_taik'];
$tong_tien              = $_POST['tong_tien'];

$tb_id_thiet_bi_old          = $_POST['tb_id_thiet_bi_old'];
$tb_id_kho_old               = $_POST['tb_id_kho_old'];
$tb_vat_tu_thiet_bi_old      = $_POST['tb_vat_tu_thiet_bi_old'];
$tb_thong_so_old             = $_POST['tb_thong_so_old'];
$tb_so_luong_old             = $_POST['tb_so_luong_old'];
$tb_hinh_thuc_thue_old       = $_POST['tb_hinh_thuc_thue_old'];
$tb_ngay_bat_dau_old         = $_POST['tb_ngay_bat_dau_old'];
$tb_ngay_ket_thuc_old        = $_POST['tb_ngay_ket_thuc_old'];
$tb_khoi_luong_old           = $_POST['tb_khoi_luong_old'];
$tb_han_muc_old              = $_POST['tb_han_muc_old'];
$tb_don_gia_old              = $_POST['tb_don_gia_old'];
$tb_don_gia_ca_may_old       = $_POST['tb_don_gia_ca_may_old'];
$tb_thanh_tien_old           = $_POST['tb_thanh_tien_old'];
$tb_thoa_thuan_khac_old      = $_POST['tb_thoa_thuan_khac_old'];
$tb_luu_y_old                = $_POST['tb_luu_y_old'];

$count_o      = count($tb_id_kho_old);
$count_o1     = count($tb_vat_tu_thiet_bi_old);
$count_o2     = count($tb_so_luong_old);
$count_o3     = count($tb_hinh_thuc_thue_old);
$count_o6     = count($tb_khoi_luong_old);
$count_o7     = count($tb_han_muc_old);
$count_o8     = count($tb_don_gia_ca_may_old);
$count_o9     = count($tb_thanh_tien_old);

$tb_kho               = $_POST['tb_kho'];
$tb_thiet_bi          = $_POST['tb_thiet_bi'];
$tb_thong_so          = $_POST['tb_thong_so'];
$tb_so_luong          = $_POST['tb_so_luong'];
$tb_hinh_thuc         = $_POST['tb_hinh_thuc'];
$tb_ngay_bat_dau      = $_POST['tb_ngay_bat_dau'];
$tb_ngay_ket_thuc     = $_POST['tb_ngay_ket_thuc'];
$tb_khoi_luong        = $_POST['tb_khoi_luong'];
$tb_han_muc           = $_POST['tb_han_muc'];
$tb_don_gia           = $_POST['tb_don_gia'];
$tb_don_gia_ca_may    = $_POST['tb_don_gia_ca_may'];
$tb_thanh_tien        = $_POST['tb_thanh_tien'];
$tb_thoa_thuan_khac   = $_POST['tb_thoa_thuan_khac'];
$tb_luu_y             = $_POST['tb_luu_y'];

$count      = count($tb_kho);
$count1     = count($tb_thiet_bi);
$count2     = count($tb_so_luong);
$count3     = count($tb_hinh_thuc);
$count6     = count($tb_khoi_luong);
$count7     = count($tb_han_muc);
$count8     = count($tb_don_gia_ca_may);
$count9     = count($tb_thanh_tien);


if ($ngay_ky_hd != "" && $hd_id != "") {
    if ($count == 0 && $count_o == 0) {
        echo "Thêm ít nhất 1 thiết bị.";
    } else {
        if ($count != $count1 || $count1 != $count2 || $count2 != $count3 || $count6 != $count7 || $count7 != $count8 || $count8 != $count9 || $count_o != $count_o1 || $count_o1 != $count_o2 || $count_o2 != $count_o3 || $count_o6 != $count_o7 || $count_o7 != $count_o8 || $count_o8 != $count_o9) {
            echo "Vui lòng điền đầy đủ thông tin thiết bị.";
        } else {
            $sua_hd_thue = new db_query("UPDATE `hop_dong` SET `ngay_ky_hd` = '$ngay_ky_hd', `id_nha_cc_kh` = '$id_nha_cung_cap',`id_du_an_ctrinh`= '$id_cong_trinh', `thue_noi_bo` = '$thue_noi_bo',`noi_dung_hd` = '$noi_dung_hd', `noi_dung_luu_y` = '$noi_dung_luu_y', `dieu_khoan_tt` = '$dieu_khoan_tt', `ten_ngan_hang` = '$ten_nh', `so_tk` = '$so_taik',`gia_tri_trvat`= '$tong_tien', `gia_tri_svat`= '$tong_tien' WHERE `id` = '$hd_id'");


            for ($i = 0; $i < count($tb_id_thiet_bi_old); $i++) {
                $start_date_old = strtotime($tb_ngay_bat_dau_old[$i]);
                $end_date_old   = strtotime($tb_ngay_ket_thuc_old[$i]);

                $sua_vt_hd = new db_query("UPDATE `vat_tu_hd_thue` SET `id_kho`='$tb_id_kho_old[$i]',`id_vat_tu_thiet_bi`='$tb_vat_tu_thiet_bi_old[$i]',`thong_so_kthuat`='$tb_thong_so_old[$i]',`so_luong`='$tb_so_luong_old[$i]',`hinh_thuc_thue`='$tb_hinh_thuc_thue_old[$i]',`thue_tu_ngay`='$start_date_old',`thue_den_ngay`='$end_date_old',`khoi_luong_du_kien`='$tb_khoi_luong_old[$i]',`han_muc_ca_may`='$tb_han_muc_old[$i]',`don_gia_thue`='$tb_don_gia_old[$i]',`dg_ca_may_phu_troi`='$tb_don_gia_ca_may_old[$i]',`thanh_tien_du_kien`='$tb_thanh_tien_old[$i]',`thoa_thuan_khac`='$tb_thoa_thuan_khac_old[$i]',`luu_y`='$tb_luu_y_old[$i]' WHERE `id`= '$tb_id_thiet_bi_old[$i]'");
            }

            for ($i = 0; $i < count($tb_kho); $i++) {
                $start_date = strtotime($tb_ngay_bat_dau[$i]);
                $end_date   = strtotime($tb_ngay_ket_thuc[$i]);

                $them_vt_hd = new db_query("INSERT INTO `vat_tu_hd_thue`(`id`, `id_hd_thue`, `id_kho`, `id_vat_tu_thiet_bi`, `thong_so_kthuat`, `so_luong`, `hinh_thuc_thue`, `thue_tu_ngay`, `thue_den_ngay`, `khoi_luong_du_kien`, `han_muc_ca_may`, `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien`, `thoa_thuan_khac`, `luu_y`) VALUES (NULL,'$hd_id','$tb_kho[$i]','$tb_thiet_bi[$i]','$tb_thong_so[$i]','$tb_so_luong[$i]','$tb_hinh_thuc[$i]','$start_date','$end_date','$tb_khoi_luong[$i]','$tb_han_muc[$i]','$tb_don_gia[$i]','$tb_don_gia_ca_may[$i]','$tb_thanh_tien[$i]','$tb_thoa_thuan_khac[$i]','$tb_luu_y[$i]')");
            }

            // save log
            $noi_dung = 'Bạn sửa hợp đồng thuê thiết bị: HĐ - ' . $hd_id;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                          VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
