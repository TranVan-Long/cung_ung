<?php
include "../includes/icon.php";
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $user_id = $_SESSION['com_id'];
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
    $com_name = $_SESSION['com_name'];
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
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `ho_so_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $hs_tt3 = explode(',', $item_nv['ho_so_tt']);
        if (in_array(1, $hs_tt3) == FALSE) {
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

$id = getValue('id', 'int', 'GET', '');

if ($id != "") {
    $list_hs = new db_query("SELECT `id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`, `tong_tien_tt`,
                            `tong_tien_thue`, `tong_tien_tatca`, `chi_phi_khac`, `trang_thai`, `ngay_tao`, `id_nguoi_lap`
                            FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $id ");

    $ho_so = mysql_fetch_assoc($list_hs->result);
    $loai_hs = $ho_so['loai_hs'];
    $id_hd_dh = $ho_so['id_hd_dh'];

    if ($loai_hs == 1) {
        $phan_loai_hd = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `hop_dong` AS h
                                    INNER JOIN `nha_cc_kh` AS n ON h.`id_nha_cc_kh` = n.`id`
                                    WHERE h.`id` = $id_hd_dh AND h.`id_cong_ty` = $com_id ");
        $ploai_hd = mysql_fetch_assoc($phan_loai_hd->result);

        $loai_hd = $ploai_hd['phan_loai'];
        if ($loai_hd == 1 || $loai_hd == 3 || $loai_hd == 4) {
            $dv_thuc_hien = $ploai_hd['ten_nha_cc_kh'];
        } else if ($loai_hd == 2) {
            $dv_thuc_hien = $com_name;
        }
    } else if ($list_hs == 2) {
        $phan_loai_dh = new db_query("SELECT  d.`phan_loai`, n.`ten_nha_cc_kh`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`
                                        FROM `don_hang` AS d
                                        INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                        WHERE d.`id` = $id_hd_dh AND d.`id_cong_ty` = $com_id ");

        $ploai_dh = mysql_fetch_assoc($phan_loai_dh->result);

        $loai_dh = $ploai_dh['phan_loai'];
        if ($loai_dh == 1) {
            $dv_thuc_hien = $ploai_dh['ten_nha_cc_kh'];
        } else if ($loai_dh == 2) {
            $dv_thuc_hien = $com_name;
        };
    }

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);
    $data_list1 = json_decode($response1, true);
    $list_vattu = $data_list1['data']['items'];
    $cou2 = count($list_vattu);

    $all_vattu = [];
    for ($j = 0; $j < $cou2; $j++) {
        $item2 = $list_vattu[$j];
        $all_vattu[$item2['dsvt_id']] = $item2;
    };
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết hồ sơ thanh toán</title>
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
    <div class="main-container ql_ct_phieu ql_ct_hs_tt">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content" data="<?= $com_id ?>" data1="<?= $id ?>" data2="<?= $id_hd_dh ?>" data3="<?= $loai_hs ?>" data4="<?= $user_id ?>">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-ho-so-thanh-toan.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi tiết hồ sơ thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $user_id ?>" data1="<?= $phan_quyen_nk ?>">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng / Đơn hàng</p>
                                    <? if ($ho_so['loai_hs'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $ho_so['id_hd_dh'] ?></p>
                                    <? } else if ($ho_so['loai_hs'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">ĐH - <?= $ho_so['id_hd_dh'] ?></p>
                                    <? } ?>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị thực hiện</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $dv_thuc_hien ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đợt nghiệm thu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ho_so['dot_nghiem_thu'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời gian</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($ho_so['tg_nghiem_thu'] != 0) ? date('d/m/Y', $ho_so['tg_nghiem_thu']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời hạn thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($ho_so['thoi_han_thanh_toan'] != 0) ? date('d/m/Y', $ho_so['thoi_han_thanh_toan']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Trạng thái</p>
                                    <? if ($ho_so['trang_thai'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one cr_red">Chưa hoàn thành</p>
                                    <? } else if ($ho_so['trang_thai'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one text_green">Hoàn thành</p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $user[$ho_so['id_nguoi_lap']]['ep_name'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= date('d/m/Y', $ho_so['ngay_tao']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper mt-10 them_moi_vt">
                            <div class="table-container table-3900 ds_vat_tu" data="<?= $user_id ?>">

                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc right d_flex mb-10">
                                <? if ($ho_so['trang_thai'] == 1) {
                                    if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hs">Xóa</p>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-ho-so-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                        </p>
                                        <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                        if (in_array(4, $hs_tt3)) { ?>
                                            <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hs">Xóa</p>
                                        <? }
                                        if (in_array(3, $hs_tt3)) { ?>
                                            <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                                <a href="chinh-sua-ho-so-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                            </p>
                                <? }
                                    }
                                } else {
                                    echo "";
                                } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc left d_flex mb-10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data=<?= $id ?>>Xuất Excel</p>
                                <p class="share_w_148 ml_20"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỒ SƠ THANH TOÁN</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hồ sơ thanh toán này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp xoa_hs_tt">Đồng
                                        ý</button>
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
    var com_id = $('.content').attr("data");
    var id_hs = $('.content').attr("data1");
    var id_hd_dh = $('.content').attr("data2");
    var loai_hs = $('.content').attr("data3");
    var user_id = $('.content').attr("data4");

    $.ajax({
        url: '../render/hstt_table.php',
        type: 'POST',
        data: {
            com_id: com_id,
            id_hs: id_hs,
            id_hd_dh: id_hd_dh,
            loai_hs: loai_hs,
        },
        success: function(data) {
            $(".ds_vat_tu").append(data);
        }
    })

    var remove_hs = $(".remove_hs");
    remove_hs.click(function() {
        modal_share.fadeIn();
    });
    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/hstt_excel.php?id=' + id;
    });

    $(".xoa_hs_tt").click(function() {
        var user_id = (".ctiet_dk_hp").attr("data");
        var phan_quyen_nk = $(".ctiet_dk_hp").attr("data1");
        var com_id = $('.content').attr("data");
        var id_hs = $('.content').attr("data1");
        $.ajax({
            url: '../ajax/hstt_xoa.php',
            type: 'POST',
            data: {
                user_id: user_id,
                id_hs: id_hs,
                com_id: com_id,
                phan_quyen_nk: phan_quyen_nk,
            },
            success: function(data) {
                if (data == "") {
                    alert("Bạn đã xóa phiếu hồ sơ thanh toán thành công");
                    window.location.href = '/quan-ly-ho-so-thanh-toan.html';
                }else{
                    alert(data);
                }

            }
        })
    })
</script>

</html>