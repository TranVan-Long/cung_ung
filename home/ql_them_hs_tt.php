<?php
include "../includes/icon.php";
include("config.php");



if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['com_id'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['ep_id'];
        $phan_quyen_nk = 2;
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `ho_so_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hs_tt3 = explode(',', $item_nv['ho_so_tt']);
            if (in_array(2, $hs_tt3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
} else {
    header('Location: /');
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];
// echo "<pre>";
// print_r($vat_tu_data);
// echo "</pre>";


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tạo hồ sơ thanh toán</title>
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
    <div class="main-container ql_them_hs_tt ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-ho-so-thanh-toan.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Tạo hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $phan_quyen_nk ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $com_name ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Loại hồ sơ thanh toán <span class="cr_red">*</span></label>
                                        <select name="loai_hs" class="form-control loai_hs">
                                            <option value="">-- Chọn loại hồ sơ thanh toán --</option>
                                            <option value="1">Hồ sơ thanh toán hợp đồng</option>
                                            <option value="2">Hồ sơ thanh toán đơn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng / Đơn hàng <span class="cr_red">*</span></label>
                                        <select name="hdong_dhang" class="form-control all_hd_dh">
                                            <option value="">-- Chọn hợp đồng / Đơn hàng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group dv_thuc_hien">
                                        <label>Đơn vị thực hiện</label>
                                        <input type="text" name="dia_chi" value="" class="form-control" placeholder="Nhập địa chỉ" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đợt nghiệm thu <span class="cr_red">*</span></label>
                                        <input type="text" name="dot_nthu" class="form-control" placeholder="Nhập đợt nghiệm thu">
                                    </div>
                                    <div class="form-group">
                                        <label>Thời gian nghiệm thu</label>
                                        <input type="date" name="thoig_nthu" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời hạn thanh toán</label>
                                        <input type="date" name="thoih_ttoan" class="form-control">
                                    </div>
                                </div>
                                <div class="table-wrapper mt-10 them_moi_vt">
                                    <div class="table-container table-3900 ds_vat_tu" data="<?= $user_id ?>">

                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hs_button">
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc tạo hồ sơ?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hs_dy_pop">
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
    $(document).ready(function() {
        var loai_hs = $(".loai_hs").val();
        var dh_hd = $(".all_hd_dh").val();
        if (loai_hs != "" && dh_hd != "") {
            $(".table-wrapper").css("border", "1px solid #474747");
        } else {
            $(".table-wrapper").css("border", "none");
        }
    });

    $(".loai_hs, .all_hd_dh").select2({
        width: '100%',
    });

    $(".loai_hs").change(function() {
        var loai_hs = $(this).val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var hs_phieu = 1;
        $.ajax({
            url: '../render/ds_hd_dh.php',
            type: 'POST',
            data: {
                loai_hs: loai_hs,
                com_id: com_id,
                hs_phieu: hs_phieu,
            },
            success: function(data) {
                $(".all_hd_dh").html(data);
            }
        });

        $.ajax({
            url: '../render/dv_thuc_hien.php',
            type: 'POST',
            data: {
                loai_hs: loai_hs,
                com_id: com_id,
            },
            success: function(data) {
                $(".dv_thuc_hien").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_vattu_hstt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                loai_hs: loai_hs,
            },
            success: function(data) {
                $(".ds_vat_tu").html(data);
            }
        });

        if (loai_hs == "") {
            $(".table-wrapper").css("border", "none");
        }
    });

    $(".all_hd_dh").change(function() {
        var dh_hd = $(this).val();
        var loai_hs = $(".loai_hs").val();
        var com_id = $(".form_add_hp_mua").attr("data");
        var com_name = $(".form_add_hp_mua").attr("data1");

        $.ajax({
            url: '../render/dv_thuc_hien.php',
            type: 'POST',
            data: {
                dh_hd: dh_hd,
                loai_hs: loai_hs,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                $(".dv_thuc_hien").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_vattu_hstt.php',
            type: 'POST',
            data: {
                dh_hd: dh_hd,
                com_id: com_id,
                loai_hs: loai_hs,
            },
            success: function(data) {
                $(".ds_vat_tu").html(data);
            }
        });

        if (loai_hs != "" && dh_hd != "") {
            $(".table-wrapper").css("border", "1px solid #474747");
        } else {
            $(".table-wrapper").css("border", "none");
        }
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".save_add").click(function() {
        var form_validate = $(".form_add_hp_mua");
        form_validate.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                loai_hs: {
                    required: true,
                },
                hdong_dhang: {
                    required: true,
                },
                dot_nthu: {
                    required: true,
                }
            },
            messages: {
                loai_hs: {
                    required: "Không được để trống",
                },
                hdong_dhang: {
                    required: "Không được để trống",
                },
                dot_nthu: {
                    required: "Không được để trống",
                }
            }
        });
        if (form_validate.valid() === true) {
            var loai_hs = $("select[name='loai_hs']").val();
            var hd_dh = $("select[name='hdong_dhang']").val();
            var dot_nthu = $("input[name='dot_nthu']").val();
            var thoig_nthu = $("input[name='thoig_nthu']").val();
            var thoi_han_tt = $("input[name='thoih_ttoan']").val();
            var com_id = $(".form_add_hp_mua").attr("data");
            var user_id = $(".ds_vat_tu").attr("data");
            var phan_quyen_nk = $(".ctiet_dk_hp").attr("data");

            var id_vt = [];
            $(".vat_tu_dh").each(function() {
                var idvt = $(this).attr("data");
                if (idvt != "") {
                    id_vt.push(idvt);
                }
            });

            var sl_kynay = [];
            $("input[name='kl_luy_ke_ky_nay']").each(function() {
                var klkn = $(this).val();
                if (klkn != "") {
                    sl_kynay.push(klkn);
                } else {
                    klkn = 0;
                    sl_kynay.push(klkn);
                }
            });

            var giatri_kn = [];
            $("input[name='gt_luy_ke_ky_nay']").each(function() {
                var gtkn = $(this).val();
                if (gtkn != "") {
                    giatri_kn.push(gtkn);
                } else {
                    gtkn = 0;
                    giatri_kn.push(gtkn);
                }
            });

            var tong_tien_ky_nay = $(".tong_tien_ky_nay").text();
            var tien_thue = $(".thue_ky_nay").text();
            var chi_phi_khac = $("input[name='chi_phi_khac']").val();
            var tien_svat = $(".tong_tatca").text();

            $.ajax({
                url: '../ajax/them_hs_tt.php',
                type: 'POST',
                data: {
                    loai_hs: loai_hs,
                    hd_dh: hd_dh,
                    dot_nthu: dot_nthu,
                    thoi_han_tt: thoi_han_tt,
                    thoig_nthu: thoig_nthu,
                    com_id: com_id,
                    user_id: user_id,
                    id_vt: id_vt,
                    sl_kynay: sl_kynay,
                    giatri_kn: giatri_kn,
                    tong_tien_ky_nay: tong_tien_ky_nay,
                    chi_phi_khac: chi_phi_khac,
                    tien_thue: tien_thue,
                    tien_svat: tien_svat,
                    phan_quyen_nk: phan_quyen_nk,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã tạo hồ sơ thanh toán thành công");
                        window.location.href = "/quan-ly-ho-so-thanh-toan.html";
                    } else if (data != "") {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>