
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
        <h1>HỢP ĐỒNG THUÊ THIẾT BỊ</h1>
        <div class="chi_tiet">
            <p>Số  {So_Hop_Dong} </p>
            <p>Chúng tôi gồm có:</p>
            <h4>Bên cho thuê</h4>
            <p style="margin-bottom: 15px">{Nha_Cung_Cap}</p>
            <h4>Bên thuê</h4>
            <p style="margin-bottom: 28px">{Ten_Cong_Ty}</p>
            <p style="margin-bottom: 15px">Hai bên đồng ý thực hiện việc thuê tài sản/ thuê máy móc, thiết bị với các thoả thuận sau đây:</p>
            <div class="dieu_khoan" style="margin-bottom: 25px">
                <h4>Điều 1: Tài sản thuê</h4>
            </div>
            <table class="table" style="margin-bottom: 35px">
                <tr>
                    <th class="thead_th_one" style="width: 7%">STT</th>
                    <th class="thead_th_two" style="width: 40%">Loại tài sản thiết bị</th>
                    <th class="thead_th_three" style="width: 25%">Thông số kỹ thuật</th>
                    <th class="thead_th_four" style="width: 13%">Đơn vị tính</th>
                    <th class="thead_th_five" style="width: 15%; border-right: 1px solid transparent;border-top-right-radius: 10px;">Số lượng</th>
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
            <div class="dieu_khoan" style="margin-bottom: 25px">
                <h4>Điều 2: Thời hạn thuê</h4>
            </div>
            <table class="table" style="margin-bottom: 35px">
                <tr>
                    <th class="thead_th_one" style="width: 10%">STT</th>
                    <th class="thead_th_two" style="width: 50%">{Loai_Tai_San_Thiet_Bi}</th>
                    <th class="thead_th_three" style="width: 40%; border-right: 1px solid transparent;border-top-right-radius: 10px;">{Thoi_Gian_Thue}</th>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Thoi_Gian_Thue}</td>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>STT</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Thoi_Gian_Thue}</td>
                </tr>
            </table>

            <div class="dieu_khoan" style="margin-bottom: 25px">
                <h4>Điều 3: Giá thuê và hình thức thanh toán</h4>
            </div>
            <table class="table" style="margin-bottom: 20px">
                <tr>
                    <th class="thead_th_one" style="width: 7%">STT</th>
                    <th class="thead_th_two" style="width: 38%">Loại tài sản thiết bị</th>
                    <th class="thead_th_three" style="width: 15%">Đơn giá thuê</th>
                    <th class="thead_th_four" style="width: 20%">Ca máy phụ trội</th>
                    <th class="thead_th_five" style="width: 20%; border-right: 1px solid transparent;border-top-right-radius: 10px;">Thành tiền</th>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Don_Gia_Thue}</td>
                    <td>{Don_Gia_Ca_May}</td>
                    <td>{Thành tiền}</td>
                </tr>
                <tr style="border: 1px solid #666666;">
                    <td>1</td>
                    <td>{Loai_Tai_San_Thiet_Bi}</td>
                    <td>{Don_Gia_Thue}</td>
                    <td>{Don_Gia_Ca_May}</td>
                    <td>{Thành tiền}</td>
                </tr>
            </table>

            <div class="dieu_khoan" style="margin-bottom: 20px">
                <h4 style="margin-bottom: 10px">Thanh toán</h4>
                <p style="margin-bottom: 10px">Tên ngân hàng: {Ten_Ngan_Hang}</p>
                <p>Số tài khoản: {So_Tai_Khoan}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 4: Nội dung hợp đồng</h4>
                <p>{Noi_Dung_Hop_dong}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 5: Điều khoản thanh toán</h4>
                <p>{Dieu_Khoan_Thanh_Toan}</p>
            </div>
            <div class="dieu_khoan">
                <h4>Điều 6: Nội dung cần lưu ý</h4>
                <p>{Noi_Dung_Can_Luu_Y}</p>
            </div>
        </div>
    </div>
</body>
</html>