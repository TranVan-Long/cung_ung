<?
include("config.php");
include("../classes/PHPMailer/Mailer.php");

$id = getValue('id', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];
$com_name = sql_injection_rp($com_name);

if($id != "" && $com_id != ""){

    $hd_get = new db_query("SELECT `id_nha_cc_kh`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`, `giu_lai_bhanh`, `gia_tri_bhanh`, `bao_lanh_hd`, `gia_tri_blanh`, `thoi_han_blanh`,`noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt`, `ten_ngan_hang`, `so_tk` FROM `hop_dong` WHERE `id` = $id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ncc_id = $hd_detail['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh`, `email` FROM nha_cc_kh WHERE `id` = $ncc_id AND `id_cong_ty` = $com_id AND `phan_loai` = 1 "))->result);
    $email = $ncc['email'];

    if($email == ""){
        echo "Chưa cập nhật email nhà cung cấp, vui lòng cập nhật email nhà cung cấp để gửi mail!";
    }else if($email != ""){
        $list_vt = new db_query("SELECT * FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $id");
        $stt = 1;
        $a = "";
        while ($row = mysql_fetch_assoc($list_vt->result)) {
            $a .= '<tr style="border: 1px solid #666666;">
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $stt++ . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['vat_tu'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_vi_tinh'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['khoi_luong'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['don_gia'] . '</td>
                <td style="font-size: 14px; line-height: 16px; color: #474747; text-align: center; padding-top: 18px; padding-bottom: 17px;">' . $row['thanh_tien'] . '</td>
            </tr>';
        };
        $mailer = new Mailer();
        $subject = "HỢP ĐỒNG THUÊ VẬN CHUYỂN";
        $body = '<div style="width: 724px; float: left; background: #FFFFFF; padding: 90px 40px; border-radius: 8px;">
            <h1 style="width: 100%; float: left; margin-bottom: 35px; font-size: 24px; line-height: 28px; text-align: center; font-weight: bold; color: #474747;">HỢP ĐỒNG THUÊ VẬN CHUYỂN</h1>
            <div style="width: 100%; float: left;">
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Số: HĐ-' . $id . ' </p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Chúng tôi gồm có:</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên chủ hàng</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $com_name . '</p>
                <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Bên vận chuyển</h4>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $ncc['ten_nha_cc_kh'] . '</p>
                <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Hai bên cùng thỏa thuận ký hợp đồng với những nội dung sau:</p>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 1: Hàng hóa vận chuyển</h4>
                </div>
                <table style="width: 100%; float: left; border-collapse: collapse;">
                    <tr style="background: #4C5BD4; height: 52px; color: #FFFFFF;">
                        <th style="width: 10%; border-top-left-radius: 10px; border-right: 1px solid #FFFFFF;">STT</th>
                        <th style="width: 30%; border-right: 1px solid #FFFFFF;">Vật tư</th>
                        <th style="width: 15%; border-right: 1px solid #FFFFFF;">Đơn vị tính</th>
                        <th style="width: 12%; border-right: 1px solid #FFFFFF;">Khối lượng</th>
                        <th style="width: 13%; border-right: 1px solid #FFFFFF;">Đơn giá</th>
                        <th style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent;">Thành tiền</th>
                    </tr>' . $a . '
                </table>

                <div style="margin-top: 20px; width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 2: Nội dung hợp đồng</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['noi_dung_hd'] . '</p>
                </div>
                <div style="margin-top: 20px; width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 3: Điều khoản thanh toán</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['dieu_khoan_tt'] . '</p>
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Thanh toán</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Tên ngân hàng: ' . $hd_detail['ten_ngan_hang'] . '</p>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">Số tài khoản: ' . $hd_detail['so_tk'] . '</p>
                </div>
                <div style="width: 100%; float: left; margin-bottom: 24px;">
                    <h4 style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747; margin-top: 0;">Điều 4: Nội dung cần lưu ý</h4>
                    <p style="font-size: 14px; line-height: 16px; color: #474747; width: 100%; float: left; margin-bottom: 8px; margin-top: 0;">' . $hd_detail['noi_dung_luu_y'] . '</p>
                </div>
            </div>
        </div>';


        $mailer->email($email, $body, $subject, $name);

    }
} else {
    echo "Thiếu thông tin, vui lòng thử lại!";
}
