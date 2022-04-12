<?
include("config.php");
$id_ncc_kh = getValue('id_ncc_kh', 'int', 'POST', '');
$ten_nha_cc_kh = $_POST['ten_nha_cc_kh'];
$ten_vt = $_POST['ten_vt'];
$ten_giao_dich = $_POST['ten_giao_dich'];
$ma_so_thue = $_POST['ma_so_thue'];
$dia_chi_dkkd = $_POST['dia_chi_dkkd'];
$so_dkkd = $_POST['so_dkkd'];
$dia_chi_lh = $_POST['dia_chi_lh'];
$fax = $_POST['fax'];
$so_dien_thoai = $_POST['so_dien_thoai'];
$website = $_POST['website'];
$email = $_POST['email'];
$sp_cung_ung = $_POST['sp_cung_ung'];
$thong_tin_khac = $_POST['thong_tin_khac'];

// ngan  hang cu
$id_ngan_hang_old = $_POST['id_ngan_hang_old'];
$ten_ngan_hang_old = $_POST['ten_ngan_hang_old'];
$ten_chi_nhanh_old = $_POST['ten_chi_nhanh_old'];
$so_tk_old = $_POST['so_tk_old'];
$chu_tk_old  = $_POST['chu_tk_old'];

$count_nh_o_1 = count($id_ngan_hang_old);
$count_nh_o_2 = count($ten_ngan_hang_old);
$count_nh_o_3 = count($ten_chi_nhanh_old);
$count_nh_o_4 = count($so_tk_old);

// ngan hang moi
$ten_ngan_hang = $_POST['ten_ngan_hang'];
$ten_chi_nhanh = $_POST['ten_chi_nhanh'];
$so_tk = $_POST['so_tk'];
$chu_tk  = $_POST['chu_tk'];

$count_nh_n_1 = count($ten_ngan_hang);
$count_nh_n_2 = count($ten_chi_nhanh);
$count_nh_n_3 = count($so_tk);

// nguoi lien he cu
$id_nguoi_lh_old = $_POST['id_nguoi_lh_old'];
$ten_nguoi_lh_old = $_POST['ten_nguoi_lh_old'];
$chuc_vu_old = $_POST['chuc_vu_old'];
$so_dien_thoai_lh_old = $_POST['so_dien_thoai_lh_old'];
$email_lh_old = $_POST['email_lh_old'];

$count_nlh_o_1 = count($id_nguoi_lh_old);
$count_nlh_o_2 = count($ten_nguoi_lh_old);
$count_nlh_o_3 = count($so_dien_thoai_lh_old);
$count_nlh_o_4 = count($email_lh_old);

// nguoi lien he moi
$ten_nguoi_lh = $_POST['ten_nguoi_lh'];
$chuc_vu = $_POST['chuc_vu'];
$so_dien_thoai_lh = $_POST['so_dien_thoai_lh'];
$email_lh = $_POST['email_lh'];

$count_nlh_n_1 = count($ten_nguoi_lh);
$count_nlh_n_2 = count($so_dien_thoai_lh);
$count_nlh_n_3 = count($email_lh);

$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$role = getValue('role','int', 'POST', '');

$ngay_sua = strtotime(date('Y-m-d', time()));

