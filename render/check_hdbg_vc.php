<?
include("config.php");
$id_hd = getValue('id_hd', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');

if ($id_hd != "" && $com_id != "") {
    $check_vc = mysql_fetch_assoc((new db_query("SELECT `bgom_vchuyen` FROM `hop_dong` WHERE `id` = $id_hd AND `id_cong_ty` = $com_id "))->result);
    $bgom_vc = $check_vc['bgom_vchuyen'];
    if ($bgom_vc == 1) { ?>
        <div class="form-group">
            <label>Chi phí vận chuyển</label>
            <input type="number" name="chi_phi_vc" class="form-control" placeholder="Nhập chi phí vận chuyển" readonly>
        </div>
    <? } else { ?>
        <div class="form-group">
            <label>Chi phí vận chuyển</label>
            <input type="number" name="chi_phi_vc" class="form-control" placeholder="Nhập chi phí vận chuyển">
        </div>
<? }
}

?>