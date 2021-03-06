<?php
include("config.php");
include "../includes/icon.php";

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $user_name = $_SESSION['com_name'];
    $com_id = $_SESSION['com_id'];
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $user_name = $_SESSION['ep_name'];
    $com_id = $_SESSION['user_com_id'];
}

$month_start = strtotime(date('Y-m-01'));
$month_end = strtotime(date("Y-m-t"));

$year_start = strtotime('first day of January', time());
$year_end = strtotime('last day of December', time());

$date = strtotime(date('Y-m-d', time()));
$date_f = date('d/m/Y', $date);
$date = getdate($date);
$weekday = $date['weekday'];

$array_t = array(
    'Monday' => 'Thứ 2',
    'Tuesday' => 'Thứ 3',
    'Wednesday' => 'Thứ 4',
    'Thursday' => 'Thứ 5',
    'Friday' => 'Thứ 6',
    'Saturday' => 'Thứ 7',
    'Sunday' => 'Chủ nhật',
);

$ngay_hom_nay = strtotime(date('Y-m-d', time()));
// trả theo ngày
$da_tra = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                            AND (`phan_loai` = 1 OR `phan_loai` = 3 OR `phan_loai` = 4 OR `phan_loai` = 5) AND `ngay_tao` = $ngay_hom_nay "))->result)['sotien'];

if ($da_tra == "") {
    $da_tra = 0;
}

$tong_tra = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS giatri_svat FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                            AND (`phan_loai` = 1 OR `phan_loai` = 3 OR `phan_loai` = 4 )
                                            AND `tg_bd_thuc_hien` >= $ngay_hom_nay"))->result)['giatri_svat'];

$con_lai_tra = $tong_tra - $da_tra;
// trả theo tháng

$da_tra_m = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien_m FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                                            AND (`phan_loai` = 1 OR `phan_loai` = 3 OR `phan_loai` = 4 OR `phan_loai` = 5) AND `ngay_tao` >= $month_start
                                            AND `ngay_tao` <= $month_end "))->result)['sotien_m'];
if ($da_tra_m == "") {
    $da_tra_m = 0;
}

$tong_tra_m = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gtri_s  FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                            AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                            AND `tg_bd_thuc_hien` >= $month_start AND `tg_kt_thuc_hien` <= $month_end "))->result)['gtri_s'];
if ($tong_tra_m == "") {
    $tong_tra_m = 0;
}
$con_lai_tra_m = $tong_tra_m - $da_tra_m;
// echo $con_lai_tra_m;
// trả theo năm

$da_tra_y = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien_y FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                        AND (`phan_loai` = 1 OR `phan_loai` = 3 OR `phan_loai` = 4 OR `phan_loai` = 5)
                        AND `ngay_tao` >= $year_start AND `ngay_tao` <= $year_end "))->result)['sotien_y'];

if ($da_tra_y == "") {
    $da_tra_y = 0;
}

$tong_tra_y = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gtri_y  FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                            AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                            AND `tg_bd_thuc_hien` >= $year_start AND `tg_kt_thuc_hien` <= $year_end "))->result)['gtri_y'];

$con_lai_tra_y = $tong_tra_y - $da_tra_y;

// thu theo ngày
$da_thu = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                            AND (`phan_loai` = 2 OR `phan_loai` = 6 ) AND `ngay_tao` = $ngay_hom_nay "))->result)['sotien'];

if ($da_thu == "") {
    $da_thu = 0;
}

$tong_thu = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS giatri_svat FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                            AND `phan_loai` = 2 AND `tg_bd_thuc_hien` >= $ngay_hom_nay"))->result)['giatri_svat'];

$con_lai_thu = $tong_thu - $da_thu;
// thu theo thang
$da_thu_m = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien_m FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                                            AND (`phan_loai` = 2 OR `phan_loai` = 6) AND `ngay_tao` >= $month_start
                                            AND `ngay_tao` <= $month_end "))->result)['sotien_m'];
