<?
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nk = 1;

    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $list_nv = $data_list['data']['items'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nk = 2;

    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $list_nv = $data_list['data']['items'];

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $bao_gia3 = explode(',', $item_nv['bao_gia']);
        if (in_array(3, $bao_gia3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
};


$user = [];
for ($i = 0; $i < count($list_nv); $i++) {
    $item1 = $list_nv[$i];
    $user[$item1["ep_id"]] = $item1;
}

if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    $qr_ctiet = new db_query("SELECT b.`id`, b.`id_yc_bg`,b.`id_nha_cc`, b.`id_nguoi_lap`, b.`ngay_gui`, b.`ngay_bd`, b.`ngay_kt`,b.`quyen_nlap`,
                                b.`ngay_tao`,b.`id_cong_ty`, n.`ten_nha_cc_kh` FROM `bao_gia` AS b
                                INNER JOIN `nha_cc_kh` AS n ON b.`id_nha_cc` = n.`id`
                                WHERE b.`id` = $id AND b.`id_cong_ty` = $com_id ");
    $list_ct = mysql_fetch_assoc($qr_ctiet->result);
    $id_yc_bg = $list_ct['id_yc_bg'];

    $user_id = $list_ct['id_nguoi_lap'];
    $id_nhacc = $list_ct['id_nha_cc'];

    $list_vt = new db_query("SELECT b.`id`, b.`id_yc_bg`, b.`id_cong_ty`, v.`id_vat_tu`, v.`so_luong_bg`, v.`don_gia`, v.`tong_tien_trvat`,
                            v.`thue_vat`, v.`tong_tien_svat`, v.`cs_kem_theo`, v.`sl_da_dat_hang`, v.`id_bao_gia`
                            FROM `vat_tu_da_bao_gia` AS v
                            INNER JOIN `bao_gia` AS b ON b.`id` = v.`id_bao_gia`
                            WHERE b.`id_cong_ty` = $com_id AND v.`id_bao_gia` = $id ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);

    $vat_tu = json_decode($response1, true);
    $vatt = $vat_tu['data']['items'];

    $tenvt = [];
    for ($j = 0; $j < count($vatt); $j++) {
        $item2 = $vatt[$j];
        $tenvt[$item2['dsvt_id']] = $item2;
    }

    $list_nha_cc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 1 ");
}

$date_now = date('Y-m-d', time());

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ch???nh s???a b??o gi??</title>
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
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="left mt-25">
                    <a class="text-black" href="chi-tiet-bao-gia-<?= $id ?>.html"><?php echo $ic_lt ?> Quay l???i</a>
                    <p class="page-title mt_20 mb_10">Ch???nh s???a b??o gi??</p>
                </div>
                <form class="main-form" data="<?= $com_id ?>" data1="<?= $date_now ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form" data="<?= $phan_quyen_nk ?>" data1="<?= $user_id ?>">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label for="">S??? b??o gi??<span class="text-red">&ast;</span></label>
                                    <input type="text" id="so-bao-gia" name="so_bao_gia" value="BG-<?= $list_ct['id'] ?>" data="<?= $list_ct['id'] ?>" readonly>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label for="">Ng??y g???i<span class="text-red">&ast;</span></label>
                                    <input type="date" id="ngay_gui" name="ngay_gui" value="<?= date('Y-m-d', $list_ct['ngay_gui']) ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="">Ng?????i l???p</label>
                                    <? if ($list_ct['quyen_nlap'] == 1) { ?>
                                        <input type="text" name="nguoi_lap" value="<?= $com_name ?>" readonly>
                                    <? } else if ($list_ct['quyen_nlap'] == 2) { ?>
                                        <input type="text" name="nguoi_lap" value="<?= $user[$user_id]['ep_name'] ?>" readonly>
                                    <? } ?>
                                </div>
                                <div class="form-col-50 no-border right mb_15 v-select2">
                                    <label for="">Nh?? cung c???p<span class="text-red">&ast;</span></label>
                                    <select id="nha-cung-cap" name="nha_cung_cap" class="share_select">
                                        <option value="">-- Ch???n nh?? cung c???p --</option>
                                        <? while ($row1 = mysql_fetch_assoc($list_nha_cc->result)) { ?>
                                            <option value="<?= $row1['id'] ?>" <?= ($row1['id'] == $id_nhacc) ? "selected" : "" ?>><?= $row1['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="">Theo y??u c???u b??o gi?? s???<span class="text-red">&ast;</span></label>
                                    <select id="so-yeu-cau" name="so_yeu_cau" class="share_select" data="<?= $id_yc_bg ?>" data1="<?= $com_id ?>">
                                        <!-- <option value="">-- Ch???n y??u c???u b??o gi?? --</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Th???i gian ??p d???ng</label>
                                    <div class="range-date-picker">
                                        <div class="date-input-sm">
                                            <input type="date" name="tu_ngay" id="startDate" value="<?= ($list_ct['ngay_bd'] != 0) ? date('Y-m-d', $list_ct['ngay_bd']) : "" ?>">
                                        </div>
                                        <div class="range-date-text">
                                            <p id="hahaha">?????n</p>
                                        </div>
                                        <div class="date-input-sm">
                                            <input type="date" name="den_ngay" id="endDate" value="<?= ($list_ct['ngay_kt'] != 0) ? date('Y-m-d', $list_ct['ngay_kt']) : "" ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <div class="table-wrapper mt-20">
                                <div class="table-container table-2848">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-20">M?? v???t t??</th>
                                                    <th class="w-35">T??n ?????y ????? v???t t?? thi???t b???</th>
                                                    <th class="w-15">????n v??? t??nh</th>
                                                    <th class="w-40">H??ng s???n xu???t</th>
                                                    <th class="w-30">S??? l?????ng y??u c???u b??o gi??</th>
                                                    <th class="w-25">S??? l?????ng b??o gi??</th>
                                                    <th class="w-25">????n gi??</th>
                                                    <th class="w-30">T???ng ti???n tr?????c VAT</th>
                                                    <th class="w-25">Thu??? VAT (%)</th>
                                                    <th class="w-30">T???ng sau VAT</th>
                                                    <th class="w-35">Ch??nh s??ch kh??c k??m theo</th>
                                                    <th class="w-35">S??? l?????ng ???? ?????t h??ng</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="rererences" data="<?= $com_id ?>" data1="<?= $date_now ?>">
                                                <? while ($row = mysql_fetch_assoc($list_vt->result)) { ?>
                                                    <tr class="item">
                                                        <td class="w-20">
                                                            <input type="text" name="ma_vat_tu" value="VT-<?= $row['id_vat_tu'] ?>" data="<?= $row['id_vat_tu'] ?>" class="tex_center" readonly>
                                                        </td>
                                                        <td class="w-35">
                                                            <input type="text" name="ten_day_du" value="<?= $tenvt[$row['id_vat_tu']]['dsvt_name'] ?>" class="tex_center" readonly>
                                                        </td>
                                                        <td class="w-15">
                                                            <input type="text" name="don_vi_tinh" value="<?= $tenvt[$row['id_vat_tu']]['dvt_name'] ?>" class="tex_center" readonly>
                                                        </td>
                                                        <td class="w-40">
                                                            <input type="text" name="hang_san_suat" value="<?= $tenvt[$row['id_vat_tu']]['dvt_name'] ?>" class="tex_center" readonly>
                                                        </td>
                                                        <td class="w-30">
                                                            <? $phieu_ycbg = $row['id_yc_bg'];
                                                            $id_vt = $row['id_vat_tu'];
                                                            $list_sl = mysql_fetch_assoc((new db_query("SELECT `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $phieu_ycbg AND `id_vat_tu` = $id_vt "))->result)['so_luong_yc_bg']
                                                            ?>
                                                            <input type="number" name="so_luong_yeu_cau" value="<?= $list_sl ?>" class="tex_center" readonly>
                                                        </td>
                                                        <td class="w-25">
                                                            <input type="text" name="so_luong_bao_gia" value="<?= $row['so_luong_bg'] ?>" oninput="<?= $oninput ?>" class="tex_center so_luong" onkeyup="sl_doi(this)">
                                                        </td>
                                                        <td class="w-25">
                                                            <input type="text" name="don_gia" value="<?= $row['don_gia'] ?>" oninput="<?= $oninput ?>" class="tex_center don_gia" onkeyup="dg_doi(this)">
                                                        </td>
                                                        <td class="w-30">
                                                            <input type="number" name="tong_truoc_vat" value="<?= $row['tong_tien_trvat'] ?>" class="tex_center tong_trvat" readonly>
                                                        </td>
                                                        <td class="w-25">
                                                            <input type="text" name="thue_vat" oninput="<?= $oninput ?>" value="<?= ($row['thue_vat'] != 0) ? $row['thue_vat'] : "" ?>" class="tex_center thue_vat" onkeyup="thue_doi(this)">
                                                        </td>
                                                        <td class="w-30">
                                                            <input type="number" name="tong_sau_vat" value="<?= $row['tong_tien_svat'] ?>" class="tex_center tong_svat" readonly>
                                                        </td>
                                                        <td class="w-35">
                                                            <input type="text" name="chinh_sach_khac" value="<?= $row['cs_kem_theo'] ?>" class="tex_center">
                                                        </td>
                                                        <td class="w-35">
                                                            <input type="number" name="so_luong_da_dat" value="<?= $row['sl_da_dat_hang'] ?>" class="tex_center">
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
                    <div class="w-100 left">
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">H???y</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn" data="<?= $id ?>">Xong</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal text-center" id="cancel">
            <div class="m-content">
                <div class="m-head ">
                    Th??ng b??o <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>B???n c?? ch???c ch???n mu???n h???y vi???c ch???nh s???a b??o gi???</p>
                    <p>C??c th??ng tin b???n ???? nh???p s??? kh??ng ???????c l??u.</p>
                </div>
                <div class="m-foot d-flex spc-btw">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">H???y</p>
                    </div>
                    <div class="right">
                        <a href="quan-ly-bao-gia.html" class="v-btn btn-green-2 right">?????ng ??</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../modals/modal_logout.php" ?>
        <? include("../modals/modal_menu.php") ?>
    </div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script tyoe="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    var id_nhacc = $("#nha-cung-cap").val();
    var id_phieu = $("#so-yeu-cau").attr("data");
    var com_id = $("#so-yeu-cau").attr("data1");

    $.ajax({
        url: '../render/ds_phieu_yc.php',
        type: 'POST',
        data: {
            id_nhacc: id_nhacc,
            id_phieu: id_phieu,
            com_id: com_id,
        },
        success: function(data) {
            $("#so-yeu-cau").append(data);
        }
    });

    $("#nha-cung-cap").change(function() {
        var id_ncc = $(this).val();
        var com_id = $("#so-yeu-cau").attr("data1");
        $.ajax({
            url: '../render/ds_phieu_yc.php',
            type: 'POST',
            data: {
                id_nhacc: id_ncc,
                com_id: com_id,
            },
            success: function(data) {
                $("#so-yeu-cau").html(data);
            }
        });

        $.ajax({
            url: '../render/vat_tu_bg.php',
            type: 'POST',
            data: {
                id_ncc: id_ncc,
                id_com: com_id,
            },
            success: function(data) {
                $("#rererences").html(data);
            }
        });
    });

    $("#so-yeu-cau").change(function() {
        var id_phieu = $(this).val();
        var id_ncc = $("#nha-cung-cap").val();
        var com_id = $(".main-form").attr("data");
        $.ajax({
            url: '../render/vat_tu_bg.php',
            type: 'POST',
            data: {
                id_p: id_phieu,
                id_ncc: id_ncc,
                id_com: com_id,
            },
            success: function(data) {
                $("#rererences").html(data);
            }
        });
    });

    $(".submit-btn").click(function() {
        event.preventDefault();
        event.stopPropagation();
        var errorElements = document.querySelectorAll(".error");
        for (let index = 0; index < errorElements.length; index++) {
            const element = errorElements[index];
            $('html, body').animate({
                scrollTop: $(errorElements[0]).focus().offset().top - 30
            }, 1000);
            return false;
        }
    });

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        $.validator.addMethod("dateRange",
            function() {
                var date1 = $(".main-form").attr("data1");
                var date2 = $("#ngay_gui").val();
                return (date1 >= date2);

            })
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.appendTo(element.parent('.date-input-sm'));
                error.wrap('<span class="error">');
            },
            rules: {
                so_bao_gia: {
                    required: true,
                },
                ngay_gui: {
                    required: true,
                    dateRange: true,
                },
                nha_cung_cap: {
                    required: true,
                },
                so_yeu_cau: {
                    required: true,
                },
            },
            messages: {
                so_bao_gia: {
                    required: "S??? b??o gi?? kh??ng ???????c ????? tr???ng.",
                },
                ngay_gui: {
                    required: "Vui l??ng ch???n ng??y g???i.",
                    dateRange: "Ng??y g???i b?? h??n ho???c b???ng ng??y hi???n t???i",
                },
                nha_cung_cap: {
                    required: "Vui l??ng ch???n nh?? cung c???p.",
                },
                so_yeu_cau: {
                    required: "Vui l??ng ch???n s??? y??u c???u."
                },
            }
        });
        if (form.valid() === true) {
            var so_bao_gia = $("input[name='so_bao_gia']").attr("data");
            var id_ncc = $("select[name='nha_cung_cap']").val();
            var id_phieu_yc = $("select[name='so_yeu_cau']").val();
            var tg_apdung = $("input[name='tu_ngay']").val();
            var tg_ketthuc = $("input[name='den_ngay']").val();
            var com_id = $("#rererences").attr("data");
            var ngay_gui = $("input[name='ngay_gui']").val();
            var phan_quyen_nk = $(".edit-form").attr("data");
            var user_id = $(".edit-form").attr("data1");

            var new_ma_vt = new Array();
            $("input[name='ma_vat_tu']").each(function() {
                var ma_vt = $(this).attr("data");
                if (ma_vt != "") {
                    new_ma_vt.push(ma_vt);
                }
            });

            var new_sl_bg = new Array();
            $("input[name='so_luong_bao_gia']").each(function() {
                var sl_bg = $(this).val();
                if (sl_bg != "") {
                    new_sl_bg.push(sl_bg);
                }
            });

            var new_dgia = new Array();
            $("input[name='don_gia']").each(function() {
                var dgia = $(this).val();
                if (dgia != "") {
                    new_dgia.push(dgia);
                }
            });

            var new_tongtr = new Array();
            $("input[name='tong_truoc_vat']").each(function() {
                var tongtr = $(this).val();
                if (tongtr != "") {
                    new_tongtr.push(tongtr);
                } else {
                    tongtr = 0;
                    new_tongtr.push(tongtr);
                }
            });

            var new_thue = new Array();
            $("input[name='thue_vat']").each(function() {
                var thue = $(this).val();
                if (thue != "" && thue != 0) {
                    new_thue.push(thue);
                } else {
                    thue = 0;
                    new_thue.push(thue);
                }
            });

            var new_tongs = new Array();
            $("input[name='tong_sau_vat']").each(function() {
                var tongs = $(this).val();
                if (tongs != "") {
                    new_tongs.push(tongs);
                } else {
                    tongs = 0;
                    new_tongs.push(tongs);
                }
            });

            var new_cs_kt = new Array();
            $("input[name='chinh_sach_khac']").each(function() {
                var cs_kt = $(this).val();
                if (cs_kt != "") {
                    new_cs_kt.push(cs_kt);
                } else {
                    cs_kt = 'NULL';
                    new_cs_kt.push(cs_kt);
                }
            });

            var new_ddh = new Array();
            $("input[name='so_luong_da_dat']").each(function() {
                var ddh = $(this).val();
                if (ddh != "") {
                    new_ddh.push(ddh);
                } else {
                    ddh = 0;
                    new_ddh.push(ddh);
                }
            });

            if (tg_apdung != "" && tg_ketthuc != "") {
                if (tg_apdung >= ngay_gui && ngay_gui <= tg_ketthuc) {
                    $.ajax({
                        url: '../ajax/sua_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            id_bao_gia: so_bao_gia,
                            id_ncc: id_ncc,
                            id_phieu_yc: id_phieu_yc,
                            ngay_bd: tg_apdung,
                            ngay_kt: tg_ketthuc,
                            new_ma_vt: new_ma_vt,
                            new_sl_bg: new_sl_bg,
                            new_dgia: new_dgia,
                            new_tongtr: new_tongtr,
                            new_thue: new_thue,
                            new_tongs: new_tongs,
                            new_cs_kt: new_cs_kt,
                            new_ddh: new_ddh,
                            phan_quyen_nk: phan_quyen_nk,

                        },
                        success: function(data) {
                            if (data == "") {
                                alert("B???n ???? th??m phi???u b??o gi?? th??nh c??ng");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    });
                } else if (tg_apdung > tg_ketthuc) {
                    alert("Th???i gian ??p d???ng nh??? h??n th???i gian k???t th??c");
                } else if (tg_apdung < ngay_gui) {
                    alert("Th???i gian ??p d???ng l???n h??n ng??y g???i");
                }
            } else if (tg_apdung == "" && tg_ketthuc != "") {
                if (ngay_gui <= tg_ketthuc) {
                    $.ajax({
                        url: '../ajax/sua_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            id_bao_gia: so_bao_gia,
                            id_ncc: id_ncc,
                            id_phieu_yc: id_phieu_yc,
                            ngay_bd: tg_apdung,
                            ngay_kt: tg_ketthuc,
                            new_ma_vt: new_ma_vt,
                            new_sl_bg: new_sl_bg,
                            new_dgia: new_dgia,
                            new_tongtr: new_tongtr,
                            new_thue: new_thue,
                            new_tongs: new_tongs,
                            new_cs_kt: new_cs_kt,
                            new_ddh: new_ddh,
                            phan_quyen_nk: phan_quyen_nk,

                        },
                        success: function(data) {
                            if (data == "") {
                                alert("B???n ???? th??m phi???u b??o gi?? th??nh c??ng");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    });
                } else {
                    alert("Th???i gian k???t th??c ph???i l???n h??n ho???c b???ng ng??y g???i ");
                }
            } else if (tg_apdung != "" && tg_ketthuc == "") {
                if (ngay_gui <= tg_apdung) {
                    $.ajax({
                        url: '../ajax/sua_bao_gia.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            id_bao_gia: so_bao_gia,
                            id_ncc: id_ncc,
                            id_phieu_yc: id_phieu_yc,
                            ngay_bd: tg_apdung,
                            ngay_kt: tg_ketthuc,
                            new_ma_vt: new_ma_vt,
                            new_sl_bg: new_sl_bg,
                            new_dgia: new_dgia,
                            new_tongtr: new_tongtr,
                            new_thue: new_thue,
                            new_tongs: new_tongs,
                            new_cs_kt: new_cs_kt,
                            new_ddh: new_ddh,
                            phan_quyen_nk: phan_quyen_nk,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("B???n ???? th??m phi???u b??o gi?? th??nh c??ng");
                                window.location.href = '/quan-ly-bao-gia.html';
                            } else {
                                alert(data);
                            }
                        }
                    });
                } else {
                    alert("Th???i gian ??p d???ng ph???i l???n h??n ho???c b???ng ng??y g???i");
                }
            } else if (tg_apdung == "" && tg_ketthuc == "") {
                $.ajax({
                    url: '../ajax/sua_bao_gia.php',
                    type: 'POST',
                    data: {
                        com_id: com_id,
                        user_id: user_id,
                        id_bao_gia: so_bao_gia,
                        id_ncc: id_ncc,
                        id_phieu_yc: id_phieu_yc,
                        ngay_bd: tg_apdung,
                        ngay_kt: tg_ketthuc,
                        new_ma_vt: new_ma_vt,
                        new_sl_bg: new_sl_bg,
                        new_dgia: new_dgia,
                        new_tongtr: new_tongtr,
                        new_thue: new_thue,
                        new_tongs: new_tongs,
                        new_cs_kt: new_cs_kt,
                        new_ddh: new_ddh,
                        phan_quyen_nk: phan_quyen_nk,
                    },
                    success: function(data) {
                        if (data == "") {
                            alert("B???n ???? th??m phi???u b??o gi?? th??nh c??ng");
                            window.location.href = '/quan-ly-bao-gia.html';
                        } else {
                            alert(data);
                        }
                    }
                });
            }
        }
    });
</script>

</html>