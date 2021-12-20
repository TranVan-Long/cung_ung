<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đánh giá nhà cung cấp</title>
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
                <h4 class="left">Đánh giá nhà cung cấp</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="c-body mt-20">
                <div class="w-100 left">
                    <div class="category v-select2">
                        <select name="category" class="share_select">
                            <option value="">Tìm kiếm theo</option>
                            <option value="1">Ngày gửi</option>
                            <option value="2">Công trình</option>
                            <option value="3">Ngày phải hoàn thành</option>
                        </select>
                    </div>
                    <div class="search-box v-select2">
                        <select name="search" class="share_select">
                            <option value="">Nhập thông tin cần tìm kiếm</option>
                        </select>
                    </div>
                    <a class="v-btn btn-blue add-btn" href="them-danh-gia-nha-cung-cap.html">&plus; Thêm mới</a>
                </div>
                <div class="scr-wrapper mt-30">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-wrapper">
                        <div class="table-container table-md">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="w-5">STT</th>
                                        <th class="w-15">Số phiếu</th>
                                        <th class="w-10">Ngày đánh giá</th>
                                        <th class="w-15">Nhà cung cấp</th>
                                        <th class="w-5">Điểm</th>
                                        <th class="w-20">Đánh giá khác</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">1</td>
                                        <td class="w-15">
                                            <a href="chi-tiet-danh-gia-nha-cung-cap.html" class="share_clr_four">PH-009-73635</a></td>
                                        <td class="w-10">27/10/2021</td>
                                        <td class="w-15">Nhà cung cấp A</td>
                                        <td class="w-5">8/10</td>
                                        <td class="w-20">Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="chi-tiet-danh-gia-nha-cung-cap.html" class="share_clr_four">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="chi-tiet-danh-gia-nha-cung-cap.html" class="share_clr_four">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="chi-tiet-danh-gia-nha-cung-cap.html">PH-009-73635</a></td>
                                        <td>27/10/2021</td>
                                        <td>Nhà cung cấp A</td>
                                        <td>8/10</td>
                                        <td>Không có</td>
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
<script>
    $(document).ready(function(){
        if($(".table-wrapper").width() < 1251){
            $(".scr-r-btn").css("display","block");
            $(".scr-l-btn").css("display","block");
        }else{
            $(".scr-r-btn").css("display","none");
            $(".scr-l-btn").css("display","none");
        }
    })

</script>
</html>