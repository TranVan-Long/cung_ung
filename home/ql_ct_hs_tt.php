<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết hồ sơ thanh toán</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container  ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd mt_27 w_100 fload_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-ho-so-thanh-toan.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 fload_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi tiết hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng / Đơn hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ-198-24201</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị thực hiện</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Công ty A</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đợt nghiệm thu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">NT-999-19511</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời gian</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">14/10/2021</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời hạn thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">14/10/2021</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Trạng thái</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Chưa hoàn thành</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Nguyễn Văn A</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">10/10/2021</p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 fload_l">
                            <div class="ctn_table_ct w_100 fload_l khac_ctn_vc">
                                <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one">STT</th>
                                                    <th class="share_tb_three">Vật tư</th>
                                                    <th class="share_tb_two">Đơn vị tính</th>
                                                    <th class="share_tb_two mass_pad">
                                                        <div class="w_100 fload_l">
                                                            <p class="w_100 fload_l khoi_luong share_clr_tow">Đơn hàng</p>
                                                            <div class="d_flex w_100 fload_l dvi_khoil">
                                                                <p class="ft-pl share_clr_tow">Số lượng</p>
                                                                <p class="ft-pl share_clr_tow">Giá trị</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="share_tb_two">Đơn giá thực hiện</th>
                                                    <th class="share_tb_four mass_pad">
                                                        <div class="w_100 fload_l">
                                                            <p class="w_100 fload_l khoi_luong share_clr_tow">Khối lượng thực hiện</p>
                                                            <div class="d_flex w_100 fload_l dvi_khoil">
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Lũy kế kỳ trước</p>
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Kỳ này</p>
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Lũy kế đến nay</p>
                                                                <p class="ft-pl share_clr_tow">% thực hiện</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="share_tb_four mass_pad">
                                                        <div class="w_100 fload_l">
                                                            <p class="w_100 fload_l khoi_luong share_clr_tow">Giá trị thực hiện</p>
                                                            <div class="d_flex w_100 fload_l dvi_khoil">
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Lũy kế kỳ trước</p>
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Kỳ này</p>
                                                                <p class="ft-pl sh_bor_r share_clr_tow">Lũy kế đến nay</p>
                                                                <p class="ft-pl share_clr_tow">% thực hiện</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="share_tb_two mass_pad">
                                                        <div class="w_100 fload_l">
                                                            <p class="w_100 fload_l khoi_luong share_clr_tow">Giá trị đơn hàng còn lại</p>
                                                            <div class="d_flex w_100 fload_l dvi_khoil">
                                                                <p class="ft-pl share_clr_tow">Khối lượng</p>
                                                                <p class="ft-pl share_clr_tow">Giá trị</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="sh_bgr_four">
                                                    <td class="share_tb_one cr_weight share_clr_four">I</td>
                                                    <td class="share_tb_three cr_weight share_clr_four">Nâng cấp quốc lộ 999</td>
                                                    <td class="share_tb_two cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four">33.000.000</td>
                                                    <td class="share_tb_two cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four ">13.000.000</td>
                                                    <td class="share_tb_one cr_weight share_clr_four">20.000.000</td>
                                                    <td class="share_tb_one cr_weight share_clr_four">33.000.000</td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                    <td class="share_tb_one cr_weight share_clr_four"></td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one">1</td>
                                                    <td class="share_tb_three">Dầu hỏa</td>
                                                    <td class="share_tb_two">lit</td>
                                                    <td class="share_tb_one">650</td>
                                                    <td class="share_tb_one">11.000.000</td>
                                                    <td class="share_tb_two">13.000</td>
                                                    <td class="share_tb_one">43</td>
                                                    <td class="share_tb_one">20</td>
                                                    <td class="share_tb_one">60</td>
                                                    <td class="share_tb_one">50 %</td>
                                                    <td class="share_tb_one">20.000.000</td>
                                                    <td class="share_tb_one">13.000.000</td>
                                                    <td class="share_tb_one">10.000.000</td>
                                                    <td class="share_tb_one">10 %</td>
                                                    <td class="share_tb_one">10</td>
                                                    <td class="share_tb_one"></td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one">2</td>
                                                    <td class="share_tb_three">Xăng</td>
                                                    <td class="share_tb_two">lit</td>
                                                    <td class="share_tb_one">650</td>
                                                    <td class="share_tb_one">11.000.000</td>
                                                    <td class="share_tb_two">13.000</td>
                                                    <td class="share_tb_one">43</td>
                                                    <td class="share_tb_one">20</td>
                                                    <td class="share_tb_one">60</td>
                                                    <td class="share_tb_one">50 %</td>
                                                    <td class="share_tb_one">20.000.000</td>
                                                    <td class="share_tb_one">13.000.000</td>
                                                    <td class="share_tb_one">10.000.000</td>
                                                    <td class="share_tb_one">10 %</td>
                                                    <td class="share_tb_one">10</td>
                                                    <td class="share_tb_one"></td>
                                                </tr>
                                                <tr>
                                                    <td class="share_tb_one">2</td>
                                                    <td class="share_tb_three">Xăng</td>
                                                    <td class="share_tb_two">lit</td>
                                                    <td class="share_tb_one">650</td>
                                                    <td class="share_tb_one">11.000.000</td>
                                                    <td class="share_tb_two">13.000</td>
                                                    <td class="share_tb_one">43</td>
                                                    <td class="share_tb_one">20</td>
                                                    <td class="share_tb_one">60</td>
                                                    <td class="share_tb_one">50 %</td>
                                                    <td class="share_tb_one">20.000.000</td>
                                                    <td class="share_tb_one">13.000.000</td>
                                                    <td class="share_tb_one">10.000.000</td>
                                                    <td class="share_tb_one">10 %</td>
                                                    <td class="share_tb_one">10</td>
                                                    <td class="share_tb_one"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 fload_l d_flex">
                            <div class="xuat_gmc_one share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                            </div>
                            <div class="xuat_gmc_two share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hs">Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="chinh-sua-ho-so-thanh-toan.html" class="share_clr_tow">Chỉnh sửa</a></p>
                            </div>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỒ SƠ THANH TOÁN</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hồ sơ thanh toán này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button"
                                        class="js_btn_huy share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button"
                                        class="share_w_148 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
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
<script type="text/javascript">
    var remove_hs = $(".remove_hs");

    remove_hs.click(function() {
        modal_share.show();
    });

</script>

</html>
