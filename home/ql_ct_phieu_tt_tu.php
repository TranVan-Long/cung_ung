<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết phiếu thanh toán</title>
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
    <div class="main-container ql_ct_phieu_tt_tu">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd mt_25 w_100 fload_l">
                        <a class="prew_href share_fsize_one mb_25 share_clr_one" href="quan-ly-hop-dong.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 fload_l share_fsize_tow share_clr_four cr_weight_bold mb_25">Chi tiết phiếu thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng / Đơn hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ-991-10014</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số phiếu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">PH-000-98157</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nhà cung cấp</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Công ty ABCXYZ</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">14/10/2021</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hình thức thanh toán</p>
                                    <p class="cr_weight share_fsize_tow cr_red">Tiền mặt</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Loại thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Tạm ứng</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị chi trả</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Công ty X</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị thụ hưởng</p>
                                    <p class="cr_weight share_fsize_tow">Công ty A</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l share_dnone">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số tiền</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">25.000.000</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tỷ giá</p>
                                    <p class="cr_weight share_fsize_tow">1</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l share_dnone">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giá trị quy đổi</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">25.000.000</p>
                                </div>
                                <div class="ctiet_hd_right">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Phí giao dịch</p>
                                    <p class="cr_weight share_fsize_tow">0</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_right fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người nhận tiền</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Nguyễn Văn A</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Trạng thái</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Hoàn thành</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 fload_l">
                                <div class="ctiet_hd_left fload_l">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Nguyễn Thị C</p>
                                </div>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 fload_l d_flex">
                            <div class="xuat_gmc_one share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                            </div>
                            <div class="xuat_gmc_two share_xuat_gmc d_flex">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red">Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="chinh-sua-hop-dong-van-chuyen.html" class="share_clr_tow">Chỉnh sửa</a>
                                </p>
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
