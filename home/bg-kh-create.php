<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm báo giá cho khách hàng</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>
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
            <div class="mt-30 mb_25">
                <h4>Thêm báo giá cho khách hàng</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left mb_15">
                            <label for="so-bao-gia">Số phiếu phản hồi <span class="text-red">*</span></label>
                            <input type="text" id="so-bao-gia" name="so-bao-gia" value="PP-998-11182" disabled >
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <div class="v-select2 mb_15">
                                <label for="khach-hang">Khách hàng <span class="text-red">*</span></label>
                                <select id="khach-hang" name="khach-hang" class="share_select">
                                    <option value="">-- Chọn khách hàng --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <div class="v-select2 mb_15">
                                <label for="ap-dung-tu">Thời gian áp dụng</label>
                                <div class="d-flex align-items-center spc-btw w-100 left">
                                    <div class="w-40">
                                        <input class="date-input-sm" type="date" id="ap-dung-tu" name="ap-dung-tu">
                                    </div>
                                    <p class="mt-5">đến</p>
                                    <div class="w-40">
                                        <input class="date-input-sm" type="date" id="ap-dung-den" name="ngay-gui">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-100 left mb_15">
                            <label for="noi-dung-phan-hoi">Nội dung phản hồi</label>
                            <textarea name="noi-dung-phan-hoi" id="noi-dung-phan-hoi" cols="30" rows="10" placeholder="Nhập nội dung phản hồi"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-50 left w-100">
                    <p class="text-blue link-text text-500" id="them_vt_bg_kh">&plus; Thêm mới vật tư</p>
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
                                    <tbody id="rererences_kh">
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
                                                    <select class="share_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select class="share_select">
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
                                                    <select class="share_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select class="share_select">
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
            <div class="c-foot mt-30">
                <div class="right">
                    <p class="v-btn btn-outline-blue modal-btn" data-target="cancel">Hủy</p>
                    <button class="v-btn btn-blue ml-20">Xong</button>
                </div>
            </div>
            <div class="modal text-center" id="cancel">
                <div class="m-content">
                    <div class="m-head ">
                        Thông báo <span class="dismiss cancel">&times;</span>
                    </div>
                    <div class="m-body">
                        <p>Bạn có chắc chắn muốn hủy việc tạo phản hồi báo giá?</p>
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
<? include("../modals/modal_logout.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>