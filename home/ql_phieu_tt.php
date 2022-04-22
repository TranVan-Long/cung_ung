<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `phieu_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $phieu_tt2 = explode(',', $item_nv['phieu_tt']);
            if (in_array(1, $phieu_tt2) == FALSE) {
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
    $urll = '/quan-ly-phieu-thanh-toan.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-phieu-thanh-toan.html?ht=' . $ht . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id ");
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-phieu-thanh-toan.html?ht=' . $ht;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $ht;
$start = abs($start);

$list_phieu = "SELECT p.`id`, p.`id_hd_dh`, p.`id_ncc_kh`, p.`loai_phieu_tt`, p.`ngay_thanh_toan`, p.`loai_thanh_toan`, p.`so_tien`,
                p.`gia_tri_quy_doi`, p.`phan_loai`, n.`ten_nha_cc_kh`
                FROM `phieu_thanh_toan` AS p INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                WHERE p.`id_cong_ty` = $com_id  ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND p.`id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND p.`loai_thanh_toan` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = $tk_ct ");
    } else if ($tk == 3) {
        $sql = "AND p.`id_ncc_kh` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id_ncc_kh` = $tk_ct ");
    } else if ($tk == 4) {
        $sql = "AND p.`id_hd_dh` = $tk_ct AND p.`loai_phieu_tt` = 1 ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $tk_ct AND `loai_phieu_tt` = 1 ");
    } else if ($tk == 5) {
        $sql = "AND p.`id_hd_dh` = $tk_ct AND p.`loai_phieu_tt` = 2 ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $tk_ct AND `loai_phieu_tt` = 2 ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start, $ht ";

$list_phieu .= $sql;
$list_phieu .= $limit;

$all_phieu = new db_query($list_phieu);

$all_ploai = array(
    1 => 'Hợp đồng mua vật tư',
    2 => 'Hợp đồng bán vật tư',
    3 => 'Hợp đồng thuê thiết bị',
    4 => 'Hợp đồng thuê vận chuyển',
    5 => 'Đơn hàng mua vật tư',
    6 => 'Đơn hàng bán vật tư',
);

$stt = 1;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phiếu thanh toán</title>
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
    <div class="main-container ql_phieu_tt ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Phiếu thanh toán</h4>
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
                                if (in_array(2, $phieu_tt2)) { ?>
                                    <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">&plus; Thêm mới</p>
                            <? }
                            } ?>
                        </div>
                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Số phiếu thanh toán</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Loại thanh toán</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Nhà cung cấp / Khách hàng</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Hợp đồng</option>
                                    <option value="5" <?= ($tk == 5) ? "selected" : "" ?>>Đơn hàng</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_ct">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_ph = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id ");
                                        while ($row = mysql_fetch_assoc($list_ph->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($tk_ct == $row['id']) ? "selected" : "" ?>>PH - <?= $row['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) { ?>
                                        <option value="1" <?= ($tk_ct == 1) ? "selected" : "" ?>>Tạm ứng</option>
                                        <option value="2" <?= ($tk_ct == 2) ? "selected" : "" ?>>Theo hợp đồng</option>
                                        <? } else if ($tk == 3) {
                                        $list_ncc_kh = new db_query("SELECT DISTINCT p.`id_ncc_kh`, n.`ten_nha_cc_kh` FROM `phieu_thanh_toan` AS p
                                                                    INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                                                                    WHERE p.`id_cong_ty` = $com_id ");
                                        while ($row1 = mysql_fetch_assoc($list_ncc_kh->result)) {
                                        ?>
                                            <option value="<?= $row1['id_ncc_kh'] ?>" <?= ($tk_ct == $row1['id_ncc_kh']) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                        <? }
                                    } else if ($tk == 4) {
                                        $list_hd = new db_query("SELECT `id_hd_dh` FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_phieu_tt` = 1 ");
                                        while ($row2 = mysql_fetch_assoc($list_hd->result)) {
                                        ?>
                                            <option value="<?= $row2['id_hd_dh'] ?>" <?= ($tk_ct == $row2['id_hd_dh']) ? "selected" : "" ?>>HĐ - <?= $row2['id_hd_dh'] ?></option>
                                        <? }
                                    } else if ($tk == 5) {
                                        $list_dh = new db_query("SELECT `id_hd_dh` FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_phieu_tt` = 2 ");
                                        while ($row3 = mysql_fetch_assoc($list_dh->result)) {
                                        ?>
                                            <option value="<?= $row3['id_hd_dh'] ?>" <?= ($tk_ct == $row3['id_hd_dh']) ? "selected" : "" ?>>ĐH - <?= $row3['id_hd_dh'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="c-content">
                        <div class="ctn_table_share w_100 float_l">
                            <span class="scroll_left share_cursor share_dnone" onclick="pre_sc(this)"><img src="../img/right_scroll.png" alt="scroll về bên trái"></span>
                            <div class="share_tb_hd w_100 float_l" onscroll="table_scroll_sc(this)">
                                <table class="table w_100 float_l">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one" rowspan="2">STT</th>
                                            <th class="share_tb_two" rowspan="2">Số phiếu</th>
                                            <th class="share_tb_two" rowspan="2">Loại thanh toán</th>
                                            <th class="share_tb_two" rowspan="2">Ngày thanh toán</th>
                                            <th class="share_tb_two" rowspan="2">Hợp đồng / Đơn hàng</th>
                                            <th class="share_tb_three" rowspan="2">Nhà cung cấp / Khách hàng</th>
                                            <th class="share_tb_two" rowspan="2">Loại hợp đồng</th>
                                            <th class="share_tb_six sh_bor_b" colspan="3">Số tiền (VNĐ)</th>
                                        </tr>
                                        <tr>
                                            <th class="share_tb_two">Tạm ứng</th>
                                            <th class="share_tb_two">Thu ứng</th>
                                            <th class="share_tb_two">Theo hợp đồng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($item1 = mysql_fetch_assoc($all_phieu->result)) { ?>
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <? if ($item1['loai_thanh_toan'] == 1) { ?>
                                                    <td><a href="chi-tiet-phieu-thanh-toan-tam-ung-<?= $item1['id'] ?>.html" class="share_clr_four cr_weight">PH - <?= $item1['id'] ?></a></td>
                                                    <td>Tạm ứng</td>
                                                <? } else if ($item1['loai_thanh_toan'] == 2) { ?>
                                                    <td><a href="chi-tiet-phieu-thanh-toan-<?= $item1['id'] ?>.html" class="share_clr_four cr_weight">PH - <?= $item1['id'] ?></a></td>
                                                    <td>Theo hợp đồng</td>
                                                <? } ?>
                                                <td><?= ($item1['ngay_thanh_toan'] != 0) ? date('d/m/Y', $item1['ngay_thanh_toan']) : "" ?></td>
                                                <? if ($item1['loai_phieu_tt'] == 1) { ?>
                                                    <td>HĐ - <?= $item1['id_hd_dh'] ?></td>
                                                <? } else if ($item1['loai_phieu_tt'] == 2) { ?>
                                                    <td>ĐH - <?= $item1['id_hd_dh'] ?></td>
                                                <? } ?>
                                                <td><?= $item1['ten_nha_cc_kh'] ?></td>
                                                <td><?= $all_ploai[$item1['phan_loai']] ?></td>
                                                <? if ($item1['loai_thanh_toan'] == 1) { ?>
                                                    <td><?= ($item1['gia_tri_quy_doi'] != 0) ? number_format($item1['gia_tri_quy_doi']) : "" ?></td>
                                                <? } else if ($item1['loai_thanh_toan'] == 2) { ?>
                                                    <td></td>
                                                <? } ?>

                                                <td></td>
                                                <? if ($item1['loai_thanh_toan'] == 2) { ?>
                                                    <td><?= ($item1['so_tien'] != 0) ? number_format($item1['so_tien']) : "" ?></td>
                                                <? } else if ($item1['loai_thanh_toan'] == 1) { ?>
                                                    <td></td>
                                                <? } ?>

                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <span class="scroll_right share_cursor" onclick="next_sc(this)"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
                        </div>
                    </div>
                </div>
                <div class="c-foot d_flex flex_jct fl_agi mt_20 fl_wrap">
                    <div class="display d_flex fl_agi">
                        <label for="display" class="mr_10">Hiển thị</label>
                        <select name="display" id="display">
                            <option value="10" <?= ($ht == 10) ? 'selected' : '' ?>>10</option>
                            <option value="20" <?= ($ht == 20) ? 'selected' : '' ?>>20</option>
                        </select>
                    </div>
                    <div class="pagination mt_10">
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
    $(".tim_kiem, .tim_kiem_ct").select2({
        width: '100%',
    });

    $(".add_creart_hd").click(function() {
        window.location.href = "them-phieu-thanh-toan.html";
    });

    // $('.scroll_right').click(function(e) {
    //     e.preventDefault();
    //     $('.share_tb_hd').animate({
    //         scrollLeft: "+=300px"
    //     }, "slow");
    // });

    // $('.scroll_left').click(function(e) {
    //     e.preventDefault();
    //     $('.share_tb_hd').animate({
    //         scrollLeft: "-=300px"
    //     }, "slow");
    // });

    $(".tim_kiem").change(function() {
        var tk = $(this).val();
        var page = 1;
        var ht = $("#display").val();
        if (tk != "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page;
        }
    });

    $(".tim_kiem_ct").change(function() {
        var tk_ct = $(this).val();
        var tk = $(".tim_kiem").val();
        var page = 1;
        var ht = $("#display").val();
        if (tk_ct != "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#display").change(function() {
        var ht = $(this).val();
        var tk = $(".tim_kiem").val();
        var tk_ct = $(".tim_kiem_ct").val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-phieu-thanh-toan.html?ht=' + ht + '&page=' + page;
        }
    });
</script>

</html>