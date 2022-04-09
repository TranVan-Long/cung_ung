<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `ho_so_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hs_tt = explode(',', $item_nv['ho_so_tt']);
            if (in_array(1, $hs_tt) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = $_GET['ht'] : $ht = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($tk != "" && $tk_ct != "") {
    $urll = '/quan-ly-ho-so-thanh-toan.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-ho-so-thanh-toan.html?ht=' . $ht . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id ");
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-ho-so-thanh-toan.html?ht=' . $ht;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id ");
}

$start = ($page - 1) * $ht;
$start = abs($start);

$list_hs = "SELECT `id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`, `tong_tien_tatca`,
            `chi_phi_khac`, `trang_thai` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND `id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND `id_hd_dh` = $tk_ct AND `loai_hs` = 1 ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $tk_ct AND `loai_hs` = 1 ");
    } else if ($tk == 3) {
        $sql = "AND `id_hd_dh` = $tk_ct AND `loai_hs` = 2 ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $tk_ct AND `loai_hs` = 2 ");
    } else if ($tk == 4) {
        $sql = "AND `loai_hs` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_hs` = $tk_ct ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start, $ht";

$list_hs .= $sql;
$list_hs .= $limit;

$all_hs = new db_query($list_hs);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hồ sơ thanh toán</title>
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
    <div class="main-container ql_ho_so_tt ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Hồ sơ thanh toán</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="add_hopd ml_20">
                            <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">&plus; Thêm mới</p>
                                <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                if (in_array(1, $hs_tt)) { ?>
                                    <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">&plus; Thêm mới</p>
                            <? }
                            } ?>
                        </div>

                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Đợt nghiệm thu</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Hợp đồng</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Đơn hàng</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Trạng thái</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_tk">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $gia_tri = new db_query("SELECT `id`, `dot_nghiem_thu` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id ");
                                        while ($row = mysql_fetch_assoc($gia_tri->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['dot_nghiem_thu'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $gia_tri = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_hs` = 1 ");
                                        while ($row = mysql_fetch_assoc($gia_tri->result)) {
                                        ?>
                                            <option value="<?= $row['id_hd_dh'] ?>">HĐ - <?= $row['id_hd_dh'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $gia_tri = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_hs` = 2");
                                        while ($row = mysql_fetch_assoc($gia_tri->result)) {
                                        ?>
                                            <option value="<?= $row['id_hd_dh'] ?>">ĐH - <?= $row['id_hd_dh'] ?></option>
                                        <? }
                                    } else if ($tk == 4) { ?>
                                        <option value="1">Hồ sơ thanh toán hợp đồng</option>
                                        <option value="2">Hồ sơ thanh toán đơn hàng</option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="c-content">
                        <div class="ctn_table_share w_100 float_l">
                            <span class="scroll_left share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên trái"></span>
                            <div class="share_tb_hd w_100 float_l">
                                <table class="table w_100 float_l">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_seven">STT</th>
                                            <th class="share_tb_eight">Đợt nghiệm thu</th>
                                            <th class="share_tb_two">Thời gian nghiệm thu</th>
                                            <th class="share_tb_four">Đơn vị thực hiện</th>
                                            <th class="share_tb_eight">Hợp đồng / Đơn hàng</th>
                                            <th class="share_tb_eight">Thời hạn thanh toán</th>
                                            <th class="share_tb_two">Giá trị thực hiện sau VAT</th>
                                            <th class="share_tb_eight">Giá trị bảo hành</th>
                                            <th class="share_tb_eight">Thu hồi tạm ứng</th>
                                            <th class="share_tb_eight">Đã thanh toán</th>
                                            <th class="share_tb_eight">Còn lại</th>
                                            <th class="share_tb_eight">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $stt = 1;
                                        while ($row2 = mysql_fetch_assoc($all_hs->result)) {
                                            $id_hd_dh = $row2['id_hd_dh'];
                                            if ($row2['loai_hs'] == 1) {
                                                $phan_loai_hd = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `hop_dong` AS h
                                                                                        INNER JOIN `nha_cc_kh` AS n ON h.`id_nha_cc_kh` = n.`id`
                                                                                        WHERE h.`id` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
                                                $ploai_hd = mysql_fetch_assoc($phan_loai_hd->result);
                                                $loai_hd = $ploai_hd['phan_loai'];
                                                if ($loai_hd == 1 || $loai_hd == 3 || $loai_hd == 4) {
                                                    $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];
                                                } else if ($loai_hd == 2) {
                                                    $dv_thuc_hien = $com_name;
                                                };

                                            } else if ($row2['loai_hs'] == 2) {
                                                $phan_loai_dh = new db_query("SELECT d.`phan_loai`, n.`ten_nha_cc_kh` FROM `don_hang` AS d
                                                                                        INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                                                                        WHERE d.`id` = $id_hd_dh AND d.`id_cong_ty` = $com_id ");

                                                $ploai_dh = mysql_fetch_assoc($phan_loai_dh->result);

                                                $loai_dh = $ploai_dh['phan_loai'];
                                                if ($loai_dh == 1) {
                                                    $dv_thuc_hien = $ploai_dh['ten_nha_cc_kh'];
                                                } else if ($loai_dh == 2) {
                                                    $dv_thuc_hien = $com_name;
                                                };
                                            }

                                            $id_hs = $row2['id'];
                                            $check_tt_hs = new db_query("SELECT DISTINCT `id_hs` FROM `chi_tiet_phieu_tt_vt`
                                                                            WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id ");
                                            if (mysql_num_rows($check_tt_hs->result) > 0) {
                                                $tong_tien_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS tong_tien
                                                                    FROM `chi_tiet_phieu_tt_vt` WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id "))->result);
                                                $tong_tien_tt = $tong_tien_tt['tong_tien'];
                                                $tien_con_lai = $row2['tong_tien_tatca'] - $tong_tien_tt;
                                            }else{
                                                $tong_tien_tt = 0;
                                                $tien_con_lai = $row2['tong_tien_tatca'] - $tong_tien_tt;
                                            }

                                        ?>
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <td>
                                                    <a href="chi-tiet-ho-so-thanh-toan-<?= $row2['id'] ?>.html" class="share_clr_four text-500">
                                                        <?= $row2['dot_nghiem_thu'] ?>
                                                    </a>
                                                </td>
                                                <td><?= ($row2['tg_nghiem_thu'] != 0) ? date('d/m/Y', $row2['tg_nghiem_thu']) : "" ?></td>
                                                <td><?= $dv_thuc_hien ?></td>
                                                <? if ($row2['loai_hs'] == 1) { ?>
                                                    <td>HĐ - <?= $row2['id_hd_dh'] ?></td>
                                                <? } else if ($row2['loai_hs'] == 2) { ?>
                                                    <td>ĐH - <?= $row2['id_hd_dh'] ?></td>
                                                <? } ?>
                                                <td><?= ($row2['thoi_han_thanh_toan'] != 0) ? date('d/m/Y', $row2['thoi_han_thanh_toan']) : "" ?></td>
                                                <td><?= number_format($row2['tong_tien_tatca']) ?></td>
                                                <td></td>
                                                <td>0</td>
                                                <td><?= formatMoney($tong_tien_tt) ?></td>
                                                <td><?= formatMoney($tien_con_lai) ?></td>
                                                <? if ($row2['trang_thai'] == 1) { ?>
                                                    <td class="text-red">Chưa hoàn thành</td>
                                                <? } else if ($row2['trang_thai'] == 2) { ?>
                                                    <td class="text-green">Hoàn thành</td>
                                                <? } ?>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <span class="scroll_right share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
                        </div>
                    </div>
                </div>
                <div class="c-foot d_flex flex_jct fl_agi fl_wrap mt_20">
                    <div class="display d_flex fl_agi">
                        <label for="display" class="mr_10">Hiển thị</label>
                        <select name="display" id="display">
                            <option value="10" <?= ($ht == 10) ? "selected" : "" ?>>10</option>
                            <option value="20" <?= ($ht == 20) ? "selected" : "" ?>>20</option>
                        </select>
                    </div>
                    <div class="pagination mt-10">
                        <ul>
                            <?= generatePageBar3('', $page, $ht, $total, $urll, '&', '', 'active', 'preview', '<', 'next', '>', '', '<<<', '', '>>>'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script>
    $(".tim_kiem, .tim_kiem_tk").select2({
        width: '100%',
    });

    $(".add_creart_hd").click(function() {
        window.location.href = "them-ho-so-thanh-toan.html";
    });

    $('.scroll_right').click(function(e) {
        e.preventDefault();
        $('.share_tb_hd').animate({
            scrollLeft: "+=300px"
        }, "slow");
    });

    $('.scroll_left').click(function(e) {
        e.preventDefault();
        $('.share_tb_hd').animate({
            scrollLeft: "-=300px"
        }, "slow");
    });

    $(".tim_kiem").change(function() {
        var tk = $(this).val();
        var tk_ct = $(".tim_kiem_tk").val();
        var ht = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht + "&tk=" + tk;
        } else if (tk == "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht;
        }
    });

    $(".tim_kiem_tk").change(function() {
        var tk = $(".tim_kiem").val();
        var tk_ct = $(this).val();
        var ht = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht + "&tk=" + tk + "&tk_ct=" + tk_ct;
        } else if (tk_ct == "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht + "&tk=" + tk;
        }
    });

    $("#display").change(function() {
        var ht = $(this).val();
        var tk = $(".tim_kiem").val();
        console.log(tk);
        var tk_ct = $(".tim_kiem_tk").val();

        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht + "&tk=" + tk + "&tk_ct=" + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht + "&tk=" + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = "/quan-ly-ho-so-thanh-toan.html?page=" + page + "&ht=" + ht;
        }

    });
</script>

</html>