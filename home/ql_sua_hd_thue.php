<?php
include "../includes/icon.php";
include("config.php");
$date = date('m-d-Y', time());
$com_id = "";
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
}

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = '$hd_id' ");
    $get_vt_thue = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);
    $ep_id = $_SESSION['ep_id'];
}
$ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
$id_ncc = $hd_detail['id_nha_cc_kh'];
$du_an_ctr = $hd_detail['id_du_an_ctrinh'];
$ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
$ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);
$hinh_thuc_hd = $hd_detail['hinh_thuc_hd'];
$thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2) {
    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_vt = json_decode($response, true);
    $vat_tu_data = $list_vt['data']['items'];
    $count_vt = count($vat_tu_data);

    $vat_tu_detail = [];
    for ($i = 0; $i < count($vat_tu_data); $i++) {
        $items_vt = $vat_tu_data[$i];
        $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
    }

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_ct = json_decode($response, true);
    $cong_trinh_data = $list_ct['data']['items'];


    // echo "<pre>";
    // print_r($cong_trinh_data);
    // echo "</pre>";
    // die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa hợp đồng thuê</title>
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
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Sửa hợp đồng thuê</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" method="">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" value="HĐ - <?= $hd_id ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= $ngay_hop_dong ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <select name="id_ncc" class="form-control all_nhacc">
                                            <option value="">--Chọn nhà cung cấp--</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_ncc == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình </label>
                                        <select name="id_cong_trinh" class="form-control all_duan">
                                            <option value="">--Chọn Dự án / Công trình--</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $du_an_ctr) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="thue_noi_bo">Thuê nội bộ</label>
                                        <input type="checkbox" name="thue_noi_bo" id="thue_noi_bo" <?= ($hd_detail['thue_noi_bo'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noi_dung_hd" rows="5" class="form-control" placeholder="Nhập nội dung hợp đồng"><?= $hd_detail['noi_dung_hd'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noi_dung_luu_y" rows="5" class="form-control" placeholder="Nhập nội dung cần lưu ý"><?= $hd_detail['noi_dung_luu_y'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieu_khoan_tt" rows="5" class="form-control" placeholder="Nhập điều khoản thanh toán"><?= $hd_detail['dieu_khoan_tt'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group autocomplete">
                                        <label>Tên ngân hàng</label>
                                        <input type="text" name="ten_nh" id="ten_nh" value="<?= $hd_detail['ten_ngan_hang'] ?>" class="form-control" autocomplete="off" placeholder="Nhập tên ngân hàng">
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="text" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nhập số tài khoản">
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
                                                <?
                                                while ($vt_thue_fetch = mysql_fetch_assoc($get_vt_thue->result)) {
                                                    $thue_tu_ngay = date('Y-m-d', $vt_thue_fetch['thue_tu_ngay']);
                                                    $thue_den_ngay = date('Y-m-d', $vt_thue_fetch['thue_den_ngay']);

                                                ?>
                                                    <tr>
                                                        <td class="share_tb_seven">
                                                            <p>
                                                                <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                                                                <input type="hidden" name="id_thiet_bi_old" value="<?= $vt_thue_fetch['id'] ?>" class="share_dnone">
                                                            </p>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="loai_tb_old" value="<?= $vt_thue_fetch['loai_tai_san'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="text" name="thong_so_old" value="<?= $vt_thue_fetch['thong_so_kthuat'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_seven">
                                                            <div class="form-group">
                                                                <input type="text" name="so_luong_old" value="<?= $vt_thue_fetch['so_luong'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group tb-date-range">
                                                                <input type="date" name="ngay_bat_dau_thue_old" value="<?= $thue_tu_ngay ?>" class="form-control range">
                                                                <span> - </span>
                                                                <input type="date" name="ngay_ket_thuc_thue_old" value="<?= $thue_den_ngay ?>" class="form-control range">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_eight">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vt_thue_fetch['don_vi_tinh'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="text" name="khoi_luong_old" value="<?= $vt_thue_fetch['khoi_luong_du_kien'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="han_muc_old" value="<?= $vt_thue_fetch['han_muc_ca_may'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_one">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_old" value="<?= $vt_thue_fetch['don_gia_thue'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_ca_may_old" value="<?= $vt_thue_fetch['dg_ca_may_phu_troi'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="number" name="thanh_tien_old" value="<?= $vt_thue_fetch['thanh_tien_du_kien'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="thoa_thuan_khac_old" value="<?= $vt_thue_fetch['thoa_thuan_khac'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_two">
                                                            <div class="form-group">
                                                                <input type="text" name="luu_y_old" value="<?= $vt_thue_fetch['luu_y'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button" class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hợp đồng thuê thiết bị?</p>
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
<script>
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });

    $('.add_vat_tu').click(function() {
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
                                <input type="date" name="ngay_bat_dau_thue" class="form-control range">
                                <span> - </span>
                                <input type="date" name="ngay_ket_thuc_thue" class="form-control range">
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
                ngay_ky: {
                    required: true,
                },
                ten_nhacc: {
                    required: true,
                },
            },
            messages: {
                ngay_ky: {
                    required: "Không được để trống",
                },
                ten_nhacc: {
                    required: "Không được để trống",
                },
            },
        });

        if (form_add_thue.valid() === true) {
            var ep_id = '<?= $ep_id ?>';
            var com_id = '<?= $comp_id ?>';

            var hd_id = <?= $hd_id ?>;
            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_ncc = $("select[name='id_ncc']").val();
            var id_cong_trinh = $("select[name='id_cong_trinh']").val();
            var thue_noi_bo = 0;
            if ($("input[name='thue_noi_bo']").is(":checked")) {
                thue_noi_bo = 1;
            }
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();

            //old
            var id_thiet_bi_old = new Array();
            $("input[name='id_thiet_bi_old']").each(function() {
                var id_tb_old = $(this).val();
                if (id_tb_old != "") {
                    id_thiet_bi_old.push(id_tb_old);
                }
            });
            var loai_tb_old = new Array();
            $("input[name='loai_tb_old']").each(function() {
                var l_tb_old = $(this).val();
                if (l_tb_old != "") {
                    loai_tb_old.push(l_tb_old);
                }
            });
            var thong_so_old = new Array();
            $("input[name='thong_so_old']").each(function() {
                var ts_old = $(this).val();
                if (ts_old != "") {
                    thong_so_old.push(ts_old);
                }
            });
            var so_luong_old = new Array();
            $("input[name='so_luong_old']").each(function() {
                var sl_old = $(this).val();
                if (sl_old != "") {
                    so_luong_old.push(sl_old);
                }
            });
            var ngay_bat_dau_thue_old = new Array();
            $("input[name='ngay_bat_dau_thue_old']").each(function() {
                var bd_thue = $(this).val();
                if (bd_thue != "") {
                    ngay_bat_dau_thue_old.push(bd_thue);
                }
            });
            var ngay_ket_thuc_thue_old = new Array();
            $("input[name='ngay_ket_thuc_thue_old']").each(function() {
                var kt_thue = $(this).val();
                if (kt_thue != "") {
                    ngay_ket_thuc_thue_old.push(kt_thue);
                }
            });
            var don_vi_tinh_old = new Array();
            $("input[name='don_vi_tinh_old']").each(function() {
                var vdt_old = $(this).val();
                if (vdt_old != "") {
                    don_vi_tinh_old.push(vdt_old);
                }
            });
            var khoi_luong_old = new Array();
            $("input[name='khoi_luong_old']").each(function() {
                var kl_old = $(this).val();
                if (kl_old != "") {
                    khoi_luong_old.push(kl_old);
                }
            });
            var han_muc_old = new Array();
            $("input[name='han_muc_old']").each(function() {
                var hm_old = $(this).val();
                if (hm_old != "") {
                    han_muc_old.push(hm_old);
                }
            });
            var don_gia_old = new Array();
            $("input[name='don_gia_old']").each(function() {
                var dg_old = $(this).val();
                if (dg_old != "") {
                    don_gia_old.push(dg_old);
                }
            });
            var don_gia_ca_may_old = new Array();
            $("input[name='don_gia_ca_may_old']").each(function() {
                var dg_cm_old = $(this).val();
                if (dg_cm_old != "") {
                    don_gia_ca_may_old.push(dg_cm_old);
                }
            });
            var thanh_tien_old = new Array();
            $("input[name='thanh_tien_old']").each(function() {
                var tt_old = $(this).val();
                if (tt_old != "") {
                    thanh_tien_old.push(tt_old);
                }
            });
            var thoa_thuan_khac_old = new Array();
            $("input[name='thoa_thuan_khac_old']").each(function() {
                var ttk_old = $(this).val();
                if (ttk_old != "") {
                    thoa_thuan_khac_old.push(ttk_old);
                }
            });
            var luu_y_old = new Array();
            $("input[name='luu_y_old']").each(function() {
                var ly = $(this).val();
                if (ly != "") {
                    luu_y_old.push(ly);
                }
            });

            //new
            var loai_tb = new Array();
            $("input[name='loai_tb']").each(function() {
                var l_tb = $(this).val();
                if (l_tb != "") {
                    loai_tb.push(l_tb);
                }
            });
            var thong_so = new Array();
            $("input[name='thong_so']").each(function() {
                var ts = $(this).val();
                if (ts != "") {
                    thong_so.push(ts);
                }
            });
            var so_luong = new Array();
            $("input[name='so_luong']").each(function() {
                var sl = $(this).val();
                if (sl != "") {
                    so_luong.push(sl);
                }
            });
            var ngay_bat_dau_thue = new Array();
            $("input[name='ngay_bat_dau_thue']").each(function() {
                var bd_thue = $(this).val();
                if (bd_thue != "") {
                    ngay_bat_dau_thue.push(bd_thue);
                }
            });
            var ngay_ket_thuc_thue = new Array();
            $("input[name='ngay_ket_thuc_thue']").each(function() {
                var kt_thue = $(this).val();
                if (kt_thue != "") {
                    ngay_ket_thuc_thue.push(kt_thue);
                }
            });
            var don_vi_tinh = new Array();
            $("input[name='don_vi_tinh']").each(function() {
                var vdt = $(this).val();
                if (vdt != "") {
                    don_vi_tinh.push(vdt);
                }
            });
            var khoi_luong = new Array();
            $("input[name='khoi_luong']").each(function() {
                var kl = $(this).val();
                if (kl != "") {
                    khoi_luong.push(kl);
                }
            });
            var han_muc = new Array();
            $("input[name='han_muc']").each(function() {
                var hm = $(this).val();
                if (hm != "") {
                    han_muc.push(hm);
                }
            });
            var don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dg = $(this).val();
                if (dg != "") {
                    don_gia.push(dg);
                }
            });
            var don_gia_ca_may = new Array();
            $("input[name='don_gia_ca_may']").each(function() {
                var dg_cm = $(this).val();
                if (dg_cm != "") {
                    don_gia_ca_may.push(dg_cm);
                }
            });
            var thanh_tien = new Array();
            $("input[name='thanh_tien']").each(function() {
                var tt = $(this).val();
                if (tt != "") {
                    thanh_tien.push(tt);
                }
            });
            var thoa_thuan_khac = new Array();
            $("input[name='thoa_thuan_khac']").each(function() {
                var ttk = $(this).val();
                if (ttk != "") {
                    thoa_thuan_khac.push(ttk);
                }
            });
            var luu_y = new Array();
            $("input[name='luu_y']").each(function() {
                var ly = $(this).val();
                if (ly != "") {
                    luu_y.push(ly);
                }
            });


            $.ajax({
                url: '../ajax/hd_thue_sua.php',
                type: 'POST',
                data: {
                    ep_id: ep_id,
                    com_id: com_id,

                    hd_id: hd_id,
                    ngay_ky_hd: ngay_ky_hd,
                    id_ncc: id_ncc,
                    id_cong_trinh: id_cong_trinh,
                    thue_noi_bo: thue_noi_bo,
                    noi_dung_hd: noi_dung_hd,
                    noi_dung_luu_y: noi_dung_luu_y,
                    dieu_khoan_tt: dieu_khoan_tt,
                    ten_nh: ten_nh,
                    so_taik: so_taik,

                    id_thiet_bi_old: id_thiet_bi_old,
                    loai_tb_old: loai_tb_old,
                    thong_so_old: thong_so_old,
                    so_luong_old: so_luong_old,
                    ngay_bat_dau_thue_old: ngay_bat_dau_thue_old,
                    ngay_ket_thuc_thue_old: ngay_ket_thuc_thue_old,
                    don_vi_tinh_old: don_vi_tinh_old,
                    khoi_luong_old: khoi_luong_old,
                    han_muc_old: han_muc_old,
                    don_gia_old: don_gia_old,
                    don_gia_ca_may_old: don_gia_ca_may_old,
                    thanh_tien_old: thanh_tien_old,
                    thoa_thuan_khac_old: thoa_thuan_khac_old,
                    luu_y_old: luu_y_old,
                    

                    loai_tb: loai_tb,
                    thong_so: thong_so,
                    so_luong: so_luong,
                    ngay_bat_dau_thue: ngay_bat_dau_thue,
                    ngay_ket_thuc_thue: ngay_ket_thuc_thue,
                    don_vi_tinh: don_vi_tinh,
                    khoi_luong: khoi_luong,
                    han_muc: han_muc,
                    don_gia: don_gia,
                    don_gia_ca_may: don_gia_ca_may,
                    thanh_tien: thanh_tien,
                    thoa_thuan_khac: thoa_thuan_khac,
                    luu_y: luu_y,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Chỉnh sửa hợp đồng thuê thiết bị thành công!");
                        window.location.href = 'quan-ly-chi-tiet-hop-dong-thue-thiet-bi-<?= $hd_id ?>.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>