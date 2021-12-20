<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yêu cầu báo giá</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

</head>
<body>
<div class="main-container bg_yeu_cau">
    <?php include("../includes/sidebar.php") ?>

    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="c-top border-bottom pb-20">
                <h4 class="left">Yêu cầu báo giá</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="w-100 left mt-20">
                <div class="w-100 left">
                    <div class="category v-select2">
                        <select name="category" class="share_select">
                            <option value="">Tìm kiếm theo</option>
                            <option value="1">Mã yêu cầu</option>
                            <option value="2">Người lập</option>
                            <option value="3">Ngày lập</option>
                            <option value="4">Nhà cung cấp</option>
                        </select>
                    </div>
                    <div class="search-box v-select2">
                        <select name="search" class="share_select">
                            <option value="">Nhập thông tin cần tìm kiếm</option>
                        </select>
                    </div>
                    <a class="v-btn btn-blue add-btn" href="them-yeu-cau-bao-gia.html">&plus; Thêm mới</a>

                </div>
                <div class="table-wrapper mt-20">
                    <div class="table-container table-sm">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-15">Số phiếu yêu cầu</th>
                                    <th class="w-30">Người lập</th>
                                    <th class="w-15">Ngày lập</th>
                                    <th class="w-30">Nhà cung cấp</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia.html">BG-098-10293</a></td>
                                    <td class="w-30">Nguyễn Văn A</td>
                                    <td class="w-15">18/10/2021</td>
                                    <td class="w-30">Công ty X</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-foot mt-10">
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
</div>
<?php include "../modals/modal_logout.php"?>
<? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>