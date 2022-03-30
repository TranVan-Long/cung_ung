<?php
include "../includes/icon.php";
include("config.php");
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
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
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    // header('Location: /quan-ly-trang-chu.html');
    $com_id = $_SESSION['user_com_id'];
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
};
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cài đặt phân quyền</title>
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
    <div class="main-container ql_ctiet_hd_vc">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_cd mt_25 w_100 float_l">
                        <div class="top_sett w_100 float_l">
                            <div class="ctn_top_sett w_100 float_l">
                                <p class="caidc_ql active"><a href="quan-ly-cai-dat.html" class="cai_dtl">Cài đặt chung</a></p>
                                <p class="his_ql"><a href="nhat-ky-hoat-dong.html" class="cai_dtl">Nhật ký hoạt động</a></p>
                            </div>
                        </div>
                        <div class="ctn_sett w_100 float_l">
                            <div class="w_100 float_l">
                                <a href="quan-ly-cai-dat.html" class="quay_lai share_fsize_one share_clr_one">Quay lại</a>
                            </div>
                            <div class="search_pq w_100 mb_20 float_l">
                                <p class="share_fsize_two share_clr_one mb_10">Nhân viên</p>
                                <div class="form_search share_form_select" data="<?= $com_id ?>">
                                    <select name="search_nv" class="form-control search_nvpb">
                                        <option value="">Nhập nhân viên cần phân quyền</option>
                                        <? for ($i = 0; $i < $cou; $i++) { ?>
                                            <option value="<?= $list_nv[$i]['ep_id'] ?>">(<?= $list_nv[$i]['ep_id'] ?>) <?= $list_nv[$i]['ep_name'] ?> - <?= $list_nv[$i]['dep_name'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="phan_quyen_nd">
                                <div class="ctn_table">
                                    <p class="th_tilt_tb w_100 float_l d_flex fl_agi dflex_jc share_bgr_one share_clr_tow cr_weight">QUẢN LÝ PHÂN QUYỀN CHO NGƯỜI DÙNG</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="share_tb_five">Quyền người dùng</th>
                                                <th class="share_tb_three">Xem</th>
                                                <th class="share_tb_three">Thêm</th>
                                                <th class="share_tb_three">Sửa</th>
                                                <th class="share_tb_three">Xóa</th>
                                                <th class="share_tb_three">Duyệt / Xác nhận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="share_tb_five">
                                                    <p>Yêu cầu vật tư</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="yeucau_vt">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="yeucau_vt">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="yeucau_vt">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="yeucau_vt">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="5" name="yeucau_vt">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p>Hợp đồng</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="checkedAll_one" id="checkedAll_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="checkedAll_two" id="checkedAll_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="checkedAll_three" id="checkedAll_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="checkedAll_four" id="checkedAll_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Hợp đồng</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="hop_dong" class="checkSingle_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="hop_dong" class="checkSingle_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="hop_dong" class="checkSingle_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="hop_dong" class="checkSingle_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Đơn hàng</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="don_hang" class="checkSingle_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="don_hang" class="checkSingle_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="don_hang" class="checkSingle_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="don_hang" class="checkSingle_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Hồ sơ thanh toán</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="hs_tt" class="checkSingle_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="hs_tt" class="checkSingle_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="hs_tt" class="checkSingle_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="hs_tt" class="checkSingle_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Phiếu thanh toán</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="phieu_tt" class="checkSingle_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="phieu_tt" class="checkSingle_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="phieu_tt" class="checkSingle_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="phieu_tt" class="checkSingle_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Bảng giá</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="bang_gia_one" id="all_banggia_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="bang_gia_two" id="all_banggia_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="bang_gia_three" id="all_banggia_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="bang_gia_four" id="all_banggia_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Bảng giá</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="bang_gia" class="banggia_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Yêu cầu báo giá</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="yc_baogia" class="banggia_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="yc_baogia" class="banggia_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="yc_baogia" class="banggia_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="yc_baogia" class="banggia_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Báo giá</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="bao_gia" class="banggia_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="bao_gia" class="banggia_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="bao_gia" class="banggia_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="bao_gia" class="banggia_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Báo giá khách hàng</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="bao_gia_kh" class="banggia_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="bao_gia_kh" class="banggia_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="bao_gia_kh" class="banggia_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="bao_gia_kh" class="banggia_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Nhà cung cấp</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="nha_cc_one" id="all_nhacc_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="nha_cc_two" id="all_nhacc_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="nha_cc_three" id="all_nhacc_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="nha_cc_four" id="all_nhacc_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Nhà cung cấp</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="nha_cc" class="nha_cc_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="nha_cc" class="nha_cc_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="nha_cc" class="nha_cc_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="nha_cc" class="nha_cc_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Đánh giá nhà cung cấp</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="danhgia_ncc" class="nha_cc_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="danhgia_ncc" class="nha_cc_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="danhgia_ncc" class="nha_cc_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="danhgia_ncc" class="nha_cc_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Tiêu chí đánh giá</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="tc_danhgia" class="nha_cc_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="tc_danhgia" class="nha_cc_two">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="tc_danhgia" class="nha_cc_three">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="tc_danhgia" class="nha_cc_four">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">Khách hàng</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="khach_hang">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="2" name="khach_hang">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="3" name="khach_hang">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="4" name="khach_hang">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">Báo cáo</td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" name="all_bao_cao" id="all_bao_cao">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Doanh số bán hàng</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="dso_bhang" class="bao_cao_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr class="no_bor_bott">
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Công nợ phải thu</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="congno_pthu" class="bao_cao_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                            <tr>
                                                <td class="share_tb_five">
                                                    <p class="padd_l">Báo cáo</p>
                                                </td>
                                                <td class="share_tb_three">
                                                    <div class="form-gr">
                                                        <input type="checkbox" value="1" name="congno_ptra" class="bao_cao_one">
                                                    </div>
                                                </td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                                <td class="share_tb_three"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="v-btn btn-blue mt-20 submit-btn save_phanquyen" style="float: right;">Xong</button>
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
    $(".search_nvpb").select2({
        width: '100%',
    });

    $(".search_nvpb").change(function() {
        var id_nv = $(this).val();
        var com_id = $(".form_search").attr("data");
        $.ajax({
            url: '../render/quyen_thay_doi.php',
            type: 'POST',
            data: {
                id_nv: id_nv,
                com_id: com_id,
            },
            success: function(data) {
                $(".ctn_table").html(data);
            }
        });
    });

    // xem hop dong
    $(document).on('change', '#checkedAll_one', function() {
        if (this.checked) {
            $(".checkSingle_one").each(function() {
                this.checked = true;
            })
        } else {
            $(".checkSingle_one").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.checkSingle_one', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".checkSingle_one").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#checkedAll_one").prop("checked", true);
            }
        } else {
            $("#checkedAll_one").prop("checked", false);
        }
    });
    // them hop dong
    $(document).on('change', '#checkedAll_two', function() {
        if (this.checked) {
            $(".checkSingle_two").each(function() {
                this.checked = true;
            })
        } else {
            $(".checkSingle_two").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.checkSingle_two', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".checkSingle_two").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#checkedAll_two").prop("checked", true);
            }
        } else {
            $("#checkedAll_two").prop("checked", false);
        }
    });
    // sua hop dong
    $(document).on('change', '#checkedAll_three', function() {
        if (this.checked) {
            $(".checkSingle_three").each(function() {
                this.checked = true;
            })
        } else {
            $(".checkSingle_three").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.checkSingle_three', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".checkSingle_three").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#checkedAll_three").prop("checked", true);
            }
        } else {
            $("#checkedAll_three").prop("checked", false);
        }
    });
    // xoa hop dong
    $(document).on('change', '#checkedAll_four', function() {
        if (this.checked) {
            $(".checkSingle_four").each(function() {
                this.checked = true;
            })
        } else {
            $(".checkSingle_four").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.checkSingle_four', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".checkSingle_four").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#checkedAll_four").prop("checked", true);
            }
        } else {
            $("#checkedAll_four").prop("checked", false);
        }
    });

    // xem bang gia
    $(document).on('change', '#all_banggia_one', function() {
        if (this.checked) {
            $(".banggia_one").each(function() {
                this.checked = true;
            })
        } else {
            $(".banggia_one").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.banggia_one', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".banggia_one").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_banggia_one").prop("checked", true);
            }
        } else {
            $("#all_banggia_one").prop("checked", false);
        }
    });
    // them bang gia
    $(document).on('change', '#all_banggia_two', function() {
        if (this.checked) {
            $(".banggia_two").each(function() {
                this.checked = true;
            })
        } else {
            $(".banggia_two").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.banggia_two', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".banggia_two").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_banggia_two").prop("checked", true);
            }
        } else {
            $("#all_banggia_two").prop("checked", false);
        }
    });
    // sua bang gia
    $(document).on('change', '#all_banggia_three', function() {
        if (this.checked) {
            $(".banggia_three").each(function() {
                this.checked = true;
            })
        } else {
            $(".banggia_three").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.banggia_three', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".banggia_three").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_banggia_three").prop("checked", true);
            }
        } else {
            $("#all_banggia_three").prop("checked", false);
        }
    });
    // xoa bang gia
    $(document).on('change', '#all_banggia_four', function() {
        if (this.checked) {
            $(".banggia_four").each(function() {
                this.checked = true;
            })
        } else {
            $(".banggia_four").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.banggia_four', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".banggia_four").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_banggia_four").prop("checked", true);
            }
        } else {
            $("#all_banggia_four").prop("checked", false);
        }
    });

    // xem nha cung cap
    $(document).on('change', '#all_nhacc_one', function() {
        if (this.checked) {
            $(".nha_cc_one").each(function() {
                this.checked = true;
            })
        } else {
            $(".nha_cc_one").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.nha_cc_one', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".nha_cc_one").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_nhacc_one").prop("checked", true);
            }
        } else {
            $("#all_nhacc_one").prop("checked", false);
        }
    });
    // them nha cung cap
    $(document).on('change', '#all_nhacc_two', function() {
        if (this.checked) {
            $(".nha_cc_two").each(function() {
                this.checked = true;
            })
        } else {
            $(".nha_cc_two").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.nha_cc_two', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".nha_cc_two").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_nhacc_two").prop("checked", true);
            }
        } else {
            $("#all_nhacc_two").prop("checked", false);
        }
    });
    // sua nha cung cap
    $(document).on('change', '#all_nhacc_three', function() {
        if (this.checked) {
            $(".nha_cc_three").each(function() {
                this.checked = true;
            })
        } else {
            $(".nha_cc_three").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.nha_cc_three', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".nha_cc_three").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_nhacc_three").prop("checked", true);
            }
        } else {
            $("#all_nhacc_three").prop("checked", false);
        }
    });
    // xoa nha cung cap
    $(document).on('change', '#all_nhacc_four', function() {
        if (this.checked) {
            $(".nha_cc_four").each(function() {
                this.checked = true;
            })
        } else {
            $(".nha_cc_four").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.nha_cc_four', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".nha_cc_four").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_nhacc_four").prop("checked", true);
            }
        } else {
            $("#all_nhacc_four").prop("checked", false);
        }
    });
    // xem bao cao
    $(document).on('change', '#all_bao_cao', function() {
        if (this.checked) {
            $(".bao_cao_one").each(function() {
                this.checked = true;
            })
        } else {
            $(".bao_cao_one").each(function() {
                this.checked = false;
            })
        }
    });
    $(document).on('click', '.bao_cao_one', function() {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $(".bao_cao_one").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $("#all_bao_cao").prop("checked", true);
            }
        } else {
            $("#all_bao_cao").prop("checked", false);
        }
    });

    $(".save_phanquyen").click(function() {
        var com_id = $(".form_search").attr("data");
        var id_nv = $("select[name='search_nv']").val();

        var ycvt = document.getElementsByName("yeucau_vt");
        var yc_vt = "";
        for (var a = 0; a < ycvt.length; a++) {
            if (ycvt[a].checked === true) {
                yc_vt += ycvt[a].value + '_';
            }
        }

        var hopdong = document.getElementsByName("hop_dong");
        var hop_dong = "";
        for (var b = 0; b < hopdong.length; b++) {
            if (hopdong[b].checked === true) {
                hop_dong += hopdong[b].value + '_';
            }
        }

        var donhang = document.getElementsByName("don_hang");
        var don_hang = "";
        for (var c = 0; c < donhang.length; c++) {
            if (donhang[c].checked === true) {
                don_hang += donhang[c].value + '_';
            }
        }

        var hstt = document.getElementsByName("hs_tt");
        var hs_tt = "";
        for (var d = 0; d < hstt.length; d++) {
            if (hstt[d].checked === true) {
                hs_tt += hstt[d].value + '_';
            }
        }

        var phieutt = document.getElementsByName("phieu_tt");
        var phieu_tt = "";
        for (var f = 0; f < phieutt.length; f++) {
            if (phieutt[f].checked === true) {
                phieu_tt += phieutt[f].value + '_';
            }
        }

        var banggia = document.getElementsByName("bang_gia");
        var bang_gia = "";
        for (var g = 0; g < banggia.length; g++) {
            if (banggia[g].checked === true) {
                bang_gia += banggia[g].value + '_';
            }
        }

        var ycbaogia = document.getElementsByName("yc_baogia");
        var yc_baogia = "";
        for (var h = 0; h < ycbaogia.length; h++) {
            if (ycbaogia[h].checked === true) {
                yc_baogia += ycbaogia[h].value + '_';
            }
        }

        var baogia = document.getElementsByName("bao_gia");
        var bao_gia = "";
        for (var j = 0; j < baogia.length; j++) {
            if (baogia[j].checked === true) {
                bao_gia += baogia[j].value + '_';
            }
        }

        var bao_giakh = document.getElementsByName("bao_gia_kh");
        var bao_gia_kh = "";
        for (var n = 0; n < bao_giakh.length; n++) {
            if (bao_giakh[n].checked === true) {
                bao_gia_kh += bao_giakh[n].value + '_';
            }
        }

        var nhacc = document.getElementsByName("nha_cc");
        var nha_cc = "";
        for (var k = 0; k < nhacc.length; k++) {
            if (nhacc[k].checked === true) {
                nha_cc += nhacc[k].value + '_';
            }
        }

        var danhgiancc = document.getElementsByName("danhgia_ncc");
        var danhgia_ncc = "";
        for (var l = 0; l < danhgiancc.length; l++) {
            if (danhgiancc[l].checked === true) {
                danhgia_ncc += danhgiancc[l].value + '_';
            }
        }

        var tcdanhgia = document.getElementsByName("tc_danhgia");
        var tc_danhgia = "";
        for (var q = 0; q < tcdanhgia.length; q++) {
            if (tcdanhgia[q].checked === true) {
                tc_danhgia += tcdanhgia[q].value + '_';
            }
        }

        var khachhang = document.getElementsByName("khach_hang");
        var khach_hang = "";
        for (var b = 0; b < khachhang.length; b++) {
            if (khachhang[b].checked === true) {
                khach_hang += khachhang[b].value + '_';
            }
        }

        var dsobhang = document.getElementsByName("dso_bhang");
        var dso_bhang = "";
        for (var c = 0; c < dsobhang.length; c++) {
            if (dsobhang[c].checked === true) {
                dso_bhang += dsobhang[c].value + '_';
            }
        }

        var congnopthu = document.getElementsByName("congno_pthu");
        var congno_pthu = "";
        for (var z = 0; z < congnopthu.length; z++) {
            if (congnopthu[z].checked === true) {
                congno_pthu += congnopthu[z].value + '_';
            }
        }

        var congnoptra = document.getElementsByName("congno_ptra");
        var congno_ptra = "";
        for (var t = 0; t < congnoptra.length; t++) {
            if (congnoptra[t].checked === true) {
                congno_ptra += congnoptra[t].value + '_';
            }
        };


        $.ajax({
            url: '../ajax/phan_quyen.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_nv: id_nv,
                yc_vt: yc_vt,
                hop_dong: hop_dong,
                don_hang: don_hang,
                hs_tt: hs_tt,
                phieu_tt: phieu_tt,
                bang_gia: bang_gia,
                yc_baogia: yc_baogia,
                bao_gia: bao_gia,
                bao_gia_kh: bao_gia_kh,
                nha_cc: nha_cc,
                danhgia_ncc: danhgia_ncc,
                tc_danhgia: tc_danhgia,
                khach_hang: khach_hang,
                dso_bhang: dso_bhang,
                congno_pthu: congno_pthu,
                congno_ptra: congno_ptra,
            },
            success: function(data) {
                if (data == "") {
                    alert("Bạn phân quyền thành công");
                    window.location.reload();
                }else if(data != ""){
                    alert(data);
                }
            }
        });
    });
</script>

</html>