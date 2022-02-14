<?php
include "../includes/icon.php";
include "config.php";

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $display = $_GET['ht'] : $display = 10;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yêu cầu vật tư</title>
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
    <div class="main-container ql_chung ql_vat_tu">
        <?php include "../includes/sidebar.php" ?>
        <div class="container">
            <div class="header-container">
                <?php include '../includes/ql_header_nv.php' ?>
            </div>
            <div class="content">
                <div class="c-top border-bottom-2">
                    <h4 class="left mr-10">Yêu cầu vật tư công trình</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body">
                    <div class="w-100 left">
                        <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-yeu-cau-vat-tu.html">&plus; Thêm mới</a>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1">Số phiếu yêu cầu</option>
                                    <option value="2">Ngày gửi</option>
                                    <option value="3">Công trình</option>
                                    <option value="4">Ngày phải hoàn thành</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter2">
                        <label class="filter-container" for="all">Tất cả
                            <input type="radio" id="all" name="filter2" value="" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="not-approved">Chưa duyệt
                            <input type="radio" id="not-approved" name="filter2" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="approved">Đã duyệt
                            <input type="radio" id="approved" name="filter2" value="2" >
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="denied">Từ chối
                            <input type="radio" id="denied" name="filter2" value="3">
                            <span class="checkmark"></span>
                        </label>
                        
                    </div>
                    <div class="filter3">
                        <label class="filter-container" for="not-completed">Thuộc công trình chưa hoàn thành
                            <input type="radio" id="not-completed" name="filter3" value="1" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="completed">Thuộc công trình đã hoàn thành
                            <input type="radio" id="completed" name="filter3" value="2">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="list_ycvt w_100 left" data="<?= $page ?>" data1="<?= $display ?>"></div>
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
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    var category = $("#category").val();
    var search = $("#search").val();
    var filter2 = $("input[name='filter2']:checked").val();
    var filter3 = $("input[name='filter3']:checked").val();
    var page = $(".list_ycvt").attr("data");
    var display = $(".list_ycvt").attr("data1");

    $.ajax({
        url: '../render/ycvt-search.php',
        type: 'POST',
        data: {
            category: category,
            search: search,
            filter2: filter2,
            filter3: filter3,
            page: page,
            display: display
        },
        success: function(data) {
            $(".list_ycvt").append(data);
        }
    });

    $("#category").change(function() {
        var list_id = $(this).val();
        $.ajax({
            url: '../render/ycvt-search-detail.php',
            type: 'POST',
            data: {
                list_id: list_id
            },
            success: function(data) {
                $("#search").html(data);
            }
        });
    });
    $("#search").change(function() {
        var category = $("#category").val();
        var search = $("#search").val();
        var page = $(".list_ycvt").attr("data");
        var display = $(".list_ycvt").attr("data1");
        $.ajax({
            url: '../render/ycvt-search.php',
            type: 'POST',
            data: {
                category: category,
                search: search,
                page: page,
                display: display
            },
            success: function(data) {
                $(".list_ycvt").html(data);
            }
        });
    });
    $("input[name='filter2'],input[name='filter3']").change(function() {
        var category = $("#category").val();
        var search = $("#search").val();
        var page = $(".list_ycvt").attr("data");
        var display = $(".list_ycvt").attr("data1");
        var filter2 = $("input[name='filter2']:checked").val();
        var filter3 = $("input[name='filter3']:checked").val();
        $.ajax({
            url: '../render/ycvt-search.php',
            type: 'POST',
            data: {
                category: category,
                search: search,
                page: page,
                display: display,
                filter2:filter2,
                filter3:filter3,
            },
            success: function(data) {
                $(".list_ycvt").html(data);
            }
        });
    });

    
</script>

</html>