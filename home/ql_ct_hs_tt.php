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
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="#">Quay lại</a>
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
                            <div class="ctn_table_ct w_100 fload_l">
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
                        <div class="xuat_gmc w_100 fload_l d_flex">
                            <div class="xuat_gmc_one share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                            </div>
                            <div class="xuat_gmc_two share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red">Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="#" class="share_clr_tow">Chỉnh sửa</a></p>
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
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>

</html>
