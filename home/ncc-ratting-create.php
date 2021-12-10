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
                <h4 class="mt-5">Thêm phiếu đánh giá nhà cung cấp</h4>
            </div>
            <div class="c-body">
                <div class="form-control">
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="so-phieu">Số phiếu</label>
                            <input type="text" id="so-phieu" name="so-phieu" value="PH-000-99876" disabled>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="ngay-lap-phieu">Ngày lấp phiếu<span class="text-red">&ast;</span></label>
                            <input type="text" id="ngay-lap-phieu" name="ngay-lap-phieu"
                                   placeholder="Chọn ngày lập phiếu">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="ngay-danh-gia">Ngày đánh giá<span class="text-red">*</span></label>
                            <input class="date-input" type="text" id="ngay-danh-gia" name="ngay-danh-gia"
                                   placeholder="Chọn ngày đánh giá" onfocus="this.type='date'">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="nguoi-danh-gia">Người đánh giá<span class="text-red">*</span></label>
                            <input type="text" id="nguoi-danh-gia" name="nguoi-danh-gia"
                                   placeholder="Nhập người đánh giá">
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <label for="phong-ban">Phòng ban</label>
                            <input type="text" id="phong-ban" name="phong-ban" placeholder="Nhập phòng ban">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <label for="dia-chi-dkkd">Người lập</label>
                            <input type="text" id="dia-chi-dkkd" name="dia-chi-dkkd" placeholder="Nhập người lập">
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <div class="v-select2">
                                <label for="nha-cung-cap">Nhà cung cấp<span class="text-red">*</span></label>
                                <select name="nha-cung-cap" class="share_select">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    <option value="1">Nhà cung cấp A</option>
                                    <option value="2">Nhà cung cấp B</option>
                                    <option value="3">Nhà cung cấp C</option>
                                    <option value="4">Nhà cung cấp D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p>Tên nhà cung cấp</p>
                            <p class="text-bold mt-10">&nbsp;</p>
                        </div>
                        <div class="form-col-50 left ml-10-p">
                            <p>Địa chỉ</p>
                            <p class="text-bold mt-10">&nbsp;</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p>Sản phẩm cung ứng</p>
                            <p class="text-bold mt-10">&nbsp;</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-50 left">
                            <p>Điểm đánh giá</p>
                            <p class="text-bold mt-10">&nbsp;</p>
                        </div>
                    </div>
                    <div class="form-row left">
                        <div class="form-col-100 left">
                            <label for="danh-gia-khac">Ghi chú</label>
                            <textarea type="text" id="danh-gia-khac" name="danh-gia-khac"
                                      placeholder="Nhập ghi chú"></textarea>
                        </div>

                    </div>
                </div>
                <div class="mt-50 left w-100">
                    <p class="text-blue link-text d-inline" id="add-ratting-ruler">&plus; Thêm tiêu chí đánh giá</p>
                    <div class="table-wrapper mt-30">
                        <div class="table-container">
                            <div class="tbl-header">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                    <tr>
                                        <th class="w-5" rowspan="2"></th>
                                        <th class="w-5" rowspan="2">STT</th>
                                        <th class="w-20" rowspan="2">Tiêu chí đánh giá</th>
                                        <th class="w-10" rowspan="2">Hệ số</th>
                                        <th colspan="3" scope="colgroup">Đánh giá</th>
                                    </tr>
                                    <tr class="border-top-w">
                                        <th class="w-20" scope="colgroup">Điểm đánh giá</th>
                                        <th class="w-20" scope="colgroup">Điểm</th>
                                        <th class="w-20" scope="colgroup">Đánh giá chi tiết</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody id="ratting-ruler">
                                    <tr class="item">
                                        <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                        </td>
                                        <td class="w-5">
                                            <p>1</p>
                                        </td>
                                        <td class="w-20">
                                            <div class="v-select2">
                                                <select name="chi-nhanh-ngan-hang" class="share_select"></select>
                                            </div>
                                        </td>
                                        <td class="w-10">
                                            <p>&nbsp;</p>
                                        </td>
                                        <td class="w-20">
                                            <input type="text">
                                        </td>
                                        <td class="w-20">
                                            <p>&nbsp;</p>
                                        </td>
                                        <td class="w-20">
                                            <p>&nbsp;</p>
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
                    <p class="v-btn btn-outline-blue modal-btn">Hủy</p>
                    <div class="modal text-center">
                        <div class="m-content">
                            <div class="m-head ">
                                Thông báo <span class="dismiss cancel">&times;</span>
                            </div>
                            <div class="m-body">
                                <p>Bạn có chắc chắn muốn hủy việc thêm phiếu đánh giá?</p>
                                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                            </div>
                            <div class="m-foot d-inline-block">
                                <div class="left">
                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                </div>
                                <div class="right">
                                    <a href="ncc-rating-index.php" class="v-btn btn-green right">Đồng ý</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="ncc-rating-index.php" class="v-btn btn-blue ml-20">Xong</a>
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