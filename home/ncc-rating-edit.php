<?php

include("../includes/icon.php");
include("config.php");
$date = strtotime(date('Y-m-d', time()));

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 2;
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `danh_gia_ncc` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $ncc_rat3 = explode(',', $item_nv['danh_gia_ncc']);
            if (in_array(3, $ncc_rat3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    $list_dg = mysql_fetch_assoc((new db_query("SELECT `id`, `ngay_danh_gia`, `nguoi_danh_gia`, `phong_ban`, `id_nha_cc`, `danh_gia_khac`,`quyen_nlap`,
                            `tong_diem` FROM `danh_gia` WHERE `id`= $id AND `id_cong_ty` = $com_id "))->result);

    $id_ncc = $list_dg['id_nha_cc'];

    if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2) {
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);

        $user = [];
        for ($i = 0; $i < $count; $i++) {
            $item1 = $data_list_nv[$i];
            $user[$item1["ep_id"]] = $item1;
        }
    }

    $list_nhacc = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");

    $list_ncc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh`, `dia_chi_lh`, `sp_cung_ung`, `phan_loai`
                                                FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id` = '$id_ncc' AND `id_cong_ty` = $com_id "))->result);

    $list_ctiet_dg = new db_query(" SELECT c.`id`, c.`id_danh_gia`, c.`id_tieu_chi`, c.`diem_danh_gia`, c.`tong_diem_danh_gia`, c.`danh_gia_chi_tiet`, t.`he_so`, t.`kieu_gia_tri`
                                    FROM `chi_tiet_danh_gia` AS c
                                    INNER JOIN `tieu_chi_danh_gia` AS t ON c.`id_tieu_chi` = t.`id`
                                    WHERE c.`id_danh_gia` = $id ");
    $co = mysql_fetch_assoc((new db_query("SELECT count(`id`) AS cou FROM `chi_tiet_danh_gia` WHERE `id_danh_gia` = $id "))->result)['cou'];
} else {
    header('location: /danh-gia-nha-cung-cap.html');
    exit();
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa phiếu đánh giá</title>
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
                    <a class="text-black" href="danh-gia-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt_20 mb_10">Chỉnh sửa phiếu đánh giá nhà cung cấp</p>
                </div>
                <form class="main-form" data="<?= $com_id ?>" data1="<?= $_COOKIE['user'] ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form" data="<?= $phan_quyen_nk ?>">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Số phiếu</label>
                                    <input type="text" name="so_phieu" value="PH-<?= $list_dg['id'] ?>" data="<?= $list_dg['id'] ?>" readonly>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Ngày đánh giá<span class="text-red">&ast;</span></label>
                                    <input type="date" name="ngay_danh_gia" value="<?= date('Y-m-d', $list_dg['ngay_danh_gia']) ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>Người đánh giá<span class="text-red">&ast;</span></label>
                                    <? if ($list_dg['quyen_nlap'] == 1) { ?>
                                        <input type="text" name="nguoi_danh_gia" placeholder="Nhập người đánh giá" value="<?= $com_name ?>" readonly>
                                    <? } else if ($list_dg['quyen_nlap'] == 2) { ?>
                                        <input type="text" name="nguoi_danh_gia" placeholder="Nhập người đánh giá" value="<?= $user[$list_dg['nguoi_danh_gia']]['ep_name'] ?>" readonly>
                                    <? } ?>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Phòng ban</label>
                                    <? if ($list_dg['quyen_nlap'] == 1) { ?>
                                        <input type="text" name="phong_ban" placeholder="Nhập phòng ban" value="" readonly>
                                    <? } else if ($list_dg['quyen_nlap'] == 2) { ?>
                                        <input type="text" name="phong_ban" placeholder="Nhập phòng ban" value="<?= $user[$list_dg['nguoi_danh_gia']]['dep_name'] ?>" readonly>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="nha-cung-cap">Nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <select class="share_select" name="nha_cung_cap" id="nha-cung-cap">
                                        <option value="">Chọn nhà cung cấp</option>
                                        <? while ($row = mysql_fetch_assoc($list_nhacc->result)) { ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $list_dg['id_nha_cc']) ? "selected" : "" ?>><?= $row['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="detail_nhacc w_100 float_l">
                                <div class="form-row left">
                                    <div class="form-col-50 no-border left mb_15">
                                        <p>Tên nhà cung cấp</p>
                                        <p class="cr_weight mt-10"><?= $list_ncc['ten_nha_cc_kh'] ?></p>
                                    </div>
                                    <div class="form-col-50 no-border right mb_15">
                                        <p>Địa chỉ</p>
                                        <p class="cr_weight mt-10"><?= $list_ncc['dia_chi_lh'] ?></p>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 no-border left mb_15">
                                        <p>Sản phẩm cung ứng</p>
                                        <p class="cr_weight mt-10"><?= $list_ncc['sp_cung_ung'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <p>Điểm đánh giá</p>
                                    <input type="text" name="tongd_dg" id="tongd_dg" value="<?= $list_dg['tong_diem'] ?>" class="hidden_bd" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-100 no-border left mb_15">
                                    <label>Đánh giá khác</label>
                                    <textarea name="danh_gia_khac" placeholder="Nhập đánh giá khác"><?= $list_dg['danh_gia_khac'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <p class="text-blue link-text d-inline text-500" id="add-ratting-ruler">&plus; Thêm tiêu chí
                                đánh giá</p>
                            <div class="table-wrapper mt-10">
                                <div class="table-container table-1252">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5" rowspan="2"></th>
                                                    <th class="w-10" rowspan="2">STT</th>
                                                    <th class="w-20" rowspan="2">Tiêu chí đánh giá</th>
                                                    <th class="w-10" rowspan="2">Hệ số</th>
                                                    <th class="w-10" rowspan="2">Thang điểm</th>
                                                    <th colspan="3" scope="colgroup" class="border-bottom-w">Đánh giá</th>
                                                </tr>
                                                <tr class="border-top-w">
                                                    <th class="w-15" scope="colgroup">Điểm đánh giá</th>
                                                    <th class="w-15" scope="colgroup">Điểm</th>
                                                    <th class="w-15" scope="colgroup">Đánh giá chi tiết</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="ratting-ruler" data="<?= $co ?>">
                                                <? $stt = 1;
                                                while ($row = mysql_fetch_assoc($list_ctiet_dg->result)) {
                                                ?>
                                                    <tr class="item" data1="<?= $row['id'] ?>">
                                                        <td class="w-5">
                                                            <p class="removeItem_tc"><i class="ic-delete remove_btn" data-id="<?= $row['id'] ?>"></i></p>
                                                            <input type="hidden" name="id_tc" value="<?= $row['id'] ?>">
                                                        </td>
                                                        <td class="w-10">
                                                            <p class="one_stt"><?= $stt++ ?></p>
                                                        </td>
                                                        <td class="w-20">
                                                            <div class="v-select2">
                                                                <select name="tieu_chi" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                                                                    <option value="">Chọn tiêu chí đánh giá</option>
                                                                    <? $id_tc = $row['id_tieu_chi'];
                                                                    $list_tc = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia`");
                                                                    while ($item_o = mysql_fetch_assoc($list_tc->result)) {
                                                                    ?>
                                                                        <option value="<?= $item_o['id'] ?>" <?= ($item_o['id'] == $id_tc) ? "selected" : "" ?>><?= $item_o['tieu_chi'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="w-10">
                                                            <p class="he_so" data="<?= $row['he_so'] ?>">x<?= $row['he_so'] ?></p>
                                                        </td>
                                                        <td class="w-10">
                                                            <? $id_tcd = $row['id_tieu_chi'];
                                                            $maxd = new db_query("SELECT MAX(`gia_tri`) AS maxd FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tcd ");
                                                            $maxo = mysql_fetch_assoc($maxd->result)['maxd'];
                                                            ?>
                                                            <input type="number" name="thang_diem" class="diem_lon_nhat hidden_bd" value="<?= $maxo ?>" readonly>
                                                        </td>
                                                        <? if ($row['kieu_gia_tri'] == 1) { ?>
                                                            <td class="w-15">
                                                                <input type="text" name="diem_dgia" class="diem_danh_gia danhg_dc" onkeyup="dien_dgia(this)" oninput="<?= $oninput ?>" value="<?= $row['diem_danh_gia'] ?>">
                                                            </td>
                                                        <? } else if ($row['kieu_gia_tri'] == 2) {
                                                            $tc_dg = $row['id_tieu_chi'];
                                                            $list_gtri = new db_query("SELECT `gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tc_dg ");
                                                        ?>
                                                            <td class="w-15">
                                                                <div class="v-select2">
                                                                    <select name="diem_dgia" class="diem_danh_gia danhg_dc" onchange="dien_dgia(this)">
                                                                        <option value="">Chọn giá trị</option>
                                                                        <? while ($item3 = mysql_fetch_assoc($list_gtri->result)) { ?>
                                                                            <option value="<?= $item3['gia_tri'] ?>" <?= ($row['diem_danh_gia'] == $item3['gia_tri']) ? "selected" : "" ?>><?= $item3['gia_tri'] ?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        <? } ?>
                                                        <td class="w-15">
                                                            <input type="text" name="tongdiem_dg" class="hidden_bd tdiem_dg" value="<?= $row['tong_diem_danh_gia'] ?>" readonly>
                                                        </td>
                                                        <td class="w-15">
                                                            <input type="text" name="dgia_ctiet" value="<?= ($row['danh_gia_chi_tiet'] == '0') ? "" : $row['danh_gia_chi_tiet'] ?>">
                                                        </td>
                                                    </tr>
                                                <? } ?>
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
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn" data-id="<?= $list_dg['id'] ?>">Xong</button>
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
                    <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa phiếu đánh giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="danh-gia-nha-cung-cap.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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
    $("#add-ratting-ruler").click(function() {
        var x = 1;
        $('.one_stt').each(function() {
            $(this).text(x);
            x++;
        });

        $.ajax({
            url: '../ajax/them_tc_dg_ncc.php',
            type: 'POST',
            data: {
                x: x,
            },
            success: function(data) {
                $("#ratting-ruler").append(data);
                RefSelect2();
            }
        });
    });

    $('#nha-cung-cap').on('change', function() {
        var ncc = $(this).val();
        $.ajax({
            url: '../render/tt_nha_cc.php',
            type: 'POST',
            data: {
                id: ncc,
            },
            success: function(data) {
                $('.detail_nhacc').html(data);
            }
        })
    });

    function thay_doi(id) {
        var id_tc = $(id).val();
        var x = $(id).parents(".item").find(".one_stt").text();
        var id_tc_dc = $(id).parents(".item").attr("data1");
        $.ajax({
            url: '../render/dg_tieu_chi_ncc.php',
            type: 'POST',
            data: {
                id_tc: id_tc,
                x: x,
                id_tc_dc: id_tc_dc,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });
    };

    function dien_dgia(id) {
        var dien_danh_gia = Number($(id).parents(".item").find(".diem_danh_gia").val());
        var he_so = Number($(id).parents(".item").find(".he_so").attr("data"));
        var tong_diem = 0;
        var trong = "";
        if (dien_danh_gia != "" && he_so != "") {
            tong_diem = dien_danh_gia * he_so;
            $(id).parents(".item").find(".tdiem_dg").val(tong_diem);
        } else if (dien_danh_gia != "" || he_so != "") {
            $(id).parents(".item").find(".tdiem_dg").val(trong);
        }

        tong_dien_danhgia();
    };

    function tong_dien_danhgia() {
        var tdiem = 0;
        $(".tdiem_dg").each(function() {
            var tong_diem = $(this).val();
            if (tong_diem != "") {
                tdiem += parseInt(tong_diem);
            }
        });

        $("#tongd_dg").val(tdiem);
    }

    $(document).on('click', '.removeItem', function() {
        tong_dien_danhgia();
    });

    $(".remove_btn").click(function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '../ajax/xoa-tcdg-nhacc.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                window.location.reload();
            }
        })
    })

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ngay_lap_phieu: {
                    required: true,
                },
                ngay_danh_gia: {
                    required: true,
                },
                nguoi_danh_gia: {
                    required: true,
                },
                nha_cung_cap: {
                    required: true,
                }

            },
            messages: {
                ngay_lap_phieu: {
                    required: "Ngày lập phiếu không được để trống.",
                },
                ngay_danh_gia: {
                    required: "Ngày đánh giá không được để trống.",
                },
                nguoi_danh_gia: {
                    required: "Người đánh giá không được để trống.",
                },
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                }
            }
        });
        if (form.valid() === true) {
            var nha_cc = $("select[name='nha_cung_cap']").val();
            var dg_khac = $("textarea[name='danh_gia_khac']").val();
            var id_dg = $(this).attr("data-id");
            var user_id = $(".main-form").attr("data1");
            var com_id = $(".main-form").attr("data");
            var phan_quyen_nk = $(".edit-form").attr("data");
            var tong_diem = $("#tongd_dg").val();

            // danh gia cu
            var id = [];
            $("input[name='id_tc']").each(function() {
                var id_ct = $(this).val();
                if (id_ct != "") {
                    id.push(id_ct);
                }
            });

            var tc = [];
            $("select[name='tieu_chi']").each(function() {
                var tieu_chi = $(this).val();
                if (tieu_chi != "") {
                    tc.push(tieu_chi);
                }
            });

            var dg = [];
            $(".danhg_dc").each(function() {
                var diem_dg = $(this).val();
                if (diem_dg != "") {
                    dg.push(diem_dg);
                }
            });

            var td = [];
            $("input[name='tongdiem_dg']").each(function() {
                var tongdiem = $(this).val();
                if (tongdiem != "") {
                    td.push(tongdiem);
                }
            });

            var ct = [];
            $("input[name='dgia_ctiet']").each(function() {
                var dg_ctiet = $(this).val();
                if (dg_ctiet == "") {
                    dg_ctiet = 0;
                    ct.push(dg_ctiet);
                } else {
                    ct.push(dg_ctiet);
                }
            });

            var thangd = [];
            $("input[name='thang_diem']").each(function() {
                var th_d = $(this).val();
                if (th_d != "") {
                    thangd.push(th_d);
                }
            });

            // them moi danh gia
            var n_tc = [];
            $("select[name='ten_tchi_dg']").each(function() {
                var new_tc = $(this).val();
                if (new_tc != "") {
                    n_tc.push(new_tc);
                }
            });

            var n_dg = [];
            $(".dd_gia").each(function() {
                var new_diem_dg = $(this).val();
                if (new_diem_dg != "") {
                    n_dg.push(new_diem_dg);
                }
            });

            var n_td = [];
            $("input[name='tdiem_dg']").each(function() {
                var new_tongd = $(this).val();
                if (new_tongd != "") {
                    n_td.push(new_tongd);
                }
            });

            var n_thd = [];
            $("input[name='thang_diem_m']").each(function() {
                var thd_moi = $(this).val();
                if (thd_moi != "") {
                    n_thd.push(thd_moi);
                }
            });

            var n_ct = [];
            $("input[name='dg_ctiet']").each(function() {
                var new_dg_ctiet = $(this).val();
                if (new_dg_ctiet == "") {
                    new_dg_ctiet = 0;
                    n_ct.push(new_dg_ctiet);
                } else {
                    n_ct.push(new_dg_ctiet);
                }
            });

            $.ajax({
                url: '../ajax/sua_dg_nhacc.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
                    id_dg: id_dg,
                    nha_cc: nha_cc,
                    dg_khac: dg_khac,
                    phan_quyen_nk: phan_quyen_nk,
                    tong_diem: tong_diem,

                    id: id,
                    id_tc: tc,
                    diem_dg: dg,
                    tongdiem: td,
                    th_d: thangd,
                    dg_ctiet: ct,

                    new_tc: n_tc,
                    new_dg: n_dg,
                    new_tongd: n_td,
                    new_dgct: n_ct,
                    new_thd: n_thd,

                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn sửa đánh giá thành công");
                        window.location.href = '/danh-gia-nha-cung-cap.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>