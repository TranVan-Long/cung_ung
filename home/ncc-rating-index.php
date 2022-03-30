<?php
include("config.php");
include("../includes/icon.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
    }
};

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = $_GET['ht'] : $ht = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

$start = ($page - 1) * $ht;
$start = abs($start);

if ($tk != "" && $tk_ct != "") {
    $urll = '/danh-gia-nha-cung-cap.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/danh-gia-nha-cung-cap.html?ht=' . $ht . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `danh_gia` WHERE `id_cong_ty` = $com_id ");
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/danh-gia-nha-cung-cap.html?ht=' . $ht;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `danh_gia` WHERE `id_cong_ty` = $com_id ");
};

$list_danhgia = "SELECT d.`id`, d.`ngay_danh_gia`, d.`id_nha_cc`, d.`danh_gia_khac`, d.`tong_diem`, n.`ten_nha_cc_kh`
                FROM `danh_gia` AS d INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id` WHERE d.`id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND `id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `danh_gia` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND `id_nha_cc` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `danh_gia` WHERE `id_cong_ty` = $com_id AND `id_nha_cc` = $tk_ct ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start, $ht";

$list_danhgia .= $sql;
$list_danhgia .= $limit;

$all_danhgia = new db_query($list_danhgia);

$stt = 1;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đánh giá nhà cung cấp</title>
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
                    <h4 class="left page-title">Đánh giá nhà cung cấp</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-danh-gia-nha-cung-cap.html">&plus; Thêm mới</a>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Số phiếu</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Nhà cung cấp</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select search_tt">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_danhg = new db_query("SELECT `id` FROM `danh_gia` WHERE `id_cong_ty` = $com_id ");
                                        while ($row1 = mysql_fetch_assoc($list_danhg->result)) {
                                    ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($tk_ct == $row1['id']) ? "selected" : "" ?>>PH - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_danhg1 = new db_query("SELECT DISTINCT d.`id_nha_cc`, n.`ten_nha_cc_kh` FROM `danh_gia` AS d
                                                                    INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id`
                                                                    WHERE d.`id_cong_ty` = $com_id AND n.`phan_loai` = 1 ");
                                        while ($row2 = mysql_fetch_assoc($list_danhg1->result)) {
                                        ?>
                                            <option value="<?= $row2['id_nha_cc'] ?>" <?= ($tk_ct == $row2['id_nha_cc']) ? "selected" : "" ?>><?= $row2['ten_nha_cc_kh'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="danh_sach_dg w_100 float_l" data="<?= $page ?>">
                        <div class="scr-wrapper mt-20">
                            <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                            <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                            <div class="table-wrapper" onscroll="table_scroll(this)">
                                <div class="table-container table-1074">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5">STT</th>
                                                    <th class="w-15">Số phiếu</th>
                                                    <th class="w-10">Ngày đánh giá</th>
                                                    <th class="w-15">Nhà cung cấp</th>
                                                    <th class="w-5">Điểm</th>
                                                    <th class="w-20">Đánh giá khác</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content">
                                        <table>
                                            <tbody>
                                                <?
                                                while ($danh_gia = mysql_fetch_assoc($all_danhgia->result)) {
                                                    $danh_gia_id = $danh_gia["id"];
                                                    $tong_diem = mysql_fetch_assoc((new db_query("SELECT SUM(`diem_danh_gia`) AS sumt, SUM(`thang_diem`) AS sum_td FROM `chi_tiet_danh_gia` WHERE `id_danh_gia` = $danh_gia_id "))->result);
                                                    $diem_one = $tong_diem['sumt'];
                                                    $diemt_two = $tong_diem['sum_td'];
                                                ?>
                                                    <tr>
                                                        <td class="w-5"><?= $stt++ ?></td>
                                                        <td class="w-15">
                                                            <a href="chi-tiet-danh-gia-nha-cung-cap-<?= $danh_gia_id ?>.html" class="text-500">PH-<?= $danh_gia['id'] ?></a>
                                                        </td>
                                                        <td class="w-10"><?= date('d-m-Y', $danh_gia['ngay_danh_gia']) ?></td>
                                                        <td class="w-15"><?= $danh_gia['ten_nha_cc_kh'] ?></td>
                                                        <td class="w-5"><?= $diem_one ?>/<?= $diemt_two ?></td>
                                                        <td class="w-20"><?= $danh_gia['danh_gia_khac'] ?></td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 left mt-10 d-flex flex-wrap spc-btw">
                            <!-- <div class="w-100 left mt-10 spc-btw"> -->
                            <div class="display mr-10">
                                <label for="display">Hiển thị</label>
                                <select name="display" id="display">
                                    <option value="10" <?= ($ht == 10) ? "selected" : "" ?>>10</option>
                                    <option value="20" <?= ($ht == 20) ? "selected" : "" ?>>20</option>
                                </select>
                            </div>
                            <div class="pagination right mt-10">
                                <ul>
                                    <?= generatePageBar3('', $page, $ht, $total, $urll, '&', '', 'active', 'preview', '<', 'next', '>', '', '<<<', '', '>>>'); ?>
                                </ul>
                            </div>
                        </div>
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
<script type="text/javascript">
    var timkiem = $(".tim_kiem").val();
    var search_tt = $(".search_tt").val();
    var page = $(".danh_sach_dg").attr("data");
    var ht = $(".danh_sach_dg").attr("data1");

    $(".tim_kiem").change(function() {
        var tk = $(this).val();
        var page = $(".danh_sach_dg").attr("data");
        var ht = $("#display").val();

        if (tk != "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page;
        }
    });

    $(".search_tt").change(function() {
        var tk_ct = $(this).val();
        var tk = $(".tim_kiem").val();
        var page = 1;
        var ht = $("#display").val();

        if (tk_ct != "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk_ct == "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#display").change(function() {
        var ht = $(this).val();
        var tk = $(".tim_kiem").val();
        var page = 1;
        var tk_ct = $(".search_tt").val();

        if (tk != "" && tk_ct != "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/danh-gia-nha-cung-cap.html?ht=' + ht + '&page=' + page;
        }
    });
</script>

</html>