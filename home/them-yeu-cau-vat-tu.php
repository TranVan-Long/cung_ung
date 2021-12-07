<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
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
            <div class="mt-20">
                <h4 class="mt-5">Thêm yêu cầu vật tư</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50">
                            <label for="so-phieu">Số phiếu yêu cầu<span class="text-red">*</span></label>
                            <input type="text" id="so-phieu" name="so-phieu" value="PH-009-01029" disabled required>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="chon-phong-ban">Chọn phòng ban<span class="text-red">*</span></label>
                            <select name="chon-phong-ban" id="chon-phong-ban" class="share_select">
                                <option value="">-- Chọn phòng ban --</option>
                            </select>
                        </div>
                        <div class="form-col-50 right">
                            <label for="nguoi-yeu-cau">Người yêu cầu<span class="text-red">*</span></label>
                            <select name="nguoi-yeu-cau" id="nguoi-yeu-cau" class="share_select">
                                <option value="">-- Chọn người yêu cầu --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50">
                            <label for="cong-trinh">Chọn công trình<span class="text-red">*</span></label>
                            <select name="cong-trinh" id="cong-trinh" class="share_select">
                                <option value="">-- Chọn công trình --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ngay-tao-yeu-cau">Ngày tạo yêu cầu</label>
                            <input class="date-input" type="text" id="ngay-tao-yeu-cau" value="<?php echo $date ?>"
                                   name="ngay-tao-yeu-cau"
                                   disabled>
                        </div>
                        <div class="form-col-50 right">
                            <label for="deadline">Ngày phải hoàn thành yêu cầu</label>
                            <input class="" type="date" id="deadline" name="deadline"
                                   placeholder="Chọn ngày phải hoàn thành yêu cầu">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-100 left">
                            <label for="dien-giai">Diễn giải</label>
                            <textarea id="dien-giai" name="dien-giai" placeholder="Nhập diễn giải"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-30 left">
                    <p class="text-blue link-text" id="add-material">&plus; Thêm mới vật tư</p>
                    <div class="table-container table-scroll mt-5">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Mã vật tư</th>
                                <th>Tên đầy đủ vật tư thiết bị</th>
                                <th>Đơn vị tính</th>
                                <th>Số lượng yêu cầu duyệt</th>
                            </tr>
                            </thead>
                            <tbody id="materials">
                            <tr class="item">
                                <td class="materials-act"><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                </td>
                                <td class="materials-id">
                                    <select name="materials-id" class="share_select"></select>
                                </td>
                                <td class="materials-name">
                                    <select name="materials-name" class="share_select"></select>
                                </td>
                                <td class="materials-unit"><input type="text" readonly disabled></td>
                                <td class="materials-qty"><input type="text"></td>
                            </tr>
                            <tr class="item">
                                <td class="materials-act"><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                </td>
                                <td class="materials-id">
                                    <select name="materials-id" class="share_select"></select>
                                </td>
                                <td class="materials-name">
                                    <select name="materials-name" class="share_select"></select>
                                </td>
                                <td class="materials-unit"><input type="text" readonly disabled></td>
                                <td class="materials-qty"><input type="text"></td>
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
                                <p>Bạn có chắc chắn muốn hủy việc thêm yêu cầu vật tư?</p>
                                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
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