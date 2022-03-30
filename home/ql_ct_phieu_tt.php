<?php
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $user_name = $_SESSION['com_name'];
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
        $cou = count($list_nv);
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_name = $_SESSION['ep_name'];
        $user_id = $_SESSION['ep_id'];

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `phieu_tt` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $phieu_tt = explode(',', $item_nv['phieu_tt']);
            if (in_array(1, $phieu_tt) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }

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
        $cou = count($list_nv);
    }
};

$all_nv = [];
for ($i = 0; $i < $cou; $i++) {
    $row_nv = $list_nv[$i];
    $all_nv[$row_nv['ep_id']] = $row_nv;
}

$id = getValue('id', 'int', 'GET', '');
if ($id != "") {
    $list_phieu = new db_query("SELECT p.`id`, p.`id_hd_dh`, p.`id_ncc_kh`, p.`loai_phieu_tt`, p.`ngay_thanh_toan`, p.`hinh_thuc_tt`, p.`loai_thanh_toan`,
                                p.`nguoi_nhan_tien`, p.`phi_giao_dich`, p.`phan_loai`, p.`trang_thai`, p.`id_nguoi_lap`, n.`ten_nha_cc_kh`
                                FROM `phieu_thanh_toan` AS p
                                INNER JOIN `nha_cc_kh` AS n ON p.`id_ncc_kh` = n.`id`
                                WHERE p.`id` = $id AND p.`id_cong_ty` = $com_id ");
    $row = mysql_fetch_assoc($list_phieu->result);
    $id_hd_dh = $row['id_hd_dh'];

    if ($row['phan_loai'] == 1 || $row['phan_loai'] == 3 || $row['phan_loai'] == 4 || $row['phan_loai'] ==  5) {
        $dv_chitra = $com_name;
        $dv_thuhuong = $row['ten_nha_cc_kh'];
    } else if ($row['phan_loai'] == 2 || $row['phan_loai'] == 6) {
        $dv_chitra = $row['ten_nha_cc_kh'];
        $dv_thuhuong = $com_name;
    }

    $list_tt = mysql_fetch_assoc((new db_query("SELECT `id_hs`, `da_thanh_toan` FROM `chi_tiet_phieu_tt_vt` WHERE `id_phieu_tt` = $id AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh "))->result);
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết phiếu thanh toán</title>
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
    <div class="main-container ql_ct_phieu_tt ql_ct_phieu">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one mb_25 share_clr_one" href="quan-ly-phieu-thanh-toan.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four cr_weight_bold mb_25">Chi tiết phiếu thanh toán</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng / Đơn hàng</p>
                                    <? if ($row['phan_loai'] == 1 || $row['phan_loai'] == 3 || $row['phan_loai'] == 4 || $row['phan_loai'] == 5) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $row['id_hd_dh'] ?></p>
                                    <? } else if ($row['phan_loai'] == 2 || $row['phan_loai'] == 6) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">ĐH - <?= $row['id_hd_dh'] ?></p>
                                    <? } ?>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số phiếu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">PH - <?= $id ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nhà cung cấp</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $row['ten_nha_cc_kh'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= ($row['ngay_thanh_toan'] != 0) ? date('d/m/Y', $row['ngay_thanh_toan']) : "" ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hình thức thanh toán</p>
                                    <? if ($row['hinh_thuc_tt'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">Tiền mặt</p>
                                    <? } else if ($row['hinh_thuc_tt'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">Bằng thẻ</p>
                                    <? } else if ($row['hinh_thuc_tt'] == 3) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">Chuyển khoản</p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Loại thanh toán</p>
                                    <? if ($row['loai_thanh_toan'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">Tạm ứng</p>
                                    <? } else if ($row['loai_thanh_toan'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">Theo hợp đồng</p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị chi trả</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $dv_chitra ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị thụ hưởng</p>
                                    <p class="cr_weight share_fsize_tow"><?= $dv_thuhuong ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Phí giao dịch</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $row['phi_giao_dich'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd chitiet_hd_brt w_100 float_l">
                                <div class="ctiet_hd_right float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người nhận tiền</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $row['nguoi_nhan_tien'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Trạng thái</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">Hoàn thành</p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người lập</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $all_nv[$row['id_nguoi_lap']]['ep_name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_five">Hồ sơ thanh toán</th>
                                            <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                            <th class="share_tb_five">Thời hạn thanh toán</th>
                                            <th class="share_tb_five">Thanh toán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="sh_bgr_four">
                                            <td class="tex_left share_clr_four cr_weight share_tb_five">Tổng</td>
                                            <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                            <td class="share_tb_five"></td>
                                            <td class="share_clr_four cr_weight share_tb_five">25.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="tex_left share_tb_five">HS - <?= $list_tt['id_hs'] ?></td>
                                            <td class="share_tb_five">25.000.000</td>
                                            <td class="share_tb_five">30/10/2021</td>
                                            <td class="share_tb_five"><?= number_format($list_tt['da_thanh_toan']) ?></td>
                                        </tr>
                                        <!-- <tr class="sh_bgr_five">
                                            <td class="tex_left share_tb_five">Công trình xây dựng cầu XYZ</td>
                                            <td class="share_tb_five">25.000.000</td>
                                            <td class="share_tb_five"></td>
                                            <td class="share_tb_five">25.000.000</td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td class="tex_left share_tb_five">TT-08954</td>
                                            <td class="share_tb_five">25.000.000</td>
                                            <td class="share_tb_five"></td>
                                            <td class="share_tb_five">25.000.000</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc right mb-10 d_flex">
                                <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_phieu_tt">Xóa</p>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                        <a href="chinh-sua-phieu-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                    </p>
                                    <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(4, $phieu_tt)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_phieu_tt">Xóa</p>
                                    <? }
                                    if (in_array(3, $phieu_tt)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-phieu-thanh-toan-<?= $id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                        </p>
                                <? }
                                } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc left mb-10 mr-10 d_flex">
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA PHIẾU THANH TOÁN</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa phiếu thanh toán này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
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
    var remove_phieu_tt = $(".remove_phieu_tt");

    remove_phieu_tt.click(function() {
        modal_share.show();
    });
    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/ptt_hd_excel.php?id=' + id;
    });
</script>

</html>