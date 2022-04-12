<?php
include "../includes/icon.php";
include("config.php");

if (isset($_GET['id']) && $_GET['id'] != "") {
    $hd_id = $_GET['id'];
    $hd_get = new db_query("SELECT `ngay_ky_hd`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `thue_noi_bo`, `hinh_thuc_hd`, `ten_ngan_hang`, `so_tk`, `noi_dung_hd`, `noi_dung_luu_y`, `dieu_khoan_tt` FROM `hop_dong` WHERE `id` = $hd_id");
    $hd_detail = mysql_fetch_assoc($hd_get->result);

    $ncc_id = $hd_detail['id_nha_cc_kh'];
    $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);
}
if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 2;

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


$vat_tu = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu[$items_vt['dsvt_id']] = $items_vt;
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


$kho = [];
for ($i = 0; $i < count($kho_data); $i++) {
    $items_kho = $kho_data[$i];
    $kho[$items_kho['kho_id']] = $items_kho;
}

?>
<!DOCTYPE html>
<html lang="vi">

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
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $user_id ?>" data1="<?= $phan_quyen_nk ?>" data2="<?= $com_id ?>">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Số hợp đồng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">HĐ - <?= $hd_id ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ngày ký hợp đồng</p>
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
                                            $stt = 1;
                                            $get_tb_detail = new db_query("SELECT * FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $hd_id");
                                            while ($thiet_bi = mysql_fetch_assoc($get_tb_detail->result)) {
                                            ?>
                                                <tr>
                                                    <td class="w-5"><?= $stt++ ?></td>
                                                    <td class="w-10"><?= $kho[$thiet_bi['id_kho']]['kho_name'] ?></td>
                                                    <td class="w-20"><?= $vat_tu[$thiet_bi['id_vat_tu_thiet_bi']]['dsvt_name'] ?></td>
                                                    <td class="w-15"><?= $thiet_bi['thong_so_kthuat'] ?></td>
                                                    <td class="w-10"><?= $thiet_bi['so_luong'] ?></td>
                                                    <td class="w-10">
                                                        <? if ($thiet_bi['hinh_thuc_thue'] == 1) { ?>
                                                            Theo giờ
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 2) { ?>
                                                            Theo ngày
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 3) { ?>
                                                            Theo tháng
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 4) { ?>
                                                            Theo ca máy
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 5) { ?>
                                                            Theo công việc
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-10">
                                                        <? if ($thiet_bi['hinh_thuc_thue'] == 1) { ?>
                                                            Giờ
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 2) { ?>
                                                            Ngày
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 3) { ?>
                                                            Tháng
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 4) { ?>
                                                            Ca máy
                                                        <? } else if ($thiet_bi['hinh_thuc_thue'] == 5) { ?>
                                                            Công việc
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-25">
                                                        <? if ($thiet_bi['thue_tu_ngay'] == 0 && $thiet_bi['thue_den_ngay'] == 0) { ?>
                                                            Không có dữ liệu.
                                                            <? } else {
                                                            if ($thiet_bi['hinh_thuc_thue'] == 1) { ?>
                                                                <?= date('h:i', $thiet_bi['thue_tu_ngay']) ?> - <?= date('h:i', $thiet_bi['thue_den_ngay']) ?>
                                                            <? } else if ($thiet_bi['hinh_thuc_thue'] == 2) { ?>
                                                                <?= date('d/m/Y', $thiet_bi['thue_tu_ngay']) ?> - <?= date('d/m/Y', $thiet_bi['thue_den_ngay']) ?>
                                                            <? } else if ($thiet_bi['hinh_thuc_thue'] == 3) { ?>
                                                                <?= date('m/Y', $thiet_bi['thue_tu_ngay']) ?> - <?= date('m/Y', $thiet_bi['thue_den_ngay']) ?>
                                                            <? } else if ($thiet_bi['hinh_thuc_thue'] == 4) { ?>
                                                                Không có dữ liệu.
                                                            <? } else if ($thiet_bi['hinh_thuc_thue'] == 5) { ?>
                                                                Không có dữ liệu.
                                                            <? } ?>
                                                        <? } ?>
                                                    </td>
                                                    <td class="w-10"><?= $thiet_bi['khoi_luong_du_kien'] ?></td>
                                                    <td class="w-10"><?= $thiet_bi['han_muc_ca_may'] ?></td>
                                                    <td class="w-10"><?= formatMoney($thiet_bi['don_gia_thue']) ?></td>
                                                    <td class="w-10"><?= formatMoney($thiet_bi['dg_ca_may_phu_troi']) ?></td>
                                                    <td class="w-10"><?= formatMoney($thiet_bi['thanh_tien_du_kien']) ?></td>
                                                    <td class="w-10"><?= $thiet_bi['thoa_thuan_khac'] ?></td>
                                                    <td class="w-10"><?= $thiet_bi['luu_y'] ?></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc mb_10 d_flex right">
                                <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">Xóa</p>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                        <a href="chinh-sua-hop-dong-thue-thiet-bi-<?= $hd_id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                    </p>
                                    <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(4, $hop_dong2)) {
                                    ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_hd">Xóa</p>
                                    <? }
                                    if (in_array(3, $hop_dong2)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_one ml_20">
                                            <a href="chinh-sua-hop-dong-thue-thiet-bi-<?= $hd_id ?>.html" class="share_clr_tow">Chỉnh sửa</a>
                                        </p>
                                <? }
                                } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc mb_10 d_flex left mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data=<?= $hd_id ?>>Xuất Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20 gui_mail" data1="<?= $hd_id ?>" data2="<?= $com_id ?>" data3="<?= $com_name ?>">Gửi mail</p>
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
        var com_id = $(".ctiet_dk_hp").attr("data2");
        var user_id = $(".ctiet_dk_hp").attr("data");
        var phan_quyen_nk = $(".ctiet_dk_hp").attr("data1");
        var loai = "thuê thiết bị";
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
                    alert("Bị lỗi");
                }
            }
        });
    });
    $(".gui_mail").click(function() {
        var id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var com_name = $(this).attr("data3");

        $.ajax({
            url: '../ajax/gui_mail_hdt.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                com_name: com_name,
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
        window.location.href = '../excel/hd_thue_excel.php?id=' + id;
    });
</script>

</html>