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
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd w_100 fload_l">
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 fload_l share_fsize_tow share_clr_one cr_weight_bold">Tạo hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 fload_l" method="">
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại hồ sơ thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_hs" class="form-control all_nhacc">
                                            <option value="">-- Chọn loại hồ sơ thanh toán --</option>
                                            <option value="1">Hồ sơ thanh toán hợp đồng</option>
                                            <option value="2">Hồ sơ thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_da_ct">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thực hiện <span class="cr_red">*</span></label>
                                         <input type="text" name="dia_chi" value="aaa" class="form-control" placeholder="Nhập địa chỉ" disabled>
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Đợt nghiệm thu <span class="cr_red">*</span></label>
                                        <input type="text" name="dot_nthu" class="form-control" placeholder="Nhập đợt nghiệm thu">
                                    </div>
                                    <div class="form-group">
                                        <label>Thời gian nghiệm thu</label>
                                        <input type="date" name="thoig_nthu" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Thời hạn thanh toán</label>
                                        <input type="date" name="thoih_ttoan" class="form-control">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 fload_l">
                                    <div class="ctn_table w_100 fload_l">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one" rowspan="2">STT</th>
                                                    <th class="share_tb_three" rowspan="2">Vật tư</th>
                                                    <th class="share_tb_two" rowspan="2">Đơn vị tính</th>
                                                    <th class="share_tb_two sh_bor_b" colspan="2">Đơn hàng</th>
                                                    <th class="share_tb_two" rowspan="2">Đơn giá thực hiện</th>
                                                    <th class="share_tb_four sh_bor_b" colspan="4">Khối lượng thực hiện</th>
                                                    <th class="share_tb_four sh_bor_b" colspan="4">Giá trị thực hiện</th>
                                                    <th class="share_tb_tow sh_bor_b" colspan="2">Giá trị đơn hàng còn lại</th>
                                                </tr>
                                                <tr>
                                                    <th class="share_tb_one">Số lượng</th>
                                                    <th class="share_tb_one sh_bor_r">Giá trị</th>
                                                    <th class="share_tb_one">Lũy kế kỳ trước</th>
                                                    <th class="share_tb_one">Kỳ này</th>
                                                    <th class="share_tb_one">Lũy kế đến nay</th>
                                                    <th class="share_tb_one sh_bor_r">% thực hiện</th>
                                                    <th class="share_tb_one">Lũy kế kỳ trước</th>
                                                    <th class="share_tb_one">Kỳ này</th>
                                                    <th class="share_tb_one">Lũy kế đến nay</th>
                                                    <th class="share_tb_one sh_bor_r">% thực hiện</th>
                                                    <th class="share_tb_one">Khối lượng</th>
                                                    <th class="share_tb_one">Giá trị</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>I</td>
                                                    <td>Nâng cấp quốc lộ 999</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>33.000.000</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>13.000.000</td>
                                                    <td>20.000.000</td>
                                                    <td>33.000.000</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Dầu hỏa</td>
                                                    <td>lit</td>
                                                    <td>650</td>
                                                    <td>11.000.000</td>
                                                    <td>13.000</td>
                                                    <td>43</td>
                                                    <td>20</td>
                                                    <td>60</td>
                                                    <td>50 %</td>
                                                    <td>20.000.000</td>
                                                    <td>13.000.000</td>
                                                    <td>10.000.000</td>
                                                    <td>10 %</td>
                                                    <td>10</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
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
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script>
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });
</script>

</html>