<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm báo giá</title>
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
            <div class="mt-30">
                <h4 class="mt-5">Thêm báo giá</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="so-bao-gia">Số báo giá<span class="text-red">*</span></label>
                            <input type="text" id="so-bao-gia" name="so-bao-gia" value="BG-999-09827" disabled
                                   required>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="ngay-gui">Ngày gửi<span class="text-red">*</span></label>
                            <input type="date" id="ngay-gui" name="ngay-gui">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <div class="v-select2">
                                <label for="nguoi-lap">Người lập</label>
                                <select id="nguoi-lap" name="nguoi-lap" class="share_select">
                                    <option value="">-- Chọn người lập --</option>
                                    <option value="Nguyễn Văn A">Nguyễn Văn A</option>
                                    <option value="Nguyễn Văn B">Nguyễn Văn B</option>
                                    <option value="Nguyễn Thị A">Nguyễn Thị A</option>
                                    <option value="Nguyễn Thị B">Nguyễn Thị B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <div class="v-select2">
                                <label for="nha-cung-cap">Nhà cung cấp<span
                                            class="text-red">*</span></label>
                                <select id="nha-cung-cap" name="nha-cung-cap" class="share_select">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    <option value="Công ty A">Công ty A</option>
                                    <option value="Công ty B">Công ty B</option>
                                    <option value="Công ty C">Công ty C</option>
                                    <option value="Công ty D">Công ty D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <div class="v-select2">
                                <label for="so-yeu-cau">Theo yêu cầu báo giá số<span class="text-red">*</span></label>
                                <select id="so-yeu-cau" name="so-yeu-cau" class="share_select">
                                    <option value="">-- Chọn yêu cầu báo giá --</option>
                                    <option value="YC-001-02938">YC-001-02938</option>
                                    <option value="YC-020-45648">YC-020-45648</option>
                                    <option value="YC-999-73648">YC-999-73648</option>
                                    <option value="YC-888-39475">YC-888-39475</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
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
                <div class="mt-50 left w-100">
                    <div class="table-wrapper mt-15">
                        <div class="table-container table-2k8">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="w-20">Mã vật tư</th>
                                        <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                        <th class="w-15">Đơn vị tính</th>
                                        <th class="w-40">Hãng sản xuất</th>
                                        <th class="w-30">Số lượng yêu cầu báo giá</th>
                                        <th class="w-25">Số lượng báo giá</th>
                                        <th class="w-25">Đơn giá</th>
                                        <th class="w-30">Tổng tiền trước VAT</th>
                                        <th class="w-25">Thuế VAT</th>
                                        <th class="w-30">Tổng sau VAT</th>
                                        <th class="w-35">Chính sách khác kèm theo</th>
                                        <th class="w-35">Số lượng đã đặt hàng</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table>
                                    <tbody id="rererences">
                                    <tr class="item">
                                        <td class="w-20">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-35">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-15">
                                            <input type="text">
                                        </td>
                                        <td class="w-40">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-30">
                                            <input type="text">
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-30">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-30">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-35">
                                            <input type="text">
                                        </td>
                                        <td class="w-35">
                                            <input type="text">
                                        </td>
                                    </tr>
                                    <tr class="item">
                                        <td class="w-20">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-35">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-15">
                                            <input type="text">
                                        </td>
                                        <td class="w-40">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-30">
                                            <input type="text">
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-30">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-25">
                                            <input type="text">
                                        </td>
                                        <td class="w-30">
                                            <input type="text" disabled>
                                        </td>
                                        <td class="w-35">
                                            <input type="text">
                                        </td>
                                        <td class="w-35">
                                            <input type="text">
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
                        <p>Bạn có chắc chắn muốn hủy việc thêm báo giá?</p>
                        <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                    </div>
                    <div class="m-foot d-inline-block">
                        <div class="left">
                            <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                        </div>
                        <div class="right">
                            <a href="quan-ly-bao-gia.html" class="v-btn btn-green right">Đồng ý</a>
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