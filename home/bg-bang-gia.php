<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng giá</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

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
            <div class="c-top border-bottom-2">
                <h4 class="left">Bảng giá</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="c-body mt-10">
                <div class="w-100 left">
                    <label for="gia-vat-tu-ngay">Bảng giá vật tư ngày</label>
                    <input class="date-input" type="text" id="gia-vat-tu-ngay" name="gia-vat-tu-ngay" onfocus="this.type='date'">
                </div>
                <div class="w-100 left mt-20">
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
                </div>
                <div class="scr-wrapper mt-20">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-wrapper">
                        <div class="table-container table-full-width">
                            <div class="tbl-header">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                    <tr>

                                        <th class="w-10" rowspan="2">STT</th>
                                        <th class="w-15" rowspan="2">Mã vật tư</th>
                                        <th class="w-20" rowspan="2">Tên đầy đủ vật tư thiết bị</th>
                                        <th class="w-10" rowspan="2">Đơn vị tính</th>
                                        <th class="w-20" rowspan="2">Giá thấp nhất</th>
                                        <th class="w-20" rowspan="2">Giá cao nhất</th>
                                        <th colspan="3" scope="colgroup" class="w-60 border-bottom-w">Danh sách giá theo nhà cung cấp</th>
                                    </tr>
                                    <tr class="border-top-w">
                                        <th class="w-20" scope="colgroup">Nhà cung cấp 1</th>
                                        <th class="w-20" scope="colgroup">Nhà cung cấp 2</th>
                                        <th class="w-20" scope="colgroup">Nhà cung cấp 3</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-15">VT-000-13456</td>
                                        <td class="w-20">Aptomat 3fa - 60A - LS</td>
                                        <td class="w-10">Cái</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">70.000</td>
                                        <td class="w-20">60.000</td>
                                        <td class="w-20">65.000</td>
                                        <td class="w-20">70.000</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
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
                <!--                    pagination-->
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
<script type="text/javascript" src="../js/select.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>