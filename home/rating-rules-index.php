<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `tieu_chi_danh_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $tieu_chi_dg = explode(',', $item_nv['tieu_chi_danh_gia']);
            if (in_array(1, $tieu_chi_dg) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($tk != "" && $tk_ct != "") {
    $url = '/tieu-chi-danh-gia.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk == "" && $tk_ct == "") {
    $url = '/tieu-chi-danh-gia.html?currP=' . $currP;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id ");
} else if ($tk != "" && $tk_ct == "") {
    $url = '/tieu-chi-danh-gia.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_tc = "SELECT * FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND `id` = $tk_ct";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id  AND `id` = $tk_ct");
    } elseif ($tk == 2) {
        $sql = "AND `kieu_gia_tri` = $tk_ct";
        $cou = new db_query("SELECT COUNT(`kieu_gia_tri`) AS total FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id  AND `kieu_gia_tri` = $tk_ct");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];
$limit = " LIMIT $start,$currP";
$list_tc .= $sql;
$list_tc .= " ORDER BY `id` ASC";
$list_tc .= $limit;

$tc_data = new db_query($list_tc);

$stt = 1;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiêu chí đánh giá</title>
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
                    <p class="left page-title">Đánh giá nhà cung cấp</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-tieu-chi-danh-gia.html">&plus; Thêm mới</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $tieu_chi_dg)) {  ?>
                                <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-tieu-chi-danh-gia.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Tiêu chí đánh giá</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Kiểu giá trị</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_vt = new db_query("SELECT `id`, `tieu_chi` FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                    ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>><?= $row1['tieu_chi'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_vt = new db_query("SELECT DISTINCT `kieu_gia_tri` FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['kieu_gia_tri'] ?>" <?= ($row1['kieu_gia_tri'] == $tk_ct) ? "selected" : "" ?>><?= ($row1['kieu_gia_tri'] == 1) ? "Nhập tay" : "Danh sách"; ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrapper left w-100 mt-20">
                        <div class="table-container table-988">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="w-10">STT</th>
                                            <th rowspan="2">Tiêu chí đánh giá</th>
                                            <th rowspan="2" class="w-10">Hệ số</th>
                                            <th rowspan="2">Kiểu giá trị</th>
                                            <th class="border-bottom-w" colspan="2" scope="colgroup">Danh sách giá trị</th>
                                        </tr>
                                        <tr>
                                            <th scope="colgroup">Giá trị</th>
                                            <th scope="colgroup">Tên hiển thị</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                        <?
                                        while ($tieu_chi = mysql_fetch_assoc($tc_data->result)) {
                                            $tieu_chi_id = $tieu_chi['id'];
                                        ?>
                                            <tr class="more">
                                                <td class="w-10"><?= $stt++ ?></td>
                                                <td><?= $tieu_chi['tieu_chi'] ?></td>
                                                <td class="w-10"><?= $tieu_chi['he_so'] ?></td>
                                                <td><? echo ($tieu_chi['kieu_gia_tri'] == 1) ? "Nhập tay" : "Danh sách"; ?></td>
                                                <td>
                                                    <? $list_gt = new db_query("SELECT `id_tieu_chi`, `gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tieu_chi_id ");
                                                    while ($gia_tri_c = mysql_fetch_assoc($list_gt->result)) { ?>
                                                        <p class="table-text"><?= $gia_tri_c['gia_tri'] ?></p>
                                                    <? } ?>
                                                </td>
                                                <td>
                                                    <? $list_gt_n = new db_query("SELECT `ten_gia_tri`, `id_tieu_chi` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tieu_chi_id ");
                                                    while ($gia_tri = mysql_fetch_assoc($list_gt_n->result)) { ?>
                                                        <p class="table-text"><?= $gia_tri['ten_gia_tri'] ?></p>
                                                    <? } ?>
                                                    <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                                        <span class="tbl-menu" data-tab="<?= $tieu_chi_id ?>"></span>
                                                        <ul class="tbl-menu-content" id="<?= $tieu_chi_id ?>">
                                                            <li class="mb-10"><a href="chinh-sua-tieu-chi-danh-gia-<?= $tieu_chi_id ?>.html" class="tbl-menu-text">Chỉnh sửa</a></li>
                                                            <li class="border-top2">
                                                                <p class="tbl-menu-text modal-btn mt-10" data-target="modal-<?= $tieu_chi_id ?>">Xóa</p>
                                                            </li>
                                                        </ul>
                                                        <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                                        if (in_array(3, $tieu_chi_dg) || in_array(4, $tieu_chi_dg)) { ?>
                                                            <span class="tbl-menu" data-tab="<?= $tieu_chi_id ?>"></span>
                                                        <? } ?>
                                                        <ul class="tbl-menu-content" id="<?= $tieu_chi_id ?>">
                                                            <? if (in_array(3, $tieu_chi_dg)) { ?>
                                                                <li class="mb-10"><a href="chinh-sua-tieu-chi-danh-gia-<?= $tieu_chi_id ?>.html" class="tbl-menu-text">Chỉnh sửa</a></li>
                                                            <? }
                                                            if (in_array(4, $tieu_chi_dg)) { ?>
                                                                <li class="border-top2">
                                                                    <p class="tbl-menu-text modal-btn mt-10" data-target="modal-<?= $tieu_chi_id ?>">Xóa</p>
                                                                </li>
                                                            <? } ?>
                                                        </ul>
                                                    <? } ?>
                                                    <div class="modal text-center" id="modal-<?= $tieu_chi_id ?>">
                                                        <div class="m-content huy-them">
                                                            <div class="m-head ">
                                                                Xóa tiêu chí <span class="dismiss cancel">&times;</span>
                                                            </div>
                                                            <div class="m-body">
                                                                <p>Bạn có chắc chắn muốn xóa tiêu chí đánh giá này?</p>
                                                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                            </div>
                                                            <div class="m-foot d-inline-block">
                                                                <div class="left">
                                                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                                </div>
                                                                <div class="right">
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right delete-tc" data-id="<?= $tieu_chi_id ?>">Đồng ý</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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
                            <option value="10" <?= ($currP == 10) ? "selected" : "" ?>>10</option>
                            <option value="20" <?= ($currP == 20) ? "selected" : "" ?>>20</option>
                        </select>
                    </div>
                    <div class="pagination mt-10">
                        <ul>
                            <?= generatePageBar3('', $page, $currP, $total, $urll, '&', '', 'active', 'preview', '<', 'next', '>', '', '<<<', '', '>>>'); ?>
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
    var tblMenu = $('td .tbl-menu');
    var tblMenuContent = $('td .tbl-menu-content');
    var count = 0;

    $('.tbl-menu').click(function() {
        $(this).parents("td").find(".tbl-menu-content").toggleClass('active');
    });
    $(window).click(function(e) {
        if (!tblMenu.is(e.target) && !tblMenuContent.is(e.target) && tblMenuContent.has(e.target).length === 0) {
            tblMenuContent.removeClass('active');
        }
    })

    $('.tbl-menu').click(function() {
        var id = $(this).attr("data-tab");

        $(".tbl-menu-content").removeClass("active");

        $('#' + id).addClass("active");
    })
    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&page=' + page;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk_ct == "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/tieu-chi-danh-gia.html?currP=' + currP + '&page=' + page;
        }
    });
    $(".delete-tc").click(function() {
        var id = $(this).attr("data-id");
        var ep_id = '<?= $user_id ?>';
        $.ajax({
            url: '../ajax/tc_xoa.php',
            type: 'POST',
            data: {
                id: id,
                ep_id: ep_id
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert("Xóa tiêu chí thất bại.");
                }
            }
        });
    })
</script>

</html>