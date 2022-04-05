<?php
include("../includes/icon.php");
include("config.php");

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

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($tk != "" && $tk_ct != "") {
    $url = '/quan-ly-nha-cung-cap.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk == "" && $tk_ct == "") {
    $url = '/quan-ly-nha-cung-cap.html?currP=' . $currP;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");
} else if ($tk != "" && $tk_ct == "") {
    $url = '/quan-ly-nha-cung-cap.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_ncc = "SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `dia_chi_lh`, `so_dkkd`, `sp_cung_ung`, `ma_so_thue` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk != "") {
        $sql = "AND `id` = $tk_ct";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id AND `id` = $tk_ct");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];
$limit = " LIMIT $start,$currP";
$list_ncc .= $sql;
$list_ncc .= " ORDER BY `id` ASC";
$list_ncc .= $limit;

$ncc_data = new db_query($list_ncc);

$stt = 1;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhà cung cấp</title>
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
                    <p class="left page-title">Nhà cung cấp</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-nha-cung-cap.html">&plus; Thêm mới</a>
                         <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                if (in_array(2, $ncc3)) { ?>
                                    <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-nha-cung-cap.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Mã nhà cung cấp</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Tên nhà cung cấp</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Số ĐKKD</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Mã số thuế</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_vt = new db_query("SELECT `id` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                    ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>NCC - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_vt = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_vt = new db_query("SELECT `id`,`so_dkkd` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>><?= $row1['so_dkkd'] ?></option>
                                        <? }
                                    } else if ($tk == 4) {
                                        $list_vt = new db_query("SELECT `id`,`ma_so_thue` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>><?= $row1['ma_so_thue'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper" onscroll="table_scroll(this)">
                            <div class="table-container table_1928">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-5">STT</th>
                                                <th class="w-10">Mã nhà cung cấp</th>
                                                <th class="w-10">Tên gọi tắt</th>
                                                <th class="w-15">Tên nhà cung cấp</th>
                                                <th class="w-20">Địa chỉ</th>
                                                <th class="w-10">Số ĐKKD</th>
                                                <th class="w-10">Sản phẩm cung ứng</th>
                                                <th class="w-10">Mã số thuế</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <?
                                            $stt = 1;
                                            while ($ncc_fetch = mysql_fetch_assoc($ncc_data->result)) {
                                            ?>
                                                <tr>
                                                    <td class="w-5"><?= $stt++ ?></td>
                                                    <td class="w-10">
                                                        <a href="quan-ly-chi-tiet-nha-cung-cap-<?= $ncc_fetch['id'] ?>.html" class="text-bold">NCC - <?= $ncc_fetch['id'] ?></a>
                                                    </td>
                                                    <td class="w-10"><?= $ncc_fetch['ten_vt'] ?></td>
                                                    <td class="w-15"><?= $ncc_fetch['ten_nha_cc_kh'] ?></td>
                                                    <td class="w-20"><?= $ncc_fetch['dia_chi_lh'] ?></td>
                                                    <td class="w-10"><?= $ncc_fetch['so_dkkd'] ?></td>
                                                    <td class="w-10"><?= $ncc_fetch['sp_cung_ung'] ?></td>
                                                    <td class="w-10"><?= $ncc_fetch['ma_so_thue'] ?></td>
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
                            <option value="10" <?= ($currP == 10) ? "selected" : "" ?>>10</option>
                            <option value="20" <?= ($currP == 20) ? "selected" : "" ?>>20</option>
                        </select>
                    </div>
                    <div class="pagination mt-10">
                        <ul>
                            <?= generatePageBar3('', $page, $currP, $total, $url, '&', '', 'active', 'preview', '<', 'next', '>', '', '<<<', '', '>>>'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../modals/modal_logout.php") ?>
    <? include("../modals/modal_menu.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&page=' + page;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-nha-cung-cap.html?currP=' + currP + '&page=' + page;
        }
    });
</script>

</html>