<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm hợp đồng mua</title>
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
    <div class="main-container ql_them_hd_mua">
        <? include('../includes/sidebar.php') ?>

        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l mt_20">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one mb_20 share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm hợp đồng mua</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <select name="nha_ccap" class="form-control all_nhacc">
                                            <option value="">-- Chọn nhà cung cấp --</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="dan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="hd_nguyent">Hợp đồng nguyên tắc</label>
                                        <input type="checkbox" id="hd_nguyent" name="hd_ntac">
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Hình thức hợp đồng</label>
                                        <select name="hinht_hd" class="form-control all_hthuc_hd">
                                            <option value="">-- Chọn hình thức hợp đồng --</option>
                                            <option value="1">Hợp đồng trọn gói</option>
                                            <option value="2">Hợp đồng theo đơn giá cố định</option>
                                            <option value="3">Hợp đồng theo đơn giá điều chỉnh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="hd_ntac" value="10000"
                                            class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="dgia_tt">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" id="dgia_tt" name="dgia_vat">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thuế suất VAT</label>
                                        <input type="text" name="thues_vat" class="form-control"
                                            placeholder="Nhập thuế suất VAT" >
                                    </div>
                                    <div class="form-group">
                                        <label>Tiền chiết khấu</label>
                                        <input type="number" name="tien_chietk" class="form-control"
                                            placeholder="Nhập số tiền chiết khấu">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="hd_ntac" value="1000"
                                            class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" class="baoh_pt">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri" class="gia_tri">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Bảo lãnh thực hiện hợp đồng</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baol_hd" class="baoh_pt">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri_bl" class="gia_tri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn bảo lãnh</label>
                                        <input type="date" name="thoih_bl" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời gian thực hiện</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="bd_ngay" class="gia_tri">
                                            <span>đến</span>
                                            <input type="date" name="kt_ngay" class="gia_tri">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="baog_vanc">Hợp đồng đã bao gồm vận chuyển</label>
                                        <input type="checkbox" id="baog_vanc" name="hd_vanc">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Yêu cầu về tiến độ</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control"
                                        placeholder="Nhập yêu cầu về tiến độ"></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noid_hd" rows="5" class="form-control"
                                        placeholder="Nhập nội dung hợp đồng"></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noid_luuy" rows="5" class="form-control"
                                        placeholder="Nhập nội dung cần lưu ý"></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieuk_ttoan" rows="5" class="form-control"
                                        placeholder="Nhập điều khoản thanh toán"></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên ngân hàng</label>
                                        <select name="ngan_hang" class="form-control ten_nganhang">
                                            <option value="">-- Chọn tên ngân hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="text" name="so_taik" class="form-control"
                                            placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Báo giá</label>
                                        <select name="bao_gia" class="form-control bao_gia">
                                            <option value="">-- Chọn phiếu báo giá --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Thỏa thuận hóa đơn</label>
                                    <textarea name="tthuan_hdon" rows="5" class="form-control"
                                        placeholder="Nhập thỏa thuận hóa đơn"></textarea>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm
                                        mới vật tư</p>
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_three">Vật tư thiết bị</th>
                                                    <th class="share_tb_two">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_two">Xuất xứ</th>
                                                    <th class="share_tb_two">Số lượng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_two">Thuế VAT</th>
                                                    <th class="share_tb_two">Tổng tiền sau VAT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="share_tb_one">
                                                        <p>
                                                            <img src="../img/remove.png" alt="xóa"
                                                                class="remo_cot_ngang share_cursor">
                                                        </p>
                                                    </td>
                                                    <td class="share_tb_three">
                                                        <div class="form-group share_form_select">
                                                            <select name="ma_vatt" class="ma_vatt">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="don_vi" class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="hang-san-xuat"
                                                                class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="xuat-xu" class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="so-luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="don-gia" class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="tien_tvat" class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="thue_vat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="tien_svat" class="form-control" disabled>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button"
                                            class="cancel_add mb_10 share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button"
                                            class="save_add mb_10 share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm hợp đồng
                                    mua?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hd_dy_pop">
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
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });

    $(".all_hthuc_hd").select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
    })

    $('.add_vat_tu').click(function() {
        var html = `<tr>
                        <td class="share_tb_one">
                            <p>
                                <img src="../img/remove.png" alt="xóa"
                                    class="remo_cot_ngang share_cursor">
                            </p>
                        </td>
                        <td class="share_tb_three">
                            <div class="form-group share_form_select">
                                <select name="ma_vatt" class="ma_vatt">
                                    <option value=""></option>
                                </select>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="don_vi" class="form-control" disabled>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="hang-san-xuat"
                                    class="form-control" disabled>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="text" name="xuat-xu" class="form-control" disabled>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="so-luong" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="don-gia" class="form-control" disabled>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="tien_tvat" class="form-control" disabled>
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="thue_vat" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_two">
                            <div class="form-group">
                                <input type="number" name="tien_svat" class="form-control" disabled>
                            </div>
                        </td>
                    </tr>`;
        $(".ctn_table .table tbody").append(html);
        widthSelect();
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".save_add").click(function(){
        var form_add_mua = $(".form_add_hp_mua");
        form_add_mua.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules:{
                ngay_ky:{
                    required: true,
                },
                nha_ccap:{
                    required: true,
                },
                dan_ctrinh:{
                    required: true,
                }
            },
            messages:{
                 ngay_ky:{
                    required: "Không được để trống",
                },
                nha_ccap:{
                    required: "Không được để trống",
                },
                dan_ctrinh:{
                    required: "Không được để trống",
                }
            },
        });

        if(form_add_mua.valid() === true){
            alert("oke");
        }
    });
</script>

</html>