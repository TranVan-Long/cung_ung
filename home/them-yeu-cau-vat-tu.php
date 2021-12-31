<?
    include("../includes/icon.php");
    $date = date('d-m-Y', time());
    $date1 = date_format(date_create($date),'m/d/Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm yêu cầu vật tư</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

</head>

<body>
    <div class="main-container ql_them_yc">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="mt_25 w_100 float_l">
                    <a class="prew_href share_fsize_one share_clr_one mb_20" href="quan-ly-yeu-cau-vat-tu.html">Quay lại</a>
                    <h4 class="mb_25 w_100 float_l">Thêm yêu cầu vật tư</h4>
                </div>
                <div class="c-body">
                    <div class="ctiet_them_vtu w_100 float_l">
                        <form action="" class="form_save_add w_100 float_l" method="">
                            <div class="form-control">
                                <div class="form-row left">
                                    <div class="form-col-50 mb_15">
                                        <label for="so-phieu">Số phiếu yêu cầu</label>
                                        <input type="text" id="so-phieu" name="so-phieu" value="PH-009-01029" disabled>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>Phòng ban <span class="text-red">*</span></label>
                                        <select name="phong_ban" class="share_select">
                                            <option value="">-- Chọn phòng ban --</option>
                                        </select>
                                    </div>
                                    <div class="form-col-50 right v-select2 mb_15">
                                        <label>Người yêu cầu <span class="text-red">*</span></label>
                                        <select name="nguoi_yeu_cau" class="share_select">
                                            <option value="">-- Chọn người yêu cầu --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>Công trình <span class="text-red">*</span></label>
                                        <select name="cong_trinh" class="share_select" id="abcvd">
                                            <option value="">-- Chọn công trình --</option>
                                            <option value="1">abc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <label>Ngày tạo yêu cầu</label>
                                        <input class="date-input" type="text" value="<?php echo $date1 ?>"
                                            name="ngay-tao-yeu-cau" disabled>
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <label>Ngày phải hoàn thành yêu cầu</label>
                                        <input class="" type="date" name="deadline"
                                            placeholder="Chọn ngày phải hoàn thành yêu cầu">
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-100 left mb_15">
                                        <label>Diễn giải</label>
                                        <textarea id="dien-giai" name="dien-giai"
                                            placeholder="Nhập diễn giải"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-30 left w-100">
                                <p class="text-blue link-text cr_weight" id="add-material">&plus; Thêm mới vật tư</p>
                                <div class="table-wrapper mt-5">
                                    <div class="table-container table-988">
                                        <div class="tbl-header">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="w-10"></th>
                                                        <th class="w-15">Mã vật tư</th>
                                                        <th class="w-25">Tên vật tư</th>
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
                                                            <p class="removeItem"><i
                                                                    class="ic-delete remove-btn"></i>
                                                            </p>
                                                        </td>
                                                        <td class="w-15">
                                                            <div class="v-select2">
                                                                <select name="materials_id[]"
                                                                    class="share_select"></select>
                                                            </div>
                                                        </td>
                                                        <td class="w-25">
                                                            <div class="v-select2">
                                                                <select name="materials_name[]"
                                                                    class="share_select"></select>
                                                            </div>
                                                        </td>
                                                        <td class="w-20">
                                                            <input type="text" name="dv_tinh" disabled>
                                                        </td>
                                                        <td class="w-25">
                                                            <input type="text" name="so_luong[]">
                                                        </td>
                                                    </tr>
                                                    <tr class="item">
                                                        <td class="w-10">
                                                            <p class="removeItem"><i
                                                                    class="ic-delete remove-btn"></i>
                                                            </p>
                                                        </td>
                                                        <td class="w-15">
                                                            <div class="v-select2">
                                                                <select name="materials_id[]"
                                                                    class="share_select"></select>
                                                            </div>
                                                        </td>
                                                        <td class="w-25">
                                                            <div class="v-select2">
                                                                <select name="materials_name[]"
                                                                    class="share_select"></select>
                                                            </div>
                                                        </td>
                                                        <td class="w-20">
                                                            <input type="text" name="dv_tinh" disabled>
                                                        </td>
                                                        <td class="w-25">
                                                            <input type="text" name="so_luong[]">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-foot mt-30">
                                <div class="right huy_xong">
                                    <button type="button" class="v-btn btn-outline-blue modal-btn"
                                        data-target="cancel">Hủy</button>
                                    <p class="v-btn btn-blue ml-20 luu_them_moi">Xong</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            <div class="m-foot d_flex flex_jct">
                <div class="left mb_10">
                    <button class="v-btn btn-outline-blue left cancel">Hủy</button>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-yeu-cau-vat-tu.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    $(".luu_them_moi").click(function() {
        var creart_ycvt = $(".form_save_add");
        creart_ycvt.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-col-50"));
                error.wrap("<span class='error'>");
            },
            rules: {
                phong_ban: {
                    required: true,
                },
                nguoi_yeu_cau: {
                    required: true,
                },
                cong_trinh: {
                    required: true,
                },
            },
            messages: {
                phong_ban: {
                    required: "Không được để trống",
                },
                nguoi_yeu_cau: {
                    required: "Không được để trống",
                },
                cong_trinh: {
                    required: "Không được để trống",
                },
            },
        });
        if (creart_ycvt.valid() === true) {
            alert("oke");
        }
    });
</script>

</html>