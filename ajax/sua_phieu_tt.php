<?
include('config.php');
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_phieu = getValue('id_phieu', 'int', 'POST', '');
$loai_ptt = getValue('loai_ptt', 'int', 'POST', '');

$hdong_dhang = getValue('hdong_dhang', 'int', 'POST', '');
$id_ncc_kh = getValue('id_ncc_kh', 'int', 'POST', '');
if($_POST['ngay_tt'] == ""){
    $ngay_tt = 0;
} else{
    $ngay_tt = strtotime($_POST['ngay_tt']);
};
$hinh_thuc_tt = getValue('hinh_thuc_tt', 'int', 'POST', '');
$lthanh_toan = getValue('lthanh_toan', 'int', 'POST', '');
$so_tien_tu = $_POST['so_tien_tu'];
$ty_gia = $_POST['ty_gia'];
$gia_quy_doi = $_POST['gia_quy_doi'];
$phi_giaod = $_POST['phi_giaod'];
$nguoi_ntien = $_POST['nguoi_ntien'];
$phan_loai = getValue('phan_loai', 'int', 'POST', '');

$new_tngan_hang = $_POST['new_tngan_hang'];
$co1 = count($new_tngan_hang);


$new_chi_nhanh = $_POST['new_chi_nhanh'];
$co2 = count($new_chi_nhanh);

$new_so_tk = $_POST['new_so_tk'];
$co3 = count($new_so_tk);

$ngay_sua = strtotime(date('Y-m-d', time()));

$new_chu_tk = $_POST['new_chu_tk'];

$id_ctp = $_POST['id_ctp'];
$coun1 = count($id_ctp);
$id_hs = $_POST['id_hs'];
$coun2 = count($id_hs);
$tien_ttoan = $_POST['tien_ttoan'];
$tong_tien = $_POST['tong_tien'];
$tongt_thanhtoan = $_POST['tongt_thanhtoan'];
$tong_tien_tatca_tr = $_POST['tong_tien_tatca_tr'];

if($lthanh_toan == 2){
    if($tong_tien_tatca_tr == $tongt_thanhtoan){
        $trang_thai = 2;
    }else{
        $trang_thai = 1;
    }
}


