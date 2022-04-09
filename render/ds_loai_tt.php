<?
include("config.php");
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');


if ($hd_dh != "" && $com_id != "" && $loai_phieu != "") {
    if ($loai_phieu == 1) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT `phan_loai` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result)['phan_loai'];

        if ($phan_loai == 1 || $phan_loai == 3 || $phan_loai == 4) { ?>
            <label>Loại thanh toán <span class="cr_red">*</span></label>
            <select name="lthanh_toan" class="form-control all_ltt  share_select" data="<?= $com_id ?>" onchange="loai_tt_doi(this)">
                <option value="">-- Chọn loại thanh toán --</option>
                <option value="1">Tạm ứng</option>
                <option value="2">Theo hợp đồng</option>
            </select>
        <? } else if ($phan_loai == 2) { ?>
            <label>Loại thanh toán <span class="cr_red">*</span></label>
            <input name="lthanh_toan" value="Theo hợp đồng" data="2" class="form-control" readonly>
        <? }
    } else if ($loai_phieu == 2) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT `phan_loai` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id` = $hd_dh "))->result)['phan_loai'];
        if ($phan_loai == 1) { ?>
            <label>Loại thanh toán <span class="cr_red">*</span></label>
            <select name="lthanh_toan" class="form-control all_ltt share_select" data="<?= $com_id ?>" onchange="loai_tt_doi(this)">
                <option value="">-- Chọn loại thanh toán --</option>
                <option value="1">Tạm ứng</option>
                <option value="2">Theo hợp đồng</option>
            </select>
        <? } else if ($phan_loai == 2) { ?>
            <label>Loại thanh toán <span class="cr_red">*</span></label>
            <input name="lthanh_toan" value="Theo hợp đồng" data="2" class="form-control" readonly>
<?          }
    }
}


?>