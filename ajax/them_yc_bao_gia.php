<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$user_id = getValue('user_id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$ngay_lap = strtotime(date('Y-m-d',$_POST['ngay_lap']));

$id_nhacc = getValue('nhacc_id', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');
$id_ctrinh = getValue('id_ctrinh', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$noi_dung = $_POST['noi_dung'];
$mail_nhan_bg = $_POST['mail_nhan_bg'];
$com_name = $_POST['com_name'];

$gui_mail = getValue('gui_mail', 'int', 'POST', '');

$gia_baog_vat = getValue('gia_baog_vat', 'int', 'POST', '');

$ma_vt = $_POST['ma_vt'];
$cou = count($ma_vt);

$so_luong = $_POST['so_luong'];
$co1 = count($so_luong);

if ($user_id != "" && $com_id != "" && $id_nhacc != "") {
    if($cou == 0){
        echo "Thêm ít nhất 1 vật tư";
    }else if($cou > 0){
        if ($co1 != $cou) {
            echo "Điền đầy đủ thông tin yêu vầu vật tư và số lượng phải lớn hơn 0";
        } else if ($cou == $co1) {
            if ($gui_mail == 1) {
                $mail_g = mysql_fetch_assoc((new db_query("SELECT `email` FROM `nha_cc_kh` WHERE `id` = $id_nhacc AND `phan_loai` = 1
                                                            AND `id_cong_ty` = $com_id "))->result)['email'];
                if ($mail_g != "") {
                    $inser_ycbg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`, `noi_dung_thu`,
                                        `mail_nhan_bg`, `gui_mail`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`, `quyen_nlap`, `ngay_tao`,
                                         `ngay_chinh_sua`, `id_cong_ty`)
                                        VALUES (NULL,'$user_id','$id_nhacc','$id_ctrinh','$id_nguoi_lh','$noi_dung','$mail_nhan_bg','$gui_mail',
                                        '','','$gia_baog_vat',1,1,'$phan_quyen_nk','$ngay_lap','','$com_id')");

                    $id_ycbg = new db_query("SELECT LAST_INSERT_ID() AS yc_id");
                    $yc_id = mysql_fetch_assoc($id_ycbg->result)['yc_id'];

                    for ($j = 0; $j < $cou; $j++) {
                        $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$yc_id','$ma_vt[$j]','$so_luong[$j]')");
                    }

                    $noi_dung_thu = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " . $yc_id;
                    $ngay_tao = strtotime(date('Y-m-d', time()));
                    $gio_tao = strtotime(date('H:i:s', time()));
                    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu','$com_id')");

                    // gui mail
                    $ctiet_ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`, `email` FROM `nha_cc_kh` WHERE `id` = $id_nhacc AND `phan_loai` = 1
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
                                Số: BG-' . $yc_id . '</p>
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
                } else {
                    echo "Nhà cung cấp chưa cập nhật địa chỉ email, vui lòng cập nhật địa chỉ email nhà cung cập để gửi mail yêu cầu báo giá";
                }
            } else {
                $inser_ycbg = new db_query("INSERT INTO `yeu_cau_bao_gia`(`id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_trinh`, `id_nguoi_tiep_nhan`, `noi_dung_thu`,
                                        `mail_nhan_bg`, `gui_mail`, `ngay_bd`, `ngay_kt`, `gia_bg_vat`, `phan_loai`, `trang_thai`, `quyen_nlap`, `ngay_tao`,
                                         `ngay_chinh_sua`, `id_cong_ty`)
                                        VALUES (NULL,'$user_id','$id_nhacc','$id_ctrinh','$id_nguoi_lh','$noi_dung','$mail_nhan_bg','$gui_mail',
                                        '','','$gia_baog_vat',1,1,'$phan_quyen_nk','$ngay_lap','','$com_id')");

                $id_ycbg = new db_query("SELECT LAST_INSERT_ID() AS yc_id");
                $yc_id = mysql_fetch_assoc($id_ycbg->result)['yc_id'];

                for ($j = 0; $j < $cou; $j++) {
                    $inser_yc = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$yc_id','$ma_vt[$j]','$so_luong[$j]')");
                }

                $noi_dung_thu = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " . $yc_id;
                $ngay_tao = strtotime(date('Y-m-d', time()));
                $gio_tao = strtotime(date('H:i:s', time()));
                $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id', '$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_thu','$com_id')");
            }
        }
    }

} else {
    echo "Bạn yêu cầu báo giá không thành công, vui lòng thử lại!";
}
