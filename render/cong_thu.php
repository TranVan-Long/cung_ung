<?
include("config.php");

$cong_thu = getValue('cong_thu', 'int', 'POST', '');

$thu_n = $_POST['thu_n'];
$thu_n = sql_injection_rp($thu_n);

$con_lai_n = $_POST['con_lai_n'];
$con_lai_n = sql_injection_rp($con_lai_n);

$tong_thu = $_POST['tong_thu'];
$tong_thu = sql_injection_rp($tong_thu);

$thu_m = $_POST['thu_m'];
$thu_m = sql_injection_rp($thu_m);

$con_lai_m = $_POST['con_lai_m'];
$con_lai_m = sql_injection_rp($con_lai_m);

$tong_thu_m = $_POST['tong_thu_m'];
$tong_thu_m = sql_injection_rp($tong_thu_m);

$thu_y = $_POST['thu_y'];
$thu_y = sql_injection_rp($thu_y);

$con_lai_y = $_POST['con_lai_y'];
$con_lai_y = sql_injection_rp($con_lai_y);

$tong_thu_y = $_POST['tong_thu_y'];
$tong_thu_y = sql_injection_rp($tong_thu_y);

if ($cong_thu == 1) {
?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_thu) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $thu_n ?>"><?= number_format($thu_n) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_n ?>"><?= number_format($con_lai_n) ?></p>
    </div>
<? } else if ($cong_thu == 2) { ?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_thu_m) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $thu_m ?>"><?= number_format($thu_m) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_m ?>"><?= number_format($con_lai_m) ?></p>
    </div>
<? } else if ($cong_thu == 3) { ?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_thu_y) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $thu_y ?>"><?= number_format($thu_y) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_y ?>"><?= number_format($con_lai_y) ?></p>
    </div>
<? } ?>