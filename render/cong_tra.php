<?
include("config.php");
$cong_tra = getValue('cong_tra', 'int', 'POST', '');

$tra_n = $_POST['tra_n'];
$con_lai_n = $_POST['con_lai_n'];
$tong_tra = $_POST['tong_tra'];
$tra_m = $_POST['tra_m'];
$con_lai_m = $_POST['con_lai_m'];
$tong_tra_m = $_POST['tong_tra_m'];
$tra_y = $_POST['tra_y'];
$con_lai_y = $_POST['con_lai_y'];
$tong_tra_y = $_POST['tong_tra_y'];
if ($cong_tra == 1) {
?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_tra) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $tra_n ?>"><?= number_format($tra_n) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_n ?>"><?= number_format($con_lai_n) ?></p>
    </div>
<? } else if ($cong_tra == 2) { ?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_tra_m) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $tra_m ?>"><?= number_format($tra_m) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_m ?>"><?= number_format($con_lai_m) ?></p>
    </div>
<? } else if ($cong_tra == 3) { ?>
    <div class="tcong_no w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="share_fsize_tow share_clr_one">Tổng công nợ</p>
        <p class="share_fsize_tow share_clr_one cr_weight"><?= number_format($tong_tra_y) ?></p>
    </div>
    <div class="da_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="dtra share_fsize_tow share_clr_one">Đã trả:</p>
        <p class="share_fsize_tow cr_da_cam cr_weight da_tra_tt" data="<?= $tra_y ?>"><?= number_format($tra_y) ?></p>
    </div>
    <div class="con_thu w_100 float_l d_flex mb_10 fl_wrap flex_jct">
        <p class="cphai_tra share_fsize_tow share_clr_one">Còn phải trả:</p>
        <p class="share_fsize_tow cr_do_nhat cr_weight con_lai_tra" data="<?= $con_lai_y ?>"><?= number_format($con_lai_y) ?></p>
    </div>
<? } ?>