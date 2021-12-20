<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý trang chủ</title>
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
    <div class="main-container ql_trangchu_s">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctt_tt_one w_100 float_l">
                    <div class="tt_left_one staff_fulln d_flex flex_jct">
                        <div class="til_fulln">
                            <h1 class="ten_nvien_ql  w_100 float_l cr_weight"><span class="share_clr_one">Xin
                                    chào,</span> <span class="share_clr_four">Nguyễn Văn A</span></h1>
                            <p>Chúc bạn một ngày mới làm việc hiệu quả!</p>
                        </div>
                        <div class="titl_avt_full">
                            <img src="../img/pana.png" alt="ảnh đại diện">
                        </div>
                    </div>
                    <div class="tt_right_one staff_fulln">
                        <h3 class="time_tt cr_weight share_clr_one">08:00</h3>
                        <p class="cr_weight share_clr_one share_fsize_tow">Thứ ba, 11/05/2021</p>
                    </div>
                </div>
                <div class="ctt_tt_two mb_20 w_100 float_l">
                    <div class="tt_left_tow staff_fulln">
                        <div class="tieu_de_bd w_100 float_l d_flex mb_20 flex_jct">
                            <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10">Công nợ phải thu</h3>
                            <div class="filter_mdy">
                                <select name="tim_kiem" class="form_search_dmy">
                                    <option value="1">Theo ngày</option>
                                    <option value="2">Theo tháng</option>
                                    <option value="3">Theo năm</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart"></div>
                        <div class="ttin_ctiet w_100 float_l mb_20">
                            <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
                                <p class="share_fsize_tow share_clr_one cr_weight">1.000.000.000</p>
                            </div>
                            <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="dthu share_fsize_tow share_clr_one">Đã thu:</p>
                                <p class="share_fsize_tow cr_xanh_dam cr_weight">100.000.000</p>
                            </div>
                            <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="cphai_thu share_fsize_tow share_clr_one">Còn phải thu</p>
                                <p class="share_fsize_tow cr_vang cr_weight">900.000.000</p>
                            </div>
                        </div>
                    </div>
                    <div class="tt_left_tow staff_fulln tt_right_tow float_l">
                        <div class="tieu_de_bd w_100 float_l d_flex mb_20 flex_jct">
                            <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10">Công nợ phải trả</h3>
                            <div class="filter_mdy">
                                <select name="tim_kiem" class="form_search_dmy cong_no_tra">
                                    <option value="1">Theo ngày</option>
                                    <option value="2">Theo tháng</option>
                                    <option value="3">Theo năm</option>
                                </select>
                            </div>
                        </div>
                        <div class="tt_charts">
                            <div class="charts"></div>
                        </div>
                        <div class="tt_charts_one">
                            <div class="charts_one share_dnone"></div>
                        </div>
                        <div class="ttin_ctiet w_100 float_l mb_20">
                            <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
                                <p class="share_fsize_tow share_clr_one cr_weight">1.000.000.000</p>
                            </div>
                            <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
                                <p class="share_fsize_tow cr_da_cam cr_weight">100.000.000</p>
                            </div>
                            <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
                                <p class="share_fsize_tow cr_do_nhat cr_weight">900.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ctt_tt_three w_100">
                    <div class="tieu_de_chart w_100 float_l d_flex">
                        <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10">Giá trị hợp đồng mua, bán</h3>
                        <div class="search_chart">
                            <select name="search_chart" class="form_search_dmy share_clr_one share_fsize_tow">
                                <option value="1">Theo năm</option>
                                <option value="2">Theo tháng</option>
                            </select>
                        </div>
                    </div>
                    <div class="content_hcot w_100 float_l">
                        <div id="tt_three_ctiet"></div>
                        <table id="datatable" class="share_dnone">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Hợp đồng mua</th>
                                    <th>Hợp đồng bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <td>3000000</td>
                                    <td>4000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>2000000</td>
                                    <td>10000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>5000000</td>
                                    <td>11000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>1000000</td>
                                    <td>19000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>2000000</td>
                                    <td>4000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>20000000</td>
                                    <td>50000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>2000000</td>
                                    <td>40000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>2000000</td>
                                    <td>4000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>2000000</td>
                                    <td>40000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>20000000</td>
                                    <td>40000000</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>20000000</td>
                                    <td>40000000</td>

                                </tr>
                                <tr>
                                    <th></th>
                                    <td>20000000</td>
                                    <td>40000000</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="titl_chr w_100 float_l">
                        <p class="hd_mua_chr share_clr_one share_fsize_tow">Hợp đồng mua</p>
                        <p class="hd_ban_chr share_clr_one share_fsize_tow">Hợp đồng bán</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include("../modals/modal_logout.php")?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/apexcharts.min.js"></script>

<!-- js bieu do cot -->
<script src="../js/highcharts.js"></script>
<script src="../js/export-data.js"></script>
<script src="../js/exporting.js"></script>
<script src="../js/accessibility.js"></script>
<!-- end -->
<script type="text/javascript" src="../js/style.js"></script>
<script>
    $(".cong_no_tra").change(function(){
        var id = $(this).val();
        if(id == 1){
            $(".charts").css('display','block');
            $(".charts_one").css('display','none');
        }else if(id == 2){
            $(".charts").css('display','none');
            $(".charts_one").css('display','block');
        }
    })
</script>
<script>
    var a = 4400000;
    var b = 55000000;
    var options = {
        series: [a, b],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#219653', '#F2C94C'],
        labels: ['Đã thu', 'Chưa thu'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 160
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector(".chart"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [4400000, 55000000],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#F2994A', '#EB5757'],
        labels: ['Đã thu', 'Chưa thu'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector(".charts"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [4500000, 5000000],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#F2994A', '#EB5757'],
        labels: ['Đã thu', 'Chưa thu'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector(".charts_one"), options);
    chart.render();
</script>
<script>
    Highcharts.chart('tt_three_ctiet', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            },
            labels: {
                style: {
                    color: '#474747',
                    fontSize: '14px',
                }
            },
        },

        tooltip: {
            style: {
                color: '#474747',
                fontSize: '14px',
            }
        },

        xAxis: {
            labels: {
                style: {
                    color: '#474747',
                    fontSize: '14px',
                }
            },

            categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
        },

        title: false,
        subtitle: false,

        colors: ['#E09A6A ', '#9D92C8'],
    });
</script>

</html>