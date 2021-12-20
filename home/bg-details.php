<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết báo giá</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">
</head>

</head>
<body>
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-20 left">
                <a class="text-black" href="quan-ly-bao-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title text-blue mt-20">Chi tiết báo giá</p>
            </div>
            <div class="w-100 left">
                <div class="form-control">
                    <div class="form-row left pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Số báo giá</p>
                            <p class="right text-right w-50 cr_weight">BG-000-10176</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Ngày gửi</p>
                            <p class="right text-right w-50 cr_weight">18/10/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Người lập</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Văn A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50"> Nhà cung cấp</p>
                            <p class="right text-right w-50 cr_weight">Công ty A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Theo yêu cầu báo giá số</p>
                            <p class="right text-right w-50 cr_weight">BG-083-47474</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Thời gian áp dụng</p>
                            <p class="right text-right w-50 cr_weight">18/10/2021 - 05/05/2022</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 left mt-35">
                <div class="table-wrapper mt-30">
                    <div class="table-container table-3192">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-15">Mã vật tư</th>
                                    <th class="w-30">Tên đầy đủ vật tư thiết bị</th>
                                    <th class="w-15">Đơn vị tính</th>
                                    <th class="w-25">Hãng sản xuất</th>
                                    <th class="w-25">Số lượng yêu cầu báo giá</th>
                                    <th class="w-20">Số lượng báo giá</th>
                                    <th class="w-20">Đơn giá</th>
                                    <th class="w-25">Tổng tiền trước VAT</th>
                                    <th class="w-20">Thuế VAT</th>
                                    <th class="w-25">Tổng sau VAT</th>
                                    <th class="w-25">Chính sách khác kèm theo</th>
                                    <th class="w-20">Số lượng đã đặt hàng</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15">VT-000-00000</td>
                                    <td class="w-30">Cát vàng</td>
                                    <td class="w-15">m3</td>
                                    <td class="w-25">m3</td>
                                    <td class="w-25">100</td>
                                    <td class="w-20">100</td>
                                    <td class="w-25">65.000</td>
                                    <td class="w-20">6.500.000</td>
                                    <td class="w-25">10%</td>
                                    <td class="w-20">7.150.000</td>
                                    <td class="w-20">Không có</td>
                                    <td class="w-20">50</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="left mt-15 mr-20">
                    <button class="v-btn btn-green">Xuất excel</button>
                </div>
                <div class="right">
                    <p class="v-btn btn-outline-red modal-btn mt-15" data-target="delete">Xóa</p>
                    <a href="chinh-sua-bao-gia.html" class="v-btn btn-blue mt-15 ml-20">Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal text-center" id="delete">
        <div class="m-content huy-them">
            <div class="m-head ">
                XÓA BÁO GIÁ<span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa thông tin báo giá này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-flex spc-btw">
                <div class="left">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right">
                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("../modals/modal_logout.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>