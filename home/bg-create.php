<?php
include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm báo giá</title>
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
                <p class="page-title">Thêm báo giá</p>
            </div>
            <div class="w-100 left mt-10">
                <form action="" class="main-form">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 left">
                                <label>Số báo giá<span class="text-red">*</span></label>
                                <input type="text" name="so_bao_gia" value="BG-999-09827" readonly
                                       required>
                            </div>
                            <div class="form-col-50 no-border mb_15 right">
                                <label>Ngày gửi<span class="text-red">*</span></label>
                                <input type="date" name="ngay_gui">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 left">
                                <div class="v-select2">
                                    <label for="nguoi-lap">Người lập</label>
                                    <select id="nguoi-lap" name="nguoi_lap" class="share_select">
                                        <option value="">-- Chọn người lập --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-col-50 no-border mb_15 right">
                                <div class="v-select2">
                                    <label for="nha-cung-cap">Nhà cung cấp<span
                                                class="text-red">*</span></label>
                                    <select id="nha-cung-cap" name="nha_cung_cap" class="share_select">
                                        <option value="">-- Chọn nhà cung cấp --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 left">
                                <div class="v-select2">
                                    <label for="so-yeu-cau">Theo yêu cầu báo giá số<span
                                                class="text-red">*</span></label>
                                    <select id="so-yeu-cau" name="so_yeu_cau" class="share_select">
                                        <option value="">-- Chọn yêu cầu báo giá --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 left range-date-picker">
                                <label for="ap-dung-tu">Thời gian áp dụng</label>
                                <div class="d-flex align-items-center spc-btw w-100 left fl_wrap">
                                    <div class="w-40 date-input-sm">
                                        <input type="date" name="date_from">
                                    </div>
                                    <p class="text-center">đến</p>
                                    <div class="w-40 date-input-sm">
                                        <input type="date" name="date_to">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-50 left w-100">
                        <div class="table-wrapper mt-15">
                            <div class="table-container table-2848">
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
                                        <tbody>
                                        <tr class="item">
                                            <td class="w-20">
                                                <input type="text"name="ma_vat_tu" readonly>
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="ten_day_du" readonly>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="don_vi_tinh">
                                            </td>
                                            <td class="w-40">
                                                <input type="text" name="hang_san_suat" readonly>
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="so_luong_yeu_cau">
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="so_luong_bao_gia">
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="don_gia">
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="tong_truoc_vat" readonly>
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="thue_vat">
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="tong_sau_vat" readonly>
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="chinh_sach_khac">
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="so_luong_da_dat">
                                            </td>
                                        </tr>
                                        <tr class="item">
                                            <td class="w-20">
                                                <input type="text"name="ma_vat_tu" readonly>
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="ten_day_du" readonly>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="don_vi_tinh">
                                            </td>
                                            <td class="w-40">
                                                <input type="text" name="hang_san_suat" readonly>
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="so_luong_yeu_cau">
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="so_luong_bao_gia">
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="don_gia">
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="tong_truoc_vat" readonly>
                                            </td>
                                            <td class="w-25">
                                                <input type="text" name="thue_vat">
                                            </td>
                                            <td class="w-30">
                                                <input type="text" name="tong_sau_vat" readonly>
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="chinh_sach_khac">
                                            </td>
                                            <td class="w-35">
                                                <input type="text" name="so_luong_da_dat">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                        <button type="submit" class="v-btn btn-blue mt-20">Xong</button>
                    </div>
                </form>
            </div>
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
                    <a href="quan-ly-bao-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

</html>