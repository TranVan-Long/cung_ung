<?php
include("config.php");
include("../includes/icon.php");

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
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `tieu_chi_danh_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $tieu_chi_dg3 = explode(',', $item_nv['tieu_chi_danh_gia']);
        if (in_array(2, $tieu_chi_dg3) == FALSE) {
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
    <title>Thêm tiêu chí đánh giá</title>
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
                    <p class="page-title mt-20">Thêm tiêu chí đánh giá</p>
                </div>
                <form action="" class="main-form">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Tiêu chí đánh giá<span class="text-red">&ast;</span></label>
                                    <input type="text" name="tieu_chi_danh_gia" placeholder="Nhập tiêu chí đánh giá">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Hệ số</label>
                                    <input type="number" name="he_so" placeholder="Nhập hệ số">
                                </div>
                            </div>
                            <div class="form-row left chon_gt">
                                <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="kieu_gia_tri">Chọn kiểu giá trị</label>
                                    <select id="value-type" name="kieu_gia_tri" class="share_select">
                                        <!-- <option value="">-- Chọn kiểu giá trị --</option> -->
                                        <option value="1" selected>Nhập tay</option>
                                        <option value="2">Danh sách</option>
                                    </select>
                                </div>
                                <div class="form-col-50 no-border right mb_15 gia_tri1">
                                    <label>Thang điểm <span class="text-red">&ast;</span></label>
                                    <input type="number" name="gia_tri" placeholder="Nhập điểm tối đa">
                                </div>
                            </div>
                        </div>
                        <div class="form-control edit-form mt-15 left w-100 manual-value">
                            <div class="value-control border-bottom pb-10 d-none">
                                <p class="d-inline-block text-bold mr-20 mt-15">Danh sách giá trị</p>
                                <p class="d-inline-block text-blue link-text text-500 mt-15" id="add-rules-value">&plus;
                                    Thêm mới giá trị</p>
                            </div>
                            <div id="rules-value">
                            </div>
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
                    <p>Bạn có chắc chắn muốn hủy việc thêm tiêu chí đánh giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right">
                        <a href="tieu-chi-danh-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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
            var tieu_chi_danh_gia = $("input[name='tieu_chi_danh_gia'").val();
            var he_so = $("input[name='he_so'").val();
            var kieu_gia_tri = $("#value-type").val();

            var gia_tri = new Array();
            var ten_hien_thi = new Array();

            $("input[name='gia_tri'").each(function() {
                $gt = $(this).val();
                if ($gt != "") {
                    gia_tri.push($gt);
                }
            })
            $("input[name='ten_hien_thi'").each(function() {
                $tht = $(this).val();
                if ($gt != "") {
                    ten_hien_thi.push($tht);
                }
            })
            //get user id
            var ep_id = '<?= $user_id ?>';
            var com_id = '<?= $com_id ?>';
            $.ajax({
                url: '../ajax/tc_them.php',
                type: 'POST',
                data: {
                    tieu_chi_danh_gia: tieu_chi_danh_gia,
                    he_so: he_so,
                    kieu_gia_tri: kieu_gia_tri,

                    gia_tri: gia_tri,
                    ten_hien_thi: ten_hien_thi,

                    //user id
                    ep_id: ep_id,
                    com_id: com_id

                },
                success: function(data) {
                    if (data == "") {
                        alert("Thêm tiêu chí thành công!");
                        window.location.href = 'tieu-chi-danh-gia.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>