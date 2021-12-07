<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cung ứng xây dựng</title>
    <link href="../css/select2.min.css" rel="stylesheet"/>
    <link href="../css/app.css" rel="stylesheet">

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
                <a class="text-black" href="quan-ly-vat-tu.php"><?php echo $ic_lt ?> Quay lại</a>
                <h4 class="text-blue mt-20">Chi tiết yêu cầu vật tư</h4>
            </div>
            <div class="c-body">

                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50">
                            <p class="left text-left w-50">Số phiếu yêu cầu</p>
                            <p class="right text-right w-50 text-bold">YC-000-00094</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Người yêu cầu</p>
                            <p class="right text-right w-50 text-bold"> Nguyễn Văn A</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Phòng ban</p>
                            <p class="right text-right w-50 text-bold">Dự án</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50"> Ngày tạo yêu cầu</p>
                            <p class="right text-right w-50 text-bold"> 30/10/2021</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Ngày phải hoàn thành yêu cầu</p>
                            <p class="right text-right w-50 text-bold">10/11/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50">
                            <p class="left text-left w-50">Công trình</p>
                            <p class="right text-right w-50 text-bold">Xây dựng nhà sinh hoạt văn hóa phường</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Diễn giải</p>
                            <p class="right text-right w-50 text-bold">Sử dụng để nối thêm đường ống nước</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Trạng thái</p>
                            <p class="right text-right w-50 text-bold">Chưa duyệt</p>
                        </div>
                    </div>
                    <div class="form-row left border-top d-none">
                        <div class="form-col-50 left">
                            <p class="left text-left w-50">Người duyệt</p>
                            <p class="right text-right w-50 text-bold">Nguyễn Thị B</p>
                        </div>
                        <div class="form-col-50 right">
                            <p class="left text-left w-50">Ngày duyệt</p>
                            <p class="right text-right w-50 text-bold">20/11/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50">
                            <p class="left text-left w-50">Lý do từ chối</p>
                            <p class="right text-right w-50 text-bold">Không đủ kinh phí</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="c-foot mt-30">
                <div class="table-container table-scroll">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã vật tư</th>
                            <th>Tên đầy đủ vật tư thiết bị</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng yêu cầu duyệt</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>VT-000-99877</td>
                            <td>Ống nhựa 0,5 m</td>
                            <td>Cái</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>VT-000-99877</td>
                            <td>Ống nhựa 0,5 m</td>
                            <td>Cái</td>
                            <td>50</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="left mt-30">
                    <a href="#" class="v-btn btn-green">Xuất excel</a>
                </div>
                <div class="right mt-30">
                    <a href="#" class="v-btn btn-outline-red modal-btn">Xóa</a>
                    <div class="modal text-center">
                        <div class="m-content huy-them">
                            <div class="m-head ">
                                Xóa yêu cầu vật tư <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn xóa yêu cầu vật tư này?</p>
                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="m-foot d-inline-block">
                                <div class="left">
                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                </div>
                                <div class="right">
                                    <a href="quan-ly-vat-tu.php" class="v-btn btn-green right">Đồng ý</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="chinh-sua-yeu-cau-vat-tu.php" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
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