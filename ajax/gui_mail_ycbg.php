<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$id = getValue('id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];
$com_name = sql_injection_rp($com_name);

if($id != "" && $com_id != ""){
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
    };

    $list_ct = new db_query("SELECT y.`id`, y.`nha_cc_kh`, y.`noi_dung_thu`,y.`mail_nhan_bg`, y.`gia_bg_vat`, n.`ten_nha_cc_kh`
                        FROM `yeu_cau_bao_gia` AS y
                        INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                        INNER JOIN `nguoi_lien_he` AS l ON n.`id` = l.`id_nha_cc`
                        WHERE y.`id_cong_ty` = $com_id AND y.`id` = $id ");
    $item_ct = mysql_fetch_assoc($list_ct->result);

    $id_nhacc = $item_ct['nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`,`email` FROM nha_cc_kh WHERE `id` = $id_nhacc AND `id_cong_ty` = $com_id AND `phan_loai` = 1 "))->result);
    $email = $ncc['email'];
    if($email == ""){
        echo "Chưa cập nhật email nhà cung cấp, vui lòng cập nhật email nhà cung cấp để gửi mail!";
    }else if($email != ""){
        $list_vt = new db_query("SELECT `id`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id ");

        if ($item_ct['gia_bg_vat'] == 1) {
            $gia_vat = "Giá ở trên đã bao gồm VAT";
        } else {
            $gia_vat = "Giá ở trên chưa bao gồm VAT";
        };

        $stt = 1;
        $a = "";
        while ($row = mysql_fetch_assoc($list_vt->result)) {
            $a .= '<tr style="border: 1px solid #666666;">
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dsvt_name'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dvt_name'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['so_luong_yc_bg'] . '</td>
                    </tr>';
        };

        $mailer = new Mailer();
        $subject = "YÊU CẦU BÁO GIÁ";
        $body = '<div style="width: 724px;float: left;background: #FFFFFF;padding: 90px 40px;border-radius: 8px;">
                    <p style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747">
                        CÔNG TY  ' . $com_name . '</p>
                    <p style="width: 100%; float: left; margin-bottom: 23px; font-size: 14px; line-height: 16px; color: #474747">
                        Số: BG-' . $item_ct['id'] . '</p>
                    <h1 style="width: 100%; float: left; text-align: center; font-size: 24px; line-height: 28px; margin-bottom:14px">THƯ YÊU CẦU BÁO GIÁ</h1>
                    <p style="width: 100%; float: left; text-align: center; margin-bottom: 25px; font-size: 14px; line-height: 16px; color: #474747">Kính gửi: <span style="font-weight: 500">' . $item_ct['ten_nha_cc_kh'] . '</span></p>
                    <div style="width: 100%; float: left;">
                        <p style="width:100%; float:left; margin-bottom:18px; font-size: 14px; line-height: 16px; color: #474747"> Nội dung: ' . $item_ct['noi_dung_thu'] . '</p>
                        <table style="width: 100%; float: left; border-collapse: collapse;">
                            <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                                <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                                <th style="width: 53%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                                <th style="width: 20%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                                <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent">Số lượng</th>
                            </tr>' . $a . '
                        </table>
                        <p style="margin-top: 20px;width: 100%;float: left;margin-bottom: 20px;">' . $gia_vat . '</p>
                        <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747;">Mail nhận: ' . $item_ct['mail_nhan_bg'] . '</h4>
                    </div>
                </div>';

        $mailer->email($email, $body, $subject, $name);

    }
}else{
    echo "Thiếu thông tin, vui lòng thử lại!";
}
