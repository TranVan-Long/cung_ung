<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa báo giá cho khách hàng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>

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
            <div class="left mt-25">
                <p class="page-title">Chỉnh sửa báo giá cho khách hàng</p>
            </div>
            <div class="w-100 left mt-10">
                <div class="form-control edit-form">
                    <div class="form-row left">
                        <div class="form-col-50 no-border left mb_15">
                            <label for="so-bao-gia">Số phiếu phản hồi<span class="text-red">*</span></label>
                            <input type="text" id="so-bao-gia" name="so-bao-gia" value="PH-099-01239" disabled >
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 no-border left mb_15">
                            <div class="v-select2">
                                <label for="khach-hang">Khách hàng<span class="text-red">*</span></label>
                                <select id="khach-hang" name="khach-hang" class="share_select">
                                    <option value="">-- Chọn khách hàng --</option>
                                    <option value="1" selected>Công ty X</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col-50 no-border right mb_15">
                            <div class="v-select2">
                                <label for="ap-dung-tu">Thời gian áp dụng</label>
                                <div class="d-flex align-items-center spc-btw w-100 left">
                                    <div class="w-40">
                                        <input class="date-input-sm" type="date" id="ap-dung-tu" name="ap-dung-tu" value="2021-11-20">
                                    </div>
                                    <p class="mt-5">đến</p>
                                    <div class="w-40">
                                        <input class="date-input-sm" type="date" id="ap-dung-den" name="ngay-gui" value="2022-01-01">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="w-100 no-border left">
                            <label for="noi-dung-phan-hoi">Nội dung phản hồi</label>
                            <textarea name="noi-dung-phan-hoi" id="noi-dung-phan-hoi" cols="30" rows="10" placeholder="Nhập nội dung phản hồi"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-50 left w-100">
                    <p class="text-blue link-text text-500" id="add_bgia">&plus; Thêm mới vật tư</p>
                    <div class="table-wrapper mt-10">
                        <div class="table-container table-1k5">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="w-5"></th>
                                        <th class="w-15">Mã vật tư</th>
                                        <th class="w-20">Tên đầy đủ vật tư thiết bị</th>
                                        <th class="w-20">Hãng sản xuất</th>
                                        <th class="w-15">Số lượng báo giá</th>
                                        <th class="w-15">Đơn vị tính</th>
                                        <th class="w-20">Đơn giá</th>
                                        <th class="w-20">Thành tiền</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table>
                                    <tbody id="rererences_bgia">
                                        <tr class="item">
                                            <td class="w-5">
                                                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select class="share_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-15">
                                                <input type="text">
                                            </td>
                                            <td class="w-15">
                                                <input type="text" disabled>
                                            </td>
                                            <td class="w-20">
                                                <input type="text">
                                            </td>
                                            <td class="w-20">
                                                <input type="text" disabled>
                                            </td>
                                        </tr>
                                        <tr class="item">
                                            <td class="w-5">
                                                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select class="share_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-15">
                                                <input type="text">
                                            </td>
                                            <td class="w-15">
                                                <input type="text" disabled>
                                            </td>
                                            <td class="w-20">
                                                <input type="text">
                                            </td>
                                            <td class="w-20">
                                                <input type="text" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-foot">
                <div class="control-btn right">
                    <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                    <button class="v-btn btn-blue mt-20">Xong</button>
                </div>
            </div>
            <div class="modal text-center" id="cancel">
                <div class="m-content">
                    <div class="m-head ">
                        Thông báo <span class="dismiss cancel">&times;</span>
                    </div>
                    <div class="m-body">
                        <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa phản hồi báo giá?</p>
                        <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                    </div>
                    <div class="m-foot d-inline-block">
                        <div class="left">
                            <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                        </div>
                        <div class="right">
                            <a href="quan-ly-bao-gia-cho-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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
<script type="text/javascript"></script>
</html>