<?php
include "../includes/icon.php";
include("config.php");

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `hd_nguyen_tac`, `hinh_thuc_hd`, `gia_tri_trvat`, `bao_gom_vat`, `thue_vat`, `gia_tri_svat`,`tien_chiet_khau`, `giu_lai_bhanh`, `gia_tri_bhanh`, `thoi_han_blanh`,`bao_lanh_hd`,`gia_tri_blanh`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `bgom_vchuyen`, `ten_ngan_hang`, `so_tk`,`id_bao_gia`, `thoa_tuan_hoa_don`,  `yc_tien_do`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ncc_id = $hd_detail['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);

    $ep_name = $_SESSION['ep_name'];
    $ep_id = $_SESSION['ep_id'];
}
if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2) {
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

    foreach ($data_list_nv as $key => $items) {
        $user_name = $items['ep_name'];
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
        $comp_id = $items['com_id'];
    }
    $curl = curl_init();
    $data = array(
        'id_com' => $comp_id,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
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

    $curl = curl_init();
    $data = array(
        'id_com' => $comp_id,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_ct = json_decode($response, true);
    $cong_trinh_data = $list_ct['data']['items'];
}

// echo "<pre>";
// print_r($cong_trinh_detail);
// echo "</pre>";
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết hợp đồng mua</title>
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
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one mb_26 share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi
                            tiết hợp đồng mua</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $hd_id ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= date('d/m/Y', $hd_detail['ngay_ky_hd']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nhà cung cấp</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ncc['ten_nha_cc_kh'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Dự án / Công trình</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $cong_trinh_data[$hd_detail['id_du_an_ctrinh']]['ctr_name'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng nguyên tắc</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['hd_nguyen_tac']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['hd_nguyen_tac']) ? "Có" : "Không" ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hình thức hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['hinh_thuc_hd'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giá trị trước VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($hd_detail['gia_tri_trvat']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn giá đã bao gồm VAT</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['bao_gom_vat']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['bao_gom_vat']) ? "Có" : "Không" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thuế suất VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['thue_vat'] ?>%</p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tiền chiết khấu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['tien_chiet_khau'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giá trị sau VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($hd_detail['gia_tri_svat']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giữ lại bảo hành</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['giu_lai_bhanh'] ?>% tương đương <?= formatMoney($hd_detail['gia_tri_bhanh']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Bảo lãnh thực hiện hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['bao_lanh_hd'] ?>% tương đương <?= formatMoney($hd_detail['gia_tri_blanh']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời hạn bảo lãnh</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= date('d/m/Y', $hd_detail['thoi_han_blanh']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời gian thực hiện</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= date('d/m/Y', $hd_detail['tg_bd_thuc_hien']) ?> - <?= date('d/m/Y', $hd_detail['tg_kt_thuc_hien']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng bao gồm vận chuyển</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['bgom_vchuyen']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['bgom_vchuyen']) ? "Có" : "Không" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tên ngân hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['ten_ngan_hang'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số tài khoản</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['so_tk'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Báo giá</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">BG - <?= $hd_detail['id_bao_gia'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thỏa thuận hóa đơn</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['thoa_tuan_hoa_don'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Yêu cầu về tiến độ</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['yc_tien_do'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nội dung hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['noi_dung_hd'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Nội dung cần lưu ý</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['noi_dung_luu_y'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Điều khoản thanh toán</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['dieu_khoan_tt'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table w_100 float_l">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Mã vật tư</th>
                                            <th class="share_tb_two">Tên vật tư</th>
                                            <th class="share_tb_two">Đơn vị tính</th>
                                            <th class="share_tb_two">Hãng sản xuất</th>
                                            <th class="share_tb_two">Xuất xứ</th>
                                            <th class="share_tb_one">Số lượng</th>
                                            <th class="share_tb_two">Đơn giá</th>
                                            <th class="share_tb_two">Tổng tiền trước VAT</th>
                                            <th class="share_tb_two">Thuế VAT (%)</th>
                                            <th class="share_tb_two">Tổng tiền sau VAT</th>
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
                                                <td class="share_tb_two"><?= $vat_tu['don_gia'] ?></td>
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
                            <div class="xuat_gmc_two share_xuat_gmc d_flex mb_10 right">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">
                                    Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="chinh-sua-hop-dong-mua-<?= $hd_id?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                </p>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc d_flex left mb_10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20">Gửi
                                    mail</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popup xóa -->

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỢP ĐỒNG MUA</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hợp đồng mua này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp xoa_hd_mua" data-id="<?= $hd_id ?>">Đồng
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
<script>
    $(".tim_kiem, .tim_kiem_o").select2({
        width: '100%',
    });

    var modal_share = $(".modal_share");
    var remove_hd = $(".remove_hd");

    var close_dectl = $(".close_dectl");
    var js_btn_huy = $(".js_btn_huy");

    remove_hd.click(function() {
        modal_share.show();
    });

    close_dectl.click(function() {
        modal_share.hide();
    });

    js_btn_huy.click(function() {
        modal_share.hide();
    });

    $(".xoa_hd_mua").click(function() {
        var id = $(this).attr("data-id");
        //log record
        var ep_id = '<?= $ep_id ?>';
        var hd_id = '<?= $hd_id ?>';
        var loai = "mua vật tư"
        $.ajax({
            url: '../ajax/hd_xoa.php',
            type: 'POST',
            data: {
                id: id,
                ep_id: ep_id,
                hd_id: hd_id,
                loai: loai,
            },
            success: function(data) {
                if (data == "") {
                    window.location.href = '/quan-ly-hop-dong.html';
                } else {
                    alert("Bị lỗi");
                }
            }
        });
    });
</script>

</html>