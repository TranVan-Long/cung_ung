
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
        <h1>HỢP ĐỒNG MUA BÁN VẬT LIỆU XÂY DỰNG</h1>
        <div class="chi_tiet">
            <p>Số  {So_Hop_Dong} </p>
            <p>Căn cứ vào nhu cầu và khả năng của hai bên, hôm nay, {Ngay_Ky_Hop_Dong} , đại diện hai bên gồm:</p>
            <h4>Bên mua</h4>
            <p>{Khach_Hang}</p>
            <h4>Bên bán</h4>
            <p>{Ten_Cong_Ty}</p>
            <p>Sau khi bàn bạc, trao đổi hai bên thống nhất ký kết Hợp đồng với các điều khoản sau:</p>
            <div class="dieu_khoan">
                <h4>Điều 1: Nội dung hợp đồng</h4>
                <p>{Noi_Dung_Hop_Dong}</p>
            </div>
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
            <p class="gia_tren">(Giá ở trên chưa bao gồm VAT)</p>

            <div class="dieu_khoan">
                <h4>Điều 2: Yêu cầu về tiến độ</h4>
                <p>{Yeu_Cau_Ve_Tien_Do}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 3: Điều khoản thanh toán</h4>
                <p>{Dieu_Khoan_Thanh_Toan}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 4: Thỏa thuận hóa đơn</h4>
                <p>{Thoa_Thuan_Hoa_Don}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 5: Nội dung cần lưu ý</h4>
                <p>{Noi_Dung_Can_Luu_Y}</p>
            </div>
        </div>
    </div>
</body>
</html>