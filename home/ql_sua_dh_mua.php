<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa đơn hàng mua vật tư</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_sua_dh">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd mt_25 w_100 fload_l">
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 fload_l share_fsize_tow share_clr_one cr_weight_bold">
                            Chỉnh sửa đơn hàng mua vật tư</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 fload_l" method="">
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên nhà cung cấp <span class="cr_red">*</span></label>
                                        <select name="ten_nhacc" class="form-control all_nhacc">
                                            <option value="">Nhập tên nhà cung cấp</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="dia_chi" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Người liên hệ</label>
                                        <select name="nha_ccap" class="form-control all_nguoilh">
                                            <option value="">Nhập tên người liên hệ</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Số điện thoại / Fax</label>
                                        <input type="text" name="so_dthoai" value="0987654543" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng <span class="cr_red">*</span></label>
                                        <select name="hop-dong" class="form-control all_hopd">
                                            <option value="">-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Số đơn hàng</label>
                                        <input type="text" name="so_dh" value="ĐH-000-09987" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký đơn hàng</label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="duan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn đơn hàng</label>
                                        <input type="date" name="thoi_han" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Đơn vị nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Phòng ban</label>
                                        <select name="phong_ban" class="form-control all_pban">
                                            <option value="">-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="nguoi_nh" class="form-control" placeholder="Nhập người nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Số điện thoại người nhận</label>
                                        <input type="text" name="dient_nnhan" value="090876787" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 fload_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" class="baoh_pt">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri" class="gia_tri">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 fload_l">
                                    <label>Ghi chú</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control"
                                        placeholder="Nhập ghi chú"></textarea>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="giatr_vat" value="10000" class="form-control h_border cr_weight">
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label>Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" name="dgia_vat">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Thuế suất VAT</label>
                                        <input type="text" name="thue_vat" class="form-control" placeholder="Nhập thuế suất VAT">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiền chiết khấu</label>
                                        <input type="text" name="tien_ckhau" class="form-control"
                                            placeholder="Nhập số tiền chiết khấu">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="gias_vat" value="10000" class="form-control h_border cr_weight">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Chi phí vận chuyển</label>
                                        <input type="text" name="chi_phi_vc" class="form-control" placeholder="Nhập chi phí vận chuyển">
                                    </div>
                                </div>
                                <div class="form-group w_100 fload_l">
                                    <label>Ghi chú vận chuyển</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control"
                                        placeholder="Nhập ghi chú vận chuyển"></textarea>
                                </div>

                                <div class="them_moi_vt w_100 fload_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">
                                        + Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 fload_l">
                                        <table class="table w_100 fload_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_two">Mã vật tư</th>
                                                    <th class="share_tb_two">Tên đầy đủ vật tư thiết bị</th>
                                                    <th class="share_tb_eight">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_one">Số lượng</th>
                                                    <th class="share_tb_eight">Thời gian giao hàng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_one">Thuế VAT</th>
                                                    <th class="share_tb_two">Tổng tiền sau VAT</th>
                                                    <th class="share_tb_two">Địa điểm giao hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="share_tb_seven">
                                                        <p>
                                                            <img src="../img/remove.png" alt="xóa"
                                                                class="remo_cot_ngang share_cursor">
                                                        </p>
                                                    </td>
                                                    <td class="share_tb_seven">
                                                        <p>1</p>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group share_form_select">
                                                            <select name="ma_vatt" class="ma_vatt">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group share_form_select">
                                                            <select name="ten_vatt" class="ten_vatt">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="text" name="hang-san-xuat"
                                                                class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="xuat-xu" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="so-luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="number" name="don-gia" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="tien_tvat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="thue_vat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="thu_svat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="tien_svat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="dia_chi_g" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button dh_button">
                                        <button type="button"
                                            class="cancel_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="submit"
                                            class="save_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script>
    $(".all_nhacc, .all_nguoilh, .all_pban, .all_da_ct, .all_hopd, .ma_vatt, .ten_vatt").select2({
        width: '100%',
    });


    $(".add_vat_tu").click(function(){
        var html = `<tr>
                        <td class="share_tb_seven">
                            <p>
                                <img src="../img/remove.png" alt="xóa"
                                    class="remo_cot_ngang share_cursor">
                            </p>
                        </td>
                        <td class="share_tb_seven">
                            <p>1</p>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group share_form_select">
                                <select name="ma_vatt" class="ma_vatt">
                                    <option value=""></option>
                                </select>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group share_form_select">
                                <select name="ten_vatt" class="ten_vatt">
                                    <option value=""></option>
                                </select>
                            </div>
                        </td>
                        <td class="share_tb_eight">
                            <div class="form-group">
                                <input type="text" name="hang-san-xuat"
                                    class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="xuat-xu" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_one">
                            <div class="form-group">
                                <input type="number" name="so-luong" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_eight">
                            <div class="form-group">
                                <input type="number" name="don-gia" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="tien_tvat" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="thue_vat" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_one">
                            <div class="form-group">
                                <input type="number" name="thu_svat" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="tien_svat" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="dia_chi_g" class="form-control">
                            </div>
                        </td>
                    </tr>`;
        $(".ctn_table .table tbody").append(html);
        widthSelect();

        if ($(".ctn_table .table tbody").height() > 105.5) {
            $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
        } else {
            $(".ctn_table .table thead tr").css('width', '100%');
        }
    })
</script>

</html>
