<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `hop_dong` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hop_dong2 = explode(',', $item_nv['hop_dong']);
            if (in_array(1, $hop_dong2) == FALSE) {
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
    $url = '/quan-ly-hop-dong.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk == "" && $tk_ct == "") {
    $url = '/quan-ly-hop-dong.html?currP=' . $currP;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $com_id ");
} else if ($tk != "" && $tk_ct == "") {
    $url = '/quan-ly-hop-dong.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_hd = "SELECT `id`, `ngay_ky_hd`, `phan_loai`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `thoi_han_blanh`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `noi_dung_hd`, `hd_nguyen_tac` FROM `hop_dong` WHERE `id_cong_ty` = $com_id ";

if ($tk_ct == "") {
    if ($tk != "") {
        $sql = "AND `phan_loai` = $tk";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = $tk");
    }
} elseif ($tk_ct != "") {
    if ($tk != "") {
        $sql = "AND `id` = $tk_ct";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];
$limit = " LIMIT $start,$currP";
$list_hd .= $sql;
$list_hd .= " ORDER BY `id` ASC";
$list_hd .= $limit;
$hd_data = new db_query($list_hd);

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
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];

$cong_trinh_detail = [];
for ($i = 0; $i < count($cong_trinh_data); $i++) {
    $items_ct = $cong_trinh_data[$i];
    $cong_trinh_detail[$items_ct['ctr_id']] = $items_ct;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hợp đồng</title>
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
    <div class="main-container ql_hop_dong ql_chung">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="c-top d_flex flex_jct fl_agi">
                    <h4 class="c-name share_fsize_four share_clr_one">Hợp đồng</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="c-body mt_20">
                    <div class="filter1">
                        <div class="add_hopd">
                            <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                <p class="add_creart_hd ml-10 share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">
                                    &plus; Thêm mới</p>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(2, $hop_dong2)) { ?>
                                    <p class="add_creart_hd ml-10 share_bgr_one s_radius_two cr_weight tex_center share_clr_tow share_cursor share_w_148 share_h_36">
                                        &plus; Thêm mới</p>
                            <? }
                            } ?>
                            <div class="all_hopd share_bgr_tow">
                                <p class="hd_mua_vt">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-mua.html">
                                        Hợp đồng mua vật tư</a>
                                </p>
                                <p class="hopd_bvt">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-ban.html">
                                        Hợp đồng bán vật tư</a>
                                </p>
                                <p class="hopd_thue_tb">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-thue-thiet-bi.html">
                                        Hợp đồng thuê thiết bị</a>
                                </p>
                                <p class="hopd_thue_vc">
                                    <a class="share_clr_one share_fsize_one" href="them-hop-dong-van-chuyen.html">
                                        Hợp đồng thuê vận chuyển</a>
                                </p>
                            </div>
                        </div>
                        <div class="form_tkiem d_flex">
                            <div class="share_form_select category">
                                <select name="category" class="tim_kiem" id="category">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Hợp đồng mua vật tư</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Hợp đồng bán vật tư</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Hợp đồng thuê thiết bị</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Hợp đồng thuê vận chuyển</option>
                                </select>
                            </div>
                            <div class="share_form_select search-box">
                                <select name="search" class="tim_kiem_o" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_vt = new db_query("SELECT `id` FROM `hop_dong` WHERE `phan_loai` = 1  AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                    ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>HĐ - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_vt = new db_query("SELECT `id` FROM `hop_dong` WHERE `phan_loai` = 2  AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>HĐ - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_vt = new db_query("SELECT `id`, `phan_loai` FROM `hop_dong` WHERE `phan_loai` = 3 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>HĐ - <?= $row1['id'] ?></option>
                                        <? }
                                    } else if ($tk == 4) {
                                        $list_vt = new db_query("SELECT `id`, `phan_loai` FROM `hop_dong` WHERE `phan_loai` = 4 AND `id_cong_ty` = $com_id ORDER BY `id` ASC");
                                        while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                        ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>HĐ - <?= $row1['id'] ?></option>

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
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Số hợp đồng</th>
                                            <th class="share_tb_two">Ngày ký</th>
                                            <th class="share_tb_two">Loại hợp đồng</th>
                                            <th class="share_tb_three">Thời gian thực hiện</th>
                                            <th class="share_tb_two">Thời hạn bảo lãnh</th>
                                            <th class="share_tb_two">Nhà cung cấp / Khách hàng</th>
                                            <th class="share_tb_two">Công trình</th>
                                            <th class="share_tb_two">Tóm tắt nội dung</th>
                                            <th class="share_tb_two">Hợp đồng nguyên tắc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        while ($hd_row = mysql_fetch_assoc($hd_data->result)) {
                                            $phan_loai = $hd_row['phan_loai'];
                                            $ngay_ky = date('d/m/Y', $hd_row['ngay_ky_hd']);
                                            $ngay_bd = date('d/m/Y', $hd_row['tg_bd_thuc_hien']);
                                            $ngay_kt = date('d/m/Y', $hd_row['tg_kt_thuc_hien']);
                                            if (is_null($hd_row['thoi_han_blanh']) || $hd_row['thoi_han_blanh'] <= 0) {
                                                $ngay_bao_lanh = "";
                                            } else {
                                                $ngay_bao_lanh = date('d/m/Y', $hd_row['thoi_han_blanh']);
                                            }
                                            if (!is_null($cong_trinh_detail[$hd_row['id_du_an_ctrinh']]['ctr_name'])) {
                                                $cong_trinh = $cong_trinh_detail[$hd_row['id_du_an_ctrinh']]['ctr_name'];
                                            } else {
                                                $cong_trinh = "";
                                            }
                                            $ncc_id = $hd_row['id_nha_cc_kh'];
                                            $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);
                                        ?>
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <td>
                                                    <? if ($phan_loai == 1) { ?>
                                                        <a href="quan-ly-chi-tiet-hop-dong-mua-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                                            HĐ - <?= $hd_row['id'] ?></a>
                                                    <? } elseif ($phan_loai == 2) { ?>
                                                        <a href="quan-ly-chi-tiet-hop-dong-ban-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                                            HĐ - <?= $hd_row['id'] ?></a>
                                                    <? } elseif ($phan_loai == 3) { ?>
                                                        <a href="quan-ly-chi-tiet-hop-dong-thue-thiet-bi-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                                            HĐ - <?= $hd_row['id'] ?></a>
                                                    <? } elseif ($phan_loai == 4) { ?>
                                                        <a href="quan-ly-chi-tiet-hop-dong-van-chuyen-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                                            HĐ - <?= $hd_row['id'] ?></a>
                                                    <? } ?>

                                                </td>
                                                <td><?= $ngay_ky ?></td>
                                                <td><? if ($phan_loai == 1) { ?>
                                                        Hợp đồng mua vật tư
                                                    <? } elseif ($phan_loai == 2) { ?>
                                                        Hợp đồng bán vật tư
                                                    <? } elseif ($phan_loai == 3) { ?>
                                                        Hợp đồng Thuê thiết bị
                                                    <? } elseif ($phan_loai == 4) { ?>
                                                        Hợp đồng thuê vận chuyển
                                                    <? } ?>
                                                </td>
                                                <td><? if ($hd_row['tg_bd_thuc_hien'] == 0 && $hd_row['tg_kt_thuc_hien'] == 0) {
                                                    } else { ?>
                                                        <?= $ngay_bd ?> - <?= $ngay_kt ?>
                                                    <? } ?>
                                                </td>
                                                <td><?= $ngay_bao_lanh ?></td>
                                                <td><?= $ncc['ten_nha_cc_kh'] ?></td>
                                                <td><?= $cong_trinh ?></td>
                                                <td><? if ($hd_row['noi_dung_hd'] == "") {
                                                    } else {
                                                        if (strlen($hd_row['noi_dung_hd']) > 80) { ?>
                                                            <?= substr($hd_row['noi_dung_hd'], 0, 81) ?>...
                                                        <? } else { ?>
                                                            <?= $hd_row['noi_dung_hd'] ?>
                                                        <? } ?>
                                                    <? } ?>
                                                </td>
                                                <td class="<?= ($hd_row['hd_nguyen_tac']) ? "text-green" : "text-red" ?>">
                                                    <?= ($hd_row['hd_nguyen_tac']) ? "Có" : "Không" ?>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <span class="scroll_right share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
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
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
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

    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&page=' + page;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-hop-dong.html?currP=' + currP + '&page=' + page;
        }
    });

    $(".tim_kiem, .tim_kiem_o").select2({
        width: '100%',
    });

    var add_creart_hd = $(".add_creart_hd");
    var all_hopd = $(".all_hopd");

    $(".add_creart_hd").click(function() {
        $(".all_hopd").toggleClass("active");
    })

    $(window).click(function(e) {
        if (!add_creart_hd.is(e.target) && !all_hopd.is(e.target) && add_creart_hd.has(e.target).length == 0) {
            all_hopd.removeClass("active");
        }
    })
</script>

</html>