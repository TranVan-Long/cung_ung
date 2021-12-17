<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết báo giá cho khách hàng</title>
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
                <a class="text-black" href="quan-ly-bao-gia-cho-khach-hang.html"><?php echo $ic_lt ?> Quay lại</a>
                <h5 class="text-blue mt-20">Chi tiết báo giá cho khách hàng</h5>
            </div>
            <div class="w-100 left mt-10">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Số phiếu phản hồi</p>
                            <p class="right text-right w-50 text-bold">PH-123-45678</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Người phản hồi</p>
                            <p class="right text-right w-50 text-bold">Nguyễn Văn A</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Ngày phản hồi</p>
                            <p class="right text-right w-50 text-bold">18/10/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50"> Khách hàng</p>
                            <p class="right text-right w-50 text-bold">Công ty A</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Thời gian áp dụng</p>
                            <p class="right text-right w-50 text-bold">18/10/2021 - 05/05/2022</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Nội dung phản hồi</p>
                            <p class="right text-right w-50 text-bold">Không có</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <div class="table-wrapper mt-30">
                    <div class="table-container table-lg">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-20">Mã vật tư</th>
                                    <th class="w-30">Tên đầy đủ vật tư thiết bị</th>
                                    <th class="w-25">Hãng sản xuất</th>
                                    <th class="w-20">Số lượng báo giá</th>
                                    <th class="w-15">Đơn vị tính</th>
                                    <th class="w-20">Đơn giá</th>
                                    <th class="w-25">Thành tiền</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-20">VT-090-00019</td>
                                    <td class="w-30">Ống nhựa 0,5m</td>
                                    <td class="w-25">Hãng X</td>
                                    <td class="w-20">20</td>
                                    <td class="w-15">cái</td>
                                    <td class="w-20">20.000</td>
                                    <td class="w-25">400.000</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-20">VT-090-00019</td>
                                    <td class="w-30">Ống nhựa 0,5m</td>
                                    <td class="w-25">Hãng X</td>
                                    <td class="w-20">20</td>
                                    <td class="w-15">cái</td>
                                    <td class="w-20">20.000</td>
                                    <td class="w-25">400.000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="left mt-20">
                    <a href="#" class="v-btn btn-gray">Gửi mail</a>
                </div>
                <div class="right mt-20">
                    <p class="v-btn btn-outline-red modal-btn" data-target="delete">Xóa</p>
                    <a href="chinh-sua-bao-gia-cho-khach-hang.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                </div>
            </div>
            <div class="modal text-center" id="delete">
                <div class="m-content huy-them">
                    <div class="m-head ">
                        XÓA BÁO GIÁ<span class="dismiss cancel">&times;</span>
                    </div>
                    <div class="m-body">
                        <p>Bạn có chắc chắn muốn xóa phản hồi báo giá này?</p>
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
    </div>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/style.js"></script>

</html>