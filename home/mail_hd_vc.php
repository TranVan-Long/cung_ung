
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
        <h1>HỢP ĐỒNG THUÊ VẬN CHUYỂN</h1>
        <div class="chi_tiet">
            <p>Số  {So_Hop_Dong} </p>
            <p>Chúng tôi gồm có:</p>
            <h4>Bên chủ hàng</h4>
            <p>{Ten_Cong_Ty}</p>
            <h4>Bên vận chuyển</h4>
            <p>{Nha_Cung_Cap}</p>
            <p>Hai bên cùng thỏa thuận ký hợp đồng với những nội dung sau:</p>
            <div class="dieu_khoan">
                <h4>Điều 1: Hàng hóa vận chuyển</h4>
            </div>
            <table class="table">
                <tr>
                    <th class="thead_th_one" style="width: 7%">STT</th>
                    <th class="thead_th_two" style="width: 30%">Loại tài sản thiết bị</th>
                    <th class="thead_th_three" style="width: 28%">Thông số kỹ thuật</th>
                    <th class="thead_th_four" style="width: 20%">Đơn vị tính</th>
                    <th class="thead_th_five" style="width: 15%; border-top-right-radius: 10px; border-right: 1px solid transparent;">Số lượng</th>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Thong_So_Ky_Thuat}</td>
                    <td>{Don_Vi_Tinh}</td>
                    <td>{So_Luong}</td>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Thong_So_Ky_Thuat}</td>
                    <td>{Don_Vi_Tinh}</td>
                    <td>{So_Luong}</td>
                </tr>
            </table>

            <div class="dieu_khoan" style="margin-top: 20px">
                <h4>Điều 2: Nội dung hợp đồng</h4>
                <p>{Noi_Dung_Hop_dong}</p>
            </div>
            <div class="dieu_khoan" style="margin-top: 20px">
                <h4>Điều 3: Điều khoản thanh toán</h4>
                <p>{Dieu_Khoan_Thanh_Toan}</p>
                <h4>Thanh toán</h4>
                <p>Tên ngân hàng: {Ten_Ngan_Hang}</p>
                <p>Số tài khoản: {So_Tai_Khoan}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 4: Nội dung cần lưu ý</h4>
                <p>{Noi_Dung_Can_Luu_Y}</p>
            </div>
        </div>
    </div>
</body>
</html>