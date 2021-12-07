<?php
include "../includes/icon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm hợp đồng thuê</title>
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
    <div class="main-container ql_them_hd_thue">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 fload_l">
                    <div class="chi_tiet_hd w_100 fload_l">
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 fload_l share_fsize_tow share_clr_one cr_weight_bold">Thêm hợp đồng thuê</h4>
                        <div class="ctiet_dk_hp w_100 fload_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 fload_l" method="">
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <input type="text" name="nha_ccap" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Dự án / Công trình </label>
                                        <input type="date" name="duan_ctrinh" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label>Hợp đồng nguyên tắc</label>
                                        <input type="checkbox" name="hd_ntac">
                                    </div>
                                </div>
                                <div class="form-group w_100 fload_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noid_hd" rows="5" class="form-control" placeholder="Nhập nội dung hợp đồng"></textarea>
                                </div>
                                <div class="form-group w_100 fload_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noid_luuy" rows="5" class="form-control" placeholder="Nhập nội dung cần lưu ý"></textarea>
                                </div>
                                <div class="form-group w_100 fload_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieuk_ttoan" rows="5" class="form-control" placeholder="Nhập điều khoản thanh toán"></textarea>
                                </div>
                                <div class="form-row w_100 fload_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên ngân hàng</label>
                                        <select name="ngan_hang" class="form-control ten_nganhang">
                                            <option value="">-- Chọn tên ngân hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="text" name="so_taik" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 fload_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 fload_l">
                                        <table class="table w_100 fload_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_two">Loại tài sản thiết bị</th>
                                                    <th class="share_tb_one">Số lượng</th>
                                                    <th class="share_tb_three">Thời gian thuê</th>
                                                    <th class="share_tb_one">Đơn vị tính</th>
                                                    <th class="share_tb_one">Khối lượng dự kiến</th>
                                                    <th class="share_tb_two">Hạn mức ca máy</th>
                                                    <th class="share_tb_one">Đơn giá thuê</th>
                                                    <th class="share_tb_two">Đơn giá ca máy phụ trội</th>
                                                    <th class="share_tb_two">Thành tiền dự kiến</th>
                                                    <th class="share_tb_two">Thỏa thuận khác</th>
                                                    <th class="share_tb_two">Lưu ý</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p>
                                                            <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="form-group share_form_select">
                                                            <select name="ma_vatt" class="ma_vatt">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="so_luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="don_vi" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="hang-san-xuat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="xuat-xu" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="so-luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="don-gia" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="tien_tvat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="thue_vat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="tien_svat" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="tien_svat" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button"
                                                class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="submit"
                                                class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/sidebar-accordion.js"></script>
<script>
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });
</script>

</html>
