<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hợp đồng</title>
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
    <div class="main-container ql_hop_dong ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Hợp đồng</h4>
                    <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="share_form_select category">
                            <select name="category" class="tim_kiem">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1">Hợp đồng mua vật tư</option>
                                <option value="2">Hợp đồng bán vật tư</option>
                                <option value="3">Hợp đồng thuê thiết bị</option>
                                <option value="4">Hợp đồng thuê vận chuyển</option>
                            </select>
                        </div>
                        <div class="share_form_select search-box">
                            <select name="search" class="tim_kiem_o">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                            </select>
                        </div>
                        <div class="add_hopd">
                            <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">&plus; Thêm mới</p>
                            <div class="all_hopd share_bgr_tow">
                                <p class="hd_mua_vt">
                                    <a class="share_clr_one share_fsize_one" href="/them-hop-dong-mua.html">Hợp đồng mua vật tư</a>
                                </p>
                                <p class="hopd_bvt">
                                    <a class="share_clr_one share_fsize_one" href="/them-hop-dong-ban.html">Hợp đồng bán vật tư</a>
                                </p>
                                <p class="hopd_thue_tb">
                                    <a class="share_clr_one share_fsize_one" href="/them-hop-dong-thue-thiet-bi.html">Hợp đồng thuê thiết bị</a>
                                </p>
                                <p class="hopd_thue_vc">
                                    <a class="share_clr_one share_fsize_one" href="/them-hop-dong-van-chuyen.html">Hợp đồng thuê vận chuyển</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="c-content">
                        <div class="ctn_table_share w_100 fload_l">
                            <span class="scroll_left share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên trái"></span>
                            <div class="share_tb_hd w_100 fload_l">
                                <table class="table w_100 fload_l">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Số hợp đồng</th>
                                            <th class="share_tb_two">Ngày ký</th>
                                            <th class="share_tb_two">Loại hợp đồng</th>
                                            <th class="share_tb_three">Thời gian thực hiện</th>
                                            <th class="share_tb_two">Thời hạn bảo lãnh</th>
                                            <th class="share_tb_two">Nhà cung cấp / Khách hàng</th>
                                            <th class="share_tb_two">Công trình</th>
                                            <th class="share_tb_two">Tóm tắt nội dung</th>
                                            <th class="share_tb_two">Hợp đồng nguyên tắc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="quan-ly-chi-tiet-hop-dong-mua.html">HĐ - 0001</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng mua vật tư</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="quan-ly-chi-tiet-hop-dong-ban.html">HĐ - 0002</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng bán vật tư</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="quan-ly-chi-tiet-hop-dong-thue-thiet-bi.html">HĐ - 0001</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng thuê thiết bị vật tư</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="quan-ly-chi-tiet-hop-dong-van-chuyen.html">HĐ - 0001</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng thuê vận chuyển</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#">HĐ - 0001</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng mua vật tư</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="#">HĐ - 0001</a></td>
                                            <td>29/10/2021</td>
                                            <td>Hợp đồng mua vật tư</td>
                                            <td>12/10/2021 - 30/10/2021</td>
                                            <td>10/11/2021</td>
                                            <td>Công ty A</td>
                                            <td>Công trình</td>
                                            <td>Mua bán vật tư</td>
                                            <td>Có</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span class="scroll_right share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
                        </div>
                    </div>
                </div>
                <div class="c-foot d_flex flex_jct fl_agi mt_20">
                    <div class="display d_flex fl_agi">
                        <label for="display" class="mr_10">Hiển thị</label>
                        <select name="display" id="display">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
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
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
$(".tim_kiem, .tim_kiem_o").select2({
    width: '100%',
});

(function(w) {
    w.addEventListener('load', function() {
        const btn_right = document.querySelector('.scroll_right'),
        btn_left = document.querySelector('.scroll_left'),
        content = document.querySelector('.share_tb_hd');
        const content_scroll_width = content.scrollWidth;
        let content_scoll_left = content.scrollLeft;

        btn_right.addEventListener('click', () => {
            content_scoll_left += 100;
            if (content_scoll_left >= content_scroll_width) {
                content_scoll_left = content_scroll_width;
            }
            content.scrollLeft = content_scoll_left;
        });

        btn_left.addEventListener('click', () => {
            content_scoll_left -= 100;
            if (content_scoll_left <= 0) {
                content_scoll_left = 0;
            }
            content.scrollLeft = content_scoll_left;
        });
    });
})(window);

var add_creart_hd = $(".add_creart_hd");
var all_hopd = $(".all_hopd");

$(".add_creart_hd").click(function(){
    $(".all_hopd").toggleClass("active");
})

$(window).click(function(e){
    if(!add_creart_hd.is(e.target) && !all_hopd.is(e.target) && add_creart_hd.has(e.target).length == 0){
        all_hopd.removeClass("active");
    }
})
</script>

</html>