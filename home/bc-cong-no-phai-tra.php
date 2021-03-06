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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `cong_no_tra` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $cong_no_tra = explode(',', $item_nv['cong_no_tra']);
            if (in_array(1, $cong_no_tra) == FALSE) {
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
    $url = '/bao-cao-cong-no-phai-tra.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk == "" && $tk_ct == "") {
    $url = '/bao-cao-cong-no-phai-tra.html?currP=' . $currP;
    $cou = new db_query("SELECT COUNT( DISTINCT h.`id_nha_cc_kh`) AS total FROM `hop_dong` AS h
                         JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
                         WHERE k.`phan_loai` = 1 AND h.`id_cong_ty` = $com_id ");
} else if ($tk != "" && $tk_ct == "") {
    $url = '/bao-cao-cong-no-phai-tra.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT( DISTINCT h.`id_nha_cc_kh`) AS total FROM `hop_dong` AS h
    JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
    WHERE k.`phan_loai` = 1 AND h.`id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_kh = "SELECT DISTINCT h.`id_nha_cc_kh` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4) WHERE k.`phan_loai` = 1 AND h.`id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND k.`id` = $tk_ct";
        $cou = new db_query("SELECT COUNT( DISTINCT `id_nha_cc_kh`) AS total FROM `hop_dong` AS h
                 JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
                 WHERE h.`id_cong_ty` = $com_id AND k.`id` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND k.`id` = $tk_ct";
        $cou = new db_query("SELECT COUNT( DISTINCT `id_nha_cc_kh`) AS total FROM `hop_dong` AS h
                 JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
                 WHERE h.`id_cong_ty` = $com_id AND k.`id` = $tk_ct ");
    } else if ($tk == 3) {
        $sql = "AND h.`id` = $tk_ct";
        $cou = new db_query("SELECT COUNT( DISTINCT `id_nha_cc_kh`) AS total FROM `hop_dong` AS h
                 JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
                 WHERE h.`id_cong_ty` = $com_id AND h.`id` = $tk_ct ");
    } else if ($tk == 4) {
        $sql = "AND h.`id_du_an_ctrinh` = $tk_ct";
        $cou = new db_query("SELECT COUNT( DISTINCT `id_nha_cc_kh`) AS total FROM `hop_dong` AS h
                 JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` AND h.`phan_loai` IN (1,3,4)
                 WHERE h.`id_cong_ty` = $com_id AND h.`id_du_an_ctrinh` = $tk_ct ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];
$limit = " LIMIT $start,$currP";

$list_kh .= $sql;
$list_kh .= " ORDER BY h.`id_nha_cc_kh` ASC";
$list_kh .= $limit;
// echo $list_kh;
$ncc_kh = new db_query($list_kh);

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
$ct_data = $data_list['data']['items'];

$all_ct = [];
for ($i = 0; $i < count($ct_data); $i++) {
    $item1 = $ct_data[$i];
    $all_ct[$item1['ctr_id']] = $item1;
};


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B??o c??o c??ng n??? ph???i tr???</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media !== 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media !== 'all')media='all'">
</head>

<body>
    <div class="main-container">
        <!--    a-side menu-->
        <?php include("../includes/sidebar.php") ?>
        <!--    a-side menu end-->

        <div class="container">
            <!--        header-->
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <!--        header end-->
            <div class="content">
                <div class="w-100 left border-bottom mt-25 pb-20 d-flex align-items-center spc-btw">
                    <p class="left page-title">B??o c??o c??ng n??? ph???i tr???</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">H?????ng d???n</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="filter w-100 left">
                        <div class="category v-select2 mt-20">
                            <select name="category" class="share_select">
                                <option value="">T??m ki???m theo</option>
                                <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>M?? nh?? cung c???p</option>
                                <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>T??n nh?? cung c???p</option>
                                <option value="3" <?= ($tk == 3) ? "selected" : "" ?>>S??? h???p ?????ng</option>
                                <option value="4" <?= ($tk == 4) ? "selected" : "" ?>>C??ng tr??nh</option>
                            </select>
                        </div>
                        <div class="search-box v-select2 mt-20">
                            <select name="search" class="share_select">
                                <option value="">Nh???p th??ng tin c???n t??m ki???m</option>
                                <? if ($tk == 1) {
                                    $list_kh = new db_query("SELECT DISTINCT `id_nha_cc_kh` FROM `nha_cc_kh` AS k JOIN `hop_dong` AS h ON k.`id` = h.`id_nha_cc_kh` WHERE `id_cong_ty` = $com_id AND h.`phan_loai` IN (1,3,4) ORDER BY h.`id_nha_cc_kh` ASC");
                                    while ($row1 = mysql_fetch_assoc($list_kh->result)) {
                                ?>
                                        <option value="<?= $row1['id_nha_cc_kh'] ?>" <?= ($row1['id_nha_cc_kh'] == $tk_ct) ? "selected" : "" ?>>NCC - <?= $row1['id_nha_cc_kh'] ?></option>
                                    <? }
                                } else if ($tk == 2) {
                                    $list_kh = new db_query("SELECT DISTINCT `id_nha_cc_kh`,`ten_nha_cc_kh` FROM `nha_cc_kh` AS k JOIN `hop_dong` AS h ON k.`id` = h.`id_nha_cc_kh` WHERE `id_cong_ty` = $com_id AND h.`phan_loai` IN (1,3,4) ORDER BY h.`id_nha_cc_kh` ASC");
                                    while ($row1 = mysql_fetch_assoc($list_kh->result)) {
                                    ?>
                                        <option value="<?= $row1['id_nha_cc_kh'] ?>" <?= ($row1['id_nha_cc_kh'] == $tk_ct) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                    <? }
                                } else if ($tk == 3) {
                                    $list_hd = new db_query("SELECT DISTINCT `id` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` IN (1,3,4) ORDER BY `id` ASC");
                                    while ($item1 = mysql_fetch_assoc($list_hd->result)) {
                                    ?>
                                        <option value="<?= $item1['id'] ?>" <?= $item1['id'] == $tk_ct ? "selected" : "" ?>>H?? - <?= $item1['id'] ?></option>
                                    <? }
                                } else if ($tk == 4) {
                                    $list_hd = new db_query("SELECT DISTINCT `id_du_an_ctrinh` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` IN (1,3,4) ORDER BY `id` ASC");
                                    while ($item1 = mysql_fetch_assoc($list_hd->result)) {
                                    ?>
                                        <option value="<?= $item1['id_du_an_ctrinh'] ?>" <?= $item1['id_du_an_ctrinh'] == $tk_ct ? "selected" : "" ?>><?= $all_ct[$item1['id_du_an_ctrinh']]['ctr_name'] ?></option>
                                        <? }
                                } ?>?>
                            </select>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper" onscroll="table_scroll(this)">
                            <div class="table-container table-2204">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-10">STT</th>
                                                <th class="w-20">M?? nh?? cung c???p</th>
                                                <th class="w-30">T??n nh?? cung c???p</th>
                                                <th class="w-25">S??? h???p ?????ng</th>
                                                <th class="w-25">Ng??y h???p ?????ng</th>
                                                <th class="w-35">C??ng tr??nh</th>
                                                <th class="w-30">Gi?? tr??? th???c hi???n</th>
                                                <th class="w-20">H???n m???c t??n d???ng</th>
                                                <th class="w-30">Thanh to??n</th>
                                                <th class="w-25">% thanh to??n</th>
                                                <th class="w-25">C??n ph???i thu</th>
                                                <th class="w-20">T??? l??? h???n m???c</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <?
                                            while ($item = mysql_fetch_assoc($ncc_kh->result)) {
                                                $id_kh = $item['id_nha_cc_kh'];

                                            ?>
                                                <tr>
                                                    <td class="w-10"><?= $stt++ ?></td>
                                                    <td class="w-20">NCC - <?= $item['id_nha_cc_kh'] ?></td>
                                                    <td class="w-30">
                                                        <?
                                                        $all_ncc_kh = new db_query("SELECT `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id_cong_ty` = $com_id AND `id` = $id_kh ");
                                                        while ($ten_kh = mysql_fetch_assoc($all_ncc_kh->result)) {
                                                            echo ($ten_kh['ten_nha_cc_kh']);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`id` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text <? if ($hd_item['id'] == $tk_ct) {
                                                                                        echo ("text-red text-bold");
                                                                                    } ?>">H?? - <?= $hd_item['id'] ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`ngay_ky_hd` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text"><?= date("d/m/Y", $hd_item['ngay_ky_hd']); ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-35">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`id_du_an_ctrinh` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text <? if ($hd_item['id_du_an_ctrinh'] == $tk_ct) {
                                                                                        echo ("text-red text-bold");
                                                                                    };
                                                                                    ($all_ct[$hd_item['id_du_an_ctrinh']]['ctr_name']) ? "" : "text-red" ?>"><?= $all_ct[$hd_item['id_du_an_ctrinh']]['ctr_name'] ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-30">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`gia_tri_svat` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text"><?= formatMoney($hd_item['gia_tri_svat']) ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-20">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`han_muc_tin_dung` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                            if ($hd_item['han_muc_tin_dung']) {
                                                        ?>
                                                                <p class="table-text"><?= formatMoney($hd_item['han_muc_tin_dung']) ?></p>
                                                            <? } else { ?>
                                                                <p class="table-text">0</p>
                                                        <? }
                                                        } ?>
                                                    </td>
                                                    <td class="w-30">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`id`, h.`id_nha_cc_kh` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                            $id_hd = $hd_item['id'];
                                                            $id_ncc = $hd_item['id_nha_cc_kh'];
                                                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS summ FROM `phieu_thanh_toan`
                                                            WHERE `loai_phieu_tt` = 1 AND `id_hd_dh` = $id_hd  AND `id_ncc_kh` = $id_ncc AND `loai_thanh_toan` = 2 AND `id_cong_ty` = $com_id "))->result);
                                                        ?>
                                                            <p class="table-text"><?= number_format($tong_tien['summ']) ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`id`, h.`id_nha_cc_kh`, h.`gia_tri_svat` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                            $id_hd = $hd_item['id'];
                                                            $id_ncc = $hd_item['id_nha_cc_kh'];
                                                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS summ FROM `phieu_thanh_toan`
                                                            WHERE `loai_phieu_tt` = 1 AND `id_hd_dh` = $id_hd  AND `id_ncc_kh` = $id_ncc AND `loai_thanh_toan` = 2 AND `id_cong_ty` = $com_id "))->result);
                                                            $gia_tri_hd = $hd_item['gia_tri_svat'];
                                                            $gia_tri_th = $tong_tien['summ'];
                                                            $ty_le = ($gia_tri_th / $gia_tri_hd) * 100;
                                                        ?>
                                                            <p class="table-text"><?= round($ty_le, 2) ?> %</p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT h.`id`, h.`id_nha_cc_kh`, h.`gia_tri_svat` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                            $id_hd = $hd_item['id'];
                                                            $id_ncc = $hd_item['id_nha_cc_kh'];
                                                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS summ FROM `phieu_thanh_toan`
                                                            WHERE `loai_phieu_tt` = 1 AND `id_hd_dh` = $id_hd  AND `id_ncc_kh` = $id_ncc AND `loai_thanh_toan` = 2 AND `id_cong_ty` = $com_id "))->result);
                                                            $gia_tri_hd = $hd_item['gia_tri_svat'];
                                                            $gia_tri_th = $tong_tien['summ'];
                                                            $phai_thu = $gia_tri_hd - $gia_tri_th;
                                                        ?>
                                                            <p class="table-text"><?= number_format($phai_thu) ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-20">
                                                    <?
                                                        $ds_hd = new db_query("SELECT h.`id`, h.`id_nha_cc_kh`, h.`gia_tri_svat`, h.`han_muc_tin_dung` FROM `hop_dong` AS h JOIN `nha_cc_kh` AS k ON h.`id_nha_cc_kh` = k.`id` WHERE h.`id_cong_ty` = $com_id AND k.`id` = $id_kh AND h.`phan_loai` IN (1,3,4)");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                            $id_hd = $hd_item['id'];
                                                            $hm_td = $hd_item['han_muc_tin_dung'];
                                                            $id_ncc = $hd_item['id_nha_cc_kh'];
                                                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS summ FROM `phieu_thanh_toan`
                                                            WHERE `loai_phieu_tt` = 1 AND `id_hd_dh` = $id_hd  AND `id_ncc_kh` = $id_ncc AND `loai_thanh_toan` = 2 AND `id_cong_ty` = $com_id "))->result);
                                                            $gia_tri_hd = $hd_item['gia_tri_svat'];
                                                            $gia_tri_th = $tong_tien['summ'];
                                                            $phai_thu = $gia_tri_hd - $gia_tri_th;
                                                            $ty_le_hm = ($phai_thu/$hm_td)*100;
                                                        ?>
                                                            <p class="table-text"><?= number_format($ty_le_hm) ?>%</p>
                                                        <? } ?>
                                                    </td>
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
                        <label for="display">Hi???n th???</label>
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
    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&page=' + page;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk_ct == "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/bao-cao-cong-no-phai-tra.html?currP=' + currP + '&page=' + page;
        }
    });
</script>

</html>