<?php
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `yeu_cau_bao_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $yc_baogia = explode(',', $item_nv['yeu_cau_bao_gia']);
        if (in_array(1, $yc_baogia) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
};


$list_nv = [];
for ($i = 0; $i < count($data_list_nv); $i++) {
    $item1 = $data_list_nv[$i];
    $list_nv[$item1['ep_id']] = $item1;
};

isset($_GET['tk']) ? $tk = (int)$_GET['tk'] : $tk = "";
isset($_GET['ct']) ? $ct = (int)$_GET['ct'] : $ct = "";
isset($_GET['page']) ? $page = (int)$_GET['page'] : $page = 1;
isset($_GET['ht']) ? $ht = (int)$_GET['ht'] : $ht = 10;


if ($tk != "" && $ct != "") {
    $urll = '/quan-ly-yeu-cau-bao-gia.html?ht=' . $ht . '&tk=' . $tk . '&ct=' . $ct;
} elseif ($tk != "" && $ct == "") {
    $urll = '/quan-ly-yeu-cau-bao-gia.html?ht=' . $ht . '&tk=' . $tk;
} elseif ($tk == "" && $ct == "") {
    $urll = '/quan-ly-yeu-cau-bao-gia.html?ht=' . $ht;
}


$start = ($page - 1) * $ht;
$start = abs($start);

$list_yc = "SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`phan_loai`, y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`
                    FROM `yeu_cau_bao_gia` AS y INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                    WHERE y.`phan_loai` = 1 AND y.`id_cong_ty` = $com_id ";
if ($ct != "") {
    if ($tk == 1) {
        $sql = "AND y.`id` = $ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `id` = $ct ");
    } else if ($tk == 2) {
        $sql = "AND y.`id_nguoi_lap` = $ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1 AND `id_nguoi_lap` = $ct ");
    } else if ($tk == 3) {
        $sql = "AND y.`nha_cc_kh` = $ct ";
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1 AND `nha_cc_kh` = $ct ");
    }
}

if ($tk == "" || $ct == "") {
    $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1");
}

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start,$ht";

$list_yc .= $sql;
$list_yc .= $limit;

$list_yc1 = new db_query($list_yc);
$stt = 1;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yêu cầu báo giá</title>
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
    <div class="main-container bg_yeu_cau">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20 d-flex align-items-center spc-btw">
                    <p class="page-title">Yêu cầu báo giá</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left ">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-yeu-cau-bao-gia.html">&plus; Thêm mới</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $yc_baogia)) { ?>
                                <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-yeu-cau-bao-gia.html">&plus; Thêm mới</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select tim_kiem">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="1" <?= ($tk == '1') ? "selected" : "" ?>>Mã yêu cầu</option>
                                    <option value="2" <?= ($tk == '2') ? "selected" : "" ?>>Người lập</option>
                                    <option value="3" <?= ($tk == '3') ? "selected" : "" ?>>Nhà cung cấp</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select tk_chi_tiet">
                                    <option value="">Nhập thông tin cần tìm kiếm</option>
                                    <? if ($tk == 1) {
                                        $list_tt = new db_query("SELECT `id`, `phan_loai` FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1 ");
                                        while ($row = mysql_fetch_assoc($list_tt->result)) {
                                    ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $ct) ? "selected" : "" ?>>BG - <?= $row['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $list_t = new db_query("SELECT DISTINCT `id_nguoi_lap`, `phan_loai` FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1");
                                        while ($row1 = mysql_fetch_assoc($list_t->result)) {
                                        ?>
                                            <option value="<?= $row1['id_nguoi_lap'] ?>" <?= ($row1['id_nguoi_lap'] == $ct) ? "selected" : "" ?>>(<?= $row1['id_nguoi_lap'] ?>) <?= $list_nv[$row1['id_nguoi_lap']]['ep_name'] ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $list_t = new db_query("SELECT DISTINCT y.`nha_cc_kh`, y.`phan_loai`, n.`ten_nha_cc_kh` FROM `yeu_cau_bao_gia` AS y
                                                            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                                                            WHERE y.`phan_loai` = 1");
                                        while ($row1 = mysql_fetch_assoc($list_t->result)) {
                                        ?>
                                            <option value="<?= $row1['nha_cc_kh'] ?>" <?= ($row1['nha_cc_kh'] == $ct) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="detail_tab w_100 float_l" data="<?= $page ?>" data1="<?= $ht ?>">
                        <div class="table-wrapper mt-20">
                            <div class="table-container table-988">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-10">STT</th>
                                                <th class="w-15">Số phiếu yêu cầu</th>
                                                <th class="w-30">Người lập</th>
                                                <th class="w-15">Ngày lập</th>
                                                <th class="w-30">Nhà cung cấp</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <? while ($item = mysql_fetch_assoc($list_yc1->result)) { ?>
                                                <tr>
                                                    <td class="w-10"><?= $stt++ ?></td>
                                                    <td class="w-15"><a href="chi-tiet-yeu-cau-bao-gia-<?= $item['id'] ?>.html" class="text-500">BG-<?= $item['id'] ?></a></td>
                                                    <td class="w-30"><?= $list_nv[$item['id_nguoi_lap']]['ep_name'] ?></td>
                                                    <td class="w-15"><?= date('d/m/Y', $item['ngay_tao']) ?></td>
                                                    <td class="w-30"><?= $ten_cty = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id` = '" . $item['nha_cc_kh'] . "' "))->result)['ten_nha_cc_kh'] ?></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 left mt-10 d-flex flex-wrap spc-btw">
                            <div class="display mr-10">
                                <label for="display">Hiển thị</label>
                                <select name="display" id="display">
                                    <option value="10" <?= ($ht == '10') ? "selected" : "" ?>>10</option>
                                    <option value="20" <?= ($ht == '20') ? "selected" : "" ?>>20</option>
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
    $(".tim_kiem").change(function() {
        var tk = $(this).val();
        var ct = $(".tk_chi_tiet").val();
        var page = $(".detail_tab").attr("data");
        var ht = $(".detail_tab").attr("data1");

        if (tk != "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page + "&tk=" + tk;
        } else if (tk == "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page;
        }

    });

    $(".tk_chi_tiet").change(function() {
        var tk = $(".tim_kiem").val();
        var ct = $(this).val();
        var page = 1;
        var ht = $(".detail_tab").attr("data1");

        if (ct == "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page + "&tk=" + tk;
        } else {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page + "&tk=" + tk + "&ct=" + ct;
        }
    });

    $("#display").change(function() {
        var ht = $(this).val();
        var page = 1;
        var tk = $(".tim_kiem").val();
        var ct = $(".tk_chi_tiet").val();

        if (tk != "" && ct != "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page + "&tk=" + tk + "&ct=" + ct;
        } else if (tk != "" && ct == "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page + "&tk=" + tk;
        } else if (tk == "" && ct == "") {
            window.location.href = "/quan-ly-yeu-cau-bao-gia.html?ht=" + ht + "&page=" + page;
        }
    })
</script>

</html>