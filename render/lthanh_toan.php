<?
include("config.php");
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');


if ($hd_dh != "" && $com_id != "" && $loai_phieu != "") {
    if ($loai_phieu == 1) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT `phan_loai` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result)['phan_loai'];

        if ($phan_loai == 2) {
            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);
            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2 ");
            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh");
            if (mysql_num_rows($check_tt->result) > 0) { ?>
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
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
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
            <?  } else { ?>
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
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
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
            <?  }
        } else if ($phan_loai == 1 || $phan_loai == 3 || $phan_loai == 4) {
            echo "";
        }
    } else if ($loai_phieu == 2) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT `phan_loai` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result)['phan_loai'];

        if ($phan_loai == 2) {

            $list_giatr = mysql_fetch_assoc((new db_query("SELECT `gia_tri_svat` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result);
            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh ");
            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2 ");
            if (mysql_num_rows($check_tt->result) > 0) { ?>
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
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
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
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
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
<?          }
        } else if ($phan_loai == 1) {
            echo "";
        }
    }
} ?>