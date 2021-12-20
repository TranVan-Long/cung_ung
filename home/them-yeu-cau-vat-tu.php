<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm yêu cầu vật tư</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />
    <link href="../css/select2.min.css" rel="stylesheet" />

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
                <div class="mt_25 mb_25">
                    <h4>Thêm yêu cầu vật tư</h4>
                </div>
                <div class="c-body">
                    <div class="form-control">
                        <div class="form-row left">
                            <div class="form-col-50 mb_15">
                                <label for="so-phieu">Số phiếu yêu cầu <span class="text-red">*</span></label>
                                <input type="text" id="so-phieu" name="so-phieu" value="PH-009-01029" disabled required>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left v-select2 mb_15">
                                <label for="chon-phong-ban">Chọn phòng ban <span class="text-red">*</span></label>
                                <select name="chon-phong-ban" id="chon-phong-ban" class="share_select">
                                    <option value="">-- Chọn phòng ban --</option>
                                </select>
                            </div>
                            <div class="form-col-50 right v-select2 mb_15">
                                <label for="nguoi-yeu-cau">Người yêu cầu <span class="text-red">*</span></label>
                                <select name="nguoi-yeu-cau" id="nguoi-yeu-cau" class="share_select">
                                    <option value="">-- Chọn người yêu cầu --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 v-select2 mb_15">
                                <label for="cong-trinh">Chọn công trình <span class="text-red">*</span></label>
                                <select name="cong-trinh" id="cong-trinh" class="share_select">
                                    <option value="">-- Chọn công trình --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label for="ngay-tao-yeu-cau">Ngày tạo yêu cầu</label>
                                <input class="date-input" type="text" id="ngay-tao-yeu-cau" value="<?php echo $date ?>"
                                    name="ngay-tao-yeu-cau" disabled>
                            </div>
                            <div class="form-col-50 right mb_15">
                                <label for="deadline">Ngày phải hoàn thành yêu cầu</label>
                                <input class="" type="date" id="deadline" name="deadline"
                                    placeholder="Chọn ngày phải hoàn thành yêu cầu">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-100 left mb_15">
                                <label for="dien-giai">Diễn giải</label>
                                <textarea id="dien-giai" name="dien-giai" placeholder="Nhập diễn giải"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 left w-100">
                        <p class="text-blue link-text cr_weight" id="add-material">&plus; Thêm mới vật tư</p>
                        <div class="table-wrapper mt-5">
                            <div class="table-container">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-10"></th>
                                                <th class="w-15">Mã vật tư</th>
                                                <th class="w-25">Tên đầy đủ vật tư thiết bị</th>
                                                <th class="w-20">Đơn vị tính</th>
                                                <th class="w-25">Số lượng yêu cầu duyệt</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody id="materials">
                                            <tr class="item">
                                                <td class="w-10">
                                                    <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                                </td>
                                                <td class="w-15">
                                                    <div class="v-select2">
                                                        <select name="materials-id" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-25">
                                                    <div class="v-select2">
                                                        <select name="materials-name" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-20">
                                                    <input type="text" disabled>
                                                </td>
                                                <td class="w-25">
                                                    <input type="text">
                                                </td>
                                            </tr>
                                            <tr class="item">
                                                <td class="w-10">
                                                    <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                                </td>
                                                <td class="w-15">
                                                    <div class="v-select2">
                                                        <select name="materials-id" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-25">
                                                    <div class="v-select2">
                                                        <select name="materials-name" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-20">
                                                    <input type="text" name="" disabled>
                                                </td>
                                                <td class="w-25">
                                                    <input type="text" name="">
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
                        <button class="v-btn btn-outline-blue modal-btn" data-target="cancel">Hủy</button>
                        <a href="quan-ly-vat-tu.php" class="v-btn btn-blue ml-20">Xong</a>
                    </div>
                </div>
                <div class="modal text-center" id="cancel">
                    <div class="m-content">
                        <div class="m-head ">
                            Thông báo <span class="dismiss cancel">&times;</span>
                        </div>
                        <div class="m-body">
                            <p>Bạn có chắc chắn muốn hủy việc thêm yêu cầu vật tư?</p>
                            <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                        </div>
                        <div class="m-foot d-inline-block">
                            <div class="left">
                                <button class="v-btn btn-outline-blue left cancel">Hủy</button>
                            </div>
                            <div class="right">
                                <a href="quan-ly-yeu-cau-vat-tu.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include('../modals/modal_logout.php') ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</html>