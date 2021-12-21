<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết yêu cầu vật tư</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

</head>
<body>
<div class="main-container share_res_ct">
    <?php include("../includes/sidebar.php") ?>

    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-20 left">
                <a class="text-black" href="quan-ly-yeu-cau-vat-tu.html"><?php echo $ic_lt ?> Quay lại</a>
                <h4 class="text-blue mt-20 mb_25">Chi tiết yêu cầu vật tư</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left pl-10 mb_12">
                            <p class="left text-left w-50">Số phiếu yêu cầu</p>
                            <p class="right text-right w-50 cr_weight">YC-000-00094</p>
                        </div>
                    </div>
                    <div class="form-row left border-top ">
                        <div class="form-col-50 left pl-10 pt-10 mb_12">
                            <p class="left text-left w-50"> Người yêu cầu</p>
                            <p class="right text-right w-50 cr_weight"> Nguyễn Văn A</p>
                        </div>
                        <div class="form-col-50 right pr-10 pt-10 mb_12">
                            <p class="left text-left w-50">Phòng ban</p>
                            <p class="right text-right w-50 cr_weight">Dự án</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 left pl-10  pt-10 mb_12">
                            <p class="left text-left w-50"> Ngày tạo yêu cầu</p>
                            <p class="right text-right w-50 cr_weight"> 30/10/2021</p>
                        </div>
                        <div class="form-col-50 right pr-10 pt-10 mb_12">
                            <p class="left text-left w-50">Ngày phải hoàn thành yêu cầu</p>
                            <p class="right text-right w-50 cr_weight">10/11/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top pl-10">
                        <div class="form-col-50 left pt-10 mb_12">
                            <p class="left text-left w-50">Công trình</p>
                            <p class="right text-right w-50 cr_weight">Xây dựng nhà sinh hoạt văn hóa phường</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 left pl-10 pt-10 mb_12">
                            <p class="left text-left w-50">Diễn giải</p>
                            <p class="right text-right w-50 cr_weight">Sử dụng để nối thêm đường ống nước</p>
                        </div>
                        <div class="form-col-50 right pr-10 pt-10 mb_12">
                            <p class="left text-left w-50">Trạng thái</p>
                            <p class="right text-right w-50 cr_weight">Chưa duyệt</p>
                        </div>
                    </div>
                    <div class="form-row left border-top d-none">
                        <div class="form-col-50 left pl-10 pt-10 mb_12">
                            <p class="left text-left w-50">Người duyệt</p>
                            <p class="right text-right w-50 cr_weight">Nguyễn Thị B</p>
                        </div>
                        <div class="form-col-50 right pr-10 pt-10 mb_12">
                            <p class="left text-left w-50">Ngày duyệt</p>
                            <p class="right text-right w-50 cr_weight">20/11/2021</p>
                        </div>
                    </div>
                    <div class="form-row left border-top">
                        <div class="form-col-50 pl-10 pt-10 mb_12">
                            <p class="left text-left w-50">Lý do từ chối</p>
                            <p class="right text-right w-50 cr_weight">Không đủ kinh phí</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="left w-100 mt-30">
                <div class="table-wrapper mt-5">
                    <div class="table-container table-sm">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-15">Mã vật tư</th>
                                    <th class="w-30">Tên đầy đủ vật tư thiết bị</th>
                                    <th class="w-20">Đơn vị tính</th>
                                    <th class="w-25">Số lượng yêu cầu duyệt</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table>
                                <tbody id="materials">
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15">VT-000-99877</td>
                                    <td class="w-30">Ống nhựa 0,5 m</td>
                                    <td class="w-20">Cái</td>
                                    <td class="w-25">50</td>
                                </tr>
                                <tr>
                                    <td class="w-10">1</td>
                                    <td class="w-15">VT-000-99877</td>
                                    <td class="w-30">Ống nhựa 0,5 m</td>
                                    <td class="w-20">Cái</td>
                                    <td class="w-25">50</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="right mt-30 xoa_csua">
                    <button class="v-btn btn-outline-red modal-btn" data-target="delete">Xóa</button>
                    <a href="chinh-sua-yeu-cau-vat-tu.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                </div>
                <div class="left mt-30 mr-10">
                    <p class="v-btn btn-green">Xuất excel</p>
                </div>

            </div>
            <div class="modal text-center" id="delete">
                <div class="m-content">
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
                            <p class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</p>
                        </div>
                    </div>
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