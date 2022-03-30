<?php
include "../includes/icon.php";
include("config.php");
$date = date('m-d-Y', time());
$com_id = "";
$id_ct = "";
if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
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

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT * FROM `hop_dong` WHERE `id` = '$hd_id' ");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ngay_hop_dong = date('Y-m-d', $hd_detail['ngay_ky_hd']);
    $id_nha_cung_cap = $hd_detail['id_nha_cc_kh'];
    $du_an_ctr = $hd_detail['id_du_an_ctrinh'];
    $ngay_bat_dau = date('Y-m-d', $hd_detail['tg_bd_thuc_hien']);
    $ngay_ket_thuc = date('Y-m-d', $hd_detail['tg_kt_thuc_hien']);
    $hinh_thuc_hd = $hd_detail['hinh_thuc_hd'];
    $thoi_han_bl = date('Y-m-d', $hd_detail['thoi_han_blanh']);
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_ct = json_decode($response, true);
$cong_trinh_data = $list_ct['data']['items'];

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
$count_vt = count($vat_tu_data);

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_kho.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_kho = json_decode($response, true);
$kho_data = $list_kho['data']['items'];

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa hợp đồng thuê</title>
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
    <div class="main-container ql_them_hd_thue">
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
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">Sửa hợp đồng thuê</h4>
                        <div class="ctiet_dk_hp w_100 float_l">
                            <form action="" class="form_add_hp_mua share_distance w_100 float_l" method="">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Số hợp đồng</label>
                                        <input type="text" name="so_hd" value="HĐ - <?= $hd_id ?>" class="form-control" readonly>
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
                                            <option value="">--Chọn nhà cung cấp--</option>
                                            <?
                                            $get_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
                                            while ($ncc_fetch = mysql_fetch_assoc($get_ncc->result)) {
                                            ?>
                                                <option value="<?= $ncc_fetch['id'] ?>" <?= ($id_nha_cung_cap == $ncc_fetch['id']) ? "selected" : "" ?>><?= $ncc_fetch['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Dự án / Công trình </label>
                                        <select name="id_cong_trinh" class="form-control all_duan">
                                            <option value="">--Chọn Dự án / Công trình--</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $du_an_ctr) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group d_flex fl_agi form_lb">
                                        <label for="thue_noi_bo">Thuê nội bộ</label>
                                        <input type="checkbox" name="thue_noi_bo" id="thue_noi_bo" <?= ($hd_detail['thue_noi_bo'] == 1) ? "checked" : "" ?>>
                                    </div>
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
                                        <input type="text" name="so_taik" value="<?= $hd_detail['so_tk'] ?>" class="form-control" placeholder="Nhập số tài khoản">
                                        <input type="hidden" name="tong_tien" value="<?= $hd_detail['gia_tri_svat'] ?>" class="d-none tong_tien">
                                    </div>
                                </div>
                                <div class="them_moi_vt w_100 float_l">
                                    <p class="add_vat_tu cr_weight share_fsize_tow share_clr_four share_cursor">+ Thêm mới vật tư</p>
                                    <div class="table-wrapper mt-5">
                                        <div class="table-container table-3192">
                                            <div class="tbl-header">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="w-5"></th>
                                                            <th class="w-10">Kho</th>
                                                            <th class="w-20">Vật tư/thiết bị</th>
                                                            <th class="w-15">Thông số kỹ thuật</th>
                                                            <th class="w-10">Số lượng</th>
                                                            <th class="w-10">Hình thức thuê</th>
                                                            <th class="w-10">Đơn vị tính</th>
                                                            <th class="w-25">Thời gian thuê</th>
                                                            <th class="w-10">Khối lượng dự kiến</th>
                                                            <th class="w-10">Hạn mức ca máy</th>
                                                            <th class="w-10">Đơn giá thuê</th>
                                                            <th class="w-10">Đơn giá ca máy phụ trội</th>
                                                            <th class="w-10">Thành tiền dự kiến</th>
                                                            <th class="w-10">Thỏa thuận khác</th>
                                                            <th class="w-10">Lưu ý</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tbl-content table-2-row">
                                                <table>
                                                    <tbody id="vt-tb">
                                                        <?
                                                        $get_vt_thue = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $hd_id");
                                                        while ($vt_thue_fetch = mysql_fetch_assoc($get_vt_thue->result)) {
                                                            if ($vt_thue_fetch['hinh_thuc_thue'] == 1) {
                                                                $thue_tu_ngay = date('h:i', $vt_thue_fetch['thue_tu_ngay']);
                                                                $thue_den_ngay = date('h:i', $vt_thue_fetch['thue_den_ngay']);
                                                            } else if ($vt_thue_fetch['hinh_thuc_thue'] == 2) {
                                                                $thue_tu_ngay = date('Y-m-d', $vt_thue_fetch['thue_tu_ngay']);
                                                                $thue_den_ngay = date('Y-m-d', $vt_thue_fetch['thue_den_ngay']);
                                                            } else if ($vt_thue_fetch['hinh_thuc_thue'] == 3) {
                                                                $thue_tu_ngay = date('Y-m', $vt_thue_fetch['thue_tu_ngay']);
                                                                $thue_den_ngay = date('Y-m', $vt_thue_fetch['thue_den_ngay']);
                                                            } else if ($vt_thue_fetch['hinh_thuc_thue'] == 4 || $vt_thue_fetch['hinh_thuc_thue'] == 5) {
                                                                $thue_tu_ngay = "";
                                                                $thue_den_ngay = "";
                                                            }
                                                            $kho_id = $vt_thue_fetch['id_kho'];
                                                            $vt_id = $vt_thue_fetch['id_vat_tu_thiet_bi'];
                                                        ?>
                                                            <tr class="item">
                                                                <td class="w-5">
                                                                    <p class="xoa_thiet_bi" data1=<?= $vt_thue_fetch['id'] ?>><i class="ic-delete"></i></p>
                                                                    <input type="hidden" name="id_thiet_bi_old" value="<?= $vt_thue_fetch['id'] ?>" class="share_dnone id_thiet_bi">
                                                                </td>
                                                                <td class="w-10">
                                                                    <div class="v-select2">
                                                                        <select name="tb_kho_vt_old" class="form-control share_select tb_kho_vt" onchange="changeKho(this)">
                                                                            <option value="">-- Chọn kho vật tư --</option>
                                                                            <? foreach ($kho_data as $key => $items) { ?>
                                                                                <option value="<?= $items['kho_id'] ?>" <?= ($items['kho_id'] == $kho_id) ? "selected" : "" ?>><?= $items['kho_name'] ?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="w-20">
                                                                    <div class="v-select2">
                                                                        <select name="tb_vat_tu_thiet_bi_old" class="form-control share_select tb_vat_tu_thiet_bi">
                                                                            <option value="">-- Chọn vật tư/thiết bị --</option>
                                                                            <? foreach ($vat_tu_data as $key => $items) { ?>
                                                                                <option value="<?= $items['dsvt_id'] ?>" <?= ($items['dsvt_id'] == $vt_id) ? 'selected' : '' ?>><?= $items['dsvt_name'] ?></option>
                                                                            <? } ?>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="w-15">
                                                                    <input type="text" name="tb_thong_so_old" class="form-control tb_thong_so" value="<?= $vt_thue_fetch['thong_so_kthuat'] ?>">
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="number" name="tb_so_luong_old" class="form-control tb_so_luong" value="<?= $vt_thue_fetch['so_luong'] ?>" onkeyup="khoiLuong(this), thanhTien()">
                                                                </td>
                                                                <td class="w-10">
                                                                    <div class="v-select2">
                                                                        <select name="tb_hinh_thuc_thue_old" class="form-control tb_hinh_thuc_thue" onchange="hinhThucChange(this), thanhTien()">
                                                                            <option value="">-- Chọn hình thức --</option>
                                                                            <? if ($vt_thue_fetch['hinh_thuc_thue'] == 1) { ?>
                                                                                <option value="1" selected>Theo giờ</option>
                                                                                <option value="2">Theo ngày</option>
                                                                                <option value="3">Theo tháng</option>
                                                                                <option value="4">Theo ca máy</option>
                                                                                <option value="5">Theo công việc</option>
                                                                            <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 2) { ?>
                                                                                <option value="1">Theo giờ</option>
                                                                                <option value="2" selected>Theo ngày</option>
                                                                                <option value="3">Theo tháng</option>
                                                                                <option value="4">Theo ca máy</option>
                                                                                <option value="5">Theo công việc</option>
                                                                            <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 3) { ?>
                                                                                <option value="1">Theo giờ</option>
                                                                                <option value="2">Theo ngày</option>
                                                                                <option value="3" selected>Theo tháng</option>
                                                                                <option value="4">Theo ca máy</option>
                                                                                <option value="5">Theo công việc</option>
                                                                            <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 4) { ?>
                                                                                <option value="1">Theo giờ</option>
                                                                                <option value="2">Theo ngày</option>
                                                                                <option value="3">Theo tháng</option>
                                                                                <option value="4" selected>Theo ca máy</option>
                                                                                <option value="5">Theo công việc</option>
                                                                            <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 5) { ?>
                                                                                <option value="1">Theo giờ</option>
                                                                                <option value="2">Theo ngày</option>
                                                                                <option value="3">Theo tháng</option>
                                                                                <option value="4">Theo ca máy</option>
                                                                                <option value="5" selected>Theo công việc</option>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="text" name="tb_don_vi_tinh_old" class="tb_don_vi_tinh" <? if ($vt_thue_fetch['hinh_thuc_thue'] == 1) { ?> value="Giờ" <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 2) { ?> value="Ngày" <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 3) { ?> value="Tháng" <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 4) { ?> value="Ca" <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 5) { ?> value="Công việc" <? } ?> readonly>
                                                                </td>
                                                                <td class="w-25">
                                                                    <div class="tb-date-range">
                                                                        <? if ($vt_thue_fetch['hinh_thuc_thue'] == 1) { ?>
                                                                            <input type="time" name="tb_ngay_bat_dau_old" value="<?= $thue_tu_ngay ?>" class="form-control range date1" onchange="khoiLuong(this), thanhTien()">
                                                                            <span> - </span>
                                                                            <input type="time" name="tb_ngay_ket_thuc_old" value="<?= $thue_den_ngay ?>" class="form-control range date2" onchange="khoiLuong(this), thanhTien()">
                                                                        <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 2) { ?>
                                                                            <input type="date" name="tb_ngay_bat_dau_old" value="<?= $thue_tu_ngay ?>" class="form-control range date1" onchange="khoiLuong(this), thanhTien()">
                                                                            <span> - </span>
                                                                            <input type="date" name="tb_ngay_ket_thuc_old" value="<?= $thue_den_ngay ?>" class="form-control range date2" onchange="khoiLuong(this), thanhTien()">
                                                                        <? } else if ($vt_thue_fetch['hinh_thuc_thue'] == 3) { ?>
                                                                            <input type="month" name="tb_ngay_bat_dau_old" value="<?= $thue_tu_ngay ?>" class="form-control range date1" onchange="khoiLuong(this), thanhTien()">
                                                                            <span> - </span>
                                                                            <input type="month" name="tb_ngay_ket_thuc_old" value="<?= $thue_den_ngay ?>" class="form-control range date2" onchange="khoiLuong(this), thanhTien()">
                                                                        <? } else if($vt_thue_fetch['hinh_thuc_thue'] == 4 || $vt_thue_fetch['hinh_thuc_thue'] == 5) { ?>
                                                                            <input type="month" name="tb_ngay_bat_dau_old" value="<?= $thue_tu_ngay ?>" class="form-control range date1" onchange="khoiLuong(this), thanhTien()" readonly>
                                                                            <span> - </span>
                                                                            <input type="month" name="tb_ngay_ket_thuc_old" value="<?= $thue_den_ngay ?>" class="form-control range date2" onchange="khoiLuong(this), thanhTien()" readonly>
                                                                        <? } ?>
                                                                    </div>
                                                                </td>
                                                                <td class="w-10">
                                                                    <? if ($vt_thue_fetch['hinh_thuc_thue'] == 1 || $vt_thue_fetch['hinh_thuc_thue'] == 2 || $vt_thue_fetch['hinh_thuc_thue'] == 3) { ?>
                                                                        <input type="number" name="tb_khoi_luong_old" class="tb_khoi_luong" value="<?= $vt_thue_fetch['khoi_luong_du_kien'] ?>" class="form-control tb_khoi_luong" onkeyup="khoiLuong(this), thanhTien()" readonly>
                                                                    <? } else { ?>
                                                                        <input type="number" name="tb_khoi_luong_old" class="tb_khoi_luong" value="<?= $vt_thue_fetch['khoi_luong_du_kien'] ?>" class="form-control tb_khoi_luong" onkeyup="khoiLuong(this), thanhTien()">
                                                                    <? } ?>
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="number" name="tb_han_muc_old" class="form-control tb_han_muc" value="<?= $vt_thue_fetch['han_muc_ca_may'] ?>" onkeyup="khoiLuong(this), thanhTien()">
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="number" name="tb_don_gia_old" class="form-control tb_don_gia" value="<?= $vt_thue_fetch['don_gia_thue'] ?>" onkeyup="khoiLuong(this), thanhTien()">
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="number" name="tb_don_gia_ca_may_old" class="form-control tb_don_gia_ca_may" value="<?= $vt_thue_fetch['dg_ca_may_phu_troi'] ?>" onkeyup="khoiLuong(this), thanhTien()">
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="number" name="tb_thanh_tien_old" class="form-control tb_thanh_tien" value="<?= $vt_thue_fetch['thanh_tien_du_kien'] ?>" readonly>
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="text" name="tb_thoa_thuan_khac_old" class="form-control tb_thoa_thuan_khac" value="<?= $vt_thue_fetch['thoa_thuan_khac'] ?>">
                                                                </td>
                                                                <td class="w-10">
                                                                    <input type="text" name="tb_luu_y_old" class="form-control tb_luu_y" value="<?= $vt_thue_fetch['luu_y'] ?>">
                                                                </td>
                                                            </tr>
                                                        <? } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
                                <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn hủy việc sửa hợp đồng thuê thiết bị?</p>
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
    <? include("../modals/xoa_thietbi.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/bank-name.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".all_nhacc, .all_da_ct, .ten_nganhang, .bao_gia, .ma_vatt").select2({
        width: '100%',
    });
    autocomplete(document.getElementById("ten_nh"), bank);

    $(".add_vat_tu").click(function() {
        var html = `<tr class="item">
                        <td class="w-5">
                            <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                        </td>
                        <td class="w-10">
                            <div class="v-select2">
                                <select name="tb_kho_vt" class="form-control share_select tb_kho_vt" onchange="changeKho(this)">
                                    <option value="">-- Chọn kho vật tư --</option>
                                    <? foreach ($kho_data as $key => $items) { ?>
                                        <option value="<?= $items['kho_id'] ?>"><?= $items['kho_name'] ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </td>
                        <td class="w-20">
                            <div class="v-select2">
                                <select name="tb_vat_tu_thiet_bi" class="form-control share_select tb_vat_tu_thiet_bi">
                                    <option value="">-- Chọn vật tư/thiết bị --</option>
                                </select>
                            </div>
                        </td>
                        <td class="w-15">
                            <input type="text" name="tb_thong_so" class="form-control tb_thong_so">
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_so_luong" class="form-control tb_so_luong" onkeyup="khoiLuong(this), thanhTien()">
                        </td>
                        <td class="w-10">
                            <div class="v-select2">
                                <select name="tb_hinh_thuc_thue" class="form-control tb_hinh_thuc_thue" onchange="hinhThucChange(this), thanhTien()">
                                    <option value="">-- Chọn hình thức --</option>
                                    <option value="1">Theo giờ</option>
                                    <option value="2">Theo ngày</option>
                                    <option value="3">Theo tháng</option>
                                    <option value="4">Theo ca máy</option>
                                    <option value="5">Theo công việc</option>
                                </select>
                            </div>
                        </td>
                        <td class="w-10">
                            <input type="text" name="tb_don_vi_tinh" class="tb_don_vi_tinh" readonly>
                        </td>
                        <td class="w-25">
                            <div class="tb-date-range">
                                <input type="date" name="tb_ngay_bat_dau" class="form-control range date1" onchange="khoiLuong(this), thanhTien()">
                                <span> - </span>
                                <input type="date" name="tb_ngay_ket_thuc" class="form-control range date2" onchange="khoiLuong(this), thanhTien()">
                            </div>
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_khoi_luong" class="form-control tb_khoi_luong" onkeyup="khoiLuong(this), thanhTien()" readonly>
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_han_muc" class="form-control tb_han_muc" onkeyup="khoiLuong(this), thanhTien()">
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_don_gia" class="form-control tb_don_gia" onkeyup="khoiLuong(this), thanhTien()">
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_don_gia_ca_may" class="form-control tb_don_gia_ca_may" onkeyup="khoiLuong(this), thanhTien()">
                        </td>
                        <td class="w-10">
                            <input type="number" name="tb_thanh_tien" class="form-control tb_thanh_tien" readonly>
                        </td>
                        <td class="w-10">
                            <input type="text" name="tb_thoa_thuan_khac" class="form-control tb_thoa_thuan_khac">
                        </td>
                        <td class="w-10">
                            <input type="text" name="tb_luu_y" class="form-control tb_luu_y">
                        </td>
                    </tr>`;
        $("#vt-tb").append(html);
        RefSelect2();
    });
    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.fadeIn();
    });

    function changeKho(id) {
        var com_id = <?= $com_id ?>;
        var id_kho = $(id).val();
        $.ajax({
            url: '../render/hd_thue_ds_vt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_kho: id_kho,
            },
            success: function(data) {
                $(id).parents('.item').find(".tb_vat_tu_thiet_bi").html(data);
            }
        });
    };

    $(".save_add").click(function() {
        var form_add_thue = $(".form_add_hp_mua");
        form_add_thue.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.wrap("<span class='error'>");
            },
            rules: {
                ngay_ky: {
                    required: true,
                },
                ten_nhacc: {
                    required: true,
                },
            },
            messages: {
                ngay_ky: {
                    required: "Không được để trống",
                },
                ten_nhacc: {
                    required: "Không được để trống",
                },
            },
        });

        if (form_add_thue.valid() === true) {
            var ep_id = '<?= $user_id ?>';
            var com_id = '<?= $com_id ?>';

            var hd_id = <?= $hd_id ?>;
            var ngay_ky_hd = $("input[name='ngay_ky_hd'").val();
            var id_nha_cung_cap = $("select[name='id_nha_cung_cap']").val();
            var id_cong_trinh = $("select[name='id_cong_trinh']").val();
            var thue_noi_bo = 0;
            if ($("input[name='thue_noi_bo']").is(":checked")) {
                thue_noi_bo = 1;
            }
            var noi_dung_hd = $("textarea[name='noi_dung_hd']").val();
            var noi_dung_luu_y = $("textarea[name='noi_dung_luu_y']").val();
            var dieu_khoan_tt = $("textarea[name='dieu_khoan_tt']").val();
            var ten_nh = $("input[name='ten_nh']").val();
            var so_taik = $("input[name='so_taik']").val();
            var tong_tien = $("input[name='tong_tien']").val();

            //old
            var tb_id_thiet_bi_old = new Array();
            $("input[name='id_thiet_bi_old']").each(function() {
                var id_tb_old = $(this).val();
                if (id_tb_old != "") {
                    tb_id_thiet_bi_old.push(id_tb_old);
                }
            });
            var tb_id_kho_old = new Array();
            $("select[name='tb_kho_vt_old']").each(function() {
                var idk_o = $(this).val();
                if (idk_o != "") {
                    tb_id_kho_old.push(idk_o);
                }
            });
            var tb_vat_tu_thiet_bi_old = new Array();
            $("select[name='tb_vat_tu_thiet_bi_old']").each(function() {
                var vt_tb_o = $(this).val();
                if (vt_tb_o != "") {
                    tb_vat_tu_thiet_bi_old.push(vt_tb_o);
                }
            });
            var tb_thong_so_old = new Array();
            $("input[name='tb_thong_so_old']").each(function() {
                var ts_old = $(this).val();
                if (ts_old != "") {
                    tb_thong_so_old.push(ts_old);
                }
            });
            var tb_so_luong_old = new Array();
            $("input[name='tb_so_luong_old']").each(function() {
                var sl_old = $(this).val();
                if (sl_old != "") {
                    tb_so_luong_old.push(sl_old);
                }
            });
            var tb_hinh_thuc_thue_old = new Array();
            $("select[name='tb_hinh_thuc_thue_old']").each(function() {
                var htt_o = $(this).val();
                if (htt_o != "") {
                    tb_hinh_thuc_thue_old.push(htt_o);
                }
            });
            var tb_ngay_bat_dau_old = new Array();
            $("input[name='tb_ngay_bat_dau_old']").each(function() {
                var bd_thue = $(this).val();
                if (bd_thue != "") {
                    tb_ngay_bat_dau_old.push(bd_thue);
                }
            });
            var tb_ngay_ket_thuc_old = new Array();
            $("input[name='tb_ngay_ket_thuc_old']").each(function() {
                var kt_thue = $(this).val();
                var bd_thue = $(this).parents('.item').find("input[name='tb_ngay_bat_dau_old']").val();
                if (kt_thue != "") {
                    if (kt_thue < bd_thue) {
                        alert("Ngày kết thúc thuê không được nhỏ hơn ngày bắt đầu.")
                    } else {
                        tb_ngay_ket_thuc_old.push(kt_thue);
                    }
                }
            });
            var tb_khoi_luong_old = new Array();
            $("input[name='tb_khoi_luong_old']").each(function() {
                var kl_old = $(this).val();
                if (kl_old != "") {
                    tb_khoi_luong_old.push(kl_old);
                }
            });
            var tb_han_muc_old = new Array();
            $("input[name='tb_han_muc_old']").each(function() {
                var hm_old = $(this).val();
                if (hm_old != "") {
                    tb_han_muc_old.push(hm_old);
                }
            });
            var tb_don_gia_old = new Array();
            $("input[name='tb_don_gia_old']").each(function() {
                var dg_old = $(this).val();
                if (dg_old != "") {
                    tb_don_gia_old.push(dg_old);
                }
            });
            var tb_don_gia_ca_may_old = new Array();
            $("input[name='tb_don_gia_ca_may_old']").each(function() {
                var dg_cm_old = $(this).val();
                if (dg_cm_old != "") {
                    tb_don_gia_ca_may_old.push(dg_cm_old);
                }
            });
            var tb_thanh_tien_old = new Array();
            $("input[name='tb_thanh_tien_old']").each(function() {
                var tt_old = $(this).val();
                if (tt_old != "") {
                    tb_thanh_tien_old.push(tt_old);
                }
            });
            var tb_thoa_thuan_khac_old = new Array();
            $("input[name='tb_thoa_thuan_khac_old']").each(function() {
                var ttk_old = $(this).val();
                if (ttk_old != "") {
                    tb_thoa_thuan_khac_old.push(ttk_old);
                }
            });
            var tb_luu_y_old = new Array();
            $("input[name='tb_luu_y_old']").each(function() {
                var ly = $(this).val();
                if (ly != "") {
                    tb_luu_y_old.push(ly);
                }
            });

            //new
            var tb_kho = new Array();
            $("select[name='tb_kho_vt']").each(function() {
                var id_kho = $(this).val();
                if (id_kho != "") {
                    tb_kho.push(id_kho);
                }
            });

            var tb_thiet_bi = new Array();
            $("select[name='tb_vat_tu_thiet_bi']").each(function() {
                var id_vt_tb = $(this).val();
                if (id_vt_tb != "") {
                    tb_thiet_bi.push(id_vt_tb);
                }
            });
            var tb_thong_so = new Array();
            $("input[name='tb_thong_so']").each(function() {
                var ts_tb = $(this).val();
                if (ts_tb != "") {
                    tb_thong_so.push(ts_tb);
                }
            });
            var tb_so_luong = new Array();
            $("input[name='tb_so_luong']").each(function() {
                var sl_tb = $(this).val();
                if (sl_tb != "") {
                    tb_so_luong.push(sl_tb);
                }
            });
            var tb_hinh_thuc = new Array();
            $("select[name='tb_hinh_thuc_thue']").each(function() {
                var tb_ht = $(this).val();
                if (tb_ht != "") {
                    tb_hinh_thuc.push(tb_ht);
                }
            });
            var tb_ngay_bat_dau = new Array();
            $("input[name='tb_ngay_bat_dau']").each(function() {
                var tgbd_tb = $(this).val();
                if (tgbd_tb != "") {
                    tb_ngay_bat_dau.push(tgbd_tb);
                }
            });
            var tb_ngay_ket_thuc = new Array();
            $("input[name='tb_ngay_ket_thuc']").each(function() {
                var tgkt_tb = $(this).val();
                var tgbd_tb = $(this).parents().find("input[name='ngay_bat_dau']").val();
                if (tgkt_tb != "") {
                    if (tgkt_tb < tgbd_tb) {
                        alert("Ngày kết thúc thuê không được nhỏ hơn ngày bắt đầu.")
                    } else {
                        tb_ngay_ket_thuc.push(tgkt_tb);
                    }
                }
            });
            var tb_khoi_luong = new Array();
            $("input[name='tb_khoi_luong']").each(function() {
                var kl_tb = $(this).val();
                if (kl_tb != "") {
                    tb_khoi_luong.push(kl_tb);
                }
            });
            var tb_han_muc = new Array();
            $("input[name='tb_han_muc']").each(function() {
                var hm_tb = $(this).val();
                if (hm_tb != "") {
                    tb_han_muc.push(hm_tb);
                }
            });
            var tb_don_gia = new Array();
            $("input[name='tb_don_gia']").each(function() {
                var dg_tb = $(this).val();
                if (dg_tb != "") {
                    tb_don_gia.push(dg_tb);
                }
            });
            var tb_don_gia_ca_may = new Array();
            $("input[name='tb_don_gia_ca_may']").each(function() {
                var dgcm_tb = $(this).val();
                if (dgcm_tb != "") {
                    tb_don_gia_ca_may.push(dgcm_tb);
                }
            });
            var tb_thanh_tien = new Array();
            $("input[name='tb_thanh_tien']").each(function() {
                var total_tb = $(this).val();
                if (total_tb != "") {
                    tb_thanh_tien.push(total_tb);
                }
            });
            var tb_thoa_thuan_khac = new Array();
            $("input[name='tb_thoa_thuan_khac']").each(function() {
                var ttk_tb = $(this).val();
                if (ttk_tb != "") {
                    tb_thoa_thuan_khac.push(ttk_tb);
                }
            });
            var tb_luu_y = new Array();
            $("input[name='tb_luu_y']").each(function() {
                var ly_tb = $(this).val();
                if (ly_tb != "") {
                    tb_luu_y.push(ly_tb);
                }
            });

            $.ajax({
                url: '../ajax/hd_thue_sua.php',
                type: 'POST',
                data: {
                    ep_id: ep_id,
                    com_id: com_id,

                    hd_id: hd_id,
                    ngay_ky_hd: ngay_ky_hd,
                    id_nha_cung_cap: id_nha_cung_cap,
                    id_cong_trinh: id_cong_trinh,
                    thue_noi_bo: thue_noi_bo,
                    noi_dung_hd: noi_dung_hd,
                    noi_dung_luu_y: noi_dung_luu_y,
                    dieu_khoan_tt: dieu_khoan_tt,
                    ten_nh: ten_nh,
                    so_taik: so_taik,
                    tong_tien: tong_tien,

                    tb_id_thiet_bi_old: tb_id_thiet_bi_old,
                    tb_id_kho_old: tb_id_kho_old,
                    tb_vat_tu_thiet_bi_old: tb_vat_tu_thiet_bi_old,
                    tb_thong_so_old: tb_thong_so_old,
                    tb_so_luong_old: tb_so_luong_old,
                    tb_hinh_thuc_thue_old: tb_hinh_thuc_thue_old,
                    tb_ngay_bat_dau_old: tb_ngay_bat_dau_old,
                    tb_ngay_ket_thuc_old: tb_ngay_ket_thuc_old,
                    tb_khoi_luong_old: tb_khoi_luong_old,
                    tb_han_muc_old: tb_han_muc_old,
                    tb_don_gia_old: tb_don_gia_old,
                    tb_don_gia_ca_may_old: tb_don_gia_ca_may_old,
                    tb_thanh_tien_old: tb_thanh_tien_old,
                    tb_thoa_thuan_khac_old: tb_thoa_thuan_khac_old,
                    tb_luu_y_old: tb_luu_y_old,


                    tb_kho: tb_kho,
                    tb_thiet_bi: tb_thiet_bi,
                    tb_thong_so: tb_thong_so,
                    tb_so_luong: tb_so_luong,
                    tb_hinh_thuc: tb_hinh_thuc,
                    tb_ngay_bat_dau: tb_ngay_bat_dau,
                    tb_ngay_ket_thuc: tb_ngay_ket_thuc,
                    tb_khoi_luong: tb_khoi_luong,
                    tb_han_muc: tb_han_muc,
                    tb_don_gia: tb_don_gia,
                    tb_don_gia_ca_may: tb_don_gia_ca_may,
                    tb_thanh_tien: tb_thanh_tien,
                    tb_thoa_thuan_khac: tb_thoa_thuan_khac,
                    tb_luu_y: tb_luu_y,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Chỉnh sửa hợp đồng thuê thiết bị thành công!");
                        window.location.href = 'quan-ly-chi-tiet-hop-dong-thue-thiet-bi-<?= $hd_id ?>.html';
                    } else {
                        console.log(data);
                    }
                }
            })
        }
    });

    $('.xoa_thiet_bi').click(function() {
        var id = $(this).attr('data1');
        $('#xoa_thietbi .confirm-delete').attr('data-id', id);
        $('#xoa_thietbi').fadeIn();
    });

    $('#xoa_thietbi .confirm-delete').click(function() {
        var id_v = $(this).attr('data-id');
        $.ajax({
            url: '../ajax/hd_thue_sua_xoa_vt.php',
            type: 'POST',
            data: {
                id: id_v,
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
</script>

</html>