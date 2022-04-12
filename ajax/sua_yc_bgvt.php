<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$id_bg = getValue('id_bg', 'int', 'POST', '');
$id_nha_cc = getValue('id_nha_cc', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');
$noi_dung = $_POST['noi_dung_thu'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$gui_mail = getValue('gui_mail', 'int', 'POST', '');

$gia_baog_vat = getValue('gia_baog_vat', 'int', 'POST', '');

$com_name = $_POST['com_name'];

$id_vatt = $_POST['id_vatt'];
$cou = count($id_vatt);

$ma_vt = $_POST['ma_vt'];
$cou1 = count($ma_vt);

$so_luong = $_POST['so_luong'];
$cou2 = count($so_luong);

$new_ma_vt = $_POST['new_ma_vt'];
$co1 = count($new_ma_vt);

$new_sl = $_POST['new_sl'];
$co2 = count($new_sl);

$noi_dung_thu = "Bạn đã sửa phiếu yêu cầu báo giá: BG - " . $id_bg;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($com_id != "" && $user_id != "" && $id_bg != "" && ($cou > 0 || $co1 > 0)) {
    if($gui_mail == 1){
        $check_mail_g = new db_query("SELECT `email` FROM `nha_cc_kh` WHERE `id` = $id_nha_cc AND `phan_loai` = 1 AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($check_mail_g->result) > 0) {
            if ($cou > 0 && $co1 == 0) {
                if ($cou != $cou1 || $cou1 != $cou2) {
                    echo "Điền đầy đủ thông tin vật tư";
                } else if ($cou == $cou1 && $cou1 == $cou2) {
                    $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou; $i++) {
                        $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
                    };

                    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`, `id_cong_ty`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu', '$com_id')");

                    // gui mail
                    $ctiet_ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`, `email` FROM `nha_cc_kh` WHERE `id` = $id_nha_cc AND `phan_loai` = 1
                                                        AND `id_cong_ty` = $com_id "))->result);
                    $email = $ctiet_ncc['email'];
                    $ten_nha_cc_kh = $ctiet_ncc['ten_nha_cc_kh'];
                    $curl = curl_init();
                    $data = array(
                        'id_com' => $com_id,
                    );
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    $response1 = curl_exec($curl);
                    curl_close($curl);

                    $list_vttb = json_decode($response1, true);
                    $data_vttb = $list_vttb['data']['items'];

                    $vat_tu = [];
                    for ($j = 0; $j < count($data_vttb); $j++) {
                        $item2 = $data_vttb[$j];
                        $vat_tu[$item2['dsvt_id']] = $item2;
                    }

                    $stt = 1;
                    $gm = "";

                    for ($a = 0; $a < $cou; $a++) {
                        $gm .= '<tr style="border: 1px solid #666666;">
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$ma_vt[$a]]['dsvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$ma_vt[$a]]['dvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $so_luong[$a] . '</td>
                                </tr>';
                    }
                    $mailer = new Mailer();
                    $subject = "YÊU CẦU BÁO GIÁ";
                    $body = '<div style="width: 724px;float: left;background: #FFFFFF;padding: 90px 40px;border-radius: 8px;">
                            <p style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747">
                                CÔNG TY  ' . $com_name . '</p>
                            <p style="width: 100%; float: left; margin-bottom: 23px; font-size: 14px; line-height: 16px; color: #474747">
                                Số: BG-' . $id_bg . '</p>
                            <h1 style="width: 100%; float: left; text-align: center; font-size: 24px; line-height: 28px; margin-bottom:14px">THƯ YÊU CẦU BÁO GIÁ</h1>
                            <p style="width: 100%; float: left; text-align: center; margin-bottom: 25px; font-size: 14px; line-height: 16px; color: #474747">Kính gửi: <span style="font-weight: 500">' . $ten_nha_cc_kh . '</span></p>
                            <div style="width: 100%; float: left;">
                                <p style="width:100%; float:left; margin-bottom:18px; font-size: 14px; line-height: 16px; color: #474747"> Nội dung: ' . $noi_dung . '</p>
                                <table style="width: 100%; float: left; border-collapse: collapse;">
                                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                                        <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                                        <th style="width: 53%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                                        <th style="width: 20%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent">Số lượng</th>
                                    </tr>' . $gm . '
                                </table>
                                <p style="margin-top: 20px;width: 100%;float: left;margin-bottom: 20px;"></p>
                                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747;">Mail nhận: ' . $mail_nhan_bg . '</h4>
                            </div>
                        </div>';

                    $mailer->email($email, $body, $subject, $name);
                }
            } else if ($cou == 0 && $co1 > 0) {
                if ($co1 != $co2) {
                    echo "Điền đầy đủ thông tin vật tư";
                } else if ($co1 == $co2) {
                    $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                    for ($j = 0; $j < $co1; $j++) {
                        $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
                    };

                    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu','$com_id')");

                    // gui mail
                    $ctiet_ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`, `email` FROM `nha_cc_kh` WHERE `id` = $id_nha_cc AND `phan_loai` = 1
                                                        AND `id_cong_ty` = $com_id "))->result);
                    $email = $ctiet_ncc['email'];
                    $ten_nha_cc_kh = $ctiet_ncc['ten_nha_cc_kh'];
                    $curl = curl_init();
                    $data = array(
                        'id_com' => $com_id,
                    );
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    $response1 = curl_exec($curl);
                    curl_close($curl);

                    $list_vttb = json_decode($response1, true);
                    $data_vttb = $list_vttb['data']['items'];

                    $vat_tu = [];
                    for ($j = 0; $j < count($data_vttb); $j++) {
                        $item2 = $data_vttb[$j];
                        $vat_tu[$item2['dsvt_id']] = $item2;
                    }

                    $stt = 1;
                    $gm = "";

                    for ($a = 0; $a < $co1; $a++) {
                        $gm .= '<tr style="border: 1px solid #666666;">
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$new_ma_vt[$a]]['dsvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$new_ma_vt[$a]]['dvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $new_sl[$a] . '</td>
                                </tr>';
                    }
                    $mailer = new Mailer();
                    $subject = "YÊU CẦU BÁO GIÁ";
                    $body = '<div style="width: 724px;float: left;background: #FFFFFF;padding: 90px 40px;border-radius: 8px;">
                            <p style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747">
                                CÔNG TY  ' . $com_name . '</p>
                            <p style="width: 100%; float: left; margin-bottom: 23px; font-size: 14px; line-height: 16px; color: #474747">
                                Số: BG-' . $id_bg . '</p>
                            <h1 style="width: 100%; float: left; text-align: center; font-size: 24px; line-height: 28px; margin-bottom:14px">THƯ YÊU CẦU BÁO GIÁ</h1>
                            <p style="width: 100%; float: left; text-align: center; margin-bottom: 25px; font-size: 14px; line-height: 16px; color: #474747">Kính gửi: <span style="font-weight: 500">' . $ten_nha_cc_kh . '</span></p>
                            <div style="width: 100%; float: left;">
                                <p style="width:100%; float:left; margin-bottom:18px; font-size: 14px; line-height: 16px; color: #474747"> Nội dung: ' . $noi_dung . '</p>
                                <table style="width: 100%; float: left; border-collapse: collapse;">
                                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                                        <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                                        <th style="width: 53%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                                        <th style="width: 20%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent">Số lượng</th>
                                    </tr>' . $gm . '
                                </table>
                                <p style="margin-top: 20px;width: 100%;float: left;margin-bottom: 20px;"></p>
                                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747;">Mail nhận: ' . $mail_nhan_bg . '</h4>
                            </div>
                        </div>';

                    $mailer->email($email, $body, $subject, $name);
                }
            } else if ($cou > 0 && $co1 > 0) {
                if ($cou != $cou1 || $cou1 != $cou2 || $co1 != $co2) {
                    echo "Điền đầy đủ thông tin vật tư";
                } else if ($cou == $cou1 && $cou1 == $cou2 && $co1 == $co2) {
                    $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                    for ($i = 0; $i < $cou; $i++) {
                        $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
                    };

                    for ($j = 0; $j < $co1; $j++) {
                        $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
                    };

                    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu','$com_id')");
                    // gui mail
                    $ctiet_ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`, `email` FROM `nha_cc_kh` WHERE `id` = $id_nha_cc AND `phan_loai` = 1
                                                        AND `id_cong_ty` = $com_id "))->result);
                    $email = $ctiet_ncc['email'];
                    $ten_nha_cc_kh = $ctiet_ncc['ten_nha_cc_kh'];
                    $curl = curl_init();
                    $data = array(
                        'id_com' => $com_id,
                    );
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    $response1 = curl_exec($curl);
                    curl_close($curl);

                    $list_vttb = json_decode($response1, true);
                    $data_vttb = $list_vttb['data']['items'];

                    $vat_tu = [];
                    for ($l = 0; $l < count($data_vttb); $l++) {
                        $item2 = $data_vttb[$l];
                        $vat_tu[$item2['dsvt_id']] = $item2;
                    }

                    $stt = 1;
                    $gm = "";

                    for ($b = 0; $b < $cou; $b++) {
                        $gm .= '<tr style="border: 1px solid #666666;">
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$ma_vt[$b]]['dsvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$ma_vt[$b]]['dvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $so_luong[$b] . '</td>
                                </tr>';
                    }

                    for ($a = 0; $a < $co1; $a++) {
                        $gm .= '<tr style="border: 1px solid #666666;">
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$new_ma_vt[$a]]['dsvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$new_ma_vt[$a]]['dvt_name'] . '</td>
                                    <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $new_sl[$a] . '</td>
                                </tr>';
                    }
                    $mailer = new Mailer();
                    $subject = "YÊU CẦU BÁO GIÁ";
                    $body = '<div style="width: 724px;float: left;background: #FFFFFF;padding: 90px 40px;border-radius: 8px;">
                            <p style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747">
                                CÔNG TY  ' . $com_name . '</p>
                            <p style="width: 100%; float: left; margin-bottom: 23px; font-size: 14px; line-height: 16px; color: #474747">
                                Số: BG-' . $id_bg . '</p>
                            <h1 style="width: 100%; float: left; text-align: center; font-size: 24px; line-height: 28px; margin-bottom:14px">THƯ YÊU CẦU BÁO GIÁ</h1>
                            <p style="width: 100%; float: left; text-align: center; margin-bottom: 25px; font-size: 14px; line-height: 16px; color: #474747">Kính gửi: <span style="font-weight: 500">' . $ten_nha_cc_kh . '</span></p>
                            <div style="width: 100%; float: left;">
                                <p style="width:100%; float:left; margin-bottom:18px; font-size: 14px; line-height: 16px; color: #474747"> Nội dung: ' . $noi_dung . '</p>
                                <table style="width: 100%; float: left; border-collapse: collapse;">
                                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                                        <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                                        <th style="width: 53%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                                        <th style="width: 20%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent">Số lượng</th>
                                    </tr>' . $gm . '
                                </table>
                                <p style="margin-top: 20px;width: 100%;float: left;margin-bottom: 20px;"></p>
                                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747;">Mail nhận: ' . $mail_nhan_bg . '</h4>
                            </div>
                        </div>';

                    $mailer->email($email, $body, $subject, $name);
                }
            }
        } else {
            echo "Nhà cung cấp chưa cập nhật địa chỉ email, vui lòng cập nhật địa chỉ email nhà cung cập để gửi mail yêu cầu báo giá";
        }
    }else{
        if ($cou > 0 && $co1 == 0) {
            if ($cou != $cou1 || $cou1 != $cou2) {
                echo "Điền đầy đủ thông tin vật tư";
            } else if ($cou == $cou1 && $cou1 == $cou2) {
                $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                for ($i = 0; $i < $cou; $i++) {
                    $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
                };

                $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
            }
        } else if ($cou == 0 && $co1 > 0) {
            if ($co1 != $co2) {
                echo "Điền đầy đủ thông tin vật tư";
            } else if ($co1 == $co2) {
                $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                for ($j = 0; $j < $co1; $j++) {
                    $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
                };

                $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
            }
        } else if ($cou > 0 && $co1 > 0) {
            if ($cou != $cou1 || $cou1 != $cou2 || $co1 != $co2) {
                echo "Điền đầy đủ thông tin vật tư";
            } else if ($cou == $cou1 && $cou1 == $cou2 && $co1 == $co2) {
                $update_yc = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_nha_cc',`id_cong_trinh`='$id_ctrinh',`id_nguoi_tiep_nhan`='$id_nguoi_lh',
                                    `noi_dung_thu`='$noi_dung',`mail_nhan_bg`='$mail_nhan_bg',`gui_mail`='$gui_mail',`gia_bg_vat`='$gia_baog_vat'
                                    WHERE `id` = $id_bg AND `id_cong_ty` = $com_id ");

                for ($i = 0; $i < $cou; $i++) {
                    $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$ma_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]'
                                    WHERE `id` = $id_vatt[$i] ");
                };

                for ($j = 0; $j < $co1; $j++) {
                    $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`)
                                        VALUES ('','$id_bg','$new_ma_vt[$j]','$new_sl[$j]')");
                };

                $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`)
                                VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu')");
            }
        }
    }

} else {
    echo "Bạn sửa yêu cầu báo giá không thành công, vui lòng thử lại!";
}
