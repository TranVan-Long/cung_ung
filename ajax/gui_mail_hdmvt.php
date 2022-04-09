<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$id = getValue('id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];

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


$hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`,
                        `thoa_tuan_hoa_don`, `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $id AND `id_cong_ty` = $com_id ");
$hd_detail = mysql_fetch_assoc($hd_get->result);

$ncc_id = $hd_detail['id_nha_cc_kh'];
$ngay_ky_hd = date('d/m/Y', $hd_detail['ngay_ky_hd']);

$ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id AND `id_cong_ty` = $com_id "))->result);

if ($hd_detail['bao_gom_vat'] == 1) {
    $gia_vat = "Giá ở trên đã bao gồm VAT";
} else {
    $gia_vat = "Giá ở trên chưa bao gồm VAT";
}

$list_vt = new db_query("SELECT `id`, `id_vat_tu`, `so_luong`, `don_gia`, `tien_svat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id");
$stt = 1;
$a = "";
while ($row = mysql_fetch_assoc($list_vt->result)) {
    $a .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dsvt_name'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $vat_tu[$row['id_vat_tu']]['dvt_name'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['so_luong'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_gia'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['tien_svat'] . '</td>
            </tr>';
}


$email = "bboyraizo@gmail.com";
$mailer = new Mailer();
$subject = "HỢP ĐỒNG MUA VẬT LIỆU XÂY DỰNG";
$body = '<div style="width: 724px; float: left; background: #FFFFFF; padding: 90px 40px; border-radius: 8px;">
            <h1 style="width: 100%; float: left; margin-bottom: 35px; font-size: 24px; line-height: 28px; text-align: center; font-weight: bold; color: #474747;">HỢP ĐỒNG MUA BÁN VẬT LIỆU XÂY DỰNG</h1>
            <div style="width: 100%; float: left;">
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Số: HĐ-' . $id . ' </p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Căn cứ vào nhu cầu và khả năng của hai bên, hôm nay, ngày ' . $ngay_ky_hd . '. Đại diện hai bên gồm:</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên mua</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $ncc['ten_nha_cc_kh'] . '</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên bán</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $com_name . '</p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Sau khi bàn bạc, trao đổi hai bên thống nhất ký kết Hợp đồng với các điều khoản sau:</p>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 1: Nội dung hợp đồng</h4>
                    <p>' . $hd_detail['noi_dung_hd'] . '</p>
                </div>
                <table style="width: 100%; float: left; border-collapse: collapse;">
                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 10%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 30%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                        <th style="width: 15%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                        <th style="width: 12%; border-right: 1px solid #FFFFFF;">Số lượng</th>
                        <th style="width: 13%; border-right: 1px solid #FFFFFF;">Đơn giá</th>
                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent;">Thành tiền</th>
                    </tr>' . $a . '
                </table>
                <p style="font-size: 14px; line-height: 16px; color: #474747; margin-top: 20px; width: 100%; float: left; margin-bottom: 20px;">(' . $gia_vat . ')</p>

                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 2: Yêu cầu về tiến độ</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['yc_tien_do'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 3: Điều khoản thanh toán</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['dieu_khoan_tt'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 4: Thỏa thuận hóa đơn</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['thoa_tuan_hoa_don'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 5: Nội dung cần lưu ý</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['noi_dung_luu_y'] . '</p>
                </div>
            </div>
        </div>';
//Gửi mail

$mailer->email($email, $body, $subject, $name);
