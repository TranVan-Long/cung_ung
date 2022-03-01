<?php
include "../includes/icon.php";
include("config.php");

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `thue_noi_bo`, `hinh_thuc_hd`, `ten_ngan_hang`, `so_tk`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $hd_id");
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
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_ct = json_decode($response, true);
    $cong_trinh_data = $list_ct['data']['items'];

    $cong_trinh_detail = [];
    for ($i = 0; $i < count($cong_trinh_data); $i++) {
        $items_ct = $cong_trinh_data[$i];
        $cong_trinh_detail[$items_ct['ctr_id']] = $items_ct;
    }
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
    <title>Chi tiết hợp đồng thuê thiết bị</title>
    <link href="../css/select2.min.css" rel="stylesheet" />
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
    <div class="main-container ql_ctiet_hd_thue">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-hop-dong.html">Quay lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi tiết hợp đồng thuê thiết bị</h4>
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
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $cong_trinh_detail[$hd_detail['id_du_an_ctrinh']]['ctr_name'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thuê nội bộ</p>
                                    <p class="cr_weight share_fsize_tow <?= ($hd_detail['thue_noi_bo']) ? "text-green" : "text-red" ?>"><?= ($hd_detail['thue_noi_bo']) ? "Có" : "Không" ?></p>
                                </div>
                            </div>
                            <!-- <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hình thức hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $hd_detail['hinh_thuc_hd'] ?></p>
                                </div>
                            </div> -->
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Loại tài sản thiết bị</th>
                                            <th class="share_tb_two">Thông số kỹ thuật</th>
                                            <th class="share_tb_one">Số lượng</th>
                                            <th class="share_tb_two">Thời gian thuê</th>
                                            <th class="share_tb_one">Đợn vị tính</th>
                                            <th class="share_tb_one">Khối lượng dự kiến</th>
                                            <th class="share_tb_one">Hạn mức ca máy</th>
                                            <th class="share_tb_one">Đơn giá thuế</th>
                                            <th class="share_tb_two">Đơn giá ca máy phụ hồi</th>
                                            <th class="share_tb_two">Thành tiền dự kiến</th>
                                            <th class="share_tb_two">Thỏa thuận khác</th>
                                            <th class="share_tb_two">Lưu ý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $stt = 1;
                                        $get_tb_detail = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $hd_id");
                                        while ($thiet_bi = mysql_fetch_assoc($get_tb_detail->result)) {
                                        ?>
                                            <tr>
                                                <td class="share_tb_one"><?= $stt++ ?></td>
                                                <td class="share_tb_two"><?= $thiet_bi['loai_tai_san'] ?></td>
                                                <td class="share_tb_two"><?= $thiet_bi['thong_so_kthuat'] ?></td>
                                                <td class="share_tb_one"><?= $thiet_bi['so_luong'] ?></td>
                                                <td class="share_tb_two">
                                                    <? if ($thiet_bi['thue_tu_ngay'] == 0 && $thiet_bi['thue_den_ngay'] == 0) { ?>
                                                        Không có dữ liệu.
                                                    <? } else { ?>
                                                        <?= date('d/m/Y', $thiet_bi['thue_tu_ngay']) ?> - <?= date('d/m/Y', $thiet_bi['thue_den_ngay']) ?>
                                                    <? } ?>
                                                </td>
                                                <td class="share_tb_one"><?= $thiet_bi['don_vi_tinh'] ?></td>
                                                <td class="share_tb_one"><?= $thiet_bi['khoi_luong_du_kien'] ?></td>
                                                <td class="share_tb_one"><?= formatMoney($thiet_bi['han_muc_ca_may']) ?></td>
                                                <td class="share_tb_one"><?= formatMoney($thiet_bi['don_gia_thue']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($thiet_bi['dg_ca_may_phu_troi']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($thiet_bi['thanh_tien_du_kien']) ?></td>
                                                <td class="share_tb_two"><?= $thiet_bi['thoa_thuan_khac'] ?></td>
                                                <td class="share_tb_two"><?= $thiet_bi['luu_y'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc mb_10 d_flex right">
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">Xóa</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                    <a href="chinh-sua-hop-dong-thue-thiet-bi-<?= $hd_id?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                </p>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc mb_10 d_flex left mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight">Xuất Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20">Gửi mail</p>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA HỢP ĐỒNG THUÊ THIẾT BỊ</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa hợp đồng thuê thiết bị này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp xoa_hd_thue" data-id="<?= $hd_id ?>">Đồng
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
    var remove_hd = $(".remove_hd");
    remove_hd.click(function() {
        modal_share.show();
    });

    $(".xoa_hd_thue").click(function() {
        var id = $(this).attr("data-id");
        //log record
        var ep_id = '<?= $ep_id ?>';
        var hd_id = '<?= $hd_id ?>';
        var loai = "thuê thiết bị"
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