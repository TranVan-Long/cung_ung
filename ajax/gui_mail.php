<?

include("config.php");
include("../classes/PHPMailer/Mailer.php");

$email = $_POST['email'];
$stt = 1;
$list = 10;
$mailer = new Mailer();
$subject = "Email verification";
$body = '<div class="ctn_hop_dong">
        <h1>ĐƠN HÀNG MUA VẬT TƯ</h1>
        <p style="width: 100%; float: left; text-align: center; margin-bottom: 13px">Số  {So_Hop_Dong} </p>
        <p style="width: 100%; float: left; text-align: center; margin-bottom: 28px">Kính gửi: <span style="font-weight: 500">{Nha_Cung_Cap}</span></p>
        <div class="chi_tiet">
            <p>Chúng tôi, có nhu cầu đặt hàng tại công ty theo mẫu yêu cầu.</p>
            <p>Nội dung đặt hàng như sau:</p>
            <table class="table">
                <tr>
                    <th class="thead_th_one">STT</th>
                    <th class="thead_th_two">Vật tư</th>
                    <th class="thead_th_three">Đơn vị tính</th>
                    <th class="thead_th_four">Số lượng</th>
                    <th class="thead_th_five">Đơn giá</th>
                    <th class="thead_th_six">Thành tiền</th>
                </tr>';
                while($row = mysql_fetch_assoc()){
                    '<tr style="border: 1px solid #666666;">
                        <td>'.$stt++.'</td>
                        <td>'. $email.'</td>
                        <td>kg</td>
                        <td>100</td>
                        <td>10.000</td>
                        <td>1.000.000</td>
                    </tr>';
                }
            '</table>
            <p class="gia_tren">(Giá ở trên chưa bao gồm VAT)</p>
            <div class="nguoi_nhan">
                <p>Chi phí vận chuyển: {Chi_Phi_Van_Chuyen}</p>
                <p>Người nhận: {Nguoi_Nhan}</p>
                <p>Phòng ban: {Phong_Ban}</p>
                <p>Số điện thoại: {So_Dien_Thoai}</p>
            </div>
        </div>
    </div>';
//Gửi mail

$mailer -> email($email, $body, $subject);

?>