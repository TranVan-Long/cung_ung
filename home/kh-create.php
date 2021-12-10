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
                <h4 class="mt-5">Thêm khách hàng</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ma-khach-hang">Mã khách hàng<span class="text-red">*</span></label>
                            <input type="text" id="ma-khach-hang" name="ma-khach-hang" value="KH-987-554324" disabled
                                   required>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="ma-so-thue">Mã số thuế</label>
                            <input type="text" id="ma-so-thue" name="ma-so-thue" placeholder="Nhập Mã số thuế">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ten-khach-hang">Tên khách hàng<span class="text-red">*</span></label>
                            <input type="text" id="ten-khach-hang" name="ten-khach-hang"
                                   placeholder="Nhập tên khách hàng">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="ten-giao-dich">Tên giao dịch<span class="text-red">*</span></label>
                            <input type="text" id="ten-giao-dich" name="ten-giao-dich" placeholder="Nhập tên giao dịch">
                        </div>

                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ten-goi-tat">Tên gọi tắt</label>
                            <input type="text" id="ten-goi-tat" name="ten-goi-tat" placeholder="Nhập mã số thuế">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="dia-chi-dkkd">Địa chỉ ĐKKD</label>
                            <input type="text" id="dia-chi-dkkd" name="dia-chi-dkkd" placeholder="Nhập địa chỉ ĐKKD">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="so-dkkd">Số ĐKKD</label>
                            <input type="text" id="so-dkkd" name="so-dkkd" placeholder="Nhập số ĐKKD">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="dia-chi-lien-he">Địa chỉ liên hệ</label>
                            <input type="text" id="dia-chi-lien-he" name="dia-chi-lien-he"
                                   placeholder="Nhập địa chỉ liên hệ">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="fax">Fax</label>
                            <input type="text" id="fax" name="fax" placeholder="Nhập Fax">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="dien-thoai">Điện thoại</label>
                            <input type="text" id="dien-thoai" name="dien-thoai" placeholder="Nhập điện thoại">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="website">Website</label>
                            <input type="text" id="website" name="website" placeholder="Nhập Website">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="e-mail">E-mail<span class="text-red">*</span></label>
                            <input type="text" id="e-mail" name="e-mail" placeholder="Nhập E-mail">
                        </div>
                    </div>
                </div>
                <div class="mt-30 left w-100">
                    <div class="border-bottom">
                        <p class="d-inline text-bold">Danh sách tài khoản ngân hàng</p>
                        <p class="text-blue link-text d-inline pl-20" id="add-bank-acc">&plus; Thêm mới tài khoản ngân
                            hàng</p>
                    </div>
                    <div id="bank-list">
                        <div class="bank border-bottom left w-100 pb-20">
                            <div class="form-row left">
                                <div class="form-col-50 left">
                                    <div class="v-select2">
                                        <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">*</span></label>
                                        <select name="ten-ngan-hang" class="share_select">
                                            <option value="">-- Chọn ngân hàng --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-col-50 ml-10-p left">
                                    <div class="v-select2">
                                        <label for="chi-nhanh-ngan-hang">Chi nhánh<span
                                                class="text-red">*</span></label>
                                        <select name="chi-nhanh-ngan-hang" class="share_select">
                                            <option value="">-- Chọn chi nhánh --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 left">
                                    <label for="tai-khoan-ngan-hang">Tài khoản ngân hàng<span
                                            class="text-red">*</span></label>
                                    <input type="text" id="tai-khoan-ngan-hang" name="tai-khoan-ngan-hang"
                                           placeholder="Nhập số tài khoản">
                                </div>
                                <div class="form-col-50 left ml-10-p">
                                    <label for="ma-so-thue">Chủ tài khoản</label>
                                    <input type="text" id="ma-so-thue" name="ma-so-thue" placeholder="Nhập mã số thuế">
                                </div>
                            </div>
                            <div class="right">
                                <p class="removeItem2"><i class="ic-delete2"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-foot mt-30">
                <div class="right">
                    <p class="v-btn btn-outline-blue modal-btn">Hủy</p>
                    <div class="modal text-center">
                        <div class="m-content">
                            <div class="m-head ">
                                Thông báo <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn hủy việc thêm nhà cung cấp?</p>
                                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                            </div>
                            <div class="m-foot d-inline-block">
                                <div class="left">
                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                </div>
                                <div class="right">
                                    <a href="ncc-index.php" class="v-btn btn-green right">Đồng ý</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="ncc-index.php" class="v-btn btn-blue ml-20">Xong</a>
                </div>
            </div>
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