if ($ten_nha_cc_kh != "" && $ten_giao_dich != "") {
    if($count_nh_o_1 == 0 && $count_nh_n_1 == 0){
        echo "Thêm ít nhất 1 tài khoản ngân hàng";
    }else if($count_nlh_o_1 == 0 && $count_nlh_n_1 == 0){
        echo "Thêm ít nhất 1 người liên hệ nhà cung cấp";
    }
    else if($count_nh_o_1 > 0 && $count_nh_n_1 == 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 == 0){
        if($count_nh_o_1 != $count_nh_o_2 || $count_nh_o_2 != $count_nh_o_3 || $count_nh_o_3 != $count_nh_o_4 || $count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nh_o_1 == $count_nh_o_2 && $count_nh_o_2 == $count_nh_o_3 && $count_nh_o_3 == $count_nh_o_4 && $count_nlh_o_1 == $count_nlh_o_2 && $count_nlh_o_2 == $count_nlh_o_3 && $count_nlh_o_3 == $count_nlh_o_4){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($i = 0; $i < $count_nlh_o_1; $i++) {
                $nguoi_lh_old = new db_query("UPDATE `nguoi_lien_he` SET `ten_nguoi_lh`='$ten_nguoi_lh_old[$i]', `chuc_vu`='$chuc_vu_old[$i]',
                                        `so_dien_thoai`='$so_dien_thoai_lh_old[$i]', `email`='$email_lh_old[$i]' WHERE `id` = '$id_nguoi_lh_old[$i]' ");
            }

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($count_nh_o_1 > 0 && $count_nh_n_1 > 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 == 0){
        if($count_nh_o_1 != $count_nh_o_2 || $count_nh_o_2 != $count_nh_o_3 || $count_nh_o_3 != $count_nh_o_4 || $count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4 || $count_nh_n_1 != $count_nh_n_2 || $count_nh_n_2 != $count_nh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nh_o_1 == $count_nh_o_2 && $count_nh_o_2 == $count_nh_o_3 && $count_nh_o_3 == $count_nh_o_4 && $count_nlh_o_1 == $count_nlh_o_2 && $count_nlh_o_2 == $count_nlh_o_3 && $count_nlh_o_3 == $count_nlh_o_4 && $count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($k = 0; $k < $count_nh_n_1; $k++) {
                $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$k]','$ten_chi_nhanh[$k]','$so_tk[$k]','$chu_tk[$k]')");
            }

            for ($i = 0; $i < $count_nlh_o_1; $i++) {
                $nguoi_lh_old = new db_query("UPDATE `nguoi_lien_he` SET `ten_nguoi_lh`='$ten_nguoi_lh_old[$i]', `chuc_vu`='$chuc_vu_old[$i]',
                                        `so_dien_thoai`='$so_dien_thoai_lh_old[$i]', `email`='$email_lh_old[$i]' WHERE `id` = '$id_nguoi_lh_old[$i]' ");
            }

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($count_nh_o_1 == 0 && $count_nh_n_1 > 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 == 0){
        if($count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4 || $count_nh_n_1 != $count_nh_n_2 || $count_nh_n_2 != $count_nh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nlh_o_1 == $count_nlh_o_2 && $count_nlh_o_2 == $count_nlh_o_3 && $count_nlh_o_3 == $count_nlh_o_4 && $count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($k = 0; $k < $count_nh_n_1; $k++) {
                $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$k]','$ten_chi_nhanh[$k]','$so_tk[$k]','$chu_tk[$k]')");
            }

            for ($i = 0; $i < $count_nlh_o_1; $i++) {
                $nguoi_lh_old = new db_query("UPDATE `nguoi_lien_he` SET `ten_nguoi_lh`='$ten_nguoi_lh_old[$i]', `chuc_vu`='$chuc_vu_old[$i]',
                                        `so_dien_thoai`='$so_dien_thoai_lh_old[$i]', `email`='$email_lh_old[$i]' WHERE `id` = '$id_nguoi_lh_old[$i]' ");
            }

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($count_nh_o_1 == 0 && $count_nh_n_1 > 0 && $count_nlh_o_1 == 0 && $count_nlh_n_1 > 0){
        if($count_nh_n_1 != $count_nh_n_2 || $count_nh_n_2 != $count_nh_n_3 || $count_nlh_n_1 != $count_nlh_n_2 || $count_nlh_n_2 != $count_nlh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3 && $count_nlh_n_1 == $count_nlh_n_2 && $count_nlh_n_2 == $count_nlh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($k = 0; $k < $count_nh_n_1; $k++) {
                $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$k]','$ten_chi_nhanh[$k]','$so_tk[$k]','$chu_tk[$k]')");
            };

            for ($l = 0; $l < $count_nlh_n_1; $l++) {
                $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`)
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$l]', '$chuc_vu[$l]', '$so_dien_thoai_lh[$l]', '$email_lh[$l]')");
            };

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($count_nh_o_1 == 0 && $count_nh_n_1 > 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 > 0){
        if($count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4 || $count_nh_n_1 != $count_nh_n_2 || $count_nh_n_2 != $count_nh_n_3 || $count_nlh_n_1 != $count_nlh_n_2 || $count_nlh_n_2 != $count_nlh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nlh_o_1 == $count_nlh_o_2 && $count_nlh_o_2 == $count_nlh_o_3 && $count_nlh_o_3 == $count_nlh_o_4 && $count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3 && $count_nlh_n_1 == $count_nlh_n_2 && $count_nlh_n_2 == $count_nlh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };


            for ($k = 0; $k < $count_nh_n_1; $k++) {
                $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$k]','$ten_chi_nhanh[$k]','$so_tk[$k]','$chu_tk[$k]')");
            };

            for ($l = 0; $l < $count_nlh_n_1; $l++) {
                $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`)
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$l]', '$chuc_vu[$l]', '$so_dien_thoai_lh[$l]', '$email_lh[$l]')");
            };

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    }else if($count_nh_o_1 > 0 && $count_nh_n_1 > 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 > 0){
        if($count_nh_o_1 != $count_nh_o_2 || $count_nh_o_2 != $count_nh_o_3 || $count_nh_o_3 != $count_nh_o_4 || $count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4 || $count_nh_n_1 != $count_nh_n_2 || $count_nh_n_2 != $count_nh_n_3 || $count_nlh_n_1 != $count_nlh_n_2 || $count_nlh_n_2 != $count_nlh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nh_o_1 == $count_nh_o_2 && $count_nh_o_2 == $count_nh_o_3 && $count_nh_o_3 == $count_nh_o_4 && $count_nlh_o_1 == $count_nlh_o_2 && $count_nlh_o_2 == $count_nlh_o_3 && $count_nlh_o_3 == $count_nlh_o_4 && $count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3 && $count_nlh_n_1 == $count_nlh_n_2 && $count_nlh_n_2 == $count_nlh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };


            for ($k = 0; $k < $count_nh_n_1; $k++) {
                $tk_ncc_new = new db_query("INSERT INTO `tai_khoan`(`id`, `id_nha_cc_kh`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`)
                            VALUES ('','$id_ncc_kh','$ten_ngan_hang[$k]','$ten_chi_nhanh[$k]','$so_tk[$k]','$chu_tk[$k]')");
            };

            for ($l = 0; $l < $count_nlh_n_1; $l++) {
                $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`)
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$l]', '$chuc_vu[$l]', '$so_dien_thoai_lh[$l]', '$email_lh[$l]')");
            };

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }

    } else if ($count_nh_o_1 > 0 && $count_nh_n_1 == 0 && $count_nlh_o_1 == 0 && $count_nlh_n_1 > 0) {
        if($count_nh_o_1 != $count_nh_o_2 || $count_nh_o_2 != $count_nh_o_3 || $count_nh_o_3 != $count_nh_o_4 || $count_nlh_n_1 != $count_nlh_n_2 || $count_nlh_n_2 != $count_nlh_n_3){
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        }else if($count_nh_o_1 == $count_nh_o_2 && $count_nh_o_2 == $count_nh_o_3 && $count_nh_o_3 == $count_nh_o_4 && $count_nlh_n_1 == $count_nlh_n_2 && $count_nlh_n_2 == $count_nlh_n_3){
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($l = 0; $l < $count_nlh_n_1; $l++) {
                $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`)
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$l]', '$chuc_vu[$l]', '$so_dien_thoai_lh[$l]', '$email_lh[$l]')");
            };

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    } else if ($count_nh_o_1 > 0 && $count_nh_n_1 == 0 && $count_nlh_o_1 > 0 && $count_nlh_n_1 > 0) {
        if ($count_nh_o_1 != $count_nh_o_2 || $count_nh_o_2 != $count_nh_o_3 || $count_nh_o_3 != $count_nh_o_4 || $count_nlh_o_1 != $count_nlh_o_2 || $count_nlh_o_2 != $count_nlh_o_3 || $count_nlh_o_3 != $count_nlh_o_4 || $count_nlh_n_1 != $count_nlh_n_2 || $count_nlh_n_2 != $count_nlh_n_3) {
            echo "Điền đầy đủ thông tin tài khoản ngân hàng, người liên hệ";
        } else if ($count_nh_o_1 == $count_nh_o_2 && $count_nh_o_2 == $count_nh_o_3 && $count_nh_o_3 == $count_nh_o_4 &&$count_nh_n_1 == $count_nh_n_2 && $count_nh_n_2 == $count_nh_n_3 && $count_nlh_n_1 == $count_nlh_n_2 && $count_nlh_n_2 == $count_nlh_n_3) {
            $sua_ncc = new db_query("UPDATE `nha_cc_kh` SET `ten_vt` = '$ten_vt', `ten_nha_cc_kh` = '$ten_nha_cc_kh' ,
                                    `ma_so_thue` = '$ma_so_thue' ,`ten_giao_dich` = '$ten_giao_dich' , `dia_chi_dkkd` = '$dia_chi_dkkd',
                                    `so_dkkd` = '$so_dkkd', `dia_chi_lh` = '$dia_chi_lh', `fax` = '$fax', `so_dien_thoai` = '$so_dien_thoai',
                                    `website` = '$website', `email` = '$email', `sp_cung_ung` = '$sp_cung_ung',
                                    `thong_tin_khac` = '$thong_tin_khac', `ngay_sua` = '$ngay_sua' WHERE `id` = '$id_ncc_kh'");

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($j = 0; $j < $count_nh_o_1; $j++) {
                $tk_ncc_old = new db_query("UPDATE `tai_khoan` SET `ten_ngan_hang`='$ten_ngan_hang_old[$j]',`ten_chi_nhanh`='$ten_chi_nhanh_old[$j]',
                                            `so_tk`='$so_tk_old[$j]',`chu_tk`='$chu_tk_old[$j]' WHERE `id` = '$id_ngan_hang_old[$j]' ");
            };

            for ($l = 0; $l < $count_nlh_n_1; $l++) {
                $nguoi_lh_new = new db_query("INSERT INTO `nguoi_lien_he` (`id`, `id_nha_cc`, `ten_nguoi_lh`, `chuc_vu`, `so_dien_thoai`, `email`)
                            VALUES ('', '$id_ncc_kh ', '$ten_nguoi_lh[$l]', '$chuc_vu[$l]', '$so_dien_thoai_lh[$l]', '$email_lh[$l]')");
            };

            $noi_dung = 'Bạn đã sửa nhà cung cấp: ' . $ten_nha_cc_kh . '. Mã: NCC-' . $id_ncc_kh;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$role', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }


} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
