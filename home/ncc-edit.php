<?php
include("config.php");
include("../includes/icon.php");
$date = date('m-d-Y', time());

if (isset($_GET['id']) && $_GET['id'] != "") {
    $ncc_id = $_GET['id'];
    $ncc_get = new db_query("SELECT * FROM `nha_cc_kh` WHERE `id` = '" . $ncc_id . "' ");
    $ncc_bank = new db_query("SELECT * FROM `tai_khoan` WHERE `id_nha_cc_kh` = '" . $ncc_id . "' ");
    $ncc_contact = new db_query("SELECT * FROM `nguoi_lien_he` WHERE `id_nha_cc` = '" . $ncc_id . "' ");
    $ncc_detail = mysql_fetch_assoc($ncc_get->result);
    $ep_id = $_SESSION['ep_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa nhà cung cấp</title>
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
                    <a class="text-black" href="quan-ly-chi-tiet-nha-cung-cap-<?= "$ncc_id" ?>.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt_25 mb_10">Chỉnh sửa nhà cung cấp</p>
                </div>
                <form action="" class="main-form">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Mã nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <input type="text" name="id" value="NCC-<?= $ncc_detail['id'] ?>" readonly>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Tên gọi tắt</label>
                                    <input type="text" name="ten_vt" placeholder="Nhập tên gọi tắt" value="<?= $ncc_detail['ten_vt'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Tên nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_nha_cc_kh" placeholder="Nhập tên nhà cung cấp" value="<?= $ncc_detail['ten_nha_cc_kh'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Mã số thuế</label>
                                    <input type="number" name="ma_so_thue" placeholder="Nhập mã số thuế" value="<?= $ncc_detail['ma_so_thue'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Tên giao dịch<span class="text-red">&ast;</span></label>
                                    <input type="text" name="ten_giao_dich" placeholder="Nhập tên giao dịch" value="<?= $ncc_detail['ten_giao_dich'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Địa chỉ ĐKKD</label>
                                    <input type="text" name="dia_chi_dkkd" placeholder="Nhập địa chỉ ĐKKD" value="<?= $ncc_detail['dia_chi_dkkd'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Số ĐKKD</label>
                                    <input type="text" name="so_dkkd" placeholder="Nhập số ĐKKD" value="<?= $ncc_detail['so_dkkd'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Địa chỉ liên hệ</label>
                                    <input type="text" name="dia_chi_lh" placeholder="Nhập địa chỉ liên hệ" value="<?= $ncc_detail['dia_chi_lh'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Fax</label>
                                    <input type="number" name="fax" placeholder="Nhập Fax" value="<?= $ncc_detail['fax'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Điện thoại</label>
                                    <input type="tel" name="so_dien_thoai" placeholder="Nhập điện thoại" value="<?= $ncc_detail['so_dien_thoai'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Website</label>
                                    <input type="url" name="website" placeholder="Nhập Website" value="<?= $ncc_detail['website'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>E-mail</label>
                                    <input type="email" name="email" placeholder="Nhập E-mail" value="<?= $ncc_detail['email'] ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Sản phẩm cung ứng</label>
                                    <input type="text" name="sp_cung_ung" placeholder="Nhập sản phẩm cung ứng" value="<?= $ncc_detail['sp_cung_ung'] ?>">
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Thông tin khác</label>
                                    <input type="text" name="thong_tin_khac" placeholder="Nhập Thông tin" value="<?= $ncc_detail['thong_tin_khac'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-control edit-form mt-30 left w-100">
                            <div class="border-bottom pb-10">
                                <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                                <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-bank-acc">&plus; Thêm
                                    mới tài khoản ngân
                                    hàng</p>
                            </div>
                            <div id="bank-list">
                                <? while ($ncc_detail_bank = mysql_fetch_assoc($ncc_bank->result)) { ?>
                                    <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                        <div class="bank-form">
                                            <div class="form-row left">
                                                <div class="form-col-50 left mb_15">
                                                    <input type="hiden" class="d-none" name="id_ngan_hang_old" value="<?= $ncc_detail_bank['id'] ?>">
                                                    <label>Tên ngân hàng<span class="text-red">&ast;</span></label>
                                                    <input type="text" name="ten_ngan_hang_old" placeholder="Nhập tên ngân hàng" value="<?= $ncc_detail_bank['ten_ngan_hang'] ?>">
                                                </div>
                                                <div class="form-col-50 right mb_15">
                                                    <label>Chi nhánh<span class="text-red">&ast;</span></label>
                                                    <input type="text" name="ten_chi_nhanh_old" placeholder="Nhập tên chi nhánh ngân hàng" value="<?= $ncc_detail_bank['ten_chi_nhanh'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row left">
                                                <div class="form-col-50 left mb_15">
                                                    <label>Số tài khoản<span class="text-red">&ast;</span></label>
                                                    <input type="number" name="so_tk_old" placeholder="Nhập số tài khoản" value="<?= $ncc_detail_bank['so_tk'] ?>">
                                                </div>
                                                <div class="form-col-50 right mb_15">
                                                    <label>Chủ tài khoản</label>
                                                    <input type="text" name="chu_tk_old" placeholder="Nhập tên chủ tài khoản" value="<?= $ncc_detail_bank['chu_tk'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-btn" data-target="remove-bank-<?= $ncc_detail_bank['id'] ?>">
                                            <i class="ic-delete2"></i>
                                        </div>
                                        <div class="modal text-center" id="remove-bank-<?= $ncc_detail_bank['id'] ?>">
                                            <div class="m-content">
                                                <div class="m-head ">
                                                    Thông báo <span class="dismiss cancel">&times;</span>
                                                </div>
                                                <div class="m-body">
                                                    <p>Bạn có chắc chắn muốn xóa tài khoản này?</p>
                                                    <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                </div>
                                                <div class="m-foot d-inline-block">
                                                    <div class="left mb_10">
                                                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                    </div>
                                                    <div class="right mb_10">
                                                        <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove-bank" data-id="<?= $ncc_detail_bank['id'] ?>">Đồng ý</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <p class="d-inline cr_weightd-inline-block text-bold mr-20 mt-15">Người liên hệ</p>
                            <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-references">&plus; Thêm
                                người liên hệ</p>
                            <div class="table-wrapper mt-20">
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
                                                <? while ($ncc_detail_contact = mysql_fetch_assoc($ncc_contact->result)) { ?>
                                                    <tr class="item">
                                                        <td class="w-5">
                                                            <p class="modal-btn" data-target="remove-contact-<?= $ncc_detail_contact['id'] ?>"><i class="ic-delete remove-btn"></i></p>
                                                        </td>
                                                        <td class="w-30">
                                                            <input type="hiden" class="d-none" name="id_nguoi_lh_old" value="<?= $ncc_detail_contact['id'] ?>">
                                                            <input type="text" name="ten_nguoi_lh_old" value="<?= $ncc_detail_contact['ten_nguoi_lh'] ?>">
                                                        </td>
                                                        <td class="w-30">
                                                            <input type="text" name="chuc_vu_old" value="<?= $ncc_detail_contact['chuc_vu'] ?>">
                                                        </td>
                                                        <td class="w-20">
                                                            <input type="number" name="so_dien_thoai_lh_old" value="<?= $ncc_detail_contact['so_dien_thoai'] ?>">
                                                        </td>
                                                        <td class="w-30">
                                                            <input type="email" name="email_lh_old" value="<?= $ncc_detail_contact['email'] ?>">
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="remove-contact-<?= $ncc_detail_contact['id'] ?>">
                                                        <div class="m-content">
                                                            <div class="m-head ">
                                                                Thông báo <span class="dismiss cancel">&times;</span>
                                                            </div>
                                                            <div class="m-body">
                                                                <p>Bạn có chắc chắn muốn xóa người liên hệ này?</p>
                                                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                            </div>
                                                            <div class="m-foot d-inline-block">
                                                                <div class="left mb_10">
                                                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                                </div>
                                                                <div class="right mb_10">
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove-contact" data-id="<?= $ncc_detail_contact['id'] ?>">Đồng ý</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? } ?>
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
                    <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa nhà cung cấp?</p>
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
                id: {
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
                id: {
                    required: "Mã nhà cung cấp không được để trống.",
                },
                ten_nha_cc_kh: {
                    required: "Tên nhà cung cấp không được để trống.",
                },
                ten_giao_dich: {
                    required: "Tên giao dịch không được để trống.",
                },
                ten_ngan_hang: {
                    required: "Vui lòng chọn ngân hàng.",
                },
                ten_chi_nhanh: {
                    required: "Vui lòng chọn chi nhánh.",
                },
                so_tk: {
                    required: "Số tài khoản không được để trống.",
                    number: "Số tài khoản không đúng định dạng.",
                }
            }
        });
        if (form.valid() === true) {
            //thong tin nha cung cap
            var id_ncc_kh = "<?= $ncc_id ?>";
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

            // ngan hang cu
            var id_ngan_hang_old = new Array();
            var ten_ngan_hang_old = new Array();
            var ten_chi_nhanh_old = new Array();
            var so_tk_old = new Array();
            var chu_tk_old = new Array();
            $("input[name='id_ngan_hang_old']").each(function() {
                var id_nh_o = $(this).val();
                if (id_nh_o != "") {
                    id_ngan_hang_old.push(id_nh_o);
                }
            })
            $("input[name='ten_ngan_hang_old']").each(function() {
                var ten_nh_o = $(this).val();
                if (ten_nh_o != "") {
                    ten_ngan_hang_old.push(ten_nh_o);
                }
            });
            $("input[name='ten_chi_nhanh_old']").each(function() {
                var ten_cn_o = $(this).val();
                if (ten_cn_o != "") {
                    ten_chi_nhanh_old.push(ten_cn_o);
                }

            });
            $("input[name='so_tk_old']").each(function() {
                var stk_o = $(this).val();
                if (stk_o != "") {
                    so_tk_old.push(stk_o);
                }
            });
            $("input[name='chu_tk_old']").each(function() {
                chu_tk_old.push($(this).val());
            });

            // ngan hang moi
            var ten_ngan_hang = new Array();
            var ten_chi_nhanh = new Array();
            var so_tk = new Array();
            var chu_tk = new Array();

            $("input[name='ten_ngan_hang']").each(function() {
                var ten_nh = $(this).val();
                if (ten_nh != "") {
                    ten_ngan_hang.push(ten_nh);
                }
            });
            $("input[name='ten_chi_nhanh']").each(function() {
                var ten_cn = $(this).val();
                if (ten_cn != "") {
                    ten_chi_nhanh.push(ten_cn);
                }
            });
            $("input[name='so_tk']").each(function() {
                var stk_n = $(this).val();
                if (stk_n != "") {
                    so_tk.push(stk_n);
                }
            });
            $("input[name='chu_tk']").each(function() {
                chu_tk.push($(this).val());
            });

            // nguoi lien he cu
            var id_nguoi_lh_old = new Array();
            var ten_nguoi_lh_old = new Array();
            var chuc_vu_old = new Array();
            var so_dien_thoai_lh_old = new Array();
            var email_lh_old = new Array();
            $("input[name='id_nguoi_lh_old']").each(function() {
                var nlh_o = $(this).val();
                if (nlh_o != "") {
                    id_nguoi_lh_old.push(nlh_o);
                }
            })
            $("input[name='ten_nguoi_lh_old']").each(function() {
                var ten_nlh_o = $(this).val();
                if (ten_nlh_o != "") {
                    ten_nguoi_lh_old.push(ten_nlh_o);
                }

            });
            $("input[name='chuc_vu_old']").each(function() {
                var chuc_vu_nlh_o = $(this).val();
                if (chuc_vu_nlh_o != "") {
                    chuc_vu_old.push(chuc_vu_nlh_o);
                }
            });
            $("input[name='so_dien_thoai_lh_old']").each(function() {
                var sdt_lh_o = $(this).val();
                if (sdt_lh_o != "") {
                    so_dien_thoai_lh_old.push(sdt_lh_o);
                }
            });
            $("input[name='email_lh_old']").each(function() {
                var mail_lh_o = $(this).val();
                if (mail_lh_o != "") {
                    email_lh_old.push(mail_lh_o);
                }
            });

            // nguoi lien he moi
            var ten_nguoi_lh = new Array();
            var chuc_vu = new Array();
            var so_dien_thoai_lh = new Array();
            var email_lh = new Array();

            $("input[name='ten_nguoi_lh']").each(function() {
                var ten_nlh = $(this).val();
                if (ten_nlh != "") {
                    ten_nguoi_lh.push(ten_nlh);
                }
            });
            $("input[name='chuc_vu']").each(function() {
                var chuc_vu_nlh = $(this).val();
                if (chuc_vu_nlh != "") {
                    chuc_vu.push(chuc_vu_nlh);
                }
            });
            $("input[name='so_dien_thoai_lh']").each(function() {
                var sdt_lh = $(this).val();
                if (sdt_lh != "") {
                    so_dien_thoai_lh.push(sdt_lh);
                }
            });
            $("input[name='email_lh']").each(function() {
                var mail_lh = $(this).val();
                if (mail_lh != "") {
                    email_lh.push(mail_lh);
                }
            });

            //get user id
            var ep_id = '<?= $ep_id ?>';


            $.ajax({
                url: '../ajax/ncc_sua.php',
                type: 'POST',
                data: {
                    id_ncc_kh: id_ncc_kh,
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

                    //ngan hang cu
                    id_ngan_hang_old: id_ngan_hang_old,
                    ten_ngan_hang_old: ten_ngan_hang_old,
                    ten_chi_nhanh_old: ten_chi_nhanh_old,
                    so_tk_old: so_tk_old,
                    chu_tk_old: chu_tk_old,

                    //ngan hang moi
                    ten_ngan_hang: ten_ngan_hang,
                    ten_chi_nhanh: ten_chi_nhanh,
                    so_tk: so_tk,
                    chu_tk: chu_tk,

                    //nguoi lien he cu
                    id_nguoi_lh_old: id_nguoi_lh_old,
                    ten_nguoi_lh_old: ten_nguoi_lh_old,
                    chuc_vu_old: chuc_vu_old,
                    so_dien_thoai_lh_old: so_dien_thoai_lh_old,
                    email_lh_old: email_lh_old,

                    //nguoi lien he moi
                    ten_nguoi_lh: ten_nguoi_lh,
                    chuc_vu: chuc_vu,
                    so_dien_thoai_lh: so_dien_thoai_lh,
                    email_lh: email_lh,

                    //user id
                    ep_id: ep_id
                },
                success: function(data) {
                    if (data == "") {
                        alert('"Cập nhật nhà cung cấp thành công!"');
                        window.location.href = 'quan-ly-chi-tiet-nha-cung-cap-<?= "$ncc_id" ?>.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });

    $(".remove-bank").click(function() {
        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/xoa_tk_nh.php',
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

    $(".remove-contact").click(function() {
        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/ncc_xoa_nguoi_lien_he.php',
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