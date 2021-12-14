<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cài đặt phân quyền</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_ctiet_hd_vc">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_cd mt_25 w_100 fload_l">
                        <div class="top_sett w_100 fload_l">
                            <div class="ctn_top_sett w_100 fload_l">
                                <p class="caidc_ql active"><a href="#" class="cai_dtl">Cài đặt chung</a></p>
                                <p class="his_ql"><a href="#" class="cai_dtl">Nhật ký hoạt động</a></p>
                            </div>
                        </div>
                        <div class="ctn_sett w_100 fload_l">
                            <div class="w_100 fload_l">
                                <a href="#" class="quay_lai share_fsize_one share_clr_one">Quay lại</a>
                            </div>
                            <div class="search_pq w_100 mb_20 fload_l">
                                <p class="share_fsize_two share_clr_one mb_10">Nhân viên / Phòng ban</p>
                                <div class="form_search share_form_select">
                                    <select name="search" class="form-control search_nvpb">
                                        <option value="">Nhập nhân viên / Phòng ban cần phân quyền</option>
                                    </select>
                                </div>
                            </div>
                            <div class="phan_quyen_nd">
                                <div class="ctn_table">
                                    <p class="th_tilt_tb w_100 fload_l d_flex fl_agi dflex_jc share_bgr_one share_clr_tow cr_weight">QUẢN LÝ PHÂN QUYỀN CHO NGƯỜI DÙNG</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="share_tb_five">Quyền người dùng</th>
                                                <th class="share_tb_three">Xem</th>
                                                <th class="share_tb_three">Thêm</th>
                                                <th class="share_tb_three">Sửa</th>
                                                <th class="share_tb_three">Xóa</th>
                                                <th class="share_tb_three">Duyệt / Xác nhận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="share_tb_five">Yêu cầu vật tư</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Hợp đồng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Hợp đồng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Đơn hàng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Hồ sơ thanh toán</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Phiếu thanh toán</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Bảng giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Bảng giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Yêu cầu báo giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Báo giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Nhà cung cấp</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Nhà cung cấp</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Đánh giá nhà cung cấp</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Tiêu chí đánh giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Khách hàng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="them">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="sua">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xoa">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="duyet/xn">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Báo cáo</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Doanh số bán hàng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Công nợ phải thu</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Báo cáo</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="xem">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>

<script type="text/javascript">
    $(".search_nvpb").select2({
        width: '100%',
    })
</script>
</html>
