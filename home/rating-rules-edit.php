<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa tiêu chí đánh giá</title>
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
                <p class="page-title">Chỉnh sửa tiêu chí đánh giá</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Tiêu chí đánh giá<span
                                            class="text-red">&ast;</span></label>
                                <input type="text" name="tieu_chi_danh_gia"
                                       placeholder="Nhập tiêu chí đánh giá" value="Chất lượng sản phẩm">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Hệ số</label>
                                <input type="text" name="he_so"
                                       placeholder="Nhập hệ số" value="1">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <div class="v-select2">
                                    <label for="nha-cung-cap" id="nha-cung-cap">Chọn kiểu giá trị</label>
                                    <select id="value-type" name="nha_cung_cap" class="share_select">
                                        <option value="">-- Chọn kiểu giá trị --</option>
                                        <option value="1" selected>Nhập tay</option>
                                        <option value="2">Danh sách</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-control edit-form mt-15 left w-100 manual-value">
                        <div class="border-bottom pb-10">
                            <p class="d-inline-block text-bold mr-20 mt-15">Danh sách giá trị</p>
                            <p class="d-inline-block text-blue link-text text-500 mt-15" id="add-rules-value">&plus;
                                Thêm mới tài giá trị</p>
                        </div>
                        <div id="rules-value">
                        </div>
                    </div>
                    <div class="w-100 left mt-30">
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc sửa tiêu chí đánh giá?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="tieu-chi-danh-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                tieu_chi_danh_gia: {
                    required: true,
                },
                gia_tri: {
                    required: true,
                }
            },
            messages: {
                tieu_chi_danh_gia: {
                    required: "Tiêu chí đánh giá không được để trống.",
                },
                gia_tri: {
                    required: "Giá trị không được để trống.",
                }
            }
        });
        if (form.valid() === true) {
            alert("pass");
        }
    });
</script>
</html>