
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
        <h1>ĐƠN HÀNG BÁN VẬT TƯ</h1>
        <p style="width: 100%; float: left">Tên khách hàng: {Ten_Khach_Hang} </p>
        <p style="width: 100%; float: left;">Địa chỉ: {Dia_Chi}</p>
        <p>Người liên hệ: {Nguoi_Lien_He}</p>
        <p style="margin-bottom: 25px">Số điện thoại/Fax: {So_Dien_Thoai}</p>
        <div class="chi_tiet">
            <table class="table">
                <tr>
                    <th class="thead_th_one">STT</th>
                    <th class="thead_th_two">Vật tư</th>
                    <th class="thead_th_three">Đơn vị tính</th>
                    <th class="thead_th_four">Số lượng</th>
                    <th class="thead_th_five">Đơn giá</th>
                    <th class="thead_th_six">Thành tiền</th>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>Xn11 - Xi măng</td>
                    <td>kg</td>
                    <td>100</td>
                    <td>10.000</td>
                    <td>1.000.000</td>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>STT</td>
                    <td>({Ma_Vat_Tu}) {Ten_Vat_Tu}</td>
                    <td>{Don_Vi_Tinh}</td>
                    <td>{So_Luong}</td>
                    <td>{Don_Gia}</td>
                    <td>{Thanh_Tien}</td>
                </tr>
            </table>
            <div class="nguoi_nhan">
                <p style="margin-top: 20px">(Giá ở trên chưa bao gồm VAT)</p>
                <p>Chi phí vận chuyển: {Chi_Phi_Van_Chuyen}</p>
            </div>
        </div>
    </div>
</body>
</html>