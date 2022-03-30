<?
include("config.php");
$hthuc_tt = getValue('hthuc_tt', 'int', 'POST', '');
if ($hthuc_tt == 2 || $hthuc_tt == 3) {
?>
    <div class="ctie_form_nhang w_100 float_l">
        <div class="tieu_de  w_100 float_l d_flex fl_wrap mb_10">
            <p class="mr_30 share_fsize_tow share_clr_one cr_weight cate_bank">Danh sách
                tài khoản ngân hàng</p>
            <p class="add_ngan_hang share_clr_four share_fsize_tow cr_weight share_cursor">
                + Thêm mới tài khoản ngân hàng</p>
        </div>
        <div class="tien_chi_tra w_100 float_l d_flex fl_agi">
            <div class="form-ctra w_100 float_l">
                <div class="form-row">
                    <div class="form-group share_form_select">
                        <label>Tên ngân hàng <span class="cr_red">*</span></label>
                        <input name="ten_nhanhang" class="form-control" type="text">
                    </div>
                    <div class="form-group share_form_select">
                        <label>Chi nhánh <span class="cr_red">*</span></label>
                        <input type="text" class="form-control" name="chi_nhanh">
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
    <? } ?>