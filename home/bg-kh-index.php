<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo giá cho khách hàng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>
<body>
<div class="main-container">
    <!--    a-side menu-->
    <?php include("../includes/sidebar.php") ?>

    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="c-top border-bottom pb-30">
                <h4 class="left">Báo giá cho khách hàng</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="c-body mt-20">
                <div class="w-100 left">
                    <div class="category v-select2">
                        <select name="category" class="share_select">
                            <option value="">Tìm kiếm theo</option>
                            <option value="1">Số phiếu phản hồi</option>
                            <option value="2">Người phản hồi</option>
                            <option value="3">Ngày phản hồi</option>
                            <option value="4">Khách hàng</option>
                            <option value="5">Thời gian áp dụng</option>
                            <option value="6">Hiệu lực báo giá</option>
                        </select>
                    </div>
                    <div class="search-box v-select2">
                        <select name="search" class="share_select">
                            <option value="">Nhập thông tin cần tìm kiếm</option>
                        </select>
                    </div>
                    <a class="v-btn btn-blue add-btn" href="them-bao-gia-cho-khach-hang.html">&plus; Thêm mới</a>
                </div>
                <div class="scr-wrapper mt-20">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-wrapper">
                        <div class="table-container table-lg">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="w-15">STT</th>
                                        <th class="w-25">Số phiếu phản hồi</th>
                                        <th class="w-30">Người phản hồi</th>
                                        <th class="w-25">Ngày phản hồi</th>
                                        <th class="w-35">Khách hàng</th>
                                        <th class="w-35">Thời gian áp dụng</th>
                                        <th class="w-25">Hiệu lực báo giá</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Đã hết hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang.html">PH-000-99999</a></td>
                                        <td class="w-30">Nguyễn Thị A</td>
                                        <td class="w-25">20/11/2021</td>
                                        <td class="w-35">Công ty X</td>
                                        <td class="w-35">20/11/2021 - 01/01/2022</td>
                                        <td class="w-25">Còn hạn</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-foot mt-20 left">
                <div class="display">
                    <label for="display">Hiển thị</label>
                    <select name="display" id="display">
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="pagination mt-10">
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
<? include("../modals/modal_logout.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>