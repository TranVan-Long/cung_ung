<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo giá</title>
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
    <!--    a-side menu end-->

    <div class="container">
        <!--        header-->
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <!--        header end-->
        <div class="content">
            <div class="c-top border-bottom pb-20">
                <h4 class="left">Báo giá</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="w-100 left">
                <div class="w-100 left">
                    <div class="right mt-20">
                        <a class="v-btn btn-blue add-btn mt-20" href="them-bao-gia.html">&plus; Thêm mới</a>
                    </div>
                    <div class="left">
                        <div class="category v-select2 mt-20">
                            <select name="category" class="share_select">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1">Nhà cung cấp</option>
                                <option value="2">Số báo giá</option>
                                <option value="3">Số yêu cầu báo giá</option>
                                <option value="4">Ngày gửi</option>
                                <option value="5">Ngày áp dụng</option>
                            </select>
                        </div>
                        <div class="search-box v-select2 mt-20">
                            <select name="search" class="share_select">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                            </select>
                        </div>
                    </div>

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
                                        <th class="w-30">Nhà cung cấp</th>
                                        <th class="w-20">Số báo giá</th>
                                        <th class="w-30">Theo yêu cầu báo giá số</th>
                                        <th class="w-20">Ngày gửi</th>
                                        <th class="w-40">Ngày áp dụng</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="w-15">1</td>
                                        <td class="w-30">Công ty A</td>
                                        <td class="w-20"><a href="chi-tiet-bao-gia.html">BG-000-45875</a></td>
                                        <td class="w-30">YC-999-19456</td>
                                        <td class="w-20">18/10/2021</td>
                                        <td class="w-40">18/10/2021 - 05/05/2022</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-foot mt-10 left">
                <div class="display">
                    <label for="display">Hiển thị</label>
                    <select name="display" id="display">
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <!--                    pagination-->
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
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>