<?php
include("../includes/icon.php");
include("config.php");

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `hd_nguyen_tac`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `ten_ngan_hang`, `so_tk`, `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ncc_id = $hd_detail['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);
}


if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 1;
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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `hop_dong` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hop_dong2 = explode(',', $item_nv['hop_dong']);
            if (in_array(1, $hop_dong2) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}


$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi ti???t h???p ?????ng b??n</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_ctiet_hd">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l" data="<?= $phan_quyen_nk ?>" data1="<?= $user_id ?>">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-hop-dong.html">Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi ti???t h???p ?????ng b??n</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $com_id ?>">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">S??? h???p ?????ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">H?? - <?= $hd_id ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ng??y k?? h???p ?????ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= (!empty($hd_detail['ngay_ky_hd'])) ? date('d/m/Y', $hd_detail['ngay_ky_hd']) : "" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Kh??ch h??ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ncc['ten_nha_cc_kh'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">H???p ?????ng nguy??n t???c</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['hd_nguyen_tac']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['hd_nguyen_tac']) ? "C??" : "Kh??ng" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Gi?? tr??? tr?????c VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($hd_detail['gia_tri_trvat']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">????n gi?? ???? bao g???m VAT</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['bao_gom_vat']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['bao_gom_vat']) ? "C??" : "Kh??ng" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thu??? su???t VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($hd_detail['thue_vat']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Th???i gian th???c hi???n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?
                                        if (($hd_detail['tg_bd_thuc_hien'] != 0 || !empty($hd_detail['tg_bd_thuc_hien'])) && ($hd_detail['tg_kt_thuc_hien'] != 0 || !empty($hd_detail['tg_kt_thuc_hien']))) { ?>
                                            <?= date('d/m/Y', $hd_detail['tg_bd_thuc_hien']) ?> - <?= date('d/m/Y', $hd_detail['tg_kt_thuc_hien']) ?>
                                        <? } ?>
                                    </p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Gi?? tr??? sau VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($hd_detail['gia_tri_svat']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">T??n ng??n h??ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['ten_ngan_hang'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">S??? t??i kho???n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one stk_xd"><?= $hd_detail['so_tk'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Y??u c???u v??? ti???n ?????</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= ($hd_detail['yc_tien_do']) ? "" . $hd_detail['yc_tien_do'] . "" : "Kh??ng c??" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">N???i dung h???p ?????ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one noi_dung"><?= ($hd_detail['noi_dung_hd']) ? "" . $hd_detail['noi_dung_hd'] . "" : "Kh??ng c??" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">N???i dung c???n l??u ??</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= ($hd_detail['noi_dung_luu_y']) ? "" . $hd_detail['noi_dung_luu_y'] . "" : "Kh??ng c??" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">??i???u kho???n thanh to??n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= ($hd_detail['dieu_khoan_tt']) ? "" . $hd_detail['dieu_khoan_tt'] . "" : "Kh??ng c??" ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">M?? v???t t??</th>
                                            <th class="share_tb_two">T??n v???t t??</th>
                                            <th class="share_tb_two">????n v??? t??nh</th>
                                            <th class="share_tb_two">H??ng s???n xu???t</th>
                                            <th class="share_tb_two">Xu???t x???</th>
                                            <th class="share_tb_one">S??? l?????ng</th>
                                            <th class="share_tb_two">????n gi??</th>
                                            <th class="share_tb_two">T???ng ti???n tr?????c VAT</th>
                                            <th class="share_tb_two">Thu??? VAT (%)</th>
                                            <th class="share_tb_two">T???ng ti???n sau VAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $stt = 1;
                                        $get_vat_tu = new db_query("SELECT `id`, `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $hd_id");
                                        while ($vat_tu = mysql_fetch_assoc($get_vat_tu->result)) {
                                        ?>
                                            <tr>
                                                <td class="share_tb_one"><?= $stt++ ?></td>
                                                <td class="share_tb_two">VT - <?= $vat_tu['id'] ?></td>
                                                <td class="share_tb_two"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="share_tb_two"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="share_tb_two"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['hsx_name'] ?></td>
                                                <td class="share_tb_two"><?= $vat_tu_detail[$vat_tu['id_vat_tu']]['xx_name'] ?></td>
                                                <td class="share_tb_one"><?= $vat_tu['so_luong'] ?></td>
                                                <td class="share_tb_two"><?= formatMoney($vat_tu['don_gia']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($vat_tu['tien_trvat']) ?></td>
                                                <td class="share_tb_two"><?= $vat_tu['thue_vat'] ?></td>
                                                <td class="share_tb_two"><?= formatMoney($vat_tu['tien_svat']) ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                <div class="xuat_gmc_two share_xuat_gmc d_flex mb_10 right">
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">X??a</p>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                        <a href="chinh-sua-hop-dong-ban-<?= $hd_id ?>.html" class="share_clr_tow">Ch???nh s???a</a>
                                    </p>
                                </div>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            ?>
                                <div class="xuat_gmc_two share_xuat_gmc d_flex mb_10 right">
                                    <? if (in_array(4, $hop_dong2)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">X??a</p>
                                    <? }
                                    if (in_array(3, $hop_dong2)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-hop-dong-ban-<?= $hd_id ?>.html" class="share_clr_tow">Ch???nh s???a</a>
                                        </p>
                                    <? } ?>
                                </div>
                            <? } ?>
                            <div class="xuat_gmc_one share_xuat_gmc d_flex left mb_10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data=<?= $hd_id ?>>Xu???t Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20 gui_mail" data1="<?= $hd_id ?>" data2="<?= $com_id ?>" data3="<?= $com_name ?>">G???i mail</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popup x??a -->

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">X??A H???P ?????NG B??N</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n x??a h???p ?????ng b??n n??y?</p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy share_cursor mb_10 btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">H???y</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp xoa_hd_ban" data-id="<?= $hd_id ?>">?????ng
                                        ??</button>
                                </div>
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

<script type="text/javascript">
    var remove_hd = $(".remove_hd");

    remove_hd.click(function() {
        modal_share.show();
    });
    $(".xoa_hd_ban").click(function() {
        var id = $(this).attr("data-id");
        var phan_quyen_nk = $(".chi_tiet_hd").attr("data");
        var user_id = $(".chi_tiet_hd").attr("data1");
        var com_id = $(".ctiet_dk_hp").attr("data");
        var loai = "b??n v???t t??"
        $.ajax({
            url: '../ajax/hd_xoa.php',
            type: 'POST',
            data: {
                id: id,
                user_id: user_id,
                com_id: com_id,
                phan_quyen_nk: phan_quyen_nk,
                loai: loai,
            },
            success: function(data) {
                if (data == "") {
                    window.location.href = '/quan-ly-hop-dong.html';
                } else {
                    alert("B??? l???i");
                }
            }
        });
    });
    $(".gui_mail").click(function() {
        var id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var com_name = $(this).attr("data3");

        $.ajax({
            url: '../ajax/gui_mail_hdbvt.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                com_name: com_name,
            },
            success: function(data) {
                if (data == "") {
                    alert("G???i email th??nh c??ng.");
                    window.location.reload();
                } else {
                    alert(data);
                }
            }

        })
    });
    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/hd_ban_excel.php?id=' + id;
    });
</script>

</html>