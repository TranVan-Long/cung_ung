<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $user_name = $_SESSION['com_name'];
        $com_id = $_SESSION['com_id'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $user_name = $_SESSION['ep_name'];
        $com_id = $_SESSION['user_com_id'];
        $phan_quyen_nk = 2;
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bao_gia3 = explode(',', $item_nv['bao_gia']);
            if (in_array(2, $bao_gia3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}

$date_now = date("Y-m-d", time());

$list_nhacc = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `phan_loai`, `id_cong_ty` FROM `nha_cc_kh`
                            WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` DESC ");


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm báo giá</title>
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
    <div class="main-container">
        <?php include("../includes/sidebar.php") ?>
        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="left mt-25">
                    <a class="text-black" href="quan-ly-bao-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="share_fsize_four cr_weight_bold mb_10 w_100 float_l mt_20">Thêm báo giá</p>
                </div>
                <div class="w-100 left mt-10">
                    <form class="main-form" data="<?= $date_now ?>" data1="<?= $phan_quyen_nk ?>">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Ngày gửi<span class="text-red">&ast;</span></label>
                                    <input type="date" name="ngay_gui" id="ngay_gui">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <div class="v-select2">
                                        <label for="">Người lập</label>
                                        <input type="text" name="nguoi_lap" value="<?= $user_name ?>" data-id="<?= $user_id ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-col-50 no-border mb_15 right v-select2">
                                    <label for="">Nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <select id="nha-cung-cap" name="nha_cung_cap" class="share_select" data="<?= $com_id ?>">
                                        <option value="">-- Chọn nhà cung cấp --</option>
                                        <? while ($item = mysql_fetch_assoc($list_nhacc->result)) { ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left v-select2">
                                    <label for="">Theo yêu cầu báo giá số<span class="text-red">&ast;</span></label>
                                    <select id="so-yeu-cau" name="so_yeu_cau" class="share_select" data="<?= $com_id ?>">
                                        <option value="">-- Chọn yêu cầu báo giá --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Thời gian áp dụng</label>
                                    <div class="range-date-picker">
                                        <div class="date-input-sm">
                                            <input type="date" name="tu_ngay" id="startDate">
                                        </div>
                                        <div class="range-date-text">
                                            <p id="hahaha">đến</p>
                                        </div>
                                        <div class="date-input-sm">
                                            <input type="date" name="den_ngay" id="endDate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <div class="table-wrapper mt-15">
                                <div class="table-container table-2848">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-20">Mã vật tư</th>
                                                    <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                                    <th class="w-15">Đơn vị tính</th>
                                                    <th class="w-40">Hãng sản xuất</th>
                                                    <th class="w-30">Số lượng yêu cầu báo giá</th>
                                                    <th class="w-25">Số lượng báo giá</th>
                                                    <th class="w-25">Đơn giá</th>
                                                    <th class="w-30">Tổng tiền trước VAT</th>
                                                    <th class="w-25">Thuế VAT</th>
                                                    <th class="w-30">Tổng sau VAT</th>
                                                    <th class="w-35">Chính sách khác kèm theo</th>
                                                    <th class="w-35">Số lượng đã đặt hàng</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="danh_sach_vt" data="<?= $date_now ?>">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn" data="<?= $com_id ?>">Xong</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal text-center" id="cancel">
            <div class="m-content">
                <div class="m-head ">
                    Thông báo <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>Bạn có chắc chắn muốn hủy việc thêm báo giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right">
                        <a href="quan-ly-bao-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../modals/modal_logout.php" ?>
        <? include("../modals/modal_menu.php") ?>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript">
    $("#nha-cung-cap").change(function() {
        var com_id = $(this).attr("data");
        var id_ncc = $(this).val();
        $.ajax({
            url: '../render/ds_phieu_bgvt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_ncc: id_ncc,
            },
            success: function(data) {
                $("#so-yeu-cau").html(data);
            }
        });

        $.ajax({
            url: '../render/vat_tu_bg.php',
            type: 'POST',
            data: {
                id_ncc: id_ncc,
                id_com: com_id
            },
            success: function(data) {
                $("#danh_sach_vt").html(data);
            }
        });
    });

    $("#so-yeu-cau").change(function() {
        var id_p = $(this).val();
        var com_id = $(this).attr("data");
        var id_ncc = $("#nha-cung-cap").val();
        $.ajax({
            url: '../render/vat_tu_bg.php',
            type: 'POST',
            data: {
                id_p: id_p,
                id_ncc: id_ncc,
                id_com: com_id
            },
            success: function(data) {
                $("#danh_sach_vt").html(data);
            }
        });
    });

    $(".submit-btn").click(function() {
        event.preventDefault();
        event.stopPropagation();
        var errorElements = document.querySelectorAll(".error");
        for (let index = 0; index < errorElements.length; index++) {
            const element = errorElements[index];
            $('html, body').animate({
                scrollTop: $(errorElements[0]).focus().offset().top - 30
            }, 1000);
            return false;
        }
    });

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        $.validator.addMethod("dateRange",
            function() {
                var date1 = $(".main-form").attr("data");
                var date2 = $("#ngay_gui").val();
                return (date1 >= date2);

            })
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.appendTo(element.parent('.date-input-sm'));
                error.wrap('<span class="error">');
            },
            rules: {
                so_bao_gia: {
                    required: true,
                },
                ngay_gui: {
                    required: true,
                    dateRange: true,
                },
                nha_cung_cap: {
                    required: true,
                },
                so_yeu_cau: {
                    required: true,
                },
            },
            messages: {
                so_bao_gia: {
                    required: "Số báo giá không được để trống.",
                },
                ngay_gui: {
                    required: "Vui lòng chọn ngày gửi.",
                    dateRange: "Ngày gửi bé hơn hoặc bằng ngày hiện tại",
                },
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                },
                so_yeu_cau: {
                    required: "Vui lòng chọn số yêu cầu."
                },
            }
        });
        if (form.valid() === true) {
            var com_id = $(this).attr("data");
            var user_id = $("input[name='nguoi_lap']").attr("data-id");
            var ngay_gui = $("input[name='ngay_gui']").val();
            var nha_cc = $("select[name='nha_cung_cap']").val();
            var phieu_yc = $("select[name='so_yeu_cau']").val();
            var tg_apdung = $("input[name='tu_ngay']").val();
            var tg_ketthuc = $("input[name='den_ngay']").val();
            var tg_hientai = $("#danh_sach_vt").attr("data");
            var phan_quyen_nk = $(".main-form").attr("data1");

            var id_vt = [];
            $("input[name='ma_vat_tu']").each(function() {
                var ma_vt = $(this).attr("data");
                if (ma_vt != "") {
                    id_vt.push(ma_vt);
                }
            });

            var sl_bg = [];
            $("input[name='so_luong_bao_gia']").each(function() {
                var so_luong = $(this).val();
                if (so_luong != "") {
                    sl_bg.push(so_luong);
                }
            });

            var don_gia = [];
            $("input[name='don_gia']").each(function() {
                var don_g = $(this).val();
                if (don_g != "") {
                    don_gia.push(don_g);
                }
            });

            var tongtr_vat = [];
            $("input[name='tong_truoc_vat']").each(function() {
                var tong_tr = $(this).val();
                if (tong_tr != "") {
                    tongtr_vat.push(tong_tr);
                } else if (tong_tr == "") {
                    tong_tr = 0;
                    tongtr_vat.push(tong_tr);
                }
            });

            var thue = [];
            $("input[name='thue_vat']").each(function() {
                var thue_vat = $(this).val();
                if (thue_vat != "") {
                    thue.push(thue_vat);
                } else if (thue_vat == "") {
                    thue_vat = 0;
                    thue.push(thue_vat);
                }
            });

            var tongs_vat = [];
            $("input[name='tong_sau_vat']").each(function() {
                var tong_svat = $(this).val();
                if (tong_svat != "") {
                    tongs_vat.push(tong_svat);
                } else if (tong_svat == "") {
                    tong_svat = 0;
                    tongs_vat.push(tong_svat);
                }
            });

            var chinh_sach_khac = [];
            $("input[name='chinh_sach_khac']").each(function() {
                var cs_khac = $(this).val();
                if (cs_khac != "") {
                    chinh_sach_khac.push(cs_khac);
                } else {
                    cs_khac = 0;
                    chinh_sach_khac.push(cs_khac);
                }
            });

            var so_luong_da_dat = [];
            $("input[name='so_luong_da_dat']").each(function() {
                var sl_dh = $(this).val();
                if (sl_dh != "") {
                    so_luong_da_dat.push(sl_dh);
                } else {
                    sl_dh = 0;
                    so_luong_da_dat.push(sl_dh);
                }
            });

            if (tg_apdung != "" && tg_ketthuc != "") {
                if (tg_apdung >= ngay_gui && ngay_gui <= tg_ketthuc) {
                    $.ajax({
                        url: '../ajax/them_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            ngay_gui: ngay_gui,
                            nha_cc: nha_cc,
                            phieu_yc: phieu_yc,
                            tg_apdung: tg_apdung,
                            tg_ketthuc: tg_ketthuc,
                            id_vt: id_vt,
                            sl_bg: sl_bg,
                            don_gia: don_gia,
                            tongtr_vat: tongtr_vat,
                            thue: thue,
                            tongs_vat: tongs_vat,
                            chinh_sach_khac: chinh_sach_khac,
                            so_luong_da_dat: so_luong_da_dat,
                            phan_quyen_nk: phan_quyen_nk,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Bạn đã thêm thành công báo giá vật tư");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                } else if (tg_apdung > tg_ketthuc) {
                    alert("Thời gian áp dụng nhỏ hơn thời gian kết thúc");
                } else if (tg_apdung < ngay_gui) {
                    alert("Thời gian áp dụng lớn hơn ngày gửi");
                }
            } else if (tg_apdung == "" && tg_ketthuc != "") {
                if (ngay_gui <= tg_ketthuc) {
                    $.ajax({
                        url: '../ajax/them_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            ngay_gui: ngay_gui,
                            nha_cc: nha_cc,
                            phieu_yc: phieu_yc,
                            tg_apdung: tg_apdung,
                            tg_ketthuc: tg_ketthuc,
                            id_vt: id_vt,
                            sl_bg: sl_bg,
                            don_gia: don_gia,
                            tongtr_vat: tongtr_vat,
                            thue: thue,
                            tongs_vat: tongs_vat,
                            chinh_sach_khac: chinh_sach_khac,
                            so_luong_da_dat: so_luong_da_dat,
                            phan_quyen_nk: phan_quyen_nk,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Bạn đã thêm thành công báo giá vật tư");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                } else {
                    alert("Thời gian kết thúc phải lớn hơn hoặc bằng ngày gửi ");
                }
            } else if (tg_apdung != "" && tg_ketthuc == "") {
                if (ngay_gui <= tg_apdung) {
                    $.ajax({
                        url: '../ajax/them_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            ngay_gui: ngay_gui,
                            nha_cc: nha_cc,
                            phieu_yc: phieu_yc,
                            tg_apdung: tg_apdung,
                            tg_ketthuc: tg_ketthuc,
                            id_vt: id_vt,
                            sl_bg: sl_bg,
                            don_gia: don_gia,
                            tongtr_vat: tongtr_vat,
                            thue: thue,
                            tongs_vat: tongs_vat,
                            chinh_sach_khac: chinh_sach_khac,
                            so_luong_da_dat: so_luong_da_dat,
                            phan_quyen_nk: phan_quyen_nk,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Bạn đã thêm thành công báo giá vật tư");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                } else {
                    alert("Thời gian áp dụng phải lớn hơn hoặc bằng ngày gửi");
                }

            } else if (tg_apdung == "" && tg_ketthuc == "") {
                $.ajax({
                    url: '../ajax/them_bao_gia.php',
                    type: 'POST',
                    data: {
                        com_id: com_id,
                        user_id: user_id,
                        ngay_gui: ngay_gui,
                        nha_cc: nha_cc,
                        phieu_yc: phieu_yc,
                        tg_apdung: tg_apdung,
                        tg_ketthuc: tg_ketthuc,
                        id_vt: id_vt,
                        sl_bg: sl_bg,
                        don_gia: don_gia,
                        tongtr_vat: tongtr_vat,
                        thue: thue,
                        tongs_vat: tongs_vat,
                        chinh_sach_khac: chinh_sach_khac,
                        so_luong_da_dat: so_luong_da_dat,
                        phan_quyen_nk: phan_quyen_nk,
                    },
                    success: function(data) {
                        if (data == "") {
                            alert("Bạn đã thêm thành công báo giá vật tư");
                            window.location.href = '/quan-ly-bao-gia.html';
                        } else {
                            alert(data);
                        }
                    }
                })
            }
        }
    });
</script>

</html>