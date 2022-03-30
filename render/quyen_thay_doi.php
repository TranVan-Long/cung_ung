<?
include("config.php");
$id_nv = getValue('id_nv', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');

if ($id_nv != "" && $com_id != "") {
    $nhan_vien = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $id_nv AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($nhan_vien->result) > 0) {
        $ctiet_pqnv = mysql_fetch_assoc((new db_query("SELECT `id`, `yeu_cau_vat_tu`, `hop_dong`, `don_hang`, `ho_so_tt`, `phieu_tt`, `bang_gia`, `yeu_cau_bao_gia`,
                                    `bao_gia`, `bao_gia_kh`, `nha_cung_cap`, `danh_gia_ncc`, `tieu_chi_danh_gia`, `khach_hang`, `bc_doanh_so`,
                                    `cog_no_thu`, `cong_no_tra` FROM `phan_quyen` WHERE `id_nhan_vien` = $id_nv AND `id_cong_ty` = $com_id "))->result);

        $ycvt = explode(',', $ctiet_pqnv['yeu_cau_vat_tu']);
        $hop_dong = explode(',', $ctiet_pqnv['hop_dong']);
        $don_hang = explode(',', $ctiet_pqnv['don_hang']);
        $hs_tt = explode(',', $ctiet_pqnv['ho_so_tt']);
        $phieu_tt = explode(',', $ctiet_pqnv['phieu_tt']);
        $bang_gia = explode(',', $ctiet_pqnv['bang_gia']);
        $ycbg = explode(',', $ctiet_pqnv['yeu_cau_bao_gia']);
        $bao_gia = explode(',', $ctiet_pqnv['bao_gia']);
        $bao_gia_kh = explode(',', $ctiet_pqnv['bao_gia_kh']);
        $nha_cc = explode(',', $ctiet_pqnv['nha_cung_cap']);
        $dgia_ncc = explode(',', $ctiet_pqnv['danh_gia_ncc']);
        $tieu_chi_dg = explode(',', $ctiet_pqnv['tieu_chi_danh_gia']);
        $khach_hang = explode(',', $ctiet_pqnv['khach_hang']);
        $bc_doanh_so = explode(',', $ctiet_pqnv['bc_doanh_so']);
        $cong_no_thu = explode(',', $ctiet_pqnv['cog_no_thu']);
        $cong_no_tra = explode(',', $ctiet_pqnv['cong_no_tra']);


?>

        <p class="th_tilt_tb w_100 float_l d_flex fl_agi dflex_jc share_bgr_one share_clr_tow cr_weight">QUẢN LÝ PHÂN QUYỀN CHO NGƯỜI DÙNG</p>
        <table class="table">
            <thead>
                <tr>
                    <th class="share_tb_five">Quyền người dùng</th>
                    <th class="share_tb_three">Xem</th>
                    <th class="share_tb_three">Thêm</th>
                    <th class="share_tb_three">Sửa</th>
                    <th class="share_tb_three">Xóa</th>
                    <th class="share_tb_three">Duyệt / Xác nhận</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="share_tb_five">
                        <p>Yêu cầu vật tư</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="yeucau_vt" <?= (in_array(1, $ycvt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="yeucau_vt" <?= (in_array(2, $ycvt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="yeucau_vt" <?= (in_array(3, $ycvt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="yeucau_vt" <?= (in_array(4, $ycvt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="5" name="yeucau_vt" <?= (in_array(5, $ycvt)) ? "checked" : "" ?>>
                        </div>
                    </td>

                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p>Hợp đồng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(1, $hop_dong) && in_array(1, $don_hang) && in_array(1, $hs_tt) && in_array(1, $phieu_tt)) { ?>
                                <input type="checkbox" name="checkedAll_one" id="checkedAll_one" checked>
                            <? } else { ?>
                                <input type="checkbox" name="checkedAll_one" id="checkedAll_one">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(2, $hop_dong) && in_array(2, $don_hang) && in_array(2, $hs_tt) && in_array(2, $phieu_tt)) { ?>
                                <input type="checkbox" name="checkedAll_two" id="checkedAll_two" checked>
                            <? } else { ?>
                                <input type="checkbox" name="checkedAll_two" id="checkedAll_two">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(3, $hop_dong) && in_array(3, $don_hang) && in_array(3, $hs_tt) && in_array(3, $phieu_tt)) { ?>
                                <input type="checkbox" name="checkedAll_three" id="checkedAll_three" checked>
                            <? } else { ?>
                                <input type="checkbox" name="checkedAll_three" id="checkedAll_three">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(4, $hop_dong) && in_array(4, $don_hang) && in_array(4, $hs_tt) && in_array(4, $phieu_tt)) { ?>
                                <input type="checkbox" name="checkedAll_four" id="checkedAll_four" checked>
                            <? } else { ?>
                                <input type="checkbox" name="checkedAll_four" id="checkedAll_four">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Hợp đồng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="hop_dong" class="checkSingle_one" <?= (in_array(1, $hop_dong)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="hop_dong" class="checkSingle_two" <?= (in_array(2, $hop_dong)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="hop_dong" class="checkSingle_three" <?= (in_array(3, $hop_dong)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="hop_dong" class="checkSingle_four" <?= (in_array(4, $hop_dong)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Đơn hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="don_hang" class="checkSingle_one" <?= (in_array(1, $don_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="don_hang" class="checkSingle_two" <?= (in_array(2, $don_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="don_hang" class="checkSingle_three" <?= (in_array(3, $don_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="don_hang" class="checkSingle_four" <?= (in_array(4, $don_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Hồ sơ thanh toán</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="hs_tt" class="checkSingle_one" <?= (in_array(1, $hs_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="hs_tt" class="checkSingle_two" <?= (in_array(2, $hs_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="hs_tt" class="checkSingle_three" <?= (in_array(3, $hs_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="hs_tt" class="checkSingle_four" <?= (in_array(4, $hs_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Phiếu thanh toán</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="phieu_tt" class="checkSingle_one" <?= (in_array(1, $phieu_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="phieu_tt" class="checkSingle_two" <?= (in_array(2, $phieu_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="phieu_tt" class="checkSingle_three" <?= (in_array(3, $phieu_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="phieu_tt" class="checkSingle_four" <?= (in_array(4, $phieu_tt)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Bảng giá</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(1, $bang_gia) && in_array(1, $ycbg) && in_array(1, $bao_gia) && in_array(1, $bao_gia_kh)) { ?>
                                <input type="checkbox" name="bang_gia_one" id="all_banggia_one" checked>
                            <? } else { ?>
                                <input type="checkbox" name="bang_gia_one" id="all_banggia_one">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(2, $ycbg) && in_array(2, $bao_gia) && in_array(2, $bao_gia_kh)) { ?>
                                <input type="checkbox" name="bang_gia_two" id="all_banggia_two" checked>
                            <? } else { ?>
                                <input type="checkbox" name="bang_gia_two" id="all_banggia_two">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(3, $ycbg) && in_array(3, $bao_gia) && in_array(3, $bao_gia_kh)) { ?>
                                <input type="checkbox" name="bang_gia_three" id="all_banggia_three" checked>
                            <? } else { ?>
                                <input type="checkbox" name="bang_gia_three" id="all_banggia_three">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(4, $ycbg) && in_array(4, $bao_gia) && in_array(4, $bao_gia_kh)) { ?>
                                <input type="checkbox" name="bang_gia_four" id="all_banggia_four" checked>
                            <? } else { ?>
                                <input type="checkbox" name="bang_gia_four" id="all_banggia_four">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Bảng giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bang_gia" class="banggia_one" <?= (in_array(1, $bang_gia)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Yêu cầu báo giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="yc_baogia" class="banggia_one" <?= (in_array(1, $ycbg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="yc_baogia" class="banggia_two" <?= (in_array(2, $ycbg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="yc_baogia" class="banggia_three" <?= (in_array(3, $ycbg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="yc_baogia" class="banggia_four" <?= (in_array(4, $ycbg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Báo giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bao_gia" class="banggia_one" <?= (in_array(1, $bao_gia)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="bao_gia" class="banggia_two" <?= (in_array(2, $bao_gia)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="bao_gia" class="banggia_three" <?= (in_array(3, $bao_gia)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="bao_gia" class="banggia_four" <?= (in_array(4, $bao_gia)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Báo giá khách hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bao_gia_kh" class="banggia_one" <?= (in_array(1, $bao_gia_kh)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="bao_gia_kh" class="banggia_two" <?= (in_array(2, $bao_gia_kh)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="bao_gia_kh" class="banggia_three" <?= (in_array(3, $bao_gia_kh)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="bao_gia_kh" class="banggia_four" <?= (in_array(4, $bao_gia_kh)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Nhà cung cấp</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(1, $nha_cc) && in_array(1, $dgia_ncc) && in_array(1, $tieu_chi_dg)) { ?>
                                <input type="checkbox" name="nha_cc_one" id="all_nhacc_one" checked>
                            <? } else { ?>
                                <input type="checkbox" name="nha_cc_one" id="all_nhacc_one">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(2, $nha_cc) && in_array(2, $dgia_ncc) && in_array(2, $tieu_chi_dg)) { ?>
                                <input type="checkbox" name="nha_cc_two" id="all_nhacc_two" checked>
                            <? } else { ?>
                                <input type="checkbox" name="nha_cc_two" id="all_nhacc_two">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(3, $nha_cc) && in_array(3, $dgia_ncc) && in_array(3, $tieu_chi_dg)) { ?>
                                <input type="checkbox" name="nha_cc_three" id="all_nhacc_three" checked>
                            <? } else { ?>
                                <input type="checkbox" name="nha_cc_three" id="all_nhacc_three">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(4, $nha_cc) && in_array(4, $dgia_ncc) && in_array(4, $tieu_chi_dg)) { ?>
                                <input type="checkbox" name="nha_cc_four" id="all_nhacc_four" checked>
                            <? } else { ?>
                                <input type="checkbox" name="nha_cc_four" id="all_nhacc_four">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Nhà cung cấp</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="nha_cc" class="nha_cc_one" <?= (in_array(1, $nha_cc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="nha_cc" class="nha_cc_two" <?= (in_array(2, $nha_cc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="nha_cc" class="nha_cc_three" <?= (in_array(3, $nha_cc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="nha_cc" class="nha_cc_four" <?= (in_array(4, $nha_cc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Đánh giá nhà cung cấp</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="danhgia_ncc" class="nha_cc_one" <?= (in_array(1, $dgia_ncc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="danhgia_ncc" class="nha_cc_two" <?= (in_array(2, $dgia_ncc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="danhgia_ncc" class="nha_cc_three" <?= (in_array(3, $dgia_ncc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="danhgia_ncc" class="nha_cc_four" <?= (in_array(4, $dgia_ncc)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Tiêu chí đánh giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="tc_danhgia" class="nha_cc_one" <?= (in_array(1, $tieu_chi_dg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="tc_danhgia" class="nha_cc_two" <?= (in_array(2, $tieu_chi_dg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="tc_danhgia" class="nha_cc_three" <?= (in_array(3, $tieu_chi_dg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="tc_danhgia" class="nha_cc_four" <?= (in_array(4, $tieu_chi_dg)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">Khách hàng</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="khach_hang" <?= (in_array(1, $khach_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="khach_hang" <?= (in_array(2, $khach_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="khach_hang" <?= (in_array(3, $khach_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="khach_hang" <?= (in_array(4, $khach_hang)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Báo cáo</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <? if (in_array(1, $bc_doanh_so) && in_array(1, $cong_no_thu) && in_array(1, $cong_no_tra)) { ?>
                                <input type="checkbox" name="all_bao_cao" id="all_bao_cao" checked>
                            <? } else { ?>
                                <input type="checkbox" name="all_bao_cao" id="all_bao_cao">
                            <? } ?>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Doanh số bán hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="dso_bhang" class="bao_cao_one" <?= (in_array(1, $bc_doanh_so)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Công nợ phải thu</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="congno_pthu" class="bao_cao_one" <?= (in_array(1, $cong_no_thu)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Công nợ phải trả</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="congno_ptra" class="bao_cao_one" <?= (in_array(1, $cong_no_tra)) ? "checked" : "" ?>>
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
            </tbody>
        </table>

    <? } else { ?>
        <p class="th_tilt_tb w_100 float_l d_flex fl_agi dflex_jc share_bgr_one share_clr_tow cr_weight">QUẢN LÝ PHÂN QUYỀN CHO NGƯỜI DÙNG</p>
        <table class="table">
            <thead>
                <tr>
                    <th class="share_tb_five">Quyền người dùng</th>
                    <th class="share_tb_three">Xem</th>
                    <th class="share_tb_three">Thêm</th>
                    <th class="share_tb_three">Sửa</th>
                    <th class="share_tb_three">Xóa</th>
                    <th class="share_tb_three">Duyệt / Xác nhận</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="share_tb_five">
                        <p>Yêu cầu vật tư</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="yeucau_vt">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="yeucau_vt">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="yeucau_vt">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="yeucau_vt">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="5" name="yeucau_vt">
                        </div>
                    </td>

                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p>Hợp đồng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="checkedAll_one" id="checkedAll_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="checkedAll_two" id="checkedAll_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="checkedAll_three" id="checkedAll_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="checkedAll_four" id="checkedAll_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Hợp đồng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="hop_dong" class="checkSingle_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="hop_dong" class="checkSingle_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="hop_dong" class="checkSingle_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="hop_dong" class="checkSingle_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Đơn hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="don_hang" class="checkSingle_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="don_hang" class="checkSingle_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="don_hang" class="checkSingle_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="don_hang" class="checkSingle_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Hồ sơ thanh toán</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="hs_tt" class="checkSingle_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="hs_tt" class="checkSingle_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="hs_tt" class="checkSingle_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="hs_tt" class="checkSingle_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Phiếu thanh toán</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="phieu_tt" class="checkSingle_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="phieu_tt" class="checkSingle_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="phieu_tt" class="checkSingle_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="phieu_tt" class="checkSingle_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Bảng giá</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="bang_gia_one" id="all_banggia_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="bang_gia_two" id="all_banggia_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="bang_gia_three" id="all_banggia_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="bang_gia_four" id="all_banggia_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Bảng giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bang_gia" class="banggia_one">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Yêu cầu báo giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="yc_baogia" class="banggia_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="yc_baogia" class="banggia_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="yc_baogia" class="banggia_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="yc_baogia" class="banggia_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Báo giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bao_gia" class="banggia_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="bao_gia" class="banggia_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="bao_gia" class="banggia_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="bao_gia" class="banggia_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Báo giá khách hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="bao_gia_kh" class="banggia_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="bao_gia_kh" class="banggia_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="bao_gia_kh" class="banggia_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="bao_gia_kh" class="banggia_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Nhà cung cấp</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="nha_cc_one" id="all_nhacc_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="nha_cc_two" id="all_nhacc_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="nha_cc_three" id="all_nhacc_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="nha_cc_four" id="all_nhacc_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Nhà cung cấp</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="nha_cc" class="nha_cc_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="nha_cc" class="nha_cc_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="nha_cc" class="nha_cc_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="nha_cc" class="nha_cc_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Đánh giá nhà cung cấp</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="danhgia_ncc" class="nha_cc_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="danhgia_ncc" class="nha_cc_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="danhgia_ncc" class="nha_cc_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="danhgia_ncc" class="nha_cc_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Tiêu chí đánh giá</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="tc_danhgia" class="nha_cc_one">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="tc_danhgia" class="nha_cc_two">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="tc_danhgia" class="nha_cc_three">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="tc_danhgia" class="nha_cc_four">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">Khách hàng</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="khach_hang">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="2" name="khach_hang">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="3" name="khach_hang">
                        </div>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="4" name="khach_hang">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">Báo cáo</td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" name="all_bao_cao" id="all_bao_cao">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Doanh số bán hàng</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="dso_bhang" class="bao_cao_one">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr class="no_bor_bott">
                    <td class="share_tb_five">
                        <p class="padd_l">Công nợ phải thu</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="congno_pthu" class="bao_cao_one">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
                <tr>
                    <td class="share_tb_five">
                        <p class="padd_l">Công nợ phải trả</p>
                    </td>
                    <td class="share_tb_three">
                        <div class="form-gr">
                            <input type="checkbox" value="1" name="congno_ptra" class="bao_cao_one">
                        </div>
                    </td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                    <td class="share_tb_three"></td>
                </tr>
            </tbody>
        </table>
    <? }
} else if ($id_nv == "" && $com_id != "") { ?>
    <p class="th_tilt_tb w_100 float_l d_flex fl_agi dflex_jc share_bgr_one share_clr_tow cr_weight">QUẢN LÝ PHÂN QUYỀN CHO NGƯỜI DÙNG</p>
    <table class="table">
        <thead>
            <tr>
                <th class="share_tb_five">Quyền người dùng</th>
                <th class="share_tb_three">Xem</th>
                <th class="share_tb_three">Thêm</th>
                <th class="share_tb_three">Sửa</th>
                <th class="share_tb_three">Xóa</th>
                <th class="share_tb_three">Duyệt / Xác nhận</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="share_tb_five">
                    <p>Yêu cầu vật tư</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="yeucau_vt">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="yeucau_vt">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="yeucau_vt">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="yeucau_vt">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="5" name="yeucau_vt">
                    </div>
                </td>

            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p>Hợp đồng</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="checkedAll_one" id="checkedAll_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="checkedAll_two" id="checkedAll_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="checkedAll_three" id="checkedAll_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="checkedAll_four" id="checkedAll_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Hợp đồng</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="hop_dong" class="checkSingle_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="hop_dong" class="checkSingle_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="hop_dong" class="checkSingle_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="hop_dong" class="checkSingle_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Đơn hàng</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="don_hang" class="checkSingle_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="don_hang" class="checkSingle_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="don_hang" class="checkSingle_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="don_hang" class="checkSingle_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Hồ sơ thanh toán</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="hs_tt" class="checkSingle_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="hs_tt" class="checkSingle_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="hs_tt" class="checkSingle_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="hs_tt" class="checkSingle_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr>
                <td class="share_tb_five">
                    <p class="padd_l">Phiếu thanh toán</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="phieu_tt" class="checkSingle_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="phieu_tt" class="checkSingle_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="phieu_tt" class="checkSingle_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="phieu_tt" class="checkSingle_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">Bảng giá</td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="bang_gia_one" id="all_banggia_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="bang_gia_two" id="all_banggia_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="bang_gia_three" id="all_banggia_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="bang_gia_four" id="all_banggia_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Bảng giá</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="bang_gia" class="banggia_one">
                    </div>
                </td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Yêu cầu báo giá</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="yc_baogia" class="banggia_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="yc_baogia" class="banggia_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="yc_baogia" class="banggia_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="yc_baogia" class="banggia_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Báo giá</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="bao_gia" class="banggia_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="bao_gia" class="banggia_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="bao_gia" class="banggia_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="bao_gia" class="banggia_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr>
                <td class="share_tb_five">
                    <p class="padd_l">Báo giá khách hàng</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="bao_gia_kh" class="banggia_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="bao_gia_kh" class="banggia_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="bao_gia_kh" class="banggia_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="bao_gia_kh" class="banggia_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">Nhà cung cấp</td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="nha_cc_one" id="all_nhacc_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="nha_cc_two" id="all_nhacc_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="nha_cc_three" id="all_nhacc_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="nha_cc_four" id="all_nhacc_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Nhà cung cấp</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="nha_cc" class="nha_cc_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="nha_cc" class="nha_cc_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="nha_cc" class="nha_cc_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="nha_cc" class="nha_cc_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Đánh giá nhà cung cấp</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="danhgia_ncc" class="nha_cc_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="danhgia_ncc" class="nha_cc_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="danhgia_ncc" class="nha_cc_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="danhgia_ncc" class="nha_cc_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr>
                <td class="share_tb_five">
                    <p class="padd_l">Tiêu chí đánh giá</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="tc_danhgia" class="nha_cc_one">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="tc_danhgia" class="nha_cc_two">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="tc_danhgia" class="nha_cc_three">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="tc_danhgia" class="nha_cc_four">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr>
                <td class="share_tb_five">Khách hàng</td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="khach_hang">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="2" name="khach_hang">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="3" name="khach_hang">
                    </div>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="4" name="khach_hang">
                    </div>
                </td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">Báo cáo</td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" name="all_bao_cao" id="all_bao_cao">
                    </div>
                </td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Doanh số bán hàng</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="dso_bhang" class="bao_cao_one">
                    </div>
                </td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
            </tr>
            <tr class="no_bor_bott">
                <td class="share_tb_five">
                    <p class="padd_l">Công nợ phải thu</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="congno_pthu" class="bao_cao_one">
                    </div>
                </td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
            </tr>
            <tr>
                <td class="share_tb_five">
                    <p class="padd_l">Công nợ phải trả</p>
                </td>
                <td class="share_tb_three">
                    <div class="form-gr">
                        <input type="checkbox" value="1" name="congno_ptra" class="bao_cao_one">
                    </div>
                </td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
                <td class="share_tb_three"></td>
            </tr>
        </tbody>
    </table>
<? } ?>