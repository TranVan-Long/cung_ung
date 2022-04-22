<?php
include "../includes/icon.php";
include "config.php";

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
        $phan_loai_nk = 1;

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
        $coun = count($list_nv);
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $user_name = $_SESSION['ep_name'];
        $phan_loai_nk = 2;

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
        $coun = count($list_nv);

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang3 = explode(',', $item_nv['don_hang']);
            if (in_array(3, $don_hang3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};

$list_kh = new db_query("SELECT DISTINCT n.`id`, n.`ten_nha_cc_kh`, n.`id_cong_ty` FROM `nha_cc_kh` AS n
                        INNER JOIN `hop_dong` AS h ON n.`id` = h.`id_nha_cc_kh`
                        WHERE n.`phan_loai` = 2 AND n.`id_cong_ty` = $com_id AND h.`phan_loai` = 2 ");

$curl = curl_init();
$token = $_COOKIE['acc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$all_ctrinh = $data_list['data']['items'];
$cou = count($all_ctrinh);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm đơn hàng bán vật tư</title>
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
    <div class="main-container ql_them_dh_ban">
        <? include('../includes/sidebar.php') ?>

        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-don-hang.html">
                            Quay lại</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Thêm đơn hàng bán vật tư</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $user_id ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $phan_loai_nk ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Tên khách hàng <span class="cr_red">*</span></label>
                                        <select name="ten_khach_hang" class="form-control all_nhacc ">
                                            <option value="">Nhập tên khách hàng</option>
                                            <? while ($item1 = mysql_fetch_assoc($list_kh->result)) { ?>
                                                <option value="<?= $item1['id'] ?>"><?= $item1['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group thay_doi_dc">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="dia_chi" value="" class="form-control" placeholder="Địa chỉ liên hệ khách hàng" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Người liên hệ</label>
                                        <? if ($phan_loai_nk == 1) { ?>
                                            <select name="nguoi_lh" class="form-control share_select all_nvct">
                                                <option value="">-- Chọn người liên hệ --</option>
                                                <? for ($i = 0; $i < $coun; $i++) { ?>
                                                    <option value="<?= $list_nv[$i]['ep_id'] ?>">(<?= $list_nv[$i]['ep_id'] ?>) <?= $list_nv[$i]['ep_name'] ?></option>
                                                <? } ?>
                                            </select>
                                        <? } else if ($phan_loai_nk == 2) { ?>
                                            <input type="text" name="nguoi_lh" class="form-control all_nvct" value="<?= $user_name ?>" data-id="<?= $user_id ?>" readonly>
                                        <? } ?>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Số điện thoại / Fax</label>
                                        <input type="text" name="so_dthoai" value="" class="form-control" oninput="<?= $oninput ?>" placeholder="Số điện thoại / Fax khách hàng" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Hợp đồng <span class="cr_red">*</span></label>
                                        <select name="hop_dong" class="form-control all_hd">
                                            <option value="">-- Chọn hợp đồng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày ký đơn hàng</label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình</label>
                                        <select name="duan_ctrinh" class="form-control all_da_ct">
                                            <option value="">-- Chọn Dự án / Công trình --</option>
                                            <? for ($i = 0; $i < $cou; $i++) { ?>
                                                <option value="<?= $all_ctrinh[$i]['ctr_id'] ?>"><?= $all_ctrinh[$i]['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thời hạn đơn hàng</label>
                                        <input type="date" name="thoi_han" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Đơn vị nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control" placeholder="Nhập đơn vị nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Phòng ban</label>
                                        <input type="text" name="phong_ban" class="form-control" placeholder="Nhập phòng ban người nhận">
                                    </div>
                                    <div class="form-group">
                                        <label>Người nhận hàng <span class="cr_red">*</span></label>
                                        <input type="text" name="nguoi_nh" class="form-control" placeholder="Nhập người nhận hàng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số điện thoại người nhận</label>
                                        <input type="text" name="dient_nnhan" value="" class="form-control" oninput="<?= $oninput ?>" placeholder="Nhập số điện thoại người nhận">
                                    </div>
                                    <div class="form-group">
                                        <label>Giữ lại bảo hành</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" class="baoh_pt pt_bao_hanh pl-10 share_fsize_tow" oninput="<?= $oninput ?>" onkeyup="baoHanh()">
                                            </div>
                                            <span>tương đương</span>
                                            <input type="text" name="gia_tri" class="gia_tri gia_tri_bh pl-10 share_fsize_tow" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nhập ghi chú"></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị trước VAT</label>
                                        <input type="text" name="giatr_vat" id="tong_truoc_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="lab_cli">Đơn giá đã bao gồm VAT</label>
                                        <input type="checkbox" name="dgia_vat" id="lab_cli">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Thuế suất VAT</label>
                                        <input type="text" name="tong_thue_vat" class="form-control thue_vat_tong" placeholder="Nhập thuế suất VAT" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiền chiết khấu</label>
                                        <input type="text" name="tien_ckhau" class="form-control" oninput="<?= $oninput ?>" placeholder="Nhập số tiền chiết khấu">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Giá trị sau VAT</label>
                                        <input type="text" name="gias_vat" id="tong_sau_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Chi phí vận chuyển</label>
                                        <input type="text" name="chi_phi_vc" class="form-control" oninput="<?= $oninput ?>" placeholder="Nhập chi phí vận chuyển">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi chú vận chuyển</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control" placeholder="Nhập ghi chú vận chuyển"></textarea>
                                </div>

                                <div class="them_moi_vt w_100 float_l mt_25">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_one">Mã vật tư</th>
                                                    <th class="share_tb_two">Tên đầy đủ vật tư thiết bị</th>
                                                    <th class="share_tb_seven">Đơn vị tính</th>
                                                    <th class="share_tb_two">Hãng sản xuất</th>
                                                    <th class="share_tb_eight">Số lượng theo hợp đồng</th>
                                                    <th class="share_tb_eight">Số lượng lũy kế kỳ trước</th>
                                                    <th class="share_tb_one">Số lượng kỳ này</th>
                                                    <th class="share_tb_eight">Thời gian giao hàng</th>
                                                    <th class="share_tb_two">Đơn giá</th>
                                                    <th class="share_tb_two">Tổng tiền trước VAT</th>
                                                    <th class="share_tb_seven">Thuế VAT</th>
                                                    <th class="share_tb_eight">Tổng tiền sau VAT</th>
                                                    <th class="share_tb_two">Địa điểm giao hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button dh_button">
                                        <button type="button" class="cancel_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">Hủy</button>
                                        <button type="button" class="save_add share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
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
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc thêm đơn hàng?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex dh_dy_pop">
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
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript" src="../js/ql_them_dh_ban.js"></script>

</html>