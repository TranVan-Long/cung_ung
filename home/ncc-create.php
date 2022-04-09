<?php
include("config.php");
include("../includes/icon.php");
$date = date('m-d-Y', time());

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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `nha_cung_cap` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $ncc3 = explode(',', $item_nv['nha_cung_cap']);
            if (in_array(2, $ncc3) == FALSE) {
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
    <title>Thêm nhà cung cấp</title>
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
                    <a class="text-black" href="quan-ly-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt-20">Thêm nhà cung cấp</p>
                </div>
                <form action="" class="main-form" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Tên nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_nha_cc_kh" placeholder="Nhập tên nhà cung cấp">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Tên gọi tắt</label>
                                    <input type="text" name="ten_vt" placeholder="Nhập tên gọi tắt">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Mã số thuế</label>
                                    <input type="number" name="ma_so_thue" placeholder="Nhập mã số thuế">
                                </div>
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Tên giao dịch<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_giao_dich" placeholder="Nhập tên giao dịch">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Địa chỉ ĐKKD</label>
                                    <input type="text" name="dia_chi_dkkd" placeholder="Nhập địa chỉ ĐKKD">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Số ĐKKD</label>
                                    <input type="number" name="so_dkkd" placeholder="Nhập số ĐKKD">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Địa chỉ liên hệ</label>
                                    <input type="text" name="dia_chi_lh" placeholder="Nhập địa chỉ liên hệ">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Fax</label>
                                    <input type="number" name="fax" placeholder="Nhập Fax">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Điện thoại</label>
                                    <input type="tel" name="so_dien_thoai" placeholder="Nhập điện thoại">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Website</label>
                                    <input type="url" name="website" placeholder="Nhập Website">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>E-mail</label>
                                    <input type="email" name="email" placeholder="Nhập E-mail">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Sản phẩm cung ứng</label>
                                    <input type="text" name="sp_cung_ung" placeholder="Nhập sản phẩm cung ứng">
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Thông tin khác</label>
                                    <input type="text" name="thong_tin_khac" placeholder="Nhập thông tin">
                                </div>
                            </div>
                        </div>
                        <div class="form-control edit-form mt-15 left w-100">
                            <div class="border-bottom pb-10">
                                <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                                <p class="d-inline-block text-500 text-blue link-text mt-15 add_bank_kh">&plus; Thêm
                                    mới tài khoản ngân
                                    hàng</p>
                            </div>
                            <div id="bank-list">
                                <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                    <div class="bank-form">
                                        <div class="form-row left">
                                            <div class="form-col-50 left mb_15 autocomplete">
                                                <label">Tên ngân hàng<span class="text-red">&ast;</span></label>
                                                    <input type="text" id="ten_nh" name="ten_nhanhang" placeholder="Nhập tên ngân hàng" autocomplete="off">
                                            </div>
                                            <div class="form-col-50 right mb_15">
                                                <label">Chi nhánh<span class="text-red">&ast;</span></label>
                                                    <input type="text" name="chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row left">
                                            <div class="form-col-50 left mb_15">
                                                <label>Số tài khoản<span class="text-red">&ast;</span></label>
                                                <input type="number" name="so_tk" placeholder="Nhập số tài khoản" autocomplete="off" oninput="<?= $oninput ?>">
                                            </div>
                                            <div class="form-col-50 right mb_15">
                                                <label>Chủ tài khoản</label>
                                                <input type="text" name="chu_taik" placeholder="Nhập tên chủ tài khoản" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="removeItem2">
                                        <i class="ic-delete2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-15 left w-100">
                            <p class="d-inline-block text-bold mr-20 mt-15">Người liên hệ</p>
                            <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-references">&plus; Thêm
                                người liên hệ</p>
                            <div class="table-wrapper mt-10">
                                <div class="table-container table_1048">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5"></th>
                                                    <th class="w-30">Họ tên</th>
                                                    <th class="w-30">Chức vụ</th>
                                                    <th class="w-20">Điện thoại</th>
                                                    <th class="w-30">Email</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="rererences">
                                                <tr id="item">
                                                    <td class="w-5">
                                                        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                                    </td>
                                                    <td class="w-30">
                                                        <input type="text" name="ten_nguoi_lh">
                                                    </td>
                                                    <td class="w-30">
                                                        <input type="text" name="chuc_vu">
                                                    </td>
                                                    <td class="w-20">
                                                        <input type="tel" name="so_dien_thoai_lh">
                                                    </td>
                                                    <td class="w-30">
                                                        <input type="email" name="email_lh">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 left mt-30">
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
                    <p>Bạn có chắc chắn muốn hủy việc thêm nhà cung cấp?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="quan-ly-nha-cung-cap.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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
<script type="text/javascript" src="../js/bank-name.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $(".add_bank_kh").click(function() {
        var kh_bank = 1;
        $.ajax({
            url: '../render/tai_khoan_html.php',
            type: 'POST',
            data: {
                kh_bank: kh_bank
            },
            success: function(data) {
                $('#bank-list').append(data);
            }
        })
    });

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ma_nha_cung_cap: {
                    required: true,
                },
                ten_nha_cc_kh: {
                    required: true,
                },
                ten_giao_dich: {
                    required: true,
                },
                ten_ngan_hang: {
                    required: true,
                },
                ten_chi_nhanh: {
                    required: true,
                },
                so_tk: {
                    required: true,
                    number: true,
                }

            },
            messages: {
                ma_nha_cung_cap: {
                    required: "Mã nhà cung cấp không được để trống.",
                },
                ten_nha_cc_kh: {
                    required: "Tên nhà cung cấp không được để trống.",
                },
                ten_giao_dich: {
                    required: "Tên giao dịch không được để trống.",
                },
                ten_ngan_hang: {
                    required: "Tên ngân hàng không được để trống.",
                },
                ten_chi_nhanh: {
                    required: "Tên chi nhánh không được để trống.",
                },
                so_tk: {
                    required: "Số tài khoản không được để trống.",
                    number: "Số tài khoản không đúng định dạng.",
                }
            }
        });
        if (form.valid() === true) {

            //thong tin nha cung cap
            var ten_nha_cc_kh = $("input[name='ten_nha_cc_kh'").val();
            var ten_vt = $("input[name='ten_vt']").val();
            var ten_giao_dich = $("input[name='ten_giao_dich']").val();
            var ma_so_thue = $("input[name='ma_so_thue']").val();
            var dia_chi_dkkd = $("input[name='dia_chi_dkkd']").val();
            var so_dkkd = $("input[name='so_dkkd']").val();
            var dia_chi_lh = $("input[name='dia_chi_lh']").val();
            var fax = $("input[name='fax']").val();
            var so_dien_thoai = $("input[name='so_dien_thoai']").val();
            var website = $("input[name='website']").val();
            var email = $("input[name='email']").val();
            var sp_cung_ung = $("input[name='sp_cung_ung']").val();
            var thong_tin_khac = $("input[name='thong_tin_khac']").val();

            // ngan hang
            var ten_ngan_hang = [];
            var ten_chi_nhanh = [];
            var so_tk = [];
            var chu_tk = [];
            $("input[name='ten_nhanhang']").each(function() {
                $ten_nh = $(this).val();
                if ($ten_nh != "") {
                    ten_ngan_hang.push($ten_nh);
                }
            });
            $("input[name='chi_nhanh']").each(function() {
                $chi_nhanh_nh = $(this).val();
                if ($chi_nhanh_nh != "") {
                    ten_chi_nhanh.push($chi_nhanh_nh);
                }
            });
            $("input[name='so_tk']").each(function() {
                $stk_nh = $(this).val();
                if ($stk_nh != "") {
                    so_tk.push($stk_nh);
                }
            });
            $("input[name='chu_taik']").each(function() {
                $chu_tk_nh = $(this).val();
                if ($chu_tk_nh != "") {
                    chu_tk.push($chu_tk_nh);
                }
            });

            // nguoi lien he
            var ten_nguoi_lh = [];
            var chuc_vu = [];
            var so_dien_thoai_lh = [];
            var email_lh = [];
            $("input[name='ten_nguoi_lh']").each(function() {
                $ten_nlh = $(this).val();
                if ($ten_nlh != "") {
                    ten_nguoi_lh.push($ten_nlh);
                }
            });

            $("input[name='chuc_vu']").each(function() {
                $cv_nlh = $(this).val();
                if ($cv_nlh != "") {
                    chuc_vu.push($(this).val());
                }

            });
            $("input[name='so_dien_thoai_lh']").each(function() {
                $sdt_nlh = $(this).val();
                if ($sdt_nlh != "") {
                    so_dien_thoai_lh.push($sdt_nlh);
                }
            });
            $("input[name='email_lh']").each(function() {
                $mail_nlh = $(this).val();
                if ($mail_nlh != "") {
                    email_lh.push($mail_nlh);
                }
            });

            //get user id
            var user_id = $(".main-form").attr("data2");
            var com_id = $(".main-form").attr("data1");
            var role = $(".main-form").attr("data");

            $.ajax({
                url: '../ajax/ncc_them.php',
                type: 'POST',
                data: {
                    ten_nha_cc_kh: ten_nha_cc_kh,
                    ten_vt: ten_vt,
                    ten_giao_dich: ten_giao_dich,
                    ma_so_thue: ma_so_thue,
                    dia_chi_dkkd: dia_chi_dkkd,
                    so_dkkd: so_dkkd,
                    dia_chi_lh: dia_chi_lh,
                    fax: fax,
                    so_dien_thoai: so_dien_thoai,
                    website: website,
                    email: email,
                    sp_cung_ung: sp_cung_ung,
                    thong_tin_khac: thong_tin_khac,

                    ten_ngan_hang: ten_ngan_hang,
                    ten_chi_nhanh: ten_chi_nhanh,
                    so_tk: so_tk,
                    chu_tk: chu_tk,

                    ten_nguoi_lh: ten_nguoi_lh,
                    chuc_vu: chuc_vu,
                    so_dien_thoai_lh: so_dien_thoai_lh,
                    email_lh: email_lh,

                    user_id: user_id,
                    com_id: com_id,
                    role: role,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Thêm nhà cung cấp thành công!");
                        window.location.href = 'quan-ly-nha-cung-cap.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>