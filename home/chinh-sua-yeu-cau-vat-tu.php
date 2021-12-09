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
            <div class="mt-20">
                <h4 class="mt-5">Chỉnh sửa yêu cầu vật tư</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50">
                            <label for="so-phieu">Số phiếu yêu cầu<span class="text-red">*</span></label>
                            <input type="text" id="so-phieu" name="so-phieu" value="PH-000-99999" disabled required>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left v-select2">
                            <label for="chon-phong-ban">Phòng ban<span class="text-red">*</span></label>
                            <select name="chon-phong-ban" id="chon-phong-ban" class="share_select">
                                <option value="">Công trình</option>
                            </select>
                        </div>
                        <div class="form-col-50 right v-select2">
                            <label for="nguoi-yeu-cau">Người yêu cầu<span class="text-red">*</span></label>
                            <select name="nguoi-yeu-cau" id="nguoi-yeu-cau" class="share_select">
                                <option value="">Nguyễn Văn A</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 v-select2">
                            <label for="cong-trinh">Công trình<span class="text-red">*</span></label>
                            <select name="cong-trinh" id="cong-trinh" class="share_select">
                                <option value="">Nâng cấp quốc lộ 999</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ngay-tao-yeu-cau">Ngày tạo yêu cầu</label>
                            <input type="date" id="ed-created-date" name="ngay-tao-yeu-cau"
                                   value="2021-01-11" disabled>
                        </div>
                        <div class="form-col-50 right">
                            <label for="deadline">Ngày phải hoàn thành yêu cầu</label>
                            <input type="date" id="ed-deadline" name="deadline"
                                   value="2021-01-11">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-100 left">
                            <label for="dien-giai">Diễn giải</label>
                            <textarea id="dien-giai" name="dien-giai">Không có</textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-30 left w-100">
                    <p class="text-blue link-text" id="add-material">&plus; Thêm mới vật tư</p>
                    <div class="table-container table-scroll mt-5">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="w-10"></th>
                                <th class="w-20">Mã vật tư</th>
                                <th class="w-25">Tên đầy đủ vật tư thiết bị</th>
                                <th class="w-20">Đơn vị tính</th>
                                <th class="w-25">Số lượng yêu cầu duyệt</th>
                            </tr>
                            </thead>
                            <tbody id="materials">
                            <tr class="item">
                                <td><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                </td>
                                <td>
                                    <div class="v-select2">
                                        <select name="materials-id" class="share_select"></select>
                                    </div>
                                </td>
                                <td>
                                    <div class="v-select2">
                                        <select name="materials-name" class="share_select"></select>
                                    </div>
                                </td>
                                <td><input type="text" readonly disabled></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr class="item">
                                <td><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                </td>
                                <td>
                                    <div class="v-select2">
                                        <select name="materials-id" class="share_select"></select>
                                    </div>
                                </td>
                                <td>
                                    <div class="v-select2">
                                        <select name="materials-name" class="share_select"></select>
                                    </div>
                                </td>
                                <td><input type="text" readonly disabled></td>
                                <td><input type="text"></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="c-foot mt-30">
                <div class="right">
                    <p class="v-btn btn-outline-blue modal-btn">Hủy</p>
                    <div class="modal text-center">
                        <div class="m-content huy-them">
                            <div class="m-head ">
                                Thông báo <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa phiếu nhập kho?</p>
                                <p>Các thông tin bạn đã chỉnh sửa sẽ không được lưu.</p>
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
                    <a href="quan-ly-vat-tu.php" class="v-btn btn-blue ml-20">Xong</a>
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