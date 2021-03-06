<?php
include "../includes/icon.php";
include "config.php";

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `yeu_cau_vat_tu` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $ycvt3 = explode(',', $item_nv['yeu_cau_vat_tu']);
            if (in_array(1, $ycvt3) == false) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}
if (!isset($_COOKIE['acc_token']) || !isset($_COOKIE['rf_token']) || !isset($_COOKIE['role'])) {
    header('Location: /quan-ly-trang-chu.html');
};
isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";
isset($_GET['filter2']) ? $filter_2 = $_GET['filter2'] : $filter_2 = 4;

$curl = curl_init();
$token = $_COOKIE['acc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($curl);
curl_close($curl);
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];
$coun1 = count($cong_trinh_data);

$newArr = [];
if ($filter_2 == 5) {
    for ($i = 0; $i < $coun1; $i++) {
        if ($cong_trinh_data[$i]['ctr_trangthai'] == 1 || $cong_trinh_data[$i]['ctr_trangthai'] == 0) {
            $value = $cong_trinh_data[$i];
            $newArr[$value["ctr_id"]] = $value['ctr_id'];
        }
    }
} else if ($filter_2 == 6) {
    for ($i = 0; $i < $coun1; $i++) {
        if ($cong_trinh_data[$i]['ctr_trangthai'] == 3 || $cong_trinh_data[$i]['ctr_trangthai'] == 4) {
            $value = $cong_trinh_data[$i];
            $newArr[$value["ctr_id"]] = $value['ctr_id'];
        }
    }
}
$chuoi_id = implode(',', $newArr);

$all_ctr = [];
for ($n = 0; $n < $coun1; $n++) {
    $new_ctr = $cong_trinh_data[$n];
    $all_ctr[$new_ctr['ctr_id']] = $new_ctr;
}

if ($tk != "" && $tk_ct != "") {
    $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct . '&filter2=' . $filter_2;
} else if ($tk == "" && $tk_ct == "") {
    if ($filter_2 == 4) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ");
    } elseif ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `trang_thai` = $filter_2 ");
    } else if ($filter_2 == 6 || $filter_2 == 5) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
    }
} else if ($tk != "" && $tk_ct == "") {
    if ($filter_2 == 4) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&tk=' . $tk . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ");
    } elseif ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&tk=' . $tk . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `trang_thai` = $filter_2 ");
    } else if ($filter_2 == 6 || $filter_2 == 5) {
        $url = '/quan-ly-yeu-cau-vat-tu.html?currP=' . $currP . '&tk=' . $tk . '&filter2=' . $filter_2;
        $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
    }
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_ycvt = "SELECT * FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ";

if ($filter_2 == 4) {
    $trang_thai = "";
} elseif ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
    $trang_thai = " AND `trang_thai` = $filter_2  ";
} else  if ($filter_2 == 6 || $filter_2 == 5) {
    $trang_thai = " AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ";
}

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND `id` = $tk_ct ";
        if ($filter_2 == 4) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct ");
        } else if ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct AND `trang_thai` = $filter_2 ");
        } else if ($filter_2 == 6 || $filter_2 == 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id` = $tk_ct AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
        }
    } elseif ($tk == 2) {
        $tk_ct = strtotime($tk_ct);
        $sql = "AND `ngay_tao` = $tk_ct ";
        if ($filter_2 == 4) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_tao` = $tk_ct ");
        } else if ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_tao` = $tk_ct AND `trang_thai` = $filter_2 ");
        } else if ($filter_2 == 6 || $filter_2 == 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_tao` = $tk_ct AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
        }
    } elseif ($tk == 3) {
        $sql = "AND `id_cong_trinh` = $tk_ct ";
        if ($filter_2 == 4) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id_cong_trinh` = $tk_ct ");
        } else if ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id_cong_trinh` = $tk_ct AND `trang_thai` = $filter_2 ");
        } else if ($filter_2 == 6 || $filter_2 == 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `id_cong_trinh` = $tk_ct AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
        }
    } elseif ($tk == 4) {
        $tk_ct = strtotime($tk_ct);
        $sql = "AND `ngay_ht_yc` = $tk_ct ";
        if ($filter_2 == 4) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_ht_yc` = $tk_ct ");
        } else if ($filter_2 != 4 && $filter_2 != 6 && $filter_2 != 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_ht_yc` = $tk_ct AND `trang_thai` = $filter_2 ");
        } else if ($filter_2 == 6 || $filter_2 == 5) {
            $cou = new db_query("SELECT COUNT(`id`) AS total FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id AND `ngay_ht_yc` = $tk_ct  AND FIND_IN_SET(`id_cong_trinh`, '" . $chuoi_id . "') ");
        }
    }
};



