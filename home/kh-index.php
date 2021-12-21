<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý khách hàng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>
<body>
<div class="main-container ql_chung">
    <?php include("../includes/sidebar.php") ?>

    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="c-top border-bottom-2">
                <h4 class="left share_fsize_four">Khách hàng</h4>
                <div class="c-help d_flex fl_agi">
                    <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                    <a class="c-help" href="#">Hướng dẫn</a>
                </div>
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
                    <a class="v-btn btn-blue add-btn" href="them-khach-hang.html">&plus; Thêm mới</a>
                </div>
                <div class="scr-wrapper mt-30">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-wrapper">
                        <div class="table-container table_1457">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="w-5">STT</th>
                                        <th class="w-10">Mã khách hàng</th>
                                        <th class="w-10">Tên gọi tắt</th>
                                        <th class="w-15">Tên khách hàng</th>
                                        <th class="w-25">Địa chỉ liên hệ</th>
                                        <th class="w-10">Mã số thuế</th>
                                        <th class="w-10">Điện thoại</th>
                                        <th class="w-15">Email</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">1</td>
                                        <td class="w-10">
                                            <a href="quan-ly-chi-tiet-khach-hang.html" class="share_clr_four">KH-002-38476</a></td>
                                        <td class="w-10">NVA</td>
                                        <td class="w-15">Nguyễn Văn A</td>
                                        <td class="w-25">Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td class="w-10">97766519367782</td>
                                        <td class="w-10">0987543671</td>
                                        <td class="w-15">mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="quan-ly-chi-tiet-khach-hang.html" class="share_clr_four">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="kh-details.php">KH-002-38476</a></td>
                                        <td>NVA</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>Số 12, ngõ 65, phố X, phường X, quận X</td>
                                        <td>97766519367782</td>
                                        <td>0987543671</td>
                                        <td>mail1234@gmail.com</td>
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
<?php include "../modals/modal_logout.php"?>
<? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>