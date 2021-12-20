<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cài đặt chung</title>
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
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_cd mt_25 w_100 float_l">
                        <div class="top_sett w_100 float_l">
                            <div class="ctn_top_sett w_100 float_l">
                                <p class="caidc_ql active"><a href="quan-ly-cai-dat.html" class="cai_dtl">Cài đặt chung</a></p>
                                <p class="his_ql"><a href="nhat-ky-hoat-dong.html" class="cai_dtl">Nhật ký hoạt động</a></p>
                            </div>
                        </div>
                        <div class="ctn_sett w_100 float_l">
                            <div class="languega w_100 float_l">
                                <div class="ctn_languega d_flex flex_jct fl_agi">
                                    <p class="share_fsize_one share_clr_one cr_weight">Ngôn ngữ</p>
                                    <div class="ct_select">
                                        <select name="" class="all_languega share_fsize_one share_clr_one">
                                            <option value="1">Tiếng Việt (VN)</option>
                                            <option value="2">English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="quyen_nd w_100 float_l">
                                <div class="ctn_quyen d_flex flex_jct fl_agi">
                                    <a href="cai-dat-phan-quyen.html" class="share_fsize_one share_clr_one cr_weight">Quyền người dùng</a>
                                    <span class="dg_quyen share_cursor"><img src="../img/exp.png" alt="quyền người dùng"></span>
                                </div>
                            </div>
                            <div class="thong_bao w_100 float_l mb_25">
                                <div class="ctn_top_tbao mb_20 w_100 float_l d_flex flex_jct fl_agi">
                                    <p class="share_fsize_one share_clr_one cr_weight">Thông báo</p>
                                    <span class="dropd share_cursor" data-tab="thong_bao"><img src="../img/exp.png" alt="thông báo"></span>
                                </div>
                                <div class="ctn_ct_tbao w_100 float_l share_bgr_tow" id="thong_bao">
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhận thông báo khi có thay đổi ở tất cả các nội dung tôi xem được</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="myonoffswitch" checked="checked">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="myonoffswitch">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhận thông báo khi có phản hồi từ các nội dung tôi tạo ra</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="tb_phan_hoi">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="tb_phan_hoi">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhận thông báo khi có thay đổi ở các nội dung tôi tạo ra</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="tb_thay_doi" checked="checked">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="tb_thay_doi">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nhac_nho w_100 float_l">
                                <div class="ctn_top_tbao mb_20 w_100 float_l d_flex flex_jct fl_agi">
                                    <p class="share_fsize_one share_clr_one cr_weight">Nhắc nhở</p>
                                    <span class="dropd share_cursor" data-tab="nhac_nho"><img src="../img/exp.png" alt="nhắc nhở"></span>
                                </div>
                                <div class="ctn_ct_tbao w_100 float_l share_bgr_tow" id="nhac_nho">
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhắc nhở khi tất cả các nội dung tôi xem được đến hạn/quá hạn</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="nn_all" checked="checked">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="nn_all">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhắc nhở khi các nội dung tôi theo dõi đến hạn/quá hạn</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="nn_noid">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="nn_noid">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbao_one d_flex flex_jct fl_agi">
                                        <p class="share_fsize_tow share_clr_one cr_weight">Nhắc nhở khi có các nội dung tôi tạo ra đến hạn/quá hạn</p>
                                        <div class="sett_right_one">
                                            <div class="tax-onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox"
                                                    id="nn_tt_qh">
                                                <label class="onoffswitch-label share_cursor btx_security_tclass" for="nn_tt_qh">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include("../modals/modal_logout.php")?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
    $(".thong_bao .dropd").click(function(){
        $(this).toggleClass("active");
        $(".thong_bao .ctn_ct_tbao").toggleClass("active");
    });

    $(".nhac_nho .dropd").click(function(){
        $(this).toggleClass("active");
        $(".nhac_nho .ctn_ct_tbao").toggleClass("active");
    })
</script>

</html>
