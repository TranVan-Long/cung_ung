<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$loai_ptt = getValue('loai_ptt', 'int', 'POST', '');
$hdong_dhang = getValue('hdong_dhang', 'int', 'POST', '');
$id_ncc_kh = getValue('id_ncc_kh', 'int', 'POST', '');

if($_POST['ngay_ttoan'] != ""){
    $ngay_ttoan = strtotime($_POST['ngay_ttoan']);
}else{
    $ngay_ttoan = "";
};

$hinh_thuc_tt = getValue('hinh_thuc', 'int', 'POST', '');
$lthanh_toan = getValue('lthanh_toan', 'int', 'POST', '');
$phi_giaod = $_POST['phi_giaod'];
$nguoi_ntien = $_POST['nguoi_ntien'];
$so_tien = $_POST['so_tien'];
$ty_gia = $_POST['ty_gia'];
$gia_quydoi = $_POST['gia_quydoi'];

$phan_loai = getValue('ploai', 'int', 'POST', '');

$ten_nganhang = $_POST['ten_nganhang'];
$cou1 = count($ten_nganhang);

$chi_nhanh = $_POST['chi_nhanh'];
$cou2 = count($chi_nhanh);

$so_tk = $_POST['so_tk'];
$cou3 = count($so_tk);

$chu_taik = $_POST['chu_taik'];

$id_hs = getValue('id_hs', 'int', 'POST', '');
$tien_ttoan = $_POST['tien_ttoan'];

$ngay_tao = strtotime(date('Y-m-d', time()));

$gio_tao_nk = strtotime(date('H:i:s', time()));

if($com_id != "" && $user_id != "" && $loai_ptt != "" && $hdong_dhang != "" && $lthanh_toan != "" && $hinh_thuc_tt != ""){
    if ($hinh_thuc_tt == 2 || $hinh_thuc_tt == 3) {
        if ($cou1 != $cou2 || $cou2 != $cou3) {
            echo "Điền đẩy đủ thông tin tài khoản ngân hàng";
        } else if ($cou1 == $cou2 && $cou2 == $cou3) {
            if ($lthanh_toan == 1) {
                $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien_tam_ung`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `id_cong_ty`) VALUES ('','$hdong_dhang', '$id_ncc_kh','$loai_ptt','$ngay_ttoan','$hinh_thuc_tt','$lthanh_toan',
                                '$nguoi_ntien','$so_tien','$ty_gia','$phi_giaod','$gia_quydoi','$phan_loai',1,'$ngay_tao','','$user_id','$com_id')");

                $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
                $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

                for($i = 0; $i < $cou1; $i++){
                    $inser_tk = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`,
                                            `so_tk`, `chu_tk`) VALUES ('','$id_ptt','$ten_nganhang[$i]','$chi_nhanh[$i]','$so_tk[$i]','$chu_taik[$i]')");
                };

                $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: ".$id_ptt;
                $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");

            } else if ($lthanh_toan == 2) {
                $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien_tam_ung`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `id_cong_ty`) VALUES ('','$hdong_dhang','$id_ncc_kh','$loai_ptt','$ngay_ttoan','$hinh_thuc_tt','$lthanh_toan',
                                '$nguoi_ntien','','','$phi_giaod','','$phan_loai',1,'$ngay_tao','','$user_id','$com_id')");
                $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
                $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

                for ($i = 0; $i < $cou1; $i++) {
                    $inser_tk = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`,
                                            `so_tk`, `chu_tk`) VALUES ('','$id_ptt','$ten_nganhang[$i]','$chi_nhanh[$i]','$so_tk[$i]','$chu_taik[$i]')");
                }

                $inser_vt = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                    `id_cong_ty`) VALUES ('','$id_ptt','$hdong_dhang','$id_hs','$tien_ttoan','$com_id')");

                $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
                $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");
            }
        }
    } else if ($hinh_thuc_tt == 1) {
        if ($lthanh_toan == 1) {
            $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien_tam_ung`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `id_cong_ty`) VALUES ('','$hdong_dhang', '$id_ncc_kh','$loai_ptt','$ngay_ttoan','$hinh_thuc_tt','$lthanh_toan',
                                '$nguoi_ntien','$so_tien','$ty_gia','$phi_giaod','$gia_quydoi','$phan_loai',1,'$ngay_tao','','$user_id','$com_id')");

            $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
            $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

            $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
            $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");


        } else if ($lthanh_toan == 2) {
            $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien_tam_ung`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `id_cong_ty`) VALUES ('','$hdong_dhang','$id_ncc_kh','$loai_ptt','$ngay_ttoan','$hinh_thuc_tt',
                                '$lthanh_toan', '$nguoi_ntien','','','$phi_giaod','','$phan_loai',1,'$ngay_tao','','$user_id','$com_id')");

            $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
            $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

            $inser_vt = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                    `id_cong_ty`) VALUES ('','$id_ptt','$hdong_dhang','$id_hs','$tien_ttoan','$com_id')");

            $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
            $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");


        }
    }
}else{
    echo "Bạn thêm phiếu thanh toán không thành công";
}