if($com_id != "" && $user_id != "" && $id_phieu != "" && $lthanh_toan != "" && $loai_ptt != ""){
    $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_hd_dh` = $hdong_dhang AND `id_cong_ty` = $com_id
                                AND `loai_phieu_tt` = $loai_ptt ");
    if(mysql_num_rows($check_tt -> result) > 0){
        $all_phieu = mysql_fetch_assoc((new db_query("SELECT `loai_thanh_toan` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu
                                        AND `id_hd_dh` = $hdong_dhang AND `id_cong_ty` = $com_id AND `loai_phieu_tt` = $loai_ptt ")) -> result);
        $loai_thanh_toan = $all_phieu['loai_thanh_toan'];
        if ($hinh_thuc_tt == 2 || $hinh_thuc_tt == 3) {
            if ($co1 > 0) {
                if ($co1 != $co2 || $co2 != $co3) {
                    echo "Điền đầy đủ thông tin tài khoản";
                } else if ($co1 == $co2 && $co2 == $co3) {
                    if ($lthanh_toan == 1) {

                        $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                        if(mysql_num_rows($check_ttt -> result) > 0){
                            $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        }else{

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        }

                        $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                        if ($lthanh_toan != $loai_thanh_toan) {
                            $dele_phieu = new db_query("DELETE FROM `chi_tiet_phieu_tt_vt` WHERE `id_phieu_tt` = $id_phieu AND `id_cong_ty` = $com_id ");
                        }

                    } else if ($lthanh_toan == 2) {

                        $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                        if (mysql_num_rows($check_ttt->result) > 0) {
                            $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        } else {
                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        }

                        $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$tongt_thanhtoan',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='$trang_thai',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                        if ($lthanh_toan == $loai_thanh_toan) {
                            for ($a = 0; $a < $coun1; $a++) {
                                if ($tien_ttoan[$a] >= $tong_tien[$a]) {
                                    $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                                } else {
                                    $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 1 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                                }

                                $updat_phieuct = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `da_thanh_toan`= $tien_ttoan[$a] WHERE `id` = $id_ctp[$a] AND `id_cong_ty` = $com_id ");
                            }
                        } else {
                            for ($a = 0; $a < $coun2; $a++) {
                                if ($tien_ttoan[$a] >= $tong_tien[$a]) {
                                    $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                                } else {
                                    $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 1 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                                }

                                $updat_phieuct = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                                        `id_cong_ty`) VALUES ('','$id_phieu','$hdong_dhang','$id_hs[$a]','$tien_ttoan[$a]','$com_id')");
                            }
                        }
                    }
                }
            }else{
                echo "Điền đầy đủ thông tin tài khoản";
            }
        } else if ($hinh_thuc_tt == 1) {
            if ($lthanh_toan == 1) {

                $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                if (mysql_num_rows($check_ttt->result) > 0) {
                    $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                }

                $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");
                if($lthanh_toan != $loai_thanh_toan){
                    $dele_phieu = new db_query("DELETE FROM `chi_tiet_phieu_tt_vt` WHERE `id_phieu_tt` = $id_phieu AND `id_cong_ty` = $com_id ");
                }

            } else if ($lthanh_toan == 2) {

                $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                if (mysql_num_rows($check_ttt->result) > 0) {
                    $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                }

                $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$tongt_thanhtoan',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='$trang_thai',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                if($lthanh_toan == $loai_thanh_toan){
                    for($a = 0; $a < $coun1; $a++){
                        if ($tien_ttoan[$a] >= $tong_tien[$a]) {
                            $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                        } else if($tien_ttoan[$a] < $tong_tien[$a]) {
                            $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 1 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                        }
                        $updat_phieuct = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `da_thanh_toan`= $tien_ttoan[$a] WHERE `id` = $id_ctp[$a] AND `id_cong_ty` = $com_id ");
                    }
                }else{
                    for ($a = 0; $a < $coun2; $a++) {
                        if ($tien_ttoan[$a] >= $tong_tien[$a]) {
                            $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                        } else if ($tien_ttoan[$a] < $tong_tien[$a]) {
                            $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 1 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                        }

                        $updat_phieuct = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                                        `id_cong_ty`) VALUES ('','$id_phieu','$hdong_dhang','$id_hs[$a]','$tien_ttoan[$a]','$com_id')");
                    }
                }
            }
        }
    }else{
        if ($hinh_thuc_tt == 2 || $hinh_thuc_tt == 3) {
            if ($co1 > 0) {
                if ($co1 != $co2 || $co2 != $co3) {
                    echo "Điền đầy đủ thông tin tài khoản";
                } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $co1 == $co2 && $co2 == $co3) {
                    if ($lthanh_toan == 1) {

                        $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                        if (mysql_num_rows($check_ttt->result) > 0) {
                            $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        } else {

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        }
                        $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    } else if ($lthanh_toan == 2) {

                        $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                        if (mysql_num_rows($check_ttt->result) > 0) {
                            $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        } else {

                            for ($j = 0; $j < $co1; $j++) {
                                $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                            }
                        }

                        $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$tongt_thanhtoan',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                        for ($a = 0; $a < $coun2; $a++) {
                            $updat_phieuct = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                                        `id_cong_ty`) VALUES ('','$id_phieu','$hdong_dhang','$id_hs[$a]','$tien_ttoan[$a]','$com_id')");
                        }
                    }
                }
            }else{
                echo "Điền đầy đủ thông tin tài khoản";
            }
        } else if ($hinh_thuc_tt == 1) {
            if ($lthanh_toan == 1) {
                $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                if (mysql_num_rows($check_ttt->result) > 0) {
                    $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                }

                $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");
            } else if ($lthanh_toan == 2) {
                $check_ttt = new db_query("SELECT `id` FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                if (mysql_num_rows($check_ttt->result) > 0) {
                    $dlete_tt = new db_query("DELETE FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu ");
                }
                $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien`='$tongt_thanhtoan',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");
                for ($a = 0; $a < $coun2; $a++) {

                    if ($tien_ttoan[$a] >= $tong_tien[$a]) {
                        $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 2 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                    } else {
                        $upda_hs = new db_query("UPDATE `ho_so_thanh_toan` SET `trang_thai`= 1 WHERE `id` = $id_hs[$a] AND `id_cong_ty` = $com_id ");
                    }

                    $updat_phieuct = new db_query("INSERT INTO `chi_tiet_phieu_tt_vt`(`id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`,
                                                        `id_cong_ty`) VALUES ('','$id_phieu','$hdong_dhang','$id_hs[$a]','$tien_ttoan[$a]','$com_id')");
                }
            }
        }
    }
}else{
    echo "Bạn cập nhật phiếu thanh toán thất bại, vui lòng thử lại!";
}

?>