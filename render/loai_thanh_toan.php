<?
include("config.php");
include("../includes/icon.php");
$loai_tt = getValue('all_ltt', 'int', 'POST', '');
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');


if ($loai_phieu != "" && $hd_dh != "") {
    if ($loai_tt == 1) {
?>
        <div class="ctn_ct_from w_100 float_l">
            <div class="form-row w_100 float_l">
                <div class="form-group">
                    <label>Số tiền <span class="cr_red">*</span></label>
                    <input type="text" name="so_tien" class="form-control so_tien" onkeyup="so_tien_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập số tiền">
                </div>
                <div class="form-group">
                    <label>Tỷ giá</label>
                    <input type="text" name="ty_gia" class="form-control ty_gia" onkeyup="ty_gia_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập tỷ giá">
                </div>
            </div>
            <div class="form-row w_100 float_l">
                <div class="form-group">
                    <label>Giá trị quy đổi</label>
                    <input type="text" name="so_tien_qdoi" class="form-control h_border cr_weight gia_qdoi" readonly>
                </div>
            </div>
        </div>
    <? } else if ($loai_tt == 2) {
        if ($loai_phieu == 1) {
            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);
            $ten_hs = mysql_fetch_assoc((new db_query("SELECT `id`, `thoi_han_thanh_toan` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh "))->result);
        } else if ($loai_phieu == 2) {
            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);
            $ten_hs = mysql_fetch_assoc((new db_query("SELECT `id`, `thoi_han_thanh_toan` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh "))->result);
        }
    ?>
        <div class="ctn_table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="share_tb_five">Hồ sơ thanh toán</th>
                        <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                        <th class="share_tb_five">Thời hạn thanh toán</th>
                        <th class="share_tb_five">Thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="sh_bgr_four">
                        <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                        <td class="share_clr_four cr_weight share_tb_five"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                        <td class="share_tb_five"></td>
                        <td class="share_clr_four cr_weight share_tb_five"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                    </tr>
                    <!-- <tr class="sh_bgr_five">
                        <td class="tex_left share_h_52 share_tb_five">Công trình xây dựng cầu XYZ</td>
                        <td class="share_tb_five">25.000.000</td>
                        <td class="share_tb_five"></td>
                        <td class="share_tb_five">25.000.000</td>
                    </tr> -->
                    <tr>
                        <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $ten_hs['id'] ?>">HS - <?= $ten_hs['id'] ?></td>
                        <td class="share_tb_five"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                        <td class="share_tb_five"><?= ($ten_hs['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $ten_hs['thoi_han_thanh_toan']) ?></td>
                        <td class="share_tb_five">
                            <div class="form-group">
                                <input type="text" name="so_tien_ctra" class="form-control tex_center">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
<? }
} ?>