if ($da_thu_m == "") {
    $da_thu_m = 0;
}

$tong_thu_m = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gtri_s  FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                            AND `phan_loai` = 2 AND `tg_bd_thuc_hien` >= $month_start AND `tg_kt_thuc_hien` <= $month_end "))->result)['gtri_s'];
if ($tong_thu_m == "") {
    $tong_thu_m = 0;
}
$con_lai_thu_m = $tong_thu_m - $da_thu_m;
// thu theo nam

$da_thu_y = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien_y FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `loai_thanh_toan` = 2
                        AND (`phan_loai` = 2 OR `phan_loai` = 6) AND `ngay_tao` >= $year_start AND `ngay_tao` <= $year_end "))->result)['sotien_y'];

if ($da_thu_y == "") {
    $da_thu_y = 0;
}

$tong_thu_y = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gtri_y  FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                            AND `phan_loai` = 2 AND `tg_bd_thuc_hien` >= $year_start AND `tg_kt_thuc_hien` <= $year_end "))->result)['gtri_y'];

$con_lai_thu_y = $tong_thu_y - $da_thu_y;

// gia tri hop dong mua, ban trong nam
$day_start_t1 = strtotime('first day of January', time());
$day_end_t1 = strtotime('last day of January', time());

$tong_tra_m1 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t1
                                                AND `ngay_ky_hd` <= $day_end_t1 "))->result)['gia_tri_s'];
if ($tong_tra_m1 == "") {
    $tong_tra_m1 = 0;
}
$tong_thu_m1 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t1 AND `ngay_ky_hd` <= $day_end_t1 "))->result)['gia_tri_s'];
if ($tong_thu_m1 == "") {
    $tong_thu_m1 = 0;
}
$day_start_t2 = strtotime('first day of February', time());
$day_end_t2 = strtotime('last day of February', time());

$tong_tra_m2 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t2
                                                AND `ngay_ky_hd` <= $day_end_t2 "))->result)['gia_tri_s'];
if ($tong_tra_m2 == "") {
    $tong_tra_m2 = 0;
}
$tong_thu_m2 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t2 AND `ngay_ky_hd` <= $day_end_t2 "))->result)['gia_tri_s'];
if ($tong_thu_m2 == "") {
    $tong_thu_m2 = 0;
}

$day_start_t3 = strtotime('first day of March', time());
$day_end_t3 = strtotime('last day of March', time());

$tong_tra_m3 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t3
                                                AND `ngay_ky_hd` <= $day_end_t3 "))->result)['gia_tri_s'];
if ($tong_tra_m3 == "") {
    $tong_tra_m3 = 0;
}
$tong_thu_m3 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t3 AND `ngay_ky_hd` <= $day_end_t3 "))->result)['gia_tri_s'];
if ($tong_thu_m3 == "") {
    $tong_thu_m3 = 0;
}

$day_start_t4 = strtotime('first day of April', time());
$day_end_t4 = strtotime('last day of April', time());

$tong_tra_m4 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t4 AND `ngay_ky_hd` <= $day_end_t4 "))->result)['gia_tri_s'];
if ($tong_tra_m4 == "") {
    $tong_tra_m4 = 0;
}
$tong_thu_m4 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t4 AND `ngay_ky_hd` <= $day_end_t4 "))->result)['gia_tri_s'];
if ($tong_thu_m4 == "") {
    $tong_thu_m4 = 0;
}

$day_start_t5 = strtotime('first day of May', time());
$day_end_t5 = strtotime('last day of May', time());

$tong_tra_m5 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t5
                                                AND `ngay_ky_hd` <= $day_end_t5 "))->result)['gia_tri_s'];
if ($tong_tra_m5 == "") {
    $tong_tra_m5 = 0;
}
$tong_thu_m5 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t5 AND `ngay_ky_hd` <= $day_end_t5 "))->result)['gia_tri_s'];
if ($tong_thu_m5 == "") {
    $tong_thu_m5 = 0;
}

