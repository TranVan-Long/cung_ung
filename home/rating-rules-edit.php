<?php
include("config.php");
include("../includes/icon.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $user_id = $_SESSION['com_id'];
    $phan_quyen_nk = 1;
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $com_name = $_SESSION['com_name'];
    $user_id = $_SESSION['ep_id'];
    $phan_quyen_nk = 2;
    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `tieu_chi_danh_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $tieu_chi_dg3 = explode(',', $item_nv['tieu_chi_danh_gia']);
        if (in_array(3, $tieu_chi_dg3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
}

if (isset($_GET['id']) && $_GET['id'] != "") {
    $tieu_chi_id = $_GET['id'];
    $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` WHERE `id` = '" . $tieu_chi_id . "' ");
    $list_gt = new db_query("SELECT * FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = '" . $tieu_chi_id . "' ");
    $tc_detail = mysql_fetch_assoc($list_tc->result);
    $gt = mysql_fetch_assoc($list_gt->result);
}



?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa tiêu chí đánh giá</title>
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
                    <a class="text-black" href="tieu-chi-danh-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt_20 mb_10">Chỉnh sửa tiêu chí đánh giá</p>
                </div>
                <form class="main-form" data="<?= $phan_quyen_nk ?>" data1="<?= $tieu_chi_id ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Tiêu chí đánh giá<span class="text-red">&ast;</span></label>
                                    <input type="text" name="tieu_chi_danh_gia" placeholder="Nhập tiêu chí đánh giá" value="<?= $tc_detail['tieu_chi'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Hệ số</label>
                                    <input type="text" name="he_so" placeholder="Nhập hệ số" value="<?= $tc_detail['he_so'] ?>" readonly>
                                </div>
                            </div>

                            <? if ($tc_detail['kieu_gia_tri'] == 1) { ?>
                                <div class="form-row left chon_gt">
                                    <div class="form-col-50 no-border left mb_15 v-select2">
                                        <label>Chọn kiểu giá trị</label>
                                        <input name="kieu_gia_tri" class="form-control" value="Nhập tay" data="1" readonly>
                                    </div>
                                    <div class="form-col-50 no-border right mb_15 gia_tri1">
                                        <input type="hiden" class="d-none" name="id_gia_tri_old" value="<?= $gt['id'] ?>">
                                        <label>Thang điểm <span class="text-red">&ast;</span></label>
                                        <input type="text" name="gia_tri_old" placeholder="Nhập giá trị lớn nhất" value="<?= $gt['gia_tri'] ?>" readonly>
                                    </div>
                                </div>
                            <? } elseif ($tc_detail['kieu_gia_tri'] == 2) { ?>
                                <div class="form-row left chon_gt">
                                    <div class="form-col-50 no-border left mb_15 v-select2">
                                        <label>Chọn kiểu giá trị</label>
                                        <input name="kieu_gia_tri" class="form-control" value="Danh sách" data="2" readonly>
                                    </div>
                                </div>

                            <? } ?>
                        </div>
                        <div class="form-control edit-form mt-15 left w-100" id="list-type">
                            <? if ($tc_detail['kieu_gia_tri'] == 1) { ?>
                                <div class="value-control border-bottom pb-10 d-none">
                                    <p class="d-inline-block text-bold mr-20 mt-15">Danh sách giá trị</p>
                                    <p class="d-inline-block text-blue link-text text-500 mt-15" id="add-rules-value">&plus;
                                        Thêm mới giá trị</p>
                                </div>
                                <div id="rules-value">
                                </div>
                            <? } else if ($tc_detail['kieu_gia_tri'] == 2) { ?>
                                <div class="value-control border-bottom pb-10">
                                    <p class="d-inline-block text-bold mr-20 mt-15">Danh sách giá trị</p>
                                    <p class="d-inline-block text-blue link-text text-500 mt-15" id="add-rules-value">&plus;
                                        Thêm mới giá trị</p>
                                </div>
                                <div id="rules-value">
                                    <?
                                    $list_gt_ds = new db_query("SELECT * FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tieu_chi_id ");
                                    while ($gia_tri = mysql_fetch_assoc($list_gt_ds->result)) {
                                    ?>
                                        <div class="value border-bottom left w-100 pb-20 mt-10 d-flex spc-btw">
                                            <div class="value-form">
                                                <div class="form-row left">
                                                    <div class="form-col-50 left mb_15">
                                                        <input type="hiden" class="d-none" name="id_gia_tri_old" value="<?= $gia_tri['id'] ?>">
                                                        <label>Giá trị<span class="text-red">*</span></label>
                                                        <input type="number" name="gia_tri_old" placeholder="Nhập giá trị" value="<?= $gia_tri['gia_tri'] ?>" readonly>
                                                    </div>
                                                    <div class="form-col-50 right mb_15">
                                                        <label>Tên hiển thị</label>
                                                        <input type="text" name="ten_hien_thi_old" placeholder="Nhập tên hiển thị" value="<?= $gia_tri['ten_gia_tri'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="modal-btn" data-target="item-<?= $gia_tri['id'] ?>">
                                                <i class="ic-delete2"></i>
                                            </p>
                                        </div>
                                        <div class="modal text-center" id="item-<?= $gia_tri['id'] ?>">
                                            <div class="m-content">
                                                <div class="m-head ">
                                                    Thông báo <span class="dismiss cancel">&times;</span>
                                                </div>
                                                <div class="m-body">
                                                    <p>Bạn có chắc chắn muốn xóa giá trị này?</p>
                                                    <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                </div>
                                                <div class="m-foot d-inline-block">
                                                    <div class="left mb_10">
                                                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                    </div>
                                                    <div class="right mb_10">
                                                        <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove-item" data-id="<?= $gia_tri['id'] ?>">Đồng ý</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            <? } ?>
                        </div>

                        <div class="w-100 left mt-30">
                            <div class="control-btn right">
                                <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                                <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
                            </div>
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
                    <p>Bạn có chắc chắn muốn hủy việc sửa tiêu chí đánh giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="tieu-chi-danh-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                            ý</a>
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
<script>
    $('.submit-btn').click(function() {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                tieu_chi_danh_gia: {
                    required: true,
                },
                gia_tri: {
                    required: true,
                },
                kieu_gia_tri: {
                    required: true
                }
            },
            messages: {
                tieu_chi_danh_gia: {
                    required: "Tiêu chí đánh giá không được để trống.",
                },
                gia_tri: {
                    required: "Giá trị không được để trống.",
                },
                kieu_gia_tri: {
                    required: "Chọn một kiểu giá trị."
                }
            }
        });
        if (form.valid() === true) {
            var tc_id = $(".main-form").attr("data1");
            var tieu_chi_danh_gia = $("input[name='tieu_chi_danh_gia']").val();

            var id_gia_tri_old = [];
            $("input[name='id_gia_tri_old']").each(function() {
                var id_gt_old = $(this).val();
                if (id_gt_old != "") {
                    id_gia_tri_old.push(id_gt_old);
                }
            });

            var ten_hien_thi_old = [];
            $("input[name='ten_hien_thi_old']").each(function() {
                var tht_old = $(this).val();
                if (tht_old != "") {
                    ten_hien_thi_old.push(tht_old);
                }
            });

            var gia_tri = [];
            $("input[name='gia_tri']").each(function() {
                var gt = $(this).val();
                if (gt != "") {
                    gia_tri.push(gt);
                }
            });

            var ten_hien_thi = [];
            $("input[name='ten_hien_thi']").each(function() {
                var tht = $(this).val();
                if (tht != "") {
                    ten_hien_thi.push(tht);
                }
            });

            //get user id
            var phan_quyen_nk = $(".main-form").attr("data");
            var com_id = $(".main-form").attr("data1");
            var user_id = $(".main-form").attr("data2");
            var kieu_gia_tri = $("input[name='kieu_gia_tri']").attr("data");

            $.ajax({
                url: '../ajax/tc_sua.php',
                type: 'POST',
                data: {
                    tc_id: tc_id,
                    tieu_chi_danh_gia: tieu_chi_danh_gia,

                    id_gia_tri_old: id_gia_tri_old,
                    ten_hien_thi_old: ten_hien_thi_old,

                    gia_tri: gia_tri,
                    ten_hien_thi: ten_hien_thi,

                    user_id: user_id,
                    phan_quyen_nk: phan_quyen_nk,
                    com_id: com_id,
                    kieu_gia_tri: kieu_gia_tri,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Sửa tiêu chí thành công!");
                        window.location.href = 'tieu-chi-danh-gia.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
    $(".remove-item").click(function() {
        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/gt_xoa.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert(data);
                }
            }
        });
    });
</script>

</html>