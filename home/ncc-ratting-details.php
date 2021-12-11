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
                <a class="text-black" href="ncc-rating-index.php"><?php echo $ic_lt ?> Quay lại</a>
                <h5 class="text-blue mt-20">Chi tiết phiếu đánh giá</h5>
            </div>
            <div class="w-100 left">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Số phiếu</p>
                            <p class="right text-right w-50 text-bold">PH-000-38374</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Ngày lập phiếu</p>
                            <p class="right text-right w-50 text-bold">27/10/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Ngày đánh giá</p>
                            <p class="right text-right w-50 text-bold">27/10/2021</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Người đánh giá</p>
                            <p class="right text-right w-50 text-bold">Nguyễn Văn A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Phòng ban</p>
                            <p class="right text-right w-50 text-bold">Phòng 1</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Người lập</p>
                            <p class="right text-right w-50 text-bold">Nguyễn Văn A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Nhà cung cấp</p>
                            <p class="right text-right w-50 text-bold">NCCA</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Tên nhà cung cấp</p>
                            <p class="right text-right w-50 text-bold">Nhà cung cấp A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Địa chỉ</p>
                            <p class="right text-right w-50 text-bold">Số 5, phường A, quận A</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Sản phẩm cung ứng</p>
                            <p class="right text-right w-50 text-bold">Gạch ngói</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Điểm đánh giá</p>
                            <p class="right text-right w-50 text-bold">8</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Trạng thái</p>
                            <p class="right text-right w-50 text-bold">Đã hoàn thành</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Đánh giá khác</p>
                            <p class="right text-right w-50 text-bold">Không có</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-30">
                <div class="table-wrapper">
                    <div class="table-container">
                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                <tr>
                                    <th scope="col" rowspan="2" class="w-5">STT</th>
                                    <th scope="col" rowspan="2" class="w-20">Tiêu chí đánh giá</th>
                                    <th scope="col" rowspan="2" class="w-10">Hệ số</th>
                                    <th colspan="3" scope="colgroup" class="">Đánh giá</th>
                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup" class="">Điểm đánh giá</th>
                                    <th scope="colgroup" class="">Điểm</th>
                                    <th scope="colgroup" class="">Đánh giá chi tiết</th></tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                <tr>
                                    <td class="w-5">1</td>
                                    <td class="w-20">Chắt lượng sản phẩm</td>
                                    <td class="w-10">2</td>
                                    <td class="">10</td>
                                    <td class="">20</td>
                                    <td>Chất lượng sản phẩm rất tốt</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Chắt lượng sản phẩm</td>
                                    <td>2</td>
                                    <td>10</td>
                                    <td>20</td>
                                    <td>Chất lượng sản phẩm rất tốt</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="left mt-30">
                    <a href="#" class="v-btn btn-green">Xuất excel</a>
                </div>
                <div class="right mt-30">
                    <a class="v-btn btn-outline-red modal-btn">Xóa</a>

<!--                    modal xoa-->
                    <div class="modal text-center">
                        <div class="m-content huy-them">
                            <div class="m-head ">
                                Xóa đơn hàng <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn xóa phiếu đánh giá này?</p>
                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="m-foot d-inline-block">
                                <div class="left">
                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                </div>
                                <div class="right">
                                    <a href="ncc-rating-index.php" class="v-btn btn-green right">Đồng ý</a>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    end modal-->

                    <a href="ncc-ratting-edit.php" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
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