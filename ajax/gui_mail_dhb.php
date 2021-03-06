<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$id = getValue('id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];
$com_name = sql_injection_rp($com_name);
$token = $_POST['token'];

if($id != "" && $com_id != ""){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
    $count = count($data_list_nv);
    $all_nv = [];
    for ($i = 0; $i < $count; $i++) {
        $item = $data_list_nv[$i];
        $all_nv[$item['ep_id']] = $item;
    };

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

    $ctiet_dh = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`id_du_an_ctrinh`, d.`ngay_ky`,
                                d.`thoi_han`, d.`don_vi_nhan_hang`, d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`,
                                d.`ghi_chu`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`phan_loai`, d.`hieu_luc`, d.`trang_thai`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`
                                FROM `don_hang` AS d
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                WHERE d.`id` = $id AND d.`id_cong_ty` = $com_id "))->result);
    $id_ncc = $ctiet_dh['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`,`email` FROM nha_cc_kh WHERE `id` = $id_ncc AND `id_cong_ty` = $com_id AND `phan_loai` = 2 "))->result);
    $email = $ncc['email'];
    if($email == ""){
        echo "Ch??a c???p nh???t email kh??ch h??ng, vui l??ng c???p nh???t email kh??ch h??ng ????? g???i mail!";
    }else if($email != ""){
        if ($ctiet_dh['bao_gom_vat'] == 1) {
            $gia_vat = "Gi?? ??? tr??n ???? bao g???m VAT";
        } else {
            $gia_vat = "Gi?? ??? tr??n ch??a bao g???m VAT";
        };

        $nguoi_lien_he = $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'];

        if ($ctiet_dh['dien_thoai_nn'] != 0) {
            $dt_nguoi_nhan = $ctiet_dh['dien_thoai_nn'];
        } else {
            $dt_nguoi_nhan = "";
        };

        $list_vt = new db_query("SELECT `id_don_hang`, `id_vat_tu`, `so_luong_ky_nay`, `don_gia`, `tong_tien_svat` FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id AND `id_cong_ty` = $com_id ");
        $stt = 1;
        $a = "";
        while ($row = mysql_fetch_assoc($list_vt->result)) {
            $a .= '<tr style="border: 1px solid #666666;">
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dsvt_name'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dvt_name'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['so_luong_ky_nay'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_gia'] . '</td>
                        <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['tong_tien_svat'] . '</td>
                    </tr>';
        };

        $mailer = new Mailer();
        $subject = "????N H??NG B??N V???T T??";
        $body = '<div style="width: 724px; float: left; background: #FFFFFF; padding: 90px 40px; border-radius: 8px;">
            <h1 style="width: 100%; float: left; margin-bottom: 13px; font-size: 24px; line-height: 28px; text-align: center; font-weight: bold; color: #474747;">????N H??NG B??N V???T T??</h1>
            <p style="width: 100%; float: left; margin-bottom: 32px; font-size: 14px; line-height: 16px; text-align: center; margin-top: 0; color: #474747">
                S???  ??H-' . $id . '</p>
            <p style="width: 100%; float: left; font-size: 14px; line-height: 16px; color: #474747; margin-bottom: 8px; margin-top: 0;">T??n kh??ch h??ng: ' . $ctiet_dh['ten_nha_cc_kh'] . ' </p>
            <p style="width: 100%; float: left; font-size: 14px; line-height: 16px; color: #474747; margin-bottom: 8px; margin-top: 0;">?????a ch???: ' . $ctiet_dh['dia_chi_lh'] . '</p>
            <p style="width: 100%; float: left; font-size: 14px; line-height: 16px; color: #474747; margin-bottom: 8px; margin-top: 0;">Ng?????i li??n h???: ' . $nguoi_lien_he . '</p>
            <p style="width: 100%; float: left; font-size: 14px; line-height: 16px; color: #474747; margin-bottom: 25px; margin-top: 0;">S??? ??i???n tho???i/Fax: ' . $dt_nguoi_nhan . '</p>
            <div style="width: 100%; float: left;">
                <table style="width: 100%; float: left; border-collapse: collapse;">
                    <tr style=" background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 10%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 30%; border-right: 1px solid #FFFFFF;">V???t t??</th>
                        <th style="width: 15%; border-right: 1px solid #FFFFFF;">????n v??? t??nh</th>
                        <th style="width: 12%; border-right: 1px solid #FFFFFF;">S??? l?????ng</th>
                        <th style="width: 13%; border-right: 1px solid #FFFFFF;">????n gi??</th>
                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent;">Th??nh ti???n</th>
                    </tr>' . $a . '
                </table>
                <div class="nguoi_nhan">
                    <p style="width: 100%; float: left; font-size: 14px; line-height: 16px; color: #474747; margin-bottom: 25px; margin-top: 20px;">(' . $gia_vat . ')</p>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Chi ph?? v???n chuy???n: ' . $ctiet_dh['chi_phi_vchuyen'] . '</p>
                </div>
            </div>
        </div>';

        $mailer->email($email, $body, $subject, $name);
    }

} else {
    echo "Thi???u th??ng tin, vui l??ng th??? l???i!";
}
