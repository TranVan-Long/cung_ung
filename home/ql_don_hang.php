<?php
include "../includes/icon.php";
include("config.php");

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = $_GET['ht'] : $ht = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang2 = explode(',', $item_nv['don_hang']);
            if (in_array(1, $don_hang2) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
} else {
    header('Location: /');
}

if ($tk != "" && $tk_ct != "") {
    $urll = '/quan-ly-don-hang.html?ht=' . $ht . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-don-hang.html?ht=' . $ht . '&tk=' . $tk;
} else if ($tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-don-hang.html?ht=' . $ht;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `don_hang` WHERE `id_cong_ty` = $com_id");
}

$start = ($page - 1) * $ht;
$start = abs($start);

$list_dh = "SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_hop_dong`, d.`id_du_an_ctrinh`,d.`gia_tri_svat`, d.`ngay_ky`, d.`thoi_han`, d.`phan_loai`, n.`ten_nha_cc_kh`
            FROM `don_hang` AS d
            INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
            WHERE d.`id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND d.`id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `don_hang` WHERE `id` = $tk_ct AND `id_cong_ty` = $com_id ");
    } else if ($tk == 2) {
        $ngay_ky = strtotime($tk_ct);
        $sql = "AND d.`ngay_ky` = $ngay_ky ";
        $cou = new db_query("SELECT COUNT(`ngay_ky`) AS total FROM `don_hang` WHERE `ngay_ky` = $ngay_ky AND `id_cong_ty` = $com_id ");
    } else if ($tk == 3) {
        $thoi_han = strtotime($tk_ct);
        $sql = "AND d.`thoi_han` = $thoi_han ";
        $cou = new db_query("SELECT COUNT(`thoi_han`) AS total FROM `don_hang` WHERE `thoi_han` = $thoi_han AND `id_cong_ty` = $com_id ");
    } else if ($tk == 4) {
        $sql = "AND d.`id_nha_cc_kh` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id_nha_cc_kh`) AS total FROM `don_hang` WHERE `id_nha_cc_kh` = $tk_ct AND `id_cong_ty` = $com_id ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start,$ht";

$list_dh .= $sql;
$list_dh .= $limit;
$item_dh = new db_query($list_dh);

$stt = 1;

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$list_ctrinh = $data_list['data']['items'];
$cou1 = count($list_ctrinh);

$all_ctrinh = [];
for ($i = 0; $i < $cou1; $i++) {
    $item1 = $list_ctrinh[$i];
    $all_ctrinh[$item1['ctr_id']] = $item1;
};

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
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
    <div class="main-container ql_don_hang ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Đơn hàng</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="add_hopd ml_20">
                            <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">
                                    &plus; Thêm mới</p>
                                <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                if (in_array(2, $don_hang2)) { ?>
                                    <p class="add_creart_hd share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">
                                        &plus; Thêm mới</p>
                            <? }
                            } ?>
                            <div class="all_hopd share_bgr_tow">
                                <p class="hd_mua_vt">
                                    <a class="share_clr_one share_fsize_one" href="them-don-hang-mua.html">
                                        Đơn hàng mua vật tư
                                    </a>
                                </p>
                                <p class="hopd_bvt">
                                    <a class="share_clr_one share_fsize_one" href="them-don-hang-ban.html">
                                        Đơn hàng bán vật tư
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem share_select" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Mã đơn hàng</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Ngày ký</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Ngày phải hoàn thành</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Nhà cung cấp / Khách hàng</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_o share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_iddh = new db_query("SELECT `id` FROM `don_hang` WHERE `id_cong_ty` = $com_id ");
                                        while ($row = mysql_fetch_assoc($list_iddh->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $tk_ct) ? "selected" : "" ?>>ĐH - <?= $row['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_nky = new db_query("SELECT DISTINCT `ngay_ky` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `ngay_ky` != 0 ");
                                        while ($row1 = mysql_fetch_assoc($list_nky->result)) {
                                        ?>
                                            <option value="<?= date('d-m-Y', $row1['ngay_ky']) ?>" <?= (date('d-m-Y', $row1['ngay_ky']) == $tk_ct) ? "selected" : "" ?>><?= date('d-m-Y', $row1['ngay_ky']) ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_nht = new db_query("SELECT DISTINCT `thoi_han` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `thoi_han` != 0 ");
                                        while ($row2 = mysql_fetch_assoc($list_nht->result)) {
                                        ?>
                                            <option value="<?= date('d-m-Y', $row2['thoi_han']) ?>" <?= (date('d-m-Y', $row2['thoi_han']) == $tk_ct) ? "selected" : "" ?>><?= date('d-m-Y', $row2['thoi_han']) ?></option>
                                        <? }
                                    } else if ($tk == 4) {
                                        $list_mcc_kh = new db_query("SELECT DISTINCT d.`id_nha_cc_kh`, n.`ten_nha_cc_kh` FROM `don_hang` AS d
                                                                    INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                                                    WHERE d.`id_cong_ty` = $com_id ");
                                        while ($row3 = mysql_fetch_assoc($list_mcc_kh->result)) {
                                        ?>
                                            <option value="<?= $row3['id_nha_cc_kh'] ?>" <?= ($row3['id_nha_cc_kh'] == $tk_ct) ? "selected" : "" ?>><?= $row3['ten_nha_cc_kh'] ?></option>
                                    <? }
                                    } ?>
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
                                            <th class="share_tb_two">Số đơn hàng</th>
                                            <th class="share_tb_two">Số hợp đồng</th>
                                            <th class="share_tb_one">Ngày ký</th>
                                            <th class="share_tb_one">Thời hạn</th>
                                            <th class="share_tb_four">Nhà cung cấp / Khách hàng</th>
                                            <th class="share_tb_two">Công trình</th>
                                            <th class="share_tb_two">Loại hợp đồng</th>
                                            <th class="share_tb_eight">Trạng thái</th>
                                            <th class="share_tb_two">Tạm ứng</th>
                                            <th class="share_tb_two">Giá trị cần phải trả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($item2 = mysql_fetch_assoc($item_dh->result)) { ?>
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <td>
                                                    <? if ($item2['phan_loai'] == 1) { ?>
                                                        <a href="chi-tiet-don-hang-mua-<?= $item2['id'] ?>.html" class="share_clr_four cr_weight">ĐH - <?= $item2['id'] ?></a>
                                                    <? } else if ($item2['phan_loai'] == 2) { ?>
                                                        <a href="chi-tiet-don-hang-ban-<?= $item2['id'] ?>.html" class="share_clr_four cr_weight">ĐH - <?= $item2['id'] ?></a>
                                                    <? } ?>
                                                </td>
                                                <td>HĐ - <?= $item2['id_hop_dong'] ?></td>
                                                <td><?= ($item2['ngay_ky'] != 0) ? date('d/m/Y', $item2['ngay_ky']) : "" ?></td>
                                                <td><?= ($item2['thoi_han'] != 0) ? date('d/m/Y', $item2['thoi_han']) : "" ?></td>
                                                <td><?= $item2['ten_nha_cc_kh'] ?></td>
                                                <td><?= $all_ctrinh[$item2['id_du_an_ctrinh']]['ctr_name'] ?></td>
                                                <? if ($item2['phan_loai'] == 1) { ?>
                                                    <td>Hợp đông mua vật tư</td>
                                                <? } else if ($item2['phan_loai'] == 2) { ?>
                                                    <td>Hợp đông bán vật tư</td>
                                                <? } ?>
                                                <?
                                                $id_dh = $item2['id'];
                                                $check_tt = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 2
                                                                            AND `trang_thai` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_dh ");
                                                if (mysql_fetch_assoc($check_tt->result) > 0) {
                                                    $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tong1,
                                                                        SUM(`chi_phi_khac`) AS tong2 FROM `ho_so_thanh_toan`WHERE `loai_hs` = 2
                                                                        AND `trang_thai` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_dh "))->result);
                                                    $tong1 = $tong_tien['tong1'];
                                                    $tong2 = $tong_tien['tong2'];
                                                    $tong12 = $tong1 - $tong2;
                                                } else {
                                                    $tong12 = 0;
                                                }

                                                $tong_svat_dh = $item2['gia_tri_svat'];
                                                if ($tong_svat_dh == $tong12) {

                                                ?>
                                                    <td class="text-green">Hoàn thành</td>
                                                <? } else if ($tong_svat_dh != $tong12) { ?>
                                                    <td class="text-red">Chưa hoàn thành</td>
                                                <? } ?>

                                                <? $id_dh = $item2['id'];
                                                $list_donhang = new db_query("SELECT DISTINCT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $id_dh
                                                                        AND `loai_phieu_tt` = 2 AND `id_cong_ty` = $com_id AND `loai_thanh_toan` = 1 ");
                                                if (mysql_num_rows($list_donhang->result) > 0) {
                                                    $list_donhang1 = new db_query("SELECT SUM(`so_tien`) AS tt_tamung FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $id_dh AND `loai_phieu_tt` = 2
                                                                        AND `id_cong_ty` = $com_id AND `loai_thanh_toan` = 1 ");
                                                    $tt_tamung = mysql_fetch_assoc($list_donhang1->result)['tt_tamung'];
                                                } else {
                                                    $tt_tamung = 0;
                                                };
                                                ?>
                                                <td><?= number_format($tt_tamung) ?></td>
                                                <td><?= number_format($item2['gia_tri_svat']) ?></td>
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
<script type="text/javascript" src="../js/app.js"></script>

<script>
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

    var add_creart_hd = $(".add_creart_hd");
    var all_hopd = $(".all_hopd");

    $(".add_creart_hd").click(function() {
        $(".all_hopd").toggleClass("active");
    });

    $(window).click(function(e) {
        if (!add_creart_hd.is(e.target) && !all_hopd.is(e.target) && add_creart_hd.has(e.target).length == 0) {
            all_hopd.removeClass("active");
        }
    });

    $("#category").change(function() {
        var tk = $(this).val();
        var ht = $("#display").val();
        var page = 1;

        if (tk == "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page;
        } else if (tk != "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#search").change(function() {
        var tk = $("#category").val();
        var tk_ct = $(this).val();
        var ht = $("#display").val();
        var page = 1;

        if (tk_ct == "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk_ct != "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        }
    });

    $("#display").change(function() {
        var tk = $("#category").val();
        var ht = $(this).val();
        var tk_ct = $("#search").val();
        var page = 1;

        if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk;
        } else if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-don-hang.html?ht=' + ht + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        }
    });
</script>

</html>