<?
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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bang_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bang_gia = explode(',', $item_nv['bang_gia']);
            if (in_array(1, $bang_gia) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['currP']) ? $currP = $_GET['currP'] : $currP = 10;
isset($_GET['day']) ? $day = $_GET['day'] : $day = "";
isset($_GET['tk']) ? $tk = $_GET['tk'] : $tk = "";
isset($_GET['tk_ct']) ? $tk_ct = $_GET['tk_ct'] : $tk_ct = "";

if ($day != "" && $tk != "" && $tk_ct != "") {
    $urll = '/quan-ly-bang-gia.html?currP=' . $currP . '&day=' . $day . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($day != "" && $tk == "" && $tk_ct == "") {
    $urll = '/quan-ly-bang-gia.html?currP=' . $currP . '&day=' . $day;
    $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id ");
} else if ($day == "" && $tk != "" && $tk_ct == "") {
    $urll = '/quan-ly-bang-gia.html?currP=' . $currP . '&tk=' . $tk;
    $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id ");
} else if ($day == "" && $tk != "" && $tk_ct != "") {
    $urll = '/quan-ly-bang-gia.html?currP=' . $currP . '&tk=' . $tk . '&tk_ct=' . $tk_ct;
} else if ($day == "" && $tk == "" && $tk_ct = "") {
    $urll = '/quan-ly-bang-gia.html?currP=' . $currP;
    $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id ");
};

$start = ($page - 1) * $currP;
$start = abs($start);

$list_vt = "SELECT DISTINCT v.`id_vat_tu` FROM `vat_tu_da_bao_gia` AS v
                INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                WHERE b.`id_cong_ty` = $com_id ";

if ($day != "") {
    $days = strtotime($day);
    $sql_day = "AND b.`ngay_tao` = $days ";
    $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id AND b.`ngay_tao` = $days");
};

if ($tk_ct != "") {
    if ($tk == 1) {
        $sql = "AND b.`id` = $tk_ct ";
        $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id AND b.`id` = $tk_ct ");
    } else if ($tk == 2) {
        $ngay_gui = strtotime($tk_ct);
        $sql = "AND b.`ngay_gui` =  $ngay_gui ";
        $cou = new db_query("SELECT  COUNT(DISTINCT v.`id_vat_tu`) AS total FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON v.`id_bao_gia` = b.`id`
                            WHERE b.`id_cong_ty` = $com_id AND b.`ngay_gui` =  $ngay_gui ");
    };
};

$total = mysql_fetch_assoc($cou->result)['total'];

$limit = "LIMIT $start,$currP";

$list_vt .= $sql_day;
$list_vt .= $sql;
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

$ds_nha_cc = new db_query("SELECT y.`id_nha_cc`, n.`ten_nha_cc_kh` FROM `bao_gia` AS y
                            INNER JOIN `nha_cc_kh` AS n ON y.`id_nha_cc` = n.`id` WHERE y.`id_cong_ty` = $com_id ");

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng giá</title>
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
                    <p class="page-title">Bảng giá</p>
                    <div class="c-help d_flex fl_agi">
                        <i class="ic-question share_clr_four"><?php echo $ic_question ?></i>
                        <a class="c-help" href="#">Hướng dẫn</a>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="w-100 left mt-10">
                        <label for="gia-vat-tu-ngay">Bảng giá vật tư ngày</label>
                        <input class="date-input" type="date" id="gia-vat-tu-ngay" value="<?= $day ?>" name="gia-vat-tu-ngay">
                    </div>
                    <div class="w-100 left filter" data="<?= $page ?>">
                        <div class="category v-select2 mt-20">
                            <select name="category" class="share_select">
                                <option value="">Tìm kiếm theo</option>
                                <option value="1" <?= ($tk == 1) ? "selected" : "" ?>>Mã báo giá</option>
                                <option value="2" <?= ($tk == 2) ? "selected" : "" ?>>Ngày gửi</option>
                                <!-- <option value="3">Công trình</option>
                            <option value="4">Ngày phải hoàn thành</option> -->
                            </select>
                        </div>
                        <div class="search-box v-select2 mt-20">
                            <select name="search" class="share_select">
                                <option value="">Nhập thông tin cần tìm kiếm</option>
                                <? if ($tk == 1) {
                                    $list_bg = new db_query("SELECT `id` FROM `bao_gia` WHERE `id_cong_ty` = $com_id ");
                                    while ($row1 = mysql_fetch_assoc($list_bg->result)) {
                                ?>
                                        <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $tk_ct) ? "selected" : "" ?>>PH - <?= $row1['id'] ?></option>
                                    <? }
                                } else if ($tk == 2) {
                                    $bao_gia = new db_query("SELECT DISTINCT `ngay_gui` FROM `bao_gia` WHERE `id_cong_ty` = $com_id");
                                    while ($item1 = mysql_fetch_assoc($bao_gia->result)) {
                                    ?>
                                        <option value="<?= date('Y-m-d', $item1['ngay_gui']) ?>" <?= (date('Y-m-d', $item1['ngay_gui']) == $tk_ct) ? "selected" : "" ?>><?= date('d/m/Y', $item1['ngay_gui']) ?></option>
                                <? }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="scr-wrapper mt-20">
                        <div class="scr-btn scr-l-btn right" onclick="next_q(this)"><i class="ic-chevron-left"></i></div>
                        <div class="scr-btn scr-r-btn left d-none" onclick="pre_q(this)"><i class="ic-chevron-right"></i></div>
                        <div class="table-wrapper" onscroll="table_scroll(this)">
                            <div class="table-container table-1791">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>

                                                <th class="w-5">STT</th>
                                                <th class="w-10">Mã vật tư</th>
                                                <th class="w-15">Tên đầy đủ vật tư thiết bị</th>
                                                <th class="w-10">Đơn vị tính</th>
                                                <th class="w-10">Giá thấp nhất</th>
                                                <th class="w-10">Giá cao nhất</th>
                                                <th class="w-20">Danh sách giá theo nhà cung cấp</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table>
                                        <tbody>
                                            <? while ($item = mysql_fetch_assoc($vat_tu->result)) { ?>
                                                <tr>
                                                    <td class="w-5"><?= $stt++ ?></td>
                                                    <td class="w-10">VT - <?= $item['id_vat_tu'] ?></td>
                                                    <td class="w-15"><?= $all_vt[$item['id_vat_tu']]['dsvt_name'] ?></td>
                                                    <td class="w-10"><?= $all_vt[$item['id_vat_tu']]['dvt_name'] ?></td>
                                                    <?
                                                    $id_vtu = $item['id_vat_tu'];
                                                    $mind = mysql_fetch_assoc((new db_query("SELECT MIN(`don_gia`) AS mind FROM `vat_tu_da_bao_gia`
                                                WHERE `id_cong_ty` = $com_id AND `id_vat_tu` = $id_vtu "))->result)['mind'];

                                                    $maxd = mysql_fetch_assoc((new db_query("SELECT MAX(`don_gia`) AS maxd FROM `vat_tu_da_bao_gia`
                                                WHERE `id_cong_ty` = $com_id AND `id_vat_tu` = $id_vtu "))->result)['maxd'];
                                                    ?>
                                                    <td class="w-10"><?= $mind ?></td>
                                                    <td class="w-10"><?= $maxd ?></td>
                                                    <td class="w-20 share_clr_four share_cursor see_ds text-500 ds_nhacc" data="<?= $item['id_vat_tu'] ?>" data1="<?= $com_id ?>">+
                                                        Xem danh sách giá
                                                        theo nhà cung cấp
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
        <!-- modal -->

        <div class="modal_share modal_share_tow list_cate_nhacc" data="" data1="">
            <div class="modal-content">
                <div class="info_modal">
                    <div class="modal-header">
                        <div class="header_ctn_share">
                            <h4 class="ctn_share_h share_htitl share_clr_tow tex_left padd_l cr_weight_bold">
                                <span class="text-upper pr-5">Bảng giá: </span>
                                Tên vật tư thiết bị
                            </h4>
                            <span class="close_detl close_dectl">&times;</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="ctn_body_modal">
                            <div class="madal_form mt-20">
                                <div class="sapx_dgia w_100 float_l share_bgr_tow d_flex fl_agi mb_15">
                                    <p class="share_clr_one share_fsize_tow mr_10 cr_weight text">Đơn giá:</p>
                                    <div class="form_search_dgia">
                                        <select name="search_dgia" class="form-control w_100 search_dgia">
                                            <option value="">Không sắp xếp</option>
                                            <option value="1">Từ thấp đến cao</option>
                                            <option value="2">Từ cao đến thấp</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="search_nhacc w_100 float_l mb_15">
                                    <div class="selec_nhacc share_form_select w_100 float_l">
                                        <select name="timk_nhacc" class="form-control timk_nhacc">
                                            <option value="">Tìm kiếm theo tên nhà cung cấp</option>
                                            <? while ($item2 = mysql_fetch_assoc($ds_nha_cc->result)) { ?>
                                                <option value="<?= $item2['id_nha_cc'] ?>"><?= $item2['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                        <span class="ico_timk"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="sroll_ds_gia w_100 float_l">
                                <div class="ctiet_ds_nha_cc w_100 float_l">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nhà cung cấp</th>
                                                <th>Đơn giá (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all_bg_ncc">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
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
<script type="text/javascript">
    var list_cate_nhacc = $(".list_cate_nhacc");

    $(".ds_nhacc").click(function() {
        var id_vt = $(this).attr("data");
        var com_id = $(this).attr("data1");
        $.ajax({
            url: '../render/ds_banggia_nhacc_bg.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                com_id: com_id,
            },
            success: function(data) {
                $(".list_cate_nhacc").attr("data", id_vt);
                $(".list_cate_nhacc").attr("data1", com_id);
                $(".list_cate_nhacc #all_bg_ncc").html(data);
                $(".list_cate_nhacc").show();
            }
        })
    });

    $(window).click(function(e) {
        if ($(e.target).is(".list_cate_nhacc")) {
            list_cate_nhacc.hide();
        }
    });

    $(".timk_nhacc").change(function() {
        var id_ncc = $(this).val();
        var id_vt = $(".list_cate_nhacc").attr("data");
        var com_id = $(".list_cate_nhacc").attr("data1");
        $.ajax({
            url: '../render/ds_banggia_nhacc_bg.php',
            type: 'POST',
            data: {
                id_ncc: id_ncc,
                id_vt: id_vt,
                com_id: com_id,
            },
            success: function(data) {
                $(".list_cate_nhacc #all_bg_ncc").html(data);
            }
        })
    });

    $(".search_dgia").change(function() {
        var sapxep = $(this).val();
        var id_ncc = $(".timk_nhacc").val();
        var id_vt = $(".list_cate_nhacc").attr("data");
        var com_id = $(".list_cate_nhacc").attr("data1");
        $.ajax({
            url: '../render/ds_banggia_nhacc_bg.php',
            type: 'POST',
            data: {
                sapxep: sapxep,
                id_ncc: id_ncc,
                id_vt: id_vt,
                com_id: com_id,
            },
            success: function(data) {
                $(".list_cate_nhacc #all_bg_ncc").html(data);
            }
        })
    });

    $(".search_dgia, .timk_nhacc").select2({
        width: '100%',
    });

    $("#gia-vat-tu-ngay, select[name='category'],select[name='search'], #display").on('change', function() {
        var day = $("#gia-vat-tu-ngay").val();
        var tk = $("select[name='category']").val();
        var tk_ct = $("select[name='search']").val();
        var currP = $("#display").val();
        var page = $(".filter").attr("data");
        if (tk == "") {
            tk_ct = ""
        };

        if (day != "" && tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&day=' + day + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (day == "" && tk != "" && tk_ct != "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&tk=' + tk + '&tk_ct=' + tk_ct + '&page=' + page;
        } else if (day != "" && tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&day=' + day + '&tk=' + tk + '&page=' + page;
        } else if (day != "" && tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&day=' + day + '&page=' + page;
        } else if (day == "" && tk != "" && tk_ct == "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&tk=' + tk + '&page=' + page;
        } else if (day == "" && tk == "" && tk_ct == "") {
            window.location.href = '/quan-ly-bang-gia.html?currP=' + currP + '&page=' + page;
        }

    });
</script>

</html>