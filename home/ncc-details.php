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
            <div class="mt-20 left">
                <a class="text-black" href="ncc-index.php"><?php echo $ic_lt ?> Quay lại</a>
                <h5 class="text-blue mt-20">Chi tiết nhà cung cấp</h5>
            </div>
            <div class="w-100 left">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Mã nhà cung cấp</p>
                            <p class="right text-right w-50 text-bold">NCC-198-24201</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50"> Tên gọi tắt</p>
                            <p class="right text-right w-50 text-bold"> NCC1</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Tên nhà cung cấp</p>
                            <p class="right text-right w-50 text-bold"> Nhà cung cấp 1</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Tên giao dịch</p>
                            <p class="right text-right w-50 text-bold">NCC001</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Mã số thuế</p>
                            <p class="right text-right w-50 text-bold">09988776485</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Địa chỉ ĐKKD</p>
                            <p class="right text-right w-50 text-bold">Số 5, phố X, phường X, quận X</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Số ĐKKD</p>
                            <p class="right text-right w-50 text-bold">9988332818</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Địa chỉ liên hệ</p>
                            <p class="right text-right w-50 text-bold">Số 5, phố X, phường X, quận X</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Fax</p>
                            <p class="right text-right w-50 text-bold">0123456789</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Điện thoại</p>
                            <p class="right text-right w-50 text-bold">01234567889</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Website</p>
                            <p class="right text-right w-50 text-bold">ncca.com.vn</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">E-mail</p>
                            <p class="right text-right w-50 text-bold">ncca@gmail.com</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Sản phẩm cung ứng</p>
                            <p class="right text-right w-50 text-bold">Sắt thép</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Thông tin khác</p>
                            <p class="right text-right w-50 text-bold">Không có</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <p class="text-bold">Danh sách tài khoản ngân hàng</p>
                <div class="left w-100 bordered mt-10">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Tên ngân hàng</p>
                            <p class="right text-right w-50 text-bold">Ngân hàng A</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Chi nhánh</p>
                            <p class="right text-right w-50 text-bold">Chi nhánh 1</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Số tài khoản</p>
                            <p class="right text-right w-50 text-bold">0364777829845</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Chủ tài khoản</p>
                            <p class="right text-right w-50 text-bold">Nguyễn Văn A</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <p class="text-bold">Người liên hệ</p>
                <div class="table-container table-scroll mt-10">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Chức vụ</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Nguyễn Văn A</td>
                            <td>Giám đốc</td>
                            <td>0123456789</td>
                            <td>mail01101011@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="left mt-30">
                    <a href="#" class="v-btn btn-green">Xuất excel</a>
                </div>
                <div class="right mt-30">
                    <p class="v-btn btn-outline-red modal-btn">Xóa</p>
                    <div class="modal text-center">
                        <div class="m-content huy-them">
                            <div class="m-head ">
                                Xóa đơn hàng <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn xóa nhà cung cấp này?</p>
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
                    <a href="ncc-edit.php" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                </div>
            </div>
            <div class=""></div>
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