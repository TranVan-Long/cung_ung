<?php
include("config.php");
include("../includes/icon.php");
if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
        $role = 1;
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $role = 2;

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `khach_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $khach_hang3 = explode(',', $item_nv['khach_hang']);
            if (in_array(2, $khach_hang3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm khách hàng</title>
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
                    <a class="text-black" href="quan-ly-khach-hang.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt-20">Thêm khách hàng</p>
                </div>
                <form class="main-form" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Tên khách hàng<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_khach_hang" placeholder="Nhập tên khách hàng">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Tên gọi tắt</label>
                                    <input type="text" name="ten_goi_tat" placeholder="Nhập tên gọi tắt">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Tên giao dịch<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_giao_dich" placeholder="Nhập tên giao dịch">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Mã số thuế</label>
                                    <input type="text" name="ma_so_thue" placeholder="Nhập Mã số thuế" oninput="<?= $oninput ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Địa chỉ ĐKKD</label>
                                    <input type="text" name="dia_chi_dkkd" placeholder="Nhập địa chỉ ĐKKD">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Số ĐKKD</label>
                                    <input type="text" name="so_dkkd" placeholder="Nhập số ĐKKD">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Địa chỉ liên hệ</label>
                                    <input type="text" name="dia_chi_lien-he" placeholder="Nhập địa chỉ liên hệ">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Fax</label>
                                    <input type="text" name="fax" placeholder="Nhập Fax" oninput="<?= $oninput ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Điện thoại</label>
                                    <input type="text" name="dien_thoai" placeholder="Nhập điện thoại" oninput="<?= $oninput ?>">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Website</label>
                                    <input type="text" name="website" placeholder="Nhập Website">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>E-mail</label>
                                    <input type="text" name="email" placeholder="Nhập E-mail">
                                </div>
                            </div>
                        </div>
                        <div class="form-control edit-form mt-15 left w-100">
                            <div class="border-bottom pb-10">
                                <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                                <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-bank-acc">&plus; Thêm
                                    mới tài khoản ngân
                                    hàng</p>
                            </div>
                            <div id="bank-list">
                                <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                    <div class="bank-form">
                                        <div class="form-row left">
                                            <div class="form-col-50 left mb_15">
                                                <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">&ast;</span></label>
                                                <input type="text" name="ten_ngan_hang" placeholder="Nhập tên ngân hàng">
                                            </div>
                                            <div class="form-col-50 right mb_15 v-select2">
                                                <label for="chi-nhanh-ngan-hang">Chi nhánh
                                                    <span class="text-red">&ast;</span></label>
                                                <input type="text" name="ten_chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                                            </div>
                                        </div>
                                        <div class="form-row left">
                                            <div class="form-col-50 left mb_15">
                                                <label>Số tài khoản<span class="text-red">&ast;</span></label>
                                                <input type="text" name="so_tk" placeholder="Nhập số tài khoản" oninput="<?= $oninput ?>">
                                            </div>
                                            <div class="form-col-50 right mb_15">
                                                <label>Chủ tài khoản</label>
                                                <input type="text" name="chu_tk" placeholder="Nhập tên chủ tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="removeItem2">
                                        <i class="ic-delete2"></i>
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
                    <p>Bạn có chắc chắn muốn hủy việc thêm khách hàng?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="quan-ly-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                    </div>
                </div>
            </div>
        </div>
        <? include "../modals/modal_logout.php" ?>
        <? include("../modals/modal_menu.php") ?>
    </div>
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
                ten_khach_hang: {
                    required: true,
                },
                ten_giao_dich: {
                    required: true,
                },
                ten_ngan_hang: {
                    required: true,
                },
                chi_nhanh_ngan_hang: {
                    required: true,
                },
                so_tai_khoan: {
                    required: true,
                    number: true,
                }
            },
            messages: {
                ten_khach_hang: {
                    required: "Tên khách hàng không được để trống.",
                },
                ten_giao_dich: {
                    required: "Tên giao dịch không được để trống.",
                },
                ten_ngan_hang: {
                    required: "Vui lòng chọn ngân hàng.",
                },
                chi_nhanh_ngan_hang: {
                    required: "Vui lòng chọn chi nhánh.",
                },
                so_tai_khoan: {
                    required: "Số tài khoản không được để trống.",
                    number: "Số tài khoản không đúng định dạng.",
                }
            }
        });
        if (form.valid() === true) {
            var user_id = $(".main-form").attr("data2");
            var com_id = $(".main-form").attr("data1");
            var role = $(".main-form").attr("data");

            var ten_kh = $("input[name='ten_khach_hang']").val();
            var ten_goi_tat = $("input[name='ten_goi_tat']").val();
            var ten_giao_dich = $("input[name='ten_giao_dich']").val();
            var ma_so_thue = $("input[name='ma_so_thue']").val();
            var dia_chi_dkkd = $("input[name='dia_chi_dkkd']").val();
            var so_dkkd = $("input[name='so_dkkd']").val();
            var dia_chi_lh = $("input[name='dia_chi_lien-he']").val();
            var fax = $("input[name='fax']").val();
            var so_dien_thoai = $("input[name='dien_thoai']").val();
            var website = $("input[name='website']").val();
            var email = $("input[name='email']").val();



            var nh = [];
            $("input[name='ten_ngan_hang']").each(function() {
                var ten_nh = $(this).val();
                if (ten_nh != "") {
                    nh.push(ten_nh);
                }
            });

            var ch = [];
            $("input[name='ten_chi_nhanh']").each(function() {
                var ten_ch_nh = $(this).val();
                if (ten_ch_nh != "") {
                    ch.push(ten_ch_nh);
                }
            });

            var stk = [];
            $("input[name='so_tk']").each(function() {
                var so_tai_khoan = $(this).val();
                if (so_tai_khoan != "") {
                    stk.push(so_tai_khoan);
                }
            });

            var ctk = [];
            $("input[name='chu_tk']").each(function() {
                var chu_tk = $(this).val();
                if (chu_tk == "") {
                    chu_tk = "0";
                    ctk.push(chu_tk);
                } else {
                    ctk.push(chu_tk);
                }
            });

            $.ajax({
                url: '../ajax/them_kh.php',
                type: 'POST',
                data: {
                    ten_kh: ten_kh,
                    ten_goi_tat: ten_goi_tat,
                    ten_giao_dich: ten_giao_dich,
                    ma_so_thue: ma_so_thue,
                    dia_chi_dkkd: dia_chi_dkkd,
                    so_dkkd: so_dkkd,
                    dia_chi_lh: dia_chi_lh,
                    fax: fax,
                    so_dien_thoai: so_dien_thoai,
                    website: website,
                    email: email,
                    ten_nh: nh,
                    ten_ch_nh: ch,
                    so_tai_khoan: stk,
                    chu_tk: ctk,
                    com_id: com_id,
                    user_id: user_id,
                    role: role,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã thêm khách hàng thành công");
                        window.location.href = '/quan-ly-khach-hang.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>