$day_start_t6 = strtotime('first day of June', time());
$day_end_t6 = strtotime('last day of June', time());

$tong_tra_m6 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t6 AND `ngay_ky_hd` <= $day_end_t6 "))->result)['gia_tri_s'];
if ($tong_tra_m6 == "") {
    $tong_tra_m6 = 0;
}
$tong_thu_m6 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t6 AND `ngay_ky_hd` <= $day_end_t6 "))->result)['gia_tri_s'];
if ($tong_thu_m6 == "") {
    $tong_thu_m6 = 0;
}

$day_start_t7 = strtotime('first day of July', time());
$day_end_t7 = strtotime('last day of July', time());

$tong_tra_m7 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t7 AND `ngay_ky_hd` <= $day_end_t7 "))->result)['gia_tri_s'];
if ($tong_tra_m7 == "") {
    $tong_tra_m7 = 0;
}
$tong_thu_m7 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t7 AND `ngay_ky_hd` <= $day_end_t7 "))->result)['gia_tri_s'];
if ($tong_thu_m7 == "") {
    $tong_thu_m7 = 0;
}

$day_start_t8 = strtotime('first day of August', time());
$day_end_t8 = strtotime('last day of August', time());

$tong_tra_m8 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t8 AND `ngay_ky_hd` <= $day_end_t8 "))->result)['gia_tri_s'];
if ($tong_tra_m8 == "") {
    $tong_tra_m8 = 0;
}
$tong_thu_m8 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t8 AND `ngay_ky_hd` <= $day_end_t8 "))->result)['gia_tri_s'];
if ($tong_thu_m8 == "") {
    $tong_thu_m8 = 0;
}

$day_start_t9 = strtotime('first day of September', time());
$day_end_t9 = strtotime('last day of September', time());

$tong_tra_m9 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t9 AND `ngay_ky_hd` <= $day_end_t9 "))->result)['gia_tri_s'];
if ($tong_tra_m9 == "") {
    $tong_tra_m9 = 0;
}
$tong_thu_m9 = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t9 AND `ngay_ky_hd` <= $day_end_t9 "))->result)['gia_tri_s'];
if ($tong_thu_m9 == "") {
    $tong_thu_m9 = 0;
}

$day_start_t10 = strtotime('first day of October', time());
$day_end_t10 = strtotime('last day of October', time());

$tong_tra_m10 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t10 AND `ngay_ky_hd` <= $day_end_t10 "))->result)['gia_tri_s'];
if ($tong_tra_m10 == "") {
    $tong_tra_m10 = 0;
}
$tong_thu_m10 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t10 AND `ngay_ky_hd` <= $day_end_t10 "))->result)['gia_tri_s'];
if ($tong_thu_m10 == "") {
    $tong_thu_m10 = 0;
}

$day_start_t11 = strtotime('first day of November', time());
$day_end_t11 = strtotime('last day of November', time());

$tong_tra_m11 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t11 AND `ngay_ky_hd` <= $day_end_t11 "))->result)['gia_tri_s'];
if ($tong_tra_m11 == "") {
    $tong_tra_m11 = 0;
}
$tong_thu_m11 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t11 AND `ngay_ky_hd` <= $day_end_t11 "))->result)['gia_tri_s'];
if ($tong_thu_m11 == "") {
    $tong_thu_m11 = 0;
}

$day_start_t12 = strtotime('first day of December', time());
$day_end_t12 = strtotime('last day of December', time());

$tong_tra_m12 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id
                                                AND (`phan_loai` = 1 OR `phan_loai` = 4 OR `phan_loai` = 3)
                                                AND `ngay_ky_hd` >= $day_start_t12 AND `ngay_ky_hd` <= $day_end_t12 "))->result)['gia_tri_s'];
