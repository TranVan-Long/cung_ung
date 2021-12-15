
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mail.css">
</head>
<body style="font-family: roboto;">
    <div class="ctn_hop_dong">
        <p style="width: 100%; float: left; margin-bottom: 8px; font-size: 14px; line-height: 16px; color: #474747">
            CÔNG TY  {Ten_Cong_Ty}</p>
        <p style="width: 100%; float: left; margin-bottom: 23px; font-size: 14px; line-height: 16px; color: #474747">
            Số  {So_Phieu_Yeu_Cau}</p>
        <h1 style="width: 100%; float: left; text-align: center; font-size: 24px; line-height: 28px; margin-bottom:14px">BẢNG BÁO GIÁ</h1>
        <p style="width: 100%; float: left; text-align: center; margin-bottom: 25px; font-size: 14px; line-height: 16px; color: #474747">Kính gửi: <span style="font-weight: 500">{Khach_hang}</span></p>
        <div class="chi_tiet">
            <p style="width:100%; float:left; margin-bottom:18px; font-size: 14px; line-height: 16px; color: #474747">{Noi_Dung_Thu}</p>
            <table class="table">
                <tr>
                    <th class="thead_th_one" style="width: 7%">STT</th>
                    <th class="thead_th_two" style="width: 38%">Vật tư</th>
                    <th class="thead_th_three" style="width: 20%">Đơn vị tính</th>
                    <th style="width: 15%; border-right: 1px solid #FFFFFF">Số lượng</th>
                    <th class="thead_th_four" style="width: 20%; border-top-right-radius: 10px; border-right: 1px solid transparent">Đơn giá</th>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>Xn11 - Xi măng</td>
                    <td>kg</td>
                    <td>100</td>
                    <td>100</td>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>STT</td>
                    <td>({Ma_Vat_Tu}) {Ten_Vat_Tu}</td>
                    <td>{Don_Vi_Tinh}</td>
                    <td>{So_Luong}</td>
                    <td>{Don_gia}</td>
                </tr>
            </table>
            <p class="gia_tren">(Giá ở trên chưa bao gồm VAT)</p>
        </div>
    </div>
</body>
</html>