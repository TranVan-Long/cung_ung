<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cung ứng xây dựng</title>
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
                    <a class="v-btn btn-blue add-btn" href="../home/ratting-rules-create.php">&plus; Thêm mới</a>
                </div>
                <div class="table-wrapper left w-100 mt-30">
                    <div class="table-container">
                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="w-10">STT</th>
                                    <th rowspan="2">Tiêu chí đánh giá</th>
                                    <th rowspan="2" class="w-10">Hệ số</th>
                                    <th rowspan="2">Kiểu giá trị</th>
                                    <th colspan="2" scope="colgroup">Danh sách giá trị</th>
                                </tr>
                                <tr>
                                    <th scope="colgroup">Giá trị</th>
                                    <th scope="colgroup">Tên hiển thị</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                <tr class="more">
                                    <td class="w-10">1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td class="w-10">2</td>
                                    <td>Danh sách</td>
                                    <td>
                                        <p class="rate-val">10</p>
                                        <p class="rate-val">5</p>
                                        <p class="rate-val">0</p>
                                    </td>
                                    <td>
                                        <p class="rate-val">Tốt<span class="tbl-menu" data-tab="1"></span>
                                        <ul class="tbl-menu-content" id="1">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                        </p>
                                        <p class="rate-val">Trung bình</p>
                                        <p class="rate-val">Kém</p>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td>
                                        <span class="tbl-menu" data-tab="2"></span>
                                        <ul class="tbl-menu-content" id="2">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="3"></span>
                                        <ul class="tbl-menu-content" id="3">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="4"></span>
                                        <ul class="tbl-menu-content" id="4">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="5"></span>
                                        <ul class="tbl-menu-content" id="5">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="6"></span>
                                        <ul class="tbl-menu-content" id="6">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="7"></span>
                                        <ul class="tbl-menu-content" id="7">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="8"></span>
                                        <ul class="tbl-menu-content" id="8">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="9"></span>
                                        <ul class="tbl-menu-content" id="9">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="more">
                                    <td>1</td>
                                    <td>Chất lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>Nhập tay</td>
                                    <td></td>
                                    <td><span class="tbl-menu" data-tab="10"></span>
                                        <ul class="tbl-menu-content" id="10">
                                            <li class="mb-10"><a href="ratting-rules-edit.php" class="tbl-menu-text">Chỉnh sửa</a></li>
                                            <li class="border-top2"><p class="tbl-menu-text modal-btn">Xóa</p></li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal text-center">
                    <div class="m-content huy-them">
                        <div class="m-head ">
                            Xóa tiêu chí <span class="dismiss cancel">&times;</span>
                        </div>
                        <div class="m-body">
                            <p>Bạn có chắc chắn muốn xóa tiêu chí đánh giá này?</p>
                            <p>Thao tác này sẽ không thể hoàn tác.</p>
                        </div>
                        <div class="m-foot d-inline-block">
                            <div class="left">
                                <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                            </div>
                            <div class="right">
                                <a href="ncc-index.php" class="v-btn btn-green right">Đồng ý</a>
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