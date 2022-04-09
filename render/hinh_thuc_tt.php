<?
include("config.php");
$hthuc_tt = getValue('hthuc_tt', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_phieu = getValue('id_phieu', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');
$id_hd_dh = getValue('id_hd_dh', 'int', 'POST', '');


if ($com_id == "" && $id_phieu == "" && $id_hd_dh == "" && $loai_phieu == "" && $hthuc_tt != "") {
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
                            <input name="ten_nhanhang" class="form-control" type="text" placeholder="Nhập tên ngân hàng">
                        </div>
                        <div class="form-group share_form_select">
                            <label>Chi nhánh <span class="cr_red">*</span></label>
                            <input type="text" class="form-control" name="chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group share_form_select">
                            <label>Số tài khoản <span class="cr_red">*</span></label>
                            <input type="number" class="form-control" name="so_tk" placeholder="Nhập tên số tài khoản ngân hàng">
                        </div>
                        <div class="form-group">
                            <label>Chủ tài khoản </label>
                            <input type="text" name="chu_taik" class="form-control" placeholder="Nhập tên chủ tài khoản">
                        </div>
                    </div>
                </div>
                <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
            </div>
        </div>
        <? }
} else if ($com_id != "" && $id_phieu != "" && $id_hd_dh != "" && $loai_phieu != "" && $hthuc_tt != "") {
    $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_cong_ty` = $com_id AND `id` = $id_phieu AND `id_hd_dh` = $id_hd_dh AND `hinh_thuc_tt` = $hthuc_tt ");
    if (mysql_num_rows($check_tt->result) > 0) {
        $hinh_thuc_tt = mysql_fetch_assoc((new db_query("SELECT `hinh_thuc_tt` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                            AND `id_hd_dh` = $id_hd_dh "))->result)['hinh_thuc_tt'];
        if ($hthuc_tt == 2 || $hthuc_tt == 3) {
            if ($hthuc_tt == $hinh_thuc_tt) {
                $tai_khoan = new db_query("SELECT `id`, `ten_ngan_hang`, `ten_chi_nhanh`, `so_tk`, `chu_tk`
                                            FROM `tai_khoan_thanh_toan` WHERE `id_phieu_tt` = $id_phieu  "); ?>
                <div class="ctie_form_nhang w_100 float_l">
                    <div class="tieu_de  w_100 float_l d_flex fl_wrap mb_10">
                        <p class="mr_30 share_fsize_tow share_clr_one cr_weight cate_bank">Danh sách
                            tài khoản ngân hàng</p>
                        <p class="add_ngan_hang share_clr_four share_fsize_tow cr_weight share_cursor">
                            + Thêm mới tài khoản ngân hàng</p>
                    </div>
                    <? while ($row1 = mysql_fetch_assoc($tai_khoan->result)) { ?>
                        <div class="tien_chi_tra w_100 float_l d_flex fl_agi">
                            <div class="form-ctra w_100 float_l">
                                <div class="form-row">
                                    <div class="form-group share_form_select">
                                        <label>Tên ngân hàng <span class="cr_red">*</span></label>
                                        <input name="ten_nhanhang" class="form-control" type="text" value="<?= $row1['ten_ngan_hang'] ?>">
                                        <input name="id_stk" type="hidden" value="<?= $row1['id'] ?>">
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Chi nhánh <span class="cr_red">*</span></label>
                                        <input type="text" class="form-control" name="chi_nhanh" value="<?= $row1['ten_chi_nhanh'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group share_form_select">
                                        <label>Số tài khoản <span class="cr_red">*</span></label>
                                        <input type="number" class="form-control" name="so_tk" value="<?= $row1['so_tk'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Chủ tài khoản </label>
                                        <input type="text" name="chu_taik" class="form-control" value="<?= $row1['chu_tk'] ?>">
                                    </div>
                                </div>
                            </div>
                            <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
                        </div>
                    <? } ?>
                </div>
            <? } else if ($hthuc_tt != $hinh_thuc_tt) { ?>
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
                </div>
        <? }
        }
    } else { ?>
        <div class="ctie_form_nhang w_100 float_l ">
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
                            <input name="ten_nhanhang" class="form-control" type="text" placeholder="Nhập tên ngân hàng">
                        </div>
                        <div class="form-group share_form_select">
                            <label>Chi nhánh <span class="cr_red">*</span></label>
                            <input type="text" class="form-control" name="chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group share_form_select">
                            <label>Số tài khoản <span class="cr_red">*</span></label>
                            <input type="number" class="form-control" name="so_tk" placeholder="Nhập tên số tài khoản ngân hàng" oninput="<?= $oninput ?>">
                        </div>
                        <div class="form-group">
                            <label>Chủ tài khoản </label>
                            <input type="text" name="chu_taik" class="form-control" placeholder="Nhập tên chủ tài khoản">
                        </div>
                    </div>
                </div>
                <span class="remove_tnh ml_50 mr_10 share_cursor"><img src="../img/remove-2.png" alt="xóa"></span>
            </div>
        </div>
<? }
} ?>