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

    $list_dhm = new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`ngay_ky`, d.`thoi_han`, d.`don_vi_nhan_hang`,
                                d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`, d.`ghi_chu`,
                                d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`ngay_tao`, h.`id_du_an_ctrinh`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`, l.`ten_nguoi_lh`
                                FROM `don_hang` AS d
                                INNER JOIN `hop_dong` AS h ON d.`id_hop_dong` = h.`id`
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                INNER JOIN `nguoi_lien_he` AS l ON d.`id_nguoi_lh` = l.`id`
                                WHERE  d.`id` = $id AND d.`phan_loai` = 1 AND d.`id_cong_ty` = $com_id ");
    $item = mysql_fetch_assoc($list_dhm->result);
    $id_ncc = $item['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`,`email` FROM nha_cc_kh WHERE `id` = $id_ncc AND `id_cong_ty` = $com_id AND `phan_loai` = 1 "))->result);
    $email = $ncc['email'];
    if($email == ""){
        echo "Ch??a c???p nh???t email nh?? cung c???p, vui l??ng c???p nh???t email nh?? cung c???p ????? g???i mail!";
    }else if($email != ""){
        $id_ctrinh = $item['id_du_an_ctrinh'];

        if ($item['bao_gom_vat'] == 1) {
            $gia_vat = "Gi?? ??? tr??n ???? bao g???m VAT";
        } else {
            $gia_vat = "Gi?? ??? tr??n ch??a bao g???m VAT";
        }

        $nguoi_lien_he = $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'];
        if ($ctiet_dh['dien_thoai_nn'] != 0) {
            $dt_nguoi_nhan = $ctiet_dh['dien_thoai_nn'];
        } else {
            $dt_nguoi_nhan = "";
        }

        $list_vt_dhm = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_ky_nay`, `thoi_gian_giao_hang`,
                                    `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                    FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id AND `id_cong_ty` = $com_id ");
        $stt = 1;
        $a = "";
        while ($row = mysql_fetch_assoc($list_vt_dhm->result)) {
            $a .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dsvt_name'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dvt_name'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['so_luong_ky_nay'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_gia'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['tong_tien_svat'] . '</td>
            </tr>';
        }

        $mailer = new Mailer();
        $subject = "????N H??NG MUA V???T T??";
        $body = '<div style="width: 724px; float: left; background: #FFFFFF; padding: 90px 40px; border-radius: 8px;">
                    <h1 style=" width: 100%; float: left; margin-bottom: 13px; font-size: 24px; line-height: 28px; text-align: center; font-weight: bold; color: #474747;">????N H??NG MUA V???T T??</h1>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; text-align: center; margin-bottom: 8px; margin-top: 0;">S???: H??-' . $id . '</p>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; text-align: center; margin-bottom: 28px; margin-top: 0;">K??nh g???i: <span style="font-weight: bold">' . $item['ten_nha_cc_kh'] . '</span></p>
                    <div style="width: 100%; float: left;">
                        <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Ch??ng t??i, c?? nhu c???u ?????t h??ng t???i c??ng ty theo m???u y??u c???u.</p>
                        <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">N???i dung ?????t h??ng nh?? sau:</p>
                        <table style="width: 100%; float: left; border-collapse: collapse;">
                            <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                                <th style="width: 10%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                                <th style="width: 30%; border-right: 1px solid #FFFFFF;">V???t t??</th>
                                <th style="width: 15%; border-right: 1px solid #FFFFFF;">????n v??? t??nh</th>
                                <th style="width: 12%; border-right: 1px solid #FFFFFF;">S??? l?????ng</th>
                                <th style="width: 13%; border-right: 1px solid #FFFFFF;">????n gi??</th>
                                <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent;">Th??nh ti???n</th>
                            </tr>' . $a . '
                        </table>
                        <p style="margin-top: 20px; width: 100%; float: left; margin-bottom: 20px;">(' . $gia_vat . ')</p>
                        <div class="nguoi_nhan">
                            <p>Chi ph?? v???n chuy???n: ' . $item['chi_phi_vchuyen'] . '</p>
                            <p>Ng?????i nh???n: ' . $item['nguoi_nhan_hang'] . '</p>
                            <p>Ph??ng ban: ' . $item['phong_ban'] . '</p>
                            <p>S??? ??i???n tho???i: ' . $item['dien_thoai_nn'] . '</p>
                        </div>
                    </div>
                </div>';
        //G???i mail

        $mailer->email($email, $body, $subject, $name);
    }


}else{
    echo "Thi???u th??ng tin, vui l??ng th??? l???i!";
}
