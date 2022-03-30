<?php
include "../includes/icon.php";
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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `hop_dong` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $hop_dong = explode(',', $item_nv['hop_dong']);
            if (in_array(3, $hop_dong) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
}

$date = date('m-d-Y', time());
if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = '" . $hd_id . "' ");
    $hd_vat_tu = new db_query("SELECT * FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = '" . $hd_id . "' ");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
    $cong_trinh = $hd_detail['id_du_an_ctrinh'];
    $id_ncc = $hd_detail['id_nha_cc_kh'];
    $thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);
    $ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
    $ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);

    $curl = curl_init();
    $data = array(
            'id_com' => $com_id,
        );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $list_cong_trinh = json_decode($response, true);
    $cong_trinh_data = $list_cong_trinh['data']['items'];
}else{
    header('Location: /quan-ly-trang-chu.html');
}



?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa hợp đồng thuê vận chuyển</title>
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
    <div class="main-container ql_them_hd_vc ql_ctiet_hd_vc">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_25 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-hop-dong.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Sửa hợp đồng thuê vận chuyển</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" method="">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" value="HĐ - <?= $hd_id ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký hợp đồng <span class="cr_red">*</span></label>
                                        <input type="date" name="ngay_ky_hd" id="ngay_ky_hd" value="<?= $ngay_hop_dong ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Nhà cung cấp <span class="cr_red">*</span></label>
                                        <select name="id_nha_cung_cap" class="form-control all_nhacc">
                                            <option value="">-- Chọn nhà cung cấp --</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_ncc == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình <span class="cr_red">*</span></label>
                                        <select name="dan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $cong_trinh) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="number" name="truoc_vat" id="tong_truoc_vat" value="<?= $hd_detail['gia_tri_trvat'] ?>" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="don_gia_vat">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" id="don_gia_vat" name="don_gia_vat" <?= ($hd_detail['bao_gom_vat'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thuế suất VAT</label>
                                        <input type="number" name="thue_vat" value="<?= $hd_detail['thue_vat'] ?>" class="form-control thue_vat_tong" onkeyup="tong_vt()" placeholder="Nhập thuế suất VAT">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="number" name="sau_vat" value="<?= $hd_detail['gia_tri_svat'] ?>" id="tong_sau_vat" class="form-control cr_weight h_border" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="number" name="bao_hanh" onkeyup="baoHanh()" value="<?= $hd_detail['giu_lai_bhanh'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_hanh">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="number" name="gt_bao_hanh" value="<?= $hd_detail['gia_tri_bhanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bh" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Bảo lãnh thực hiện hợp đồng</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="number" name="bao_lanh" onkeyup="baoLanh()" value="<?= $hd_detail['bao_lanh_hd'] ?>" class="baoh_pt gr_padd share_fsize_tow pt_bao_lanh">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="number" name="gt_bao_lanh" value="<?= $hd_detail['gia_tri_blanh'] ?>" class="gia_tri gr_padd share_fsize_tow gia_tri_bl" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn bảo lãnh</label>
                                        <input type="date" name="han_bao_lanh" value="<?= $thoi_han_bl ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Thời gian thực hiện</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" value="<?= $ngay_bat_dau ?>" class="gia_tri gr_padd share_fsize_tow">
                                            <span>đến</span>
                                            <input type="date" name="ngay_ket_thuc" value="<?= $ngay_ket_thuc ?>" class="gia_tri gr_padd share_fsize_tow">
                                        </div>
                                    </div>
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="bao_gom_van_chuyen">Hợp đồng đã bao gồm vận chuyển</label>
                                        <input type="checkbox" id="bao_gom_van_chuyen" name="bao_gom_van_chuyen" <?= ($hd_detail['bgom_vchuyen'] == 1) ? "checked" : "" ?>>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Hạn mức tín dụng</label>
                                        <input type="number" name="hmuc_tind" value="<?= $hd_detail['han_muc_tin_dung'] ?>" class="form-control" placeholder="Nhập hạn mức tín dụng">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Yêu cầu về tiến độ</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nhập yêu cầu về tiến độ"><?= $hd_detail['yc_tien_do'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung hợp đồng</label>
                                    <textarea name="noi_dung_hd" rows="5" class="form-control" placeholder="Nhập nội dung hợp đồng"><?= $hd_detail['noi_dung_hd'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Nội dung cần lưu ý</label>
                                    <textarea name="noi_dung_luu_y" rows="5" class="form-control" placeholder="Nhập nội dung cần lưu ý"><?= $hd_detail['noi_dung_luu_y'] ?></textarea>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Điều khoản thanh toán</label>
                                    <textarea name="dieu_khoan_tt" rows="5" class="form-control" placeholder="Nhập điều khoản thanh toán"><?= $hd_detail['dieu_khoan_tt'] ?></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group autocomplete">
                                        <label>Tên ngân hàng</label>
                                        <input type="text" name="ten_nh" id="ten_nh" value="<?= $hd_detail['ten_ngan_hang'] ?>" class="form-control" autocomplete="off" placeholder="Nhập tên ngân hàng">
                                    </div>
                                    <div class="form-group">
                                        <label>Số tài khoản</label>
                                        <input type="number" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nhập số tài khoản">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm mới vật tư</p>
                                    <div class="ctn_table w_100 float_l khac_ctn_vc">
                                        <table class="table w_100 float_l">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_one"></th>
                                                    <th class="share_tb_five">Vật tư / Tên thiết bị / Vật tư vận chuyển</th>
                                                    <th class="share_tb_six mass_pad">
                                                        <div class="w_100 float_l">
                                                            <p class="w_100 float_l khoi_luong share_clr_tow">Khối lượng</p>
                                                            <div class="d_flex w_100 float_l dvi_khoil">
                                                                <p class="ft-pl share_clr_tow">Đơn vị tính</p>
                                                                <p class="ft-pl share_clr_tow">Khối lượng</p>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="share_tb_four">Đơn giá</th>
                                                    <th class="share_tb_four">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                $get_vt_vc = new db_query("SELECT * FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $hd_id");
                                                while ($vt_vc_fetch = mysql_fetch_assoc($get_vt_vc->result)) {
                                                ?>
                                                    <tr class="item">
                                                        <td class="share_tb_one">
                                                            <p class="modal-btn" data-target="xoa-vt-<?= $vt_vc_fetch['id'] ?>"><i class="ic-delete remove-btn"></i></p>
                                                        </td>
                                                        <td class="share_tb_five">
                                                            <div class="form-group">
                                                                <input type="hiden" name="id_tb_vt_old" value="<?= $vt_vc_fetch['id'] ?>" class="share_dnone">
                                                                <input type="text" name="thietb_vt_old" value="<?= $vt_vc_fetch['vat_tu'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group">
                                                                <input type="text" name="don_vi_tinh_old" value="<?= $vt_vc_fetch['don_vi_tinh'] ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_three">
                                                            <div class="form-group">
                                                                <input type="number" name="khoi_luong_old" value="<?= $vt_vc_fetch['khoi_luong'] ?>" class="form-control so_luong" onkeyup="sl_doi(this),tong_vt(), baoLanh(),baoHanh()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_four">
                                                            <div class="form-group">
                                                                <input type="number" name="don_gia_old" value="<?= $vt_vc_fetch['don_gia'] ?>" class="form-control don_gia" onkeyup="dg_doi(this),tong_vt(), baoLanh(),baoHanh()">
                                                            </div>
                                                        </td>
                                                        <td class="share_tb_four">
                                                            <div class="form-group">
                                                                <input type="hiden" name="vat_ao" value="0" class="share_dnone thue_vat">
                                                                <input type="number" name="thanh_tien_old" value="<?= $vt_vc_fetch['thanh_tien'] ?>" class="form-control h_border tong_svat" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="xoa-vt-<?= $vt_vc_fetch['id'] ?>">
                                                        <div class="m-content">
                                                            <div class="m-head ">
                                                                Thông báo <span class="dismiss cancel">&times;</span>
                                                            </div>
                                                            <div class="m-body">
                                                                <p>Bạn có chắc chắn muốn xóa vật tư/thiết bị này?</p>
                                                                <p>Thao tác này sẽ không thể hoàn tác.</p>
                                                            </div>
                                                            <div class="m-foot d-inline-block">
                                                                <div class="left mb_10">
                                                                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                                                </div>
                                                                <div class="right mb_10">
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right xoa_vt_tb" data-id="<?= $vt_vc_fetch['id'] ?>" onclick="tong_vt(),baoLanh(),baoHanh()">Đồng ý</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button hd_button">
                                        <button type="button" class="cancel_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop ctiet_pop_vc mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hợp đồng thuê vận chuyển?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex hd_dy_pop">
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
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/bank-name.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

<script>
    $(window).on("load", function() {
        tong_vt();
        baoLanh();
        baoHanh();
    });
    $(document).on('click', '.remo_cot_ngang, .remove-btn', function() {
        tong_vt();
        baoLanh();
        baoHanh();
    })

    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });
    autocomplete(document.getElementById("ten_nh"), bank);

    $('.add_vat_tu').click(function() {
        var html = `<tr class="item">
                        <td class="share_tb_one">
                            <p>
                                <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor" onclick="tong_vt(),baoLanh(),baoHanh()">
                            </p>
                        </td>
                        <td class="share_tb_five">
                            <div class="form-group">
                                <input type="text" name="thietb_vt" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_three">
                            <div class="form-group">
                                <input type="text" name="don_vi_tinh" class="form-control">
                            </div>
                        </td>
                        <td class="share_tb_three">
                            <div class="form-group">
                                <input type="number" name="khoi_luong" class="form-control so_luong" onkeyup="sl_doi(this),tong_vt()">
                            </div>
                        </td>
                        <td class="share_tb_four">
                            <div class="form-group">
                                <input type="number" name="don_gia" class="form-control don_gia" onkeyup="dg_doi(this),tong_vt()">
                            </div>
                        </td>
                        <td class="share_tb_four">
                            <div class="form-group">
                                <input type="hiden" name="vat_ao" value="0" class="share_dnone thue_vat" >
                                <input type="number" name="thanh_tien" class="form-control h_border tong_svat" readonly>
                            </div>
                        </td>
                    </tr>`;
        $(".ctn_table .table tbody").append(html);
        widthSelect();

        if ($(".ctn_table .table tbody").height() > 105.5) {
            $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
        }
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });
    $(".xoa_vt_tb").click(function() {

        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/hd_vc_xoa_vt.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert(data);
                }
            }
        });
    });

    $(".save_add").click(function() {
        var form_edit_vc = $(".form_add_hp_mua");
        form_edit_vc.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky_hd: {
                    required: true,
                },
                id_nha_cung_cap: {
                    required: true,
                }
            },
            messages: {
                ngay_ky_hd: {
                    required: "Không được để trống",
                },
                id_nha_cung_cap: {
                    required: "Không được để trống",
                }
            },
        });

        if (form_edit_vc.valid() === true) {
            var ep_id = '<?= $user_id ?>';
            var com_id = '<?= $com_id ?>';

            var hd_id = <?= $hd_id ?>;
            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_nha_cung_cap = $("select[name='id_nha_cung_cap']").val();
            var dan_ctrinh = $("select[name='dan_ctrinh']").val();

            var truoc_vat = $("input[name='truoc_vat']").val();
            var don_gia_vat = 0;
            if ($("input[name='don_gia_vat']").is(":checked")) {
                don_gia_vat = 1;
            }
            var thue_vat = $("input[name='thue_vat']").val();
            var sau_vat = $("input[name='sau_vat']").val();
            var bao_hanh = $("input[name='bao_hanh']").val();
            var gt_bao_hanh = $("input[name='gt_bao_hanh']").val();
            var bao_lanh = $("input[name='bao_lanh']").val();
            var gt_bao_lanh = $("input[name='gt_bao_lanh']").val();
            var han_bao_lanh = $("input[name='han_bao_lanh']").val();
            var ngay_bat_dau = $("input[name='ngay_bat_dau']").val();
            var ngay_ket_thuc = $("input[name='ngay_ket_thuc']").val();
            var bao_gom_van_chuyen = 0
            if ($("input[name='bao_gom_van_chuyen']").is(":checked")) {
                bao_gom_van_chuyen = 1;
            }
            var hmuc_tind = $("input[name='hmuc_tind']").val();
            var yc_tiendo = $("textarea[name='yc_tiendo']").val();
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();

            var vt_id_vat_tu_old = new Array();
            $("input[name='id_tb_vt_old']").each(function() {
                var id_vat_tu_old = $(this).val();
                if (id_vat_tu_old != "") {
                    vt_id_vat_tu_old.push(id_vat_tu_old);
                }
            });

            var vt_vat_tu_old = new Array();
            $("input[name='thietb_vt_old']").each(function() {
                var ten_vat_tu_old = $(this).val();
                if (ten_vat_tu_old != "") {
                    vt_vat_tu_old.push(ten_vat_tu_old);
                }
            });
            var vt_don_vi_tinh_old = new Array();
            $("input[name='don_vi_tinh_old']").each(function() {
                var sl_vt_old = $(this).val();
                if (sl_vt_old != "") {
                    vt_don_vi_tinh_old.push(sl_vt_old);
                }
            });
            var vt_khoi_luong_old = new Array();
            $("input[name='khoi_luong_old']").each(function() {
                var kl_vt_old = $(this).val();
                if (kl_vt_old != "") {
                    vt_khoi_luong_old.push(kl_vt_old);
                }
            });
            var vt_don_gia_old = new Array();
            $("input[name='don_gia_old']").each(function() {
                var dg_vat_old = $(this).val();
                if (dg_vat_old != "") {
                    vt_don_gia_old.push(dg_vat_old);
                }
            });
            var vt_thanh_tien_old = new Array();
            $("input[name='thanh_tien_old']").each(function() {
                var tt_vt_old = $(this).val();
                if (tt_vt_old != "") {
                    vt_thanh_tien_old.push(tt_vt_old);
                }
            });

            var vt_vat_tu = new Array();
            $("input[name='thietb_vt']").each(function() {
                var ten_vat_tu = $(this).val();
                if (ten_vat_tu != "") {
                    vt_vat_tu.push(ten_vat_tu);
                }
            });
            var vt_don_vi_tinh = new Array();
            $("input[name='don_vi_tinh']").each(function() {
                var sl_vt = $(this).val();
                if (sl_vt != "") {
                    vt_don_vi_tinh.push(sl_vt);
                }
            });
            var vt_khoi_luong = new Array();
            $("input[name='khoi_luong']").each(function() {
                var kl_vt = $(this).val();
                if (kl_vt != "") {
                    vt_khoi_luong.push(kl_vt);
                }
            });
            var vt_don_gia = new Array();
            $("input[name='don_gia']").each(function() {
                var dg_vat = $(this).val();
                if (dg_vat != "") {
                    vt_don_gia.push(dg_vat);
                }
            });
            var vt_thanh_tien = new Array();
            $("input[name='thanh_tien']").each(function() {
                var tt_vt = $(this).val();
                if (tt_vt != "") {
                    vt_thanh_tien.push(tt_vt);
                }
            });

            if (ngay_bat_dau < ngay_ky_hd) {
                alert("Ngày bắt đầu không được nhỏ hơn ngày ký hợp đồng.")
            } else {
                if (ngay_ket_thuc < ngay_bat_dau) {
                    alert("Ngày kết thúc không được nhỏ hơn ngày bắt đầu.")
                } else {
                    $.ajax({
                        url: '../ajax/hd_vc_sua.php',
                        type: 'POST',
                        data: {
                            ep_id: ep_id,
                            com_id: com_id,

                            hd_id: hd_id,
                            ngay_ky_hd: ngay_ky_hd,
                            id_nha_cung_cap: id_nha_cung_cap,
                            dan_ctrinh: dan_ctrinh,
                            truoc_vat: truoc_vat,
                            don_gia_vat: don_gia_vat,
                            thue_vat: thue_vat,
                            sau_vat: sau_vat,
                            bao_hanh: bao_hanh,
                            gt_bao_hanh: gt_bao_hanh,
                            bao_lanh: bao_lanh,
                            gt_bao_lanh: gt_bao_lanh,
                            han_bao_lanh: han_bao_lanh,
                            ngay_bat_dau: ngay_bat_dau,
                            ngay_ket_thuc: ngay_ket_thuc,
                            bao_gom_van_chuyen: bao_gom_van_chuyen,
                            hmuc_tind: hmuc_tind,
                            yc_tiendo: yc_tiendo,
                            noi_dung_hd: noi_dung_hd,
                            noi_dung_luu_y: noi_dung_luu_y,
                            dieu_khoan_tt: dieu_khoan_tt,
                            ten_nh: ten_nh,
                            so_taik: so_taik,

                            vt_id_vat_tu_old: vt_id_vat_tu_old,
                            vt_vat_tu_old: vt_vat_tu_old,
                            vt_don_vi_tinh_old: vt_don_vi_tinh_old,
                            vt_khoi_luong_old: vt_khoi_luong_old,
                            vt_don_gia_old: vt_don_gia_old,
                            vt_thanh_tien_old: vt_thanh_tien_old,

                            vt_vat_tu: vt_vat_tu,
                            vt_don_vi_tinh: vt_don_vi_tinh,
                            vt_khoi_luong: vt_khoi_luong,
                            vt_don_gia: vt_don_gia,
                            vt_thanh_tien: vt_thanh_tien
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Chỉnh sửa hợp đồng thuê vận chuyển thành công!");
                                window.location.href = 'quan-ly-chi-tiet-hop-dong-van-chuyen-<?= $hd_id ?>.html';
                            } else {
                                alert(data);
                            }
                        }
                    })
                }
            }
        }
    });
</script>

</html>