<?
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $user_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $com_name = $_SESSION['com_name'];
    $user_id = $_SESSION['ep_id'];
    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `phieu_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $phieu_tt2 = explode(',', $item_nv['phieu_tt']);
        if (in_array(2, $phieu_tt2) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm phiếu thanh toán</title>
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
    <div class="main-container ql_them_phieu_tt ql_sua_phieu_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-phieu-thanh-toan.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm phiếu thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_name ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại phiếu thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_ptt" class="form-control loai_phieu" data="<?= $com_id ?>">
                                            <option value="">-- Chọn loại phiếu thanh toán --</option>
                                            <option value="1">Phiếu thanh toán hợp đồng</option>
                                            <option value="2">Phiếu thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hd_dh">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group nha_cc_kh">
                                        <label></label>
                                        <input type="text" name="khachh_nhacc" class="form-control h_border">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thanh toán</label>
                                        <input type="date" name="ngay_ttoan" class="form-control" placeholder="Chọn ngày thanh toán">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l ">
                                    <div class="form-group share_form_select">
                                        <label>Hình thức thanh toán <span class="cr_red">*</span></label>
                                        <select name="hinh_thuc" class="form-control all_hthuc">
                                            <option value="">-- Chọn hình thức thanh toán --</option>
                                            <option value="1">Tiền mặt</option>
                                            <option value="2">Bằng thẻ</option>
                                            <option value="3">Chuyển khoản</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select loai_thanht">
                                        <label>Loại thanh toán <span class="cr_red">*</span></label>
                                        <select name="lthanh_toan" class="form-control all_ltt share_select" data="<?= $com_id ?>" data="<?php echo $com_id ?>">
                                            <option value="">-- Chọn loại thanh toán --</option>
                                            <option value="1">Tạm ứng</option>
                                            <option value="2">Theo hợp đồng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l dv_ctra_hthu">
                                    <div class="form-group">
                                        <label>Đơn vị chi trả</label>
                                        <p class="cr_weight"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn vị thụ hưởng</label>
                                        <p class="cr_weight"></p>
                                    </div>
                                </div>
                                <div class="ct_form w_100 float_l">

                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Phí giao dịch</label>
                                        <input type="text" name="phi_giaod" class="form-control" placeholder="Nhập phí giao dịch">
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận tiền</label>
                                        <input type="text" name="nguoi_ntien" class="form-control" placeholder="Nhập người nhận tiền">
                                    </div>
                                </div>
                                <div class="form-them-nganh w_100 float_l"></div>
                                <div class="them_moi_vt w_100 float_l"></div>
                                <div class="form-button w_100">
                                    <div class="form_button phieu_button">
                                        <button type="button" class="cancel_add mb-10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add mb-10 share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm phiếu thanh
                                    toán?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex phieu_dy_pop">
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
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".save_new_dp").click(function() {
        window.location.href = '/quan-ly-phieu-thanh-toan.html';
    });

    $(".all_hd_dh, .all_ltt").select2({
        width: '100%',
    });

    $(".loai_phieu, .all_hthuc").select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $(".loai_phieu").change(function() {
        var loai_phieu = $(this).val();
        var com_id = $(this).attr("data");
        var hs_phieu = 2;
        $.ajax({
            url: '../render/ds_hd_dh.php',
            type: 'POST',
            data: {
                loai_hs: loai_phieu,
                com_id: com_id,
                hs_phieu: hs_phieu,
            },
            success: function(data) {
                $(".all_hd_dh").html(data);
            }
        });

        $.ajax({
            url: '../render/phieu_ncc_kh.php',
            type: 'POST',
            data: {
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".nha_cc_kh").html(data);
            }
        });
    });

    $(".all_hd_dh").change(function() {
        var hd_dh = $(this).val();
        var loai_phieu = $(".loai_phieu").val();
        var com_id = $(".loai_phieu").attr("data");
        var com_name = $(".form_add_hp_mua").attr("data");

        $.ajax({
            url: '../render/phieu_ncc_kh.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".nha_cc_kh").html(data);
            }
        });

        $.ajax({
            url: '../render/dv_ctra_hthu.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                $(".dv_ctra_hthu").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_loai_tt.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".loai_thanht").html(data);
                RefSelect2();
            }
        });

        $.ajax({
            url: '../render/lthanh_toan.php',
            type: 'POST',
            data: {
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                $(".them_moi_vt").html(data);
            }
        });

    });

    function loai_tt_doi(id) {
        var all_ltt = $(id).val();
        var com_id = $(id).attr("data");
        var hd_dh = $(".all_hd_dh").val();
        var loai_phieu = $(".loai_phieu").val();
        $.ajax({
            url: '../render/loai_thanh_toan.php',
            type: 'POST',
            data: {
                all_ltt: all_ltt,
                hd_dh: hd_dh,
                loai_phieu: loai_phieu,
                com_id: com_id,
            },
            success: function(data) {
                if (hd_dh != "" && loai_phieu != "") {
                    if (all_ltt == 1) {
                        $(".ct_form").html(data);
                        $(".them_moi_vt .ctn_table").remove();
                    } else if (all_ltt == 2) {
                        $(".ct_form .ctn_ct_from").remove();
                        $(".them_moi_vt").html(data);
                    } else {
                        $(".ct_form .ctn_ct_from").remove();
                        $(".them_moi_vt .ctn_table").remove();
                    }
                };
                RefSelect2();
            }
        });
    }

    $(document).on('click', '.remove_tnh', function() {
        $(this).parents(".tien_chi_tra").remove();
    });

    $(document).ready(function() {
        if ($(".them_moi_vt .table tbody").height() > 395.5) {
            $(".them_moi_vt .table thead tr").css("width", 'calc(100% - 10px)');
        }
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".all_hthuc").change(function() {
        var hthuc_tt = $(this).val();
        $.ajax({
            url: '../render/hinh_thuc_tt.php',
            type: 'POST',
            data: {
                hthuc_tt: hthuc_tt,
            },
            success: function(data) {
                if (hthuc_tt == 1) {
                    $(".form-them-nganh .ctie_form_nhang").remove()
                    $(".tien_chi_tra").remove();
                } else if (hthuc_tt == 2 || hthuc_tt == 3) {
                    $(".form-them-nganh").html(data);
                }
            }
        });
    });

    $(document).on('click', '.add_ngan_hang', function() {
        $.ajax({
            url: '../render/tai_khoan_html.php',
            type: 'POST',
            success: function(data) {
                $(".form-them-nganh").append(data);
            }
        });
    });

    $(".save_add").click(function() {
        var form_validate = $(".form_add_hp_mua");
        form_validate.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                loai_ptt: {
                    required: true,
                },
                hdong_dhang: {
                    required: true,
                },
                hinh_thuc: {
                    required: true,
                },
            },
            messages: {
                loai_ptt: {
                    required: "Không được để trống",
                },
                hdong_dhang: {
                    required: "Không được để trống",
                },
                hinh_thuc: {
                    required: "Không được để trống",
                },
            }
        });

        if (form_validate.valid() === true) {
            var loai_ptt = $("select[name='loai_ptt']").val();
            var hdong_dhang = $("select[name='hdong_dhang']").val();
            var ngay_ttoan = $("input[name='ngay_ttoan']").val();
            var hinh_thuc = $("select[name='hinh_thuc']").val();
            var lthanh_toan = $(".all_ltt").val();
            var nguoi_ntien = $("input[name='nguoi_ntien']").val();
            var phi_giaod = $("input[name='phi_giaod']").val();
            var com_id = $(".loai_phieu").attr("data");
            var user_id = $(".form_add_hp_mua").attr("data1");
            var ploai = $("input[name='khachh_nhacc']").attr("data1");
            if (ploai == 2 || ploai == 6) {
                lthanh_toan = 2;
            }

            var id_ncc_kh = $("input[name='khachh_nhacc']").attr("data");

            var so_tien = $("input[name='so_tien']").val();
            var ty_gia = $("input[name='ty_gia']").val();
            var gia_quydoi = $("input[name='so_tien_qdoi']").val();
            var tongt_thanhtoan = $(".sum_tatca").text();

            var ten_nganhang = new Array();
            $("input[name='ten_nhanhang']").each(function() {
                var tnh = $(this).val();
                if (tnh != "") {
                    ten_nganhang.push(tnh);
                }
            });

            var chi_nhanh = new Array();
            $("input[name='chi_nhanh']").each(function() {
                var cnhanh = $(this).val();
                if (cnhanh != "") {
                    chi_nhanh.push(cnhanh);
                }
            });

            var so_tk = new Array();
            $("input[name='so_tk']").each(function() {
                var stk = $(this).val();
                if (stk != "") {
                    so_tk.push(stk);
                }
            })

            var chu_taik = new Array();
            $("input[name='chu_taik']").each(function() {
                var chutk = $(this).val();
                if (chutk == "") {
                    chutk = "0";
                } else {
                    chu_taik.push(chutk);
                }
            });

            var id_hs = [];
            $(".ho_so").each(function() {
                var hoso = $(this).attr("data");
                if (hoso != "") {
                    id_hs.push(hoso);
                }
            });

            var tien_ttoan = [];
            $("input[name='so_tien_ctra']").each(function() {
                var tienttoan = $(this).attr("data");
                if (tienttoan != "") {
                    tien_ttoan.push(tienttoan);
                } else if (tienttoan == "") {
                    tienttoan = 0;
                    tien_ttoan.push(tienttoan);
                }
            });

            var tong_tien = [];
            $(".tongtien").each(function() {
                var tongtien = $(this).attr("data");
                if (tongtien != "") {
                    tong_tien.push(tongtien);
                }
            });

            $.ajax({
                url: '../ajax/them_phieu_tt.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
                    loai_ptt: loai_ptt,
                    hdong_dhang: hdong_dhang,
                    ngay_ttoan: ngay_ttoan,
                    hinh_thuc: hinh_thuc,
                    lthanh_toan: lthanh_toan,
                    phi_giaod: phi_giaod,
                    nguoi_ntien: nguoi_ntien,
                    so_tien: so_tien,
                    ty_gia: ty_gia,
                    gia_quydoi: gia_quydoi,
                    ten_nganhang: ten_nganhang,
                    chi_nhanh: chi_nhanh,
                    so_tk: so_tk,
                    chu_taik: chu_taik,
                    ploai: ploai,
                    id_ncc_kh: id_ncc_kh,
                    id_hs: id_hs,
                    tien_ttoan: tien_ttoan,
                    tong_tien: tong_tien,
                    tongt_thanhtoan: tongt_thanhtoan,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã thêm phiếu thanh toán thành công");
                        window.location.href = '/quan-ly-phieu-thanh-toan.html';
                    } else if (data != "") {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>