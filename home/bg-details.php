<?php
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $con_name = $_SESSION['com_name'];
    $phan_quyen_nk = 1;
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
    $list_nv = $data_list['data']['items'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $com_id = $_SESSION['user_com_id'];
    $con_name = $_SESSION['com_name'];
    $user_id = $_SESSION['ep_id'];
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
        if (in_array(1, $bao_gia3) == FALSE) {
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
};

if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    $qr_ctiet = new db_query("SELECT b.`id`, b.`id_yc_bg`,b.`id_nha_cc`, b.`id_nguoi_lap`, b.`ngay_gui`, b.`ngay_bd`, b.`ngay_kt`,b.`quyen_nlap`,
                                b.`ngay_tao`,b.`id_cong_ty`, n.`ten_nha_cc_kh` FROM `bao_gia` AS b
                                INNER JOIN `nha_cc_kh` AS n ON b.`id_nha_cc` = n.`id`
                                WHERE b.`id` = $id AND b.`id_cong_ty` = $com_id ");
    $list_ct = mysql_fetch_assoc($qr_ctiet->result);
    $id_yc_bg = $list_ct['id_yc_bg'];

    $user_id = $list_ct['id_nguoi_lap'];
    $id_nhacc = $list_ct['nha_cc_kh'];

    $list_vt = new db_query("SELECT b.`id`, b.`id_yc_bg`, b.`id_cong_ty`, v.`id_vat_tu`, v.`so_luong_bg`, v.`don_gia`, v.`tong_tien_trvat`,
                            v.`thue_vat`, v.`tong_tien_svat`, v.`cs_kem_theo`, v.`sl_da_dat_hang`
                            FROM `bao_gia` AS b
                            INNER JOIN `vat_tu_da_bao_gia` AS v ON b.`id` = v.`id_bao_gia`
                            WHERE b.`id_cong_ty` = $com_id AND b.`id` = $id ");

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
};


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi ti???t b??o gi??</title>
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
                <div class="mt-20 left">
                    <a class="text-black" href="quan-ly-bao-gia.html"><?php echo $ic_lt ?> Quay l???i</a>
                    <p class="page-title text-blue mt-20">Chi ti???t b??o gi??</p>
                </div>
                <div class="w-100 left mt-10">
                    <div class="form-control detail-form" data="<?= $phan_quyen_nk  ?>" data1="<?= $user_id ?>">
                        <div class="form-row left">
                            <div class="form-col-50 left p-10 no-border">
                                <p class="detail-title">S??? b??o gi??</p>
                                <p class="detail-data text-500">BG-<?= $list_ct['id'] ?></p>
                            </div>
                            <div class="form-col-50 right p-10">
                                <p class="detail-title">Ng??y g???i</p>
                                <p class="detail-data text-500"><?= date('d/m/Y', $list_ct['ngay_gui']) ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Ng?????i l???p</p>
                                <? if ($list_ct['quyen_nlap'] == 1) { ?>
                                    <p class="detail-data text-500"> <?= $con_name ?></p>
                                <? } else if ($list_ct['quyen_nlap'] == 2) { ?>
                                    <p class="detail-data text-500"> <?= $user[$user_id]['ep_name'] ?></p>
                                <? } ?>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title"> Nh?? cung c???p</p>
                                <p class="detail-data text-500"><?= $list_ct['ten_nha_cc_kh'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Theo y??u c???u b??o gi?? s???</p>
                                <p class="detail-data text-500">BG-<?= $list_ct['id_yc_bg'] ?></p>
                            </div>
                            <div class="form-col-50 right p-10">
                                <p class="detail-title">Th???i gian ??p d???ng</p>
                                <? if ($list_ct['ngay_bd'] != 0 && $list_ct['ngay_kt'] != 0) { ?>
                                    <p class="detail-data text-500"> T???: <?= date('d/m/Y', $list_ct['ngay_bd']) ?><br> ?????n: <?= date('d/m/Y', $list_ct['ngay_kt']) ?></p>
                                <? } else if ($list_ct['ngay_bd'] != 0 && $list_ct['ngay_kt'] == 0) { ?>
                                    <p class="detail-data text-500"> T???: <?= date('d/m/Y', $list_ct['ngay_bd']) ?></p>
                                <? } else if ($list_ct['ngay_bd'] == 0 && $list_ct['ngay_kt'] != 0) { ?>
                                    <p class="detail-data text-500"> ?????n: <?= date('d/m/Y', $list_ct['ngay_kt']) ?></p>
                                <? } else { ?>
                                    <p class="detail-data text-500"></p>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left mt-35">
                    <div class="table-wrapper mt-20">
                        <div class="table-container table-3192">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-10">STT</th>
                                            <th class="w-15">M?? v???t t??</th>
                                            <th class="w-30">T??n ?????y ????? v???t t?? thi???t b???</th>
                                            <th class="w-15">????n v??? t??nh</th>
                                            <th class="w-25">H??ng s???n xu???t</th>
                                            <th class="w-25">S??? l?????ng y??u c???u b??o gi??</th>
                                            <th class="w-20">S??? l?????ng b??o gi??</th>
                                            <th class="w-25">????n gi??</th>
                                            <th class="w-20">T???ng ti???n tr?????c VAT</th>
                                            <th class="w-25">Thu??? VAT</th>
                                            <th class="w-20">T???ng sau VAT</th>
                                            <th class="w-20">Ch??nh s??ch kh??c k??m theo</th>
                                            <th class="w-20">S??? l?????ng ???? ?????t h??ng</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table>
                                    <tbody>
                                        <? $stt = 1;
                                        while ($row = mysql_fetch_assoc($list_vt->result)) { ?>
                                            <tr>
                                                <td class="w-10"><?= $stt++ ?></td>
                                                <td class="w-15">VT-<?= $row['id_vat_tu'] ?></td>
                                                <td class="w-30"><?= $tenvt[$row['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="w-15"><?= $tenvt[$row['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="w-25"><?= $tenvt[$row['id_vat_tu']]['hsx_name'] ?></td>
                                                <? $phieu_ycbg = $row['id_yc_bg'];
                                                $id_vt = $row['id_vat_tu'];
                                                $list_sl = mysql_fetch_assoc((new db_query("SELECT `so_luong_yc_bg`FROM `vat_tu_bao_gia`
                                        WHERE `id_yc_bg` = $phieu_ycbg AND `id_vat_tu` = $id_vt "))->result)['so_luong_yc_bg'] ?>
                                                <td class="w-25"><?= $list_sl ?></td>
                                                <td class="w-20"><?= $row['so_luong_bg'] ?></td>
                                                <td class="w-25"><?= $row['don_gia'] ?></td>
                                                <td class="w-20"><?= $row['tong_tien_trvat'] ?></td>
                                                <td class="w-25"><?= ($row['thue_vat'] != 0) ? $row['thue_vat'] . '%' : "" ?></td>
                                                <td class="w-20"><?= $row['tong_tien_svat'] ?></td>
                                                <td class="w-20"><?= $row['cs_kem_theo'] ?></td>
                                                <td class="w-20"><?= $row['sl_da_dat_hang'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="control-btn right">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <p class="v-btn btn-outline-red modal-btn mr-20 mt-15" data-target="delete">X??a</p>
                            <a href="chinh-sua-bao-gia-<?= $list_ct['id'] ?>.html" class="v-btn btn-blue mt-15">Ch???nh s???a</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(4, $bao_gia3)) { ?>
                                <p class="v-btn btn-outline-red modal-btn mr-20 mt-15" data-target="delete">X??a</p>
                            <? }
                            if (in_array(3, $bao_gia3)) { ?>
                                <a href="chinh-sua-bao-gia-<?= $list_ct['id'] ?>.html" class="v-btn btn-blue mt-15">Ch???nh s???a</a>
                        <? }
                        } ?>
                    </div>
                    <div class="control-btn left mr-10">
                        <button class="v-btn btn-green mr-20 mt-15 xuat_excel" data="<?= $id ?>">Xu???t excel</button>
                        <p class="v-btn"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal text-center" id="delete">
            <div class="m-content huy-them">
                <div class="m-head ">
                    X??A B??O GI??<span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>B???n c?? ch???c ch???n mu???n x??a th??ng tin b??o gi?? n??y?</p>
                    <p>Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                </div>
                <div class="m-foot d-flex spc-btw">
                    <div class="left">
                        <p class="v-btn btn-outline-blue left cancel">H???y</p>
                    </div>
                    <div class="right">
                        <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove_bg" data="<?= $id ?>" data1="<?= $com_id ?>">?????ng ??</button>
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
    $("#delete .remove_bg").click(function() {
        var id = $(this).attr("data");
        var com_id = $(this).attr("data1");
        var user_id = $(".detail-form").attr("data1");
        var phan_quyen_nk = $(".detail-form").attr("data");

        $.ajax({
            url: '../ajax/xoa_phieu_bg.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                phan_quyen_nk: phan_quyen_nk,
                user_id: user_id,
            },
            success: function(data) {
                window.location.href = '/quan-ly-bao-gia.html';
            }
        })
    });

    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/baogia_excel.php?id=' + id;
    });
</script>

</html>