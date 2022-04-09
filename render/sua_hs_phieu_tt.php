<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$id_phieu = getValue('id_phieu', 'int', 'POST', '');
$loai_tt = getValue('loai_tt', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');

if ($com_id != "" && $hd_dh != "" && $id_phieu != "" && $loai_phieu != "" && $loai_tt = 2) {
    if ($loai_phieu == 1) {
        $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                AND `loai_thanh_toan` = $loai_tt AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = $loai_phieu ");
        if (mysql_num_rows($check_tt->result) > 0) {
            $list_hs = new db_query("SELECT `id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`
                                    FROM `chi_tiet_phieu_tt_vt` WHERE `id_cong_ty` = $com_id AND `id_phieu_tt` = $id_phieu AND `id_hd_dh` = $hd_dh "); ?>
            <div class="ctn_table w_100 float_l">
                <table class="table" data="<?= $id_phieu ?>">
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
                            <td class="share_clr_four cr_weight share_tb_five"></td>
                            <td class="share_tb_five"></td>
                            <td class="share_clr_four cr_weight share_tb_five sum_tatca"></td>
                        </tr>
                        <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                            $id_hs = $row1['id_hs'];
                            $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                        WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);

                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS sumtt FROM `chi_tiet_phieu_tt_vt`
                                                                        WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_phieu_tt` != $id_phieu "))->result); ?>

                            <tr>
                                <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                <td><?= $than_tient['tong_tien_tatca'] - $tong_tien['sumtt'] ?></td>
                                <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                <td class="share_tb_five">
                                    <div class="form-group">
                                        <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
                                    </div>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        <? } else {
            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);

            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh");

            $checktt_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = $loai_phieu ");
            if (mysql_num_rows($checktt_hd->result) > 0) { ?>
                <div class="ctn_table">
                    <table class="table" data="<?= $id_phieu ?>">
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
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                $id_hs = $row1['id'];
                                $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                            ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>" data1="">HS - <?= $row1['id'] ?></td>
                                    <? if ($tien_datra['summ'] == $row1['tong_tien_tatca']) { ?>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>">0</td>
                                    <? } else if ($tien_datra['summ'] != $row1['tong_tien_tatca']) { ?>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                            <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                        </td>
                                    <? } ?>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <? if ($tien_datra['summ'] == $row1['tong_tien_tatca']) { ?>
                                                <input type="text" name="so_tien_ctra" data="0" value="<?= $row1['tong_tien_tatca'] ?>" onkeyup="change_tien(this)" class="form-control tex_center" readonly>
                                            <? } else if ($tien_datra['summ'] != $row1['tong_tien_tatca']) { ?>
                                                <input type="text" name="so_tien_ctra" data="" onkeyup="change_tien(this)" class="form-control tex_center">
                                            <? } ?>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
                <div class="ctn_table">
                    <table class="table" data="<?= $id_phieu ?>">
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
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>" data1="">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <? }
        }
    } else if ($loai_phieu == 2) {
        $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                AND `loai_thanh_toan` = $loai_tt AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = $loai_phieu ");
        if (mysql_num_rows($check_tt->result) > 0) {
            $list_hs = new db_query("SELECT `id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`
                                    FROM `chi_tiet_phieu_tt_vt` WHERE `id_cong_ty` = $com_id AND `id_phieu_tt` = $id_phieu AND `id_hd_dh` = $hd_dh "); ?>
            <div class="ctn_table w_100 float_l">
                <table class="table" data="<?= $id_phieu ?>">
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
                            <td class="share_clr_four cr_weight share_tb_five"></td>
                            <td class="share_tb_five"></td>
                            <td class="share_clr_four cr_weight share_tb_five sum_tatca"></td>
                        </tr>
                        <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                            $id_hs = $row1['id_hs'];
                            $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                        WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);
                            $tong_tien = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS sumtt FROM `chi_tiet_phieu_tt_vt`
                                                                        WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_phieu_tt` != $id_phieu "))->result); ?>

                            <tr>
                                <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                <td><?= $than_tient['tong_tien_tatca'] - $tong_tien['sumtt'] ?></td>
                                <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                <td class="share_tb_five">
                                    <div class="form-group">
                                        <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
                                    </div>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        <? } else {
            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);

            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh ");
            $checktt_hd = new db_query("SELECT DISTINCT `id_hd_dh` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = $loai_phieu ");
            if (mysql_num_rows($checktt_hd->result) > 0) { ?>
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
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                $id_hs = $row1['id'];
                                $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                            ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>" data1="">HS - <?= $row1['id'] ?></td>
                                    <? if ($tien_datra['summ'] == $row1['tong_tien_tatca']) { ?>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>">0</td>
                                    <? } else if ($tien_datra['summ'] != $row1['tong_tien_tatca']) { ?>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                            <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                        </td>
                                    <? } ?>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <? if ($tien_datra['summ'] == $row1['tong_tien_tatca']) { ?>
                                                <input type="text" name="so_tien_ctra" data="0" value="<?= $row1['tong_tien_tatca'] ?>" onkeyup="change_tien(this)" class="form-control tex_center" readonly>
                                            <? } else if ($tien_datra['summ'] != $row1['tong_tien_tatca']) { ?>
                                                <input type="text" name="so_tien_ctra" data="" onkeyup="change_tien(this)" class="form-control tex_center">
                                            <? } ?>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
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
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= number_format($list_giatr['gia_tri_svat']) ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>" data1="">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
        <? }
        }
    }
}

?>