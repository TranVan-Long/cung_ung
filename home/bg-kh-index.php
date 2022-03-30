<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['com_name'];
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $all_nv = $data_list['data']['items'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $user_name = $_SESSION['ep_name'];
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $all_nv = $data_list['data']['items'];

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia_kh` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bao_gia_kh = explode(',', $item_nv['bao_gia']);
            if (in_array(1, $bao_gia_kh) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$list_nv = [];
for ($i = 0; $i < count($all_nv); $i++) {
    $item1 = $all_nv[$i];
    $list_nv[$item1['ep_id']] = $item1;
};

isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";
isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;

if ($tk != "" && $tk_ct != "") {
    $urll = 'quan-ly-bao-gia-cho-khach-hang.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk != "" && $tk_ct == "") {
    $urll = 'quan-ly-bao-gia-cho-khach-hang.html?currP=' . $currP . '&tk=' . $tk;
} else if ($tk == "" && $tk_ct == "") {
    $urll = 'quan-ly-bao-gia-cho-khach-hang.html?currP=' . $currP;
};

$start = ($page - 1) * $currP;
$start = abs($start);

$ds_bgkh = "SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`noi_dung_thu`, y.`ngay_bd`, y.`ngay_kt`, y.`phan_loai`, y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`
            FROM `yeu_cau_bao_gia` AS y
            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
            WHERE y.`id_cong_ty` = $com_id AND y.`phan_loai` = 2 ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND y.`id` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct AND `phan_loai` = 2  ");
    } else if ($tk == 2) {
        $sql = "AND y.`id_nguoi_lap` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2 AND `id_nguoi_lap` = $tk_ct ");
    } else if ($tk == 3) {
        $sql = "AND y.`nha_cc_kh` = $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2 AND `nha_cc_kh` = $tk_ct ");
    }
};

if ($tk == "" || $tk_ct == "") {
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2  ");
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start,$currP";

$ds_bgkh .= $sql;
$ds_bgkh .= $limit;

$list_ds = new db_query($ds_bgkh);

$stt = 1;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo giá cho khách hàng</title>
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
        <!--    a-side menu-->
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20 d-flex align-items-center spc-btw">
                    <p class="page-title">Báo giá cho khách hàng</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-bao-gia-cho-khach-hang.html">&plus; Thêm mới</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $bao_gia_kh)) { ?>
                                <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-bao-gia-cho-khach-hang.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter" data="<?= $page ?>" data1="<?= $currP ?>">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Số phiếu phản hồi</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Người phản hồi</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>Khách hàng</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_tk = new db_query("SELECT `id` FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2 ");
                                        while ($row = mysql_fetch_assoc($list_tk->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $tk_ct) ? "selected" : "" ?>>BG - <?= $row['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_tk = new db_query("SELECT DISTINCT `id_nguoi_lap` FROM `yeu_cau_bao_gia` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2 ");
                                        while ($row = mysql_fetch_assoc($list_tk->result)) {
                                        ?>
                                            <option value="<?= $row['id_nguoi_lap'] ?>" <?= ($row['id_nguoi_lap'] == $tk_ct) ? "selected" : "" ?>>(<?= $row['id_nguoi_lap'] ?>) <?= $list_nv[$row['id_nguoi_lap']]['ep_name'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_tk = new db_query("SELECT DISTINCT y.`nha_cc_kh`, y.`id_cong_ty`, y.`phan_loai`, n.`ten_nha_cc_kh`
                                                            FROM `yeu_cau_bao_gia` AS y INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                                                            WHERE y.`id_cong_ty` = $com_id AND y.`phan_loai` = 2 ");
                                        while ($row = mysql_fetch_assoc($list_tk->result)) {
                                        ?>
                                            <option value="<?= $row['nha_cc_kh'] ?>" <?= ($row['nha_cc_kh'] == $tk_ct) ? "selected" : "" ?>>(<?= $row['nha_cc_kh'] ?>) <?= $row['ten_nha_cc_kh'] ?></option>
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
                            <div class="table-container table-1310">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-15">STT</th>
                                                <th class="w-25">Số phiếu phản hồi</th>
                                                <th class="w-30">Người phản hồi</th>
                                                <th class="w-25">Ngày phản hồi</th>
                                                <th class="w-35">Khách hàng</th>
                                                <th class="w-35">Thời gian áp dụng</th>
                                                <th class="w-25">Hiệu lực báo giá</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <? while ($row1 = mysql_fetch_assoc($list_ds->result)) { ?>
                                                <tr>
                                                    <td class="w-15"><?= $stt++ ?></td>
                                                    <td class="w-25"><a href="chi-tiet-bao-gia-cho-khach-hang-<?= $row1['id'] ?>.html" class="text-500">PH-<?= $row1['id'] ?></a></td>
                                                    <td class="w-30"><?= ($user_id == $row1['id_nguoi_lap']) ? $user_name : $list_nv[$row1['id_nguoi_lap']]['ep_name'] ?></td>
                                                    <td class="w-25"><?= date('d/m/Y', $row1['ngay_tao']) ?></td>
                                                    <td class="w-35"><?= $row1['ten_nha_cc_kh'] ?></td>
                                                    <td class="w-35"><?= date('d/m/Y', $row1['ngay_bd']) ?> - <?= date('d/m/Y', $row1['ngay_kt']) ?></td>
                                                    <? if ($row1['ngay_kt'] >= strtotime(date('Y-m-d', time()))) { ?>
                                                        <td class="w-25 text-green">Còn hạn</td>
                                                    <? } else { ?>
                                                        <td class="w-25 text-red">Hết hạn</td>
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
<script type="text/javascript">
    $(".tim_kiem").change(function() {
        var tk = $(this).val();
        var tk_ct = $("#search").val();
        var currP = $(".filter").attr("data1");
        var page = $(".filter").attr("data");

        if (tk != "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page + '&tk=' + tk;
        } else if (tk == "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page;
        }
    });

    $("#search").change(function() {
        var tk_ct = $(this).val();
        var tk = $(".tim_kiem").val();
        var currP = $(".filter").attr("data1");
        var page = 1;

        if (currP != "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (currP == "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page + '&tk=' + tk;
        }
    });

    $("#display").change(function() {
        var currP = $(this).val();
        var tk = $(".tim_kiem").val();
        var tk_ct = $("#search").val();
        var page = 1;
        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page + '&tk=' + tk + '&tk_ct=' + tk_ct;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page + '&tk=' + tk;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html?currP=' + currP + '&page=' + page;
        }
    });
</script>

</html>