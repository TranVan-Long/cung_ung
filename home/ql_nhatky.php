<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhật ký hoạt động</title>
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
    <div class="main-container ql_ctiet_hd_vc">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_cd mt_25 w_100 fload_l">
                        <div class="top_sett w_100 fload_l">
                            <div class="ctn_top_sett w_100 fload_l">
                                <p class="caidc_ql"><a href="quan-ly-cai-dat.html" class="cai_dtl">Cài đặt chung</a></p>
                                <p class="his_ql active"><a href="nhat-ky-hoat-dong.html" class="cai_dtl">Nhật ký hoạt động</a></p>
                            </div>
                        </div>
                        <div class="ctn_sett w_100 fload_l">
                            <div class="nhat_ky_nd w_100 fload_l">
                                <div class="thead_nhatk fload_l w_100 d_flex share_bgr_one">
                                    <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Ngày/tháng/năm</p>
                                    <p class="share_tb_nine share_clr_tow share_fsize_tow cr_weight">Công việc</p>
                                    <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Thời gian</p>
                                    <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Chức năng</p>
                                </div>
                            </div>
                            <div class="ctiet_nhatk share_bgr_tow w_100 fload_l">
                                <div class="ctn_ctiet_nky">
                                    <p class="dropd_ctiet w_100 fload_l"><span class="mr_10">Hôm nay</span> <img src="../img/exp.png" alt="" class="avt_dropd share_cursor"></p>
                                    <div class="ctiet_nd_nhatk w_100 fload_l d_flex">
                                        <p class="share_tb_four"></p>
                                        <p class="share_tb_nine share_fsize_tow"><span class="cr_weight">Yêu cầu mua vật tư mới</span><br><span>Bạn đã đề xuất mua thêm vật tư</span></p>
                                        <p class="share_tb_four cr_weight share_fsize_tow">15:00</p>
                                        <p class="share_tb_four d_flex share_cursor"><img src="../img/remove.png" alt="xóa nhật ký"> <span class="ml_5 padd_t cr_red">Xóa</span></p>
                                    </div>
                                    <div class="ctiet_nd_nhatk w_100 fload_l d_flex">
                                        <p class="share_tb_four"></p>
                                        <p class="share_tb_nine share_fsize_tow"><span class="cr_weight">Yêu cầu mua vật tư mới</span><br><span>Bạn đã đề xuất mua thêm vật tư</span></p>
                                        <p class="share_tb_four cr_weight share_fsize_tow">15:00</p>
                                        <p class="share_tb_four d_flex share_cursor"><img src="../img/remove.png" alt="xóa nhật ký"> <span class="ml_5 padd_t cr_red">Xóa</span></p>
                                    </div>
                                </div>
                                <div class="ctn_ctiet_nky">
                                    <p class="dropd_ctiet"><span class="mr_10">15/11/2021</span> <img src="../img/exp.png" alt="" class="avt_dropd share_cursor"></p>
                                    <div class="ctiet_nd_nhatk w_100 fload_l d_flex">
                                        <p class="share_tb_four"></p>
                                        <p class="share_tb_nine share_fsize_tow"><span class="cr_weight">Yêu cầu mua vật tư mới</span><br><span>Bạn đã đề xuất mua thêm vật tư</span></p>
                                        <p class="share_tb_four cr_weight share_fsize_tow">15:00</p>
                                        <p class="share_tb_four d_flex share_cursor"><img src="../img/remove.png" alt="xóa nhật ký"> <span class="ml_5 padd_t cr_red">Xóa</span></p>
                                    </div>
                                    <div class="ctiet_nd_nhatk w_100 fload_l d_flex">
                                        <p class="share_tb_four"></p>
                                        <p class="share_tb_nine share_fsize_tow"><span class="cr_weight">Yêu cầu mua vật tư mới</span><br><span>Bạn đã đề xuất mua thêm vật tư</span></p>
                                        <p class="share_tb_four cr_weight share_fsize_tow">15:00</p>
                                        <p class="share_tb_four d_flex share_cursor"><img src="../img/remove.png" alt="xóa nhật ký"> <span class="ml_5 padd_t cr_red">Xóa</span></p>
                                    </div>
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
    $(".dropd_ctiet").click(function(){
        $(this).parents(".ctn_ctiet_nky").find(".ctiet_nd_nhatk").toggle();
    })
</script>
</html>