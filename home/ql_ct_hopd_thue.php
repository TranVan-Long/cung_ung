<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết hợp đồng thuê thiết bị</title>
    <link href="../css/select2.min.css" rel="stylesheet" />
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
    <div class="main-container ql_ctiet_hd_thue">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-hop-dong.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi tiết hợp đồng thuê thiết bị</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ-198-24201</p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">12/10/2021</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nhà cung cấp</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Công ty ABCXYZ</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Dự án / Công trình</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Nâng cấp quốc lộ 999</p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thuê nội bộ</p>
                                    <p class="cr_weight share_fsize_tow cr_red">Không</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hình thức hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Hợp đồng trọn gói</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tên ngân hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">VCB</p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số tài khoản</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">0287666827456</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nội dung hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Thuê thiết bị</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nội dung cần lưu ý</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Không có</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Điều khoản thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Không có</p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Loại tài sản thiết bị</th>
                                            <th class="share_tb_two">Thông số kỹ thuật</th>
                                            <th class="share_tb_one">Số lượng</th>
                                            <th class="share_tb_two">Thời gian thuê</th>
                                            <th class="share_tb_one">Đợn vị tính</th>
                                            <th class="share_tb_one">Khối lượng dự kiến</th>
                                            <th class="share_tb_one">Hạn mức ca máy</th>
                                            <th class="share_tb_one">Đơn giá thuế</th>
                                            <th class="share_tb_two">Đơn giá ca máy phụ hồi</th>
                                            <th class="share_tb_two">Thành tiền dự kiến</th>
                                            <th class="share_tb_two">Thỏa thuận khác</th>
                                            <th class="share_tb_two">Lưu ý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="share_tb_one">1</td>
                                            <td class="share_tb_two">Cần trục tháp</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_two">13/11/2021 - 15/11/2021</td>
                                            <td class="share_tb_one">Cái</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_two">0</td>
                                            <td class="share_tb_two">10.000.000</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_two">Không có</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one">1</td>
                                            <td class="share_tb_two">Cần trục tháp</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_two">13/11/2021 - 15/11/2021</td>
                                            <td class="share_tb_one">Cái</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_two">0</td>
                                            <td class="share_tb_two">10.000.000</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_two">Không có</td>
                                        </tr>
                                        <tr>
                                            <td class="share_tb_one">1</td>
                                            <td class="share_tb_two">Cần trục tháp</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_two">13/11/2021 - 15/11/2021</td>
                                            <td class="share_tb_one">Cái</td>
                                            <td class="share_tb_one">2</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_one">2.000.000</td>
                                            <td class="share_tb_two">0</td>
                                            <td class="share_tb_two">10.000.000</td>
                                            <td class="share_tb_two">Không có</td>
                                            <td class="share_tb_two">Không có</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc mb_10 d_flex right">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="chinh-sua-hop-dong-thue-thiet-bi.html" class="share_clr_tow">Chỉnh sửa</a>
                                </p>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc mb_10 d_flex left mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20">Gửi mail</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỢP ĐỒNG THUÊ THIẾT BỊ</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hợp đồng thuê thiết bị này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button"
                                        class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button"
                                        class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
    var remove_hd = $(".remove_hd");

    remove_hd.click(function() {
        modal_share.show();
    });

</script>

</html>
