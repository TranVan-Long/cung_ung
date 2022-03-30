<?
include("config.php");
?>
<div class="tien_chi_tra w_100 float_l d_flex fl_agi">
    <div class="form-ctra w_100 float_l">
        <div class="form-row">
            <div class="form-group share_form_select">
                <label>Tên ngân hàng <span class="cr_red">*</span></label>
                <input name="ten_nhanhang" class="form-control" type="text">
            </div>
            <div class="form-group share_form_select">
                <label>Chi nhánh <span class="cr_red">*</span></label>
                <input type="text" class="form-control" name="chi_nhanh" oninput="<?= $oninput ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group share_form_select">
                <label>Số tài khoản <span class="cr_red">*</span></label>
                <input type="number" class="form-control" name="so_tk">
            </div>
            <div class="form-group">
                <label>Chủ tài khoản </label>
                <input type="text" name="chu_taik" class="form-control">
            </div>
        </div>
    </div>
    <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
</div>