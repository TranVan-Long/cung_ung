<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm đơn hàng bán vật tư</title>
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
    <div class="main-container ql_them_dh_ban">
        <? include('../includes/sidebar.php') ?>

        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-don-hang.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm đơn hàng bán vật tư</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên khách hàng <span class="cr_red">*</span></label>
                                        <select name="ten_khach_hang" class="form-control all_nhacc">
                                            <option value="">Nhập tên khách hàng</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="dia_chi" value="aaa" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Người liên hệ</label>
                                        <select name="nguoi_lh" class="form-control all_nguoilh">
                                            <option value="">Nhập tên người liên hệ</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Số điện thoại / Fax</label>
                                        <input type="text" name="so_dthoai" value="0987654543" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng <span class="cr_red">*</span></label>
                                        <select name="hop_dong" class="form-control all_hd">
                                            <option value="" >-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký đơn hàng</label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="duan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn đơn hàng</label>
                                        <input type="date" name="thoi_han" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đơn vị nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control" placeholder="Nhập đơn vị nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Phòng ban</label>
                                        <input type="text" name="phong_ban" class="form-control" placeholder="Nhập phòng ban người nhận">
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="nguoi_nh" class="form-control" placeholder="Nhập người nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số điện thoại người nhận</label>
                                        <input type="text" name="dient_nnhan" value="090876787" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" class="baoh_pt gr_padd share_fsize_tow">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri" class="gia_tri gr_padd share_fsize_tow">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control"
                                        placeholder="Nhập ghi chú"></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="giatr_vat" value="10000" class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label>Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" name="dgia_vat">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
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
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="gias_vat" value="10000" class="form-control h_border cr_weight" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Chi phí vận chuyển</label>
                                        <input type="text" name="chi_phi_vc" class="form-control" placeholder="Nhập chi phí vận chuyển">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú vận chuyển</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control"
                                        placeholder="Nhập ghi chú vận chuyển"></textarea>
                                </div>

                                <div class="them_moi_vt w_100 float_l mt_25">
                                    <div class="ctn_table w_100 float_l">
                                    <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_two">Vật tư thiết bị</th>
                                                    <th class="share_tb_one">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_eight">Số lượng theo hợp đồng</th>
                                                    <th class="share_tb_two">Số lượng lũy kế kỳ trước</th>
                                                    <th class="share_tb_one">Số lượng kỳ này</th>
                                                    <th class="share_tb_one">Thời gian giao hàng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_one">Thuế VAT</th>
                                                    <th class="share_tb_eight">Tổng tiền sau VAT</th>
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

                                                    <td class="share_tb_seven">1</td>

                                                    <td class="share_tb_two">
                                                        <div class="form-group share_form_select">
                                                            <select name="ma_vatt" class="ma_vatt">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="text" name="dvi_tinh"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="hsan_xuat" class="form-control">
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="number" name="so_luong_hd" class="form-control" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="so_luong_kt" class="form-control" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="sl_knay" class="form-control">
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="date" name="thoig_ghang" class="form-control">
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="don_gia" class="form-control" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="ttr_vat" class="form-control" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="thue_vat" class="form-control">
                                                        </div>
                                                    </td>

                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="number" name="tts_vat" class="form-control" readonly>
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
                                        <button type="button"
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

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm đơn hàng?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex dh_dy_pop">
                                    <button type="button"
                                        class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button"
                                        class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
    $(".all_nhacc, .all_nguoilh, .all_da_ct, .all_hd, .ma_vatt").select2({
        width: '100%',
    });

    var cancel_add = $(".cancel_add");

    cancel_add.click(function(){
        modal_share.show();
    });

    $('.save_add').click(function () {
        var form_validate = $('.form_add_hp_mua');
        form_validate.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ten_khach_hang: {
                    required: true,
                },
                hop_dong: {
                    required: true,
                },
                donv_nh: {
                    required: true,
                },
                nguoi_nh: {
                    required: true,
                }
            },
            messages: {
                ten_khach_hang: {
                    required: "Vui lòng chọn khách hàng.",
                },
                hop_dong: {
                    required: "Vui lòng chọn hợp đồng.",
                },
                donv_nh: {
                    required: "Đơn vị nhận hàng không được để trống.",
                },
                nguoi_nh: {
                    required: "Người nhận hàng không được để trống."
                }
            }
        });
        if (form_validate.valid() === true) {
            alert("true");
        }
    });
</script>

</html>
