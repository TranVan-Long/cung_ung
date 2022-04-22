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
$nguoi_ntien = sql_injection_rp($nguoi_ntien);
$so_tien = $_POST['so_tien'];
$ty_gia = getValue('ty_gia', 'flo', 'POST', '');
$gia_quydoi = $_POST['gia_quydoi'];

$phan_loai = getValue('ploai', 'int', 'POST', '');

$ten_nganhang = $_POST['ten_nganhang'];
$cou1 = count($ten_nganhang);

$chi_nhanh = $_POST['chi_nhanh'];
$cou2 = count($chi_nhanh);

$so_tk = $_POST['so_tk'];
$cou3 = count($so_tk);

$chu_taik = $_POST['chu_taik'];

$id_hs = $_POST['id_hs'];
$co1 = count($id_hs);

$tong_tien = $_POST['tong_tien'];
$co2 = count($tong_tien);

$tien_ttoan = $_POST['tien_ttoan'];
$tongt_thanhtoan = $_POST['tongt_thanhtoan'];

$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$ngay_tao_phieu = strtotime(date('Y-m-d',time()));

$ngay_tao = strtotime(date('Y-m-d', time()));

$gio_tao_nk = strtotime(date('H:i:s', time()));

$tong_tien_tatca_tr = $_POST['tong_tien_tatca_tr'];
if($lthanh_toan == 2){
    if($tong_tien_tatca_tr == $so_tien){
        $trang_thai = 2;
    }else if($tong_tien_tatca_tr != $so_tien){
        $trang_thai = 1;
    }
}

$tongtien_ck = 0;
$tongtien_hs = 0;

