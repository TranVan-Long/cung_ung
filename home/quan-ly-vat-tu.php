<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý yêu cầu vật tư</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />
    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

</head>

<body>
    <div class="main-container">
        <!--    a-side menu-->
        <?php include "../includes/sidebar.php"?>
        <!--    a-side menu end-->

        <div class="container">
            <!--        header-->
            <div class="header-container">
                <?php include '../includes/ql_header_nv.php'?>
            </div>
            <!--        header end-->
            <div class="content">
                <div class="c-top border-bottom-2">
                    <h4 class="left">Yêu cầu vật tư công trình</h4>
                    <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
                </div>
                <div class="c-body mt-20">
                    <div class="w-100 left">
                        <div class="category v-select2">
                            <select name="category" class="share_select">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1">Mã yêu cầu</option>
                                <option value="2">Ngày gửi</option>
                                <option value="3">Công trình</option>
                                <option value="4">Ngày phải hoàn thành</option>
                            </select>
                        </div>
                        <div class="search-box v-select2">
                            <select name="search" class="share_select">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                            </select>
                        </div>
                        <a class="v-btn btn-blue add-btn" href="them-yeu-cau-vat-tu.html">&plus; Thêm mới</a>
                    </div>
                    <div class="filter2">
                        <label class="filter-container" for="all">Tất cả
                            <input type="radio" id="all" name="filter1" value="all" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="approved">Đã duyệt
                            <input type="radio" id="approved" name="filter1" value="approved">
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="not-approved">Chưa duyệt
                            <input type="radio" id="not-approved" name="filter1" value="not-approved">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="filter3">
                        <label class="filter-container" for="not-completed">Thuộc công trình chưa hoàn thành
                            <input type="radio" id="not-completed" name="filter2" value="not-completed" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="completed">Thuộc công trình đã hoàn thành
                            <input type="radio" id="completed" name="filter2" value="completed">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="table-wrapper">
                        <div class="table-container table-sm">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-5">STT</th>
                                            <th class="w-15">Số phiếu yêu cầu</th>
                                            <th class="w-10">Ngày gửi</th>
                                            <th class="w-20">Công trình</th>
                                            <th class="w-15">Ngày phải hoàn thành</th>
                                            <th class="w-15">Trạng thái duyệt</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="w-5">1</td>
                                            <td class="w-15"><a
                                                    href="quan-ly-chi-tiet-yeu-cau-vat-tu.html">YC-000-02983</a></td>
                                            <td class="w-10">29/10/2021</td>
                                            <td class="w-20">Xây dựng nhà văn hóa</td>
                                            <td class="w-15">10/11/2021</td>
                                            <td class="w-15">Đã duyệt</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Chờ duyệt</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã bị từ chối</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã hoàn thành</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã duyệt</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Chờ duyệt</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã bị từ chối</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã hoàn thành</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Đã duyệt</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td><a href="#">YC-000-02983</a></td>
                                            <td>29/10/2021</td>
                                            <td>Xây dựng nhà văn hóa</td>
                                            <td>10/11/2021</td>
                                            <td>Chờ duyệt</td>
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
    <? include("../modals/modal_logout.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/select.js"></script>
<script type="text/javascript" src="../js/app.js"></script>


</html>