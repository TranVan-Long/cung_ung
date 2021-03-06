<?php
include("../includes/icon.php");
include("config.php");


if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
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
        $count = count($data_list_nv);
    } else if ($_COOKIE['role'] == 2) {
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
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia_kh` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bao_gia_kh3 = explode(',', $item_nv['bao_gia']);
            if (in_array(1, $bao_gia_kh3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}

$user = [];
for ($i = 0; $i < count($data_list_nv); $i++) {
    $item = $data_list_nv[$i];
    $user[$item["ep_id"]] = $item;
}

if (isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] != 0) {
    $id_bg = $_GET['id'];
    $list_yc = mysql_fetch_assoc((new db_query("SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`noi_dung_thu`, y.`ngay_bd`, y.`ngay_kt`,
                            y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`, y.`quyen_nlap`
                            FROM `yeu_cau_bao_gia` AS y
                            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                            WHERE y.id = $id_bg AND y.`id_cong_ty` = $com_id "))->result);

    $list_vt = new db_query("SELECT `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id_bg ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $emp0 = json_decode($response, true);
    $emp = $emp0['data']['items'];
    $cou = count($emp);

    $all_vt = [];
    for ($i = 0; $i < $cou; $i++) {
        $item1 = $emp[$i];
        $all_vt[$item1['dsvt_id']] = $item1;
    };
    $stt = 1;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi ti???t b??o gi?? cho kh??ch h??ng</title>
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
                    <a class="text-black" href="quan-ly-bao-gia-cho-khach-hang.html"><?php echo $ic_lt ?> Quay l???i</a>
                    <p class="page-title text-blue mt-20 mb_10">Chi ti???t b??o gi?? cho kh??ch h??ng</p>
                </div>
                <div class="w-100 left mt-10">
                    <div class="form-control detail-form" data="<?= $phan_quyen_nk ?>">
                        <div class="form-row left">
                            <div class="form-col-50 left p-10 no-border">
                                <p class="detail-title">S??? phi???u ph???n h???i</p>
                                <p class="detail-data text-500">PH - <?= $list_yc['id'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Ng?????i ph???n h???i</p>
                                <? if ($list_yc['quyen_nlap'] == 1) { ?>
                                    <p class="detail-data text-500"><?= $com_name ?></p>
                                <? } else if ($list_yc['quyen_nlap'] == 2) { ?>
                                    <p class="detail-data text-500"><?= $user[$list_yc['id_nguoi_lap']]['ep_name'] ?></p>
                                <? } ?>
                            </div>
                            <div class="form-col-50 right p-10">
                                <p class="detail-title">Ng??y ph???n h???i</p>
                                <p class="detail-data text-500"><?= date('d/m/Y', ($list_yc['ngay_tao'])) ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title"> Kh??ch h??ng</p>
                                <p class="detail-data text-500"><?= $list_yc['ten_nha_cc_kh'] ?></p>
                            </div>
                            <div class="form-col-50 right p-10">
                                <p class="detail-title">Th???i gian ??p d???ng</p>
                                <p class="detail-data text-500"><?= date('d/m/Y', $list_yc['ngay_bd']) ?> - <?= date('d/m/Y', $list_yc['ngay_kt']) ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">N???i dung ph???n h???i</p>
                                <p class="detail-data text-500"><?= $list_yc['noi_dung_thu'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left mt-30">
                    <div class="table-wrapper mt-30">
                        <div class="table-container table_1457">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-10">STT</th>
                                            <th class="w-20">M?? v???t t??</th>
                                            <th class="w-30">T??n ?????y ????? v???t t?? thi???t b???</th>
                                            <th class="w-25">H??ng s???n xu???t</th>
                                            <th class="w-20">S??? l?????ng b??o gi??</th>
                                            <th class="w-15">????n v??? t??nh</th>
                                            <th class="w-20">????n gi??</th>
                                            <th class="w-25">Th??nh ti???n</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table>
                                    <tbody>
                                        <? while ($row = mysql_fetch_assoc($list_vt->result)) { ?>
                                            <tr>
                                                <td class="w-10"><?= $stt++ ?></td>
                                                <td class="w-20">VT-<?= $row['id_vat_tu'] ?></td>
                                                <td class="w-30"><?= $all_vt[$row['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="w-25"><?= $all_vt[$row['id_vat_tu']]['hsx_name'] ?></td>
                                                <td class="w-20"><?= $row['so_luong_yc_bg'] ?></td>
                                                <td class="w-15"><?= $all_vt[$row['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="w-20"><?= $all_vt[$row['id_vat_tu']]['dsvt_donGia'] ?></td>
                                                <td class="w-25"><?= $row['so_luong_yc_bg'] * $all_vt[$row['id_vat_tu']]['dsvt_donGia'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="control-btn right">
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <p class="v-btn btn-outline-red modal-btn mr-20 mt-20" data-target="delete">X??a</p>
                            <a href="chinh-sua-bao-gia-cho-khach-hang-<?= $id_bg ?>.html" class="v-btn btn-blue mt-20">Ch???nh s???a</a>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            if (in_array(4, $bao_gia_kh3)) { ?>
                                <p class="v-btn btn-outline-red modal-btn mr-20 mt-20" data-target="delete">X??a</p>
                            <? }
                            if (in_array(3, $bao_gia_kh3)) { ?>
                                <a href="chinh-sua-bao-gia-cho-khach-hang-<?= $id_bg ?>.html" class="v-btn btn-blue mt-20">Ch???nh s???a</a>
                        <? }
                        } ?>
                    </div>
                    <div class="control-btn left">
                        <p class="v-btn btn-gray mr-20 mt-20 gui_mail" data1="<?= $id_bg ?>" data2="<?= $com_id ?>" data3="<?= $com_name ?>">G???i mail</p>
                        <p class="v-btn"></p>
                    </div>
                </div>
                <div class="modal text-center" id="delete">
                    <div class="m-content huy-them">
                        <div class="m-head ">
                            X??A B??O GI??<span class="dismiss cancel">&times;</span>
                        </div>
                        <div class="m-body">
                            <p>B???n c?? ch???c ch???n mu???n x??a ph???n h???i b??o gi?? n??y?</p>
                            <p>Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                        </div>
                        <div class="m-foot d-inline-block">
                            <div class="left">
                                <p class="v-btn btn-outline-blue left cancel">H???y</p>
                            </div>
                            <div class="right">
                                <button type="button" class="v-btn sh_bgr_six share_clr_tow right remo_dongy" data="<?= $id_bg ?>" data1="<?= $user_id ?>" data2="<?= $com_id ?>">?????ng ??</button>
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
    $("#delete .remo_dongy").click(function() {
        var id_bg = $(this).attr("data");
        var user_id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var phan_quyen_nk = $(".detail-form").attr("data");
        $.ajax({
            url: '../ajax/xoa_bg_kh.php',
            type: 'POST',
            data: {
                id_bg: id_bg,
                user_id: user_id,
                com_id: com_id,
                phan_quyen_nk: phan_quyen_nk,
            },
            success: function(data) {
                if (data == "") {
                    // alert("B???n ???? x??a phi???u b??o gi?? kh??ch h??ng th??nh c??ng");
                    window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html';
                } else if ($data != "") {
                    alert(data);
                }
            }
        });
    });
    $(".gui_mail").click(function() {
        var id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var com_name = $(this).attr("data3");

        $.ajax({
            url: '../ajax/gui_mail_bgkh.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                if (data == "") {
                    alert("G???i email th??nh c??ng.")
                    window.location.reload();
                } else {
                    alert(data);
                }
            }

        })
    })
</script>

</html>