if($com_id != "" && $user_id != "" && $loai_ptt != "" && $hdong_dhang != "" && $lthanh_toan != "" && $hinh_thuc_tt != "" && $co1 == $co2){
    if ($hinh_thuc_tt == 2 || $hinh_thuc_tt == 3) {
        if($cou1 > 0){
            if ($cou1 != $cou2 || $cou2 != $cou3) {
                echo "Điền đẩy đủ thông tin tài khoản ngân hàng";
            } else if ($cou1 == $cou2 && $cou2 == $cou3) {
                if ($lthanh_toan == 1) {
                    $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`,
                                `hinh_thuc_tt`, `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`,
                                `phan_loai`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `quyen_nlap`, `id_cong_ty`)
                                VALUES ('','$hdong_dhang', '$id_ncc_kh','$loai_ptt','$ngay_ttoan',
                                '$hinh_thuc_tt','$lthanh_toan','$nguoi_ntien','$so_tien','$ty_gia','$phi_giaod','$gia_quydoi','$phan_loai',1,'$ngay_tao_phieu','0',
                                '$user_id','$phan_quyen_nk','$com_id')");

                    $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
                    $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

                    for ($i = 0; $i < $cou1; $i++) {
                        $inser_tk = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`,
                                            `so_tk`, `chu_tk`) VALUES ('','$id_ptt','$ten_nganhang[$i]','$chi_nhanh[$i]','$so_tk[$i]','$chu_taik[$i]')");
                    };

                    $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
                    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`,`id_cong_ty`)
                                        VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao_nk','$noi_dung_nk','$com_id')");
                } else if ($lthanh_toan == 2) {
                    $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`,
                                `hinh_thuc_tt`, `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`,
                                `phan_loai`, `trang_thai`, `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `quyen_nlap`, `id_cong_ty`)
                                VALUES ('','$hdong_dhang','$id_ncc_kh','$loai_ptt','$ngay_ttoan',
                                '$hinh_thuc_tt','$lthanh_toan','$nguoi_ntien','$tongt_thanhtoan','','$phi_giaod','',
                                '$phan_loai','$trang_thai','$ngay_tao_phieu','','$user_id','$phan_quyen_nk','$com_id')");

                    $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
                    $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

                    for ($i = 0; $i < $cou1; $i++) {
                        $inser_tk = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`,
                                            `so_tk`, `chu_tk`) VALUES ('','$id_ptt','$ten_nganhang[$i]','$chi_nhanh[$i]','$so_tk[$i]','$chu_taik[$i]')");
                    }


                    for ($j = 0; $j < $co1; $j++) {
                        if ($tien_ttoan[$j] == $tong_tien[$j]) {
                            $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$j] AND `id_cong_ty` = $com_id ");

                            $chiphi_khac = mysql_fetch_assoc((new db_query("SELECT `chi_phi_khac` FROM `ho_so_thanh_toan` WHERE `id` = $id_hs[$j]
                                            AND `id_cong_ty` = $com_id  ")) -> result)['chi_phi_khac'];
                            $tongtien_ck += $chiphi_khac;
                        }
                        $inser_vt = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                    `id_cong_ty`) VALUES ('','$id_ptt','$hdong_dhang','$id_hs[$j]','$tien_ttoan[$j]','$com_id')");
                    }

                    if($loai_ptt == 1){
                        $tongtien_hs = $tongt_thanhtoan - $tongtien_ck;
                        $tongtiens_vat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id` = $hdong_dhang
                                                                        AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
                        if($tongtien_hs == $tongtiens_vat){
                            $upda_hd = new db_query("UPDATE `hop_dong` SET `trang_thai`= 2 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                        }else if($tongtien_hs != $tongtiens_vat){
                            $upda_hd = new db_query("UPDATE `hop_dong` SET `trang_thai`= 1 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                        }
                    }else if($loai_ptt == 2){
                        $tongtien_hs = $tongt_thanhtoan - $tongtien_ck;
                        $tongtiens_vat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id` = $hdong_dhang
                                                            AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
                        if ($tongtien_hs == $tongtiens_vat) {
                            $upda_hd = new db_query("UPDATE `don_hang` SET `trang_thai`= 2 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                        } else if ($tongtien_hs != $tongtiens_vat) {
                            $upda_hd = new db_query("UPDATE `don_hang` SET `trang_thai`= 1 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                        }
                    }

                    $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
                    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`,`id_cong_ty`)
                                        VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao_nk','$noi_dung_nk','$com_id')");
                }
            }
        }else{
            echo "Điền đẩy đủ thông tin tài khoản ngân hàng";
        }

    } else if ($hinh_thuc_tt == 1) {
        if ($lthanh_toan == 1) {
            $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `quyen_nlap`, `id_cong_ty`) VALUES ('','$hdong_dhang', '$id_ncc_kh','$loai_ptt','$ngay_ttoan',
                                '$hinh_thuc_tt','$lthanh_toan','$nguoi_ntien','$so_tien','$ty_gia','$phi_giaod','$gia_quydoi','$phan_loai',1,'$ngay_tao_phieu','',
                                '$user_id','$phan_quyen_nk','$com_id')");

            $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
            $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

            $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
            $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");

        } else if ($lthanh_toan == 2) {
            $inser_tt = new db_query("INSERT INTO `phieu_thanh_toan`(`id`, `id_hd_dh`, `id_ncc_kh`, `loai_phieu_tt`, `ngay_thanh_toan`, `hinh_thuc_tt`,
                                `loai_thanh_toan`, `nguoi_nhan_tien`, `so_tien`, `ty_gia`, `phi_giao_dich`, `gia_tri_quy_doi`, `phan_loai`, `trang_thai`,
                                `ngay_tao`, `ngay_chinh_sua`, `id_nguoi_lap`, `quyen_nlap`, `id_cong_ty`) VALUES ('','$hdong_dhang','$id_ncc_kh','$loai_ptt','$ngay_ttoan','$hinh_thuc_tt',
                                '$lthanh_toan', '$nguoi_ntien','$tongt_thanhtoan','','$phi_giaod','','$phan_loai','$trang_thai','$ngay_tao_phieu','','$user_id','$phan_quyen_nk','$com_id')");

            $list_idp = new db_query("SELECT LAST_INSERT_ID() AS id_ptt");
            $id_ptt = mysql_fetch_assoc($list_idp->result)['id_ptt'];

            for ($j = 0; $j < $co1; $j++) {
                if ($tien_ttoan[$j] == $tong_tien[$j]) {
                    $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$j]  AND `id_cong_ty` = $com_id ");

                    $chiphi_khac = mysql_fetch_assoc((new db_query("SELECT `chi_phi_khac` FROM `ho_so_thanh_toan` WHERE `id` = $id_hs[$j]
                                            AND `id_cong_ty` = $com_id  "))->result)['chi_phi_khac'];
                    $tongtien_ck += $chiphi_khac;
                }

                $inser_vt = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                    `id_cong_ty`) VALUES ('','$id_ptt','$hdong_dhang','$id_hs[$j]','$tien_ttoan[$j]','$com_id')");
            }


            if ($loai_ptt == 1) {
                $tongtien_hs = $tongt_thanhtoan - $tongtien_ck;
                $tongtiens_vat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id` = $hdong_dhang
                                                                        AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
                if ($tongtien_hs == $tongtiens_vat) {
                    $upda_hd = new db_query("UPDATE `hop_dong` SET `trang_thai`= 2 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                } else if ($tongtien_hs != $tongtiens_vat) {
                    $upda_hd = new db_query("UPDATE `hop_dong` SET `trang_thai`= 1 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                }
            } else if ($loai_ptt == 2) {
                $tongtien_hs = $tongt_thanhtoan - $tongtien_ck;
                $tongtiens_vat = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id` = $hdong_dhang
                                                            AND `id_cong_ty` = $com_id "))->result)['gia_tri_svat'];
                if ($tongtien_hs == $tongtiens_vat) {
                    $upda_hd = new db_query("UPDATE `don_hang` SET `trang_thai`= 2 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                } else if ($tongtien_hs != $tongtiens_vat) {
                    $upda_hd = new db_query("UPDATE `don_hang` SET `trang_thai`= 1 WHERE `id` = $hdong_dhang AND `id_cong_ty` = $com_id ");
                }
            }

            $noi_dung_nk = "Bạn đã thêm phiếu thanh toán: " . $id_ptt;
            $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`, `gio_tao`, `noi_dung`)
                                        VALUES ('','$user_id','$phan_quyen_nk','$ngay_tao','$gio_tao_nk','$noi_dung_nk')");


        }
    }
}
else{
    echo "Bạn thêm phiếu thanh toán không thành công";
}
