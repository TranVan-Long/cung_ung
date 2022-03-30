<?
include("config.php");
$id_tc = $_POST['id_tc'];
$x = $_POST['x'];
$id_tc_dc = getValue('id_tc_dc', 'int', 'POST', '');
$list_tchi = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` ");

if ($id_tc_dc != "") { ?>
    <? if ($id_tc != "") {
        $list_tc = mysql_fetch_assoc((new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` WHERE `id` = $id_tc"))->result);
        if ($list_tc['kieu_gia_tri'] == 1) { ?>

            <td class="w-5">
                <p class="removeItem_tc"><i class="ic-delete remove_btn" data-id="<?= $id_tc_dc ?>"></i></p>
                <input type="hidden" name="id_tc" value="<?= $id_tc_dc ?>">
            </td>
            <td class="w-10">
                <p class="one_stt"><?= $x ?></p>
            </td>
            <td class="w-20">
                <div class="v-select2">
                    <select name="tieu_chi" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                        <option value="">Chọn tiêu chí đánh giá</option>
                        <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                            <option value="<?= $item_tc['id'] ?>" <?= ($item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-10">
                <p class="he_so" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
            </td>
            <td class="w-10">
                <?
                $maxd = new db_query("SELECT MAX(`gia_tri`) AS maxd FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc ");
                $maxo = mysql_fetch_assoc($maxd->result)['maxd'];
                ?>
                <input type="number" name="thang_diem" class="diem_lon_nhat hidden_bd" value="<?= $maxo ?>" readonly>
            </td>
            <td class="w-15">
                <input type="number" name="diem_dgia" class="diem_danh_gia danhg_dc" onkeyup="dien_dgia(this)" data="<?= $list_tc['kieu_gia_tri'] ?>" oninput="<?= $oninput ?>" style="margin-bottom: 5px">
            </td>
            <td class="w-15">
                <input type="text" name="tongdiem_dg" class="hidden_bd tdiem_dg" readonly>
            </td>
            <td class="w-15">
                <input type="text" name="dgia_ctiet">
            </td>
        <? } else {
            $maxd = mysql_fetch_assoc((new db_query("SELECT `id_tieu_chi`, Max(`gia_tri`) AS gt_lnhat FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc "))->result);
            $list_gtri = new db_query("SELECT  `id_tieu_chi`, `gia_tri`, `ten_gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc  "); ?>

            <td class="w-5">
                <p class="removeItem_tc"><i class="ic-delete remove_btn" data-id="<?= $id_tc_dc ?>"></i></p>
                <input type="hidden" name="id_tc" value="<?= $id_tc_dc ?>">
            </td>
            <td class="w-10">
                <p class="one_stt"><?= $x ?></p>
            </td>
            <td class="w-20">
                <div class="v-select2">
                    <select name="tieu_chi" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                        <option value="">Chọn tiêu chí đánh giá</option>
                        <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                            <option value="<?= $item_tc['id'] ?>" <?= ($item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-10">
                <p class="he_so" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
            </td>
            <td class="w-10">
                <?
                $maxd = new db_query("SELECT MAX(`gia_tri`) AS maxd FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc ");
                $maxo = mysql_fetch_assoc($maxd->result)['maxd'];
                ?>
                <input type="number" name="thang_diem" class="diem_lon_nhat hidden_bd" value="<?= $maxo ?>" readonly>
            </td>
            <td class="w-15">
                <div class="v-select2">
                    <select name="diem_dgia" class="diem_danh_gia danhg_dc" data="<?= $list_tc['kieu_gia_tri'] ?>" onchange="dien_dgia(this)">
                        <option value="">Chọn giá trị</option>
                        <? while ($item = mysql_fetch_assoc($list_gtri->result)) { ?>
                            <option value="<?= $item['gia_tri'] ?>"><?= $item['gia_tri'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-15">
                <input type="text" name="tongdiem_dg" class="hidden_bd tdiem_dg" readonly>
            </td>
            <td class="w-15">
                <input type="text" name="dgia_ctiet">
            </td>
        <? }
    } else { ?>

        <td class="w-5">
            <p class="removeItem_tc"><i class="ic-delete remove_btn" data-id="<?= $id_tc_dc ?>"></i></p>
            <input type="hidden" name="id_tc" value="<?= $id_tc_dc ?>">
        </td>
        <td class="w-10">
            <p class="one_stt"><?= $x ?></p>
        </td>
        <td class="w-20">
            <div class="v-select2">
                <select name="tieu_chi" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                    <option value="">Chọn tiêu chí đánh giá</option>
                    <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                        <option value="<?= $item_tc['id'] ?>"><?= $item_tc['tieu_chi'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="w-10">
            <p></p>
        </td>
        <td class="w-10">
            <input type="number" name="thang_diem" class="diem_lon_nhat hidden_bd" readonly>
        </td>
        <td class="w-15">
            <input type="text" name="diem_dgia danhg_dc" oninput="<?= $oninput ?>">
        </td>
        <td class="w-15">
            <input type="text" name="tongdiem_dg" class="hidden_bd tdiem_dg" readonly>
        </td>
        <td class="w-15">
            <input type="text" name="dgia_ctiet">
        </td>
    <? } ?>
<? } else if ($id_tc_dc == "") { ?>
    <? if ($id_tc != "") {
        $list_tc = mysql_fetch_assoc((new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` WHERE `id` = $id_tc"))->result);
        if ($list_tc['kieu_gia_tri'] == 1) {
            $maxd = mysql_fetch_assoc((new db_query("SELECT `id_tieu_chi`, `gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc "))->result); ?>

            <td class="w-5">
                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
            </td>
            <td class="w-10">
                <p class="one_stt"><?= $x ?></p>
            </td>
            <td class="w-20">
                <div class="v-select2">
                    <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                        <option value="">Chọn tiêu chí đánh giá</option>
                        <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                            <option value="<?= $item_tc['id'] ?>" <?= ($item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-10">
                <p class="he_so" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
            </td>
            <td class="w-10">
                <input type="number" name="thang_diem_m" class="diem_lon_nhat hidden_bd" value="<?= $maxd['gia_tri'] ?>" readonly>
            </td>
            <td class="w-15">
                <input type="number" name="diem_danh_gia" class="diem_danh_gia dd_gia" onkeyup="dien_dgia(this)" data="<?= $list_tc['kieu_gia_tri'] ?>" oninput="<?= $oninput ?>" style="margin-bottom: 5px">
            </td>
            <td class="w-15">
                <input type="text" name="tdiem_dg" class="hidden_bd tdiem_dg" readonly>
            </td>
            <td class="w-15">
                <input type="text" name="dg_ctiet">
            </td>
        <? } else {
            $maxd = mysql_fetch_assoc((new db_query("SELECT `id_tieu_chi`, Max(`gia_tri`) AS gt_lnhat FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc "))->result);
            $list_gtri = new db_query("SELECT  `id_tieu_chi`, `gia_tri`, `ten_gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc  "); ?>

            <td class="w-5">
                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
            </td>
            <td class="w-10">
                <p class="one_stt"><?= $x ?></p>
            </td>
            <td class="w-20">
                <div class="v-select2">
                    <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                        <option value="">Chọn tiêu chí đánh giá</option>
                        <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                            <option value="<?= $item_tc['id'] ?>" <?= ($item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-10">
                <p class="he_so" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
            </td>
            <td class="w-10">
                <input type="number" name="thang_diem_m" class="diem_lon_nhat hidden_bd" value="<?= $maxd['gt_lnhat'] ?>" readonly>
            </td>
            <td class="w-15">
                <div class="v-select2">
                    <select name="diem_danh_gia" class="diem_danh_gia dd_gia" data="<?= $list_tc['kieu_gia_tri'] ?>" onchange="dien_dgia(this)">
                        <option value="">Chọn giá trị</option>
                        <? while ($item = mysql_fetch_assoc($list_gtri->result)) { ?>
                            <option value="<?= $item['gia_tri'] ?>"><?= $item['gia_tri'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
            <td class="w-15">
                <input type="text" name="tdiem_dg" class="hidden_bd tdiem_dg" readonly>
            </td>
            <td class="w-15">
                <input type="text" name="dg_ctiet">
            </td>
        <? }
    } else { ?>

        <td class="w-5">
            <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
        </td>
        <td class="w-10">
            <p class="one_stt"><?= $x ?></p>
        </td>
        <td class="w-20">
            <div class="v-select2">
                <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                    <option value="">Chọn tiêu chí đánh giá</option>
                    <? while ($item_tc = mysql_fetch_assoc($list_tchi->result)) { ?>
                        <option value="<?= $item_tc['id'] ?>"><?= $item_tc['tieu_chi'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="w-10">
            <p></p>
        </td>
        <td class="w-10">
            <input type="number" name="thang_diem_m" class="diem_lon_nhat hidden_bd" readonly>
        </td>
        <td class="w-15">
            <input type="text" name="diem_danh_gia" class="dd_gia" oninput="<?= $oninput ?>">
        </td>
        <td class="w-15">
            <input type="text" name="tdiem_dg" class="hidden_bd tdiem_dg" readonly>
        </td>
        <td class="w-15">
            <input type="text" name="dg_ctiet">
        </td>
    <? } ?>
<? } ?>