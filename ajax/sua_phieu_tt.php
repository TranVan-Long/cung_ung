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
$so_tien_ctra = $_POST['so_tien_ctra'];
$ho_so = getValue('ho_so', 'int', 'POST', '');
$phan_loai = getValue('phan_loai', 'int', 'POST', '');
$id_pctiet = getValue('id_pctiet', 'int', 'POST', '');

$id_stk = $_POST['id_stk'];
$cou1 = count($id_stk);

$ten_nganhang = $_POST['ten_nganhang'];
$cou2 = count($ten_nganhang);

$chi_nhanh = $_POST['chi_nhanh'];
$cou3 = count($chi_nhanh);

$so_tk = $_POST['so_tk'];
$cou4 = count($so_tk);

$chu_tk = $_POST['chu_tk'];

$new_tngan_hang = $_POST['new_tngan_hang'];
$co1 = count($new_tngan_hang);

$new_chi_nhanh = $_POST['new_chi_nhanh'];
$co2 = count($new_chi_nhanh);

$new_so_tk = $_POST['new_so_tk'];
$co3 = count($new_so_tk);

$ngay_sua = strtotime(date('Y-m-d', time()));

$new_chu_tk = $_POST['new_chu_tk'];

if($com_id != "" && $user_id != "" && $id_phieu != ""){
    if($hinh_thuc_tt == 2 || $hinh_thuc_tt == 3){
        if ($cou1 > 0 && $co1 == 0) {
            if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4) {
                echo "Điền đầy đủ thông tin tài khoản";
            } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4) {
                if($lthanh_toan == 1){
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for($i = 0; $i < $cou1; $i++){
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                }else if($lthanh_toan == 2){
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                    $upd_ctiet = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `id_hs`='$ho_so',`da_thanh_toan`='$so_tien_ctra'
                                             WHERE `id_cong_ty` = $com_id AND `id` = $id_pctiet ");
                }
            }
        } else if ($cou1 == 0 && $co1 > 0) {
            if ($co1 != $co2 || $co2 != $co3) {
                echo "Điền đầy đủ thông tin tài khoản";
            } else if ($co1 == $co2 && $co2 == $co3) {
                if ($lthanh_toan == 1) {
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$i]','$new_chi_nhanh[$i]','$new_so_tk[$i]','$new_chu_tk[$i]')");
                    }

                } else if ($lthanh_toan == 2) {
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                    $upd_ctiet = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `id_hs`='$ho_so',`da_thanh_toan`='$so_tien_ctra'
                                             WHERE `id_cong_ty` = $com_id AND `id` = $id_pctiet ");
                }
            }
        } else if ($cou1 > 0 && $co1 > 0) {
            if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4 || $co1 != $co2 || $co2 != $co3) {
                echo "Điền đầy đủ thông tin tài khoản";
            } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4 && $co1 == $co2 && $co2 == $co3) {
                if ($lthanh_toan == 1) {
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                    for ($j = 0; $j < $cou1; $j++) {
                        $tai_khoan = new db_query("INSERT INTO `tai_khoan_thanh_toan`(`id`, `id_phieu_tt`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`,
                                        `chu_tk`) VALUES ('','$id_phieu','$new_tngan_hang[$j]','$new_chi_nhanh[$j]','$new_so_tk[$j]','$new_chu_tk[$j]')");
                    }

                } else if ($lthanh_toan == 2) {
                    $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                    for ($i = 0; $i < $cou1; $i++) {
                        $tai_khoan = new db_query("UPDATE `tai_khoan_thanh_toan` SET `ten_ngan_hang`='$ten_nganhang[$i]',`ten_chi_nhanh`='$chi_nhanh[$i]',
                                                `so_tk`='$so_tk[$i]',`chu_tk`='$chu_tk[$i]' WHERE `id` = $id_stk[$i] ");
                    }

                    $upd_ctiet = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `id_hs`='$ho_so',`da_thanh_toan`='$so_tien_ctra'
                                             WHERE `id_cong_ty` = $com_id AND `id` = $id_pctiet ");
                }
            }
        }
    }else if($hinh_thuc_tt == 1){
        if ($lthanh_toan == 1) {
            $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='$so_tien_tu',`ty_gia`='$ty_gia',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='$gia_quy_doi',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");
        } else if ($lthanh_toan == 2) {
            $upd_phieu = new db_query("UPDATE `phieu_thanh_toan` SET `id_hd_dh`='$hdong_dhang',`id_ncc_kh`='$id_ncc_kh',`loai_phieu_tt`='$loai_ptt',
                                            `ngay_thanh_toan`='$ngay_tt',`hinh_thuc_tt`='$hinh_thuc_tt',`loai_thanh_toan`='$lthanh_toan',
                                            `nguoi_nhan_tien`='$nguoi_ntien',`so_tien_tam_ung`='',`ty_gia`='',`phi_giao_dich`='$phi_giaod',
                                            `gia_tri_quy_doi`='',`phan_loai`='$phan_loai',`trang_thai`='1',`ngay_chinh_sua`='$ngay_sua'
                                            WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id ");

            $upd_ctiet = new db_query("UPDATE `chi_tiet_phieu_tt_vt` SET `id_hs`='$ho_so',`da_thanh_toan`='$so_tien_ctra'
                                             WHERE `id_cong_ty` = $com_id AND `id` = $id_pctiet ");
        }
    }

}else{
    echo "Bạn cập nhật phiếu thanh toán thất bại, vui lòng thử lại!";
}

?>