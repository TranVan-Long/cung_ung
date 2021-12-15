<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo cáo doanh số bán hàng</title>
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
            <div class="c-top border-bottom-2">
                <h4 class="left">Báo cáo doanh số bán hàng</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="c-body mt-20">
                <div class="w-100 left">
                    <div class="category v-select2">
                        <select name="category" class="share_select">
                            <option value="">Tìm kiếm theo</option>
                            <option value="1">Mã khách hàng</option>
                            <option value="2">Tên khách hàng</option>
                            <option value="3">Số điện thoại</option>
                            <option value="4">Email</option>
                        </select>
                    </div>
                    <div class="search-box v-select2">
                        <select name="search" class="share_select">
                            <option value="">Nhập thông tin cần tìm kiếm</option>
                        </select>
                    </div>
                </div>
                <div class="scr-wrapper mt-30">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-wrapper">
                        <div class="table-container table-full-width">
                            <div class="tbl-header">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                    <tr>
                                        <th class="w-10">STT</th>
                                        <th class="w-20">Mã vật tư</th>
                                        <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                        <th class="w-25">Số hợp đồng</th>
                                        <th class="w-25">Ngày hợp đồng</th>
                                        <th class="w-35">Công trình</th>
                                        <th class="w-30">Giá trị theo hợp đồng</th>
                                        <th class="w-30">Giá trị thực hiện</th>
                                        <th class="w-25">Tiến độ(%)</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
                                    </tr>
                                    <tr>
                                        <td class="w-10">1</td>
                                        <td class="w-20"><a href="bc-details.php">VT-000-98765</a></td>
                                        <td class="w-35">Ống nhựa 0,5m</td>
                                        <td class="w-25">
                                            <p class="table-text">HĐ-123-47589</p>
                                            <p class="table-text">HĐ-098-37465</p>
                                        </td>
                                        <td class="w-25">
                                            <p class="table-text">05/11/2021</p>
                                            <p class="table-text">06/11/2021</p>
                                        </td>
                                        <td class="w-35">
                                            <p class="table-text">Xây dựng nhà dân dụng</p>
                                            <p class="table-text">Xây dựng nhà sinh hoạt văn hóa phường</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">10.000.000</p>
                                            <p class="table-text">10.000.000</p>
                                        </td>
                                        <td class="w-30">
                                            <p class="table-text">9.000.000</p>
                                            <p class="table-text">9.000.000</p>
                                        </td>
                                        <td class="w-25"><p class="table-text">90</p></td>
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
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script type="text/javascript" src="../js/select.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>