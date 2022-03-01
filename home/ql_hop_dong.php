<?php
include "../includes/icon.php";
include "config.php";

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $display = $_GET['ht'] : $display = 10;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hợp đồng</title>
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
    <div class="main-container ql_hop_dong ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Hợp đồng</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="add_hopd">
                            <p class="add_creart_hd ml-10 share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">
                                &plus; Thêm mới</p>
                            <div class="all_hopd share_bgr_tow">
                                <p class="hd_mua_vt">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-mua.html">
                                        Hợp đồng mua vật tư</a>
                                </p>
                                <p class="hopd_bvt">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-ban.html">
                                        Hợp đồng bán vật tư</a>
                                </p>
                                <p class="hopd_thue_tb">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-thue-thiet-bi.html">
                                        Hợp đồng thuê thiết bị</a>
                                </p>
                                <p class="hopd_thue_vc">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-van-chuyen.html">
                                        Hợp đồng thuê vận chuyển</a>
                                </p>
                            </div>
                        </div>
                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1">Hợp đồng mua vật tư</option>
                                    <option value="2">Hợp đồng bán vật tư</option>
                                    <option value="3">Hợp đồng thuê thiết bị</option>
                                    <option value="4">Hợp đồng thuê vận chuyển</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_o" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="list_hd w_100 left" data="<?= $page ?>" data1="<?= $display ?>"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
    var category = $("#category").val();
    var search = $("#search").val();
    var page = $(".list_hd").attr("data");
    var display = $(".list_hd").attr("data1");

    $("#category").change(function() {
        var list_id = $(this).val();
        $.ajax({
            url: '../render/hd-search-detail.php',
            type: 'POST',
            data: {
                list_id: list_id
            },
            success: function(data) {
                $("#search").html(data);
            }
        });
    });

    $.ajax({
        url: '../render/hd-search.php',
        type: 'POST',
        data: {
            category: category,
            search: search,
            page: page,
            display: display
        },
        success: function(data) {
            $(".list_hd").append(data);
        }
    });

    $("#category, #search").change(function() {
        var category = $("#category").val();
        var search = $("#search").val();
        var page = $(".list_hd").attr("data");
        var display = $(".list_hd").attr("data1");
        $.ajax({
            url: '../render/hd-search.php',
            type: 'POST',
            data: {
                category: category,
                search: search,
                page: page,
                display: display
            },
            success: function(data) {
                $(".list_hd").html(data);
            }
        });
    });

    $(".tim_kiem, .tim_kiem_o").select2({
        width: '100%',
    });

    var add_creart_hd = $(".add_creart_hd");
    var all_hopd = $(".all_hopd");

    $(".add_creart_hd").click(function() {
        $(".all_hopd").toggleClass("active");
    })

    $(window).click(function(e) {
        if (!add_creart_hd.is(e.target) && !all_hopd.is(e.target) && add_creart_hd.has(e.target).length == 0) {
            all_hopd.removeClass("active");
        }
    })
</script>

</html>