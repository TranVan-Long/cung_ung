<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $role = 1;
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $role = 2;
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `hop_dong` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hop_dong2 = explode(',', $item_nv['hop_dong']);
            if (in_array(2, $hop_dong2) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response1 = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response1, true);
$vat_tu_data = $list_vt['data']['items'];

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm hợp đồng bán</title>
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
    <div class="main-container ql_them_hd_ban">
        <? include('../includes/sidebar.php') ?>

        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one mb_20 share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Thêm hợp đồng bán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Khách hàng <span class="cr_red">*</span></label>
                                        <select name="id_khach_hang" class="form-control all_nhacc">
                                            <option value="">-- Chọn khách hàng --</option>
                                            <?
                                            $get_kh = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ");
                                            while ($list_kh = mysql_fetch_assoc($get_kh->result)) {
                                            ?>
                                                <option value="<?= $list_kh['id'] ?>">(<?= $list_kh['id'] ?>) <?= $list_kh['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="hd_nguyen_tac">Hợp đồng nguyên tắc</label>
                                        <input type="checkbox" name="hd_nguyen_tac" id="hd_nguyen_tac">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="number" class="form-control h_border cr_weight" id="tong_truoc_vat" name="truoc_vat" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" name="don_gia_vat" id="don_gia_vat">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thuế suất VAT</label>
                                        <input type="number" name="thue_vat" class="form-control thue_vat_tong" readonly placeholder="Nhập thuế suất VAT">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="number" name="sau_vat" id="tong_sau_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời gian thực hiện</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="ngay_bat_dau" class="gia_tri" id="ngay_bat_dau">
                                            <span>đến</span>
                                            <input type="date" name="ngay_ket_thuc" class="gia_tri">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="bao_gom_van_chuyen">Hợp đồng đã bao gồm vận chuyển</label>
                                        <input type="checkbox" name="bao_gom_van_chuyen" id="bao_gom_van_chuyen">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Yêu cầu về tiến độ</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nhập yêu cầu về tiến độ"></textarea>
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
                                        <input type="text" name="ten_nh" id="ten_nh" class="form-control" placeholder="Nhập tên ngân hàng" autocomplete="off">
                                    </div>
                                    <div class="form-group ">
                                        <label>Số tài khoản</label>
                                        <input type="number" name="so_taik" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor" data="<?= $com_id ?>">+ Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table cate_ql_b w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_three">Vật tư thiết bị</th>
                                                    <th class="share_tb_two">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_two">Xuất xứ</th>
                                                    <th class="share_tb_two">Số lượng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_two">Thuế VAT (%)</th>
                                                    <th class="share_tb_two">Tổng tiền sau VAT</th>
                                                </tr>
                                            </thead>
                                            <tbody id="vat_tu_thiet_bi">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button" class="cancel_add share_cursor mb-10 share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add share_cursor mb-10 share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm hợp đồng bán?</p>
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
    <? include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/bank-name.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

<script>
    $(window).on("load", function() {
        tong_vt();
    });

    $(".all_nhacc, .ten_nganhang, .ma_vatt, .ten_vatt").select2({
        width: '100%',
    });

    autocomplete(document.getElementById("ten_nh"), bank);

    $(".add_vat_tu").click(function() {
        var id_com = $(this).attr("data");
        $.ajax({
            url: '../ajax/hd_them_vt.php',
            type: 'POST',
            data: {
                id_com: id_com,
            },
            success: function(data) {
                $("#vat_tu_thiet_bi").append(data);
                RefSelect2();
            }
        });
    });

    function hd_vt_change(id) {
        var id_vt = $(id).val();
        var com_id = $(id).attr("data");
        $.ajax({
            url: '../render/hd_vat_tu.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_com: com_id,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });
    };

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".save_add").click(function() {
        var form_add_ban = $(".form_add_hp_mua");
        form_add_ban.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky_hd: {
                    required: true,
                },
                id_khach_hang: {
                    required: true,
                },
                // ngay_bat_dau: {
                //     greaterThan: "#ngay_ky_hd"
                // },
                // ngay_ket_thuc: {
                //     greaterThan: "#ngay_bat_dau"
                // },
            },
            messages: {
                ngay_ky_hd: {
                    required: "Không được để trống.",
                },
                id_khach_hang: {
                    required: "Không được để trống.",
                },
                // ngay_bat_dau: {
                //     greaterThan: "Không được nhỏ hơn ngày ký hợp đồng."
                // },
                // ngay_ket_thuc: {
                //     greaterThan: "Không được nhỏ hơn ngày bắt đầu."
                // },
            },
        });

        if (form_add_ban.valid() === true) {
            var user_id = $(".form_add_hp_mua").attr("data2");
            var com_id = $(".form_add_hp_mua").attr("data1");
            var role = $(".form_add_hp_mua").attr("data");

            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_khach_hang = $("select[name='id_khach_hang']").val();
            var hd_nguyen_tac = 0;
            if ($("input[name='hd_nguyen_tac']").is(":checked")) {
                hd_nguyen_tac = 1;
            }
            var truoc_vat = $("input[name='truoc_vat']").val();
            var don_gia_vat = 0;
            if ($("input[name='don_gia_vat']").is(":checked")) {
                don_gia_vat = 1;
            }
            var thue_vat = $("input[name='thue_vat']").val();
            var sau_vat = $("input[name='sau_vat']").val();
            var ngay_bat_dau = $("input[name='ngay_bat_dau']").val();
            var ngay_ket_thuc = $("input[name='ngay_ket_thuc']").val();
            var bao_gom_van_chuyen = 0
            if ($("input[name='bao_gom_van_chuyen']").is(":checked")) {
                bao_gom_van_chuyen = 1;
            }
            var yc_tiendo = $("textarea[name='yc_tiendo']").val();
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();

            var vt_vat_tu = new Array();
            $("select[name='ma_vt_ban']").each(function() {
                var ten_vat_tu = $(this).val();
                if (ten_vat_tu != "") {
                    vt_vat_tu.push(ten_vat_tu);
                }
            });
            var vt_so_luong = new Array();
            $("input[name='so_luong']").each(function() {
                var sl_vt = $(this).val();
                if (sl_vt != "") {
                    vt_so_luong.push(sl_vt);
                }
            });
            var vt_don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dg_vt = $(this).val();
                if (dg_vt != "") {
                    vt_don_gia.push(dg_vt);
                }
            });
            var vt_truoc_vat = new Array();
            $("input[name='vt_tien_tvat']").each(function() {
                var tr_vat = $(this).val();
                if (tr_vat != "") {
                    vt_truoc_vat.push(tr_vat);
                }
            });
            var vt_vat_tax = new Array();
            $("input[name='vt_thue_vat']").each(function() {
                var tax = $(this).val();
                if (tax != "") {
                    vt_vat_tax.push(tax);
                }
            });
            var vt_sau_vat = new Array();
            $("input[name='vt_tien_svat']").each(function() {
                var s_vat = $(this).val();
                if (s_vat != "") {
                    vt_sau_vat.push(s_vat);
                }
            });

            $.ajax({
                url: '../ajax/hd_ban_them.php',
                type: 'POST',
                data: {
                    user_id: user_id,
                    com_id: com_id,
                    role: role,
                    ngay_ky_hd: ngay_ky_hd,
                    id_khach_hang: id_khach_hang,
                    hd_nguyen_tac: hd_nguyen_tac,
                    truoc_vat: truoc_vat,
                    don_gia_vat: don_gia_vat,
                    thue_vat: thue_vat,
                    sau_vat: sau_vat,
                    ngay_bat_dau: ngay_bat_dau,
                    ngay_ket_thuc: ngay_ket_thuc,
                    bao_gom_van_chuyen: bao_gom_van_chuyen,
                    yc_tiendo: yc_tiendo,
                    noi_dung_hd: noi_dung_hd,
                    noi_dung_luu_y: noi_dung_luu_y,
                    dieu_khoan_tt: dieu_khoan_tt,
                    ten_nh: ten_nh,
                    so_taik: so_taik,

                    vt_vat_tu: vt_vat_tu,
                    vt_so_luong: vt_so_luong,
                    vt_don_gia: vt_don_gia,
                    vt_truoc_vat: vt_truoc_vat,
                    vt_vat_tax: vt_vat_tax,
                    vt_sau_vat: vt_sau_vat,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Thêm hợp đồng bán vật tư thành công!");
                        window.location.href = 'quan-ly-hop-dong.html';
                    } else {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>