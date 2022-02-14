<?php
include("config.php");
include("../includes/icon.php");


isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = $_GET['ht'] : $ht = 10;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đánh giá nhà cung cấp</title>
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
                    <h4 class="left page-title">Đánh giá nhà cung cấp</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-danh-gia-nha-cung-cap.html">&plus; Thêm mới</a>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1">Số phiếu</option>
                                    <option value="2">Nhà cung cấp</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select search_tt">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="danh_sach_dg w_100 float_l" data="<?= $page ?>" data1="<?= $ht ?>"></div>

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
    var timkiem = $(".tim_kiem").val();
    var search_tt = $(".search_tt").val();
    var page = $(".danh_sach_dg").attr("data");
    var ht = $(".danh_sach_dg").attr("data1");

    $.ajax({
        url: '../render/tktt-danh-gia.php',
        type: 'POST',
        data:{
            timkiem: timkiem,
        },
        success: function(data){
            $(".search_tt").append(data);
        }
    });

    $.ajax({
        url: '../render/ds_danh_gia.php',
        type: 'POST',
        data:{
            timkiem: timkiem,
            search_tt: search_tt,
            page: page,
            ht: ht,
        },
        success: function(data){
            $(".danh_sach_dg").append(data);
        }
    });

    function hien_thi_doi(){
        // $("#display").change(function(){
            var ht = $("#display").val();
            var page = "<?= $page ?>";
            var tt = ht * page;
            var total = $("#display").attr("data1");
            if(tt > total){
                page--;
                if(page == "" && ht != ""){
                    window.location.href = 'danh-gia-nha-cung-cap.html?ht='+ht;
                }else if(page != "" && ht != ""){
                    window.location.href = 'danh-gia-nha-cung-cap.html?ht='+ht+'&page='+page;
                }
            }else{
                if(page == "" && ht != ""){
                    window.location.href = 'danh-gia-nha-cung-cap.html?ht='+ht;
                }else if(page != "" && ht != ""){
                    window.location.href = 'danh-gia-nha-cung-cap.html?ht='+ht+'&page='+page;
                }
            }
        // })
    }

    $(".tim_kiem").change(function(){
        var timk = $(this).val();
        $.ajax({
            url: '../render/tktt-danh-gia.php',
            type: 'POST',
            data:{
                timkiem: timk,
            },
            success: function(data){
                $(".search_tt").html(data);
            }
        });
    });

    $(".tim_kiem, .search_tt").change(function(){
        var gia_tri = $(".search_tt").val();
        var tt_cha = $(".tim_kiem").val();
        var page = $(".danh_sach_dg").attr("data");
        var hien_thi = $(".danh_sach_dg").attr("data1");
        $.ajax({
            url: '../render/ds_danh_gia.php',
            type: 'POST',
            data:{
                page: page,
                search_tt: gia_tri,
                timkiem: tt_cha,
                ht: hien_thi,
            },
            success: function(data){
                $(".danh_sach_dg").html(data);
            }
        })
    });

</script>
</html>