if ($tong_tra_m12 == "") {
    $tong_tra_m12 = 0;
}
$tong_thu_m12 = mysql_fetch_assoc((new db_query("SELECT SUM(`gia_tri_svat`) AS gia_tri_s FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 2
                            AND `ngay_ky_hd` >= $day_start_t12 AND `ngay_ky_hd` <= $day_end_t12 "))->result)['gia_tri_s'];
if ($tong_thu_m12 == "") {
    $tong_thu_m12 = 0;
}
    // $month_start1 = strtotime(date('Y-m-01'));
    // $month_end1 = strtotime(date("Y-m-t"));
    // $lngay_dau = getdate($month_start1);
    // $ngay_dau = $lngay_dau['mday'];
    // $month = date('m', time());
    // $year = date('Y', time());

    // $lngay_cuoi = getdate($month_end1);
    // $ngay_cuoi = $lngay_cuoi['mday'];
    // for($i = $ngay_dau; $i <= $ngay_cuoi; $i++ ){
    //     echo "<pre>";
    //     print_r($year.'-'.$month.'-'.$i);
    //     echo "<pre>";
    // }

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý trang chủ</title>
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
    <div class="main-container ql_trangchu_s">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctt_tt_one w_100 float_l">
                    <div class="tt_left_one staff_fulln d_flex flex_jct">
                        <div class="til_fulln">
                            <h1 class="ten_nvien_ql  w_100 float_l cr_weight"><span class="share_clr_one">Xin
                                    chào,</span> <span class="share_clr_four"><?= $user_name ?></span></h1>
                            <p class="share_clr_three mb_10">Chúc bạn một ngày mới làm việc hiệu quả!</p>
                        </div>
                        <div class="titl_avt_full">
                            <picture>
                                <source media="(max-width: 768px)" srcset="../img/pana_res.png">
                                <img src="../img/pana.png" alt="ảnh đại diện">
                            </picture>
                        </div>
                    </div>
                    <div class="tt_right_one staff_fulln">
                        <div class="ctn_tt_right w_100 float_l">
                            <h3 class="time_tt cr_weight share_clr_one w_100 float_l" id="runningTime"></h3>
                            <p class="cr_weight share_clr_one share_fsize_tow w_100 float_l"><?= $array_t[$weekday] ?>,
                                <?= $date_f ?></p>
                        </div>
                    </div>
                </div>
                <div class="ctt_tt_two mb_20 w_100 float_l">
                    <div class="tt_left_tow staff_fulln">
                        <div class="cnt_left_tow">
                            <div class="ctn_cnt_left">
                                <div class="tieu_de_bd w_100 float_l d_flex mb_20 flex_jct">
                                    <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10 mr_10">Công nợ phải thu</h3>
                                    <div class="filter_mdy">
                                        <select name="tim_kiem" class="form_search_dmy cong_no_thu">
                                            <option value="1">Theo ngày</option>
                                            <option value="2">Theo tháng</option>
                                            <option value="3">Theo năm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="tt_charts theo_ngay_thu" data1="<?= $da_thu ?>" data2="<?= $con_lai_thu ?>" data3="<?= $tong_thu ?>">
                                    <div class="chart"></div>
                                </div>
                                <div class="tt_charts_one theo_thang_thu" data1="<?= $da_thu_m ?>" data2="<?= $con_lai_thu_m ?>" data3="<?= $tong_thu_m ?>">
                                    <div class="chart_one share_dnone"></div>
                                </div>
                                <div class="tt_charts_two theo_nam_thu" data1="<?= $da_thu_y ?>" data2="<?= $con_lai_thu_y ?>" data3="<?= $tong_thu_y ?>">
                                    <div class="chart_two share_dnone"></div>
                                </div>
                                <!-- <div class="chart"></div> -->
                                <div class="ttin_ctiet w_100 float_l mb_20 ttin_ctiet_thu">
                                    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
                                        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_thu) ?></p>
                                    </div>
                                    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="dthu share_fsize_tow share_clr_one">Đã thu:</p>
                                        <p class="share_fsize_tow cr_xanh_dam cr_weight da_thu_tt" data="<?= $da_thu ?>"><?= number_format($da_thu) ?></p>
                                    </div>
                                    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="cphai_thu share_fsize_tow share_clr_one">Còn phải thu</p>
                                        <p class="share_fsize_tow cr_vang cr_weight con_lai_thu" data="<?= $con_lai_thu ?>"><?= number_format($con_lai_thu) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tt_left_tow staff_fulln tt_right_tow float_l">
                        <div class="cnt_left_tow">
                            <div class="ctn_cnt_left">
                                <div class="tieu_de_bd w_100 float_l d_flex mb_20 flex_jct">
                                    <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10 mr_10">Công nợ phải trả</h3>
                                    <div class="filter_mdy">
                                        <select name="tim_kiem" class="form_search_dmy cong_no_tra">
                                            <option value="1" selected>Theo ngày</option>
                                            <option value="2">Theo tháng</option>
                                            <option value="3">Theo năm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="tt_charts theo_ngay" data1="<?= $da_tra ?>" data2="<?= $con_lai_tra ?>" data3="<?= $tong_tra ?>">
                                    <div class="charts"></div>
                                </div>
                                <div class="tt_charts_one theo_thang" data1="<?= $da_tra_m ?>" data2="<?= $con_lai_tra_m ?>" data3="<?= $tong_tra_m ?>">
                                    <div class="charts_one share_dnone"></div>
                                </div>
                                <div class="tt_charts_two theo_nam" data1="<?= $da_tra_y ?>" data2="<?= $con_lai_tra_y ?>" data3="<?= $tong_tra_y ?>">
                                    <div class="charts_two share_dnone"></div>
                                </div>
                                <div class="ttin_ctiet w_100 float_l mb_20 ttin_ctiet_tra">
                                    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
                                        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_tra) ?></p>
                                    </div>
                                    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
                                        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $da_tra ?>"><?= number_format($da_tra) ?></p>
                                    </div>
                                    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
                                        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
                                        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_tra ?>"><?= number_format($con_lai_tra) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ctt_tt_three w_100">
                    <div class="tieu_de_chart w_100 float_l d_flex">
                        <h3 class="tieu_de_ct share_fsize_four share_clr_one mb_10">Giá trị hợp đồng mua, bán</h3>
                        <div class="search_chart">
                            <input name="search_chart" class="form_search_dmy share_clr_one share_fsize_tow share_bgr_tow tex_center" value="Theo năm" style="background-color: #FFFFFF;" readonly>
                            <!-- <select name="search_chart" class="form_search_dmy share_clr_one share_fsize_tow"> -->
                            <!-- <option value="1">Theo năm</option>
                                <option value="2">Theo tháng</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="content_hcot w_100 float_l">
                        <div id="tt_three_ctiet"></div>
                        <table id="datatable" class="share_dnone">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Hợp đồng mua</th>
                                    <th>Hợp đồng bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m1 ?></td>
                                    <td><?= $tong_thu_m1 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m2 ?></td>
                                    <td><?= $tong_thu_m2 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m3 ?></td>
                                    <td><?= $tong_thu_m3 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m4 ?></td>
                                    <td><?= $tong_thu_m4 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m5 ?></td>
                                    <td><?= $tong_thu_m5 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m6 ?></td>
                                    <td><?= $tong_thu_m6 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m7 ?></td>
                                    <td><?= $tong_thu_m7 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m8 ?></td>
                                    <td><?= $tong_thu_m8 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m9 ?></td>
                                    <td><?= $tong_thu_m9 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m10 ?></td>
                                    <td><?= $tong_thu_m10 ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m11 ?></td>
                                    <td><?= $tong_thu_m11 ?></td>

                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?= $tong_tra_m12 ?></td>
                                    <td><?= $tong_thu_m12 ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="titl_chr w_100 float_l">
                        <p class="hd_mua_chr share_clr_one share_fsize_tow">Hợp đồng mua</p>
                        <p class="hd_ban_chr share_clr_one share_fsize_tow">Hợp đồng bán</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include("../modals/modal_logout.php") ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/apexcharts.min.js"></script>

<!-- js bieu do cot -->
<script src="../js/highcharts.js"></script>
<script src="../js/export-data.js"></script>
<script src="../js/exporting.js"></script>
<script src="../js/accessibility.js"></script>
<!-- end -->
<script type="text/javascript" src="../js/style.js"></script>
<script>
    $(document).ready(function() {
        setInterval(runningTime, 1000);
    });

    function runningTime() {
        $.ajax({
            url: '../ajax/timeScr.php',
            success: function(data) {
                $('#runningTime').html(data);
            },
        });
    }

    $(".cong_no_tra").change(function() {
        var id = $(this).val();
        var tra_n = $(".theo_ngay").attr("data1");
        var con_lai_n = $(".theo_ngay").attr("data2");
        var tong_tra = $(".theo_ngay").attr("data3");
        var tra_m = $(".theo_thang").attr("data1");
        var con_lai_m = $(".theo_thang").attr("data2");
        var tong_tra_m = $(".theo_thang").attr("data3");
        var tra_y = $(".theo_nam").attr("data1");
        var con_lai_y = $(".theo_nam").attr("data2");
        var tong_tra_y = $(".theo_nam").attr("data3");

        $.ajax({
            url: '../render/cong_tra.php',
            type: 'POST',
            data: {
                cong_tra: id,
                tra_n: tra_n,
                con_lai_n: con_lai_n,
                tong_tra: tong_tra,
                tra_m: tra_m,
                con_lai_m: con_lai_m,
                tong_tra_m: tong_tra_m,
                tra_y: tra_y,
                con_lai_y: con_lai_y,
                tong_tra_y: tong_tra_y,
            },
            success: function(data) {
                $(".ttin_ctiet_tra").html(data);
                if (id == 1) {
                    $(".charts").css('display', 'block');
                    $(".charts_one").css('display', 'none');
                    $(".charts_two").css('display', 'none');
                } else if (id == 2) {
                    $(".charts").css('display', 'none');
                    $(".charts_one").css('display', 'block');
                    $(".charts_two").css('display', 'none');
                } else if (id == 3) {
                    $(".charts").css('display', 'none');
                    $(".charts_one").css('display', 'none');
                    $(".charts_two").css('display', 'block');
                }
            }
        });
    });

    $(".cong_no_thu").change(function() {
        var id = $(this).val();
        var thu_n = $(".theo_ngay_thu").attr("data1");
        var con_lai_n = $(".theo_ngay_thu").attr("data2");
        var tong_thu = $(".theo_ngay_thu").attr("data3");
        var thu_m = $(".theo_thang_thu").attr("data1");
        var con_lai_m = $(".theo_thang_thu").attr("data2");
        var tong_thu_m = $(".theo_thang_thu").attr("data3");
        var thu_y = $(".theo_nam_thu").attr("data1");
        var con_lai_y = $(".theo_nam_thu").attr("data2");
        var tong_thu_y = $(".theo_nam_thu").attr("data3");

        $.ajax({
            url: '../render/cong_thu.php',
            type: 'POST',
            data: {
                cong_thu: id,
                thu_n: thu_n,
                con_lai_n: con_lai_n,
                tong_thu: tong_thu,
                thu_m: thu_m,
                con_lai_m: con_lai_m,
                tong_thu_m: tong_thu_m,
                thu_y: thu_y,
                con_lai_y: con_lai_y,
                tong_thu_y: tong_thu_y,
            },
            success: function(data) {
                $(".ttin_ctiet_thu").html(data);
                if (id == 1) {
                    $(".chart").css('display', 'block');
                    $(".chart_one").css('display', 'none');
                    $(".chart_two").css('display', 'none');
                } else if (id == 2) {
                    $(".chart").css('display', 'none');
                    $(".chart_one").css('display', 'block');
                    $(".chart_two").css('display', 'none');
                } else if (id == 3) {
                    $(".chart").css('display', 'none');
                    $(".chart_one").css('display', 'none');
                    $(".chart_two").css('display', 'block');
                }
            }
        });
    });
</script>
<!-- công trả theo ngày -->
<script>
    var da_tra_tt = Number($(".da_tra_tt").attr("data"));
    var con_lai_tra = Number($(".con_lai_tra").attr("data"));
    var options = {
        series: [da_tra_tt, con_lai_tra],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#F2994A', '#EB5757'],
        labels: ['Đã trả', 'Chưa trả'],
    };
    var chart = new ApexCharts(document.querySelector(".charts"), options);
    chart.render();
</script>
<!-- công trả theo tháng -->
<script>
    var da_tra_m = Number($(".theo_thang").attr("data1"));
    var con_lai_tra_m = Number($(".theo_thang").attr("data2"));
    var options = {
        series: [da_tra_m, con_lai_tra_m],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#F2994A', '#EB5757'],
        labels: ['Đã trả', 'Chưa trả'],
    };
    var chart = new ApexCharts(document.querySelector(".charts_one"), options);
    chart.render();
</script>
<!-- công trả theo năm -->
<script>
    var da_tra_y = Number($(".theo_nam").attr("data1"));
    var con_lai_tra_y = Number($(".theo_nam").attr("data2"));
    var options = {
        series: [da_tra_y, con_lai_tra_y],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#F2994A', '#EB5757'],
        labels: ['Đã trả', 'Chưa trả'],
    };
    var chart = new ApexCharts(document.querySelector(".charts_two"), options);
    chart.render();
</script>
<!-- công thu theo ngày -->
<script>
    var da_thu_tt = Number($(".theo_ngay_thu").attr("data1"));
    var con_lai_thu = Number($(".theo_ngay_thu").attr("data2"));
    var options = {
        series: [da_thu_tt, con_lai_thu],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#219653', '#F2C94C'],
        labels: ['Đã thu', 'Chưa thu'],
    };
    var chart = new ApexCharts(document.querySelector(".chart"), options);
    chart.render();
</script>
<!-- công thu theo tháng -->
<script>
    var da_thu_m = Number($(".theo_thang_thu").attr("data1"));
    var con_lai_m = Number($(".theo_thang_thu").attr("data2"));
    var options = {
        series: [da_thu_m, con_lai_m],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#219653', '#F2C94C'],
        labels: ['Đã thu', 'Chưa thu'],
    };
    var chart = new ApexCharts(document.querySelector(".chart_one"), options);
    chart.render();
</script>
<!-- công thu theo năm -->
<script>
    var da_thu_y = Number($(".theo_nam_thu").attr("data1"));
    var con_lai_y = Number($(".theo_nam_thu").attr("data2"));
    var options = {
        series: [da_thu_y, con_lai_y],
        chart: {
            width: 280,
            type: 'pie',
        },
        colors: ['#219653', '#F2C94C'],
        labels: ['Đã thu', 'Chưa thu'],
    };
    var chart = new ApexCharts(document.querySelector(".chart_two"), options);
    chart.render();
</script>
<!-- giá trị hợp đồng mua, bán -->
<script>
    Highcharts.chart('tt_three_ctiet', {
        data: {
            table: 'datatable'
        },

        chart: {
            type: 'column'
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            },
            labels: {
                style: {
                    color: '#474747',
                    fontSize: '14px',
                },
            },
        },

        tooltip: {
            style: {
                color: '#474747',
                fontSize: '14px',
            }
        },

        xAxis: {
            labels: {
                style: {
                    color: '#474747',
                    fontSize: '14px',
                }
            },

            categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
        },

        title: false,
        subtitle: false,

        colors: ['#E09A6A ', '#9D92C8'],
    });
</script>

</html>