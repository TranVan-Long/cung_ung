<?php
include("config.php");
include("../includes/icon.php");

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $display = $_GET['ht'] : $display = 10;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiêu chí đánh giá</title>
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
    <div class="main-container ql_chung">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20 d-flex align-items-center spc-btw">
                    <p class="left page-title">Đánh giá nhà cung cấp</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-tieu-chi-danh-gia.html">&plus; Thêm mới</a>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1">Tiêu chí đánh giá</option>
                                    <option value="2">Kiểu giá trị</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="list_tc w_100 left" data="<?= $page ?>"  data1="<?= $display ?>"></div>
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
<script>
    var category = $("#category").val();
    var search = $("#search").val();
    var page = $(".list_tc").attr("data");
    var display = $(".list_tc").attr("data1");

    $("#category").change(function() {
        var list_id = $(this).val();
        $.ajax({
            url: '../render/tc-search-detail.php',
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
        url: '../render/tc-search.php',
        type: 'POST',
        data: {
            category: category,
            search: search,
            page: page,
            display: display
        },
        success: function(data) {
            $(".list_tc").append(data);
        }
    });

    $("#category, #search").change(function() {
        var category = $("#category").val();
        var search = $("#search").val();
        var page = $(".list_tc").attr("data");
        var display = $(".list_tc").attr("data1");
        $.ajax({
            url: '../render/tc-search.php',
            type: 'POST',
            data: {
                category: category,
                search: search,
                page: page,
                display: display
            },
            success: function(data) {
                $(".list_tc").html(data);
            }
        });
    });
</script>

</html>