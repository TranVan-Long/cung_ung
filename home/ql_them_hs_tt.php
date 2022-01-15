<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tạo hồ sơ thanh toán</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

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
    <div class="main-container ql_them_hs_tt ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-ho-so-thanh-toan.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Tạo hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" method="">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại hồ sơ thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_hs" class="form-control all_nhacc">
                                            <option value="">-- Chọn loại hồ sơ thanh toán --</option>
                                            <option value="1">Hồ sơ thanh toán hợp đồng</option>
                                            <option value="2">Hồ sơ thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_da_ct">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thực hiện</label>
                                         <input type="text" name="dia_chi" value="aaa" class="form-control" placeholder="Nhập địa chỉ" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đợt nghiệm thu <span class="cr_red">*</span></label>
                                        <input type="text" name="dot_nthu" class="form-control" placeholder="Nhập đợt nghiệm thu">
                                    </div>
                                    <div class="form-group">
                                        <label>Thời gian nghiệm thu</label>
                                        <input type="date" name="thoig_nthu" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời hạn thanh toán</label>
                                        <input type="date" name="thoih_ttoan" class="form-control">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one">STT</th>
                                                    <th class="share_tb_two">Mã vật tư</th>
                                                    <th class="share_tb_four">Tên vật tư</th>
                                                    <th class="share_tb_two">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_two">Xuất xứ</th>
                                                    <th class="share_tb_one">Số lượng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_four mr-10">Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="sh_bgr_four">
                                                    <td class="share_tb_one share_clr_four cr_weight">I</td>
                                                    <td class="share_tb_two share_clr_four cr_weight">Nâng cấp nhà thi đấu</td>
                                                    <td class="share_tb_four"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_four share_clr_four cr_weight">1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one">1</td>
                                                    <td class="share_tb_two">VT-0001</td>
                                                    <td class="share_tb_four">Xi măng</td>
                                                    <td class="share_tb_two">m3</td>
                                                    <td class="share_tb_two">Công ty A</td>
                                                    <td class="share_tb_two">Việt Nam</td>
                                                    <td class="share_tb_one">100</td>
                                                    <td class="share_tb_two">100.000</td>
                                                    <td class="share_tb_four">1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one">1</td>
                                                    <td class="share_tb_two">VT-0001</td>
                                                    <td class="share_tb_four">Xi măng</td>
                                                    <td class="share_tb_two">m3</td>
                                                    <td class="share_tb_two">Công ty A</td>
                                                    <td class="share_tb_two">Việt Nam</td>
                                                    <td class="share_tb_one">100</td>
                                                    <td class="share_tb_two">100.000</td>
                                                    <td class="share_tb_four">1.000.000</td>
                                                </tr>
                                                <tr class="sh_bgr_four">
                                                    <td class="share_tb_one share_clr_four cr_weight">II</td>
                                                    <td class="share_tb_two share_clr_four cr_weight">Phải thanh toán</td>
                                                    <td class="share_tb_four"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_four share_clr_four cr_weight">1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two">Tổng cộng trước VAT</td>
                                                    <td class="share_tb_four"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_four">1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two">Thuế VAT</td>
                                                    <td class="share_tb_four"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_four">10%</td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two">Tổng cộng sau VAT</td>
                                                    <td class="share_tb_four"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_one"></td>
                                                    <td class="share_tb_two"></td>
                                                    <td class="share_tb_four">1.000.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hs_button">
                                        <button type="button"
                                                class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="submit"
                                                class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc tạo hồ sơ?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hs_dy_pop">
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

    var cancel_add = $(".cancel_add");
    cancel_add.click(function(){
        modal_share.show();
    });

    $(".save_add").click(function(){
        var form_validate = $(".form_add_hp_mua");
        form_validate.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules:{
                loai_hs:{
                    required: true,
                },
                hdong_dhang:{
                    required: true,
                },
                dot_nthu:{
                    required: true,
                }
            },
            messages:{
                loai_hs:{
                    required: "Không được để trống",
                },
                hdong_dhang:{
                    required: "Không được để trống",
                },
                dot_nthu:{
                    required: "Không được để trống",
                }
            }
        });
        if(form_validate.valid() === true){
            alert("đúng");
        }
    });
</script>

</html>
