<?php
include("../includes/icon.php");
$date = date('m-d-Y', time())
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cỉnh sửa yêu cầu báo giá</title>
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
<div class="main-container bg_them_yc">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="left mt-25">
                <p class="page-title">Chỉnh sửa yêu cầu báo giá</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Số phiếu yêu cầu</label>
                                <input type="text" name="so_phieu" value="BG-101-38475" readonly required>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Ngày lập</label>
                                <input class="date-input" type="date" name="ngay_danh_gia"
                                       value="2021-10-18">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Người lập</label>
                                <input type="text" name="nguoi_lap" value="Nguyễn Văn A" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15 v-select2">
                                <label>Nhà cung cấp<span class="text-red">&ast;</span></label>
                                <select name="nha_cung_cap" id="nha_cung_cap" class="share_select">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    <option value="1" selected>Công ty A</option>
                                    <option value="2">Công ty B</option>
                                </select>
                            </div>
                            <div class="form-col-50 no-border right mb_15 v-select2">
                                <label>Người tiếp nhận báo giá<span
                                            class="text-red">&ast;</span></label>
                                <select name="nguoi_tiep_nhan" id="nguoi-tiep-nhan" class="share_select">
                                    <option value="">-- Chọn người tiếp nhận báo giá --</option>
                                    <option value="1">Nguyễn Văn A</option>
                                    <option value="2" selected>Nguyễn Văn B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 v-select2">
                                <label>Chọn công trình</label>
                                <select name="cong_trinh" id="cong-trinh" class="share_select">
                                    <option value="">-- Chọn công trình --</option>
                                    <option value="1" selected>Nâng cấp quốc lộ 999</option>
                                    <option value="2">Xây dựng nhà dân dụng</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="w-100 left mb_15">
                                <label>Nội dung thư </label>
                                <textarea name="noi_dung_thu"
                                          placeholder="Nhập nội dung thư">Báo giá</textarea>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Mail nhận báo giá</label>
                                <input type="text" name="mail_nhan_bao_gia" placeholder="Nhập mail nhận báo giá" value="cccccc@gmail.com">
                            </div>
                            <div class="form-col-50 no-border right d-flex mb_15">
                                <div class="d_flex align-items-center checkbox-lbs mt-30">
                                    <label for="gia-VAT" class="mb-0 mr-30">Giá đã bao gồm VAT</label>
                                    <input type="checkbox" name="gia_VAT" id="gia-VAT">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 left w-100">
                        <p class="text-blue link-text text-500" id="add-quote">&plus; Thêm mới vật tư</p>
                        <div class="table-wrapper mt-5">
                            <div class="table-container table-md">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="w-5"></th>
                                            <th class="w-15">Mã vật tư</th>
                                            <th class="w-30">Tên đầy đủ vật tư thiết bị</th>
                                            <th class="w-25">Hãng sản xuất</th>
                                            <th class="w-10">Đơn vị tính</th>
                                            <th class="w-15">Số lượng</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody id="quote-me">
                                        <tr class="item" id="qm1">
                                            <td class="w-5">
                                                <p><i class="ic-delete remove-item" data-target="delete-quote-me"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select name="ma_vat_tu" class="share_select"></select>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="v-select2">
                                                    <select name="ten_day_du"></select>
                                                </div>
                                            </td>
                                            <td class="w-25">
                                                <div class="v-select2">
                                                    <select name="hang_san_xuat"></select>
                                                </div>
                                            </td>
                                            <td class="w-10">
                                                <input type="text" name="don_vi_tinh" readonly>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="so_luong">
                                            </td>
                                        </tr>
                                        <tr class="item" id="qm1">
                                            <td class="w-5">
                                                <p><i class="ic-delete remove-item" data-target="delete-quote-me"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select name="ma_vat_tu" class="share_select"></select>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="v-select2">
                                                    <select name="ten_day_du"></select>
                                                </div>
                                            </td>
                                            <td class="w-25">
                                                <div class="v-select2">
                                                    <select name="hang_san_xuat"></select>
                                                </div>
                                            </td>
                                            <td class="w-10">
                                                <input type="text" name="don_vi_tinh" readonly>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="so_luong">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mt-30 mr-20" data-target="cancel">Hủy</p>
                        <button type="button" class="v-btn btn-blue mt-30 submit-btn">Xong</button>
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
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa yêu cầu báo giá?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="chi-tiet-yeu-cau-bao-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal text-center" id="delete-quote-me">
        <div class="m-content">
            <div class="m-head">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa vật tư này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <button class="v-btn btn-green right confirm-delete"
                            data-target="qm1">Đồng ý
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>

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
                nha_cung_cap: {
                    required: true,
                },
                nguoi_tiep_nhan: {
                    required: true,
                }
            },
            messages: {
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                },
                nguoi_tiep_nhan: {
                    required: "Vui lòng chọn người tiếp nhận.",
                }
            }
        });
        if (form.valid() === true) {
            alert("pass");
        }
    });
</script>
</html>