$total = mysql_fetch_assoc($cou->result)['total'];

$limit = " LIMIT $start,$currP";
$list_ycvt .= $sql;
$list_ycvt .= $trang_thai;
$list_ycvt .= " ORDER BY `id` DESC ";
$list_ycvt .= $limit;
// echo $list_ycvt;
$ycvt_data = new db_query($list_ycvt);

$stt = 1;

// $curl = curl_init();
// $data = array(
//     'id_com' => $com_id,
// );
// curl_setopt($curl, CURLOPT_POST, 1);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
// curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// $response = curl_exec($curl);
// curl_close($curl);
// $list_cong_trinh = json_decode($response, true);
// $cong_trinh_data = $list_cong_trinh['data']['items'];

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Y??u c???u v???t t??</title>
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
    <div class="main-container ql_chung ql_vat_tu">
        <?php include "../includes/sidebar.php" ?>
        <div class="container">
            <div class="header-container">
                <?php include '../includes/ql_header_nv.php' ?>
            </div>
            <div class="content">
                <div class="c-top border-bottom-2">
                    <h4 class="left mr-10">Y??u c???u v???t t?? c??ng tr??nh</h4>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">H?????ng d???n</a>
                    </div>
                </div>
                <div class="c-body">
                    <div class="w-100 left">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-yeu-cau-vat-tu.html">&plus; Th??m m???i</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(2, $ycvt3)) { ?>
                                <a class="v-btn btn-blue add-btn ml-20 mt-20" href="them-yeu-cau-vat-tu.html">&plus; Th??m m???i</a>
                        <? }
                        } ?>
                        <div class="filter">
                            <div class="category v-select2 mt-20">
                                <select name="category" class="share_select" id="category">
                                    <option value="">T??m ki???m theo</option>
                                    <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>S??? phi???u y??u c???u</option>
                                    <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Ng??y g???i</option>
                                    <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>C??ng tr??nh</option>
                                    <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>Ng??y ph???i ho??n th??nh</option>
                                </select>
                            </div>
                            <div class="search-box v-select2 mt-20">
                                <select name="search" class="share_select" id="search">
                                    <option value="">Nh???p th??ng tin c???n t??m ki???m</option>
                                    <? if ($tk == 1) {
                                        $danh_sach = new db_query("SELECT `id` FROM `yeu_cau_vat_tu`  WHERE `id_cong_ty` = $com_id ORDER BY `id` DESC");
                                        while ($item = mysql_fetch_assoc($danh_sach->result)) {
                                    ?>
                                            <option value="<?= $item['id'] ?>" <?= ($item['id'] == $tk_ct) ? "selected" : "" ?>>YC - <?= $item['id'] ?></option>
                                        <? }
                                    } else if ($tk == 2) {
                                        $danh_sach = new db_query("SELECT DISTINCT `ngay_tao` FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ORDER BY `ngay_tao` DESC");
                                        while ($item = mysql_fetch_assoc($danh_sach->result)) {
                                        ?>
                                            <option value="<?= date("Y-m-d", $item['ngay_tao']) ?>" <?= ($item['ngay_tao'] == $tk_ct) ? "selected" : "" ?>><?= date("d/m/Y", $item['ngay_tao']); ?></option>
                                        <? }
                                    } else if ($tk == 3) {
                                        $danh_sach = new db_query("SELECT DISTINCT `id_cong_trinh` FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ORDER BY `id_cong_trinh` DESC");
                                        while ($item = mysql_fetch_assoc($danh_sach->result)) {
                                        ?>
                                            <option value="<?= $item['id_cong_trinh'] ?>" <?= ($item['id_cong_trinh'] == $tk_ct) ? "selected" : "" ?>><?= $all_ctr[$item['id_cong_trinh']]['ctr_name'] ?></option>
                                        <? }
                                    } else if ($tk == 4) {
                                        $danh_sach = new db_query("SELECT DISTINCT `ngay_ht_yc` FROM `yeu_cau_vat_tu` WHERE `id_cong_ty` = $com_id ORDER BY `ngay_ht_yc` DESC");
                                        while ($item = mysql_fetch_assoc($danh_sach->result)) {
                                        ?>
                                            <option value="<?= date("Y-m-d", $item['ngay_ht_yc']) ?>" <?= ($item['ngay_ht_yc'] == $tk_ct) ? "selected" : "" ?>><?= date("d/m/Y", $item['ngay_ht_yc']); ?></option>

                                    <? }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter2">
                        <label class="filter-container" for="all">T???t c???
                            <input type="radio" id="all" name="filter2" value="4" <?= ($filter_2 == 4) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="approved">???? duy???t
                            <input type="radio" id="approved" name="filter2" value="2" <?= ($filter_2 == 2) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="not-approved">Ch??a duy???t
                            <input type="radio" id="not-approved" name="filter2" value="1" <?= ($filter_2 == 1) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>

                        <label class="filter-container" for="denied">???? t??? ch???i
                            <input type="radio" id="denied" name="filter2" value="3" <?= ($filter_2 == 3) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>

                    </div>
                    <div class="filter3">
                        <label class="filter-container" for="not-completed">Thu???c c??ng tr??nh ch??a ho??n th??nh
                            <input type="radio" id="not-completed" name="filter2" value="5" <?= ($filter_2 == 5) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>
                        <label class="filter-container" for="completed">Thu???c c??ng tr??nh ???? ho??n th??nh
                            <input type="radio" id="completed" name="filter2" value="6" <?= ($filter_2 == 6) ? "checked" : "" ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="table-wrapper">
                        <div class="table-container">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-5">STT</th>
                                            <th class="w-15">S??? phi???u y??u c???u</th>
                                            <th class="w-10">Ng??y g???i</th>
                                            <th class="w-20">C??ng tr??nh</th>
                                            <th class="w-15">Ng??y ph???i ho??n th??nh</th>
                                            <th class="w-15">Tr???ng th??i duy???t</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content">
                                <table>
                                    <tbody>
                                        <?
                                        $stt = 1;
                                        while ($item = mysql_fetch_assoc($ycvt_data->result)) {
                                        ?>
                                            <tr>
                                                <td class="w-5"><?= $stt++ ?></td>
                                                <td class="w-15">
                                                    <a href="quan-ly-chi-tiet-yeu-cau-vat-tu-<?= $item['id'] ?>.html" class="text-bold">YC-<?= $item['id'] ?></a>
                                                </td>
                                                <td class="w-10"><?= date("d/m/Y", $item['ngay_tao']); ?></td>
                                                <td class="w-20"><?= $all_ctr[$item['id_cong_trinh']]['ctr_name'] ?></td>
                                                <td class="w-15">
                                                    <? if (!empty($item['ngay_ht_yc'])) { ?>
                                                        <?= date("d/m/Y", $item['ngay_ht_yc']); ?>
                                                    <? } ?>
                                                </td>
                                                <? if ($item['trang_thai'] == 1) { ?>
                                                    <td class="w-15 text-yellow">Ch??a duy???t</td>
                                                <? } elseif ($item['trang_thai'] == 2) { ?>
                                                    <td class="w-15 text-green">???? duy???t</td>
                                                <? } elseif ($item['trang_thai'] == 3) { ?>
                                                    <td class="w-15 text-red">T??? ch???i</td>
                                                <? } ?>

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
                        <label for="display">Hi???n th???</label>
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
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var filter_2 = $("input[name='filter2']:checked").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&page=' + page + '&filter2=' + filter_2 ;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var filter_2 = $("input[name='filter2']:checked").val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk_ct == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&page=' + page + '&filter2=' + filter_2 ;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var filter_2 = $("input[name='filter2']:checked").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&page=' + page + '&filter2=' + filter_2 ;
        }
    });

    $("input[name='filter2']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var filter_2 = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&tk=' + tk + '&page=' + page + '&filter2=' + filter_2 ;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-yeu-cau-vat-tu.html?currP=' + currP + '&page=' + page + '&filter2=' + filter_2 ;
        }
    });
</script>

</html>