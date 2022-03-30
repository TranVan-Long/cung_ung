<?
include("config.php");
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_nguoi_lh = getValue('id_nguoi_lh', 'int', 'POST', '');

if ($com_id != "" && $id_ncc != "") {
    $list_nlh = new db_query("SELECT `id`, `ten_nguoi_lh` FROM `nguoi_lien_he` WHERE `id_nha_cc` = $id_ncc ");

    $list_sdt = new db_query("SELECT `so_dien_thoai` FROM `nha_cc_kh` WHERE `id` = $id_ncc AND `id_cong_ty` = $com_id AND `phan_loai` = 1 ");
    $so_dien_thoai = mysql_fetch_assoc($list_sdt->result)['so_dien_thoai'];
}
?>
<div class="form-group share_form_select">
    <label>Người liên hệ</label>
    <select name="nguoi_lh" class="form-control share_select">
        <option value=""> -- Chọn người liên hệ --</option>
        <? while ($row = mysql_fetch_assoc($list_nlh->result)) { ?>
            <option value="<?= $row['id'] ?>" <?= ($id_nguoi_lh == $row['id']) ? "selected" : "" ?>><?= $row['ten_nguoi_lh'] ?></option>
        <? } ?>
    </select>
</div>
<div class="form-group share_form_select">
    <label>Số điện thoại / Fax</label>
    <input type="text" name="so_dthoai" value="<?= $so_dien_thoai ?>" class="form-control" placeholder="Số điện thoại nhà cung cấp" readonly>
</div>
