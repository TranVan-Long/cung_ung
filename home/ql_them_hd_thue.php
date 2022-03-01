<?php
include "../includes/icon.php";
include("config.php");
$date = date('m-d-Y', time());
$ep_id = $_SESSION['ep_id'];

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2) {
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];

    foreach ($data_list_nv as $key => $items) {
        $user_name = $items['ep_name'];
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
        $comp_id = $items['com_id'];
    }
    $curl = curl_init();
    $data = array(
        'id_com' => $comp_id,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_vt = json_decode($response, true);
    $vat_tu_data = $list_vt['data']['items'];

    $vat_tu_detail = [];
    for ($i = 0; $i < count($vat_tu_data); $i++) {
        $items_vt = $vat_tu_data[$i];
        $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
    }

    $curl = curl_init();
    $data = array(
        'id_com' => $comp_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_cong_trinh = json_decode($response, true);
    $cong_trinh_data = $list_cong_trinh['data']['items'];


    // echo "<pre>";
    // print_r($vat_tu_detail);
    // echo "</pre>";
    // die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm hợp đồng thuê</title>
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

<body>
    <div class="main-container ql_them_hd_thue">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Thêm hợp đồng thuê</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <select name="id_nha_cung_cap" class="form-control all_nhacc">
                                            <option value="">--Chọn nhà cung cấp--</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
                                            while ($list_ncc = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $list_ncc['id'] ?>"><?= $list_ncc['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình </label>
                                        <select name="dan_ctrinh" class="form-control all_duan">
                                            <option value="">--Chọn Dự án / Công trình--</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>"><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label>Thuê nội bộ</label>
                                        <input type="checkbox" name="thue_noi_bo">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noi_dung_hd" rows="5" class="form-control" placeholder="Nhập nội dung hợp đồng"></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noi_dung_luu_y" rows="5" class="form-control" placeholder="Nhập nội dung cần lưu ý"></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieu_khoan_tt" rows="5" class="form-control" placeholder="Nhập điều khoản thanh toán"></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group autocomplete">
                                        <label>Tên ngân hàng</label>
                                        <input type="text" name="ten_nh" id="ten_nh" class="form-control" autocomplete="off" placeholder="Nhập tên ngân hàng">
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="text" name="so_taik" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_two">Loại tài sản thiết bị</th>
                                                    <th class="share_tb_eight">Thông số kỹ thuật</th>
                                                    <th class="share_tb_seven">Số lượng</th>
                                                    <th class="share_tb_two">Thời gian thuê</th>
                                                    <th class="share_tb_eight">Đơn vị tính</th>
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
                                                    <td class="share_tb_seven">
                                                        <p>
                                                            <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                                                        </p>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="loai_tb" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="text" name="thong_so" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_seven">
                                                        <div class="form-group">
                                                            <input type="text" name="so_luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group tb-date-range">
                                                            <input type="date" name="ngay_bat_dau" class="form-control range">
                                                            <span> - </span>
                                                            <input type="date" name="ngay_ket_thuc" class="form-control range">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="text" name="don_vi_tinh" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="text" name="khoi_luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="han_muc" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="don_gia" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="don_gia_ca_may" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="thanh_tien" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="thoa_thuan_khac" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="luu_y" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button" class="cancel_add mb_10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add mb_10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm hợp đồng thuê thiết bị?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hd_dy_pop">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                        ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="../js/bank-name.js"></script>
<script>
    $(".all_nhacc, .all_duan, .ten_nganhang").select2({
        width: '100%',
    });
    autocomplete(document.getElementById("ten_nh"), bank);

    $(".add_vat_tu").click(function() {
        var html = `<tr>
                                                    <td class="share_tb_seven">
                                                        <p>
                                                            <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                                                        </p>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="loai_tb" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="text" name="thong_so" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_seven">
                                                        <div class="form-group">
                                                            <input type="text" name="so_luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group tb-date-range">
                                                            <input type="date" name="ngay_bat_dau" class="form-control range">
                                                            <span> - </span>
                                                            <input type="date" name="ngay_ket_thuc" class="form-control range">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_eight">
                                                        <div class="form-group">
                                                            <input type="text" name="don_vi_tinh" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="text" name="khoi_luong" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="han_muc" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_one">
                                                        <div class="form-group">
                                                            <input type="number" name="don_gia" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="don_gia_ca_may" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="number" name="thanh_tien" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="thoa_thuan_khac" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td class="share_tb_two">
                                                        <div class="form-group">
                                                            <input type="text" name="luu_y" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>`;
        $(".ctn_table .table tbody").append(html);
        widthSelect();

        if ($(".ctn_table .table tbody").height() > 105.5) {
            $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
        } else {
            $(".ctn_table .table thead tr").css('width', '100%');
        }
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".save_add").click(function() {
        var form_add_thue = $(".form_add_hp_mua");
        form_add_thue.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky_hd: {
                    required: true,
                },
                id_nha_cung_cap: {
                    required: true,
                },
            },
            messages: {
                ngay_ky_hd: {
                    required: "Không được để trống",
                },
                id_nha_cung_cap: {
                    required: "Không được để trống",
                },
            },
        });

        if (form_add_thue.valid() === true) {
            var ep_id = '<?= $ep_id ?>';
            var com_id = '<?= $comp_id ?>';

            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_nha_cung_cap = $("select[name='id_nha_cung_cap']").val();
            var dan_ctrinh = $("select[name='dan_ctrinh']").val();
            var thue_noi_bo = 0;
            if ($("input[name='thue_noi_bo']").is(":checked")) {
                thue_noi_bo = 1;
            }
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();


            var tb_thiet_bi = new Array();
            $("input[name='loai_tb']").each(function() {
                var ten_tb = $(this).val();
                if (ten_tb != "") {
                    tb_thiet_bi.push(ten_tb);
                }
            });
            var tb_thong_so = new Array();
            $("input[name='thong_so']").each(function() {
                var ts_tb = $(this).val();
                if (ts_tb != "") {
                    tb_thong_so.push(ts_tb);
                }
            });
            var tb_so_luong = new Array();
            $("input[name='so_luong']").each(function() {
                var sl_tb = $(this).val();
                if (sl_tb != "") {
                    tb_so_luong.push(sl_tb);
                }
            });
            var tb_ngay_bat_dau = new Array();
            $("input[name='ngay_bat_dau']").each(function() {
                var tgbd_tb = $(this).val();
                if (tgbd_tb != "") {
                    tb_ngay_bat_dau.push(tgbd_tb);
                }
            });
            var tb_ngay_ket_thuc = new Array();
            $("input[name='ngay_ket_thuc']").each(function() {
                var tgkt_tb = $(this).val();
                if (tgkt_tb != "") {
                    tb_ngay_ket_thuc.push(tgkt_tb);
                }
            });
            var tb_don_vi_tinh = new Array();
            $("input[name='don_vi_tinh']").each(function() {
                var dvt_tb = $(this).val();
                if (dvt_tb != "") {
                    tb_don_vi_tinh.push(dvt_tb);
                }
            });
            var tb_khoi_luong = new Array();
            $("input[name='khoi_luong']").each(function() {
                var kl_tb = $(this).val();
                if (kl_tb != "") {
                    tb_khoi_luong.push(kl_tb);
                }
            });
            var tb_han_muc = new Array();
            $("input[name='han_muc']").each(function() {
                var hm_tb = $(this).val();
                if (hm_tb != "") {
                    tb_han_muc.push(hm_tb);
                }
            });
            var tb_don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dg_tb = $(this).val();
                if (dg_tb != "") {
                    tb_don_gia.push(dg_tb);
                }
            });
            var tb_don_gia_ca_may = new Array();
            $("input[name='don_gia_ca_may']").each(function() {
                var dgcm_tb = $(this).val();
                if (dgcm_tb != "") {
                    tb_don_gia_ca_may.push(dgcm_tb);
                }
            });
            var tb_thanh_tien = new Array();
            $("input[name='thanh_tien']").each(function() {
                var total_tb = $(this).val();
                if (total_tb != "") {
                    tb_thanh_tien.push(total_tb);
                }
            });
            var tb_thoa_thuan_khac = new Array();
            $("input[name='thoa_thuan_khac']").each(function() {
                var ttk_tb = $(this).val();
                if (ttk_tb != "") {
                    tb_thoa_thuan_khac.push(ttk_tb);
                }
            });
            var tb_luu_y = new Array();
            $("input[name='luu_y']").each(function() {
                var ly_tb = $(this).val();
                if (ly_tb != "") {
                    tb_luu_y.push(ly_tb);
                }
            });


            $.ajax({
                url: '../ajax/hd_thue_them.php',
                type: 'POST',
                data: {
                    ep_id: ep_id,
                    com_id: com_id,

                    ngay_ky_hd: ngay_ky_hd,
                    id_nha_cung_cap: id_nha_cung_cap,
                    dan_ctrinh: dan_ctrinh,
                    thue_noi_bo: thue_noi_bo,
                    noi_dung_hd: noi_dung_hd,
                    noi_dung_luu_y: noi_dung_luu_y,
                    dieu_khoan_tt: dieu_khoan_tt,
                    ten_nh: ten_nh,
                    so_taik: so_taik,

                    tb_thiet_bi: tb_thiet_bi,
                    tb_thong_so: tb_thong_so,
                    tb_so_luong: tb_so_luong,
                    tb_ngay_bat_dau: tb_ngay_bat_dau,
                    tb_ngay_ket_thuc: tb_ngay_ket_thuc,
                    tb_don_vi_tinh: tb_don_vi_tinh,
                    tb_khoi_luong: tb_khoi_luong,
                    tb_han_muc: tb_han_muc,
                    tb_don_gia: tb_don_gia,
                    tb_don_gia_ca_may: tb_don_gia_ca_may,
                    tb_thanh_tien: tb_thanh_tien,
                    tb_thoa_thuan_khac: tb_thoa_thuan_khac,
                    tb_luu_y: tb_luu_y,

                },
                success: function(data) {
                    if (data == "") {
                        alert("Thêm hợp đồng thuê thiết bị thành công!");
                        window.location.href = 'quan-ly-hop-dong.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>