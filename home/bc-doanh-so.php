<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
    }
};

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($tk != "" && $tk_ct != "") {
    $url = '/bao-cao-doanh-so-ban-hang.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($tk == "" && $tk_ct == "") {
    $url = '/bao-cao-doanh-so-ban-hang.html?currP=' . $currP;
    $cou = new db_query("SELECT COUNT( DISTINCT `id_vat_tu`) AS total FROM `vat_tu_hd_dh` AS v
                         JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                         WHERE h.`id_cong_ty` = $com_id ");
} else if ($tk != "" && $tk_ct == "") {
    $url = '/bao-cao-doanh-so-ban-hang.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT COUNT( DISTINCT `id_vat_tu`) AS total FROM `vat_tu_hd_dh` AS v
                         JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                         WHERE h.`id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_vt = "SELECT DISTINCT `id_vat_tu` FROM `vat_tu_hd_dh` AS v JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id` AND h.`phan_loai` = 2 WHERE h.`id_cong_ty` = $com_id ";

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND v.`id_vat_tu` = $tk_ct";
        $cou = new db_query("SELECT COUNT( DISTINCT `id_vat_tu`) AS total FROM `vat_tu_hd_dh` AS v
                         JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id` AND h.`phan_loai` = 2
                         WHERE h.`id_cong_ty` = $com_id AND v.`id_vat_tu` = $tk_ct ");
    } else if ($tk == 2) {
        $sql = "AND v.`id_hd_mua_ban` =  $tk_ct ";
        $cou = new db_query("SELECT COUNT(`id_hd_mua_ban`) AS total FROM `vat_tu_hd_dh` AS v
                             JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id`
                             WHERE h.`id_cong_ty` = $com_id AND v.`id_hd_mua_ban` =  $tk_ct ");
    }
};

$total = mysql_fetch_assoc($cou->result)['total'];
$limit = " LIMIT $start,$currP";

$list_vt .= $sql;
$list_vt .= " ORDER BY v.`id_vat_tu` ASC";
$list_vt .= $limit;

$vat_tu = new db_query($list_vt);

$stt = 1;

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$phieu_vt = $data_list['data']['items'];

$all_vt = [];
for ($i = 0; $i < count($phieu_vt); $i++) {
    $item1 = $phieu_vt[$i];
    $all_vt[$item1['dsvt_id']] = $item1;
};

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo cáo doanh số bán hàng</title>
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
                    <p class="left page-title">Báo cáo doanh số bán hàng</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="filter w-100 left" data="<?= $page ?>">
                        <div class="category v-select2 mt-20">
                            <select name="category" class="share_select">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Vật tư</option>
                                <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Số hợp đồng</option>
                            </select>
                        </div>
                        <div class="search-box v-select2 mt-20">
                            <select name="search" class="share_select">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                                <? if ($tk == 1) {
                                    $list_vt = new db_query("SELECT DISTINCT `id_vat_tu` FROM `vat_tu_hd_dh` AS v JOIN `hop_dong` AS h ON v.`id_hd_mua_ban` = h.`id` WHERE h.`phan_loai` = 2 ORDER BY v.`id_vat_tu` ASC");
                                    while ($row1 = mysql_fetch_assoc($list_vt->result)) {
                                ?>
                                        <option value="<?= $row1['id_vat_tu'] ?>" <?= ($row1['id_vat_tu'] == $tk_ct) ? "selected" : "" ?>>VT - <?= $row1['id_vat_tu'] ?></option>
                                    <? }
                                } else if ($tk == 2) {
                                    $bao_gia = new db_query("SELECT DISTINCT `id_hd_mua_ban` FROM `vat_tu_hd_dh` AS y JOIN `hop_dong` AS n ON y.`id_hd_mua_ban` = n.`id` WHERE n.phan_loai = 2 ORDER BY y.`id_hd_mua_ban` ASC");
                                    while ($item1 = mysql_fetch_assoc($bao_gia->result)) {
                                    ?>
                                        <option value="<?= $item1['id_hd_mua_ban'] ?>" <?= $item1['id_hd_mua_ban'] == $tk_ct ? "selected" : "" ?>> HĐ - <?= $item1['id_hd_mua_ban'] ?></option>
                                <? }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper" onscroll="table_scroll(this)">
                            <div class="table-container table-1896">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-10">STT</th>
                                                <th class="w-20">Mã vật tư</th>
                                                <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                                <th class="w-25">Số hợp đồng</th>
                                                <th class="w-25">Ngày hợp đồng</th>
                                                <th class="w-30">Giá trị theo hợp đồng</th>
                                                <th class="w-30">Giá trị thực hiện</th>
                                                <th class="w-25">Tiến độ(%)</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <? while ($item = mysql_fetch_assoc($vat_tu->result)) {
                                                $id_vt = $item['id_vat_tu'];
                                            ?>
                                                <tr>
                                                    <td class="w-10"><?= $stt++ ?></td>
                                                    <td class="w-20">VT - <?= $item['id_vat_tu'] ?></td>
                                                    <td class="w-35"><?= $all_vt[$item['id_vat_tu']]['dsvt_name'] ?></td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT y.`id_hd_mua_ban` FROM `vat_tu_hd_dh` AS y JOIN `hop_dong` AS n ON y.`id_hd_mua_ban` = n.`id` WHERE y.`id_vat_tu` = $id_vt AND n.phan_loai = 2");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text">HĐ - <?= $hd_item['id_hd_mua_ban'] ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT n.`ngay_ky_hd` FROM `vat_tu_hd_dh` AS y JOIN `hop_dong` AS n ON y.`id_hd_mua_ban` = n.`id` WHERE y.`id_vat_tu` = $id_vt AND n.phan_loai = 2");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text"><?= date("d/m/Y", $hd_item['ngay_ky_hd']); ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-30">
                                                        <?
                                                        $ds_hd = new db_query("SELECT n.`gia_tri_svat` FROM `vat_tu_hd_dh` AS y JOIN `hop_dong` AS n ON y.`id_hd_mua_ban` = n.`id` WHERE y.`id_vat_tu` = $id_vt AND n.phan_loai = 2");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text gia_tri" data=<?= $hd_item['gia_tri_svat'] ?>><?= formatMoney($hd_item['gia_tri_svat']); ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-30">
                                                        <?
                                                        $ds_hd = new db_query("SELECT s.da_thanh_toan FROM chi_tiet_phieu_tt_vt s JOIN vat_tu_hd_dh b ON s.id_hd_dh = b.id_hd_mua_ban JOIN hop_dong c ON b.id_hd_mua_ban  = c.id 
                                                        WHERE b.id_vat_tu = $id_vt AND c.phan_loai = 2");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) { ?>
                                                            <p class="table-text gia_tri_th" data=<?= $hd_item['da_thanh_toan'] ?>><?= formatMoney($hd_item['da_thanh_toan']); ?></p>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <?
                                                        $ds_hd = new db_query("SELECT n.`gia_tri_svat`, n.`gia_tri_svat` FROM `vat_tu_hd_dh` AS y JOIN `hop_dong` AS n ON y.`id_hd_mua_ban` = n.`id` WHERE y.`id_vat_tu` = $id_vt AND n.phan_loai = 2");
                                                        while ($hd_item = mysql_fetch_assoc($ds_hd->result)) {
                                                        ?>
                                                            <p class="table-text tien-do"><?= ($hd_item['gia_tri_svat']) / ($hd_item['gia_tri_svat']) * 100 ?>%</p>
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
        <?php include "../modals/modal_logout.php" ?>
        <? include("../modals/modal_menu.php") ?>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(document).ready(function() {
        var num1 = Number($('.gia_tri').attr('data'));
        var num2 = Number($('.gia_tri_th').attr('data'));
        var tien_do = phanTram(num1, num2);
        console.log(tien_do);
        $('.tien_do').text(tien_do);
    });

    $("select[name='category']").on('change', function() {
        var tk = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk != "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&page=' + page;
        }
    });

    $("select[name='search']").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $(this).val();
        var currP = $("#display").val();
        var page = 1;

        if (tk_ct != "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk_ct == "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        }
    });

    $("#display").on('change', function() {
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $(this).val();
        var page = 1;

        if (tk != "" && tk_ct != "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (tk != "" && tk_ct == "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (tk == "" && tk_ct == "") {
            window.location.href = '/bao-cao-doanh-so-ban-hang.html?currP=' + currP + '&page=' + page;
        }

    });
</script>

</html>