<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `khach_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $khach_hang = explode(',', $item_nv['khach_hang']);
            if (in_array(1, $khach_hang) == FALSE) {
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
    $urll = '/quan-ly-khach-hang.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-khach-hang.html?ht=' . $ht . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ");
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-khach-hang.html?ht=' . $ht;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $ht;
$start = abs($start);

$list_kh = "SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `dia_chi_lh`, `so_dien_thoai`, `email`, `phan_loai`
            FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND `id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id AND `id` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND `so_dien_thoai` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id AND `so_dien_thoai` = $tk_ct ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start, $ht ";

$list_kh .= $sql;
$list_kh .= $limit;

$all_kh = new db_query($list_kh);

$stt = 1;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý khách hàng</title>
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
                    <p class="left page-title">Khách hàng</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20  mt-20" href="them-khach-hang.html">&plus; Thêm mới</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $khach_hang)) { ?>
                                <a class="v-btn btn-blue add-btn ml-20  mt-20" href="them-khach-hang.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select danh_muc">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Tên khách hàng</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Số điện thoại</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select dm_timkiem">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $ds_kh = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id");
                                        while ($row = mysql_fetch_assoc($ds_kh->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($tk_ct == $row['id']) ? "selected" : "" ?>>(<?= $row['id'] ?>) <?= $row['ten_nha_cc_kh'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $ds_kh1 = new db_query("SELECT DISTINCT `so_dien_thoai` FROM `nha_cc_kh` WHERE `phan_loai` = 2 AND `id_cong_ty` = $com_id AND `so_dien_thoai` != '' ");
                                        while ($row1 = mysql_fetch_assoc($ds_kh1->result)) {
                                        ?>
                                            <option value="<?= $row1['so_dien_thoai'] ?>" <?= ($tk_ct == $row1['so_dien_thoai']) ? "selected" : "" ?>><?= $row1['so_dien_thoai'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="danh_sach_kh w_100 float_l" data="<?= $page ?>">
                        <div class="scr-wrapper mt-20">
                            <? if ($total >= 5) { ?>
                                <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                                <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                            <? } ?>
                            <div class="table-wrapper" onscroll="table_scroll(this)">
                                <div class="table-container table_1457">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5">STT</th>
                                                    <th class="w-10">Mã khách hàng</th>
                                                    <th class="w-10">Tên gọi tắt</th>
                                                    <th class="w-15">Tên khách hàng</th>
                                                    <th class="w-25">Địa chỉ liên hệ</th>
                                                    <th class="w-10">Mã số thuế</th>
                                                    <th class="w-10">Điện thoại</th>
                                                    <th class="w-15">Email</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content">
                                        <table>
                                            <tbody>
                                                <? while ($row2 = mysql_fetch_assoc($all_kh->result)) { ?>
                                                    <tr>
                                                        <td class="w-5"><?= $stt++ ?></td>
                                                        <td class="w-10">
                                                            <a href="quan-ly-chi-tiet-khach-hang-<?= $row2['id'] ?>.html" class="text-500">KH - <?= $row2['id'] ?></a>
                                                        </td>
                                                        <td class="w-10"><?= $row2['ten_vt'] ?></td>
                                                        <td class="w-15"><?= $row2['ten_nha_cc_kh'] ?></td>
                                                        <td class="w-25"><?= $row2['dia_chi_lh'] ?></td>
                                                        <td class="w-10"><?= $row2['ma_so_thue'] ?></td>
                                                        <td class="w-10"><?= $row2['so_dien_thoai'] ?></td>
                                                        <td class="w-15"><?= $row2['email'] ?></td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
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
    $(".danh_muc").change(function() {
        var tk = $(this).val();
        var page = $(".danh_sach_kh").attr("data");
        var ht = $("#display").val();

        if (tk != "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page;
        }
    });

    $(".dm_timkiem").change(function() {
        var tk = $(".danh_muc").val();
        var tk_ct = $(this).val();
        var page = 1;
        var ht = $("#display").val();

        if (tk_ct != "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#display").change(function() {
        var tk = $(".danh_muc").val();
        var tk_ct = $(".dm_timkiem").val();
        var page = 1;
        var ht = $(this).val();

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-khach-hang.html?ht=' + ht + '&page=' + page;
        }
    });
</script>

</html>