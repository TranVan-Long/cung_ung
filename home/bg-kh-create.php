<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia_kh` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bao_gia_kh = explode(',', $item_nv['bao_gia']);
            if (in_array(2, $bao_gia_kh) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$list_kh = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai`, `id_cong_ty` FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ");



?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm báo giá cho khách hàng</title>
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
                    <a class="text-black" href="quan-ly-bao-gia-cho-khach-hang.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt-20">Thêm báo giá cho khách hàng</p>
                </div>
                <form action="" class="main-form">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left v-select2">
                                    <label>Khách hàng <span class="text-red">&ast;</span></label>
                                    <select id="khach-hang" name="khach_hang" class="share_select" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                        <option value="">-- Chọn khách hàng --</option>
                                        <? while ($row2 = mysql_fetch_assoc($list_kh->result)) { ?>
                                            <option value="<?= $row2['id'] ?>"><?= $row2['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Thời gian áp dụng <span class="text-red">&ast;</span></label>
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
                            <div class="form-row left">
                                <div class="w-100 left mb_15">
                                    <label>Nội dung phản hồi</label>
                                    <textarea name="noi_dung_phan_hoi" cols="30" rows="10" placeholder="Nhập nội dung phản hồi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <p class="text-blue link-text text-500" id="them_vt_bg_kh" data="<?= $com_id ?>">&plus; Thêm mới vật tư</p>
                            <div class="table-wrapper mt-10">
                                <div class="table-container table-1532">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5"></th>
                                                    <th class="w-20">Tên vật tư thiết bị</th>
                                                    <th class="w-20">Hãng sản xuất</th>
                                                    <th class="w-15">Số lượng báo giá</th>
                                                    <th class="w-15">Đơn vị tính</th>
                                                    <th class="w-20">Đơn giá</th>
                                                    <th class="w-20">Thành tiền</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="rererences_kh">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 left">
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal text-center" id="cancel">
            <div class="m-content">
                <div class="m-head ">
                    Thông báo <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>Bạn có chắc chắn muốn hủy việc tạo phản hồi báo giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="quan-ly-bao-gia-cho-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                            ý</a>
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
<script>
    $("#them_vt_bg_kh").click(function() {
        var com_id = $(this).attr("data");
        $.ajax({
            url: '../render/them_html_vtbg_kh.php',
            type: 'POST',
            data: {
                id_com: com_id,
            },
            success: function(data) {
                $("#rererences_kh").append(data);
                RefSelect2();
            }
        });
    });

    function change_vt(id) {
        var id_vt = $(id).val();
        var com_id = $(id).attr("data");
        $.ajax({
            url: '../render/sua_html_vtbg_kh.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_com: com_id,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        })
    };

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        $.validator.addMethod("dateRange",
            function() {
                var date1 = $("#startDate").val();
                var date2 = $("#endDate").val();
                return (date1 < date2);
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
                khach_hang: {
                    required: true,
                },
                tu_ngay: {
                    required: true,
                },
                den_ngay: {
                    required: true,
                    dateRange: true,
                }
            },
            messages: {
                so_bao_gia: {
                    required: "Số báo giá không được để trống.",
                },
                khach_hang: {
                    required: "Vui lòng chọn khách hàng.",
                },
                tu_ngay: {
                    required: "Vui lòng chọn ngày bắt đầu.",
                },
                den_ngay: {
                    required: "Vui lòng chọn ngày kết thúc.",
                    dateRange: "Không được nhỏ hơn ngày bắt đầu."
                }
            }
        });
        if (form.valid() === true) {
            var com_id = $("#khach-hang").attr("data");
            var user_id = $("#khach-hang").attr("data1");
            var id_kh = $("select[name='khach_hang']").val();
            var ngay_bd = $("input[name='tu_ngay']").val();
            var ngay_kt = $("input[name='den_ngay']").val();
            var noi_dung_ph = $("textarea[name='noi_dung_phan_hoi']").val();

            var id_vt = new Array();
            $("select[name='ten_day_du']").each(function() {
                var vt = $(this).val();
                if (vt != "") {
                    id_vt.push(vt);
                }
            });

            var so_luong = new Array();
            $("input[name='so_luong_bao_gia']").each(function() {
                var vt1 = $(this).parents(".item").find(".ten_vat_tu").val();
                var sl = $(this).val();
                if (vt1 != "" && sl != "") {
                    so_luong.push(sl);
                }
            });

            var don_gia = [];
            $("input[name='don_gia']").each(function() {
                var dgia = $(this).val();
                if (dgia != "") {
                    don_gia.push(dgia);
                }
            });

            $.ajax({
                url: '../ajax/them_bg_kh.php',
                type: 'POST',
                data: {
                    id_kh: id_kh,
                    ngay_bd: ngay_bd,
                    ngay_kt: ngay_kt,
                    noi_dung_ph: noi_dung_ph,
                    id_vt: id_vt,
                    so_luong: so_luong,
                    don_gia: don_gia,
                    com_id: com_id,
                    user_id: user_id,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã thêm phiếu báo giá thành công");
                        window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html';
                    } else if (data != "") {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>