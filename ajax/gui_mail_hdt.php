<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$id = getValue('id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];
$com_name = sql_injection_rp($com_name);

if($id != "" && $com_id != ""){
    $hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `ten_ngan_hang`, `so_tk`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ncc_id = $hd_detail['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`,`email` FROM nha_cc_kh WHERE `id` = $ncc_id AND `id_cong_ty` = $com_id AND `phan_loai` = 1 "))->result);
    $email = $ncc['email'];

    if($email == ""){
        echo "Chưa cập nhật email nhà cung cấp, vui lòng cập nhật email nhà cung cấp để gửi mail!";
    }else if($email != ""){
        if ($item_ct['gia_bg_vat'] == 1) {
            $gia_vat = "Giá bao gồm VAT";
        } else {
            $gia_vat = "Giá không bao gồm VAT";
        };

        $list_vt = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $id");
        $stt = 1;
        $stt2 = 1;
        $stt3 = 1;
        $a = "";
        $b = "";
        $c = "";

        while ($row = mysql_fetch_assoc($list_vt->result)) {
            $a .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['loai_tai_san'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['thong_so_kthuat'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_vi_tinh'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['so_luong'] . '</td>
            </tr>';
            $b .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt2++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['loai_tai_san'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . date('d/m/Y', $row['thue_tu_ngay']) . ' - ' . date('d/m/Y', $row['thue_den_ngay']) . '</td>
            </tr>';
            $c .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt3++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['loai_tai_san'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_gia_thue'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['dg_ca_may_phu_troi'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['thanh_tien_du_kien'] . '</td>
            </tr>';
        };

        $mailer = new Mailer();
        $subject = "HỢP ĐỒNG THUÊ THIẾT BỊ";
        $body = '<div style="width: 724px; float: left; background: #FFFFFF; padding: 90px 40px; border-radius: 8px;">
            <h1 style="width: 100%; float: left; margin-bottom: 35px; font-size: 24px; line-height: 28px; text-align: center; font-weight: bold; color: #474747;">HỢP ĐỒNG THUÊ THIẾT BỊ</h1>
            <div style="width: 100%; float: left;">
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Số: HĐ-' . $id . ' </p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Chúng tôi gồm có:</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên cho thuê</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 15px; margin-top: 0">' . $ncc['ten_nha_cc_kh'] . '</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên thuê</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 28px; margin-top: 0">' . $com_name . '</p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 15px; margin-top: 0">Hai bên đồng ý thực hiện việc thuê tài sản/ thuê máy móc, thiết bị với các thoả thuận sau đây:</p>
                <div style="margin-bottom: 25px; width: 100%; float: left;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 1: Tài sản thuê</h4>
                </div>
                <table style="margin-bottom: 35px; width: 100%; float: left; border-collapse: collapse;">
                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 40%; border-right: 1px solid #FFFFFF;">Loại tài sản thiết bị</th>
                        <th style="width: 25%" border-right: 1px solid #FFFFFF;>Thông số kỹ thuật</th>
                        <th style="width: 13%" border-right: 1px solid #FFFFFF;>Đơn vị tính</th>
                        <th style="width: 15%; border-right: 1px solid transparent;border-top-right-radius: 10px;">Số lượng</th>
                    </tr>' . $a . '
                </table>
                <div style="margin-bottom: 25px; width: 100%; float: left;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 2: Thời hạn thuê</h4>
                </div>
                <table style="margin-bottom: 35px; width: 100%; float: left; border-collapse: collapse;">
                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 10%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 50%; border-right: 1px solid #FFFFFF;">Loại tài sản thiết bị</th>
                        <th style="width: 40%; border-right: 1px solid transparent; border-top-right-radius: 10px;">Thời gian thuê</th>
                    </tr>' . $b . '
                </table>

                <div style="margin-bottom: 25px; width: 100%; float: left;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 3: Giá thuê và hình thức thanh toán</h4>
                </div>
                <table style="margin-bottom: 20px; width: 100%; float: left; border-collapse: collapse;">
                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 7%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 38%; border-right: 1px solid #FFFFFF;">Loại tài sản thiết bị</th>
                        <th style="width: 15%; border-right: 1px solid #FFFFFF;">Đơn giá thuê</th>
                        <th style="width: 20%; border-right: 1px solid #FFFFFF;">Ca máy phụ trội</th>
                        <th style="width: 20%; border-right: 1px solid transparent;border-top-right-radius: 10px;">Thành tiền</th>
                    </tr>' . $c . '
                </table>

                <div style=" width: 100%; float: left; margin-bottom: 20px;">
                    <h4 style="margin-bottom: 10px">Thanh toán</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 10px; margin-top: 0">Tên ngân hàng: ' . $hd_detail['ten_ngan_hang'] . '</p>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Số tài khoản: ' . $hd_detail['so_tk'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 4: Nội dung hợp đồng</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['noi_dung_hd'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 5: Điều khoản thanh toán</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['dieu_khoan_tt'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 6: Nội dung cần lưu ý</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['noi_dung_luu_y'] . '</p>
                </div>
            </div>
        </div>';

        $mailer->email($email, $body, $subject, $name);
    }
} else {
    echo "Thiếu thông tin, vui lòng thử lại!";
}
