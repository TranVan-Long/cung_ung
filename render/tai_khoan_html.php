<?
include("config.php");
$kh_bank = getValue('kh_bank', 'int', 'POST', '');
if ($kh_bank == "") {
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
<? } else if ($kh_bank != "") { ?>
    <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
        <div class="bank-form">
            <div class="form-row left">
                <div class="form-col-50 left mb_15">
                    <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">&ast;</span></label>
                    <input type="text" name="ten_nhanhang" placeholder="Nhập tên ngân hàng">
                </div>
                <div class="form-col-50 right mb_15 v-select2">
                    <label for="chi-nhanh-ngan-hang">Chi nhánh
                        <span class="text-red">&ast;</span></label>
                    <input type="text" name="chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                </div>
            </div>
            <div class="form-row left">
                <div class="form-col-50 left mb_15">
                    <label>Số tài khoản<span class="text-red">&ast;</span></label>
                    <input type="text" name="so_tk" placeholder="Nhập số tài khoản" oninput="<?= $oninput ?>">
                </div>
                <div class="form-col-50 right mb_15">
                    <label>Chủ tài khoản</label>
                    <input type="text" name="chu_taik" placeholder="Nhập tên chủ tài khoản">
                </div>
            </div>
        </div>
        <div class="removeItem2">
            <i class="ic-delete2"></i>
        </div>
    </div>
<? } ?>