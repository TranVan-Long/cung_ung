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
                <h4 class="left">Nhà cung cấp</h4>
                <a class="c-help" href="#"><i class="ic-question"><?php echo $ic_question ?></i>Hướng dẫn</a>
            </div>
            <div class="c-body">
                <div class="w-100 left">
                    <div class="category v-select2">
                        <select name="category" class="share_select">
                            <option value="">Tìm kiếm theo</option>
                            <option value="1">Mã nhà cung cấp</option>
                            <option value="2">Tên nhà cung cấp</option>
                            <option value="3">Số ĐKKD</option>
                            <option value="4">Mã số thuế</option>
                        </select>
                    </div>
                    <div class="search-box v-select2">
                        <select name="search" class="share_select">
                            <option value="">Nhập thông tin cần tìm kiếm</option>
                        </select>
                    </div>
                    <a class="v-btn btn-blue add-btn" href="../home/ncc-them.php">&plus; Thêm mới</a>
                </div>
                <div class="w-100 left table-wrapper">
                    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
                    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
                    <div class="table-container mt-30">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã nhà cung cấp</th>
                                <th>Tên gọi tắt</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Mã số thuế</th>
                                <th>Tên giao dịch</th>
                                <th>Địa chỉ ĐKKD</th>
                                <th>Số ĐKKD</th>
                                <th>Địa chỉ liên hệ</th>
                                <th>Fax</th>
                                <th>Điện thoại</th>
                                <th>Website</th>
                                <th>Email</th>
                                <th>Sản phẩm cung ứng</th>
                                <th>Thông tin khác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="chi-tiet-yeu-cau-vat-tu.php">NCC-198-24201</a></td>
                                <td>NCC1</td>
                                <td>Nhà cung cấp 1</td>
                                <td>09988776485</td>
                                <td>NCC001</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>9988332818</td>
                                <td>Số 5, phố X, phường X, quận X</td>
                                <td>0123456789</td>
                                <td>01234567889</td>
                                <td>ncca.com.vn</td>
                                <td>ncca@gmail.com</td>
                                <td>Sắt thép</td>
                                <td>Không có</td>
                            </tr>

                            </tbody>
                        </table>
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