<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết yêu cầu báo giá</title>
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

<body>
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-30 left">
                <a class="text-black" href="quan-ly-yeu-cau-bao-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="text-blue mt-25 page-title">Chi tiết yêu cầu báo giá</p>
            </div>
            <div class="w-100 left">
                <div class="form-control">
                    <div class="form-row left pt-10 mt-10">
                        <div class="form-col-50 pl-10">
                            <p class="left text-left w-50">Số phiếu yêu cầu</p>
                            <p class="right text-right w-50 cr_weight">BG-000-10176</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50"> Ngày lập</p>
                            <p class="right text-right w-50 cr_weight">18/10/2021</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Người lập</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Văn A</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50"> Nhà cung cấp</p>
                            <p class="right text-right w-50 cr_weight">Công ty A</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Người tiếp nhận báo giá</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Thị B</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 pl-10">
                            <p class="left text-left w-50">Công trình</p>
                            <p class="right text-right w-50 cr_weight">Nâng cấp quốc lộ 999</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Nội dung thư</p>
                            <p class="right text-right w-50 cr_weight">Không có</p>
                        </div>
                    </div>
                    <div class="form-row left border-top2 pt-10 mt-10">
                        <div class="form-col-50 left pl-10">
                            <p class="left text-left w-50">Mail nhận báo giá</p>
                            <p class="right text-right w-50 cr_weight">ctcccccycyctctc@gmail.com</p>
                        </div>
                        <div class="form-col-50 right pr-10">
                            <p class="left text-left w-50">Giá đã bao gồm VAT</p>
                            <p class="right text-right w-50 cr_weight text-green">Có</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="left w-100 mt-50">
                <div class="table-wrapper mt-40">
                    <div class="table-container table-1252">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-15">Mã vật tư</th>
                                    <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                    <th class="w-25">Hãng sản xuất</th>
                                    <th class="w-20">Đơn vị tính</th>
                                    <th class="w-20">Khối lượng</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table>
                                <tbody id="materials">
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15">VT-010-01000</td>
                                    <td class="w-35">Aptomat 3fa - 60A - LS</td>
                                    <td class="w-25">Công ty X</td>
                                    <td class="w-20">Cái</td>
                                    <td class="w-20">30</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15">VT-010-01000</td>
                                    <td class="w-35">Aptomat 3fa - 60A - LS</td>
                                    <td class="w-25">Công ty X</td>
                                    <td class="w-20">Cái</td>
                                    <td class="w-20">30</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="left mt-30">
                    <button class="v-btn btn-gray">Gửi mail</button>
                </div>
                <div class="right mt-30">
                    <button class="v-btn btn-outline-red modal-btn" data-target="delete-vt">Xóa</button>
                    <a href="chinh-sua-yeu-cau-bao-gia.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal text-center" id="delete-vt">
        <div class="m-content">
            <div class="m-head ">
                Xóa yêu cầu báo giá<span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa yêu cầu báo giá này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-flex spc-btw">
                <div class="left">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right">
                    <button class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>

</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>