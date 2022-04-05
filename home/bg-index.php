<?php
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $bao_gia3 = explode(',', $item_nv['bao_gia']);
        if (in_array(1, $bao_gia3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
}


isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = $_GET['ht'] : $ht = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($tk != "" && $tk_ct != "") {
    $urll = '/quan-ly-bao-gia.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-bao-gia.html?ht=' . $ht . '&tk=' . $tk;
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-bao-gia.html?ht=' . $ht;
};

$start = ($page - 1) * $ht;
$start = abs($start);

$list_bg = "SELECT b.`id`, b.`id_yc_bg`, b.`id_nha_cc`, b.`id_nguoi_lap`, b.`ngay_gui`, b.`ngay_bd`, b.`ngay_kt`, n.`ten_nha_cc_kh`
                        FROM `bao_gia` AS b
                        INNER JOIN `nha_cc_kh` AS n ON b.`id_nha_cc` = n.`id`
                        WHERE b.`id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND b.`id_nha_cc` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `bao_gia` WHERE `id_nha_cc` = $tk_ct AND `id_cong_ty` = $com_id ");
    } else if ($tk == 2) {
        $sql = "AND b.`id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `bao_gia` WHERE `id` = $tk_ct AND `id_cong_ty` = $com_id ");
    } else if ($tk == 3) {
        $sql = "AND b.`id_yc_bg` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `bao_gia` WHERE `id_yc_bg` = $tk_ct AND `id_cong_ty` = $com_id ");
    }
};

if ($tk == "" || $tk_ct == "") {
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `bao_gia` WHERE `id_cong_ty` = $com_id ");
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start,$ht";

$list_bg .= $sql;
$list_bg .= $limit;

$bao_gia31 = new db_query($list_bg);

$stt = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết yêu cầu báo giá</title>
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
    <div class="main-container ql_chung">
        <?php include("../includes/sidebar.php") ?>
        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20 d-flex align-items-center spc-btw">
                    <p class="left page-title">Báo giá</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-bao-gia.html">&plus; Thêm mới</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $bao_gia3)) { ?>
                                <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-bao-gia.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="tim_kiem" data="<?= $com_id ?>">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Nhà cung cấp</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Số báo giá</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Số yêu cầu báo giá</option>
                                    <!-- <option value="4">Ngày gửi</option>
                                <option value="5">Ngày áp dụng</option> -->
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="tim_kiem_ctiet">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_nhacc = new db_query("SELECT n.`id`, n.`ten_nha_cc_kh` FROM `bao_gia` AS b INNER JOIN `nha_cc_kh` AS n ON n.`id` = b.`id_nha_cc`
                                                 WHERE n.`phan_loai` = 1 AND b.`id_cong_ty` = $com_id ");
                                        while ($row = mysql_fetch_assoc($list_nhacc->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $tk_ct) ? "selected" : "" ?>><?= $row['ten_nha_cc_kh'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_sobg = new db_query("SELECT `id` FROM `bao_gia` WHERE `id_cong_ty` = $com_id ");
                                        while ($row1 = mysql_fetch_assoc($list_sobg->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>BG - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_ycbg = new db_query("SELECT DISTINCT `id_yc_bg` FROM `bao_gia` WHERE `id_cong_ty` = $com_id ");
                                        while ($row2 = mysql_fetch_assoc($list_ycbg->result)) {
                                        ?>
                                            <option value="<?= $row2['id_yc_bg'] ?>" <?= ($row2['id_yc_bg'] == $tk_ct) ? "selected" : "" ?>>YC - <?= $row2['id_yc_bg'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left share_dnone" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper" data="<?= $page ?>" data1="<?= $ht ?>" onscroll="table_scroll(this)">
                            <div class="table-container table-1428">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-15">STT</th>
                                                <th class="w-30">Nhà cung cấp</th>
                                                <th class="w-20">Số báo giá</th>
                                                <th class="w-30">Theo yêu cầu báo giá số</th>
                                                <th class="w-20">Ngày gửi</th>
                                                <th class="w-40">Ngày áp dụng</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <? while ($item = mysql_fetch_assoc($bao_gia31->result)) { ?>
                                                <tr>
                                                    <td class="w-15"><?= $stt++ ?></td>
                                                    <td class="w-30"><?= $item['ten_nha_cc_kh'] ?></td>
                                                    <td class="w-20"><a href="chi-tiet-bao-gia-<?= $item['id'] ?>.html" class="text-500">BG-<?= $item['id'] ?></a></td>
                                                    <td class="w-30">YC-<?= $item['id_yc_bg'] ?></td>
                                                    <td class="w-20"><?= date('d/m/Y', $item['ngay_gui']) ?></td>
                                                    <? if ($item['ngay_bd'] != 0 && $item['ngay_kt'] != 0) { ?>
                                                        <td class="w-40"><?= date('d/m/Y', $item['ngay_bd']) ?> - <?= date('d/m/Y', $item['ngay_kt']) ?></td>
                                                    <? } else if ($item['ngay_bd'] != 0 && $item['ngay_kt'] == 0) { ?>
                                                        <td class="w-40">Từ: <?= date('d/m/Y', $item['ngay_bd']) ?></td>
                                                    <? } else if ($item['ngay_bd'] == 0 && $item['ngay_kt'] != 0) { ?>
                                                        <td class="w-40">Đến: <?= date('d/m/Y', $item['ngay_kt']) ?></td>
                                                    <? } else if ($item['ngay_bd'] == 0 && $item['ngay_kt'] == 0) { ?>
                                                        <td class="w-40"></td>
                                                    <? } ?>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left mt-10 d-flex flex-wrap spc-btw">
                    <div class="display mr-10">
                        <label for="display">Hiển thị</label>
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
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $("#tim_kiem").change(function() {
        var tk = $(this).val();
        var tk_ct = $("#tim_kiem_ctiet").val();
        var page = $(".table-wrapper").attr("data");
        var ht = $(".table-wrapper").attr("data1");
        if (tk != "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page;
        }
    });

    $("#tim_kiem_ctiet").change(function() {
        var tk_ct = $(this).val();
        var tk = $("#tim_kiem").val();
        var page = $(".table-wrapper").attr("data");
        var ht = $(".table-wrapper").attr("data1");
        if (tk_ct != "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#display").change(function() {
        var ht = $(this).val();
        var tk = $("#tim_kiem").val();
        var tk_ct = $("#tim_kiem_ctiet").val();
        var page = $(".table-wrapper").attr("data");
        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-bao-gia.html?ht=' + ht + '&page=' + page;
        }
    });
</script>

</html>