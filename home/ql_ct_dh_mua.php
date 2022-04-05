<?
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];

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
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $com_name = $_SESSION['com_name'];

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
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang2 = explode(',', $item_nv['don_hang']);
            if (in_array(1, $don_hang2) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }

    $all_nv = [];
    for ($i = 0; $i < count($list_nv); $i++) {
        $item_one = $list_nv[$i];
        $all_nv[$item_one["ep_id"]] = $item_one;
    };
} else if (!isset($_COOKIE['acc_token']) || !isset($_COOKIE['rf_token']) || !isset($_COOKIE['role'])) {
    header('Loaction: /');
}


$id_dh = getValue('id', 'int', 'GET', '');
if ($id_dh != "") {

    $list_dhm = new db_query("SELECT d.`id`, d.`id_nha_cc_kh`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`ngay_ky`, d.`thoi_han`, d.`don_vi_nhan_hang`,
                                d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`, d.`ghi_chu`,
                                d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`ngay_tao`, h.`id_du_an_ctrinh`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`, l.`ten_nguoi_lh`
                                FROM `don_hang` AS d
                                INNER JOIN `hop_dong` AS h ON d.`id_hop_dong` = h.`id`
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                INNER JOIN `nguoi_lien_he` AS l ON d.`id_nguoi_lh` = l.`id`
                                WHERE  d.`id` = $id_dh AND d.`phan_loai` = 1 AND d.`id_cong_ty` = $com_id ");

    $item = mysql_fetch_assoc($list_dhm->result);
    $id_ctrinh = $item['id_du_an_ctrinh'];

    $list_vt_dhm = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_ky_nay`, `thoi_gian_giao_hang`,
                                    `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                    FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_dh AND `id_cong_ty` = $com_id ");
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
    $data_list = json_decode($response, true);
    $list_ctrinh = $data_list['data']['items'];
    $cou1 = count($list_ctrinh);

    $all_ctrinh = [];
    for ($i = 0; $i < $cou1; $i++) {
        $item1 = $list_ctrinh[$i];
        $all_ctrinh[$item1['ctr_id']] = $item1;
    };
    $ten_ctrinh = $all_ctrinh[$id_ctrinh]['ctr_name'];

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

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://chamcong.24hpay.vn/service/detail_company.php?id_com=" . $com_id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response4 = curl_exec($curl);
    curl_close($curl);
    $com0 = json_decode($response4, true);
    $com = $com0['data']['list_department'];
    $coun1 = count($com);

    $all_dep = [];
    for($a = 0; $a < $coun1; $a++){
        $item_dep = $com[$a];
        $all_dep[$item_dep['dep_id']] = $item_dep;
    }

    $stt = 1;
} else if ($id_dh == "") {
    header('Location: /quan-ly-don-hang.html');
}

?>
<!DOCTYPE html>
<html lang="vi">

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
    <div class="main-container ql_ct_dh_mua">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-don-hang.html">Quay
                            lại</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi
                            tiết đơn hàng mua vật tư</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tên nhà cung cấp</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['ten_nha_cc_kh'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Địa chỉ</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['dia_chi_lh'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người liên hệ</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['ten_nguoi_lh'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số điện thoại / Fax</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['so_dien_thoai'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $item['id_hop_dong'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số đơn hàng</p>
                                    <p class="cr_weight share_fsize_tow">ĐH - <?= $item['id'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày ký</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= date('d/m/Y', $item['ngay_ky']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Dự án / Công trình</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ten_ctrinh ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thời hạn đơn hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= date('d/m/Y', $item['thoi_han']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn vị nhận hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['don_vi_nhan_hang'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Người nhận hàng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $all_nv[$item['nguoi_nhan_hang']]['ep_name'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Phòng ban</p>
                                    <? if ($item['phong_ban'] == 0) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"></p>
                                    <? } else if ($item['phong_ban'] != 0) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"><?= $all_dep[$item['phong_ban']]['dep_name'] ?></p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số điện thoại người nhận</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['dien_thoai_nn'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giữ lại bảo hành</p>
                                    <? if ($item['giu_lai_bao_hanh']  != 0) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['giu_lai_bao_hanh'] ?>% tương đương <?= formatMoney($item['gia_tri_tuong_duong']) ?></p>
                                    <? } else { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"></p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ghi chú</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $item['ghi_chu'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giá trị trước VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($item['gia_tri_don_hang'] != 0) ? formatMoney($item['gia_tri_don_hang']) : "" ?>
                                    </p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Đơn giá đã bao gồm VAT</p>
                                    <p class="cr_weight share_fsize_tow cr_red"><?= ($item['bao_gom_vat'] != 0) ? "Có" : "Không" ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thuế suất VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($item['thue_vat']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Tiền chiết khấu</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($item['chiet_khau']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Giá trị sau VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($item['gia_tri_svat'] != 0) ? formatMoney($item['gia_tri_svat']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Chi phí vận chuyển</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= ($item['chi_phi_vchuyen'] != 0) ? formatMoney($item['chi_phi_vchuyen']) : "" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ghi chú vận chuyển</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= $item['ghi_chu_vchuyen'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">Mã vật tư</th>
                                            <th class="share_tb_two">Tên đầy đủ vật tư thiết bị</th>
                                            <th class="share_tb_one">Đơn vị tính</th>
                                            <th class="share_tb_two">Hãng sản xuất</th>
                                            <th class="share_tb_one">Số lượng</th>
                                            <th class="share_tb_two">Thời gian giao hàng</th>
                                            <th class="share_tb_two">Đơn giá (VNĐ)</th>
                                            <th class="share_tb_two">Tổng tiền trước VAT (VNĐ)</th>
                                            <th class="share_tb_one">Thuế VAT (%)</th>
                                            <th class="share_tb_two">Tổng tiền sau VAT (VNĐ)</th>
                                            <th class="share_tb_two">Địa điểm giao hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($row1 = mysql_fetch_assoc($list_vt_dhm->result)) { ?>
                                            <tr>
                                                <td class="share_tb_one"><?= $stt++ ?></td>
                                                <td class="share_tb_two">VT - <?= $row1['id_vat_tu'] ?></td>
                                                <td class="share_tb_two"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="share_tb_one"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="share_tb_two"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                                <td class="share_tb_one"><?= $row1['so_luong_ky_nay'] ?></td>
                                                <td class="share_tb_two"><?= date('d/m/Y', $row1['thoi_gian_giao_hang']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['don_gia']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['tong_tien_trvat']) ?></td>
                                                <td class="share_tb_one"><?= formatMoney($row1['thue_vat']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['tong_tien_svat']) ?></td>
                                                <td class="share_tb_two"><?= $row1['dia_diem_giao_hang'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc d_flex mb_10 right">
                                <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_dh">
                                        Xóa</p>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                        <a href="chinh-sua-don-hang-mua-<?= $id_dh ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                    </p>
                                    <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(4, $don_hang2)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_dh">
                                            Xóa</p>
                                    <? }
                                    if (in_array(3, $don_hang2)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-don-hang-mua-<?= $id_dh ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                        </p>
                                <? }
                                } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc d_flex left mb_10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data="<?= $id_dh ?>">Xuất Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20 gui_mail" data1="<?= $id_dh ?>" data2="<?= $com_id ?>" data3="<?= $com_name ?>">Gửi
                                    mail</p>
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
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">XÓA ĐƠN HÀNG</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa đơn hàng này?</p>
                                <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp" data="<?= $item['id'] ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>">Đồng
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
    var remove_dh = $(".remove_dh");

    remove_dh.click(function() {
        modal_share.show();
    });

    $(".save_new_dp").click(function() {
        var id_dh = $(this).attr("data");
        var com_id = $(this).attr("data1");
        var user_id = $(this).attr("data2");

        $.ajax({
            url: '../ajax/xoa_dh.php',
            type: 'POST',
            data: {
                id_dh: id_dh,
                com_id: com_id,
                user_id: user_id,
            },
            success: function(data) {
                if (data == "") {
                    window.location.href = '/quan-ly-don-hang.html';
                } else {
                    alert(data);
                }
            }
        });
    });

    $(".gui_mail").click(function() {
        var id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var com_name = $(this).attr("data3");
        var token = "<?= $_COOKIE['acc_token'] ?>";

        $.ajax({
            url: '../ajax/gui_mail_dhm.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                com_name: com_name,
                token: token,
            },
            success: function(data) {
                if (data == "") {
                    alert("Gửi email thành công.");
                    window.location.reload();
                } else {
                    alert(data);
                }
            }

        })
    });

    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/dh_mua_excel.php?id=' + id;
    });
</script>

</html>