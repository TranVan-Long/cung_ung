<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng giá</title>
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
    <div class="main-container">
        <!--    a-side menu-->
        <?php include("../includes/sidebar.php") ?>
        <!--    a-side menu end-->

        <div class="container">
            <!--        header-->
            <div class="d-flex justify-content-center">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <!--        header end-->
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20">
                    <p class="left page-title">Bảng giá</p>
                    <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left mt-10">
                        <label for="gia-vat-tu-ngay">Bảng giá vật tư ngày</label>
                        <input class="date-input" type="date" id="gia-vat-tu-ngay" name="gia-vat-tu-ngay">
                    </div>
                    <div class="w-100 left">
                        <div class="category v-select2 mt-20">
                            <select name="category" class="share_select">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1">Mã yêu cầu</option>
                                <option value="2">Ngày gửi</option>
                                <option value="3">Công trình</option>
                                <option value="4">Ngày phải hoàn thành</option>
                            </select>
                        </div>
                        <div class="search-box v-select2 mt-20">
                            <select name="search" class="share_select">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                            </select>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper">
                            <div class="table-container table-1791">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>

                                                <th class="w-5">STT</th>
                                                <th class="w-15">Mã vật tư</th>
                                                <th class="w-25">Tên vật tư</th>
                                                <th class="w-10">Đơn vị tính</th>
                                                <th class="w-10">Giá thấp nhất</th>
                                                <th class="w-10">Giá cao nhất</th>
                                                <th class="w-25">Danh sách giá theo nhà cung cấp</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25 share_clr_four share_cursor see_ds">+ Xem danh sách giá
                                                    theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5">1</td>
                                                <td class="w-15">VT-000-13456</td>
                                                <td class="w-25">Aptomat 3fa - 60A - LS</td>
                                                <td class="w-10">Cái</td>
                                                <td class="w-10">60.000</td>
                                                <td class="w-10">70.000</td>
                                                <td class="w-25">+ Xem danh sách giá theo nhà cung cấp</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left mt-20">
                    <div class="display">
                        <label for="display">Hiển thị</label>
                        <select name="display" id="display">
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <ul>
                            <li><a href="#"><?php echo $ic_lt ?></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><?php echo $ic_gt ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="modal_share modal_share_tow list_cate_nhacc">
            <div class="modal-content">
                <div class="info_modal">
                    <div class="modal-header">
                        <div class="header_ctn_share">
                            <h4 class="ctn_share_h share_clr_tow tex_left padd_l cr_weight_bold">BÁO GIÁ: Tên vật tư thiết bị</h4>
                            <span class="close_detl close_dectl">&times;</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="ctn_body_modal">
                            <div class="madal_form">
                                <div class="sapx_dgia w_100 float_l share_bgr_tow d_flex fl_agi mb_15">
                                    <p class="share_clr_one share_fsize_tow mr_10 cr_weight">Đơn giá:</p>
                                    <div class="form_search_dgia">
                                        <select name="search_dgia" class="form-control w_100 search_dgia">
                                            <option value="">Không sắp xếp</option>
                                            <option value="1">Từ thấp đến cao</option>
                                            <option value="2">Từ cao đến thấp</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="search_nhacc w_100 float_l mb_15">
                                    <div class="selec_nhacc share_form_select w_100 float_l">
                                        <select name="timk_nhacc" class="form-control timk_nhacc">
                                            <option value="">Tìm kiếm theo tên nhà cung cấp</option>
                                        </select>
                                        <span class="ico_timk"></span>
                                    </div>
                                </div>
                                <div class="sroll_ds_gia w_100 float_l">
                                    <div class="ctiet_ds_nha_cc w_100 float_l">
                                        <table class="table">
                                            <thead>
                                                <tr class="d_flex fl_agi dflex_jc">
                                                    <th class="d_flex fl_agi dflex_jc">Nhà cung cấp</th>
                                                    <th class="d_flex fl_agi dflex_jc">Đơn giá (VNĐ)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Nhà cung cấp A</td>
                                                    <td>1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td>Nhà cung cấp B</td>
                                                    <td>1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td>Nhà cung cấp B</td>
                                                    <td>1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td>Nhà cung cấp B</td>
                                                    <td>1.000.000</td>
                                                </tr><tr>
                                                    <td>Nhà cung cấp B</td>
                                                    <td>1.000.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("../modals/modal_logout.php") ?>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">

var see_ds = $(".see_ds");
var list_cate_nhacc = $(".list_cate_nhacc");

see_ds.click(function() {
    list_cate_nhacc.show();
});

$(window).click(function(e) {
    if ($(e.target).is(".list_cate_nhacc")) {
        list_cate_nhacc.hide();
    }
});

$(".search_dgia, .timk_nhacc").select2({
    width: '100%',
});

$(".see_ds").click(function(){
    if($(".ctiet_ds_nha_cc .table tbody").height() > 249.5){
        $(".ctiet_ds_nha_cc .table thead tr").css('width','calc(100% - 10px)');
    }
});

</script>

</html>