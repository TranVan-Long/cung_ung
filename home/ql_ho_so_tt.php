<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hồ sơ thanh toán</title>
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
    <div class="main-container ql_ho_so_tt ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Hồ sơ thanh toán</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="add_hopd ml_20">
                            <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">&plus; Thêm mới</p>
                        </div>

                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1">Mã yêu cầu</option>
                                    <option value="2">Ngày gửi</option>
                                    <option value="3">Công trình</option>
                                    <option value="4">Ngày phải hoàn thành</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_o">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="c-content">
                        <div class="ctn_table_share w_100 float_l">
                            <span class="scroll_left share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên trái"></span>
                            <div class="share_tb_hd w_100 float_l">
                                <table class="table w_100 float_l">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_seven">STT</th>
                                            <th class="share_tb_eight">Đợt nghiệm thu</th>
                                            <th class="share_tb_two">Thời gian nghiệm thu</th>
                                            <th class="share_tb_four">Đơn vị thực hiện</th>
                                            <th class="share_tb_eight">Hợp đồng đơn hàng</th>
                                            <th class="share_tb_eight">Thời hạn thanh toán</th>
                                            <th class="share_tb_two">Giá trị thực hiện sau VAT</th>
                                            <th class="share_tb_eight">Giá trị bảo hành</th>
                                            <th class="share_tb_eight">Thu hồi tạm ứng</th>
                                            <th class="share_tb_eight">Đã thanh toán</th>
                                            <th class="share_tb_eight">Còn lại</th>
                                            <th class="share_tb_eight">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="chi-tiet-ho-so-thanh-toan.html" class="share_clr_four">NT-001-19835</a></td>
                                            <td>14/10/2021</td>
                                            <td>Công ty X</td>
                                            <td>ĐH-001-28736</td>
                                            <td>30/11/2021</td>
                                            <td>11.500.000</td>
                                            <td>450.000</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>11.500.000</td>
                                            <td>Chưa hoàn thành</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#" class="share_clr_four">NT-001-19835</a></td>
                                            <td>14/10/2021</td>
                                            <td>Công ty X</td>
                                            <td>HĐ-001-28736</td>
                                            <td>30/11/2021</td>
                                            <td>11.500.000</td>
                                            <td>450.000</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>11.500.000</td>
                                            <td>Hoàn thành</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#">NT-001-19835</a></td>
                                            <td>14/10/2021</td>
                                            <td>Công ty X</td>
                                            <td>ĐH-001-28736</td>
                                            <td>30/11/2021</td>
                                            <td>11.500.000</td>
                                            <td>450.000</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>11.500.000</td>
                                            <td>Chưa hoàn thành</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#">NT-001-19835</a></td>
                                            <td>14/10/2021</td>
                                            <td>Công ty X</td>
                                            <td>HĐ-001-28736</td>
                                            <td>30/11/2021</td>
                                            <td>11.500.000</td>
                                            <td>450.000</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>11.500.000</td>
                                            <td>Hoàn thành</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span class="scroll_right share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
                        </div>
                    </div>
                </div>
                <div class="c-foot d_flex flex_jct fl_agi fl_wrap mt_20">
                    <div class="display d_flex fl_agi">
                        <label for="display" class="mr_10">Hiển thị</label>
                        <select name="display" id="display">
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <ul class="mt-10">
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
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
$(".tim_kiem, .tim_kiem_o").select2({
    width: '100%',
});

$(".add_creart_hd").click(function(){
    window.location.href = "them-ho-so-thanh-toan.html";
});

$('.scroll_right').click(function (e) {
    e.preventDefault();
    $('.share_tb_hd').animate({
        scrollLeft: "+=300px"
    }, "slow");
});

$('.scroll_left').click(function (e) {
    e.preventDefault();
    $('.share_tb_hd').animate({
        scrollLeft: "-=300px"
    }, "slow");
});
</script>

</html>